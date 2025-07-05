<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Side -->
            <div class="flex space-x-4 items-center">
                <a href="{{ url('/') }}" class="text-xl font-bold text-blue-600">
                    MyBlog
                </a>

                @auth
                    @if (auth()->user()->role === 'admin')
                        <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                        <a href="{{ route('categories') }}" class="text-gray-700 hover:text-blue-600 font-medium">Categories</a>
                        <a href="{{ route('posts') }}" class="text-gray-700 hover:text-blue-600 font-medium">Posts</a>
                    @elseif (auth()->user()->role === 'user')
                        <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:text-blue-600 font-medium">Dashboard</a>
                        <a href="{{ route('user.posts') }}" class="text-gray-700 hover:text-blue-600 font-medium">My Posts</a>
                    @endif
                @endauth
            </div>

            <!-- Right Side -->
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 text-gray-700 font-medium focus:outline-none">
                            <span>{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06 0L10 10.94l3.71-3.73a.75.75 0 111.06 1.06l-4.24 4.24a.75.75 0 01-1.06 0L5.23 8.27a.75.75 0 010-1.06z" clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 bg-white border rounded-md shadow-lg opacity-0 group-hover:opacity-100 invisible group-hover:visible transition duration-150 ease-in-out z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-700 hover:text-blue-600 font-medium">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
