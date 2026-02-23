@extends('layouts.app')

@section('title', $event->title)

@section('content')
    <!-- Hero Section -->
    <div class="relative h-[400px] md:h-[500px] overflow-hidden">
        <img src="{{ $event->poster ? Storage::url($event->poster) : 'https://via.placeholder.com/1200x500?text=Event' }}"
            alt="{{ $event->title }}" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent"></div>

        <div class="absolute bottom-0 left-0 right-0 p-6 md:p-12 text-white">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-3 py-1 bg-gradient-to-r from-red-600 to-red-700 rounded-full text-sm font-semibold">
                        {{ $event->category }}
                    </span>
                    <span class="px-3 py-1 bg-blue-600 rounded-full text-sm">{{ $event->age_rating ?? 'SU' }}</span>
                    @if ($event->status == 'upcoming')
                        <span class="px-3 py-1 bg-green-600 rounded-full text-sm">Mendatang</span>
                    @elseif($event->status == 'ongoing')
                        <span class="px-3 py-1 bg-yellow-600 rounded-full text-sm">Berlangsung</span>
                    @elseif($event->status == 'ended')
                        <span class="px-3 py-1 bg-gray-600 rounded-full text-sm">Selesai</span>
                    @elseif($event->status == 'cancelled')
                        <span class="px-3 py-1 bg-red-600 rounded-full text-sm">Dibatalkan</span>
                    @endif
                </div>
                <h1 class="text-3xl md:text-5xl font-bold mb-4">{{ $event->title }}</h1>
                <div class="flex flex-wrap items-center gap-4 text-sm md:text-base">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($event->event_date)->format('l, d F Y') }}
                    </span>
                    <span>•</span>
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ \Carbon\Carbon::parse($event->event_time)->format('H:i') }} WIB
                    </span>
                    @if ($event->duration)
                        <span>•</span>
                        <span class="flex items-center">
                            <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $event->duration }} menit
                        </span>
                    @endif
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
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                        {{ $event->description }}</p>
                </div>

                <!-- Artists / Lineup -->
                @if ($event->artists)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                        <h2 class="text-xl font-semibold mb-4">Lineup Artis</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach (json_decode($event->artists) as $artist)
                                <span
                                    class="px-4 py-2 bg-gradient-to-r from-blue-100 to-purple-100 dark:from-blue-900 dark:to-purple-900 text-blue-800 dark:text-blue-200 rounded-full text-sm font-medium">
                                    {{ $artist }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Venue Details -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 mb-6">
                    <h2 class="text-xl font-semibold mb-4">Lokasi</h2>
                    <div class="flex items-start">
                        <div
                            class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">{{ $event->venue }}</h3>
                            <p class="text-gray-600 dark:text-gray-400">{{ $event->address ?? $event->venue }},
                                {{ $event->city }}</p>
                            @if ($event->address)
                                <a href="https://maps.google.com/?q={{ urlencode($event->address) }}" target="_blank"
                                    class="inline-flex items-center mt-2 text-blue-600 hover:text-blue-700 text-sm">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Lihat di Google Maps
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Ticket Selection -->
            <div class="lg:col-span-1">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 sticky top-24">
                    <h2 class="text-xl font-semibold mb-4">Pilih Tiket</h2>

                    @php
                        $isEventAvailable =
                            $event->status === 'upcoming' &&
                            \Carbon\Carbon::parse($event->event_date)->greaterThanOrEqualTo(now());
                    @endphp

                    @if ($isEventAvailable && $event->ticketCategories->count() > 0)
                        <form action="{{ route('event.order.process') }}" method="POST" id="order-form">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <input type="hidden" name="tickets" id="tickets-input" value="[]">
                            <input type="hidden" name="total_price" id="total-price-input" value="0">
                            <input type="hidden" name="quantity" id="total-quantity-input" value="0">
                            <input type="hidden" name="payment_method" id="payment-method-input" value="">
                            <input type="hidden" name="provider" id="provider-input" value="">
                            <input type="hidden" name="order_method" id="order-method" value="online">

                            <!-- Ticket Categories -->
                            <div class="space-y-4 mb-6">
                                @foreach ($event->ticketCategories as $category)
                                    <div
                                        class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:border-blue-500 transition">
                                        <div class="flex justify-between items-start mb-3">
                                            <div>
                                                <h3 class="font-semibold text-lg">{{ $category->name }}</h3>
                                                @if ($category->description)
                                                    <p class="text-sm text-gray-600 dark:text-gray-400">
                                                        {{ $category->description }}</p>
                                                @endif
                                                @if ($category->benefits)
                                                    <div class="mt-2 text-xs text-green-600 dark:text-green-400">
                                                        @foreach (json_decode($category->benefits) as $benefit)
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
                                                    Sisa: <span
                                                        class="font-semibold {{ $category->available < 20 ? 'text-red-500' : 'text-green-500' }}">
                                                        {{ $category->available }}
                                                    </span>
                                                </p>
                                            </div>
                                        </div>

                                        <!-- Quantity Selector -->
                                        @if ($category->available > 0)
                                            <div
                                                class="flex items-center justify-between mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                                                <span class="text-sm text-gray-600 dark:text-gray-400">Jumlah:</span>
                                                <div
                                                    class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                                    <button type="button"
                                                        class="qty-decrease px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition text-gray-700 dark:text-gray-300 font-bold">
                                                        -
                                                    </button>
                                                    <input type="number"
                                                        class="qty-input w-16 text-center border-x border-gray-300 dark:border-gray-600 py-2 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none"
                                                        value="0" min="0"
                                                        max="{{ min($category->available, $category->max_per_order) }}"
                                                        data-category="{{ $category->name }}" readonly>
                                                    <button type="button"
                                                        class="qty-increase px-3 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition text-gray-700 dark:text-gray-300 font-bold">
                                                        +
                                                    </button>
                                                </div>
                                            </div>
                                        @else
                                            <div
                                                class="text-center py-2 bg-gray-200 dark:bg-gray-700 rounded-lg text-gray-600 dark:text-gray-400 font-semibold mt-3">
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

                            <!-- Method Selector - TAMBAHAN BARU -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                    Metode Pemesanan
                                </label>
                                <div class="grid grid-cols-2 gap-3">
                                    <button type="button" id="method-online"
                                        class="method-selector px-4 py-3 border-2 border-blue-600 bg-blue-50 dark:bg-blue-900/20 text-blue-700 dark:text-blue-300 rounded-lg font-medium transition-all">
                                        <span class="block text-sm">Pembayaran Online</span>
                                    </button>
                                    <button type="button" id="method-wa"
                                        class="method-selector px-4 py-3 border-2 border-gray-300 dark:border-gray-600 hover:border-green-500 text-gray-700 dark:text-gray-300 rounded-lg font-medium transition-all">
                                        <span class="block text-sm">Pesan via WhatsApp</span>
                                    </button>
                                </div>
                            </div>

                            <!-- Payment Method Section (untuk online) -->
                            <div id="payment-section" class="mb-6">
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

                            <!-- WhatsApp Section (hidden by default) -->
                            <div id="whatsapp-section" class="mb-6 hidden">
                                <div
                                    class="p-4 bg-green-50 dark:bg-green-900/20 rounded-lg border border-green-200 dark:border-green-800">
                                    <div class="flex items-start">
                                        <svg class="w-6 h-6 text-green-600 dark:text-green-400 mr-3 flex-shrink-0"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        <div>
                                            <h4 class="font-semibold text-green-800 dark:text-green-300">Pemesanan via
                                                WhatsApp</h4>
                                            <p class="text-sm text-green-700 dark:text-green-400 mt-1">
                                                Anda akan diarahkan ke WhatsApp untuk melakukan pemesanan. Admin akan
                                                mengkonfirmasi ketersediaan tiket.
                                            </p>
                                        </div>
                                    </div>
                                </div>
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
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-gray-500 dark:text-gray-400 mb-2">Tiket belum tersedia</p>
                            <p class="text-sm text-gray-400 dark:text-gray-500">Silakan cek kembali nanti</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Related Events -->
        @if (isset($relatedEvents) && $relatedEvents->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">Event Lainnya</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($relatedEvents as $related)
                        <a href="{{ route('events.show', $related->slug) }}" class="group">
                            <div class="relative overflow-hidden rounded-lg aspect-[2/3]">
                                <img src="{{ $related->poster ? Storage::url($related->poster) : 'https://via.placeholder.com/300x450' }}"
                                    alt="{{ $related->title }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div
                                    class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/70 to-transparent">
                                    <h3 class="text-white font-semibold text-sm">{{ $related->title }}</h3>
                                    <p class="text-xs text-gray-300">
                                        {{ \Carbon\Carbon::parse($related->event_date)->format('d M Y') }}</p>
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
            console.log('✅ Script order dimuat!');

            // Data
            let selectedTickets = [];

            // Harga per kategori
            const prices = {
                @foreach ($event->ticketCategories as $category)
                    '{{ $category->name }}': {{ $category->price }},
                @endforeach
            };

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
            const orderForm = document.getElementById('order-form');

            // Elements for method selector
            const methodOnline = document.getElementById('method-online');
            const methodWA = document.getElementById('method-wa');
            const paymentSection = document.getElementById('payment-section');
            const waSection = document.getElementById('whatsapp-section');
            const orderMethod = document.getElementById('order-method');

            // Fungsi untuk menghitung total
            function calculateTotal() {
                let subtotal = 0;
                let totalQty = 0;

                // Hitung dari semua input qty
                document.querySelectorAll('.qty-input').forEach(input => {
                    const qty = parseInt(input.value) || 0;
                    const category = input.dataset.category;
                    const price = prices[category] || 0;

                    subtotal += qty * price;
                    totalQty += qty;
                });

                const fee = Math.round(subtotal * 0.02); // Biaya layanan 2%
                const total = subtotal + fee;

                // Update display
                subtotalSpan.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(subtotal);
                feeSpan.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(fee);
                totalSpan.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);

                // Update hidden inputs
                const tickets = [];
                document.querySelectorAll('.qty-input').forEach(input => {
                    const qty = parseInt(input.value) || 0;
                    if (qty > 0) {
                        tickets.push({
                            category: input.dataset.category,
                            quantity: qty,
                            price: prices[input.dataset.category],
                            subtotal: qty * prices[input.dataset.category]
                        });
                    }
                });

                ticketsInput.value = JSON.stringify(tickets);
                totalPriceInput.value = total;
                totalQuantityInput.value = totalQty;

                console.log('💰 Total:', total, 'Jumlah tiket:', totalQty);

                updateSubmitButton();
            }

            // Fungsi update button
            function updateSubmitButton() {
                const totalQty = parseInt(totalQuantityInput.value) || 0;
                const method = orderMethod.value;

                let canSubmit = totalQty > 0;

                if (method === 'online') {
                    const metodeDipilih = paymentMethodSelect && paymentMethodSelect.value !== '';
                    const providerDipilih = providerSelect && providerSelect.value !== '';
                    canSubmit = canSubmit && metodeDipilih && providerDipilih;
                }

                submitBtn.disabled = !canSubmit;
                console.log('🔘 Status submit:', canSubmit, 'Method:', method);
            }

            // Event listener untuk tombol +/- 
            document.querySelectorAll('.qty-decrease').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('.qty-input');
                    let value = parseInt(input.value) || 0;
                    if (value > 0) {
                        input.value = value - 1;
                        calculateTotal();
                    }
                });
            });

            document.querySelectorAll('.qty-increase').forEach(btn => {
                btn.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('.qty-input');
                    const max = parseInt(input.getAttribute('max')) || 999;
                    let value = parseInt(input.value) || 0;
                    if (value < max) {
                        input.value = value + 1;
                        calculateTotal();
                    }
                });
            });

            // Method selector handlers
            if (methodOnline && methodWA) {
                methodOnline.addEventListener('click', function() {
                    methodOnline.classList.remove('border-gray-300', 'hover:border-green-500');
                    methodOnline.classList.add('border-blue-600', 'bg-blue-50', 'dark:bg-blue-900/20',
                        'text-blue-700');

                    methodWA.classList.remove('border-blue-600', 'bg-blue-50', 'dark:bg-blue-900/20',
                        'text-blue-700');
                    methodWA.classList.add('border-gray-300', 'hover:border-green-500');

                    paymentSection.classList.remove('hidden');
                    waSection.classList.add('hidden');
                    orderMethod.value = 'online';

                    updateSubmitButton();
                });

                methodWA.addEventListener('click', function() {
                    methodWA.classList.remove('border-gray-300', 'hover:border-green-500');
                    methodWA.classList.add('border-green-600', 'bg-green-50', 'dark:bg-green-900/20',
                        'text-green-700');

                    methodOnline.classList.remove('border-blue-600', 'bg-blue-50', 'dark:bg-blue-900/20',
                        'text-blue-700');
                    methodOnline.classList.add('border-gray-300', 'hover:border-blue-500');

                    paymentSection.classList.add('hidden');
                    waSection.classList.remove('hidden');
                    orderMethod.value = 'wa';

                    updateSubmitButton();
                });
            }

            // Payment method handlers
            if (paymentMethodSelect) {
                paymentMethodSelect.addEventListener('change', function() {
                    const method = this.value;
                    console.log('💰 Metode dipilih:', method);

                    providerSelect.innerHTML = '<option value="">Pilih Provider</option>';

                    if (method) {
                        providerSelect.disabled = false;

                        const providers = {
                            'ewallet': ['gopay', 'ovo', 'dana'],
                            'virtual_account': ['bca', 'mandiri', 'bri'],
                            'qris': ['qris'],
                            'transfer_bank': ['bca', 'mandiri', 'bni']
                        };

                        if (providers[method]) {
                            providers[method].forEach(p => {
                                const option = document.createElement('option');
                                option.value = p;
                                option.textContent = p.toUpperCase();
                                providerSelect.appendChild(option);
                            });
                        }

                        paymentMethodInput.value = method;
                    } else {
                        providerSelect.disabled = true;
                        paymentMethodInput.value = '';
                    }

                    updateSubmitButton();
                });
            }

            if (providerSelect) {
                providerSelect.addEventListener('change', function() {
                    providerInput.value = this.value;
                    updateSubmitButton();
                });
            }

            // Form submission
            if (orderForm) {
                orderForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    console.log('📤 Form akan disubmit...');

                    const totalQty = parseInt(totalQuantityInput.value) || 0;

                    if (totalQty === 0) {
                        alert('Silakan pilih minimal 1 tiket');
                        return;
                    }

                    const method = orderMethod.value;

                    if (method === 'online') {
                        if (!paymentMethodSelect.value) {
                            alert('Silakan pilih metode pembayaran');
                            return;
                        }

                        if (!providerSelect.value) {
                            alert('Silakan pilih provider');
                            return;
                        }

                        paymentMethodInput.value = paymentMethodSelect.value;
                        providerInput.value = providerSelect.value;

                        console.log('✅ Online payment, submitting form...');
                        this.submit();

                    } else if (method === 'wa') {
                        console.log('📱 WhatsApp order');

                        fetch('/event/order/whatsapp', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    event_id: {{ $event->id }},
                                    tickets: JSON.parse(ticketsInput.value),
                                    total_price: totalPriceInput.value,
                                    quantity: totalQuantityInput.value
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    window.open(data.whatsapp_url, '_blank');
                                    alert(
                                        'Pesanan Anda telah dibuat. Silakan lanjutkan chat via WhatsApp.'
                                    );
                                } else {
                                    alert('Gagal: ' + data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Terjadi kesalahan. Silakan coba lagi.');
                            });
                    }
                });
            }

            // Initial calculation
            calculateTotal();
        });
    </script>
@endpush
