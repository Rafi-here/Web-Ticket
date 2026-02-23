@extends('layouts.admin')

@section('title', 'Tambah Event Musik')

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
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Tambah Event Musik</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Buat event musik atau konser baru</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data"
                    class="p-8">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nama Event <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}"
                                    placeholder="Contoh: Bruno Mars Live in Jakarta"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('title') border-red-500 @enderror"
                                    required>
                                @error('title')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Category -->
                            <div>
                                <label for="category"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Kategori Event <span class="text-red-500">*</span>
                                </label>
                                <select name="category" id="category" required
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('category') border-red-500 @enderror">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Konser" {{ old('category') == 'Konser' ? 'selected' : '' }}>Konser
                                    </option>
                                    <option value="Festival" {{ old('category') == 'Festival' ? 'selected' : '' }}>Festival
                                    </option>
                                    <option value="Music Show" {{ old('category') == 'Music Show' ? 'selected' : '' }}>Music
                                        Show</option>
                                    <option value="Live Performance"
                                        {{ old('category') == 'Live Performance' ? 'selected' : '' }}>Live Performance
                                    </option>
                                    <option value="Orkestra" {{ old('category') == 'Orkestra' ? 'selected' : '' }}>Orkestra
                                    </option>
                                    <option value="DJ" {{ old('category') == 'DJ' ? 'selected' : '' }}>DJ / Electronic
                                    </option>
                                </select>
                                @error('category')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Poster Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Poster Event <span class="text-red-500">*</span>
                                </label>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <input type="file" name="poster" id="poster" accept="image/*" required
                                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('poster') border-red-500 @enderror"
                                            onchange="previewImage(this)">
                                        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG. Maksimal 2MB</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <img id="preview" src="https://via.placeholder.com/100x100?text=Preview"
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
                                    Nama Tempat <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="venue" id="venue" value="{{ old('venue') }}"
                                    placeholder="Contoh: Stadion GBK, Istora Senayan"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('venue') border-red-500 @enderror"
                                    required>
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
                                <input type="text" name="city" id="city" value="{{ old('city') }}"
                                    placeholder="Contoh: Jakarta, Surabaya, Bandung"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('city') border-red-500 @enderror"
                                    required>
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
                                <textarea name="address" id="address" rows="2"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    placeholder="Jl. Pintu Satu Senayan, Jakarta Pusat">{{ old('address') }}</textarea>
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
                                    value="{{ old('event_date', date('Y-m-d', strtotime('+30 days'))) }}"
                                    min="{{ date('Y-m-d') }}" required
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
                                    value="{{ old('event_time', '19:30') }}" required
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
                                <input type="number" name="duration" id="duration" value="{{ old('duration', 120) }}"
                                    min="30" step="30"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <p class="mt-1 text-xs text-gray-500">Estimasi durasi event dalam menit</p>
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
                                    <option value="SU" {{ old('age_rating') == 'SU' ? 'selected' : '' }}>SU (Semua
                                        Umur)</option>
                                    <option value="13+" {{ old('age_rating') == '13+' ? 'selected' : '' }}>13+</option>
                                    <option value="17+" {{ old('age_rating') == '17+' ? 'selected' : '' }}>17+</option>
                                    <option value="21+" {{ old('age_rating') == '21+' ? 'selected' : '' }}>21+</option>
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
                                <input type="text" name="artists" id="artists" value="{{ old('artists') }}"
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
                                        {{ old('status', 'upcoming') == 'upcoming' ? 'selected' : '' }}>Mendatang</option>
                                    <option value="ongoing" {{ old('status') == 'ongoing' ? 'selected' : '' }}>Berlangsung
                                    </option>
                                    <option value="ended" {{ old('status') == 'ended' ? 'selected' : '' }}>Selesai
                                    </option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                        Dibatalkan</option>
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
                        <textarea name="description" id="description" rows="5" required
                            class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Jelaskan detail tentang event ini, penampilan spesial, dll.">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Informasi Tambahan -->
                    <div
                        class="mt-8 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300">Informasi</h4>
                                <p class="text-xs text-blue-600 dark:text-blue-400 mt-1">
                                    Setelah event dibuat, Anda dapat menambahkan kategori tiket (VIP, CAT 1, CAT 2, dll)
                                    melalui menu "Kategori Tiket" di halaman detail event.
                                </p>
                            </div>
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
                            class="px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4" />
                                </svg>
                                Buat Event
                            </span>
                        </button>
                    </div>
                </form>
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
