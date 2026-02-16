@extends('layouts.admin')

@section('title', 'Tambah Jadwal Tayang')

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
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tambah Jadwal Tayang</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Buat jadwal tayang film baru</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('admin.showtimes.store') }}" method="POST" class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Film -->
                            <div>
                                <label for="film_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Pilih Film <span class="text-red-500">*</span>
                                </label>
                                <select name="film_id" id="film_id" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('film_id') border-red-500 @enderror">
                                    <option value="">-- Pilih Film --</option>
                                    @foreach ($films ?? [] as $film)
                                        <option value="{{ $film->id }}"
                                            {{ old('film_id') == $film->id ? 'selected' : '' }}>
                                            {{ $film->title }} ({{ $film->duration }} min)
                                        </option>
                                    @endforeach
                                </select>
                                @error('film_id')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Cinema -->
                            <div>
                                <label for="cinema_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Pilih Bioskop <span class="text-red-500">*</span>
                                </label>
                                <select name="cinema_id" id="cinema_id" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('cinema_id') border-red-500 @enderror">
                                    <option value="">-- Pilih Bioskop --</option>
                                    @foreach ($cinemas ?? [] as $cinema)
                                        <option value="{{ $cinema->id }}"
                                            {{ old('cinema_id') == $cinema->id ? 'selected' : '' }}>
                                            {{ $cinema->name }} - {{ $cinema->city }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('cinema_id')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Show Date -->
                            <div>
                                <label for="show_date"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Tayang <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="show_date" id="show_date"
                                    value="{{ old('show_date', date('Y-m-d')) }}" min="{{ date('Y-m-d') }}" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('show_date') border-red-500 @enderror">
                                @error('show_date')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Show Time -->
                            <div>
                                <label for="show_time"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jam Tayang <span class="text-red-500">*</span>
                                </label>
                                <input type="time" name="show_time" id="show_time"
                                    value="{{ old('show_time', '19:00') }}" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('show_time') border-red-500 @enderror">
                                @error('show_time')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Harga Tiket <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span
                                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-500 dark:text-gray-400">Rp</span>
                                    <input type="number" name="price" id="price" value="{{ old('price', 50000) }}"
                                        min="0" step="1000" required
                                        class="w-full pl-12 pr-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('price') border-red-500 @enderror">
                                </div>
                                @error('price')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Total Seats -->
                            <div>
                                <label for="total_seats"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Total Kursi <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="total_seats" id="total_seats"
                                    value="{{ old('total_seats', 100) }}" min="1" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('total_seats') border-red-500 @enderror">
                                @error('total_seats')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Kursi yang tersedia untuk dijual
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div
                        class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300">Informasi</h4>
                                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                                    Kursi yang tersedia akan otomatis terisi sesuai total kursi. Jadwal yang sudah lewat
                                    tidak dapat diedit.
                                </p>
                            </div>
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
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Jadwal
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
