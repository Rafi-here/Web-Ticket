@extends('layouts.admin')

@section('title', 'Kelola Jadwal Tayang')

@section('content')
    <div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Jadwal Tayang</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Kelola semua jadwal film yang tayang</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('admin.showtimes.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Jadwal
                    </a>
                </div>
            </div>

            <!-- Filter Section -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8 border border-gray-200 dark:border-gray-700">
                <form action="{{ route('admin.showtimes.index') }}" method="GET"
                    class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Film</label>
                        <select name="film_id"
                            class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Film</option>
                            @foreach ($films ?? [] as $film)
                                <option value="{{ $film->id }}" {{ request('film_id') == $film->id ? 'selected' : '' }}>
                                    {{ $film->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bioskop</label>
                        <select name="cinema_id"
                            class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Bioskop</option>
                            @foreach ($cinemas ?? [] as $cinema)
                                <option value="{{ $cinema->id }}"
                                    {{ request('cinema_id') == $cinema->id ? 'selected' : '' }}>
                                    {{ $cinema->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Tanggal</label>
                        <input type="date" name="show_date" value="{{ request('show_date') }}"
                            class="w-full px-4 py-2 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            <svg class="w-5 h-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('admin.showtimes.index') }}"
                            class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div
                class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden border border-gray-200 dark:border-gray-700">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Film</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Bioskop</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Tanggal & Jam</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Harga</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Kursi</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @forelse($showtimes ?? [] as $showtime)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <img class="h-10 w-10 rounded-lg object-cover"
                                                    src="{{ $showtime->film->poster ? Storage::url($showtime->film->poster) : 'https://via.placeholder.com/40x40' }}"
                                                    alt="">
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900 dark:text-white">
                                                    {{ $showtime->film->title }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ $showtime->film->duration }} min
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">{{ $showtime->cinema->name }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $showtime->cinema->city }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900 dark:text-white">
                                            {{ \Carbon\Carbon::parse($showtime->show_date)->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }} WIB
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-green-600 dark:text-green-400">
                                            Rp {{ number_format($showtime->price, 0, ',', '.') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-sm font-medium text-gray-900 dark:text-white mr-2">
                                                {{ $showtime->available_seats }}/{{ $showtime->total_seats }}
                                            </span>
                                            <div class="w-16 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                                                @php
                                                    $percentage =
                                                        $showtime->total_seats > 0
                                                            ? ($showtime->available_seats / $showtime->total_seats) *
                                                                100
                                                            : 0;

                                                    $barColor =
                                                        $percentage > 50
                                                            ? 'bg-green-500'
                                                            : ($percentage > 20
                                                                ? 'bg-yellow-500'
                                                                : 'bg-red-500');
                                                @endphp
                                                <div class="h-full {{ $barColor }} rounded-full"
                                                    style="width: {{ $percentage }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('admin.showtimes.edit', $showtime->id) }}"
                                                class="text-yellow-600 hover:text-yellow-900 dark:text-yellow-400 dark:hover:text-yellow-300 transition transform hover:scale-110"
                                                title="Edit">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>

                                            <a href="#" onclick="viewDetails({{ $showtime->id }})"
                                                class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 transition transform hover:scale-110"
                                                title="Detail">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <form action="{{ route('admin.showtimes.destroy', $showtime->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300 transition transform hover:scale-110"
                                                    title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-16 h-16 text-gray-400 mb-4" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Belum Ada
                                                Jadwal</h3>
                                            <p class="text-gray-500 dark:text-gray-400 mb-4">Mulai tambahkan jadwal tayang
                                                film</p>
                                            <a href="{{ route('admin.showtimes.create') }}"
                                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Jadwal
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if (isset($showtimes) && $showtimes->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                        {{ $showtimes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
        aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"
                onclick="closeModal()"></div>

            <div
                class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white mb-4" id="modal-title">
                                Detail Jadwal Tayang
                            </h3>

                            <div id="modalContent" class="space-y-3">
                                <!-- Content will be loaded dynamically -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="button" onclick="closeModal()"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:w-auto sm:text-sm dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-700">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function viewDetails(id) {
            @foreach ($showtimes ?? [] as $showtime)
                if (id == {{ $showtime->id }}) {
                    const modal = document.getElementById('detailModal');
                    const content = document.getElementById('modalContent');

                    // 🔥 FIX: Hindari duplikasi parsing tanggal di JavaScript
                    content.innerHTML = `
                        <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="grid grid-cols-3 gap-2 text-sm">
                                <div class="font-medium text-gray-600 dark:text-gray-400">Film:</div>
                                <div class="col-span-2 text-gray-900 dark:text-white">{{ $showtime->film->title }}</div>
                                
                                <div class="font-medium text-gray-600 dark:text-gray-400">Bioskop:</div>
                                <div class="col-span-2 text-gray-900 dark:text-white">{{ $showtime->cinema->name }}</div>
                                
                                <div class="font-medium text-gray-600 dark:text-gray-400">Lokasi:</div>
                                <div class="col-span-2 text-gray-900 dark:text-white">{{ $showtime->cinema->city }}</div>
                                
                                <div class="font-medium text-gray-600 dark:text-gray-400">Tanggal:</div>
                                <div class="col-span-2 text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($showtime->show_date)->format('d M Y') }}</div>
                                
                                <div class="font-medium text-gray-600 dark:text-gray-400">Jam:</div>
                                <div class="col-span-2 text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($showtime->show_time)->format('H:i') }} WIB</div>
                                
                                <div class="font-medium text-gray-600 dark:text-gray-400">Harga:</div>
                                <div class="col-span-2 text-gray-900 dark:text-white font-semibold text-green-600">Rp {{ number_format($showtime->price, 0, ',', '.') }}</div>
                                
                                <div class="font-medium text-gray-600 dark:text-gray-400">Kursi:</div>
                                <div class="col-span-2 text-gray-900 dark:text-white">{{ $showtime->available_seats }}/{{ $showtime->total_seats }}</div>
                                
                                <div class="font-medium text-gray-600 dark:text-gray-400">Dibuat:</div>
                                <div class="col-span-2 text-gray-900 dark:text-white">{{ $showtime->created_at->format('d M Y H:i') }}</div>
                                
                                <div class="font-medium text-gray-600 dark:text-gray-400">Diupdate:</div>
                                <div class="col-span-2 text-gray-900 dark:text-white">{{ $showtime->updated_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                    `;

                    modal.classList.remove('hidden');
                }
            @endforeach
        }

        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }

        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target == modal) {
                modal.classList.add('hidden');
            }
        }
    </script>
@endpush
