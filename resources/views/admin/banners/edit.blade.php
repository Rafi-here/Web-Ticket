@extends('layouts.admin')

@section('title', 'Edit Banner')
@section('header', 'Edit Banner')

@section('content')
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow">
        <div class="p-6">
            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Image Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Banner Image</label>
                    <div class="flex items-center space-x-4">
                        <div class="flex-1">
                            <input type="file" name="image" id="image" accept="image/*"
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('image') border-red-500 @enderror"
                                onchange="previewImage(this)">
                            @error('image')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="flex-shrink-0">
                            <img id="preview"
                                src="{{ $banner->image ? Storage::url($banner->image) : 'https://via.placeholder.com/120x60' }}"
                                alt="Preview" class="h-15 w-30 object-cover rounded border border-gray-300">
                        </div>
                    </div>
                    <p class="mt-1 text-sm text-gray-500">Leave empty to keep current image</p>
                </div>

                <!-- Title -->
                <div class="mb-6">
                    <label for="title"
                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $banner->title) }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white @error('title') border-red-500 @enderror"
                        required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Subtitle -->
                <div class="mb-6">
                    <label for="subtitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Subtitle
                        (Optional)</label>
                    <input type="text" name="subtitle" id="subtitle" value="{{ old('subtitle', $banner->subtitle) }}"
                        class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    @error('subtitle')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Order & Status -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="order"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Display Order</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $banner->order) }}"
                            min="0"
                            class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status</label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="1"
                                    {{ old('is_active', $banner->is_active) == '1' ? 'checked' : '' }}
                                    class="form-radio text-blue-600">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Active</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="is_active" value="0"
                                    {{ old('is_active', $banner->is_active) == '0' ? 'checked' : '' }}
                                    class="form-radio text-blue-600">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Inactive</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.banners.index') }}"
                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Cancel</a>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Update
                        Banner</button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            function previewImage(input) {
                const preview = document.getElementById('preview');
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
