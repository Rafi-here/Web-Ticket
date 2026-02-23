@extends('layouts.admin')

@section('title', 'Pengaturan WhatsApp')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.settings') }}"
                        class="inline-flex items-center justify-center w-10 h-10 bg-white dark:bg-gray-800 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 dark:border-gray-700 group">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500 transition-colors"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Pengaturan WhatsApp</h1>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">Atur nomor dan template pesan WhatsApp untuk
                            pemesanan tiket</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
                <form action="{{ route('admin.settings.whatsapp.update') }}" method="POST" class="p-8">
                    @csrf

                    <div class="space-y-6">
                        <!-- Nomor WhatsApp -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Nomor WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <div class="flex">
                                <span
                                    class="inline-flex items-center px-3 bg-gray-100 dark:bg-gray-700 border border-r-0 border-gray-300 dark:border-gray-600 rounded-l-lg text-gray-500 dark:text-gray-400">
                                    +62
                                </span>
                                <input type="text" name="whatsapp_number"
                                    value="{{ str_replace('+62', '', $settings['whatsapp_number']) }}"
                                    class="flex-1 px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-r-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                                    placeholder="81234567890" required>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Masukkan nomor tanpa +62, contoh: 81234567890</p>
                            @error('whatsapp_number')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Aktifkan WhatsApp -->
                        <div>
                            <label class="flex items-center space-x-3">
                                <input type="checkbox" name="whatsapp_enabled" value="1"
                                    {{ $settings['whatsapp_enabled'] == 'true' ? 'checked' : '' }}
                                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Aktifkan pemesanan via WhatsApp
                                </span>
                            </label>
                        </div>

                        <!-- Template Pesan -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Template Pesan WhatsApp
                            </label>
                            <textarea name="whatsapp_message_template" rows="10"
                                class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition font-mono text-sm">{{ $settings['whatsapp_message_template'] }}</textarea>

                            <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">Variable yang
                                    tersedia:</h4>
                                <div class="grid grid-cols-2 gap-2 text-xs">
                                    <code class="text-blue-600">{name}</code> <span class="text-gray-600">- Nama user</span>
                                    <code class="text-blue-600">{email}</code> <span class="text-gray-600">- Email
                                        user</span>
                                    <code class="text-blue-600">{event_title}</code> <span class="text-gray-600">- Judul
                                        event</span>
                                    <code class="text-blue-600">{event_date}</code> <span class="text-gray-600">- Tanggal
                                        event</span>
                                    <code class="text-blue-600">{event_time}</code> <span class="text-gray-600">- Waktu
                                        event</span>
                                    <code class="text-blue-600">{ticket_details}</code> <span class="text-gray-600">- Detail
                                        tiket</span>
                                    <code class="text-blue-600">{total_price}</code> <span class="text-gray-600">- Total
                                        harga</span>
                                    <code class="text-blue-600">{quantity}</code> <span class="text-gray-600">- Jumlah
                                        tiket</span>
                                </div>
                            </div>

                            <!-- Preview -->
                            <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-lg">
                                <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Preview:</h4>
                                <div class="bg-white dark:bg-gray-800 p-3 rounded-lg border border-gray-200 dark:border-gray-700 text-sm whitespace-pre-wrap"
                                    id="preview">
                                    {{-- Preview akan diisi JavaScript --}}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div
                        class="mt-8 flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <a href="{{ route('admin.settings') }}"
                            class="px-6 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-6 py-2 bg-gradient-to-r from-green-600 to-emerald-600 text-white font-medium rounded-lg hover:from-green-700 hover:to-emerald-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Preview template
            function updatePreview() {
                const template = document.querySelector('textarea[name="whatsapp_message_template"]').value;
                const preview = document.getElementById('preview');

                // Contoh data untuk preview
                const sampleData = {
                    name: 'John Doe',
                    email: 'john@example.com',
                    event_title: 'Bruno Mars Live in Jakarta',
                    event_date: '15 Juni 2025',
                    event_time: '19:30 WIB',
                    ticket_details: '- VIP: 2 tiket x Rp 3.500.000\n- CAT 1: 1 tiket x Rp 2.000.000',
                    total_price: 'Rp 9.000.000',
                    quantity: '3'
                };

                let previewText = template
                    .replace(/{name}/g, sampleData.name)
                    .replace(/{email}/g, sampleData.email)
                    .replace(/{event_title}/g, sampleData.event_title)
                    .replace(/{event_date}/g, sampleData.event_date)
                    .replace(/{event_time}/g, sampleData.event_time)
                    .replace(/{ticket_details}/g, sampleData.ticket_details)
                    .replace(/{total_price}/g, sampleData.total_price)
                    .replace(/{quantity}/g, sampleData.quantity);

                preview.textContent = previewText;
            }

            document.querySelector('textarea[name="whatsapp_message_template"]').addEventListener('input', updatePreview);
            updatePreview(); // Initial preview
        </script>
    @endpush
@endsection
