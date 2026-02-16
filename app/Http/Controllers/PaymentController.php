<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Showtime;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman pembayaran
     * Dari halaman detail film: route('payment.show', $showtime) + ?qty={jumlah}
     */
    public function showPayment(Request $request, $showtimeId)
    {
        $showtime = Showtime::with(['film', 'cinema'])->findOrFail($showtimeId);

        // Ambil jumlah tiket dari query string
        $qty = $request->query('qty', 1);

        // Validasi jumlah tiket
        if ($qty < 1 || $qty > $showtime->available_seats) {
            return redirect()->back()->with('error', 'Jumlah tiket tidak valid');
        }

        // Generate seat layout (untuk pemilihan kursi)
        $seats = $this->generateSeats($showtime);

        // Hitung total harga sementara
        $totalPrice = $showtime->price * $qty;

        return view('payment.show', compact('showtime', 'qty', 'seats', 'totalPrice'));
    }

    public function processPayment(Request $request)
    {
        $request->validate([
            'showtime_id' => 'required|exists:showtimes,id',
            'seats' => 'required|array|min:1',
            'quantity' => 'required|integer|min:1',
            'total_price' => 'required|numeric',
            'payment_method' => 'required|in:ewallet,virtual_account,qris,transfer_bank',
            'provider' => 'required',
        ]);

        try {
            DB::beginTransaction();

            $showtime = Showtime::findOrFail($request->showtime_id);

            // Check seat availability
            $bookedSeats = Ticket::where('showtime_id', $showtime->id)
                ->whereIn('status', ['pending', 'paid'])
                ->get()
                ->pluck('seats')
                ->flatten()
                ->toArray();

            foreach ($request->seats as $seat) {
                if (in_array($seat, $bookedSeats)) {
                    throw new \Exception("Seat {$seat} is already booked");
                }
            }

            // Create ticket
            $ticket = Ticket::create([
                'user_id' => auth()->id(),
                'showtime_id' => $request->showtime_id,
                'seats' => $request->seats,
                'quantity' => $request->quantity,
                'total_price' => $request->total_price,
                'payment_method' => $request->payment_method,
                'provider' => $request->provider,
                'status' => 'pending',
                'booking_code' => strtoupper(Str::random(8)),
                'expired_at' => now()->addHours(24),
            ]);

            // Generate QR Code
            $qrCode = $this->generateQRCode($ticket->booking_code);
            $ticket->update(['qr_code' => $qrCode]);

            // Create payment record
            $paymentDetails = $this->getPaymentDetails($request->payment_method, $request->provider);

            Payment::create([
                'ticket_id' => $ticket->id,
                'method' => $request->payment_method,
                'provider' => $request->provider,
                'amount' => $request->total_price,
                'payment_details' => $paymentDetails,
                'status' => 'pending',
            ]);

            // Update available seats
            $showtime->available_seats -= $request->quantity;
            $showtime->save();

            DB::commit();

            // Redirect ke halaman payment instructions
            return redirect()->route('payment.pending', $ticket->booking_code)
                ->with('success', 'Silakan selesaikan pembayaran dalam 24 jam');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment failed: ' . $e->getMessage());
        }
    }

    public function showTicket($code)
    {
        $ticket = Ticket::with(['user', 'showtime.film', 'showtime.cinema', 'payment'])
            ->where('ticket_code', $code)
            ->firstOrFail();

        // Check if user is authorized
        if (auth()->user()->role !== 'admin' && $ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Check if ticket is expired
        if ($ticket->isExpired()) {
            $ticket->markAsExpired();
            if ($ticket->payment) {
                $ticket->payment->markAsExpired();
            }
        }

        return view('ticket', compact('ticket'));
    }

    public function simulatePayment($ticketCode)
    {
        $ticket = Ticket::with('payment')->where('ticket_code', $ticketCode)->firstOrFail();

        // Only admin can simulate payment
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        try {
            DB::beginTransaction();

            if ($ticket->payment) {
                $ticket->payment->markAsSuccess([
                    'simulated_at' => now(),
                    'simulated_by' => auth()->id(),
                ]);
            }

            $ticket->markAsPaid();

            DB::commit();

            return redirect()->route('ticket.show', $ticket->ticket_code)
                ->with('success', 'Payment simulated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Simulation failed');
        }
    }

    public function downloadTicket($code)
    {
        $ticket = Ticket::with(['showtime.film', 'showtime.cinema'])
            ->where('ticket_code', $code)
            ->firstOrFail();

        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$ticket->isPaid()) {
            return back()->with('error', 'Ticket must be paid first');
        }

        // Generate PDF or image download
        // For simplicity, we'll just return the QR code image
        if ($ticket->qr_code && Storage::disk('public')->exists($ticket->qr_code)) {
            return Storage::disk('public')->download($ticket->qr_code, "ticket-{$code}.png");
        }

        return back()->with('error', 'QR Code not found');
    }

    public function checkStatus($code)
    {
        $ticket = Ticket::where('ticket_code', $code)->firstOrFail();

        return response()->json([
            'status' => $ticket->status,
            'expired_at' => $ticket->expired_at,
            'is_expired' => $ticket->isExpired(),
            'payment_status' => $ticket->payment ? $ticket->payment->status : null,
        ]);
    }

    private function generateQRCode($ticketCode)
    {
        $qrCode = QrCode::format('png')
            ->size(300)
            ->margin(2)
            ->color(0, 0, 0)
            ->backgroundColor(255, 255, 255)
            ->generate($ticketCode);

        $fileName = 'qrcodes/' . Str::random(20) . '.png';
        Storage::disk('public')->put($fileName, $qrCode);

        return $fileName;
    }

    private function generateSeats($showtime)
    {
        $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
        $seatsPerRow = 12;

        $bookedSeats = Ticket::where('showtime_id', $showtime->id)
            ->whereIn('status', ['pending', 'paid'])
            ->get()
            ->pluck('seats')
            ->flatten()
            ->toArray();

        $seats = [];
        foreach ($rows as $row) {
            for ($i = 1; $i <= $seatsPerRow; $i++) {
                $seatNumber = $row . str_pad($i, 2, '0', STR_PAD_LEFT);
                $seats[] = [
                    'seat' => $seatNumber,
                    'available' => !in_array($seatNumber, $bookedSeats),
                    'price' => $showtime->price,
                ];
            }
        }

        return $seats;
    }

    private function getPaymentDetails($method, $provider)
    {
        $details = [
            'ewallet' => [
                'gopay' => [
                    'type' => 'EWallet',
                    'provider' => 'GoPay',
                    'qr_code' => 'https://via.placeholder.com/200x200?text=Gopay+QR',
                    'instructions' => 'Scan QR code dengan aplikasi GoPay',
                ],
                'ovo' => [
                    'type' => 'EWallet',
                    'provider' => 'OVO',
                    'qr_code' => 'https://via.placeholder.com/200x200?text=OVO+QR',
                    'instructions' => 'Scan QR code dengan aplikasi OVO',
                ],
                'dana' => [
                    'type' => 'EWallet',
                    'provider' => 'DANA',
                    'qr_code' => 'https://via.placeholder.com/200x200?text=DANA+QR',
                    'instructions' => 'Scan QR code dengan aplikasi DANA',
                ],
            ],
            'virtual_account' => [
                'bca' => [
                    'type' => 'Virtual Account',
                    'provider' => 'BCA',
                    'va_number' => '8800' . rand(100000000, 999999999),
                    'instructions' => 'Transfer ke nomor virtual account BCA',
                ],
                'mandiri' => [
                    'type' => 'Virtual Account',
                    'provider' => 'Mandiri',
                    'va_number' => '8860' . rand(100000000, 999999999),
                    'instructions' => 'Transfer ke nomor virtual account Mandiri',
                ],
                'bri' => [
                    'type' => 'Virtual Account',
                    'provider' => 'BRI',
                    'va_number' => '8888' . rand(100000000, 999999999),
                    'instructions' => 'Transfer ke nomor virtual account BRI',
                ],
            ],
            'qris' => [
                'type' => 'QRIS',
                'provider' => 'QRIS',
                'qr_code' => 'https://via.placeholder.com/200x200?text=QRIS',
                'instructions' => 'Scan QR code dengan aplikasi pembayaran yang mendukung QRIS',
            ],
            'transfer_bank' => [
                'bca' => [
                    'type' => 'Transfer Bank',
                    'provider' => 'BCA',
                    'bank' => 'BCA',
                    'account_number' => '1234567890',
                    'account_name' => 'PT TIX Bioskop',
                    'instructions' => 'Transfer ke rekening BCA',
                ],
                'mandiri' => [
                    'type' => 'Transfer Bank',
                    'provider' => 'Mandiri',
                    'bank' => 'Mandiri',
                    'account_number' => '1234567890',
                    'account_name' => 'PT TIX Bioskop',
                    'instructions' => 'Transfer ke rekening Mandiri',
                ],
                'bni' => [
                    'type' => 'Transfer Bank',
                    'provider' => 'BNI',
                    'bank' => 'BNI',
                    'account_number' => '1234567890',
                    'account_name' => 'PT TIX Bioskop',
                    'instructions' => 'Transfer ke rekening BNI',
                ],
            ],
        ];

        return $details[$method][$provider] ?? $details[$method] ?? [];
    }
}
