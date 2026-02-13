<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    use HasFactory;

    protected $fillable = [
        'film_id',
        'cinema_id',
        'show_date',
        'show_time',
        'price',
        'available_seats',
        'seat_layout',
    ];

    protected $casts = [
        'show_date' => 'date',
        'show_time' => 'datetime',
        'seat_layout' => 'array',
    ];

    public function film()
    {
        return $this->belongsTo(Film::class);
    }

    public function cinema()
    {
        return $this->belongsTo(Cinema::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
