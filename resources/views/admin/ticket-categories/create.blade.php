@extends('layouts.admin')

@section('title', 'Tambah Kategori Tiket')

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
                    <span class="text-gray-900 dark:text-white font-medium">Tambah</span>
                </div>

                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 dark:text-white">Tambah Kategori Tiket</h1>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    Event: <span class="font-semibold">{{ $event->title }}</span>
                </p>
            </div>

            <!-- Form -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('admin.events.ticket-categories.store', $event) }}" method="POST" class="p-6">
                    @csrf

                    <div class="space-y-6">
                        <!-- Nama Kategori -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nama Kategori <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                placeholder="Contoh: VIP, Reguler, Festival Pass"
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
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('description') }}</textarea>
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
                                <input type="number" name="price" id="price" value="{{ old('price') }}" required
                                    min="0" step="1000"
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
                                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}" required
                                    min="1"
                                    class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('quantity') border-red-500 @enderror">
                                @error('quantity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Max Per Order -->
                        <div>
                            <label for="max_per_order"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Maksimal Pembelian per Order <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="max_per_order" id="max_per_order"
                                value="{{ old('max_per_order', 5) }}" required min="1"
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
                            <textarea name="benefits" id="benefits" rows="4"
                                placeholder="Tuliskan benefit, satu per baris&#10;Contoh:&#10;Meet & Greet&#10;Foto bersama&#10;Merchandise eksklusif&#10;Akses VIP Lounge"
                                class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('benefits') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">Tulis setiap benefit dalam baris baru</p>
                            @error('benefits')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preview -->
                        <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Preview</h4>
                            <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4" id="preview">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <span class="font-semibold text-gray-900 dark:text-white" id="preview-name">Nama
                                            Kategori</span>
                                        <p class="text-sm text-gray-500 dark:text-gray-400" id="preview-desc">-</p>
                                    </div>
                                    <span class="text-lg font-bold text-blue-600" id="preview-price">Rp 0</span>
                                </div>
                                <div class="text-xs text-gray-500">
                                    <span>Max pembelian: <span id="preview-max">5</span> tiket</span>
                                </div>
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
                            class="px-6 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-medium rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan Kategori
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Live preview
            document.getElementById('name').addEventListener('input', function() {
                document.getElementById('preview-name').textContent = this.value || 'Nama Kategori';
            });

            document.getElementById('description').addEventListener('input', function() {
                document.getElementById('preview-desc').textContent = this.value || '-';
            });

            document.getElementById('price').addEventListener('input', function() {
                let price = parseInt(this.value) || 0;
                document.getElementById('preview-price').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(
                    price);
            });

            document.getElementById('max_per_order').addEventListener('input', function() {
                document.getElementById('preview-max').textContent = this.value || '5';
            });
        </script>
    @endpush
@endsection
