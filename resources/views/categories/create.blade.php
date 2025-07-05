<x-app-layout>

<div class="my-4 max-w-xl mx-auto bg-white p-6 rounded-lg shadow-md">
  <h2 class="text-2xl font-bold mb-6">Create New Category</h2>


  <form action="{{ route('categories.store') }}" method="POST">
    @csrf

    <!-- Name -->
    <div class="mb-4">
      <label for="name" class="block text-gray-700 font-semibold mb-1">Name</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}"
        class="w-full rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror"
        placeholder="Enter category name">
      @error('name')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Slug -->
    <div class="mb-6">
      <label for="slug" class="block text-gray-700 font-semibold mb-1">Slug</label>
      <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
        class="w-full rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('slug') border-red-500 @enderror"
        placeholder="Auto-generated or enter custom slug">
      @error('slug')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
      @enderror
    </div>

    <!-- Submit Button -->
    <div>
      <button type="submit"
        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
        Create Category
      </button>
    </div>

  </form>
</div>

</x-app-layout>
