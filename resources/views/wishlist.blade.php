@extends('guest.layouts.app')

@section('title', 'Wishlist Saya')

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
                        class="w-20 h-20 bg-gradient-to-r from-red-500 to-pink-600 rounded-full flex items-center justify-center mx-auto mb-6 shadow-2xl shadow-red-500/30">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div
                        class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 rounded-full flex items-center justify-center text-white text-xs font-bold animate-pulse">
                        {{ $films->count() }}
                    </div>
                </div>

                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Wishlist Saya</h1>
                <p class="text-gray-600 dark:text-gray-400">Film yang ingin kamu tonton</p>
            </div>

            <!-- Wishlist Grid -->
            @if ($films->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 md:gap-6">
                    @foreach ($films as $film)
                        <div class="group relative bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-200 dark:border-gray-700 animate-fade-in-up"
                            data-id="{{ $film->id }}" style="animation-delay: {{ $loop->index * 0.1 }}s">

                            <!-- Poster -->
                            <div class="relative aspect-[2/3] overflow-hidden">
                                <img src="{{ $film->poster ? Storage::url($film->poster) : 'https://via.placeholder.com/300x450/1f2937/ffffff?text=' . urlencode($film->title) }}"
                                    alt="{{ $film->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                                <!-- Gradient Overlay -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                </div>

                                <!-- Rating Age Badge -->
                                <div
                                    class="absolute top-3 left-3 bg-black/70 text-white text-xs px-2 py-1 rounded-full border border-white/30">
                                    {{ $film->rating_age ?? 'SU' }}
                                </div>

                                <!-- Hover Actions -->
                                <div
                                    class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 transform translate-y-4 group-hover:translate-y-0">
                                    <div class="flex gap-2">
                                        <a href="{{ route('film.detail', $film->slug) }}"
                                            class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-all duration-300 transform hover:scale-110">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <button onclick="removeFromWishlist({{ $film->id }}, this)"
                                            class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-all duration-300 transform hover:scale-110">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Info -->
                            <div class="p-4">
                                <h3
                                    class="font-bold text-gray-900 dark:text-white mb-1 line-clamp-1 group-hover:text-red-600 dark:group-hover:text-red-500 transition-colors">
                                    {{ $film->title }}
                                </h3>
                                <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-1">{{ $film->genre }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div
                    class="text-center py-16 bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm rounded-3xl border border-gray-200 dark:border-gray-700 max-w-2xl mx-auto">
                    <div
                        class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 rounded-full flex items-center justify-center">
                        <svg class="w-16 h-16 text-gray-400 dark:text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">Wishlist Masih Kosong</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-8 max-w-md mx-auto">
                        Belum ada film yang kamu tandai. Yuk, cari film favoritmu sekarang!
                    </p>
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-red-600 to-pink-600 text-white font-semibold rounded-xl hover:from-red-700 hover:to-pink-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Jelajahi Film
                    </a>
                </div>
            @endif
        </div>
    </div>

    @push('scripts')
        <script>
            function removeFromWishlist(filmId, button) {
                const card = button.closest('.group');

                // Fetch request
                fetch(`/wishlist/remove/${filmId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Animasi fade out
                            card.style.opacity = '0';
                            card.style.transform = 'scale(0.8)';

                            setTimeout(() => {
                                card.remove();

                                // Update counter
                                const counter = document.querySelector('.absolute.-top-2.-right-2');
                                if (counter) {
                                    const count = parseInt(counter.textContent) - 1;
                                    counter.textContent = count;

                                    // Jika kosong, reload page
                                    if (count === 0) {
                                        window.location.reload();
                                    }
                                }
                            }, 300);
                        }
                    });
            }
        </script>
    @endpush

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

            .line-clamp-1 {
                display: -webkit-box;
                -webkit-line-clamp: 1;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    @endpush
@endsection
