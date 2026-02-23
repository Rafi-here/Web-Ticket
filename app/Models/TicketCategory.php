<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    use HasFactory;

    protected $table = 'ticket_categories';

    protected $fillable = [
        'event_id',
        'name',
        'description',
        'price',
        'quantity',
        'available',
        'max_per_order',
        'benefits',
    ];

    protected $casts = [
        'benefits' => 'array',
        'price' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            $category->available = $category->quantity;
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'category_id');
    }

    public function isAvailable()
    {
        return $this->available > 0;
    }

    public function decreaseAvailability($quantity)
    {
        $this->decrement('available', $quantity);
    }

    public function increaseAvailability($quantity)
    {
        $this->increment('available', $quantity);
    }

    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    public function getSoldCountAttribute()
    {
        return $this->quantity - $this->available;
    }

    public function getSoldPercentageAttribute()
    {
        if ($this->quantity == 0) return 0;
        return round(($this->sold_count / $this->quantity) * 100);
    }
}