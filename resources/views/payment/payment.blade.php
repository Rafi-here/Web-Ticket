@extends('layouts.app')

@section('title', 'Pembayaran')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-center space-x-4">
                <div class="flex items-center text-green-600">
                    <span class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">✓</span>
                    <span class="ml-2 font-medium">Pilih Kursi</span>
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

        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Detail Pembayaran</h1>
            </div>

            <!-- Payment Details -->
            <div class="p-6">
                <!-- Order Info -->
                <div class="mb-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <h3 class="font-semibold text-blue-800 dark:text-blue-300 mb-3">Informasi Pesanan</h3>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">Kode Booking</p>
                            <p class="font-mono font-bold text-gray-900 dark:text-white">{{ $ticket->booking_code }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">Total Pembayaran</p>
                            <p class="font-bold text-green-600 dark:text-green-400">Rp {{ number_format($ticket->total_price, 0, ',', '.') }}</p>
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
                                @endswitch
                            </p>
                        </div>
                        <div>
                            <p class="text-gray-600 dark:text-gray-400">Batas Pembayaran</p>
                            <p class="font-medium text-gray-900 dark:text-white">{{ $ticket->expired_at->format('d M Y H:i') }} WIB</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Instructions -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Instruksi Pembayaran</h3>
                    
                    @if($ticket->payment_method == 'qris')
                        <div class="text-center p-6 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <div class="mb-4">
                                <img src="{{ $ticket->payment->payment_details['qr_code'] ?? 'https://via.placeholder.com/200x200?text=QRIS' }}" 
                                     alt="QRIS Code" 
                                     class="mx-auto w-48 h-48">
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Scan QR code di atas dengan aplikasi pembayaran yang mendukung QRIS</p>
                            <p class="text-xs text-gray-500">GoPay, OVO, DANA, ShopeePay, LinkAja, dll.</p>
                        </div>
                    @elseif($ticket->payment_method == 'virtual_account')
                        <div class="space-y-3">
                            @foreach($ticket->payment->payment_details as $key => $value)
                                <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                    <span class="text-gray-600 dark:text-gray-400">{{ ucfirst(str_replace('_', ' ', $key)) }}</span>
                                    <span class="font-mono font-bold text-gray-900 dark:text-white">{{ $value }}</span>
                                </div>
                            @endforeach
                            <p class="text-sm text-gray-500 mt-2">Transfer ke nomor virtual account di atas melalui ATM/mobile banking</p>
                        </div>
                    @elseif($ticket->payment_method == 'ewallet')
                        <div class="text-center p-6 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <div class="mb-4">
                                <img src="{{ $ticket->payment->payment_details['qr_code'] ?? 'https://via.placeholder.com/200x200?text=' . strtoupper($ticket->provider) }}" 
                                     alt="E-Wallet QR Code" 
                                     class="mx-auto w-48 h-48">
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Scan QR code dengan aplikasi {{ strtoupper($ticket->provider) }}</p>
                        </div>
                    @elseif($ticket->payment_method == 'transfer_bank')
                        <div class="space-y-3">
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <span class="text-gray-600 dark:text-gray-400">Bank</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ strtoupper($ticket->provider) }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <span class="text-gray-600 dark:text-gray-400">Nomor Rekening</span>
                                <span class="font-mono font-bold text-gray-900 dark:text-white">{{ $ticket->payment->payment_details['account_number'] ?? '1234567890' }}</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                <span class="text-gray-600 dark:text-gray-400">Atas Nama</span>
                                <span class="font-bold text-gray-900 dark:text-white">{{ $ticket->payment->payment_details['account_name'] ?? 'PT TIX Bioskop' }}</span>
                            </div>
                            <p class="text-sm text-gray-500 mt-2">Transfer sesuai nominal ke rekening di atas</p>
                        </div>
                    @endif
                </div>

                <!-- Simulation Button (Admin Only) -->
                @if(auth()->user()->role === 'admin')
                <div class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                    <form action="{{ route('payment.simulate', $ticket) }}" method="POST" class="flex items-center justify-between">
                        @csrf
                        <span class="text-sm text-yellow-800 dark:text-yellow-300">Simulasi pembayaran (Admin only)</span>
                        <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                            Simulasi Bayar
                        </button>
                    </form>
                </div>
                @endif

                <!-- Check Payment Button (Untuk user cek status) -->
                <div class="flex justify-center">
                    <button onclick="checkPaymentStatus()" 
                            class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 transition flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
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
        fetch('/api/ticket/{{ $ticket->booking_code }}/status')
            .then(response => response.json())
            .then(data => {
                if (data.status === 'paid') {
                    window.location.href = '{{ route("ticket.show", $ticket->booking_code) }}';
                } else {
                    alert('Pembayaran belum diterima. Silakan cek kembali nanti.');
                }
            });
    }
</script>
@endpush
@endsection