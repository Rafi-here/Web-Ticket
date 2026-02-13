<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'city',
        'address',
        'phone',
        'image',
        'facilities',
    ];

    protected $casts = [
        'facilities' => 'array',
    ];

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }
}
