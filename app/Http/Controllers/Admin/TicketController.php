<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with(['user', 'showtime.film', 'showtime.cinema', 'payment']);

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('ticket_code', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('email', 'like', "%{$search}%");
                    })
                    ->orWhereHas('showtime.film', function ($filmQuery) use ($search) {
                        $filmQuery->where('title', 'like', "%{$search}%");
                    });
            });
        }

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date
        if ($request->has('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $tickets = $query->latest()->paginate(15);

        $stats = [
            'total' => Ticket::count(),
            'pending' => Ticket::where('status', 'pending')->count(),
            'paid' => Ticket::where('status', 'paid')->count(),
            'expired' => Ticket::where('status', 'expired')->count(),
            'used' => Ticket::where('status', 'used')->count(),
            'revenue' => Ticket::where('status', 'paid')->sum('total_price'),
        ];

        return view('admin.tickets.index', compact('tickets', 'stats'));
    }

    public function show($id)
    {
        $ticket = Ticket::with(['user', 'showtime.film', 'showtime.cinema', 'payment'])
            ->findOrFail($id);

        return view('admin.tickets.show', compact('ticket'));
    }

    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);

        // Only allow deleting expired/pending tickets
        if (!in_array($ticket->status, ['expired', 'pending'])) {
            return back()->with('error', 'Cannot delete paid or used tickets');
        }

        $ticket->delete();

        return redirect()->route('admin.tickets.index')
            ->with('success', 'Ticket deleted successfully');
    }

    public function stats()
    {
        $dailyStats = Ticket::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(CASE WHEN status = "paid" THEN 1 ELSE 0 END) as paid'),
            DB::raw('SUM(CASE WHEN status = "paid" THEN total_price ELSE 0 END) as revenue')
        )
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->limit(30)
            ->get();

        return view('admin.tickets.stats', compact('dailyStats'));
    }
}
