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
                        <button type="button" @click="tab = 'theme'"
                            :class="{ 'border-blue-500 text-blue-600': tab === 'theme' }"
                            class="py-2 px-1 border-b-2 border-transparent font-medium text-sm hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            Theme
                        </button>
                        <button type="button" @click="tab = 'contact'"
                            :class="{ 'border-blue-500 text-blue-600': tab === 'contact' }"
                            class="py-2 px-1 border-b-2 border-transparent font-medium text-sm hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            Contact
                        </button>
                        <button type="button" @click="tab = 'social'"
                            :class="{ 'border-blue-500 text-blue-600': tab === 'social' }"
                            class="py-2 px-1 border-b-2 border-transparent font-medium text-sm hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            Social Media
                        </button>
                        <button type="button" @click="tab = 'system'"
                            :class="{ 'border-blue-500 text-blue-600': tab === 'system' }"
                            class="py-2 px-1 border-b-2 border-transparent font-medium text-sm hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            System
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
                                    value="{{ old('site_name', $settings['site_name'] ?? 'TIX') }}"
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
                                    value="{{ old('logo_text', $settings['logo_text'] ?? 'TIX') }}"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                            </div>

                            <div id="image-logo-settings"
                                class="{{ ($settings['logo_type'] ?? '') == 'image' ? '' : 'hidden' }}">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Logo
                                    Image</label>
                                <div class="flex items-center space-x-4">
                                    <input type="file" name="logo_image" id="logo_image" accept="image/*"
                                        class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                    @if (isset($settings['logo_image']) && $settings['logo_image'])
                                        <img src="{{ Storage::url($settings['logo_image']) }}" alt="Logo"
                                            class="h-10 w-auto">
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
