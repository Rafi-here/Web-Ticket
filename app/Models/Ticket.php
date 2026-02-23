<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_code',
        'user_id',
        'showtime_id',
        'seats',
        'quantity',
        'total_price',
        'payment_method',
        'status',
        'qr_code',
        'expired_at',
        'paid_at',
        'used_at',
    ];

    protected $casts = [
        'seats' => 'array',
        'expired_at' => 'datetime',
        'paid_at' => 'datetime',
        'used_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($ticket) {
            $ticket->ticket_code = 'TIX-' . strtoupper(Str::random(10)) . '-' . now()->format('Ymd');
            $ticket->expired_at = now()->addHours(12);
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function showtime()
    {
        return $this->belongsTo(Showtime::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    //public function film()
    //{
    //    return $this->hasOneThrough(Film::class, Showtime::class, 'id', 'id', 'showtime_id', 'film_id');
    //}

    //public function cinema()
    //{
    //    return $this->hasOneThrough(Cinema::class, Showtime::class, 'id', 'id', 'showtime_id', 'cinema_id');
    //}

    public function getBookingCodeAttribute()
    {
        return $this->ticket_code;
    }

    public function isExpired()
    {
        return $this->expired_at->isPast() && $this->status === 'pending';
    }

    public function isPaid()
    {
        return $this->status === 'paid';
    }

    public function isUsed()
    {
        return $this->status === 'used';
    }

    public function canBeUsed()
    {
        return $this->status === 'paid' && !$this->expired_at->isPast();
    }

    public function markAsPaid()
    {
        $this->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);
    }

    public function markAsUsed()
    {
        $this->update([
            'status' => 'used',
            'used_at' => now(),
        ]);
    }

    public function markAsExpired()
    {
        $this->update(['status' => 'expired']);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeExpired($query)
    {
        return $query->where('status', 'expired');
    }

    public function scopeUserTickets($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
    public function getEventNameAttribute()
    {
        if ($this->ticket_details) {
            $details = json_decode($this->ticket_details, true);
            return $details[0]['event_name'] ?? 'Event';
        }
        return 'Event Musik';
    }
}
