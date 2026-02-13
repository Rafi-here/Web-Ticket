@extends('layouts.app')

@section('title', 'Buy Ticket')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
            <!-- Header -->
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h1 class="text-2xl font-bold">Complete Your Purchase</h1>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8" x-data="seatSelection()">
                    <!-- Ticket Details -->
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Ticket Details</h2>

                        <div class="space-y-4">
                            <div class="flex items-center space-x-4">
                                <img src="{{ $showtime->film->poster ? Storage::url($showtime->film->poster) : 'https://via.placeholder.com/80x120' }}"
                                    alt="{{ $showtime->film->title }}" class="w-20 h-28 object-cover rounded">
                                <div>
                                    <h3 class="font-semibold">{{ $showtime->film->title }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $showtime->film->genre }}</p>
                                </div>
                            </div>

                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <dl class="space-y-2">
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Cinema</dt>
                                        <dd class="font-medium">{{ $showtime->cinema->name }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Date</dt>
                                        <dd class="font-medium">
                                            @if (is_object($showtime->show_date) && method_exists($showtime->show_date, 'format'))
                                                {{ $showtime->show_date->format('l, d F Y') }}
                                            @else
                                                {{ \Carbon\Carbon::parse($showtime->show_date)->format('l, d F Y') }}
                                            @endif
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Time</dt>
                                        <dd class="font-medium">
                                            {{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }}
                                        </dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-gray-500 dark:text-gray-400">Price per ticket</dt>
                                        <dd class="font-medium">Rp {{ number_format($showtime->price) }}</dd>
                                    </div>
                                </dl>
                            </div>

                            <!-- Seat Selection -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <h3 class="font-medium mb-3">Select Seats</h3>
                                <div class="grid grid-cols-5 gap-2">
                                    @foreach ($seats as $seat)
                                        <button type="button"
                                            @click="toggleSeat('{{ $seat['seat'] }}', {{ $seat['available'] ? 'true' : 'false' }})"
                                            :class="{
                                                'bg-blue-600 text-white': isSelected('{{ $seat['seat'] }}'),
                                                'bg-gray-200 dark:bg-gray-700 cursor-not-allowed opacity-50': {{ $seat['available'] ? 'false' : 'true' }},
                                                'bg-green-100 dark:bg-green-900 hover:bg-green-200 dark:hover:bg-green-800': {{ $seat['available'] ? 'true' : 'false' }} &&
                                                    !isSelected('{{ $seat['seat'] }}')
                                            }"
                                            class="p-2 text-xs font-medium rounded transition"
                                            {{ !$seat['available'] ? 'disabled' : '' }}>
                                            {{ $seat['seat'] }}
                                        </button>
                                    @endforeach
                                </div>
                                <div class="flex items-center space-x-4 mt-3 text-xs">
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-green-100 dark:bg-green-900 rounded mr-1"></span>
                                        <span>Available</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-blue-600 rounded mr-1"></span>
                                        <span>Selected</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="w-3 h-3 bg-gray-300 dark:bg-gray-700 rounded mr-1"></span>
                                        <span>Booked</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <div>
                        <h2 class="text-lg font-semibold mb-4">Payment Method</h2>

                        <form action="{{ route('payment.process') }}" method="POST" id="paymentForm">
                            @csrf
                            <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
                            <input type="hidden" name="seats" x-model="JSON.stringify(selectedSeats)">
                            <input type="hidden" name="quantity" x-model="selectedSeats.length">
                            <input type="hidden" name="total_price" x-model="totalPrice">

                            <!-- Payment Methods -->
                            <div class="space-y-3 mb-6">
                                <label class="block">
                                    <input type="radio" name="payment_method" value="ewallet" class="sr-only peer"
                                        @change="updateSubmitButton">
                                    <div
                                        class="p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-600">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 mr-3 text-gray-600 dark:text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                                </path>
                                            </svg>
                                            <div>
                                                <p class="font-medium">E-Wallet</p>
                                                <p class="text-sm text-gray-500">GoPay, OVO, DANA</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="block">
                                    <input type="radio" name="payment_method" value="virtual_account" class="sr-only peer"
                                        @change="updateSubmitButton">
                                    <div
                                        class="p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-600">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 mr-3 text-gray-600 dark:text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                                </path>
                                            </svg>
                                            <div>
                                                <p class="font-medium">Virtual Account</p>
                                                <p class="text-sm text-gray-500">BCA, Mandiri, BRI</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="block">
                                    <input type="radio" name="payment_method" value="qris" class="sr-only peer"
                                        @change="updateSubmitButton">
                                    <div
                                        class="p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-600">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 mr-3 text-gray-600 dark:text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z">
                                                </path>
                                            </svg>
                                            <div>
                                                <p class="font-medium">QRIS</p>
                                                <p class="text-sm text-gray-500">Scan with any QRIS app</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="block">
                                    <input type="radio" name="payment_method" value="transfer_bank"
                                        class="sr-only peer" @change="updateSubmitButton">
                                    <div
                                        class="p-4 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer peer-checked:border-blue-600 peer-checked:ring-2 peer-checked:ring-blue-600">
                                        <div class="flex items-center">
                                            <svg class="w-6 h-6 mr-3 text-gray-600 dark:text-gray-400" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z">
                                                </path>
                                            </svg>
                                            <div>
                                                <p class="font-medium">Bank Transfer</p>
                                                <p class="text-sm text-gray-500">BCA, Mandiri, BNI</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <!-- Provider Selection (dynamic) -->
                            <div id="providerSection" class="mb-6 hidden" x-data="{ showProvider: false }">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Select
                                    Provider</label>
                                <select name="provider" id="provider"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="">Select provider</option>
                                    <template x-if="$el.form?.payment_method?.value === 'ewallet'">
                                        <optgroup label="E-Wallet">
                                            <option value="gopay">GoPay</option>
                                            <option value="ovo">OVO</option>
                                            <option value="dana">DANA</option>
                                        </optgroup>
                                    </template>
                                    <template x-if="$el.form?.payment_method?.value === 'virtual_account'">
                                        <optgroup label="Virtual Account">
                                            <option value="bca">BCA</option>
                                            <option value="mandiri">Mandiri</option>
                                            <option value="bri">BRI</option>
                                        </optgroup>
                                    </template>
                                    <template x-if="$el.form?.payment_method?.value === 'transfer_bank'">
                                        <optgroup label="Bank Transfer">
                                            <option value="bca">BCA</option>
                                            <option value="mandiri">Mandiri</option>
                                            <option value="bni">BNI</option>
                                        </optgroup>
                                    </template>
                                </select>
                            </div>

                            <!-- Summary -->
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mb-6">
                                <h3 class="font-medium mb-3">Summary</h3>
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Selected Seats:</span>
                                        <span class="font-medium" x-text="selectedSeatsDisplay"></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500 dark:text-gray-400">Quantity:</span>
                                        <span class="font-medium" x-text="selectedSeats.length"></span>
                                    </div>
                                    <div class="flex justify-between text-lg font-bold">
                                        <span>Total:</span>
                                        <span class="text-blue-600" x-text="'Rp ' + totalPriceFormatted"></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" id="submitBtn" :disabled="!canSubmit"
                                class="w-full px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed">
                                Proceed to Payment
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function seatSelection() {
                return {
                    selectedSeats: [],
                    pricePerTicket: {{ $showtime->price }},

                    get totalPrice() {
                        return this.selectedSeats.length * this.pricePerTicket;
                    },

                    get totalPriceFormatted() {
                        return this.totalPrice.toLocaleString('id-ID');
                    },

                    get selectedSeatsDisplay() {
                        return this.selectedSeats.length ? this.selectedSeats.join(', ') : '-';
                    },

                    get canSubmit() {
                        return this.selectedSeats.length > 0 && document.querySelector(
                            'input[name="payment_method"]:checked');
                    },

                    toggleSeat(seat, isAvailable) {
                        if (!isAvailable) return;

                        const index = this.selectedSeats.indexOf(seat);
                        if (index === -1) {
                            this.selectedSeats.push(seat);
                        } else {
                            this.selectedSeats.splice(index, 1);
                        }
                    },

                    isSelected(seat) {
                        return this.selectedSeats.includes(seat);
                    },

                    updateSubmitButton() {
                        // This will trigger the canSubmit computed property
                    }
                }
            }

            // Handle provider section visibility
            document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const providerSection = document.getElementById('providerSection');
                    const providerSelect = document.getElementById('provider');

                    providerSelect.innerHTML = '<option value="">Select provider</option>';

                    if (this.value === 'ewallet') {
                        providerSection.classList.remove('hidden');
                        providerSelect.innerHTML += `
                    <option value="gopay">GoPay</option>
                    <option value="ovo">OVO</option>
                    <option value="dana">DANA</option>
                `;
                    } else if (this.value === 'virtual_account') {
                        providerSection.classList.remove('hidden');
                        providerSelect.innerHTML += `
                    <option value="bca">BCA</option>
                    <option value="mandiri">Mandiri</option>
                    <option value="bri">BRI</option>
                `;
                    } else if (this.value === 'transfer_bank') {
                        providerSection.classList.remove('hidden');
                        providerSelect.innerHTML += `
                    <option value="bca">BCA</option>
                    <option value="mandiri">Mandiri</option>
                    <option value="bni">BNI</option>
                `;
                    } else {
                        providerSection.classList.add('hidden');
                    }

                    // Trigger Alpine to update canSubmit
                    if (window.Alpine) {
                        Alpine.dispatch('payment-method-changed');
                    }
                });
            });
        </script>
    @endpush
@endsection
