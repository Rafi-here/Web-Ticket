<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    /**
     * Menampilkan daftar tiket user
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())
            ->with(['showtime.film', 'showtime.cinema'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.tickets.index', compact('tickets'));
    }

    /**
     * Menampilkan detail tiket
     */
    public function show($code)
    {
        $ticket = Ticket::with(['showtime.film', 'showtime.cinema', 'user'])
            ->where('code', $code)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.tickets.show', compact('ticket'));
    }
}
