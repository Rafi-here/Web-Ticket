@extends('layouts.app')

@section('title', 'FAQ & Chatbot')

@section('content')
    <div
        class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Animated Header -->
            <div class="text-center mb-16 animate-fade-in-up">
                <div class="inline-flex items-center justify-center mb-4">
                    <img src="{{ asset('images/faq.png') }}" class="w-16 h-16" alt="FAQ Icon">
                </div>
                <h1
                    class="text-5xl md:text-6xl font-bold bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 bg-clip-text text-transparent mb-4">
                    Frequently Asked Questions
                </h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">
                    Ada pertanyaan? Cari tahu di sini atau tanyakan langsung ke chatbot kami
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- FAQ Section - Left Side -->
                <div class="space-y-6">
                    <!-- Category Tabs with Glassmorphism -->
                    <div
                        class="flex flex-wrap gap-2 mb-8 sticky top-24 z-10 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md rounded-2xl p-2 shadow-sm">
                        <button
                            class="category-tab px-5 py-2.5 rounded-xl text-sm font-medium transition-all duration-300 flex items-center gap-2"
                            data-category="all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                            Semua
                        </button>
                        <button class="category-tab px-5 py-2.5 rounded-xl text-sm font-medium transition-all duration-300"
                            data-category="pemesanan">
                            🎟️ Pemesanan
                        </button>
                        <button class="category-tab px-5 py-2.5 rounded-xl text-sm font-medium transition-all duration-300"
                            data-category="pembayaran">
                            💳 Pembayaran
                        </button>
                        <button class="category-tab px-5 py-2.5 rounded-xl text-sm font-medium transition-all duration-300"
                            data-category="tiket">
                            📱 Tiket & QR
                        </button>
                        <button class="category-tab px-5 py-2.5 rounded-xl text-sm font-medium transition-all duration-300"
                            data-category="akun">
                            👤 Akun
                        </button>
                        <button class="category-tab px-5 py-2.5 rounded-xl text-sm font-medium transition-all duration-300"
                            data-category="refund">
                            💰 Refund
                        </button>
                    </div>

                    <!-- FAQ Accordion with Glassmorphism -->
                    <div class="space-y-4">
                        <!-- Pemesanan Category -->
                        <div class="faq-category" data-category="pemesanan">
                            <div
                                class="glass-card rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                                <button
                                    class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20 transition-all duration-300 group">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white text-lg flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center text-white text-sm">1</span>
                                        Bagaimana cara memesan tiket?
                                    </span>
                                    <svg class="faq-icon w-6 h-6 text-gray-400 transition-transform duration-300 group-hover:text-blue-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500">
                                    <div
                                        class="p-6 pt-0 text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700">
                                        <p class="mb-3">📝 Untuk memesan tiket:</p>
                                        <ol class="list-decimal list-inside space-y-2 ml-2">
                                            <li>✨ Pilih event yang Anda inginkan dari halaman utama</li>
                                            <li>🎫 Pilih kategori tiket dan jumlah yang diinginkan</li>
                                            <li>💳 Pilih metode pembayaran</li>
                                            <li>✅ Lakukan pembayaran sesuai instruksi</li>
                                            <li>🎉 Tiket akan muncul di menu "Tiket Saya" setelah pembayaran dikonfirmasi
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pembayaran Category -->
                        <div class="faq-category" data-category="pembayaran">
                            <div
                                class="glass-card rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                                <button
                                    class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20 transition-all duration-300 group">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white text-lg flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center text-white text-sm">2</span>
                                        Metode pembayaran apa saja yang tersedia?
                                    </span>
                                    <svg class="faq-icon w-6 h-6 text-gray-400 transition-transform duration-300 group-hover:text-blue-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500">
                                    <div
                                        class="p-6 pt-0 text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700">
                                        <p class="mb-3">💳 Kami menyediakan berbagai metode pembayaran:</p>
                                        <ul class="space-y-2">
                                            <li class="flex items-center gap-2"><span
                                                    class="w-2 h-2 bg-green-500 rounded-full"></span> E-Wallet (GoPay, OVO,
                                                DANA)</li>
                                            <li class="flex items-center gap-2"><span
                                                    class="w-2 h-2 bg-blue-500 rounded-full"></span> Virtual Account (BCA,
                                                Mandiri, BRI)</li>
                                            <li class="flex items-center gap-2"><span
                                                    class="w-2 h-2 bg-purple-500 rounded-full"></span> QRIS</li>
                                            <li class="flex items-center gap-2"><span
                                                    class="w-2 h-2 bg-orange-500 rounded-full"></span> Transfer Bank (BCA,
                                                Mandiri, BNI)</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="faq-category" data-category="pembayaran">
                            <div
                                class="glass-card rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                                <button
                                    class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20 transition-all duration-300 group">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white text-lg flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center text-white text-sm">3</span>
                                        Berapa lama waktu pembayaran?
                                    </span>
                                    <svg class="faq-icon w-6 h-6 text-gray-400 transition-transform duration-300 group-hover:text-blue-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500">
                                    <div
                                        class="p-6 pt-0 text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700">
                                        <div
                                            class="flex items-center gap-3 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl">
                                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <div>
                                                <p class="font-semibold">12 Jam</p>
                                                <p class="text-sm">Anda memiliki waktu 12 jam untuk menyelesaikan
                                                    pembayaran setelah pesanan dibuat. Jika melebihi batas waktu, pesanan
                                                    akan otomatis dibatalkan.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tiket & QR Category -->
                        <div class="faq-category" data-category="tiket">
                            <div
                                class="glass-card rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                                <button
                                    class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20 transition-all duration-300 group">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white text-lg flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center text-white text-sm">4</span>
                                        Di mana saya bisa melihat tiket saya?
                                    </span>
                                    <svg class="faq-icon w-6 h-6 text-gray-400 transition-transform duration-300 group-hover:text-blue-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500">
                                    <div
                                        class="p-6 pt-0 text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700">
                                        <p>Anda dapat melihat tiket di menu <span
                                                class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-lg font-semibold">🎫
                                                Tiket Saya</span> pada navbar setelah login. Tiket akan muncul setelah
                                            pembayaran berhasil dikonfirmasi.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="faq-category" data-category="tiket">
                            <div
                                class="glass-card rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                                <button
                                    class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20 transition-all duration-300 group">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white text-lg flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center text-white text-sm">5</span>
                                        Bagaimana cara menggunakan QR Code?
                                    </span>
                                    <svg class="faq-icon w-6 h-6 text-gray-400 transition-transform duration-300 group-hover:text-blue-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500">
                                    <div
                                        class="p-6 pt-0 text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700">
                                        <div
                                            class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 p-4 rounded-xl">
                                            <p class="flex items-center gap-2">📱 QR Code pada tiket Anda akan dipindai
                                                oleh petugas di venue untuk validasi. Pastikan Anda menunjukkan QR Code
                                                dalam kondisi yang jelas (bisa dicetak atau ditampilkan di ponsel).</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Akun Category -->
                        <div class="faq-category" data-category="akun">
                            <div
                                class="glass-card rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                                <button
                                    class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20 transition-all duration-300 group">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white text-lg flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center text-white text-sm">6</span>
                                        Bagaimana cara mengedit profil saya?
                                    </span>
                                    <svg class="faq-icon w-6 h-6 text-gray-400 transition-transform duration-300 group-hover:text-blue-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500">
                                    <div
                                        class="p-6 pt-0 text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700">
                                        <p>Anda dapat mengedit profil di menu <span
                                                class="inline-flex items-center gap-1 px-3 py-1 bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded-lg font-semibold">👤
                                                My Profile</span> setelah login. Di sana Anda bisa mengubah nama, email,
                                            nomor telepon, dan foto profil.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Refund Category -->
                        <div class="faq-category" data-category="refund">
                            <div
                                class="glass-card rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-2xl">
                                <button
                                    class="faq-question w-full text-left p-6 flex justify-between items-center hover:bg-gradient-to-r hover:from-blue-50 hover:to-purple-50 dark:hover:from-blue-900/20 dark:hover:to-purple-900/20 transition-all duration-300 group">
                                    <span
                                        class="font-semibold text-gray-900 dark:text-white text-lg flex items-center gap-3">
                                        <span
                                            class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-xl flex items-center justify-center text-white text-sm">7</span>
                                        Bagaimana kebijakan refund?
                                    </span>
                                    <svg class="faq-icon w-6 h-6 text-gray-400 transition-transform duration-300 group-hover:text-blue-500"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div class="faq-answer max-h-0 overflow-hidden transition-all duration-500">
                                    <div
                                        class="p-6 pt-0 text-gray-600 dark:text-gray-400 border-t border-gray-100 dark:border-gray-700">
                                        <div
                                            class="bg-red-50 dark:bg-red-900/20 p-4 rounded-xl border border-red-200 dark:border-red-800">
                                            <p>💰 Refund hanya dapat dilakukan jika event dibatalkan oleh penyelenggara.
                                                Untuk pembatalan dari pihak pembeli, tiket tidak dapat direfund. Silakan
                                                hubungi customer support untuk informasi lebih lanjut.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Statistics / Info Panel -->
                <div class="hidden lg:block">
                    <div class="sticky top-24 space-y-6">
                        <!-- Quick Stats -->
                        <div class="glass-card rounded-2xl p-6 text-center">
                            <div
                                class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">Fast Response</h3>
                            <p class="text-gray-600 dark:text-gray-400">Rata-rata waktu respons chatbot kurang dari 5 detik
                            </p>
                        </div>

                        <div class="glass-card rounded-2xl p-6 text-center">
                            <div
                                class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">24/7 Support</h3>
                            <p class="text-gray-600 dark:text-gray-400">Layanan customer support tersedia 24 jam sehari, 7
                                hari seminggu</p>
                        </div>

                        <div class="glass-card rounded-2xl p-6 text-center">
                            <div
                                class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold mb-2">10K+ Users</h3>
                            <p class="text-gray-600 dark:text-gray-400">Bergabung dengan ribuan pengguna yang sudah
                                menggunakan layanan kami</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Floating Chatbot Premium -->
        <div x-data="chatbot()" x-init="init()" class="fixed bottom-6 right-6 z-50">
            <!-- Chat Button with Pulse Effect -->
            <button @click="toggleChat()"
                class="relative w-14 h-14 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110 flex items-center justify-center text-white group">
                <div
                    class="absolute inset-0 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 animate-ping opacity-75">
                </div>
                <svg x-show="!isOpen" class="w-6 h-6 relative z-10" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                    </path>
                </svg>
                <svg x-show="isOpen" class="w-6 h-6 relative z-10" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <!-- Chat Window Premium -->
            <div x-show="isOpen" x-transition:enter="transition-all duration-300"
                x-transition:enter-start="opacity-0 transform translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                x-transition:leave="transition-all duration-200"
                x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 transform translate-y-6 scale-95"
                class="absolute bottom-16 right-0 w-[380px] sm:w-[420px] bg-white/95 dark:bg-gray-800/95 backdrop-blur-xl rounded-2xl shadow-2xl overflow-hidden border border-gray-200 dark:border-gray-700"
                @click.away="isOpen = false">

                <!-- Chat Header -->
                <div class="bg-gradient-to-r from-blue-600 to-purple-600 px-5 py-4 flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-white rounded-full flex items-center justify-center shadow-lg">
                            <img src="{{ asset('images/cs.png') }}" class="w-auto h-9" alt="FAQ Icon">
                        </div>
                        <div>
                            <h3 class="text-white font-semibold">BPIX Assistant</h3>
                            <div class="flex items-center gap-1">
                                <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                                <p class="text-xs text-blue-100">Online</p>
                            </div>
                        </div>
                    </div>
                    <button @click="isOpen = false" class="text-white hover:text-gray-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Chat Messages -->
                <div class="h-[280px] overflow-y-auto p-4 space-y-3 bg-gradient-to-b from-gray-50 to-white dark:from-gray-900 dark:to-gray-800"
                    x-ref="chatMessages">
                    <template x-for="(msg, idx) in messages" :key="idx">
                        <div x-show="msg.show" x-transition:enter="transition-all duration-300"
                            x-transition:enter-start="opacity-0 transform translate-y-4"
                            x-transition:enter-end="opacity-100 transform translate-y-0" class="flex"
                            :class="msg.type === 'user' ? 'justify-end' : 'justify-start'">
                            <div :class="msg.type === 'user' ?
                                'bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-br-none' :
                                'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-white rounded-bl-none'"
                                class="max-w-[85%] rounded-2xl px-4 py-2.5 shadow-md">
                                <p class="text-sm whitespace-pre-wrap" x-text="msg.text"></p>
                                <p class="text-xs mt-1 opacity-70" x-text="msg.time"></p>
                            </div>
                        </div>
                    </template>

                    <!-- Typing Indicator -->
                    <div x-show="isTyping" class="flex justify-start">
                        <div class="bg-gray-200 dark:bg-gray-700 rounded-2xl rounded-bl-none px-4 py-3">
                            <div class="flex gap-1.5">
                                <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"></div>
                                <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"
                                    style="animation-delay: 0.2s"></div>
                                <div class="w-2 h-2 bg-gray-500 rounded-full animate-bounce"
                                    style="animation-delay: 0.4s"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Questions -->
                <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <div class="flex flex-wrap gap-2">
                        <button @click="sendQuickQuestion('Cara beli tiket?')"
                            class="text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500 hover:text-white transition-all duration-300">
                            🎟️ Cara beli tiket?
                        </button>
                        <button @click="sendQuickQuestion('Metode pembayaran?')"
                            class="text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500 hover:text-white transition-all duration-300">
                            💳 Metode pembayaran?
                        </button>
                        <button @click="sendQuickQuestion('Tiket saya dimana?')"
                            class="text-xs px-3 py-1.5 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gradient-to-r hover:from-blue-500 hover:to-purple-500 hover:text-white transition-all duration-300">
                            🎫 Tiket saya dimana?
                        </button>
                    </div>
                </div>

                <!-- Chat Input -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800">
                    <div class="flex gap-2">
                        <input type="text" x-model="userInput" @keyup.enter="sendMessage()"
                            placeholder="Tanyakan sesuatu..."
                            class="flex-1 px-4 py-2.5 border border-gray-300 dark:border-gray-600 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white transition-all">
                        <button @click="sendMessage()"
                            class="px-5 py-2.5 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .glass-card {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
            }

            .dark .glass-card {
                background: rgba(31, 41, 55, 0.9);
                border: 1px solid rgba(255, 255, 255, 0.05);
            }

            .category-tab {
                background: rgba(243, 244, 246, 0.8);
                backdrop-filter: blur(8px);
                transition: all 0.3s ease;
            }

            .dark .category-tab {
                background: rgba(55, 65, 81, 0.8);
            }

            .category-tab.active {
                background: linear-gradient(135deg, #3b82f6, #8b5cf6);
                color: white;
                box-shadow: 0 4px 15px 0 rgba(59, 130, 246, 0.3);
            }

            .animate-fade-in-up {
                animation: fadeInUp 0.8s ease-out;
            }

            .animate-pulse-slow {
                animation: pulseSlow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes pulseSlow {

                0%,
                100% {
                    opacity: 1;
                    transform: scale(1);
                }

                50% {
                    opacity: 0.8;
                    transform: scale(0.95);
                }
            }

            .animate-bounce {
                animation: bounce 1.4s infinite;
            }

            @keyframes bounce {

                0%,
                60%,
                100% {
                    transform: translateY(0);
                }

                30% {
                    transform: translateY(-6px);
                }
            }

            /* Scrollbar Styling */
            .overflow-y-auto::-webkit-scrollbar {
                width: 6px;
            }

            .overflow-y-auto::-webkit-scrollbar-track {
                background: #f1f1f1;
                border-radius: 10px;
            }

            .overflow-y-auto::-webkit-scrollbar-thumb {
                background: linear-gradient(135deg, #3b82f6, #8b5cf6);
                border-radius: 10px;
            }

            .dark .overflow-y-auto::-webkit-scrollbar-track {
                background: #374151;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            function chatbot() {
                return {
                    isOpen: false,
                    messages: [],
                    userInput: '',
                    isTyping: false,

                    init() {
                        const saved = localStorage.getItem('chatHistory');
                        if (saved) {
                            this.messages = JSON.parse(saved);
                        } else {
                            this.messages.push({
                                type: 'bot',
                                text: '👋 Halo! Saya BPIX Assistant. Ada yang bisa saya bantu? Silakan tanyakan tentang tiket, pembayaran, atau event!',
                                time: this.getTime(),
                                show: true
                            });
                        }
                        this.scrollToBottom();
                    },

                    getTime() {
                        const now = new Date();
                        return now.toLocaleTimeString('id-ID', {
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    },

                    scrollToBottom() {
                        setTimeout(() => {
                            const container = this.$refs.chatMessages;
                            if (container) {
                                container.scrollTop = container.scrollHeight;
                            }
                        }, 100);
                    },

                    saveToLocalStorage() {
                        localStorage.setItem('chatHistory', JSON.stringify(this.messages));
                    },

                    addMessage(type, text) {
                        this.messages.push({
                            type: type,
                            text: text,
                            time: this.getTime(),
                            show: true
                        });
                        this.saveToLocalStorage();
                        this.scrollToBottom();
                    },

                    toggleChat() {
                        this.isOpen = !this.isOpen;
                        if (this.isOpen) {
                            this.scrollToBottom();
                        }
                    },

                    async sendMessage() {
                        if (!this.userInput.trim()) return;

                        const userMessage = this.userInput;
                        this.addMessage('user', userMessage);
                        this.userInput = '';

                        this.isTyping = true;
                        this.scrollToBottom();

                        setTimeout(() => {
                            const botReply = this.getBotReply(userMessage);
                            this.isTyping = false;
                            this.addMessage('bot', botReply);
                        }, 800);
                    },

                    sendQuickQuestion(question) {
                        this.userInput = question;
                        this.sendMessage();
                    },

                    getBotReply(message) {
                        const msg = message.toLowerCase();

                        if (msg.includes('tiket') && (msg.includes('dimana') || msg.includes('lihat') || msg.includes(
                                'cari'))) {
                            return '🎟️ *Tiket Anda* dapat dilihat di menu *"Tiket Saya"* pada navbar setelah login. Tiket akan muncul setelah pembayaran berhasil dikonfirmasi.';
                        }

                        if (msg.includes('tiket') && (msg.includes('beli') || msg.includes('pesan') || msg.includes('order'))) {
                            return '🎟️ *Cara beli tiket:*\n1. Pilih event favorit Anda\n2. Pilih kategori tiket\n3. Pilih metode pembayaran\n4. Selesaikan pembayaran\n5. Tiket akan muncul di "Tiket Saya"';
                        }

                        if (msg.includes('bayar') || msg.includes('payment') || msg.includes('metode')) {
                            return '💳 *Metode Pembayaran:*\n✅ E-Wallet (GoPay, OVO, DANA)\n✅ Virtual Account (BCA, Mandiri, BRI)\n✅ QRIS\n✅ Transfer Bank';
                        }

                        if (msg.includes('expired') || msg.includes('kadaluarsa')) {
                            return '⏰ *Waktu Pembayaran:* Anda memiliki waktu *12 jam* untuk menyelesaikan pembayaran. Jika melebihi batas waktu, pesanan akan otomatis dibatalkan.';
                        }

                        if (msg.includes('qr') || msg.includes('scan') || msg.includes('kode')) {
                            return '📱 *QR Code:* QR code pada tiket akan dipindai oleh petugas di venue. Pastikan QR code dalam kondisi jelas (bisa dicetak atau ditampilkan di ponsel).';
                        }

                        if (msg.includes('profil') || msg.includes('akun') || msg.includes('edit profile')) {
                            return '👤 *Profil:* Anda dapat mengedit profil di menu *"My Profile"* setelah login. Di sana Anda bisa mengubah nama, email, nomor telepon, dan foto profil.';
                        }

                        if (msg.includes('refund') || msg.includes('pengembalian') || msg.includes('dana')) {
                            return '💰 *Kebijakan Refund:* Refund hanya dapat dilakukan jika event dibatalkan oleh penyelenggara. Untuk pembatalan dari pihak pembeli, tiket tidak dapat direfund.';
                        }

                        if (msg.includes('event') || msg.includes('konser') || msg.includes('festival')) {
                            return '🎤 *Event:* Cek halaman utama atau menu *"Events"* untuk melihat daftar event yang tersedia. Kami selalu update dengan event-event terbaru!';
                        }

                        return '😅 *Maaf, saya belum mengerti pertanyaan Anda.*\n\nSilakan coba gunakan kata kunci seperti:\n- "tiket", "beli tiket"\n- "pembayaran", "metode bayar"\n- "qr code", "scan"\n- "profil", "akun"\n\nAtau cek FAQ di atas untuk informasi lebih lengkap!';
                    }
                };
            }

            // FAQ Accordion with smooth animation
            document.querySelectorAll('.faq-question').forEach(button => {
                button.addEventListener('click', () => {
                    const answer = button.nextElementSibling;
                    const icon = button.querySelector('.faq-icon');

                    if (answer.style.maxHeight && answer.style.maxHeight !== '0px') {
                        answer.style.maxHeight = '0';
                        icon.style.transform = 'rotate(0deg)';
                    } else {
                        document.querySelectorAll('.faq-answer').forEach(ans => {
                            ans.style.maxHeight = '0';
                        });
                        document.querySelectorAll('.faq-icon').forEach(icn => {
                            icn.style.transform = 'rotate(0deg)';
                        });

                        answer.style.maxHeight = answer.scrollHeight + 'px';
                        icon.style.transform = 'rotate(180deg)';
                    }
                });
            });

            // Category Filter with animation
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.addEventListener('click', () => {
                    const category = tab.dataset.category;

                    document.querySelectorAll('.category-tab').forEach(t => {
                        t.classList.remove('active');
                    });
                    tab.classList.add('active');

                    document.querySelectorAll('.faq-category').forEach(faq => {
                        if (category === 'all' || faq.dataset.category === category) {
                            faq.style.display = 'block';
                            faq.style.animation = 'fadeInUp 0.5s ease-out';
                        } else {
                            faq.style.display = 'none';
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
