<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'payment_code',
        'method',
        'provider',
        'amount',
        'status',
        'payment_details',
        'payment_proof',
        'paid_at',
        'expired_at',
    ];

    protected $casts = [
        'payment_details' => 'array',
        'payment_proof' => 'array',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $payment->payment_code = 'PAY-' . strtoupper(Str::random(12));
            $payment->expired_at = now()->addHours(12);
        });
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->hasOneThrough(User::class, Ticket::class, 'id', 'id', 'ticket_id', 'user_id');
    }

    public function markAsSuccess($proof = null)
    {
        $this->update([
            'status' => 'success',
            'paid_at' => now(),
            'payment_proof' => $proof,
        ]);

        $this->ticket->markAsPaid();
    }

    public function markAsFailed()
    {
        $this->update(['status' => 'failed']);
    }

    public function markAsExpired()
    {
        $this->update(['status' => 'expired']);
        $this->ticket->markAsExpired();
    }

    public function isExpired()
    {
        return $this->expired_at->isPast() && $this->status === 'pending';
    }

    public function getPaymentInstructionsAttribute()
    {
        $instructions = [
            'ewallet' => [
                'title' => 'Pembayaran E-Wallet',
                'steps' => [
                    'Buka aplikasi ' . ($this->provider ?? 'E-Wallet'),
                    'Pilih menu Scan QR',
                    'Scan kode QR yang ditampilkan',
                    'Konfirmasi pembayaran',
                ]
            ],
            'virtual_account' => [
                'title' => 'Pembayaran Virtual Account',
                'steps' => [
                    'Buka aplikasi bank ' . ($this->provider ?? 'Anda'),
                    'Pilih menu Virtual Account',
                    'Masukkan nomor VA: ' . ($this->payment_details['va_number'] ?? '1234567890'),
                    'Konfirmasi pembayaran',
                ]
            ],
            'qris' => [
                'title' => 'Pembayaran QRIS',
                'steps' => [
                    'Buka aplikasi pembayaran',
                    'Pilih menu Scan QRIS',
                    'Scan kode QR yang ditampilkan',
                    'Konfirmasi pembayaran',
                ]
            ],
            'transfer_bank' => [
                'title' => 'Transfer Bank',
                'steps' => [
                    'Buka aplikasi bank ' . ($this->provider ?? 'Anda'),
                    'Transfer ke rekening:',
                    'Bank: ' . ($this->payment_details['bank'] ?? 'BCA'),
                    'No Rekening: ' . ($this->payment_details['account_number'] ?? '1234567890'),
                    'Atas Nama: ' . ($this->payment_details['account_name'] ?? 'PT TIX Bioskop'),
                    'Jumlah: Rp ' . number_format($this->amount),
                ]
            ],
        ];

        return $instructions[$this->method] ?? [];
    }
}
