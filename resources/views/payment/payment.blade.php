@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center space-x-4">
                <div class="flex items-center text-green-600">
                    <span class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">✓</span>
                    <span class="ml-2 font-medium">Pilih Tiket</span>
                </div>
                <div class="w-16 h-1 bg-green-600"></div>
                <div class="flex items-center text-blue-600">
                    <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</span>
                    <span class="ml-2 font-medium">Pembayaran</span>
                </div>
                <div class="w-16 h-1 bg-gray-300 dark:bg-gray-700"></div>
                <div class="flex items-center text-gray-400">
                    <span class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center font-bold">3</span>
                    <span class="ml-2 font-medium">Selesai</span>
                </div>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-6 py-5">
                <h1 class="text-2xl font-bold text-white">Detail Pembayaran</h1>
                <p class="text-blue-100 text-sm mt-1">Silakan selesaikan pembayaran Anda</p>
            </div>

            <div class="p-6">
                <!-- Info Pesanan -->
                <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                    <h3 class="font-semibold text-blue-800 dark:text-blue-300 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Informasi Pesanan
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Kode Booking</p>
                            <p class="font-mono font-bold text-gray-900 dark:text-white">{{ $ticket->booking_code }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Pembayaran</p>
                            <p class="text-xl font-bold text-green-600">Rp {{ number_format($ticket->total_price, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Event</p>
                            <p class="font-medium">{{ $ticket->event->title }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Metode Pembayaran</p>
                            <p class="font-medium">
                                @switch($ticket->payment_method)
                                    @case('ewallet') E-Wallet ({{ strtoupper($ticket->provider) }}) @break
                                    @case('virtual_account') Virtual Account ({{ strtoupper($ticket->provider) }}) @break
                                    @case('qris') QRIS @break
                                    @case('transfer_bank') Transfer Bank ({{ strtoupper($ticket->provider) }}) @break
                                    @default {{ $ticket->payment_method }}
                                @endswitch
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Batas Pembayaran</p>
                            <p class="font-medium text-red-600">{{ \Carbon\Carbon::parse($ticket->expired_at)->format('d M Y H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Detail Tiket -->
                <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                        </svg>
                        Detail Tiket
                    </h3>
                    @php
                        $ticketDetails = json_decode($ticket->ticket_details, true);
                    @endphp
                    <div class="space-y-2">
                        @foreach($ticketDetails as $detail)
                            <div class="flex justify-between items-center py-2 border-b border-gray-200 dark:border-gray-600">
                                <div>
                                    <span class="font-medium">{{ $detail['category'] }}</span>
                                    <span class="text-sm text-gray-500 ml-2">{{ $detail['quantity'] }} tiket</span>
                                </div>
                                <span class="font-semibold text-blue-600">Rp {{ number_format($detail['subtotal'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                        <div class="flex justify-between items-center pt-2">
                            <span class="font-bold">Total</span>
                            <span class="text-xl font-bold text-green-600">Rp {{ number_format($ticket->total_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Form Pembayaran -->
                <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                    @csrf
                    <input type="hidden" name="booking_code" value="{{ $ticket->booking_code }}">

                    <!-- Informasi Pembayaran -->
                    <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-yellow-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-semibold text-yellow-800 dark:text-yellow-300">Simulasi Pembayaran</p>
                                <p class="text-sm text-yellow-700 dark:text-yellow-400">Klik tombol "Bayar Sekarang" untuk simulasi pembayaran (demo).</p>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol Bayar -->
                    <button type="submit" class="w-full py-3 px-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-[1.02] shadow-lg">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Bayar Sekarang
                        </span>
                    </button>
                </form>

                <!-- Link Kembali -->
                <div class="mt-4 text-center">
                    <a href="{{ route('events.show', $ticket->event->slug) }}" class="text-sm text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                        ← Kembali ke Detail Event
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection