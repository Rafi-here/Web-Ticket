@extends('layouts.app')

@section('title', 'Pilih Kursi')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Progress Steps -->
            <div class="mb-8">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center text-blue-600">
                        <span class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</span>
                        <span class="ml-2 font-medium">Pilih Kursi</span>
                    </div>
                    <div class="w-16 h-1 bg-blue-600"></div>
                    <div class="flex items-center text-gray-400">
                        <span class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center font-bold">2</span>
                        <span class="ml-2 font-medium">Pembayaran</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-300 dark:bg-gray-700"></div>
                    <div class="flex items-center text-gray-400">
                        <span class="w-8 h-8 bg-gray-200 dark:bg-gray-700 rounded-full flex items-center justify-center font-bold">3</span>
                        <span class="ml-2 font-medium">Selesai</span>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Seat Selection -->
                <div class="lg:col-span-2">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Pilih Kursi</h2>

                        <!-- Screen -->
                        <div class="mb-8">
                            <div class="w-full h-2 bg-gradient-to-r from-gray-400 to-gray-600 rounded-full mb-2"></div>
                            <p class="text-center text-sm text-gray-500 dark:text-gray-400">LAYAR</p>
                        </div>

                        <!-- Seat Grid -->
                        <div class="grid grid-cols-12 gap-2 mb-8" id="seat-grid">
                            @foreach ($seats as $seat)
                                <button type="button"
                                    class="seat-btn aspect-square rounded-lg text-xs font-medium transition-all duration-200
                                    {{ $seat['available']
                                        ? 'bg-gray-200 dark:bg-gray-700 hover:bg-blue-500 hover:text-white'
                                        : 'bg-red-200 dark:bg-red-900 cursor-not-allowed opacity-50' }}"
                                    data-seat="{{ $seat['seat'] }}" 
                                    data-price="{{ $seat['price'] }}"
                                    {{ !$seat['available'] ? 'disabled' : '' }}>
                                    {{ $seat['seat'] }}
                                </button>
                            @endforeach
                        </div>

                        <!-- Legend -->
                        <div class="flex items-center justify-center gap-6">
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-gray-200 dark:bg-gray-700 rounded-lg mr-2"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Tersedia</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-blue-500 rounded-lg mr-2"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Dipilih</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-6 h-6 bg-red-200 dark:bg-red-900 rounded-lg mr-2"></div>
                                <span class="text-sm text-gray-600 dark:text-gray-400">Terisi</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 sticky top-24">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Ringkasan Pesanan</h2>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Film</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $showtime->film->title }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Bioskop</span>
                                <span class="font-medium text-gray-900 dark:text-white">{{ $showtime->cinema->name }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Tanggal</span>
                                <span class="font-medium text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($showtime->show_date)->format('d M Y') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Jam</span>
                                <span class="font-medium text-gray-900 dark:text-white">
                                    {{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }} WIB
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Harga per Tiket</span>
                                <span class="font-medium text-gray-900 dark:text-white">
                                    Rp {{ number_format($showtime->price, 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Jumlah Tiket</span>
                                <span class="font-medium text-gray-900 dark:text-white" id="selected-qty-display">0 / {{ $qty }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600 dark:text-gray-400">Kursi</span>
                                <span class="font-medium text-gray-900 dark:text-white" id="selected-seats-display">-</span>
                            </div>
                            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                                <div class="flex justify-between">
                                    <span class="text-lg font-bold text-gray-900 dark:text-white">Total</span>
                                    <span class="text-2xl font-bold text-green-600 dark:text-green-400" id="total-price-display">
                                        Rp 0
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- 🔥 FORM SEDERHANA - TANPA JAVASCRIPT RUMIT -->
                        <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                            @csrf
                            <input type="hidden" name="showtime_id" value="{{ $showtime->id }}">
                            <input type="hidden" name="seats" id="selected-seats-input" value="">
                            <input type="hidden" name="quantity" id="selected-quantity-input" value="0">
                            <input type="hidden" name="total_price" id="total-price-input" value="0">
                            <input type="hidden" name="payment_method" id="payment-method-input" value="">
                            <input type="hidden" name="provider" id="provider-input" value="">

                            <!-- Pilih Metode Pembayaran -->
                            <div class="mb-6">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                    Metode Pembayaran
                                </label>
                                <select id="payment-method-select" 
                                    class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 mb-2">
                                    <option value="">Pilih Metode</option>
                                    <option value="ewallet">E-Wallet</option>
                                    <option value="virtual_account">Virtual Account</option>
                                    <option value="qris">QRIS</option>
                                    <option value="transfer_bank">Transfer Bank</option>
                                </select>

                                <select id="provider-select" disabled
                                    class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option value="">Pilih Provider</option>
                                </select>
                            </div>

                            <!-- Tombol Submit -->
                            <button type="submit" id="submit-btn" disabled
                                class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                Lanjut ke Pembayaran
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    // 🔥 SCRIPT SEDERHANA - PASTI JALAN
    document.addEventListener('DOMContentLoaded', function() {
        console.log('✅ Script dimuat!');
        
        // Data
        let selectedSeats = [];
        const pricePerSeat = {{ $showtime->price }};
        const maxSeats = {{ $qty }};
        
        // Ambil semua elemen yang diperlukan
        const seatButtons = document.querySelectorAll('.seat-btn:not([disabled])');
        const selectedQtyDisplay = document.getElementById('selected-qty-display');
        const selectedSeatsDisplay = document.getElementById('selected-seats-display');
        const totalPriceDisplay = document.getElementById('total-price-display');
        const submitBtn = document.getElementById('submit-btn');
        
        // Hidden inputs
        const selectedSeatsInput = document.getElementById('selected-seats-input');
        const selectedQuantityInput = document.getElementById('selected-quantity-input');
        const totalPriceInput = document.getElementById('total-price-input');
        const paymentMethodInput = document.getElementById('payment-method-input');
        const providerInput = document.getElementById('provider-input');
        
        // Selects
        const paymentMethodSelect = document.getElementById('payment-method-select');
        const providerSelect = document.getElementById('provider-select');
        
        console.log('Jumlah kursi tersedia:', seatButtons.length);
        
        // Fungsi update tampilan
        function updateDisplay() {
            // Update display
            if (selectedQtyDisplay) {
                selectedQtyDisplay.textContent = selectedSeats.length + ' / ' + maxSeats;
            }
            
            if (selectedSeatsDisplay) {
                selectedSeatsDisplay.textContent = selectedSeats.length ? selectedSeats.join(', ') : '-';
            }
            
            const total = selectedSeats.length * pricePerSeat;
            if (totalPriceDisplay) {
                totalPriceDisplay.textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            }
            
            // Update hidden inputs
            if (selectedSeatsInput) {
                selectedSeatsInput.value = JSON.stringify(selectedSeats);
            }
            
            if (selectedQuantityInput) {
                selectedQuantityInput.value = selectedSeats.length;
            }
            
            if (totalPriceInput) {
                totalPriceInput.value = total;
            }
            
            // Cek apakah semua syarat terpenuhi
            const canSubmit = selectedSeats.length === maxSeats && 
                              paymentMethodSelect.value && 
                              providerSelect.value;
            
            if (submitBtn) {
                submitBtn.disabled = !canSubmit;
            }
            
            console.log('Update:', {
                selected: selectedSeats.length,
                max: maxSeats,
                method: paymentMethodSelect.value,
                provider: providerSelect.value,
                canSubmit: canSubmit
            });
        }
        
        // Event listener untuk kursi
        seatButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const seat = this.dataset.seat;
                console.log('Kursi diklik:', seat);
                
                if (this.classList.contains('bg-blue-500')) {
                    // Deselect
                    this.classList.remove('bg-blue-500', 'text-white');
                    this.classList.add('bg-gray-200', 'dark:bg-gray-700');
                    selectedSeats = selectedSeats.filter(s => s !== seat);
                } else {
                    // Select
                    if (selectedSeats.length >= maxSeats) {
                        alert('Anda hanya bisa memilih ' + maxSeats + ' kursi');
                        return;
                    }
                    this.classList.remove('bg-gray-200', 'dark:bg-gray-700');
                    this.classList.add('bg-blue-500', 'text-white');
                    selectedSeats.push(seat);
                }
                
                updateDisplay();
            });
        });
        
        // Event listener untuk metode pembayaran
        if (paymentMethodSelect) {
            paymentMethodSelect.addEventListener('change', function() {
                const method = this.value;
                console.log('Metode dipilih:', method);
                
                // Kosongkan provider select
                providerSelect.innerHTML = '<option value="">Pilih Provider</option>';
                providerSelect.disabled = !method;
                
                // Tambah opsi provider sesuai metode
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
                
                // Update hidden input
                if (paymentMethodInput) {
                    paymentMethodInput.value = method;
                }
                
                updateDisplay();
            });
        }
        
        // Event listener untuk provider
        if (providerSelect) {
            providerSelect.addEventListener('change', function() {
                console.log('Provider dipilih:', this.value);
                
                if (providerInput) {
                    providerInput.value = this.value;
                }
                
                updateDisplay();
            });
        }
        
        // Validasi form sebelum submit
        const paymentForm = document.getElementById('payment-form');
        if (paymentForm) {
            paymentForm.addEventListener('submit', function(e) {
                console.log('Form akan disubmit');
                
                // Validasi terakhir
                if (selectedSeats.length !== maxSeats) {
                    e.preventDefault();
                    alert('Silakan pilih ' + maxSeats + ' kursi');
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
                
                console.log('✅ Form valid, melanjutkan ke payment.process');
            });
        }
        
        // Update awal
        updateDisplay();
    });
</script>
@endpush