<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Categories') }}
    </h2>
  </x-slot>

  <div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-2xl font-bold">All Categories</h2>
      <a href="{{ route('categories.create') }}"
        class="inline-block px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        + Add Category
      </a>
    </div>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
      <table class="min-w-full table-auto border border-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-4 py-2 text-left border">Name</th>
            <th class="px-4 py-2 text-left border">Slug</th>
            <th class="px-4 py-2 text-left border">Created At</th>
            <th class="px-4 py-2 text-left border">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($categories as $category)
        <tr>
        <td class="px-4 py-2 text-left border">{{ $category->name }}</td>
        <td class="px-4 py-2 text-left border">{{ $category->slug }}</td>
        <td class="px-4 py-2 text-left border">{{ Carbon\Carbon::parse($category->created_at)->toDateString() }}</td>
        <td class="px-4 py-2 border flex gap-2 ">
          <a href="{{ route('categories.edit', $category) }}"
          class="inline-block px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-blue-700 transition">
          Edit
          </a>
          <form action="{{ route('categories.destroy', $category->id) }}" method="post">
          @csrf
          @method("DELETE")
          <button type="submit" class="inline-block px-4 py-2  bg-red-600 text-white rounded-lg hover:bg-blue-700 transition">
            Delete
          </button>
          </form>
        </td>
        </tr>
      @endforeach

        </tbody>
      </table>
    </div>
  </div>

</x-app-layout>