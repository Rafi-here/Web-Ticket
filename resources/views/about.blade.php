@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">About TIX</h1>
            <p class="text-xl max-w-3xl mx-auto opacity-90">Platform pemesanan tiket bioskop modern dengan pengalaman terbaik
                untuk Anda</p>
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
                        To provide the easiest and most enjoyable movie ticket booking experience,
                        connecting movie lovers with the best cinematic experiences across Indonesia.
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
                        To become Indonesia's leading digital cinema platform, revolutionizing how people
                        discover, book, and enjoy movies.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us -->
    <section class="py-16 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">Why Choose TIX?</h2>

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
                    <h3 class="text-xl font-semibold mb-2">Easy Booking</h3>
                    <p class="text-gray-600 dark:text-gray-400">Book your tickets in just a few clicks with our intuitive
                        interface</p>
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
                    <h3 class="text-xl font-semibold mb-2">Secure Payment</h3>
                    <p class="text-gray-600 dark:text-gray-400">Multiple payment options with bank-level security</p>
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
                    <h3 class="text-xl font-semibold mb-2">Best Deals</h3>
                    <p class="text-gray-600 dark:text-gray-400">Exclusive promotions and discounts for our members</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-16 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div class="flex-1 text-center">
                    <div
                        class="w-12 h-12 mx-auto bg-blue-600 text-white rounded-full flex items-center justify-center text-xl font-bold mb-4">
                        1</div>
                    <h3 class="font-semibold mb-2">Choose Movie</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Browse now playing or coming soon movies</p>
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
                    <h3 class="font-semibold mb-2">Select Seats</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Pick your preferred seats and showtime</p>
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
                    <h3 class="font-semibold mb-2">Make Payment</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Choose payment method and complete</p>
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
                    <h3 class="font-semibold mb-2">Enjoy Movie</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Show your e-ticket at the cinema</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Numbers -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <div class="text-4xl font-bold mb-2">50+</div>
                    <div class="text-sm opacity-90">Cinemas Partner</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">100K+</div>
                    <div class="text-sm opacity-90">Happy Customers</div>
                </div>
                <div>
                    <div class="text-4xl font-bold mb-2">500+</div>
                    <div class="text-sm opacity-90">Movies</div>
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
            <h2 class="text-3xl font-bold text-center mb-12">Our Team</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <img src="https://via.placeholder.com/200x200" alt="Team Member"
                        class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="font-semibold text-lg">John Doe</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Founder & CEO</p>
                </div>
                <div class="text-center">
                    <img src="https://via.placeholder.com/200x200" alt="Team Member"
                        class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="font-semibold text-lg">Jane Smith</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">CTO</p>
                </div>
                <div class="text-center">
                    <img src="https://via.placeholder.com/200x200" alt="Team Member"
                        class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="font-semibold text-lg">Mike Johnson</h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Head of Operations</p>
                </div>
            </div>
        </div>
    </section>
@endsection
