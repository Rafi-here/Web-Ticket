@extends('layouts.app')

@section('title', 'Daftar Event Musik')

@section('content')
    <!-- Header -->
    <section class="relative bg-cover bg-center text-white min-h-screen py-24"
        style="background-image: url('{{ asset('images/banner-event.png') }}');">

        <div class="absolute inset-0 bg-black/60"></div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">
                Daftar Event Musik
            </h1>
            <p class="text-xl max-w-3xl mx-auto opacity-90">
                Temukan event musik favoritmu dan dapatkan tiketnya sekarang juga!
            </p>
        </div>

    </section>

    <!-- Filter Section -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
            <form action="{{ route('events.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Search -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cari Event</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama event..."
                            class="w-full pl-10 pr-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <svg class="w-5 h-5 absolute left-3 top-2.5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Filter by Category -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori</label>
                    <select name="category"
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter by City -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kota</label>
                    <select name="city"
                        class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kota</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city }}" {{ request('city') == $city ? 'selected' : '' }}>
                                {{ $city }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Button -->
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                            </path>
                        </svg>
                        Filter
                    </button>
                    <a href="{{ route('events.index') }}"
                        class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!-- Events Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($events->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($events as $event)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition group">
                        <a href="{{ route('events.show', $event->slug) }}">
                            <div class="relative h-48 overflow-hidden">
                                <img src="{{ $event->poster ? Storage::url($event->poster) : 'https://via.placeholder.com/400x200?text=Event' }}"
                                    alt="{{ $event->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                                <!-- Category Badge -->
                                <div
                                    class="absolute top-2 right-2 bg-gradient-to-r from-red-600 to-red-700 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ $event->category }}
                                </div>

                                <!-- Date Badge -->
                                <div
                                    class="absolute top-2 left-2 bg-black/70 text-white px-3 py-1 rounded-full text-xs font-semibold">
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M') }}
                                </div>
                            </div>

                            <div class="p-4">
                                <h3 class="font-bold text-lg mb-2">{{ $event->title }}</h3>

                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    {{ $event->venue }}, {{ $event->city }}
                                </div>

                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('l, d F Y') }} •
                                    {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB
                                </div>

                                <!-- Artists -->
                                @if ($event->artists)
                                    <div class="flex flex-wrap gap-1 mb-3">
                                        @foreach (json_decode($event->artists) as $artist)
                                            <span
                                                class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded text-xs">
                                                {{ $artist }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <div
                                    class="flex justify-between items-center pt-3 border-t border-gray-200 dark:border-gray-700">
                                    <div>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">Mulai dari</span>
                                        <span class="text-xl font-bold text-blue-600 block">
                                            Rp
                                            {{ number_format($event->ticketCategories->min('price') ?? 0, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <span
                                        class="text-sm {{ $event->ticketCategories->sum('available') > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $event->ticketCategories->sum('available') > 0 ? $event->ticketCategories->sum('available') . ' tiket tersisa' : 'Sold Out' }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $events->appends(request()->query())->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-xl font-medium text-gray-900 dark:text-white mb-2">Tidak Ada Event</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-4">Belum ada event yang tersedia saat ini</p>
                <a href="{{ route('home') }}"
                    class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Kembali ke Home
                </a>
            </div>
        @endif
    </section>
@endsection
