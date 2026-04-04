@extends('layouts.app')

@section('title', 'Kebijakan Privasi')

@section('content')
    <!-- Scroll Progress Bar -->
    <div class="fixed top-0 left-0 w-full h-1 bg-gray-200 dark:bg-gray-700 z-50">
        <div class="h-full bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 transition-all duration-300"
            id="scrollProgress"></div>
    </div>

    <div
        class="min-h-screen bg-gradient-to-br from-gray-50 via-white to-gray-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-pink-600 text-white">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
                <div class="text-center max-w-4xl mx-auto">
                    <div class="inline-flex items-center justify-center mb-6">
                        <div
                            class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl flex items-center justify-center shadow-2xl animate-pulse-slow">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in-up">
                        Kebijakan Privasi
                    </h1>
                    <p class="text-lg md:text-xl opacity-90 max-w-2xl mx-auto animate-fade-in-up animation-delay-200">
                        Kami menghargai privasi Anda. Pelajari bagaimana kami melindungi dan mengelola data pribadi Anda.
                    </p>
                </div>
            </div>

            <!-- Wave Bottom -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120"
                    class="w-full text-gray-50 dark:text-gray-900 fill-current">
                    <path
                        d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z">
                    </path>
                </svg>
            </div>
        </section>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Sidebar - Table of Contents -->
                <div class="lg:w-80 flex-shrink-0">
                    <div class="sticky top-24 space-y-6">
                        <!-- Back Button -->
                        <a href="{{ route('home') }}"
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white dark:bg-gray-800 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 group">
                            <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            <span>Kembali</span>
                        </a>

                        <!-- Table of Contents Card -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                            <div
                                class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 px-5 py-4 border-b border-gray-200 dark:border-gray-700">
                                <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16"></path>
                                    </svg>
                                    Daftar Isi
                                </h3>
                            </div>
                            <div class="p-4 space-y-2">
                                <a href="#informasi"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    Informasi yang Dikumpulkan
                                </a>
                                <a href="#penggunaan"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    Penggunaan Data
                                </a>
                                <a href="#keamanan"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    Keamanan Data
                                </a>
                                <a href="#pembagian"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    Pembagian Data
                                </a>
                                <a href="#cookies"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    Cookies
                                </a>
                                <a href="#hak"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    Hak Pengguna
                                </a>
                                <a href="#kontak"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    Kontak
                                </a>
                            </div>
                        </div>

                        <!-- Last Updated Card -->
                        <div
                            class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 rounded-2xl p-5 border border-blue-100 dark:border-blue-800">
                            <div class="flex items-center gap-3 mb-2">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm font-semibold text-gray-700 dark:text-gray-300">Terakhir
                                    diperbarui</span>
                            </div>
                            <p class="text-lg font-bold text-gray-900 dark:text-white">{{ date('d F Y') }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Kebijakan ini berlaku efektif sejak
                                tanggal tersebut</p>
                        </div>
                    </div>
                </div>

                <!-- Main Privacy Content -->
                <div class="flex-1 space-y-8">
                    <!-- Informasi yang Dikumpulkan -->
                    <section id="informasi"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                Informasi yang Dikumpulkan
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                                Kami mengumpulkan informasi berikut untuk memberikan layanan terbaik kepada Anda:
                            </p>
                            <div class="grid gap-4">
                                <div class="flex items-start gap-3 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                                    <div
                                        class="w-10 h-10 bg-blue-100 dark:bg-blue-800 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Data Akun</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Nama lengkap, alamat email,
                                            nomor telepon, dan informasi profil lainnya yang Anda berikan saat mendaftar.
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 p-4 bg-purple-50 dark:bg-purple-900/20 rounded-xl">
                                    <div
                                        class="w-10 h-10 bg-purple-100 dark:bg-purple-800 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Data Transaksi</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Informasi pembelian tiket,
                                            riwayat pemesanan, dan metode pembayaran yang digunakan.</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-3 p-4 bg-green-50 dark:bg-green-900/20 rounded-xl">
                                    <div
                                        class="w-10 h-10 bg-green-100 dark:bg-green-800 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900 dark:text-white mb-1">Data Penggunaan</h3>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">Informasi tentang bagaimana
                                            Anda menggunakan website kami, termasuk halaman yang dikunjungi dan fitur yang
                                            digunakan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Penggunaan Data -->
                    <section id="penggunaan"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-100">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                Penggunaan Data
                            </h2>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed mb-4">
                                Data yang kami kumpulkan digunakan untuk:
                            </p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                                    <div
                                        class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Proses Pembelian Tiket
                                    </p>
                                </div>
                                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                                    <div
                                        class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Meningkatkan Layanan</p>
                                </div>
                                <div class="text-center p-4 bg-gray-50 dark:bg-gray-700 rounded-xl">
                                    <div
                                        class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                            </path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white">Keamanan & Pencegahan
                                        Fraud</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Keamanan Data -->
                    <section id="keamanan"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-200">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                Keamanan Data
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start gap-4 p-4 bg-green-50 dark:bg-green-900/20 rounded-xl mb-4">
                                <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white mb-1">Data Dilindungi dengan
                                        Standar Keamanan Tinggi</p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Kami menggunakan enkripsi SSL dan
                                        teknologi keamanan terbaru untuk melindungi data Anda dari akses tidak sah.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-semibold text-gray-900 dark:text-white mb-1">Tidak Dibagikan Tanpa Izin
                                    </p>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Kami tidak akan pernah membagikan
                                        data pribadi Anda tanpa persetujuan, kecuali diwajibkan oleh hukum.</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Pembagian Data -->
                    <section id="pembagian"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-300">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                Pembagian Data
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">✅ Data tidak dijual ke pihak ketiga</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-gray-700 dark:text-gray-300">⚠️ Data dapat dibagikan ke payment gateway
                                    untuk memproses transaksi</span>
                            </div>
                        </div>
                    </section>

                    <!-- Cookies -->
                    <section id="cookies"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-400">
                        <div class="bg-gradient-to-r from-yellow-500 to-orange-500 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                Cookies
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="flex flex-wrap gap-4">
                                <div class="flex-1 min-w-[200px] p-4 bg-gray-50 dark:bg-gray-700 rounded-xl text-center">
                                    <div
                                        class="w-10 h-10 mx-auto mb-2 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                        <span class="text-xl">🍪</span>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Website menggunakan cookies untuk
                                        meningkatkan pengalaman pengguna</p>
                                </div>
                                <div class="flex-1 min-w-[200px] p-4 bg-gray-50 dark:bg-gray-700 rounded-xl text-center">
                                    <div
                                        class="w-10 h-10 mx-auto mb-2 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Anda dapat mengatur preferensi
                                        cookies melalui pengaturan browser</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Hak Pengguna -->
                    <section id="hak"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-500">
                        <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                Hak Pengguna
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">Edit data profil</span>
                                </div>
                                <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                        </path>
                                    </svg>
                                    <span class="text-gray-700 dark:text-gray-300">Hapus akun (opsional)</span>
                                </div>
                            </div>
                            <p
                                class="text-sm text-gray-500 dark:text-gray-400 mt-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                💡 Anda dapat mengelola data pribadi Anda melalui halaman profil atau menghubungi customer
                                support kami.
                            </p>
                        </div>
                    </section>

                    <!-- Kontak -->
                    <section id="kontak"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-600">
                        <div class="bg-gradient-to-r from-indigo-500 to-blue-500 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                Kontak
                            </h2>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Jika Anda memiliki pertanyaan tentang
                                kebijakan privasi ini, silakan hubungi kami:</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="mailto:support@bpix.com"
                                    class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-blue-50 dark:hover:bg-blue-900/20 transition group">
                                    <div
                                        class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Email</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">support@bpix.com</p>
                                    </div>
                                </a>
                                <a href="{{ route('contact') }}"
                                    class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-purple-50 dark:hover:bg-purple-900/20 transition group">
                                    <div
                                        class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center group-hover:scale-110 transition">
                                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Halaman Kontak</p>
                                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Kirim pesan langsung
                                        </p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            /* Animations */
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

            .animate-fade-in-up {
                animation: fadeInUp 0.6s ease-out forwards;
            }

            .animation-delay-100 {
                animation-delay: 0.1s;
                opacity: 0;
            }

            .animation-delay-200 {
                animation-delay: 0.2s;
                opacity: 0;
            }

            .animation-delay-300 {
                animation-delay: 0.3s;
                opacity: 0;
            }

            .animation-delay-400 {
                animation-delay: 0.4s;
                opacity: 0;
            }

            .animation-delay-500 {
                animation-delay: 0.5s;
                opacity: 0;
            }

            .animation-delay-600 {
                animation-delay: 0.6s;
                opacity: 0;
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

            .animate-pulse-slow {
                animation: pulseSlow 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            /* Smooth scroll behavior */
            html {
                scroll-behavior: smooth;
            }

            .scroll-mt-24 {
                scroll-margin-top: 6rem;
            }

            /* Table of Contents hover effect */
            .toc-link {
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .toc-link::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                width: 3px;
                height: 100%;
                background: linear-gradient(135deg, #3b82f6, #8b5cf6);
                transform: scaleY(0);
                transition: transform 0.3s ease;
            }

            .toc-link:hover::before {
                transform: scaleY(1);
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Scroll Progress Bar
            window.addEventListener('scroll', () => {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                document.getElementById('scrollProgress').style.width = scrolled + '%';
            });

            // Highlight active TOC link on scroll
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.toc-link');

            window.addEventListener('scroll', () => {
                let current = '';
                const scrollPosition = window.scrollY + 150;

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;

                    if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    link.classList.remove('text-blue-600', 'dark:text-blue-400', 'bg-gray-50',
                        'dark:bg-gray-700');
                    const href = link.getAttribute('href');
                    if (href && href.substring(1) === current) {
                        link.classList.add('text-blue-600', 'dark:text-blue-400', 'bg-gray-50',
                            'dark:bg-gray-700');
                    }
                });
            });
        </script>
    @endpush
@endsection
