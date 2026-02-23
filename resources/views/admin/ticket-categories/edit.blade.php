@extends('layouts.admin')

@section('title', 'Edit Kategori Tiket')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-6">
                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-4">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-blue-600">Dashboard</a>
                    <span>/</span>
                    <a href="{{ route('admin.events.index') }}" class="hover:text-blue-600">Events</a>
                    <span>/</span>
                    <a href="{{ route('admin.events.ticket-categories.index', $event) }}" class="hover:text-blue-600">Kategori
                        Tiket</a>
                    <span>/</span>
                    <span class="text-gray-900 dark:text-white font-medium">Edit</span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Edit Kategori Tiket</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Event: <span class="font-semibold">{{ $event->title }}</span>
                </p>
            </div>

            <!-- Form -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('admin.events.ticket-categories.update', [$event, $ticketCategory]) }}"
                    method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <!-- Nama Kategori -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Kategori <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $ticketCategory->name) }}" required
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label for="description"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="description" id="description" rows="3"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('description', $ticketCategory->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga & Quantity -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="price"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Harga (Rp) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="price" id="price"
                                    value="{{ old('price', $ticketCategory->price) }}" required min="0"
                                    step="1000"
                                    class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('price') border-red-500 @enderror">
                                @error('price')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="quantity"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Jumlah Tiket <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="quantity" id="quantity"
                                    value="{{ old('quantity', $ticketCategory->quantity) }}" required min="1"
                                    class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('quantity') border-red-500 @enderror">
                                @error('quantity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Tersedia saat ini: {{ $ticketCategory->available }}
                                </p>
                            </div>
                        </div>

                        <!-- Max Per Order -->
                        <div>
                            <label for="max_per_order"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Maksimal Pembelian per Order <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="max_per_order" id="max_per_order"
                                value="{{ old('max_per_order', $ticketCategory->max_per_order) }}" required min="1"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('max_per_order') border-red-500 @enderror">
                            @error('max_per_order')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Benefits -->
                        <div>
                            <label for="benefits" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Benefit / Fasilitas
                            </label>
                            <textarea name="benefits" id="benefits" rows="4" placeholder="Tuliskan benefit, satu per baris"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('benefits', is_array($ticketCategory->benefits) ? implode("\n", $ticketCategory->benefits) : $ticketCategory->benefits) }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Tulis setiap benefit dalam baris baru</p>
                            @error('benefits')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Info -->
                        <div class="grid grid-cols-2 gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <div>
                                <p class="text-xs text-gray-500">Tiket Terjual</p>
                                <p class="text-lg font-semibold text-green-600">{{ $ticketCategory->sold_count }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500">Tersisa</p>
                                <p
                                    class="text-lg font-semibold {{ $ticketCategory->available > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $ticketCategory->available }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="mt-8 flex items-center justify-end gap-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.events.ticket-categories.index', $event) }}"
                            class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-gradient-to-r from-yellow-600 to-orange-600 text-white font-medium rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Update Kategori
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
