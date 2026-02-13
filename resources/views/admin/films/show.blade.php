@extends('layouts.admin')

@section('title', $film->title)
@section('header', 'Film Details')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <!-- Hero Section -->
        <div class="relative h-64 bg-cover bg-center"
            style="background-image: url('{{ $film->poster ? Storage::url($film->poster) : 'https://via.placeholder.com/1200x400' }}')">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-8 text-white">
                <h1 class="text-3xl font-bold mb-2">{{ $film->title }}</h1>
                <div class="flex items-center space-x-4 text-sm">
                    <span>{{ $film->genre }}</span>
                    <span>•</span>
                    <span>{{ $film->duration }} minutes</span>
                    <span>•</span>
                    <span>{{ $film->rating_age ?? 'SU' }}</span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <!-- Action Buttons -->
            <div class="flex justify-end space-x-3 mb-6">
                <a href="{{ route('admin.films.edit', $film) }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                        </path>
                    </svg>
                    Edit Film
                </a>
                <a href="{{ route('admin.films.index') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Back to List</a>
            </div>

            <!-- Film Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Main Info -->
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Synopsis</h3>
                        <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $film->synopsis }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-3">Cast & Crew</h3>
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

                    @if ($film->trailer_url)
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Trailer</h3>
                            <a href="{{ $film->trailer_url }}" target="_blank"
                                class="text-blue-600 hover:underline flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Watch Trailer
                            </a>
                        </div>
                    @endif

                    <!-- Showtimes -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Showtimes</h3>
                        @if ($film->showtimes->count() > 0)
                            <div class="space-y-4">
                                @foreach ($film->showtimes->groupBy('show_date') as $date => $showtimes)
                                    <div>
                                        <p class="font-medium mb-2">{{ \Carbon\Carbon::parse($date)->format('l, d F Y') }}
                                        </p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach ($showtimes as $showtime)
                                                <div class="px-3 py-2 bg-gray-100 dark:bg-gray-700 rounded-lg">
                                                    <p class="text-sm font-medium">
                                                        {{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">{{ $showtime->cinema->name }}</p>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 dark:text-gray-400">No showtimes scheduled</p>
                        @endif
                    </div>
                </div>

                <!-- Sidebar Info -->
                <div class="space-y-6">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold mb-3">Details</h3>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Category</dt>
                                <dd class="text-sm font-medium">{{ $film->category->name ?? '-' }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Status</dt>
                                <dd class="text-sm">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $film->status === 'now_playing' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                        {{ str_replace('_', ' ', ucfirst($film->status)) }}
                                    </span>
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Release Date</dt>
                                <dd class="text-sm font-medium">{{ $film->release_date?->format('d M Y') ?? '-' }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Created</dt>
                                <dd class="text-sm font-medium">{{ $film->created_at->format('d M Y') }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Last Updated</dt>
                                <dd class="text-sm font-medium">{{ $film->updated_at->format('d M Y') }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Statistics -->
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                        <h3 class="font-semibold mb-3">Statistics</h3>
                        <dl class="space-y-2">
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Total Showtimes</dt>
                                <dd class="text-sm font-medium">{{ $film->showtimes->count() }}</dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Total Tickets Sold</dt>
                                <dd class="text-sm font-medium">
                                    {{ $film->showtimes->sum(function ($showtime) {return $showtime->tickets->where('status', 'paid')->count();}) }}
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm text-gray-500 dark:text-gray-400">Revenue</dt>
                                <dd class="text-sm font-medium">Rp
                                    {{ number_format($film->showtimes->sum(function ($showtime) {return $showtime->tickets->where('status', 'paid')->sum('total_price');})) }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
