@extends('layouts.app')

@section('title', 'E-Ticket')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center text-green-600">
                        <span
                            class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">✓</span>
                        <span class="ml-2 font-medium">Pilih Kursi</span>
                    </div>
                    <div class="w-16 h-1 bg-green-600"></div>
                    <div class="flex items-center text-green-600">
                        <span
                            class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center font-bold">✓</span>
                        <span class="ml-2 font-medium">Pembayaran</span>
                    </div>
                    <div class="w-16 h-1 bg-green-600"></div>
                    <div class="flex items-center text-blue-600">
                        <span
                            class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">3</span>
                        <span class="ml-2 font-medium">Selesai</span>
                    </div>
                </div>
            </div>

            <!-- Success Message -->
            @if (session('success'))
                <div
                    class="mb-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-700 rounded-lg text-green-700 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <!-- E-Ticket Card -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl overflow-hidden border-2 border-blue-500 dark:border-blue-400">
                <!-- Ticket Header -->
                <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-800 text-white">
                    <div class="flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">E-TICKET</h1>
                            <p class="text-blue-100">Tunjukkan QR code ini saat masuk bioskop</p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm opacity-90">Booking Code</div>
                            <div class="text-2xl font-mono font-bold">{{ $ticket->booking_code }}</div>
                        </div>
                    </div>
                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <!-- QR Code -->
                        <div class="md:col-span-1">
                            <div class="bg-white p-4 rounded-lg shadow-inner">
                                @if ($ticket->qr_code && Storage::disk('public')->exists($ticket->qr_code))
                                    <img src="{{ Storage::url($ticket->qr_code) }}" alt="QR Code" class="w-full h-auto">
                                @else
                                    <div
                                        class="w-full aspect-square bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                        <span class="text-gray-500">QR Code</span>
                                    </div>
                                @endif
                            </div>
                            <p class="text-xs text-center text-gray-500 mt-2">Scan untuk validasi tiket</p>
                        </div>

                        <!-- Ticket Details -->
                        <div class="md:col-span-2">
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Film</p>
                                    <p class="font-bold text-gray-900 dark:text-white">{{ $ticket->showtime->film->title }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Bioskop</p>
                                    <p class="font-bold text-gray-900 dark:text-white">{{ $ticket->showtime->cinema->name }}
                                    </p>
                                    <p class="text-xs text-gray-500">{{ $ticket->showtime->cinema->city }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Tanggal</p>
                                    <p class="font-bold text-gray-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($ticket->showtime->show_date)->format('d F Y') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Jam</p>
                                    <p class="font-bold text-gray-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($ticket->showtime->show_time)->format('H:i') }} WIB
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Kursi</p>
                                    <p class="font-bold text-gray-900 dark:text-white">
                                        {{ implode(', ', $ticket->seats) }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Jumlah Tiket</p>
                                    <p class="font-bold text-gray-900 dark:text-white">{{ $ticket->quantity }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Status</p>
                                    @if ($ticket->status == 'paid')
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">LUNAS</span>
                                    @elseif($ticket->status == 'pending')
                                        <span
                                            class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">PENDING</span>
                                    @else
                                        <span
                                            class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs font-semibold">EXPIRED</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Total Price -->
                            <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-semibold text-gray-900 dark:text-white">Total
                                        Pembayaran</span>
                                    <span class="text-2xl font-bold text-green-600 dark:text-green-400">
                                        Rp {{ number_format($ticket->total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Download Button -->
                            <div class="mt-6 flex gap-4">
                                <a href="{{ route('ticket.download', $ticket->booking_code) }}"
                                    class="flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white font-semibold rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-300 transform hover:scale-105 shadow-lg flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0 0l-3-3m3 3l3-3" />
                                    </svg>
                                    Download Tiket (PNG)
                                </a>
                                <a href="{{ route('home') }}"
                                    class="flex-1 px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition flex items-center justify-center">
                                    Kembali ke Beranda
                                </a>
                            </div>

                            <!-- Info -->
                            <p class="text-xs text-gray-500 text-center mt-4">
                                *Tunjukkan e-ticket ini beserta QR code kepada petugas saat masuk bioskop
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Ticket Footer -->
                <div
                    class="p-4 bg-gray-100 dark:bg-gray-900 text-center text-sm text-gray-600 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700">
                    <i class="fas fa-ticket-alt mr-2"></i>
                    Terima kasih telah memesan tiket di BPIX.
                </div>
            </div>
        </div>
    </div>
@endsection
