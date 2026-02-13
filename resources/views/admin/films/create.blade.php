@extends('layouts.admin')

@section('title', 'Create Film')
@section('header', 'Create New Film')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="p-6">
            <form action="{{ route('admin.films.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div>
                        <!-- Poster Upload -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Poster</label>
                            <div class="flex items-center space-x-4">
                                <div class="flex-1">
                                    <input type="file" name="poster" id="poster" accept="image/*"
                                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('poster') border-red-500 @enderror"
                                        onchange="previewPoster(this)" required>
                                    @error('poster')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="flex-shrink-0">
                                    <img id="posterPreview" src="https://via.placeholder.com/100x150" alt="Preview"
                                        class="h-32 w-24 object-cover rounded border border-gray-300">
                                </div>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Recommended size: 300x450px. Max size: 2MB</p>
                        </div>

                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('title') border-red-500 @enderror"
                                required>
                            @error('title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Genre -->
                        <div class="mb-6">
                            <label for="genre"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Genre</label>
                            <input type="text" name="genre" id="genre" value="{{ old('genre') }}"
                                placeholder="e.g., Action, Drama, Comedy"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('genre') border-red-500 @enderror"
                                required>
                            @error('genre')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Duration & Rating -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="duration"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Duration
                                    (minutes)</label>
                                <input type="number" name="duration" id="duration" value="{{ old('duration') }}"
                                    min="1"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('duration') border-red-500 @enderror"
                                    required>
                                @error('duration')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="rating_age"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Age
                                    Rating</label>
                                <select name="rating_age" id="rating_age"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                                    <option value="SU">SU (All Ages)</option>
                                    <option value="13+">13+</option>
                                    <option value="17+">17+</option>
                                    <option value="21+">21+</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <!-- Category & Status -->
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <label for="category_id"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                                <select name="category_id" id="category_id"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('category_id') border-red-500 @enderror"
                                    required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="status"
                                    class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                                <select name="status" id="status"
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white"
                                    required>
                                    <option value="now_playing">Now Playing</option>
                                    <option value="coming_soon">Coming Soon</option>
                                </select>
                            </div>
                        </div>

                        <!-- Director -->
                        <div class="mb-6">
                            <label for="director"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Director
                                (Optional)</label>
                            <input type="text" name="director" id="director" value="{{ old('director') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Cast -->
                        <div class="mb-6">
                            <label for="cast"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Cast
                                (Optional)</label>
                            <input type="text" name="cast" id="cast" value="{{ old('cast') }}"
                                placeholder="e.g., Actor 1, Actor 2, Actor 3"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Release Date -->
                        <div class="mb-6">
                            <label for="release_date"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Release Date</label>
                            <input type="date" name="release_date" id="release_date" value="{{ old('release_date') }}"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>

                        <!-- Trailer URL -->
                        <div class="mb-6">
                            <label for="trailer_url"
                                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Trailer URL
                                (YouTube)</label>
                            <input type="url" name="trailer_url" id="trailer_url" value="{{ old('trailer_url') }}"
                                placeholder="https://youtube.com/watch?v=..."
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>
                </div>

                <!-- Synopsis (Full Width) -->
                <div class="mb-6">
                    <label for="synopsis"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Synopsis</label>
                    <textarea name="synopsis" id="synopsis" rows="6"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('synopsis') border-red-500 @enderror"
                        required>{{ old('synopsis') }}</textarea>
                    @error('synopsis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.films.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Cancel</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Create
                        Film</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewPoster(input) {
                const preview = document.getElementById('posterPreview');
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    @endpush
@endsection
