<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Film extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'poster',
        'genre',
        'duration',
        'rating_age',
        'synopsis',
        'status',
        'category_id',
        'trailer_url',
        'director',
        'cast',
        'release_date',
    ];

    protected $casts = [
        'release_date' => 'date', // TAMBAHKAN INI
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($film) {
            $film->slug = Str::slug($film->title);
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function showtimes()
    {
        return $this->hasMany(Showtime::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
}
