<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $stats = [
            'total_tickets' => Ticket::where('user_id', $user->id)->count(),
            'active_tickets' => Ticket::where('user_id', $user->id)
                ->where('status', 'paid')
                ->where('expired_at', '>', now())
                ->count(),
            'pending_payments' => Ticket::where('user_id', $user->id)
                ->where('status', 'pending')
                ->count(),
            'total_spent' => Ticket::where('user_id', $user->id)
                ->where('status', 'paid')
                ->sum('total_price'),
        ];

        $recentTickets = Ticket::with(['showtime.film', 'showtime.cinema'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact('stats', 'recentTickets'));
    }

    public function tickets(Request $request)
    {
        $query = Ticket::with(['showtime.film', 'showtime.cinema', 'payment'])
            ->where('user_id', auth()->id());

        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $tickets = $query->latest()->paginate(10);

        return view('user.tickets', compact('tickets'));
    }

    public function showTicket($code)
    {
        $ticket = Ticket::with(['showtime.film', 'showtime.cinema', 'payment'])
            ->where('ticket_code', $code)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('user.ticket-detail', compact('ticket'));
    }

    public function profile()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = auth()->user();
        $data = $request->only(['name', 'phone']);

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $data['avatar'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Profile updated successfully');
    }
}
