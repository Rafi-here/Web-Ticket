<?php

namespace App\Console\Commands;

use App\Models\Ticket;
use Illuminate\Console\Command;

class ExpireTickets extends Command
{
    protected $signature = 'tickets:expire';
    protected $description = 'Expire pending tickets that are overdue';

    public function handle()
    {
        $expiredTickets = Ticket::where('status', 'pending')
            ->where('expired_at', '<', now())
            ->get();

        $count = 0;
        foreach ($expiredTickets as $ticket) {
            $ticket->markAsExpired();
            $count++;
        }

        $this->info("{$count} tickets have been expired.");

        // Update available seats for showtimes
        foreach ($expiredTickets as $ticket) {
            $showtime = $ticket->showtime;
            $seats = is_array($ticket->seats) ? $ticket->seats : json_decode($ticket->seats, true);
            $showtime->available_seats += count($seats);
            $showtime->save();
        }
    }
}
