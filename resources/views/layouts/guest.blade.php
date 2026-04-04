<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'BPIX') }} - @yield('title', 'Authentication')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
        
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .dark .gradient-bg {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 100%);
        }
        
        /* Pastikan form bisa di-klik */
        .auth-card {
            position: relative;
            z-index: 10;
        }
        
        /* Wave background di belakang */
        .wave-bg {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>
<body class="font-sans antialiased min-h-screen gradient-bg overflow-x-hidden">
    <!-- Dark Mode Toggle -->
    <div class="absolute top-4 right-4 z-50">
        <button @click="darkMode = !darkMode" class="p-2 rounded-full bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition">
            <svg x-show="!darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
            <svg x-show="darkMode" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707"></path>
            </svg>
        </button>
    </div>

    <!-- Main Content - dengan z-index tinggi agar bisa di-klik -->
    <div class="min-h-screen flex flex-col sm:justify-center items-center px-4 py-8 relative z-10">
        <!-- Logo -->
        @php
            $settings = [
                'logo_type' => \App\Models\Setting::get('logo_type', 'text'),
                'logo_text' => \App\Models\Setting::get('logo_text', 'TIX'),
                'logo_image' => \App\Models\Setting::get('logo_image'),
                'site_name' => \App\Models\Setting::get('site_name', 'TIX'),
            ];
        @endphp

        <div class="mb-8 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center group">
                @if ($settings['logo_type'] === 'image' && !empty($settings['logo_image']))
                    <img src="{{ Storage::url($settings['logo_image']) }}" alt="{{ $settings['site_name'] }}"
                        class="h-16 w-auto object-contain drop-shadow-2xl">
                @else
                    <div class="flex items-center">
                        <div class="w-14 h-14 bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl flex items-center justify-center mr-3 shadow-2xl transform group-hover:scale-110 transition-transform duration-300">
                            <span class="text-white font-bold text-2xl">{{ substr($settings['logo_text'] ?? 'T', 0, 1) }}</span>
                        </div>
                        <span class="text-4xl font-bold text-white drop-shadow-lg">
                            {{ $settings['logo_text'] ?? 'TIX' }}
                        </span>
                    </div>
                @endif
            </a>
        </div>

        <!-- Card Container - pastikan bisa di-klik -->
        <div class="w-full sm:max-w-md auth-card">
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl overflow-hidden">
                <!-- Card Header -->
                <div class="h-2 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500"></div>
                
                <!-- Content -->
                <div class="p-8">
                    @yield('content')
                </div>
            </div>

            <!-- Footer Links -->
            <div class="mt-6 text-center space-x-4 text-sm">
                <a href="{{ route('home') }}" class="text-white/80 hover:text-white transition">Home</a>
                <span class="text-white/40">|</span>
                <a href="{{ route('events.index') }}" class="text-white/80 hover:text-white transition">Events</a>
                <span class="text-white/40">|</span>
                <a href="{{ route('contact') }}" class="text-white/80 hover:text-white transition">Contact</a>
            </div>

            <!-- Copyright -->
            <p class="mt-4 text-center text-xs text-white/60">
                &copy; {{ date('Y') }} {{ $settings['site_name'] ?? 'TIX' }}. All rights reserved.
            </p>
        </div>
    </div>

    <!-- Wave Background - di belakang -->
    <div class="wave-bg">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full opacity-20">
            <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </div>
</body>
</html>