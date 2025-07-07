<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>

<body class=" flex  items-center lg:justify-center min-h-screen flex-col">
  <header class="w-full text-sm mb-6 bg-gray-900 text-white px-6 py-4 shadow">
    @if (Route::has('login'))
        <nav class="flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <span class="text-lg font-semibold">MyBlog</span>
            </div>

            <!-- Navigation Links -->
            <div class="flex items-center gap-4">
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="inline-block px-5 py-1.5 border border-white hover:bg-white hover:text-gray-900 transition rounded-sm text-sm leading-normal">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-block px-5 py-1.5 border border-transparent hover:border-white hover:bg-white hover:text-gray-900 transition rounded-sm text-sm leading-normal">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="inline-block px-5 py-1.5 border border-white hover:bg-white hover:text-gray-900 transition rounded-sm text-sm leading-normal">
                            Register
                        </a>
                    @endif
                @endauth
            </div>
        </nav>
    @endif
</header>

    <div class="w-full px-4 sm:px-6 lg:px-8 mt-3">
     <!-- <h2 class="text-2xl text-center font-bold mb-10 ">Welcome to Laravel-Blogs</h2> -->
       
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($blogs as $blog )
            
            <div class="w-full bg-white rounded-lg shadow-md overflow-hidden">
                <img src="{{ url('storage/'.$blog->img) }}" alt="Card Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-lg font-semibold text-gray-800 mb-2">{{ $blog->title }}</h2>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ $blog->slug }}
                    </p>
                    <a href="{{ url('/blog/'.$blog->slug) }}"
                        class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                        Read
                    </a>
                </div>
            </div>
            @endforeach

        </div>
    </div>


    @if (Route::has('login'))
        <div class="h-14.5 hidden lg:block"></div>
    @endif
</body>

</html>