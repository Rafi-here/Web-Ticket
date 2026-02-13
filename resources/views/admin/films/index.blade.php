@extends('layouts.admin')

@section('title', 'Manage Films')
@section('header', 'Films')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
            <h2 class="text-xl font-semibold">All Films</h2>
            <div class="flex space-x-3">
                <a href="{{ route('admin.films.create') }}"
                    class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    Add New Film
                </a>
            </div>
        </div>

        <div class="p-6">
            <!-- Filters & Search -->
            <div class="mb-4 flex flex-wrap gap-4">
                <input type="text" id="searchInput" placeholder="Search films..."
                    class="flex-1 min-w-[200px] px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">

                <select id="statusFilter"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="all">All Status</option>
                    <option value="now_playing">Now Playing</option>
                    <option value="coming_soon">Coming Soon</option>
                </select>

                <select id="categoryFilter"
                    class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="all">All Categories</option>
                    @foreach ($categories ?? [] as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Poster</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Title</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Genre</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Duration</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Rating</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Category</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($films as $film)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <img src="{{ $film->poster ? Storage::url($film->poster) : 'https://via.placeholder.com/50x70' }}"
                                        alt="{{ $film->title }}" class="h-14 w-10 object-cover rounded">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $film->title }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $film->genre }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $film->duration }} min</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $film->rating_age ?? 'SU' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $film->category->name ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 py-1 text-xs rounded-full {{ $film->status === 'now_playing' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' }}">
                                        {{ str_replace('_', ' ', ucfirst($film->status)) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('admin.films.show', $film) }}"
                                        class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-300 mr-3">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.films.edit', $film) }}"
                                        class="text-blue-600 hover:text-blue-900 dark:text-blue-400 dark:hover:text-blue-300 mr-3">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                    </a>
                                    <button onclick="confirmDelete({{ $film->id }})"
                                        class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300">
                                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                    <form id="delete-form-{{ $film->id }}"
                                        action="{{ route('admin.films.destroy', $film) }}" method="POST" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No films found. <a href="{{ route('admin.films.create') }}"
                                        class="text-blue-600 hover:underline">Create one now</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $films->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white dark:bg-gray-800 rounded-lg p-6 max-w-sm mx-auto">
            <h3 class="text-lg font-semibold mb-4">Confirm Delete</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-6">Are you sure you want to delete this film? This action cannot
                be undone.</p>
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
            document.getElementById('searchInput').addEventListener('keyup', filterTable);
            document.getElementById('statusFilter').addEventListener('change', filterTable);
            document.getElementById('categoryFilter').addEventListener('change', filterTable);

            function filterTable() {
                let searchTerm = document.getElementById('searchInput').value.toLowerCase();
                let statusFilter = document.getElementById('statusFilter').value;
                let categoryFilter = document.getElementById('categoryFilter').value;
                let tableRows = document.querySelectorAll('tbody tr');

                tableRows.forEach(row => {
                    let text = row.textContent.toLowerCase();
                    let status = row.querySelector('td:nth-child(7) span')?.textContent.trim().toLowerCase().replace(
                        ' ', '_');
                    let category = row.querySelector('td:nth-child(6)')?.textContent.trim();

                    let matchesSearch = text.includes(searchTerm);
                    let matchesStatus = statusFilter === 'all' || status === statusFilter;
                    let matchesCategory = categoryFilter === 'all' || category.includes(categoryFilter);

                    row.style.display = matchesSearch && matchesStatus && matchesCategory ? '' : 'none';
                });
            }
        </script>
    @endpush
@endsection
