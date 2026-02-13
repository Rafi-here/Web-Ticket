<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function scan($code)
    {
        $ticket = Ticket::with(['showtime.film', 'showtime.cinema', 'user'])
            ->where('ticket_code', $code)
            ->first();

        if (!$ticket) {
            return response()->json([
                'valid' => false,
                'message' => 'Ticket not found',
                'code' => 'NOT_FOUND'
            ], 404);
        }

        // Check if ticket is expired
        if ($ticket->isExpired()) {
            $ticket->markAsExpired();
            return response()->json([
                'valid' => false,
                'message' => 'Ticket has expired',
                'code' => 'EXPIRED',
                'ticket' => [
                    'code' => $ticket->ticket_code,
                    'status' => $ticket->status,
                    'expired_at' => $ticket->expired_at,
                ]
            ], 400);
        }

        // Check if ticket is already used
        if ($ticket->isUsed()) {
            return response()->json([
                'valid' => false,
                'message' => 'Ticket already used',
                'code' => 'USED',
                'ticket' => [
                    'code' => $ticket->ticket_code,
                    'status' => $ticket->status,
                    'used_at' => $ticket->used_at,
                ]
            ], 400);
        }

        // Check if ticket is paid
        if (!$ticket->isPaid()) {
            return response()->json([
                'valid' => false,
                'message' => 'Ticket not paid yet',
                'code' => 'UNPAID',
                'ticket' => [
                    'code' => $ticket->ticket_code,
                    'status' => $ticket->status,
                    'expired_at' => $ticket->expired_at,
                ]
            ], 400);
        }

        // Valid ticket - mark as used
        $ticket->markAsUsed();

        return response()->json([
            'valid' => true,
            'message' => 'Ticket is valid',
            'code' => 'VALID',
            'ticket' => [
                'code' => $ticket->ticket_code,
                'film' => $ticket->showtime->film->title,
                'cinema' => $ticket->showtime->cinema->name,
                'showtime' => $ticket->showtime->show_date . ' ' . $ticket->showtime->show_time,
                'seats' => $ticket->seats,
                'customer' => $ticket->user->name,
                'used_at' => $ticket->used_at,
            ]
        ]);
    }

    public function scanPage()
    {
        return view('scan');
    }

    public function validateScan(Request $request)
    {
        $request->validate([
            'ticket_code' => 'required|string'
        ]);

        return redirect()->route('scan.result', $request->ticket_code);
    }

    public function scanResult($code)
    {
        $ticket = Ticket::with(['showtime.film', 'showtime.cinema', 'user'])
            ->where('ticket_code', $code)
            ->first();

        return view('scan-result', compact('ticket', 'code'));
    }
}
