<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Ticket;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::with('ticketCategories')
            ->where('status', 'upcoming')
            ->where('event_date', '>=', now());

        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category', $request->category);
        }

        // Filter by city
        if ($request->has('city') && $request->city != '') {
            $query->where('city', $request->city);
        }

        // Search
        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $events = $query->orderBy('event_date')->paginate(12);

        $categories = Event::distinct()->pluck('category');
        $cities = Event::distinct()->pluck('city');

        return view('events.index', compact('events', 'categories', 'cities'));
    }

    public function show($slug)
    {
        $event = Event::with('ticketCategories')
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedEvents = Event::where('category', $event->category)
            ->where('id', '!=', $event->id)
            ->where('status', 'upcoming')
            ->where('event_date', '>=', now())
            ->take(4)
            ->get();

        return view('events.show', compact('event', 'relatedEvents'));
    }

    public function order(Event $event)
    {
        return view('events.order', compact('event'));
    }

    public function processOrder(Request $request)
    {
        // Validasi input
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'tickets' => 'required|json',
            'total_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
            'payment_method' => 'required|string',
            'provider' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            $event = Event::findOrFail($request->event_id);
            $tickets = json_decode($request->tickets, true);

            // Validasi ketersediaan tiket
            foreach ($tickets as $item) {
                $category = TicketCategory::where('event_id', $event->id)
                    ->where('name', $item['category'])
                    ->first();

                if (!$category) {
                    throw new \Exception("Kategori tiket {$item['category']} tidak ditemukan");
                }

                if ($category->available < $item['quantity']) {
                    throw new \Exception("Tiket untuk kategori {$item['category']} tidak mencukupi. Tersisa {$category->available}");
                }

                if ($item['quantity'] > $category->max_per_order) {
                    throw new \Exception("Maksimal pembelian untuk {$item['category']} adalah {$category->max_per_order} tiket");
                }
            }

            // Buat tiket
            $ticket = Ticket::create([
                'user_id' => auth()->id(),
                'event_id' => $event->id,
                'ticket_details' => $tickets,
                'quantity' => $request->quantity,
                'total_price' => $request->total_price,
                'payment_method' => $request->payment_method,
                'provider' => $request->provider,
                'status' => 'pending',
            ]);

            // Generate QR Code
            $qrCode = $this->generateQRCode($ticket->booking_code);
            $ticket->update(['qr_code' => $qrCode]);

            // Kurangi stok tiket
            foreach ($tickets as $item) {
                $category = TicketCategory::where('event_id', $event->id)
                    ->where('name', $item['category'])
                    ->first();

                if ($category) {
                    $category->decrement('available', $item['quantity']);
                }
            }

            // Buat payment record
            $paymentDetails = $this->getPaymentDetails($request->payment_method, $request->provider);

            Payment::create([
                'ticket_id' => $ticket->id,
                'method' => $request->payment_method,
                'provider' => $request->provider,
                'amount' => $request->total_price,
                'payment_details' => $paymentDetails,
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()->route('payment.pending', $ticket->booking_code)
                ->with('success', 'Silakan selesaikan pembayaran dalam 24 jam.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memproses pesanan: ' . $e->getMessage())->withInput();
        }
    }

    private function generateQRCode($code)
    {
        try {
            $qrCode = QrCode::format('png')
                ->size(300)
                ->margin(2)
                ->generate($code);

            $fileName = 'qrcodes/' . Str::random(20) . '.png';
            Storage::disk('public')->put($fileName, $qrCode);

            return $fileName;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function getPaymentDetails($method, $provider)
    {
        $details = [
            'ewallet' => [
                'gopay' => ['type' => 'E-Wallet', 'provider' => 'GoPay'],
                'ovo' => ['type' => 'E-Wallet', 'provider' => 'OVO'],
                'dana' => ['type' => 'E-Wallet', 'provider' => 'DANA'],
            ],
            'virtual_account' => [
                'bca' => ['type' => 'Virtual Account', 'provider' => 'BCA', 'va_number' => '8800' . rand(100000000, 999999999)],
                'mandiri' => ['type' => 'Virtual Account', 'provider' => 'Mandiri', 'va_number' => '8860' . rand(100000000, 999999999)],
                'bri' => ['type' => 'Virtual Account', 'provider' => 'BRI', 'va_number' => '8888' . rand(100000000, 999999999)],
            ],
            'qris' => [
                'qris' => ['type' => 'QRIS', 'provider' => 'QRIS'],
            ],
            'transfer_bank' => [
                'bca' => ['type' => 'Transfer Bank', 'provider' => 'BCA', 'account_number' => '1234567890'],
                'mandiri' => ['type' => 'Transfer Bank', 'provider' => 'Mandiri', 'account_number' => '1234567890'],
                'bni' => ['type' => 'Transfer Bank', 'provider' => 'BNI', 'account_number' => '1234567890'],
            ],
        ];

        return $details[$method][$provider] ?? $details[$method] ?? [];
    }

    public function processWhatsAppOrder(Request $request)
    {
        // Ubah validasi dari 'json' menjadi 'array'
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'tickets' => 'required|array', // Perbaikan: dari 'json' ke 'array'
            'total_price' => 'required|numeric',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            $event = Event::findOrFail($request->event_id);
            $tickets = $request->tickets; // Langsung pakai array, tidak perlu json_decode
            $user = auth()->user();

            // Log untuk debugging
            \Log::info('WhatsApp Order:', [
                'event' => $event->title,
                'user' => $user->email,
                'tickets' => $tickets
            ]);

            // Generate ticket details text
            $ticketDetails = "";
            foreach ($tickets as $item) {
                $ticketDetails .= "- {$item['category']}: {$item['quantity']} tiket x Rp " . number_format($item['price'], 0, ',', '.') . "\n";
            }

            // Get template from settings (dengan default template)
            $template = Setting::get(
                'whatsapp_message_template',
                "Halo, saya ingin memesan tiket untuk event *{event_title}*\n\n" .
                    "Detail Pemesanan:\n" .
                    "- Nama: {name}\n" .
                    "- Email: {email}\n" .
                    "- Event: {event_title}\n" .
                    "- Tanggal: {event_date}\n" .
                    "- Jam: {event_time}\n" .
                    "- Tiket:\n{ticket_details}\n" .
                    "- Total: Rp {total_price}\n\n" .
                    "Mohon konfirmasi ketersediaan tiket. Terima kasih."
            );

            // Replace variables
            $message = str_replace(
                ['{name}', '{email}', '{event_title}', '{event_date}', '{event_time}', '{ticket_details}', '{total_price}', '{quantity}'],
                [
                    $user->name,
                    $user->email,
                    $event->title,
                    \Carbon\Carbon::parse($event->event_date)->format('l, d F Y'),
                    \Carbon\Carbon::parse($event->event_time)->format('H:i') . ' WIB',
                    $ticketDetails,
                    'Rp ' . number_format($request->total_price, 0, ',', '.'),
                    $request->quantity
                ],
                $template
            );

            // Clean WhatsApp number
            $whatsappNumber = Setting::get('whatsapp_number', '628123456789');
            $whatsappNumber = preg_replace('/[^0-9]/', '', $whatsappNumber);

            // Ensure number starts with country code
            if (substr($whatsappNumber, 0, 2) !== '62') {
                if (substr($whatsappNumber, 0, 1) === '0') {
                    $whatsappNumber = '62' . substr($whatsappNumber, 1);
                } else {
                    $whatsappNumber = '62' . $whatsappNumber;
                }
            }

            // Create WhatsApp URL
            $encodedMessage = urlencode($message);
            $whatsappUrl = "https://wa.me/{$whatsappNumber}?text={$encodedMessage}";

            return response()->json([
                'success' => true,
                'whatsapp_url' => $whatsappUrl,
                'message' => 'Redirecting to WhatsApp...'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . json_encode($e->errors())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('WhatsApp Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal memproses: ' . $e->getMessage()
            ], 500);
        }
    }
}
