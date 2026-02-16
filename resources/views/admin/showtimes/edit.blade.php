@extends('layouts.admin')

@section('title', 'Edit Jadwal Tayang')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.showtimes.index') }}"
                        class="inline-flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 group">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500 transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Jadwal Tayang</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Perbarui informasi jadwal tayang</p>
                    </div>
                </div>
            </div>

            <!-- Status Warning -->
            @php
                $showDate = \Carbon\Carbon::parse($showtime->show_date . ' ' . $showtime->show_time);
                $isExpired = $showDate->isPast();
            @endphp

            @if ($isExpired)
                <div
                    class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-500 mr-3 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="text-sm text-yellow-700 dark:text-yellow-400">
                            Jadwal ini sudah lewat. Anda hanya dapat mengubah informasi tertentu.
                        </span>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('admin.showtimes.update', $showtime->id) }}" method="POST" class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Film (Readonly if expired) -->
                            <div>
                                <label for="film_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Film <span class="text-red-500">*</span>
                                </label>
                                <select name="film_id" id="film_id" required {{ $isExpired ? 'disabled' : '' }}
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('film_id') border-red-500 @enderror {{ $isExpired ? 'opacity-75 cursor-not-allowed' : '' }}">
                                    <option value="">-- Pilih Film --</option>
                                    @foreach ($films ?? [] as $film)
                                        <option value="{{ $film->id }}"
                                            {{ old('film_id', $showtime->film_id) == $film->id ? 'selected' : '' }}>
                                            {{ $film->title }} ({{ $film->duration }} min)
                                        </option>
                                    @endforeach
                                </select>
                                @if ($isExpired)
                                    <input type="hidden" name="film_id" value="{{ $showtime->film_id }}">
                                @endif
                                @error('film_id')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Cinema (Readonly if expired) -->
                            <div>
                                <label for="cinema_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Bioskop <span class="text-red-500">*</span>
                                </label>
                                <select name="cinema_id" id="cinema_id" required {{ $isExpired ? 'disabled' : '' }}
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('cinema_id') border-red-500 @enderror {{ $isExpired ? 'opacity-75 cursor-not-allowed' : '' }}">
                                    <option value="">-- Pilih Bioskop --</option>
                                    @foreach ($cinemas ?? [] as $cinema)
                                        <option value="{{ $cinema->id }}"
                                            {{ old('cinema_id', $showtime->cinema_id) == $cinema->id ? 'selected' : '' }}>
                                            {{ $cinema->name }} - {{ $cinema->city }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($isExpired)
                                    <input type="hidden" name="cinema_id" value="{{ $showtime->cinema_id }}">
                                @endif
                                @error('cinema_id')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Show Date (Readonly if expired) -->
                            <div>
                                <label for="show_date"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Tayang <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="show_date" id="show_date"
                                    value="{{ old('show_date', $showtime->show_date) }}" min="{{ date('Y-m-d') }}"
                                    {{ $isExpired ? 'disabled' : '' }} required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('show_date') border-red-500 @enderror {{ $isExpired ? 'opacity-75 cursor-not-allowed' : '' }}">
                                @if ($isExpired)
                                    <input type="hidden" name="show_date" value="{{ $showtime->show_date }}">
                                @endif
                                @error('show_date')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Show Time (Readonly if expired) -->
                            <div>
                                <label for="show_time"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jam Tayang <span class="text-red-500">*</span>
                                </label>
                                <input type="time" name="show_time" id="show_time"
                                    value="{{ old('show_time', $showtime->show_time) }}"
                                    {{ $isExpired ? 'disabled' : '' }} required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('show_time') border-red-500 @enderror {{ $isExpired ? 'opacity-75 cursor-not-allowed' : '' }}">
                                @if ($isExpired)
                                    <input type="hidden" name="show_time" value="{{ $showtime->show_time }}">
                                @endif
                                @error('show_time')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price (Bisa diubah meskipun expired) -->
                            <div>
                                <label for="price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Harga Tiket <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">Rp</span>
                                    <input type="number" name="price" id="price"
                                        value="{{ old('price', $showtime->price) }}" min="0" step="1000" required
                                        class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('price') border-red-500 @enderror">
                                </div>
                                @error('price')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Total Seats (Tidak bisa diubah jika sudah ada pemesanan) -->
                            <div>
                                <label for="total_seats"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Total Kursi <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="total_seats" id="total_seats"
                                    value="{{ old('total_seats', $showtime->total_seats) }}" min="1" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('total_seats') border-red-500 @enderror">
                                @error('total_seats')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Kursi tersedia: {{ $showtime->available_seats }} / {{ $showtime->total_seats }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Current Status -->
                    <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Status</p>
                            @php
                                $status = $showDate->isPast()
                                    ? 'expired'
                                    : ($showtime->available_seats == 0
                                        ? 'sold_out'
                                        : 'active');
                                $statusText = [
                                    'active' => 'Aktif',
                                    'sold_out' => 'Sold Out',
                                    'expired' => 'Expired',
                                ];
                                $statusColor = [
                                    'active' => 'text-green-600 dark:text-green-400',
                                    'sold_out' => 'text-red-600 dark:text-red-400',
                                    'expired' => 'text-gray-600 dark:text-gray-400',
                                ];
                            @endphp
                            <p class="text-sm font-semibold {{ $statusColor[$status] }}">{{ $statusText[$status] }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Dibuat</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $showtime->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Diupdate</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $showtime->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Kursi Terjual</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $showtime->total_seats - $showtime->available_seats }}</p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="mt-8 flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.showtimes.index') }}"
                            class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-yellow-600 to-orange-600 text-white font-semibold rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Update Jadwal
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
