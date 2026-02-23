<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'poster',
        'category',
        'duration',
        'event_date',
        'event_time',
        'venue',
        'city',
        'address',
        'description',
        'status',
        'artists',
        'age_rating',
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime',
        'artists' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($event) {
            $event->slug = Str::slug($event->title);
        });
    }

    public function ticketCategories()
    {
        return $this->hasMany(TicketCategory::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function getFormattedDateAttribute()
    {
        return $this->event_date->format('l, d F Y');
    }

    public function getFormattedTimeAttribute()
    {
        return $this->event_time->format('H:i');
    }

    public function isUpcoming()
    {
        return $this->status === 'upcoming';
    }

    public function isOngoing()
    {
        return $this->status === 'ongoing';
    }

    public function isEnded()
    {
        return $this->status === 'ended';
    }

    public function isCancelled()
    {
        return $this->status === 'cancelled';
    }
}