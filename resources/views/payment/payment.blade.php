@extends('layouts.app')

@section('title', 'Menunggu Pembayaran')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-900 dark:to-gray-800 py-12">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center text-green-600">
                        <span
                            class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">✓</span>
                        <span class="ml-2 font-medium">Pilih Tiket</span>
                    </div>
                    <div class="w-16 h-1 bg-green-600"></div>
                    <div class="flex items-center text-blue-600">
                        <span
                            class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</span>
                        <span class="ml-2 font-medium">Pembayaran</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-300 dark:bg-gray-700"></div>
                    <div class="flex items-center text-gray-400">
                        <span
                            class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center font-bold">3</span>
                        <span class="ml-2 font-medium">Selesai</span>
                    </div>
                </div>
            </div>

            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">
                <!-- Header -->
                <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-5">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-white">Menunggu Pembayaran</h1>
                            <p class="text-yellow-100 text-sm">Selesaikan pembayaran sebelum waktu habis</p>
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <!-- Countdown Timer -->
                    @if ($ticket->status === 'pending' && !$ticket->isExpired())
                        <div class="mb-8 text-center" x-data="countdown({{ $remainingSeconds }})" x-init="startCountdown()">
                            <p class="text-gray-600 dark:text-gray-400 mb-3">Sisa Waktu Pembayaran</p>
                            <div class="flex justify-center space-x-4">
                                <div class="text-center bg-gray-100 dark:bg-gray-700 rounded-xl p-3 min-w-[70px]">
                                    <span class="text-3xl font-bold text-blue-600" x-text="hours"></span>
                                    <span class="block text-xs text-gray-500">Jam</span>
                                </div>
                                <div class="text-center bg-gray-100 dark:bg-gray-700 rounded-xl p-3 min-w-[70px]">
                                    <span class="text-3xl font-bold text-blue-600" x-text="minutes"></span>
                                    <span class="block text-xs text-gray-500">Menit</span>
                                </div>
                                <div class="text-center bg-gray-100 dark:bg-gray-700 rounded-xl p-3 min-w-[70px]">
                                    <span class="text-3xl font-bold text-blue-600" x-text="seconds"></span>
                                    <span class="block text-xs text-gray-500">Detik</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Order Info -->
                    <div
                        class="mb-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl border border-blue-200 dark:border-blue-800">
                        <h3 class="font-semibold text-blue-800 dark:text-blue-300 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Informasi Pesanan
                        </h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-600 dark:text-gray-400">Kode Booking</p>
                                <p class="font-mono font-bold text-gray-900 dark:text-white">
                                    {{ $ticket->booking_code ?? $ticket->ticket_code }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 dark:text-gray-400">Total Pembayaran</p>
                                <p class="font-bold text-green-600 dark:text-green-400">Rp
                                    {{ number_format($ticket->total_price, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 dark:text-gray-400">Event</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $ticket->event->title ?? 'Event' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600 dark:text-gray-400">Metode</p>
                                <p class="font-medium text-gray-900 dark:text-white">
                                    @switch($ticket->payment_method)
                                        @case('ewallet')
                                            E-Wallet ({{ strtoupper($ticket->provider) }})
                                        @break

                                        @case('virtual_account')
                                            Virtual Account ({{ strtoupper($ticket->provider) }})
                                        @break

                                        @case('qris')
                                            QRIS
                                        @break

                                        @case('transfer_bank')
                                            Transfer Bank ({{ strtoupper($ticket->provider) }})
                                        @break

                                        @default
                                            {{ $ticket->payment_method }}
                                    @endswitch
                                </p>
                            </div>
                            <div>
                                <p class="text-gray-600 dark:text-gray-400">Batas Pembayaran</p>
                                <p class="font-medium text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($ticket->expired_at)->format('d M Y H:i') }} WIB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Instruksi Pembayaran
                        </h3>

                        @if ($ticket->payment_method == 'qris')
                            <div class="text-center p-6 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <div class="mb-4">
                                    @if ($ticket->qr_code)
                                        <img src="{{ Storage::url($ticket->qr_code) }}" alt="QRIS Code"
                                            class="mx-auto w-48 h-48">
                                    @else
                                        <div
                                            class="w-48 h-48 mx-auto bg-gray-200 dark:bg-gray-700 rounded-xl flex items-center justify-center">
                                            <span class="text-gray-500">QR Code</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Scan QR code di atas dengan
                                    aplikasi pembayaran yang mendukung QRIS</p>
                                <p class="text-xs text-gray-500">GoPay, OVO, DANA, ShopeePay, LinkAja, dll.</p>
                            </div>
                        @elseif($ticket->payment_method == 'virtual_account')
                            <div class="space-y-3">
                                @if ($ticket->payment && $ticket->payment->payment_details)
                                    @foreach ($ticket->payment->payment_details as $key => $value)
                                        @if (!is_array($value) && !is_null($value))
                                            <div
                                                class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                                <span
                                                    class="text-gray-600 dark:text-gray-400">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                                <span
                                                    class="font-mono font-bold text-gray-900 dark:text-white">{{ $value }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                @else
                                    <div
                                        class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                        <span class="text-gray-600 dark:text-gray-400">Virtual Account</span>
                                        <span
                                            class="font-mono font-bold text-gray-900 dark:text-white">8800{{ rand(100000000, 999999999) }}</span>
                                    </div>
                                @endif
                                <p class="text-sm text-gray-500 mt-2">Transfer ke nomor virtual account di atas melalui
                                    ATM/mobile banking</p>
                            </div>
                        @elseif($ticket->payment_method == 'ewallet')
                            <div class="text-center p-6 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                <div class="mb-4">
                                    @if ($ticket->qr_code)
                                        <img src="{{ Storage::url($ticket->qr_code) }}" alt="E-Wallet QR Code"
                                            class="mx-auto w-48 h-48">
                                    @else
                                        <div
                                            class="w-48 h-48 mx-auto bg-gray-200 dark:bg-gray-700 rounded-xl flex items-center justify-center">
                                            <span class="text-gray-500">QR Code</span>
                                        </div>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Scan QR code dengan aplikasi
                                    {{ strtoupper($ticket->provider) }}</p>
                            </div>
                        @elseif($ticket->payment_method == 'transfer_bank')
                            <div class="space-y-3">
                                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                    <span class="text-gray-600 dark:text-gray-400">Bank</span>
                                    <span
                                        class="font-bold text-gray-900 dark:text-white">{{ strtoupper($ticket->provider) }}</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                    <span class="text-gray-600 dark:text-gray-400">Nomor Rekening</span>
                                    <span class="font-mono font-bold text-gray-900 dark:text-white">1234567890</span>
                                </div>
                                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900 rounded-xl">
                                    <span class="text-gray-600 dark:text-gray-400">Atas Nama</span>
                                    <span class="font-bold text-gray-900 dark:text-white">BPIX</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-2">Transfer sesuai nominal ke rekening di atas</p>
                            </div>
                        @endif
                    </div>

                    <!-- Detail Tiket yang Dipesan -->
                    <div
                        class="mb-8 p-4 bg-purple-50 dark:bg-purple-900/20 rounded-xl border border-purple-200 dark:border-purple-800">
                        <h3 class="font-semibold text-purple-800 dark:text-purple-300 mb-3 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z">
                                </path>
                            </svg>
                            Detail Tiket
                        </h3>
                        <div class="space-y-2">
                            @php
                                $ticketDetails = json_decode($ticket->ticket_details, true);
                            @endphp
                            @if ($ticketDetails)
                                @foreach ($ticketDetails as $detail)
                                    <div
                                        class="flex justify-between items-center p-2 bg-white/50 dark:bg-gray-800/50 rounded-lg">
                                        <div>
                                            <span class="font-medium">{{ $detail['category'] }}</span>
                                            <span class="text-sm text-gray-500 ml-2">{{ $detail['quantity'] }}
                                                tiket</span>
                                        </div>
                                        <span class="font-semibold text-blue-600">Rp
                                            {{ number_format($detail['subtotal'], 0, ',', '.') }}</span>
                                    </div>
                                @endforeach
                            @else
                                <div class="flex justify-between items-center p-2">
                                    <span>Total Tiket</span>
                                    <span class="font-semibold">{{ $ticket->quantity }} tiket</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Simulation Button (Admin Only) -->
                    @if (auth()->user()->role === 'admin' && $ticket->status === 'pending')
                        <div
                            class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl border border-yellow-200 dark:border-yellow-800">
                            <form action="{{ route('payment.simulate', $ticket->booking_code ?? $ticket->ticket_code) }}"
                                method="POST" class="flex items-center justify-between">
                                @csrf
                                <div class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span class="text-sm text-yellow-800 dark:text-yellow-300">Simulasi pembayaran (Admin
                                        only)</span>
                                </div>
                                <button type="submit"
                                    class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                                    Simulasi Bayar
                                </button>
                            </form>
                        </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                        <a href="{{ route('user.tickets') }}"
                            class="text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-300 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali ke Tiket Saya
                        </a>

                        <button onclick="checkPaymentStatus()"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-2 rounded-lg hover:from-blue-700 hover:to-purple-700 transition flex items-center gap-2 shadow-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            Cek Status Pembayaran
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function checkPaymentStatus() {
                const code = '{{ $ticket->booking_code ?? $ticket->ticket_code }}';
                fetch(`/api/ticket/${code}/status`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'paid') {
                            window.location.href =
                                '{{ route('ticket.show', $ticket->booking_code ?? $ticket->ticket_code) }}';
                        } else if (data.status === 'expired') {
                            alert('Waktu pembayaran telah habis. Silakan lakukan pemesanan ulang.');
                            window.location.href = '{{ route('home') }}';
                        } else {
                            alert('Pembayaran belum diterima. Silakan cek kembali nanti.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Gagal mengecek status. Silakan coba lagi.');
                    });
            }

            function countdown(initialSeconds) {
                return {
                    hours: '00',
                    minutes: '00',
                    seconds: '00',
                    totalSeconds: initialSeconds,
                    timer: null,

                    startCountdown() {
                        this.updateDisplay();

                        this.timer = setInterval(() => {
                            if (this.totalSeconds <= 0) {
                                clearInterval(this.timer);
                                window.location.reload();
                                return;
                            }

                            this.totalSeconds--;
                            this.updateDisplay();
                        }, 1000);
                    },

                    updateDisplay() {
                        const hrs = Math.floor(this.totalSeconds / 3600);
                        const mins = Math.floor((this.totalSeconds % 3600) / 60);
                        const secs = this.totalSeconds % 60;

                        this.hours = hrs.toString().padStart(2, '0');
                        this.minutes = mins.toString().padStart(2, '0');
                        this.seconds = secs.toString().padStart(2, '0');
                    }
                }
            }
        </script>
    @endpush
@endsection
