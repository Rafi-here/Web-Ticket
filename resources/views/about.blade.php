@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">About BPIX</h1>
            <p class="text-xl max-w-3xl mx-auto opacity-90">Platform pemesanan tiket event musik terkemuka di Indonesia, menghubungkan Anda dengan pengalaman musik terbaik</p>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="text-center md:text-left">
                    <div class="inline-block p-3 bg-blue-100 dark:bg-blue-900 rounded-full mb-4">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Our Mission</h2>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Menyediakan platform pemesanan tiket event musik yang mudah, cepat, dan terpercaya. 
                        Kami berkomitmen untuk menghadirkan pengalaman terbaik bagi pecinta musik dalam menemukan 
                        dan menghadiri konser serta festival favorit mereka.
                    </p>
                </div>

                <div class="text-center md:text-left">
                    <div class="inline-block p-3 bg-purple-100 dark:bg-purple-900 rounded-full mb-4">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Our Vision</h2>
                    <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                        Menjadi platform digital terdepan untuk industri musik di Indonesia, 
                        menciptakan ekosistem yang menghubungkan artis, promotor, dan penggemar musik 
                        melalui teknologi inovatif dan pengalaman yang tak terlupakan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Mengapa Memilih BPIX?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition">
                    <div
                        class="w-16 h-16 mx-auto bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pemesanan Mudah</h3>
                    <p class="text-gray-600 dark:text-gray-400">Pesan tiket event favorit Anda hanya dalam beberapa klik dengan antarmuka yang intuitif</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition">
                    <div
                        class="w-16 h-16 mx-auto bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-green-600 dark:text-green-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Pembayaran Aman</h3>
                    <p class="text-gray-600 dark:text-gray-400">Berbagai pilihan metode pembayaran dengan keamanan tingkat bank untuk transaksi Anda</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl p-6 text-center shadow-lg hover:shadow-xl transition">
                    <div
                        class="w-16 h-16 mx-auto bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-purple-600 dark:text-purple-300" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Penawaran Terbaik</h3>
                    <p class="text-gray-600 dark:text-gray-400">Dapatkan promo eksklusif dan harga spesial untuk member setia BPIX</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Cara Kerja BPIX</h2>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div class="flex-1 text-center">
                    <div
                        class="w-12 h-12 mx-auto bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-4">
                        1</div>
                    <h3 class="font-semibold mb-2">Pilih Event</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Jelajahi berbagai konser dan festival musik yang akan datang</p>
                </div>

                <div class="hidden md:block text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>

                <div class="flex-1 text-center">
                    <div
                        class="w-12 h-12 mx-auto bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-4">
                        2</div>
                    <h3 class="font-semibold mb-2">Pilih Kategori Tiket</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Tentukan jumlah tiket dan kategori yang diinginkan</p>
                </div>

                <div class="hidden md:block text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>

                <div class="flex-1 text-center">
                    <div
                        class="w-12 h-12 mx-auto bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-4">
                        3</div>
                    <h3 class="font-semibold mb-2">Lakukan Pembayaran</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Pilih metode pembayaran dan selesaikan transaksi</p>
                </div>

                <div class="hidden md:block text-gray-400">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>

                <div class="flex-1 text-center">
                    <div
                        class="w-12 h-12 mx-auto bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-4">
                        4</div>
                    <h3 class="font-semibold mb-2">Nikmati Event</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Tunjukkan e-ticket Anda di venue dan nikmati pengalaman musik</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Numbers -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">100+</div>
                    <div class="text-sm opacity-90">Event Terselenggara</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">50K+</div>
                    <div class="text-sm opacity-90">Tiket Terjual</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">25+</div>
                    <div class="text-sm opacity-90">Promotor Event</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">24/7</div>
                    <div class="text-sm opacity-90">Customer Support</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Tim Kami</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&size=128&length=2&background=4F46E5&color=fff&bold=true" 
                         alt="John Doe" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                    <h3 class="font-semibold text-lg">John Doe</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Founder & CEO</p>
                </div>
                <div class="text-center">
                    <img src="https://ui-avatars.com/api/?name=Jane+Smith&size=128&length=2&background=7C3AED&color=fff&bold=true" 
                         alt="Jane Smith" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                    <h3 class="font-semibold text-lg">Jane Smith</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">CTO</p>
                </div>
                <div class="text-center">
                    <img src="https://ui-avatars.com/api/?name=Mike+Johnson&size=128&length=2&background=DB2777&color=fff&bold=true" 
                         alt="Mike Johnson" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                    <h3 class="font-semibold text-lg">Mike Johnson</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Head of Operations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section (Optional) -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Partner Kami</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 items-center justify-items-center">
                <div class="grayscale hover:grayscale-0 transition">
                    <img src="https://via.placeholder.com/150x50?text=Partner+1" alt="Partner 1" class="h-12 object-contain">
                </div>
                <div class="grayscale hover:grayscale-0 transition">
                    <img src="https://via.placeholder.com/150x50?text=Partner+2" alt="Partner 2" class="h-12 object-contain">
                </div>
                <div class="grayscale hover:grayscale-0 transition">
                    <img src="https://via.placeholder.com/150x50?text=Partner+3" alt="Partner 3" class="h-12 object-contain">
                </div>
                <div class="grayscale hover:grayscale-0 transition">
                    <img src="https://via.placeholder.com/150x50?text=Partner+4" alt="Partner 4" class="h-12 object-contain">
                </div>
            </div>
        </div>
    </section>
@endsection