<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-4 py-6">
        <div class="flex items-center justify-between mb-4 gap-4 flex-wrap">

            <!-- Left: Title -->
            <h2 class="text-2xl font-bold">All Categories</h2>

            <!-- Middle: Category Select Form -->
            <form action="{{ route('posts') }}" method="GET" class="flex items-center space-x-3">

                <!-- Category Dropdown -->
                <div>
                    <select name="category_id" id="category_id"
                        class="min-w-[180px] rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"  {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Button -->
                <div>
                    <button type="submit"
                        class="inline-block rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-800 transition hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        Filter
                    </button>
                </div>

            </form>

            <!-- Right: Add Post Button -->
            <a href="{{ route('posts.create') }}"
                class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                + Add Posts
            </a>

        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg mb-7">
            <table class="min-w-full table-auto border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left border">Title</th>
                        <th class="px-4 py-2 text-left border">Slug</th>
                        <th class="px-4 py-2 text-left border">Created At</th>
                        <th class="px-4 py-2 text-left border">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td class="px-4 py-2 text-left border">{{ $post->title }}</td>
                            <td class="px-4 py-2 text-left border">{{ $post->slug }}</td>
                            <td class="px-4 py-2 text-left border">
                                {{ Carbon\Carbon::parse($post->created_at)->toDateString() }}</td>
                            <td class="px-4 py-2 text-left border flex gap-2">
                                <a href="{{ route('posts.show', $post->slug) }}"
                                    class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    View
                                </a>
                                <a href="{{ route('posts.edit', $post->id) }}"
                                    class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    Edit
                                </a>
                                <form id="delete-post-{{ $post->id }}" action="{{ route('posts.destroy', $post->id) }}" method="post">
                                    @csrf
                                    @method("DELETE")
                                    <button type="button" onClick=" confirmDelete({{ $post->id }}) "
                                        class="inline-block px-4 py-2  bg-red-600 text-white rounded-lg hover:bg-blue-700 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $posts->links() }}
    </div>

    <script>
        function confirmDelete(postId) {
            Swal.fire({
                title: "Are you sure !",
                text: "You wan't to delete this Post",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((res)=>{
                if (res.isConfirmed) {
                    document.getElementById(`delete-post-${postId}`).submit();
                }
            })
        }
    </script>
</x-app-layout>