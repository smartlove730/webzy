@extends('admin.layouts.app')

@section('title', 'Edit Blog Post')
@section('page-title', 'Edit Blog Post')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('admin.blogs.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- AI Topic input for blog generation -->
                <div class="md:col-span-2">
                    <label for="ai_topic" class="block text-sm font-medium text-gray-700">AI Topic</label>
                    <input type="text" id="ai_topic"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                           placeholder="Enter a topic for AI generation">
                    <p class="text-xs text-gray-500 mt-1">Specify a topic to generate a blog post. If left blank, the current title will be used as the topic.</p>
                </div>
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $post->title) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                    <input type="text" name="slug" id="slug" value="{{ old('slug', $post->slug) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Leave blank to auto-generate">
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" id="category_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                    <select name="tags[]" id="tags" multiple
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ (collect(old('tags', $post->tags->pluck('id')->toArray()))->contains($tag->id)) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Windows) or Command (Mac) to select multiple tags.</p>
                </div>
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700">Featured Image</label>
                    @if($post->featured_image)
                        <div class="mb-2">
                            <img src="{{ asset($post->featured_image) }}" alt="Featured Image" class="h-16 w-16 object-cover rounded">
                        </div>
                    @endif
                    <input type="file" name="featured_image" id="featured_image"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="md:col-span-2">
                    <label for="short_description" class="block text-sm font-medium text-gray-700">Short Description</label>
                    <textarea name="short_description" id="short_description" rows="3"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('short_description', $post->short_description) }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" id="content" rows="8"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('content', $post->content) }}</textarea>
                </div>
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700">Meta Title</label>
                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title', $post->meta_title) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700">Meta Description</label>
                    <textarea name="meta_description" id="meta_description" rows="2"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('meta_description', $post->meta_description) }}</textarea>
                </div>
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700">Meta Keywords</label>
                    <input type="text" name="meta_keywords" id="meta_keywords" value="{{ old('meta_keywords', $post->meta_keywords) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="comma,separated,keywords">
                </div>
                <div class="flex items-center mt-4">
                    <input type="checkbox" name="is_published" id="is_published" value="1" class="h-4 w-4 text-blue-600 border-gray-300 rounded" {{ old('is_published', $post->is_published) ? 'checked' : '' }}>
                    <label for="is_published" class="ml-2 block text-sm text-gray-900">Publish</label>
                </div>
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700">Publish Date</label>
                    <input type="datetime-local" name="published_at" id="published_at" value="{{ old('published_at', optional($post->published_at)->format('Y-m-d\TH:i')) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <p class="text-xs text-gray-500 mt-1">Optional. If left blank, publication date defaults to now when publishing.</p>
                </div>
            </div>
            <div class="mt-6 flex items-center">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Post</button>
                <button type="button" id="generateBlog" class="ml-3 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Generate with AI</button>
                <a href="{{ route('admin.blogs.index') }}" class="ml-3 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.getElementById('generateBlog').addEventListener('click', function () {
                let topic = document.getElementById('ai_topic').value.trim();
                if (!topic) {
                    topic = document.getElementById('title').value.trim();
                }
                if (!topic) {
                    alert('Please enter a topic or title before generating.');
                    return;
                }
                const button = this;
                const originalText = button.innerHTML;
                button.disabled = true;
                button.innerHTML = 'Generating...';
                fetch("{{ route('admin.blogs.generate') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ topic: topic })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                        } else {
                            document.getElementById('title').value = data.title || '';
                            document.getElementById('short_description').value = data.short_description || '';
                            document.getElementById('content').value = data.content || '';
                            document.getElementById('meta_title').value = data.meta_title || '';
                            document.getElementById('meta_description').value = data.meta_description || '';
                            document.getElementById('meta_keywords').value = data.meta_keywords || '';
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        alert('An error occurred while generating the blog post.');
                    })
                    .finally(() => {
                        button.disabled = false;
                        button.innerHTML = originalText;
                    });
            });
        </script>
    @endpush
@endsection