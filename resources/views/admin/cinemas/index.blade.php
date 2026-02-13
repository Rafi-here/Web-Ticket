@extends('layouts.admin')

@section('title', 'Manage Cinemas')
@section('header', 'Cinemas')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h2 class="text-xl font-semibold">All Cinemas</h2>
            <a href="{{ route('admin.cinemas.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Add New Cinema
            </a>
        </div>

        <div class="p-6">
            <!-- Search & Filters -->
            <div class="mb-4 flex flex-wrap gap-4">
                <input type="text" id="searchInput" placeholder="Search cinemas..."
                    class="flex-1 min-w-[200px] px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">

                <select id="cityFilter"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="all">All Cities</option>
                    @foreach ($cities ?? [] as $city)
                        <option value="{{ $city }}">{{ $city }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Grid View -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($cinemas as $cinema)
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden">
                        @if ($cinema->image)
                            <img src="{{ Storage::url($cinema->image) }}" alt="{{ $cinema->name }}"
                                class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                    </path>
                                </svg>
                            </div>
                        @endif

                        <div class="p-4">
                            <h3 class="font-semibold text-lg mb-1">{{ $cinema->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $cinema->city }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">{{ Str::limit($cinema->address, 50) }}
                            </p>

                            <div class="flex items-center justify-between">
                                <span class="text-xs text-gray-500">
                                    {{ $cinema->showtimes_count ?? $cinema->showtimes->count() }} showtimes
                                </span>
                                <div class="space-x-2">
                                    <a href="{{ route('admin.cinemas.edit', $cinema) }}"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete({{ $cinema->id }})"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                    <form id="delete-form-{{ $cinema->id }}"
                                        action="{{ route('admin.cinemas.destroy', $cinema) }}" method="POST"
                                        class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 text-gray-500 dark:text-gray-400">
                        No cinemas found. <a href="{{ route('admin.cinemas.create') }}"
                            class="text-blue-600 hover:underline">Add your first cinema</a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $cinemas->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm mx-auto">
            <h3 class="text-lg font-semibold mb-4">Confirm Delete</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Are you sure you want to delete this cinema? All associated
                showtimes will also be deleted.</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Cancel</button>
                <button id="confirmDeleteBtn"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Delete</button>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            let deleteId = null;

            function confirmDelete(id) {
                deleteId = id;
                document.getElementById('deleteModal').classList.remove('hidden');
                document.getElementById('deleteModal').classList.add('flex');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
                document.getElementById('deleteModal').classList.remove('flex');
                deleteId = null;
            }

            document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
                if (deleteId) {
                    document.getElementById(`delete-form-${deleteId}`).submit();
                }
            });

            // Filter functionality
            document.getElementById('searchInput').addEventListener('keyup', filterCards);
            document.getElementById('cityFilter').addEventListener('change', filterCards);

            function filterCards() {
                let searchTerm = document.getElementById('searchInput').value.toLowerCase();
                let cityFilter = document.getElementById('cityFilter').value;
                let cards = document.querySelectorAll('.grid > div');

                cards.forEach(card => {
                    let title = card.querySelector('h3')?.textContent.toLowerCase() || '';
                    let city = card.querySelector('.text-gray-600')?.textContent.toLowerCase() || '';
                    let matchesSearch = title.includes(searchTerm) || city.includes(searchTerm);
                    let matchesCity = cityFilter === 'all' || city.includes(cityFilter.toLowerCase());

                    card.style.display = matchesSearch && matchesCity ? '' : 'none';
                });
            }
        </script>
    @endpush
@endsection
