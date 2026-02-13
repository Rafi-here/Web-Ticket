<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::with(['ticket.user', 'ticket.showtime.film']);

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('payment_code', 'like', "%{$search}%")
                    ->orWhereHas('ticket', function ($ticketQuery) use ($search) {
                        $ticketQuery->where('ticket_code', 'like', "%{$search}%")
                            ->orWhereHas('user', function ($userQuery) use ($search) {
                                $userQuery->where('name', 'like', "%{$search}%");
                            });
                    });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by method
        if ($request->has('method') && $request->method !== 'all') {
            $query->where('method', $request->method);
        }

        $payments = $query->latest()->paginate(15);

        $stats = [
            'total' => Payment::count(),
            'pending' => Payment::where('status', 'pending')->count(),
            'success' => Payment::where('status', 'success')->count(),
            'failed' => Payment::where('status', 'failed')->count(),
            'total_amount' => Payment::where('status', 'success')->sum('amount'),
        ];

        return view('admin.payments.index', compact('payments', 'stats'));
    }

    public function show($id)
    {
        $payment = Payment::with(['ticket.user', 'ticket.showtime.film', 'ticket.showtime.cinema'])
            ->findOrFail($id);

        return view('admin.payments.show', compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pending,success,failed,expired'
        ]);

        $oldStatus = $payment->status;
        $newStatus = $request->status;

        $payment->update(['status' => $newStatus]);

        // Update ticket status based on payment
        if ($newStatus === 'success' && $oldStatus !== 'success') {
            $payment->ticket->markAsPaid();
        } elseif ($newStatus === 'failed' && $payment->ticket->status === 'pending') {
            $payment->ticket->markAsExpired();
        }

        return redirect()->route('admin.payments.show', $payment->id)
            ->with('success', 'Payment status updated successfully');
    }
}
