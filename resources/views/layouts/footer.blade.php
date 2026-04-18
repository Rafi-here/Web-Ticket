@php
    $settings = [
        'logo_type' => \App\Models\Setting::get('logo_type', 'text'),
        'logo_text' => \App\Models\Setting::get('logo_text', 'BPIX'),
        'logo_image' => \App\Models\Setting::get('logo_image'),
        'site_name' => \App\Models\Setting::get('site_name', 'BPIX'),
        'contact_email' => \App\Models\Setting::get('contact_email', 'info@bpix.com'),
        'contact_phone' => \App\Models\Setting::get('contact_phone', '+62 21 1234 5678'),
        'address' => \App\Models\Setting::get('address', 'Bandung, Indonesia'),
    ];
@endphp

<footer class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- About Section with Logo -->
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        @if ($settings['logo_type'] === 'image' && !empty($settings['logo_image']))
                            <img src="{{ Storage::url($settings['logo_image']) }}" alt="{{ $settings['site_name'] }}"
                                class="block h-8 w-auto object-contain">
                        @else
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center mr-2 shadow-lg">
                                    <span
                                        class="text-white font-bold text-lg">{{ substr($settings['logo_text'] ?? 'T', 0, 1) }}</span>
                                </div>
                                <span
                                    class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                    {{ $settings['logo_text'] ?? 'BPIX' }}
                                </span>
                            </div>
                        @endif
                    </a>
                </div>
                <p class="text-base text-gray-500 dark:text-gray-400">
                    {{ $settings['site_description'] ?? 'Platform pemesanan tiket event musik modern dengan pengalaman terbaik.' }}
                </p>

                <!-- Contact Info -->
                <div class="mt-4 space-y-2">
                    @if ($settings['contact_email'])
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            {{ $settings['contact_email'] }}
                        </div>
                    @endif

                    @if ($settings['contact_phone'])
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            {{ $settings['contact_phone'] }}
                        </div>
                    @endif

                    @if ($settings['address'])
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $settings['address'] }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Quick Links</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('home') }}"
                            class="text-base text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('events.index') }}"
                            class="text-base text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Events
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}"
                            class="text-base text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Contact
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Support</h3>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('faq') }}"
                            class="text-base text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('terms') }}"
                            class="text-base text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Terms of Service
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('privacy') }}"
                            class="text-base text-gray-500 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition">
                            Privacy Policy
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Follow Us -->
            <div>
                <h3 class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-4">Follow Us</h3>
                <div class="flex space-x-4">

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/share/1B2za7pkbN/" target="_blank"
                        class="text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition transform hover:scale-110">
                        <span class="sr-only">Facebook</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/bpixid?igsh=MTJzdnh6Y2thbzc1Ng==" target="_blank"
                        class="text-gray-400 hover:text-pink-600 dark:hover:text-pink-400 transition transform hover:scale-110">
                        <span class="sr-only">Instagram</span>
                        <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.38 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>

                <!-- WhatsApp Contact -->
                @php
                    $whatsappNumber = \App\Models\Setting::get('whatsapp_number', '');
                @endphp
                @if ($whatsappNumber)
                    <div class="mt-4">
                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" rel="noopener noreferrer"
                            class="inline-flex items-center text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-green-300 transition">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.447-1.273.607-1.446c.16-.173.346-.216.462-.216l.332.006c.106.004.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.087-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.274.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087.159.058 1.011.477 1.184.564.173.087.289.13.332.202.043.072.043.419-.101.824z" />
                            </svg>
                            Chat WhatsApp
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Bottom Bar -->
        <div class="mt-8 border-t border-gray-200 dark:border-gray-700 pt-8">
            <div class="flex justify-center items-center">
                <p class="text-base text-gray-400 text-center">
                    &copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'BPIX' }}. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</footer>
