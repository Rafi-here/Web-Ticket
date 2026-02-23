@extends('layouts.app')

@section('title', 'Home - Event Musik')

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
            <div x-data="bannerSlider()" x-init="init()" class="relative h-full">
                <template x-if="slides.length > 0">
                    <div class="relative h-full">
                        <template x-for="(slide, index) in slides" :key="index">
                            <div x-show="currentSlide === index" x-transition:enter="transition ease-out duration-700"
                                x-transition:enter-start="opacity-0 scale-105"
                                x-transition:enter-end="opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-300"
                                x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute inset-0">
                                <img :src="getImageUrl(slide.image)" :alt="slide.title || 'Banner'"
                                    class="w-full h-full object-cover" x-on:error.document="handleImageError($event, slide)">
                                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
                                <div class="absolute inset-0 flex items-center">
                                    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                                        <div class="max-w-2xl text-white">
                                            <h2 x-text="slide.title || 'Selamat Datang'"
                                                class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4"></h2>
                                            <p x-text="slide.description || 'Temukan event musik favoritmu di sini'"
                                                class="text-lg md:text-xl text-gray-200 mb-8"></p>
                                            <a x-show="slide.button_text && slide.button_url" :href="slide.button_url"
                                                x-text="slide.button_text"
                                                class="inline-block px-8 py-3 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-300 transform hover:scale-105 shadow-lg"></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

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

                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
                            <template x-for="(slide, index) in slides" :key="'dot-' + index">
                                <button @click="currentSlide = index"
                                    class="w-3 h-3 rounded-full transition-all duration-300"
                                    :class="currentSlide === index ? 'bg-red-600 w-8' : 'bg-white/50 hover:bg-white'"></button>
                            </template>
                        </div>
                    </div>
                </template>

                <template x-if="slides.length === 0">
                    <div class="absolute inset-0 bg-gradient-to-r from-gray-900 to-gray-800 flex items-center justify-center">
                        <div class="text-center text-white">
                            <h2 class="text-4xl md:text-5xl font-bold mb-4">Selamat Datang di TIX</h2>
                            <p class="text-lg text-gray-300">Tempat booking tiket event musik terbaik</p>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Category Filters -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('home') }}" class="px-4 py-2 bg-blue-600 text-white rounded-full text-sm font-medium hover:bg-blue-700 transition">
                Semua
            </a>
            @foreach($categories as $category)
                <a href="{{ route('events.index', ['category' => $category]) }}" 
                   class="px-4 py-2 bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-700 transition">
                    {{ $category }}
                </a>
            @endforeach
        </div>
    </section>

    <!-- Featured Events -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold">Event Pilihan</h2>
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:text-blue-700 flex items-center">
                Lihat Semua
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($featuredEvents as $event)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition group">
                    <a href="{{ route('events.show', $event->slug) }}">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $event->poster ? Storage::url($event->poster) : 'https://via.placeholder.com/400x200?text=Event' }}" 
                                 alt="{{ $event->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                            <div class="absolute top-2 right-2 bg-gradient-to-r from-red-600 to-red-700 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $event->category }}
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">{{ $event->title }}</h3>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ \Carbon\Carbon::parse($event->event_date)->format('l, d F Y') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $event->venue }}, {{ $event->city }}
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold text-blue-600">
                                    Rp {{ number_format($event->ticketCategories->min('price') ?? 0, 0, ',', '.') }}
                                </span>
                                <span class="text-sm text-green-600 font-semibold">
                                    {{ $event->ticketCategories->sum('available') }} tiket tersisa
                                </span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Upcoming Events -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-2xl">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-2xl md:text-3xl font-bold">Event Mendatang</h2>
            <a href="{{ route('events.index') }}" class="text-blue-600 hover:text-blue-700 flex items-center">
                Lihat Semua
                <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($upcomingEvents as $event)
                <a href="{{ route('events.show', $event->slug) }}" class="group">
                    <div class="relative rounded-lg overflow-hidden">
                        <img src="{{ $event->poster ? Storage::url($event->poster) : 'https://via.placeholder.com/300x200' }}" 
                             alt="{{ $event->title }}" 
                             class="w-full h-40 object-cover group-hover:scale-105 transition duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-3 text-white">
                            <h3 class="font-semibold">{{ $event->title }}</h3>
                            <p class="text-xs opacity-90">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</p>
                            <p class="text-xs opacity-75">{{ $event->venue }}</p>
                        </div>
                        <div class="absolute top-2 right-2 bg-blue-600 text-white px-2 py-1 rounded text-xs">
                            {{ $event->category }}
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Events This Month -->
    @if($thisMonthEvents->count() > 0)
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl md:text-3xl font-bold mb-8">Event Bulan Ini</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($thisMonthEvents as $event)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 flex items-center space-x-4 hover:shadow-lg transition">
                    <div class="flex-shrink-0 w-20 h-20">
                        <img src="{{ $event->poster ? Storage::url($event->poster) : 'https://via.placeholder.com/80x80' }}" 
                             alt="{{ $event->title }}" 
                             class="w-full h-full object-cover rounded-lg">
                    </div>
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $event->title }}</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</p>
                        <p class="text-xs text-gray-500">{{ $event->venue }}</p>
                    </div>
                    <div class="text-right">
                        <span class="text-sm font-bold text-blue-600">
                            Rp {{ number_format($event->ticketCategories->min('price') ?? 0, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif

    <!-- CTA Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-2xl p-8 md:p-12 text-white text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Siap untuk Pengalaman Musik Terbaik?</h2>
            <p class="text-lg mb-8 opacity-90">Dapatkan tiket event musik favoritmu sekarang juga!</p>
            <a href="{{ route('events.index') }}" 
               class="inline-block px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition transform hover:scale-105 shadow-lg">
                Jelajahi Event
            </a>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
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
    </script>
@endpush