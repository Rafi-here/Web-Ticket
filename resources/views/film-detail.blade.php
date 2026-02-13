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
                    <span>{{ $film->duration }} minutes</span>
                    @if ($film->release_date)
                        <span>•</span>
                        <span>Release:
                            @if (is_object($film->release_date) && method_exists($film->release_date, 'format'))
                                {{ $film->release_date->format('d M Y') }}
                            @else
                                {{ \Carbon\Carbon::parse($film->release_date)->format('d M Y') }}
                            @endif
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
                    <h2 class="text-xl font-semibold mb-4">Synopsis</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $film->synopsis }}</p>
                </div>

                <!-- Cast & Crew -->
                @if ($film->director || $film->cast)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Cast & Crew</h2>
                        <div class="grid grid-cols-2 gap-4">
                            @if ($film->director)
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Director</p>
                                    <p class="font-medium">{{ $film->director }}</p>
                                </div>
                            @endif
                            @if ($film->cast)
                                <div class="col-span-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Cast</p>
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
                    <h2 class="text-xl font-semibold mb-4">Showtimes</h2>

                    @if ($film->showtimes->where('show_date', '>=', now())->count() > 0)
                        @foreach ($film->showtimes->where('show_date', '>=', now())->groupBy('show_date') as $date => $showtimes)
                            <div class="mb-4">
                                <h3 class="font-medium mb-2">{{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}</h3>
                                <div class="space-y-2">
                                    @foreach ($showtimes as $showtime)
                                        <div
                                            class="border border-gray-200 dark:border-gray-700 rounded-lg p-3 hover:border-blue-500 transition">
                                            <div class="flex justify-between items-center">
                                                <div>
                                                    <p class="font-medium">
                                                        {{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }}
                                                    </p>
                                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ $showtime->cinema->name }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-sm font-semibold text-blue-600">Rp
                                                        {{ number_format($showtime->price) }}</p>
                                                    @auth
                                                        @if ($showtime->available_seats > 0)
                                                            <a href="{{ route('payment.show', $showtime) }}"
                                                                class="mt-2 inline-block px-4 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                                                                Buy Ticket
                                                            </a>
                                                        @else
                                                            <span
                                                                class="mt-2 inline-block px-4 py-1 bg-gray-400 text-white text-sm rounded-lg cursor-not-allowed">
                                                                Sold Out
                                                            </span>
                                                        @endif
                                                    @else
                                                        <a href="{{ route('login') }}"
                                                            class="mt-2 inline-block px-4 py-1 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition">
                                                            Login to Buy
                                                        </a>
                                                    @endauth
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500 dark:text-gray-400 text-center py-4">No showtimes available</p>
                    @endif

                    <!-- Wishlist Button -->
                    @auth
                        <button onclick="toggleWishlist({{ $film->id }})"
                            class="mt-4 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2 text-red-500"
                                fill="{{ auth()->user()->wishlists->contains('film_id', $film->id) ? 'currentColor' : 'none' }}"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                </path>
                            </svg>
                            {{ auth()->user()->wishlists->contains('film_id', $film->id) ? 'Remove from Wishlist' : 'Add to Wishlist' }}
                        </button>
                    @endauth
                </div>
            </div>
        </div>

        <!-- Related Films -->
        @if (isset($relatedFilms) && $relatedFilms->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">You Might Also Like</h2>
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
        </script>
    @endpush
@endsection
