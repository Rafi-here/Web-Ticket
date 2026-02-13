@extends('layouts.admin')

@section('title', 'Dashboard')

@section('header', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Films -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Films</p>
                    <p class="text-2xl font-semibold">{{ $stats['total_films'] }}</p>
                </div>
            </div>
        </div>

        <!-- Now Playing -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Now Playing</p>
                    <p class="text-2xl font-semibold">{{ $stats['now_playing'] }}</p>
                </div>
            </div>
        </div>

        <!-- Tickets Sold -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Tickets Sold</p>
                    <p class="text-2xl font-semibold">{{ $stats['tickets_sold'] }}</p>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Total Users</p>
                    <p class="text-2xl font-semibold">{{ $stats['total_users'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Tickets & Revenue -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Recent Tickets -->
        <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Recent Tickets</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Ticket Code</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Film</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                User</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse ($recentTickets as $ticket)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $ticket->ticket_code }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $ticket->showtime->film->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $ticket->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full 
                                        @if ($ticket->status === 'paid') bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                        @elseif($ticket->status === 'pending') bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                        @elseif($ticket->status === 'expired') bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                        @else bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-gray-200 @endif">
                                        {{ ucfirst($ticket->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">Rp {{ number_format($ticket->total_price) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No tickets found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Revenue Today -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Revenue Today</h3>
            <p class="text-3xl font-bold text-green-600">Rp {{ number_format($stats['revenue_today']) }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">from {{ $recentTickets->count() }} tickets
            </p>

            <!-- Quick Stats -->
            <div class="mt-6 grid grid-cols-2 gap-4">
                <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-xs text-gray-500 dark:text-gray-400">This Month</p>
                    <p class="text-lg font-semibold">Rp {{ number_format($stats['revenue_month']) }}</p>
                </div>
                <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                    <p class="text-xs text-gray-500 dark:text-gray-400">Total</p>
                    <p class="text-lg font-semibold">Rp {{ number_format($stats['revenue_total']) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
        <!-- Popular Films -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Popular Films</h3>
            <div class="space-y-3">
                @forelse ($popularFilms as $film)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-sm font-medium">{{ $film->title }}</span>
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $film->ticket_count }} tickets</span>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No data available</p>
                @endforelse
            </div>
        </div>

        <!-- Payment Methods Distribution -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold mb-4">Payment Methods</h3>
            <div class="space-y-3">
                @forelse ($paymentMethods as $method)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span
                                class="text-sm font-medium capitalize">{{ str_replace('_', ' ', $method->method) }}</span>
                        </div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">{{ $method->count }} transactions</span>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">No payment data</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
