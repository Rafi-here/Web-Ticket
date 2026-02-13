@extends('layouts.app')

@section('title', '403 - Unauthorized')

@section('content')
    <div class="min-h-[60vh] flex items-center justify-center px-4">
        <div class="text-center">
            <h1 class="text-9xl font-bold text-gray-300 dark:text-gray-600">403</h1>
            <div class="mt-8">
                <svg class="mx-auto h-24 w-24 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 15v2m0 0v2m0-2h2m-2 0H9m3-6V8m0 0V6m0 2h2m-2 2H9m9-6a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h2 class="mt-4 text-2xl font-semibold">Access Denied</h2>
                <p class="mt-2 text-gray-500 dark:text-gray-400">You don't have permission to access this page.</p>
                <div class="mt-6">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
