@extends('layouts.admin')

@section('title', 'Detail Jadwal Tayang')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header dengan Back Button -->
            <div class="mb-6">
                <a href="{{ route('admin.events.index') }}" 
                   class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Detail Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-8">
                    <div class="flex justify-between items-start mb-6">
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Detail Jadwal Tayang</h1>
                        
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.events.edit', $showtime->id) }}" 
                               class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                                Edit
                            </a>
                            <form action="{{ route('admin.events.destroy', $showtime->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Hapus jadwal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Grid Informasi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Kolom Kiri -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Film</label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $showtime->film->title }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Bioskop</label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $showtime->cinema->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $showtime->cinema->city }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Tanggal Tayang</label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($showtime->show_date)->format('d F Y') }}
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Jam Tayang</label>
                                <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }} WIB
                                </p>
                            </div>
                        </div>

                        <!-- Kolom Kanan -->
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Harga Tiket</label>
                                <p class="text-lg font-semibold text-green-600 dark:text-green-400">
                                    Rp {{ number_format($showtime->price, 0, ',', '.') }}
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Ketersediaan Kursi</label>
                                <div class="flex items-center space-x-2">
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                        {{ $showtime->available_seats }}/{{ $showtime->total_seats }}
                                    </p>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $showtime->available_seats > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $showtime->available_seats > 0 ? 'Tersedia' : 'Habis' }}
                                    </span>
                                </div>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Status</label>
                                @php
                                    $showDateTime = \Carbon\Carbon::parse($showtime->show_date . ' ' . $showtime->show_time);
                                    $status = $showDateTime->isPast() ? 'expired' : ($showtime->available_seats == 0 ? 'sold_out' : 'active');
                                @endphp
                                <p class="text-lg font-semibold">
                                    @if($status == 'active')
                                        <span class="text-green-600">Aktif</span>
                                    @elseif($status == 'sold_out')
                                        <span class="text-red-600">Sold Out</span>
                                    @else
                                        <span class="text-gray-600">Expired</span>
                                    @endif
                                </p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Dibuat pada</label>
                                <p class="text-gray-900 dark:text-white">{{ $showtime->created_at->format('d M Y H:i') }}</p>
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">Diperbarui pada</label>
                                <p class="text-gray-900 dark:text-white">{{ $showtime->updated_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection