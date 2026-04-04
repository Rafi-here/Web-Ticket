@extends('layouts.app')

@section('title', 'Syarat & Ketentuan')

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
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in-up">
                        Syarat & Ketentuan
                    </h1>
                    <p class="text-lg md:text-xl opacity-90 max-w-2xl mx-auto animate-fade-in-up animation-delay-200">
                        Baca dan pahami syarat & ketentuan penggunaan layanan kami sebelum menggunakan platform BPIX.
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
                                <a href="#penerimaan"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    📌 Penerimaan Ketentuan
                                </a>
                                <a href="#akun"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    👤 Akun Pengguna
                                </a>
                                <a href="#pembelian"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    🎟️ Pembelian Tiket
                                </a>
                                <a href="#pembayaran"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    💳 Pembayaran
                                </a>
                                <a href="#masa-berlaku"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    ⏰ Masa Berlaku Tiket
                                </a>
                                <a href="#larangan"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    🚫 Larangan
                                </a>
                                <a href="#hak-platform"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    🔒 Hak Platform
                                </a>
                                <a href="#perubahan"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    ⚖️ Perubahan Ketentuan
                                </a>
                                <a href="#kontak"
                                    class="toc-link block text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 py-2 px-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    📞 Kontak
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
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">Ketentuan ini berlaku efektif sejak
                                tanggal tersebut</p>
                        </div>
                    </div>
                </div>

                <!-- Main Terms Content -->
                <div class="flex-1 space-y-8">
                    <!-- 1. Penerimaan Ketentuan -->
                    <section id="penerimaan"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up">
                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="text-2xl">📌</span>
                                1. Penerimaan Ketentuan
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start gap-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                        Dengan mengakses dan menggunakan website BPIX, Anda menyetujui untuk terikat dengan
                                        Syarat & Ketentuan ini.
                                        Jika Anda tidak setuju dengan bagian mana pun dari ketentuan ini, harap tidak
                                        menggunakan layanan kami.
                                    </p>
                                    <p class="text-gray-600 dark:text-gray-400 mt-3 text-sm">
                                        Ketentuan ini berlaku untuk semua pengguna website, termasuk namun tidak terbatas
                                        pada pengunjung, pelanggan, dan kontributor konten.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 2. Akun Pengguna -->
                    <section id="akun"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-100">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="text-2xl">👤</span>
                                2. Akun Pengguna
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">User wajib menjaga keamanan akun
                                        dan password</span>
                                </div>
                                <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Data yang diberikan harus valid
                                        dan akurat</span>
                                </div>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Anda bertanggung jawab penuh atas
                                    segala aktivitas yang terjadi di akun Anda.</p>
                            </div>
                        </div>
                    </section>

                    <!-- 3. Pembelian Tiket -->
                    <section id="pembelian"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-200">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="text-2xl">🎟️</span>
                                3. Pembelian Tiket
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-start gap-3 p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Tiket bersifat final dan tidak dapat
                                    dibatalkan atau dikembalikan</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                                <svg class="w-5 h-5 text-yellow-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-gray-700 dark:text-gray-300">User wajib memeriksa detail tiket
                                    (event, tanggal, kategori) sebelum melakukan pembayaran</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Tiket hanya berlaku untuk event,
                                    tanggal, dan kategori yang tertera</p>
                            </div>
                        </div>
                    </section>

                    <!-- 4. Pembayaran -->
                    <section id="pembayaran"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-300">
                        <div class="bg-gradient-to-r from-orange-500 to-red-500 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="text-2xl">💳</span>
                                4. Pembayaran
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-start gap-3 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Pembayaran harus dilakukan melalui
                                    metode yang tersedia di platform</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Jika pembayaran gagal, tiket tidak akan
                                    dianggap valid</p>
                            </div>
                        </div>
                    </section>

                    <!-- 5. Masa Berlaku Tiket -->
                    <section id="masa-berlaku"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-400">
                        <div class="bg-gradient-to-r from-yellow-500 to-amber-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="text-2xl">⏰</span>
                                5. Masa Berlaku Tiket
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl text-center">
                                    <div
                                        class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1">Masa berlaku 12 jam
                                    </p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Tiket memiliki waktu expired 12 jam
                                        setelah pembelian</p>
                                </div>
                                <div class="p-4 bg-gray-50 dark:bg-gray-700 rounded-xl text-center">
                                    <div
                                        class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <p class="text-sm font-semibold text-gray-900 dark:text-white mb-1">QR sekali scan</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">QR Code hanya berlaku untuk satu
                                        kali scan validasi</p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 6. Larangan -->
                    <section id="larangan"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-500">
                        <div class="bg-gradient-to-r from-red-500 to-rose-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="text-2xl">🚫</span>
                                6. Larangan
                            </h2>
                        </div>
                        <div class="p-6 space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Tidak boleh menyalahgunakan sistem
                                    atau melakukan akses ilegal</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Tidak boleh menduplikasi atau
                                    memalsukan tiket</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                <span class="text-sm text-gray-700 dark:text-gray-300">Tidak boleh melakukan aktivitas
                                    ilegal melalui platform</span>
                            </div>
                        </div>
                    </section>

                    <!-- 7. Hak Platform -->
                    <section id="hak-platform"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-600">
                        <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="text-2xl">🔒</span>
                                7. Hak Platform
                            </h2>
                        </div>
                        <div class="p-6 space-y-4">
                            <div class="flex items-start gap-3 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Berhak membatalkan transaksi yang
                                    mencurigakan atau melanggar ketentuan</p>
                            </div>
                            <div class="flex items-start gap-3 p-3 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                                <svg class="w-5 h-5 text-purple-600 flex-shrink-0 mt-0.5" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-sm text-gray-700 dark:text-gray-300">Berhak mengubah, menambah, atau
                                    menghentikan layanan tanpa pemberitahuan</p>
                            </div>
                        </div>
                    </section>

                    <!-- 8. Perubahan Ketentuan -->
                    <section id="perubahan"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-700">
                        <div class="bg-gradient-to-r from-teal-500 to-cyan-600 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="text-2xl">⚖️</span>
                                8. Perubahan Ketentuan
                            </h2>
                        </div>
                        <div class="p-6">
                            <div class="flex items-start gap-4 p-4 bg-teal-50 dark:bg-teal-900/20 rounded-xl">
                                <svg class="w-6 h-6 text-teal-600 flex-shrink-0 mt-1" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                <div>
                                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed">
                                        Kami berhak untuk memperbarui atau mengubah Syarat & Ketentuan ini sewaktu-waktu
                                        tanpa pemberitahuan sebelumnya.
                                        Perubahan akan berlaku segera setelah dipublikasikan di halaman ini.
                                    </p>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">
                                        Disarankan untuk memeriksa halaman ini secara berkala untuk mengetahui perubahan
                                        terbaru.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 9. Kontak -->
                    <section id="kontak"
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden scroll-mt-24 animate-fade-in-up animation-delay-800">
                        <div class="bg-gradient-to-r from-pink-500 to-rose-500 px-6 py-4">
                            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                                <span class="text-2xl">📞</span>
                                9. Kontak
                            </h2>
                        </div>
                        <div class="p-6">
                            <p class="text-gray-600 dark:text-gray-400 mb-4">Jika Anda memiliki pertanyaan tentang Syarat &
                                Ketentuan ini, silakan hubungi kami:</p>
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

            .animation-delay-700 {
                animation-delay: 0.7s;
                opacity: 0;
            }

            .animation-delay-800 {
                animation-delay: 0.8s;
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
