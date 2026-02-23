<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function pending($code)
    {
        $ticket = Ticket::with(['event', 'payment'])
            ->where('booking_code', $code)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Auto expired check
        if ($ticket->isExpired()) {
            $ticket->markAsExpired();
        }

        // Hitung sisa waktu
        $remainingSeconds = 0;
        if ($ticket->status === 'pending' && !$ticket->isExpired()) {
            $remainingSeconds = max(0, now()->diffInSeconds($ticket->expired_at, false));
        }

        return view('payment.pending', compact('ticket', 'remainingSeconds'));
    }

    public function showTicket($code)
    {
        $ticket = Ticket::with(['user', 'event', 'payment'])
            ->where('booking_code', $code)
            ->orWhere('ticket_code', $code)
            ->firstOrFail();

        // Authorisasi
        if (auth()->user()->role !== 'admin' && $ticket->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        // Auto expired check
        if ($ticket->isExpired() && $ticket->status === 'pending') {
            $ticket->markAsExpired();
        }

        return view('ticket.show', compact('ticket'));
    }

    public function simulatePayment($code)
    {
        $ticket = Ticket::with('payment')
            ->where('booking_code', $code)
            ->orWhere('ticket_code', $code)
            ->firstOrFail();

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        try {
            DB::beginTransaction();

            if ($ticket->status !== 'pending') {
                throw new \Exception('Tiket sudah diproses.');
            }

            if ($ticket->isExpired()) {
                throw new \Exception('Tiket sudah expired.');
            }

            if ($ticket->payment) {
                $ticket->payment->update([
                    'status' => 'success',
                    'paid_at' => now(),
                ]);
            }

            $ticket->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            DB::commit();

            return redirect()->route('ticket.show', $ticket->booking_code ?? $ticket->ticket_code)
                ->with('success', 'Pembayaran berhasil (simulasi).');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Simulasi gagal: ' . $e->getMessage());
        }
    }

    public function downloadTicket($code)
    {
        $ticket = Ticket::where('booking_code', $code)
            ->orWhere('ticket_code', $code)
            ->firstOrFail();

        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }

        if (!$ticket->isPaid()) {
            return back()->with('error', 'Tiket harus sudah dibayar.');
        }

        if ($ticket->qr_code && Storage::disk('public')->exists($ticket->qr_code)) {
            return Storage::disk('public')->download($ticket->qr_code, "tiket-{$code}.png");
        }

        return back()->with('error', 'QR Code tidak ditemukan.');
    }

    public function checkStatus($code)
    {
        $ticket = Ticket::where('booking_code', $code)
            ->orWhere('ticket_code', $code)
            ->firstOrFail();

        return response()->json([
            'status' => $ticket->status,
            'expired_at' => $ticket->expired_at ? $ticket->expired_at->format('Y-m-d H:i:s') : null,
            'is_expired' => $ticket->isExpired(),
            'payment_status' => $ticket->payment ? $ticket->payment->status : null,
        ]);
    }
}