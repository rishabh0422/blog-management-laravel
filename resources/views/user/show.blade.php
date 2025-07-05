<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 py-8">

        {{-- Post Image --}}
        <img src="{{ asset('storage/' . $post->img) }}" alt="{{ $post->title }}"
            class="w-full h-auto rounded-xl shadow-md mb-6">

        {{-- Post Title --}}
        <h1 class="text-4xl font-bold text-gray-900 mb-4">
            {{ $post->title }}
        </h1>

        {{-- Post Body --}}
        <div class="prose prose-lg max-w-none text-gray-800">
            {!! nl2br(e($post->body)) !!}
        </div>

    </div>

</x-app-layout>