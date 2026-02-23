<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Banner;
use App\Models\User;
use App\Models\Payment;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung tiket terjual per event (manual karena relasi mungkin belum sempurna)
        $events = Event::with('ticketCategories')->get();
        $totalTicketsSold = 0;
        $popularEvents = collect();
        
        foreach ($events as $event) {
            $soldCount = 0;
            foreach ($event->ticketCategories as $category) {
                $soldCount += ($category->quantity - $category->available);
            }
            $event->ticket_count = $soldCount;
            $totalTicketsSold += $soldCount;
            $popularEvents->push($event);
        }
        
        // Urutkan berdasarkan ticket_count descending dan ambil 5
        $popularEvents = $popularEvents->sortByDesc('ticket_count')->take(5);

        // Basic stats
        $stats = [
            'total_events' => Event::count(),
            'upcoming_events' => Event::where('status', 'upcoming')->count(),
            'ongoing_events' => Event::where('status', 'ongoing')->count(),
            'ended_events' => Event::where('status', 'ended')->count(),
            'cancelled_events' => Event::where('status', 'cancelled')->count(),
            'tickets_sold' => $totalTicketsSold,
            'total_revenue' => Ticket::where('status', 'paid')->sum('total_price'),
            'total_users' => User::where('role', 'user')->count(),
            'total_banners' => Banner::where('is_active', true)->count(),
            'total_categories' => TicketCategory::count(),
            
            // Revenue stats
            'revenue_today' => Ticket::whereDate('paid_at', today())
                ->where('status', 'paid')
                ->sum('total_price'),
            'revenue_month' => Ticket::whereMonth('paid_at', now()->month)
                ->where('status', 'paid')
                ->sum('total_price'),
            'revenue_total' => Ticket::where('status', 'paid')->sum('total_price'),
            
            // Ticket status stats
            'paid_tickets' => Ticket::where('status', 'paid')->count(),
            'pending_tickets' => Ticket::where('status', 'pending')->count(),
            'expired_tickets' => Ticket::where('status', 'expired')->count(),
            'used_tickets' => Ticket::where('status', 'used')->count(),
        ];

        // Recent tickets - menggunakan relasi yang ada
        $recentTickets = Ticket::with(['user'])
            ->latest()
            ->take(10)
            ->get();
            
        // Tambahkan data event ke recentTickets secara manual
        foreach ($recentTickets as $ticket) {
            // Coba dapatkan event dari ticket_details jika ada
            if ($ticket->ticket_details) {
                $details = json_decode($ticket->ticket_details, true);
                $ticket->event_name = $details[0]['event_name'] ?? 'Event';
            } else {
                $ticket->event_name = 'Event Musik';
            }
        }

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
            'popularEvents',
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

    /**
     * Get monthly revenue data for charts
     */
    public function monthlyRevenue()
    {
        $monthlyData = Ticket::select(
            DB::raw('YEAR(paid_at) as year'),
            DB::raw('MONTH(paid_at) as month'),
            DB::raw('SUM(total_price) as total')
        )
            ->where('status', 'paid')
            ->where('paid_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        return response()->json($monthlyData);
    }

    /**
     * Get top selling events
     */
    public function topEvents()
    {
        $events = Event::with('ticketCategories')->get();
        $topEvents = [];
        
        foreach ($events as $event) {
            $soldCount = 0;
            foreach ($event->ticketCategories as $category) {
                $soldCount += ($category->quantity - $category->available);
            }
            
            $topEvents[] = [
                'id' => $event->id,
                'title' => $event->title,
                'poster' => $event->poster,
                'sold' => $soldCount,
                'revenue' => $soldCount * ($event->ticketCategories->avg('price') ?? 0)
            ];
        }
        
        // Urutkan berdasarkan sold descending
        usort($topEvents, function($a, $b) {
            return $b['sold'] <=> $a['sold'];
        });
        
        return response()->json(array_slice($topEvents, 0, 5));
    }
}