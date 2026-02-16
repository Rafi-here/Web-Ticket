@extends('layouts.app')

@section('title', 'Tiket Saya')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800 pt-24 pb-16">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('home') }}"
                    class="inline-flex items-center w-10 h-10 bg-white dark:bg-gray-800 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105 border border-gray-200 dark:border-gray-700 group">
                    <svg class="w-5 h-5 mx-auto text-gray-600 dark:text-gray-400 group-hover:text-red-600 dark:group-hover:text-red-500 transition-colors"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </a>
            </div>

            <!-- Header -->
            <div class="text-center mb-12 animate-fade-in-up">
                <div class="relative inline-block">
                    <div
                        class="w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-blue-500/30">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <div
                        class="absolute -top-2 -right-2 w-6 h-6 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold animate-pulse">
                        {{ $tickets->count() }}
                    </div>
                </div>

                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Tiket Saya</h1>
                <p class="text-gray-600 dark:text-gray-400">Semua tiket yang pernah kamu beli</p>
            </div>

            @if ($tickets->count() > 0)
                <!-- Tickets List -->
                <div class="space-y-4 max-w-4xl mx-auto">
                    @foreach ($tickets as $ticket)
                        <div class="group bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1 border border-gray-200 dark:border-gray-700 overflow-hidden animate-fade-in-up"
                            style="animation-delay: {{ $loop->index * 0.1 }}s">

                            <div class="flex flex-col md:flex-row">
                                <!-- Poster -->
                                <div class="md:w-1/4 lg:w-1/5">
                                    <div class="relative aspect-[2/3] md:aspect-auto md:h-full">
                                        <img src="{{ $ticket->showtime->film->poster ? Storage::url($ticket->showtime->film->poster) : 'https://via.placeholder.com/300x450/1f2937/ffffff?text=' . urlencode($ticket->showtime->film->title) }}"
                                            alt="{{ $ticket->showtime->film->title }}" class="w-full h-full object-cover">
                                    </div>
                                </div>

                                <!-- Details -->
                                <div class="flex-1 p-6">
                                    <div class="flex flex-wrap items-start justify-between gap-4 mb-4">
                                        <div>
                                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-1">
                                                {{ $ticket->showtime->film->title }}
                                            </h3>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                                {{ $ticket->showtime->cinema->name }} •
                                                {{ $ticket->showtime->cinema->city }}
                                            </p>
                                        </div>

                                        <!-- Status Badge -->
                                        @php
                                            $statusClasses = [
                                                'pending' =>
                                                    'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-500 border-yellow-300',
                                                'paid' =>
                                                    'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-500 border-green-300',
                                                'expired' =>
                                                    'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-500 border-red-300',
                                                'used' =>
                                                    'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-400 border-gray-300',
                                            ];
                                            $statusText = [
                                                'pending' => 'Menunggu',
                                                'paid' => 'Lunas',
                                                'expired' => 'Kadaluarsa',
                                                'used' => 'Sudah Digunakan',
                                            ];
                                        @endphp

                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold border {{ $statusClasses[$ticket->status] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ $statusText[$ticket->status] ?? $ticket->status }}
                                        </span>
                                    </div>

                                    <!-- Details Grid -->
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mb-1">Tanggal</p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ \Carbon\Carbon::parse($ticket->showtime->date)->format('d M Y') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mb-1">Jam</p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $ticket->showtime->time }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mb-1">Kursi</p>
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $ticket->seats->pluck('seat_number')->join(', ') }}
                                            </p>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-500 dark:text-gray-500 mb-1">Kode Booking</p>
                                            <p class="text-sm font-mono font-semibold text-gray-900 dark:text-white">
                                                {{ $ticket->booking_code }}
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex flex-wrap gap-3">
                                        <a href="{{ route('user.ticket.show', $ticket->booking_code) }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:scale-105 text-sm font-medium">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                            Lihat Tiket
                                        </a>

                                        @if ($ticket->status === 'paid')
                                            <a href="{{ route('ticket.show', $ticket->booking_code) }}" target="_blank"
                                                class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-all duration-300 transform hover:scale-105 text-sm font-medium">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                                                </svg>
                                                QR Code
                                            </a>

                                            <a href="{{ route('ticket.download', $ticket->booking_code) }}"
                                                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-300 transform hover:scale-105 text-sm font-medium">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M12 4v12m0 0l-3-3m3 3l3-3" />
                                                </svg>
                                                Download
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($tickets->hasPages())
                    <div class="mt-8">
                        {{ $tickets->links() }}
                    </div>
                @endif
            @else
                <!-- Empty State -->
                <div
                    class="text-center py-16 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-3xl border border-gray-200 dark:border-gray-700 max-w-2xl mx-auto">
                    <div
                        class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Belum Ada Tiket</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                        Kamu belum memiliki tiket. Yuk, booking film favoritmu sekarang!
                    </p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-xl hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Cari Film
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('styles')
        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.5s ease-out forwards;
            }
        </style>
    @endpush
@endsection
