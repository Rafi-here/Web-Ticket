@extends('layouts.app')

@section('title', $film->title)

@section('content')
    <!-- Hero Section -->
    <div class="relative h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ $film->poster ? Storage::url($film->poster) : 'https://via.placeholder.com/1200x500?text=Event' }}"
            alt="{{ $film->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>

        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12 text-white">
            <div class="max-w-7xl mx-auto">
                <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $film->title }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm md:text-base">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ $film->event_date ? \Carbon\Carbon::parse($film->event_date)->format('l, d F Y') : ($film->release_date ? \Carbon\Carbon::parse($film->release_date)->format('l, d F Y') : 'TBA') }}
                    </span>
                    <span>•</span>
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $film->event_time ? \Carbon\Carbon::parse($film->event_time)->format('H:i') : '19:00' }} WIB
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Description -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Tentang Event</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">{{ $film->synopsis ?? $film->description ?? 'Belum ada deskripsi' }}</p>
                </div>

                <!-- Artists / Lineup (dari cast) -->
                @if ($film->cast)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Lineup Artis</h2>
                        <div class="flex flex-wrap gap-2">
                            @php
                                $artists = is_array($film->cast) ? $film->cast : explode(',', $film->cast);
                            @endphp
                            @foreach ($artists as $artist)
                                <span class="px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900 dark:to-purple-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">
                                    {{ trim($artist) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Venue Details (dari cinema) -->
                @if(isset($film->venue) || isset($film->cinema))
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Lokasi</h2>
                        <div class="flex items-start">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-lg">{{ $film->venue ?? ($film->cinema->name ?? 'Venue') }}</h3>
                                <p class="text-gray-600 dark:text-gray-400">{{ $film->address ?? ($film->cinema->address ?? $film->city ?? 'Jakarta') }}</p>
                                @if($film->address)
                                    <a href="https://maps.google.com/?q={{ urlencode($film->address) }}" target="_blank" 
                                       class="inline-flex items-center mt-2 text-blue-600 hover:text-blue-700 text-sm">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                        Lihat di Google Maps
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar - Ticket Selection -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 sticky top-24">
                    <h2 class="text-xl font-semibold mb-4">Pilih Tiket</h2>

                    @php
                        $today = \Carbon\Carbon::today();
                        $eventDate = isset($film->event_date) ? \Carbon\Carbon::parse($film->event_date) : (\Carbon\Carbon::parse($film->release_date) ?? $today);
                        $isEventAvailable = $eventDate->greaterThanOrEqualTo($today) && ($film->status === 'upcoming' || $film->status === 'now_playing');
                        
                        // Gunakan ticket_categories jika ada, atau buat dummy categories
                        $ticketCategories = $film->ticketCategories ?? collect([
                            (object)[
                                'name' => 'VIP',
                                'description' => 'Akses VIP + Meet & Greet',
                                'price' => 3500000,
                                'available' => 100,
                                'max_per_order' => 2,
                                'benefits' => ['Meet & Greet', 'Foto bersama', 'Merchandise eksklusif']
                            ],
                            (object)[
                                'name' => 'CAT 1',
                                'description' => 'Tribune Tengah',
                                'price' => 2000000,
                                'available' => 200,
                                'max_per_order' => 4,
                                'benefits' => null
                            ],
                            (object)[
                                'name' => 'CAT 2',
                                'description' => 'Tribune Samping',
                                'price' => 1250000,
                                'available' => 300,
                                'max_per_order' => 5,
                                'benefits' => null
                            ]
                        ]);
                    @endphp

                    @if ($isEventAvailable && $ticketCategories->count() > 0)
                        <form action="{{ route('event.order.process') }}" method="POST" id="order-form">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $film->id }}">
                            <input type="hidden" name="tickets" id="tickets-input" value="[]">
                            <input type="hidden" name="total_price" id="total-price-input" value="0">
                            <input type="hidden" name="quantity" id="total-quantity-input" value="0">
                            <input type="hidden" name="payment_method" id="payment-method-input" value="">
                            <input type="hidden" name="provider" id="provider-input" value="">

                            <!-- Ticket Categories -->
                            <div class="space-y-4 mb-6">
                                @foreach ($ticketCategories as $category)
                                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-blue-500 transition">
                                        <div class="flex justify-between items-start mb-3">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $category->name }}</h3>
                                                @if(isset($category->description) && $category->description)
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $category->description }}</p>
                                                @endif
                                                @if(isset($category->benefits) && $category->benefits)
                                                    <div class="mt-2 text-xs text-green-600 dark:text-green-400">
                                                        @foreach (is_array($category->benefits) ? $category->benefits : json_decode($category->benefits, true) as $benefit)
                                                            <span class="block">✓ {{ $benefit }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-right">
                                                <p class="text-lg font-bold text-blue-600 dark:text-blue-400">
                                                    Rp {{ number_format($category->price, 0, ',', '.') }}
                                                </p>
                                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                                    Sisa: <span class="font-semibold {{ ($category->available ?? 0) < 20 ? 'text-red-500' : 'text-green-500' }}">
                                                        {{ $category->available ?? 0 }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Quantity Selector -->
                                        @if(($category->available ?? 0) > 0)
                                            <div class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">Jumlah:</span>
                                                <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden"
                                                     x-data="{ qty: 0, category: '{{ $category->name }}', price: {{ $category->price }}, max: {{ min($category->available ?? 0, $category->max_per_order ?? 5) }} }">
                                                    <button type="button" @click="if(qty > 0) { qty--; updateTickets(); }"
                                                        class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition text-gray-700 dark:text-gray-300 font-bold">
                                                        -
                                                    </button>
                                                    <input type="number" x-model="qty" readonly
                                                        class="w-16 text-center border-x border-gray-300 dark:border-gray-600 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none"
                                                        min="0" :max="max">
                                                    <button type="button" @click="if(qty < max) { qty++; updateTickets(); }"
                                                        class="px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition text-gray-700 dark:text-gray-300 font-bold">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div class="text-center py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-400 font-semibold mt-3">
                                                Sold Out
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>

                            <!-- Total Section -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mb-6">
                                <div class="space-y-2">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600 dark:text-gray-400">Subtotal:</span>
                                        <span class="font-medium" id="subtotal">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-600 dark:text-gray-400">Biaya Layanan (2%):</span>
                                        <span class="font-medium" id="fee">Rp 0</span>
                                    </div>
                                    <div class="flex justify-between text-lg font-bold">
                                        <span class="text-gray-900 dark:text-white">Total:</span>
                                        <span class="text-blue-600" id="total">Rp 0</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                    Metode Pembayaran
                                </label>
                                <select id="payment-method-select"
                                    class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 mb-2"
                                    required>
                                    <option value="">Pilih Metode</option>
                                    <option value="ewallet">E-Wallet</option>
                                    <option value="virtual_account">Virtual Account</option>
                                    <option value="qris">QRIS</option>
                                    <option value="transfer_bank">Transfer Bank</option>
                                </select>

                                <select id="provider-select"
                                    class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required disabled>
                                    <option value="">Pilih Provider</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            @auth
                                <button type="submit" id="submit-btn" disabled
                                    class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Lanjut ke Pembayaran
                                </button>
                            @else
                                <a href="{{ route('login') }}?redirect={{ urlencode(request()->fullUrl()) }}"
                                    class="block text-center px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Login untuk Membeli Tiket
                                </a>
                            @endauth
                        </form>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400">Tiket belum tersedia</p>
                            <p class="text-sm text-gray-400 dark:text-gray-500 mt-2">Silakan cek kembali nanti</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Related Events (tetap pakai $relatedFilms) -->
        @if (isset($relatedFilms) && $relatedFilms->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">Event Lainnya</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($relatedFilms as $related)
                        <a href="{{ route('film.detail', $related->slug) }}" class="group">
                            <div class="relative overflow-hidden rounded-lg aspect-[2/3]">
                                <img src="{{ $related->poster ? Storage::url($related->poster) : 'https://via.placeholder.com/300x450' }}"
                                    alt="{{ $related->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/70 to-transparent">
                                    <h3 class="text-white font-semibold text-sm">{{ $related->title }}</h3>
                                    <p class="text-xs text-gray-300">{{ isset($related->event_date) ? \Carbon\Carbon::parse($related->event_date)->format('d M Y') : (isset($related->release_date) ? \Carbon\Carbon::parse($related->release_date)->format('d M Y') : 'TBA') }}</p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data untuk perhitungan
        let tickets = [];
        let total = 0;
        
        // Elemen DOM
        const ticketsInput = document.getElementById('tickets-input');
        const totalPriceInput = document.getElementById('total-price-input');
        const totalQuantityInput = document.getElementById('total-quantity-input');
        const subtotalSpan = document.getElementById('subtotal');
        const feeSpan = document.getElementById('fee');
        const totalSpan = document.getElementById('total');
        const submitBtn = document.getElementById('submit-btn');
        const paymentMethodSelect = document.getElementById('payment-method-select');
        const providerSelect = document.getElementById('provider-select');
        const paymentMethodInput = document.getElementById('payment-method-input');
        const providerInput = document.getElementById('provider-input');

        // Fungsi global untuk update dari Alpine
        window.updateTickets = function() {
            // Kumpulkan data dari semua Alpine components
            const categories = [];
            document.querySelectorAll('[x-data]').forEach(el => {
                if (el.__x && el.__x.$data.category) {
                    const data = el.__x.$data;
                    if (data.qty > 0) {
                        categories.push({
                            category: data.category,
                            quantity: data.qty,
                            price: data.price,
                            subtotal: data.qty * data.price
                        });
                    }
                }
            });
            
            tickets = categories;
            calculateTotal();
        };

        function calculateTotal() {
            // Hitung subtotal
            const subtotal = tickets.reduce((sum, item) => sum + (item.quantity * item.price), 0);
            const fee = Math.round(subtotal * 0.02); // Biaya layanan 2%
            total = subtotal + fee;
            const totalQty = tickets.reduce((sum, item) => sum + item.quantity, 0);

            // Update display
            subtotalSpan.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
            feeSpan.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(fee);
            totalSpan.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);

            // Update hidden inputs
            ticketsInput.value = JSON.stringify(tickets);
            totalPriceInput.value = total;
            totalQuantityInput.value = totalQty;

            // Update submit button
            updateSubmitButton();
        }

        function updateSubmitButton() {
            const canSubmit = tickets.length > 0 && 
                            paymentMethodSelect.value && 
                            providerSelect.value;
            if (submitBtn) submitBtn.disabled = !canSubmit;
        }

        // Payment method handlers
        if (paymentMethodSelect) {
            paymentMethodSelect.addEventListener('change', function() {
                const method = this.value;
                
                providerSelect.innerHTML = '<option value="">Pilih Provider</option>';
                providerSelect.disabled = !method;

                const providers = {
                    'ewallet': ['gopay', 'ovo', 'dana'],
                    'virtual_account': ['bca', 'mandiri', 'bri'],
                    'qris': ['qris'],
                    'transfer_bank': ['bca', 'mandiri', 'bni']
                };

                if (method && providers[method]) {
                    providers[method].forEach(p => {
                        const option = document.createElement('option');
                        option.value = p;
                        option.textContent = p.toUpperCase();
                        providerSelect.appendChild(option);
                    });
                }

                paymentMethodInput.value = method;
                updateSubmitButton();
            });
        }

        if (providerSelect) {
            providerSelect.addEventListener('change', function() {
                providerInput.value = this.value;
                updateSubmitButton();
            });
        }

        // Form validation
        const orderForm = document.getElementById('order-form');
        if (orderForm) {
            orderForm.addEventListener('submit', function(e) {
                if (tickets.length === 0) {
                    e.preventDefault();
                    alert('Silakan pilih minimal 1 tiket');
                    return;
                }

                if (!paymentMethodSelect.value) {
                    e.preventDefault();
                    alert('Silakan pilih metode pembayaran');
                    return;
                }

                if (!providerSelect.value) {
                    e.preventDefault();
                    alert('Silakan pilih provider');
                    return;
                }
            });
        }
    });
</script>
@endpush

@push('styles')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
@endpush