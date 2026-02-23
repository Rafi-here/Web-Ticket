@extends('layouts.admin')

@section('title', 'Edit Event')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.events.index') }}"
                        class="inline-flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 group">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500 transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit Event</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Perbarui informasi event musik</p>
                    </div>
                </div>
            </div>

            <!-- Status Warning -->
            @php
                // Cara lebih sederhana - bandingkan tanggal saja
                $today = \Carbon\Carbon::today();
                $eventDate = \Carbon\Carbon::parse($event->event_date);

                $isExpired = $eventDate->lt($today); // kurang dari hari ini
                $isSoldOut = $event->ticketCategories->sum('available') == 0;
            @endphp

            @if ($isExpired)
                <div
                    class="mb-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-800">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-500 mr-3 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="text-sm text-yellow-700 dark:text-yellow-400">
                            Event ini sudah lewat. Anda hanya dapat mengubah informasi tertentu.
                        </span>
                    </div>
                </div>
            @endif

            @if ($isSoldOut && !$isExpired)
                <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-500 mr-3 flex-shrink-0" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-sm text-blue-700 dark:text-blue-400">
                            Semua tiket untuk event ini sudah habis terjual.
                        </span>
                    </div>
                </div>
            @endif

            <!-- Form -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data"
                    class="p-8">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Event <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $event->title) }}" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('title') border-red-500 @enderror">
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Kategori <span class="text-red-500">*</span>
                                </label>
                                <select name="category" id="category" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('category') border-red-500 @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Konser"
                                        {{ old('category', $event->category) == 'Konser' ? 'selected' : '' }}>Konser
                                    </option>
                                    <option value="Festival"
                                        {{ old('category', $event->category) == 'Festival' ? 'selected' : '' }}>Festival
                                    </option>
                                    <option value="Music Show"
                                        {{ old('category', $event->category) == 'Music Show' ? 'selected' : '' }}>Music Show
                                    </option>
                                    <option value="Live Performance"
                                        {{ old('category', $event->category) == 'Live Performance' ? 'selected' : '' }}>Live
                                        Performance</option>
                                </select>
                                @error('category')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Poster Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Poster Event
                                </label>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <input type="file" name="poster" id="poster" accept="image/*"
                                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('poster') border-red-500 @enderror"
                                            onchange="previewImage(this)">
                                        <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah
                                            poster</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <img id="preview"
                                            src="{{ $event->poster ? Storage::url($event->poster) : 'https://via.placeholder.com/100x100' }}"
                                            alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-gray-300">
                                    </div>
                                </div>
                                @error('poster')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Venue -->
                            <div>
                                <label for="venue"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tempat <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="venue" id="venue"
                                    value="{{ old('venue', $event->venue) }}" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('venue') border-red-500 @enderror">
                                @error('venue')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- City -->
                            <div>
                                <label for="city"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Kota <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="city" id="city" value="{{ old('city', $event->city) }}"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('city') border-red-500 @enderror">
                                @error('city')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Address -->
                            <div>
                                <label for="address"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Alamat Lengkap
                                </label>
                                <textarea name="address" id="address" rows="3"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('address', $event->address) }}</textarea>
                                @error('address')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Event Date -->
                            <div>
                                <label for="event_date"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Tanggal Event <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="event_date" id="event_date"
                                    value="{{ old('event_date', $event->event_date) }}" min="{{ date('Y-m-d') }}"
                                    required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('event_date') border-red-500 @enderror">
                                @error('event_date')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Event Time -->
                            <div>
                                <label for="event_time"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Waktu Event <span class="text-red-500">*</span>
                                </label>
                                <input type="time" name="event_time" id="event_time"
                                    value="{{ old('event_time', $event->event_time) }}" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('event_time') border-red-500 @enderror">
                                @error('event_time')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Duration -->
                            <div>
                                <label for="duration"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Durasi (menit)
                                </label>
                                <input type="number" name="duration" id="duration"
                                    value="{{ old('duration', $event->duration) }}" min="0"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                @error('duration')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Age Rating -->
                            <div>
                                <label for="age_rating"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Batas Usia
                                </label>
                                <select name="age_rating" id="age_rating"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                    <option value="">-- Pilih Batas Usia --</option>
                                    <option value="SU"
                                        {{ old('age_rating', $event->age_rating) == 'SU' ? 'selected' : '' }}>SU (Semua
                                        Umur)</option>
                                    <option value="13+"
                                        {{ old('age_rating', $event->age_rating) == '13+' ? 'selected' : '' }}>13+</option>
                                    <option value="17+"
                                        {{ old('age_rating', $event->age_rating) == '17+' ? 'selected' : '' }}>17+</option>
                                    <option value="21+"
                                        {{ old('age_rating', $event->age_rating) == '21+' ? 'selected' : '' }}>21+</option>
                                </select>
                                @error('age_rating')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Artists -->
                            <div>
                                <label for="artists"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Artis / Lineup
                                </label>
                                <input type="text" name="artists" id="artists"
                                    value="{{ old('artists', is_array($event->artists) ? implode(', ', $event->artists) : $event->artists) }}"
                                    placeholder="Bruno Mars, Coldplay, Tulus (pisahkan dengan koma)"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <p class="mt-1 text-xs text-gray-500">Pisahkan dengan koma (,) jika lebih dari satu</p>
                                @error('artists')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Status Event
                                </label>
                                <select name="status" id="status"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                    <option value="upcoming"
                                        {{ old('status', $event->status) == 'upcoming' ? 'selected' : '' }}>Mendatang
                                    </option>
                                    <option value="ongoing"
                                        {{ old('status', $event->status) == 'ongoing' ? 'selected' : '' }}>Berlangsung
                                    </option>
                                    <option value="ended"
                                        {{ old('status', $event->status) == 'ended' ? 'selected' : '' }}>Selesai</option>
                                    <option value="cancelled"
                                        {{ old('status', $event->status) == 'cancelled' ? 'selected' : '' }}>Dibatalkan
                                    </option>
                                </select>
                                @error('status')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description (Full Width) -->
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Deskripsi Event <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" id="description" rows="6" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('description', $event->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Current Status Info -->
                    <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Status</p>
                            @php
                                $statusText = [
                                    'upcoming' => 'Mendatang',
                                    'ongoing' => 'Berlangsung',
                                    'ended' => 'Selesai',
                                    'cancelled' => 'Dibatalkan',
                                ];
                                $statusColor = [
                                    'upcoming' => 'text-green-600 dark:text-green-400',
                                    'ongoing' => 'text-blue-600 dark:text-blue-400',
                                    'ended' => 'text-gray-600 dark:text-gray-400',
                                    'cancelled' => 'text-red-600 dark:text-red-400',
                                ];
                            @endphp
                            <p class="text-sm font-semibold {{ $statusColor[$event->status] ?? 'text-gray-600' }}">
                                {{ $statusText[$event->status] ?? $event->status }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Dibuat</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $event->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Diupdate</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $event->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total Tiket</p>
                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                {{ $event->ticketCategories->sum('quantity') }}
                            </p>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="mt-8 flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.events.index') }}"
                            class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-semibold rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-all duration-300">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-8 py-3 bg-gradient-to-r from-yellow-600 to-orange-600 text-white font-semibold rounded-lg hover:from-yellow-700 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Update Event
                            </span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Ticket Categories Section -->
            <div
                class="mt-8 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                    <div>
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Kategori Tiket</h2>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Kelola kategori tiket untuk event ini</p>
                    </div>
                    <a href="{{ route('admin.events.ticket-categories.create', $event) }}"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white text-sm font-semibold rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-300">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Kategori
                    </a>
                </div>

                <div class="p-6">
                    @if ($event->ticketCategories->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($event->ticketCategories as $category)
                                <div
                                    class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-semibold text-lg">{{ $category->name }}</h3>
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.events.ticket-categories.edit', [$event, $category]) }}"
                                                class="text-yellow-600 hover:text-yellow-700" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form
                                                action="{{ route('admin.events.ticket-categories.destroy', [$event, $category]) }}"
                                                method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-700"
                                                    title="Hapus">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @if ($category->description)
                                        <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                            {{ $category->description }}</p>
                                    @endif
                                    <div class="grid grid-cols-2 gap-2 text-sm">
                                        <div>
                                            <span class="text-gray-500">Harga:</span>
                                            <span class="font-semibold text-blue-600 ml-1">Rp
                                                {{ number_format($category->price) }}</span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Tersedia:</span>
                                            <span
                                                class="font-semibold {{ $category->available > 0 ? 'text-green-600' : 'text-red-600' }} ml-1">
                                                {{ $category->available }}/{{ $category->quantity }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Max/Order:</span>
                                            <span class="font-semibold ml-1">{{ $category->max_per_order }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 mb-2">Belum ada kategori tiket</p>
                            <p class="text-sm text-gray-400">Tambahkan kategori tiket untuk event ini</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function previewImage(input) {
            const preview = document.getElementById('preview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
