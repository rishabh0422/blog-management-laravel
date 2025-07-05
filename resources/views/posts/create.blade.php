<x-app-layout>

  <div class="m-4 max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-6">Create New Post</h2>

    <form action="{{Auth::user()->role === 'admin' ? route('posts.store') : route('user.posts.store')  }}" method="POST"
      enctype="multipart/form-data">
      @csrf

      <!-- Title & Category (in one row) -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <!-- Title -->
        <div>
          <label for="title" class="block text-gray-700 font-semibold mb-1">Title</label>
          <input type="text" name="title" id="title"
            class="w-full rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror"
            placeholder="Enter post title">
          @error('title')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Category -->
        <div>
          <label for="category_id" class="block text-gray-700 font-semibold mb-1">Category</label>
          <select name="category_id" id="category_id"
            class="w-full rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
            <option value="">-- Select Category --</option>
            @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
          </select>
           @error('category_id')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <!-- Body -->
      <div class="mb-4">
        <label for="body" class="block text-gray-700 font-semibold mb-1">Body</label>
        <textarea name="body" id="body" rows="5"
          class="w-full rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('body') border-red-500 @enderror "
          placeholder="Write your post here..."></textarea>
           @error('body')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
      </div>

      <!-- Image -->
      <div class="mb-6">
        <label for="img" class="block text-gray-700 font-semibold mb-1">Image</label>
        <input type="file" name="img" id="img"
          class="w-full rounded-lg p-2 border-gray file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100
            @error('img') border-red-500 @enderror
          ">
           @error('img')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit"
          class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
          Create Post
        </button>
      </div>

    </form>
  </div>

</x-app-layout>