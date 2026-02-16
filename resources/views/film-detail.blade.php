@extends('layouts.app')

@section('title', $film->title)

@section('content')
    <!-- Hero Section -->
    <div class="relative h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ $film->poster ? Storage::url($film->poster) : 'https://via.placeholder.com/1200x500' }}"
            alt="{{ $film->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>

        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12 text-white">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $film->title }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm md:text-base">
                    <span class="px-3 py-1 bg-blue-600 rounded-full">{{ $film->rating_age ?? 'SU' }}</span>
                    <span>{{ $film->genre }}</span>
                    <span>•</span>
                    <span>{{ $film->duration }} menit</span>
                    @if ($film->release_date)
                        <span>•</span>
                        <span>Rilis:
                            {{ \Carbon\Carbon::parse($film->release_date)->format('d M Y') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Synopsis -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Sinopsis</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $film->synopsis }}</p>
                </div>

                <!-- Cast & Crew -->
                @if ($film->director || $film->cast)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Pemeran & Kru</h2>
                        <div class="grid grid-cols-2 gap-4">
                            @if ($film->director)
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Sutradara</p>
                                    <p class="font-medium">{{ $film->director }}</p>
                                </div>
                            @endif
                            @if ($film->cast)
                                <div class="col-span-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Pemeran</p>
                                    <p class="font-medium">{{ $film->cast }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Trailer -->
                @if ($film->trailer_url)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-4">Trailer</h2>
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe src="{{ str_replace('watch?v=', 'embed/', $film->trailer_url) }}" frameborder="0"
                                allowfullscreen class="w-full h-64 rounded-lg"></iframe>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Showtimes -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 sticky top-24">
                    <h2 class="text-xl font-semibold mb-4">Pilih Jadwal Tayang</h2>

                    @php
                        // 🔥 FIX: Filter showtimes yang valid (tanggal >= hari ini)
                        $today = \Carbon\Carbon::today();
                        $validShowtimes = $film->showtimes->filter(function ($showtime) use ($today) {
                            return \Carbon\Carbon::parse($showtime->show_date)->greaterThanOrEqualTo($today);
                        });
                    @endphp

                    @if ($validShowtimes->count() > 0)
                        @foreach ($validShowtimes->groupBy('show_date') as $date => $showtimes)
                            <div class="mb-6">
                                <h3 class="font-medium mb-3 text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
                                </h3>
                                <div class="space-y-4">
                                    @foreach ($showtimes as $showtime)
                                        <div
                                            class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-blue-500 transition bg-white dark:bg-gray-800">
                                            <!-- Info Showtime -->
                                            <div class="flex justify-between items-start mb-3">
                                                <div>
                                                    <p class="font-semibold text-lg">
                                                        {{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }}
                                                        WIB
                                                    </p>
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        {{ $showtime->cinema->name }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                        Sisa kursi:
                                                        <span
                                                            class="font-semibold {{ $showtime->available_seats < 20 ? 'text-red-500' : 'text-green-500' }}">
                                                            {{ $showtime->available_seats }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                                        Rp {{ number_format($showtime->price, 0, ',', '.') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <!-- Pilihan Jumlah Tiket -->
                                            <!-- Pilihan Jumlah Tiket -->
                                            @auth
                                                @if ($showtime->available_seats > 0)
                                                    <form action="{{ route('payment.show', $showtime) }}" method="GET"
                                                        class="flex items-center gap-3">
                                                        <div
                                                            class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                                            <button type="button" onclick="decrementQty(this)"
                                                                class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition text-gray-700 dark:text-gray-300 font-bold">
                                                                -
                                                            </button>
                                                            <input type="number" name="qty" value="1" min="1"
                                                                max="{{ $showtime->available_seats }}"
                                                                class="w-16 text-center border-x border-gray-300 dark:border-gray-600 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none"
                                                                id="qty-{{ $showtime->id }}" readonly>
                                                            <button type="button"
                                                                onclick="incrementQty(this, {{ $showtime->available_seats }})"
                                                                class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition text-gray-700 dark:text-gray-300 font-bold">
                                                                +
                                                            </button>
                                                        </div>

                                                        <button type="submit"
                                                            class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:scale-105 shadow-lg">
                                                            <span class="flex items-center justify-center">
                                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                                                </svg>
                                                                Beli Tiket
                                                            </span>
                                                        </button>
                                                    </form>
                                                @else
                                                    <div
                                                        class="text-center py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-400 font-semibold">
                                                        Sold Out
                                                    </div>
                                                @endif
                                            @else
                                                <a href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}"
                                                    class="block text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                                    Login untuk Membeli
                                                </a>
                                            @endauth
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Belum ada jadwal tayang</p>
                            <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Silakan cek kembali nanti</p>
                        </div>
                    @endif

                    <!-- Wishlist Button -->
                    @auth
                        <button onclick="toggleWishlist({{ $film->id }})"
                            class="mt-6 w-full px-4 py-3 border-2 border-red-500 dark:border-red-600 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 transition-all duration-300 flex items-center justify-center group">
                            <svg class="w-5 h-5 mr-2 text-red-500 group-hover:scale-110 transition-transform"
                                fill="{{ auth()->user()->wishlists->contains('film_id', $film->id) ? 'currentColor' : 'none' }}"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                            <span
                                class="font-medium text-gray-700 dark:text-gray-300 group-hover:text-red-600 dark:group-hover:text-red-500">
                                {{ auth()->user()->wishlists->contains('film_id', $film->id) ? 'Hapus dari Wishlist' : 'Tambah ke Wishlist' }}
                            </span>
                        </button>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Related Films -->
        @if (isset($relatedFilms) && $relatedFilms->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">Film Lainnya</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($relatedFilms as $related)
                        <a href="{{ route('film.detail', $related->slug) }}" class="group">
                            <div class="relative overflow-hidden rounded-lg aspect-[2/3]">
                                <img src="{{ $related->poster ? Storage::url($related->poster) : 'https://via.placeholder.com/300x450' }}"
                                    alt="{{ $related->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            </div>
                            <h3 class="mt-2 font-semibold text-sm">{{ $related->title }}</h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $related->genre }}</p>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        function toggleWishlist(filmId) {
            fetch(`/wishlist/add/${filmId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
        }

        function decrementQty(button) {
            const input = button.parentElement.querySelector('input[type="number"]');
            let value = parseInt(input.value);
            if (value > 1) {
                input.value = value - 1;
            }
        }

        function incrementQty(button, max) {
            const input = button.parentElement.querySelector('input[type="number"]');
            let value = parseInt(input.value);
            if (value < max) {
                input.value = value + 1;
            }
        }
    </script>
@endpush

@push('styles')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endpush
