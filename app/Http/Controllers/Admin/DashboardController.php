<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Film;
use App\Models\Ticket;
use App\Models\Banner;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Basic stats
        $stats = [
            'total_films' => Film::count(),
            'now_playing' => Film::where('status', 'now_playing')->count(),
            'coming_soon' => Film::where('status', 'coming_soon')->count(),
            'tickets_sold' => Ticket::where('status', 'paid')->count(),
            'total_users' => User::where('role', 'user')->count(),
            'total_banners' => Banner::where('is_active', true)->count(),
            'revenue_today' => Ticket::whereDate('paid_at', today())
                ->where('status', 'paid')
                ->sum('total_price'),
            'revenue_month' => Ticket::whereMonth('paid_at', now()->month)
                ->where('status', 'paid')
                ->sum('total_price'),
            'revenue_total' => Ticket::where('status', 'paid')->sum('total_price'),
        ];

        // Recent tickets (PENTING: ini harus ada untuk view)
        $recentTickets = Ticket::with(['user', 'showtime.film'])
            ->latest()
            ->take(10)
            ->get();

        // Tambahkan recent_tickets ke array stats
        $stats['recent_tickets'] = $recentTickets;

        // Popular films
        $popularFilms = Film::select('films.*', DB::raw('COUNT(tickets.id) as ticket_count'))
            ->leftJoin('showtimes', 'films.id', '=', 'showtimes.film_id')
            ->leftJoin('tickets', 'showtimes.id', '=', 'tickets.showtime_id')
            ->where('tickets.status', 'paid')
            ->groupBy('films.id')
            ->orderBy('ticket_count', 'desc')
            ->take(5)
            ->get();

        // Daily revenue chart data
        $dailyRevenue = Ticket::select(
            DB::raw('DATE(paid_at) as date'),
            DB::raw('SUM(total_price) as total')
        )
            ->where('status', 'paid')
            ->where('paid_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Payment methods distribution
        $paymentMethods = Payment::select('method', DB::raw('COUNT(*) as count'))
            ->where('status', 'success')
            ->groupBy('method')
            ->get();

        // Ticket status distribution
        $ticketStatus = Ticket::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentTickets',
            'popularFilms',
            'dailyRevenue',
            'paymentMethods',
            'ticketStatus'
        ));
    }

    public function quickActions(Request $request)
    {
        $action = $request->action;

        switch ($action) {
            case 'expire-pending':
                $count = Ticket::where('status', 'pending')
                    ->where('expired_at', '<', now())
                    ->update(['status' => 'expired']);
                return response()->json(['success' => true, 'count' => $count]);

            case 'clear-expired':
                $count = Ticket::where('status', 'expired')->delete();
                return response()->json(['success' => true, 'count' => $count]);

            default:
                return response()->json(['success' => false, 'message' => 'Unknown action']);
        }
    }
}
