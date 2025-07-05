<x-app-layout>

  <div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6">Dashboard Overview </h2>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

      <!-- Total Authors -->
      <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between">
        <div>
          <h3 class="text-lg font-semibold text-gray-700">Total Authors</h3>
          <p class="text-3xl font-bold text-blue-600 mt-2">{{ $authors }}</p>
        </div>
        <div>
          <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path
              d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.778.758 6.879 2.051M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
          </svg>
        </div>
      </div>

      <!-- Total Posts -->
      <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between">
        <div>
          <h3 class="text-lg font-semibold text-gray-700">Total Posts</h3>
          <p class="text-3xl font-bold text-green-600 mt-2">{{ $posts }}</p>
        </div>
        <div>
          <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M4 4h16v16H4z" />
          </svg>
        </div>
      </div>

      <!-- Total Categories -->
      <div class="bg-white shadow-md rounded-2xl p-6 flex items-center justify-between">
        <div>
          <h3 class="text-lg font-semibold text-gray-700">Total Categories</h3>
          <p class="text-3xl font-bold text-purple-600 mt-2">{{ $categories }}</p>
        </div>
        <div>
          <svg class="w-12 h-12 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path d="M3 7h18M3 12h18M3 17h18" />
          </svg>
        </div>
      </div>

    </div>


    <div class="w-full px-4 sm:px-6 lg:px-8 mt-3">
      <h2 class="text-2xl  font-bold mb-10 ">Recentely Added</h2>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($blogs as $blog)

      <div class="w-full bg-white rounded-lg shadow-md overflow-hidden">
        <img src="{{ url('storage/' . $blog->img) }}" alt="Card Image" class="w-full h-48 object-cover">
        <div class="p-4">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $blog->title }}</h2>
        <p class="text-sm text-gray-600 mb-4">
          {{ $blog->slug }}
        </p>
        <a href="" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
          Read
        </a>
        </div>
      </div>
    @endforeach

</div>
      </div>
    </div>

</x-app-layout>