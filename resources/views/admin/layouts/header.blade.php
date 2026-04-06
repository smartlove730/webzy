<header class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-800">
            @yield('page-title', 'Dashboard')
        </h1>
        <div class="flex items-center space-x-4">
            <span class="text-gray-600">{{ Auth::user()->name ?? 'Admin' }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm text-blue-600 hover:underline focus:outline-none">Logout</button>
            </form>
        </div>
    </div>
</header>