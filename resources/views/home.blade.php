@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Banner Slider -->
    <div x-data="{
        currentSlide: 0,
        slides: @json($banners),
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length
        },
        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length
        }
    }">
        <div class="relative h-[500px] lg:h-[600px] overflow-hidden bg-gray-900">

            <!-- SLIDER MENGGUNAKAN ALPINE.JS -->
            <div x-data="bannerSlider()" x-init="init()" class="relative h-full">
                <!-- Slides Container -->
                <template x-if="slides.length > 0">
                    <div class="relative h-full">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="currentSlide === index" x-transition:enter="transition ease-out duration-700"
                                x-transition:enter-start="opacity-0 scale-105"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute inset-0">
                                <!-- Gambar dengan FIX PATH -->
                                <img :src="getImageUrl(slide.image)" :alt="slide.title || 'Banner'"
                                    class="w-full h-full object-cover" x-on:error.document="handleImageError($event, slide)">
                                <!-- Overlay Gradient -->
                                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent">
                                </div>
                                <!-- Text Content -->
                                <div class="absolute inset-0 flex items-center">
                                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                                        <div class="max-w-2xl text-white">
                                            <h2 x-text="slide.title || 'Selamat Datang'"
                                                class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4"></h2>
                                            <p x-text="slide.description || 'Temukan film favoritmu di sini'"
                                                class="text-lg md:text-xl text-gray-200 mb-8"></p>
                                            <a x-show="slide.button_text && slide.button_url" :href="slide.button_url"
                                                x-text="slide.button_text"
                                                class="inline-block px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-105 shadow-lg"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <!-- Navigation Buttons -->
                        <button @click="prevSlide"
                            class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/50 hover:bg-red-600 text-white rounded-full transition-all duration-300 z-20 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>

                        <button @click="nextSlide"
                            class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-black/50 hover:bg-red-600 text-white rounded-full transition-all duration-300 z-20 flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>

                        <!-- Indicators -->
                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
                            <template x-for="(slide, index) in slides" :key="'dot-' + index">
                                <button @click="currentSlide = index"
                                    class="w-3 h-3 rounded-full transition-all duration-300"
                                    :class="currentSlide === index ? 'bg-red-600 w-8' : 'bg-white/50 hover:bg-white'"></button>
                            </template>
                        </div>
                    </div>
                </template>

                <!-- Fallback jika banner kosong -->
                <template x-if="slides.length === 0">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-800 flex items-center justify-center">
                        <div class="text-center text-white">
                            <h2 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di TIX</h2>
                            <p class="text-lg text-gray-300">Tempat booking tiket bioskop online</p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Now Playing Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold">Now Playing</h2>
            <a href="#" class="text-blue-600 hover:text-blue-700 flex items-center">
                View All
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
            @foreach ($nowPlaying as $film)
                <div class="group relative">
                    <a href="{{ route('film.detail', $film->slug) }}" class="block">
                        <div class="relative overflow-hidden rounded-lg aspect-[2/3]">
                            <img src="{{ $film->poster ? Storage::url($film->poster) : 'https://via.placeholder.com/300x450' }}"
                                alt="{{ $film->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                            <!-- Rating Age Badge -->
                            <div class="absolute top-2 left-2 bg-black/70 text-white text-xs px-2 py-1 rounded">
                                {{ $film->rating_age ?? 'SU' }}
                            </div>

                            <!-- Hover Overlay -->
                            <div
                                class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                <a href="{{ route('film.detail', $film->slug) }}"
                                    class="bg-blue-600 text-white px-4 py-2 rounded-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                    Buy Ticket
                                </a>
                            </div>
                        </div>
                        <h3 class="mt-2 font-semibold text-sm md:text-base">{{ $film->title }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $film->genre }}</p>
                    </a>

                    <!-- Wishlist Button -->
                    @auth
                        <button onclick="toggleWishlist({{ $film->id }})"
                            class="absolute top-2 right-2 bg-white dark:bg-gray-800 rounded-full p-1.5 shadow-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    @endauth
                </div>
            @endforeach
        </div>
    </section>

    <!-- Coming Soon Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gray-100 dark:bg-gray-800 rounded-2xl">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold">Coming Soon</h2>
            <a href="#" class="text-blue-600 hover:text-blue-700 flex items-center">
                View All
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="flex overflow-x-auto gap-4 pb-4 scrollbar-hide">
            @foreach ($comingSoon as $film)
                <div class="flex-none w-48 md:w-56 group">
                    <a href="{{ route('film.detail', $film->slug) }}" class="block">
                        <div class="relative overflow-hidden rounded-lg aspect-[2/3]">
                            <img src="{{ $film->poster ? Storage::url($film->poster) : 'https://via.placeholder.com/300x450' }}"
                                alt="{{ $film->title }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                            <!-- Release Date Badge -->
                            <div
                                class="absolute bottom-2 left-2 right-2 bg-black/70 text-white text-xs p-2 rounded text-center">
                                {{ $film->release_date ? $film->release_date->format('d M Y') : 'Coming Soon' }}
                            </div>
                        </div>
                        <h3 class="mt-2 font-semibold text-sm">{{ $film->title }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $film->genre }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Promo Section - DIHAPUS karena variable $promos tidak ada -->
    {{-- 
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl md:text-3xl font-bold mb-8">Special Promos</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach ($promos as $promo)
                <div class="relative rounded-2xl overflow-hidden group">
                    <img src="{{ $promo['image'] }}" alt="{{ $promo['title'] }}"
                        class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                        <div class="p-6 text-white">
                            <h3 class="text-xl font-bold mb-2">{{ $promo['title'] }}</h3>
                            <p class="text-sm opacity-90">{{ $promo['description'] }}</p>
                            <button
                                class="mt-3 bg-white text-gray-900 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-100 transition">
                                Get Promo
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    --}}

    <!-- Cinema List -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl md:text-3xl font-bold mb-8">Our Cinemas</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @foreach ($cinemas as $cinema)
                <div class="text-center group">
                    <div
                        class="bg-gray-100 dark:bg-gray-800 rounded-lg p-4 hover:bg-blue-50 dark:hover:bg-gray-700 transition cursor-pointer">
                        <div
                            class="w-16 h-16 mx-auto mb-3 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="font-semibold text-sm">{{ $cinema->name }}</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $cinema->city }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Data banners dari PHP ke JavaScript
        const banners = @json($banners);

        function bannerSlider() {
            return {
                slides: banners,
                currentSlide: 0,
                interval: null,

                init() {
                    if (this.slides.length > 1) {
                        this.startAutoPlay();
                    }
                },

                startAutoPlay() {
                    this.interval = setInterval(() => {
                        this.nextSlide();
                    }, 5000);
                },

                stopAutoPlay() {
                    clearInterval(this.interval);
                },

                nextSlide() {
                    this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                },

                prevSlide() {
                    this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length;
                },

                getImageUrl(path) {
                    if (!path) return '{{ asset('images/default-banner.jpg') }}';
                    path = path.replace(/^public\//, '');
                    if (path.startsWith('storage/')) {
                        return '{{ asset('') }}' + path;
                    }
                    return '{{ asset('storage/') }}' + '/' + path;
                },

                handleImageError(event, slide) {
                    event.target.src = '{{ asset('images/default-banner.jpg') }}';
                }
            }
        }

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
                        alert(data.message);
                    }
                });
        }
    </script>
@endpush