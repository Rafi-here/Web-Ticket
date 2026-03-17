@extends('layouts.admin')

@section('title', 'Settings')
@section('header', 'System Settings')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="p-6">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Navigation Tabs -->
                <div class="border-b border-gray-200 dark:border-gray-700 mb-6">
                    <nav class="flex space-x-8" x-data="{ tab: 'general' }">
                        <button type="button" @click="tab = 'general'"
                            :class="{ 'border-blue-500 text-blue-600': tab === 'general' }"
                            class="py-2 px-1 border-b-2 border-transparent font-medium text-sm hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            General
                        </button>
                    </nav>
                </div>

                <!-- Tab Contents -->
                <div x-data="{ tab: 'general' }">
                    <!-- General Settings -->
                    <div x-show="tab === 'general'" class="space-y-6">
                        <h3 class="text-lg font-medium">General Settings</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="site_name"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site
                                    Name</label>
                                <input type="text" name="site_name" id="site_name"
                                    value="{{ old('site_name', $settings['site_name'] ?? 'BPIX') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                                    required>
                            </div>

                            <div>
                                <label for="site_description"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Site
                                    Description</label>
                                <input type="text" name="site_description" id="site_description"
                                    value="{{ old('site_description', $settings['site_description'] ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>

                        <!-- Logo Settings -->
                        <div class="border-t border-gray-200 dark:border-gray-700 pt-6">
                            <h4 class="font-medium mb-4">Logo Settings</h4>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Logo
                                    Type</label>
                                <div class="flex space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="logo_type" value="text"
                                            {{ ($settings['logo_type'] ?? 'text') == 'text' ? 'checked' : '' }}
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-sm">Text Logo</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="logo_type" value="image"
                                            {{ ($settings['logo_type'] ?? '') == 'image' ? 'checked' : '' }}
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-sm">Image Logo</span>
                                    </label>
                                </div>
                            </div>

                            <div id="text-logo-settings"
                                class="{{ ($settings['logo_type'] ?? 'text') == 'text' ? '' : 'hidden' }}">
                                <label for="logo_text"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Logo
                                    Text</label>
                                <input type="text" name="logo_text" id="logo_text"
                                    value="{{ old('logo_text', $settings['logo_text'] ?? 'BPIX') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                <p class="mt-1 text-xs text-gray-500">Text yang akan ditampilkan sebagai logo</p>
                            </div>

                            <div id="image-logo-settings"
                                class="{{ ($settings['logo_type'] ?? '') == 'image' ? '' : 'hidden' }}">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Logo
                                    Image</label>
                                <div class="flex items-center space-x-4">
                                    <div class="flex-1">
                                        <input type="file" name="logo_image" id="logo_image" accept="image/*"
                                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                        <p class="mt-1 text-xs text-gray-500">Upload gambar logo (format: JPG, PNG, maks:
                                            2MB)</p>
                                    </div>
                                    @if (isset($settings['logo_image']) && $settings['logo_image'])
                                        <div class="flex-shrink-0">
                                            <img src="{{ Storage::url($settings['logo_image']) }}" alt="Logo"
                                                class="h-12 w-auto object-contain border border-gray-200 dark:border-gray-700 rounded-lg p-1">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Theme Settings -->
                    <div x-show="tab === 'theme'" class="space-y-6" x-cloak>
                        <h3 class="text-lg font-medium">Theme Settings</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="theme_color"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Theme
                                    Color</label>
                                <input type="color" name="theme_color" id="theme_color"
                                    value="{{ old('theme_color', $settings['theme_color'] ?? '#3b82f6') }}"
                                    class="w-full h-10 p-1 border border-gray-300 dark:border-gray-600 rounded-lg">
                            </div>

                            <div>
                                <label for="default_theme"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Default
                                    Theme</label>
                                <select name="default_theme" id="default_theme"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="light"
                                        {{ ($settings['default_theme'] ?? 'light') == 'light' ? 'selected' : '' }}>Light
                                    </option>
                                    <option value="dark"
                                        {{ ($settings['default_theme'] ?? '') == 'dark' ? 'selected' : '' }}>Dark</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label for="favicon"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Favicon</label>
                            <input type="file" name="favicon" id="favicon" accept="image/x-icon,image/png"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            <p class="mt-1 text-sm text-gray-500">Recommended: 32x32px ICO or PNG</p>
                        </div>
                    </div>

                    <!-- Contact Settings -->
                    <div x-show="tab === 'contact'" class="space-y-6" x-cloak>
                        <h3 class="text-lg font-medium">Contact Information</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="contact_email"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contact
                                    Email</label>
                                <input type="email" name="contact_email" id="contact_email"
                                    value="{{ old('contact_email', $settings['contact_email'] ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="contact_phone"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Contact
                                    Phone</label>
                                <input type="text" name="contact_phone" id="contact_phone"
                                    value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div class="md:col-span-2">
                                <label for="address"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                                <textarea name="address" id="address" rows="3"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">{{ old('address', $settings['address'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media Settings -->
                    <div x-show="tab === 'social'" class="space-y-6" x-cloak>
                        <h3 class="text-lg font-medium">Social Media Links</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="facebook_url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Facebook
                                    URL</label>
                                <input type="url" name="facebook_url" id="facebook_url"
                                    value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="instagram_url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Instagram
                                    URL</label>
                                <input type="url" name="instagram_url" id="instagram_url"
                                    value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="twitter_url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Twitter
                                    URL</label>
                                <input type="url" name="twitter_url" id="twitter_url"
                                    value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label for="youtube_url"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">YouTube
                                    URL</label>
                                <input type="url" name="youtube_url" id="youtube_url"
                                    value="{{ old('youtube_url', $settings['youtube_url'] ?? '') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp Settings -->
                    <div x-show="tab === 'whatsapp'" class="space-y-6" x-cloak>
                        <h3 class="text-lg font-medium">WhatsApp Settings</h3>

                        <div class="space-y-6">
                            <!-- Enable WhatsApp -->
                            <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div>
                                    <h4 class="font-medium text-gray-900 dark:text-white">Aktifkan Pemesanan WhatsApp</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Jika diaktifkan, user bisa memesan
                                        tiket via WhatsApp</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" name="whatsapp_enabled" value="1" class="sr-only peer"
                                        {{ ($settings['whatsapp_enabled'] ?? 'true') == 'true' ? 'checked' : '' }}>
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-green-600">
                                    </div>
                                </label>
                            </div>

                            <!-- WhatsApp Number -->
                            <div>
                                <label for="whatsapp_number"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Nomor WhatsApp Admin <span class="text-red-500">*</span>
                                </label>
                                <div class="flex">
                                    <span
                                        class="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-gray-300 dark:border-gray-600 bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                                        +62
                                    </span>
                                    <input type="text" name="whatsapp_number" id="whatsapp_number"
                                        value="{{ old('whatsapp_number', str_replace('+62', '', $settings['whatsapp_number'] ?? '81234567890')) }}"
                                        class="flex-1 px-3 py-2 rounded-r-lg border border-gray-300 dark:border-gray-600 focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                                        placeholder="81234567890">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Masukkan nomor tanpa +62. Contoh: 81234567890</p>
                            </div>

                            <!-- WhatsApp Message Template -->
                            <div>
                                <label for="whatsapp_message_template"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Template Pesan WhatsApp
                                </label>
                                <textarea name="whatsapp_message_template" id="whatsapp_message_template" rows="8"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white font-mono text-sm">{{ old('whatsapp_message_template', $settings['whatsapp_message_template'] ?? "Halo, saya ingin memesan tiket untuk event *{event_title}*\n\nDetail Pemesanan:\n👤 Nama: {name}\n📧 Email: {email}\n🎫 Event: {event_title}\n📅 Tanggal: {event_date}\n⏰ Waktu: {event_time}\n🎟️ Tiket:\n{ticket_details}\n💰 Total: Rp {total_price}\n\nMohon konfirmasi ketersediaan tiket. Terima kasih.") }}</textarea>

                                <!-- Variable Info -->
                                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                    <h4 class="text-sm font-semibold text-blue-800 dark:text-blue-300 mb-2">Variable yang
                                        tersedia:</h4>
                                    <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-xs">
                                        <div><code class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">{name}</code> -
                                            Nama user</div>
                                        <div><code class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">{email}</code>
                                            - Email user</div>
                                        <div><code
                                                class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">{event_title}</code>
                                            - Judul event</div>
                                        <div><code
                                                class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">{event_date}</code>
                                            - Tanggal event</div>
                                        <div><code
                                                class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">{event_time}</code>
                                            - Waktu event</div>
                                        <div><code
                                                class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">{ticket_details}</code>
                                            - Detail tiket</div>
                                        <div><code
                                                class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">{total_price}</code>
                                            - Total harga</div>
                                        <div><code
                                                class="bg-blue-100 dark:bg-blue-800 px-1 py-0.5 rounded">{quantity}</code>
                                            - Jumlah tiket</div>
                                    </div>
                                </div>

                                <!-- Preview Button -->
                                <div class="mt-4">
                                    <button type="button" id="preview-wa-btn"
                                        class="text-sm text-blue-600 hover:text-blue-700">
                                        👁️ Lihat Preview Pesan
                                    </button>
                                    <div id="preview-wa-box"
                                        class="mt-2 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg hidden">
                                        <p class="text-sm text-gray-700 dark:text-gray-300 whitespace-pre-wrap"
                                            id="preview-wa-text"></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- System Settings -->
                    <div x-show="tab === 'system'" class="space-y-6" x-cloak>
                        <h3 class="text-lg font-medium">System Configuration</h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="ticket_expiry_hours"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ticket Expiry
                                    (hours)</label>
                                <input type="number" name="ticket_expiry_hours" id="ticket_expiry_hours"
                                    value="{{ old('ticket_expiry_hours', $settings['ticket_expiry_hours'] ?? 12) }}"
                                    min="1" max="72"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Maintenance
                                    Mode</label>
                                <div class="flex items-center space-x-4">
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="maintenance_mode" value="1"
                                            {{ ($settings['maintenance_mode'] ?? '0') == '1' ? 'checked' : '' }}
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-sm">On</span>
                                    </label>
                                    <label class="inline-flex items-center">
                                        <input type="radio" name="maintenance_mode" value="0"
                                            {{ ($settings['maintenance_mode'] ?? '0') == '0' ? 'checked' : '' }}
                                            class="form-radio text-blue-600">
                                        <span class="ml-2 text-sm">Off</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3 mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Save
                        Settings</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            // Logo type toggle
            document.querySelectorAll('input[name="logo_type"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    document.getElementById('text-logo-settings').style.display = this.value === 'text' ?
                        'block' : 'none';
                    document.getElementById('image-logo-settings').style.display = this.value === 'image' ?
                        'block' : 'none';
                });
            });
        </script>
    @endpush
@endsection
