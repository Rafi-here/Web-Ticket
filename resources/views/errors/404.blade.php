@extends('layouts.app')

@section('title', '404 - Page Not Found')

@section('content')
<style>
    @keyframes rocketFly {
        0% { transform: translateY(40px) translateX(-20px) rotate(-8deg); opacity: 0; }
        50% { opacity: 1; }
        100% { transform: translateY(-40px) translateX(20px) rotate(8deg); }
    }

    @keyframes flame {
        0%,100% { transform: scaleY(1); opacity: .9; }
        50% { transform: scaleY(1.4); opacity: .5; }
    }

    @keyframes starsMove {
        from { transform: translateY(0); }
        to { transform: translateY(-200px); }
    }

    .rocket-anim {
        animation: rocketFly 3s ease-in-out infinite alternate;
    }

    .flame-anim {
        animation: flame .4s ease-in-out infinite;
        transform-origin: top;
    }

    .stars {
        animation: starsMove 20s linear infinite;
    }
</style>

<div class="relative min-h-[70vh] flex items-center justify-center px-4 overflow-hidden">

    {{-- ⭐ Background Stars --}}
    <div class="absolute inset-0 opacity-20 stars">
        <div class="text-white text-xs leading-6 whitespace-pre">
*     *        *       *       *
    *       *      *       *
*       *       *       *
        </div>
    </div>

    <div class="text-center relative z-10">

        {{-- 🚀 Rocket --}}
        <div class="flex justify-center mb-6 rocket-anim">
            <div class="relative">

                {{-- Rocket Body --}}
                <div class="w-16 h-24 bg-white rounded-t-full rounded-b-lg shadow-lg border border-gray-300"></div>

                {{-- Window --}}
                <div class="absolute top-6 left-1/2 -translate-x-1/2 w-6 h-6 bg-blue-400 rounded-full border-2 border-white"></div>

                {{-- Wings --}}
                <div class="absolute bottom-4 -left-4 w-6 h-8 bg-red-500 rounded"></div>
                <div class="absolute bottom-4 -right-4 w-6 h-8 bg-red-500 rounded"></div>

                {{-- Flame --}}
                <div class="absolute -bottom-6 left-1/2 -translate-x-1/2 flame-anim">
                    <div class="w-4 h-8 bg-gradient-to-b from-yellow-300 via-orange-500 to-red-600 rounded-b-full"></div>
                </div>
            </div>
        </div>

        {{-- 404 Text --}}
        <h1 class="text-8xl font-extrabold text-gray-300 dark:text-gray-600 tracking-widest">
            404
        </h1>

        <h2 class="mt-4 text-2xl font-semibold">Oops — Halaman Hilang di Luar Angkasa</h2>

        <p class="mt-2 text-gray-500 dark:text-gray-400 max-w-md mx-auto">
            Sepertinya halaman yang kamu cari sudah terbang entah ke galaksi mana nih. Ayo kembali aja
        </p>

        {{-- Buttons --}}
        <div class="mt-8 space-x-4">
            <a href="{{ route('home') }}"
               class="inline-flex items-center px-5 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow-lg hover:scale-105">
                Home
            </a>

            <a href="javascript:history.back()"
               class="inline-flex items-center px-5 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition shadow-lg hover:scale-105">
                Go Back
            </a>
        </div>

    </div>
</div>
@endsection