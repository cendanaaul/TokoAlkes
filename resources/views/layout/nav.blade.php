<nav class="bg-white shadow-md sticky top-0 w-full z-10 py-3">
    <div class="container mx-auto flex items-center justify-between px-4">
        <a href="/" class="text-lg font-bold text-primary">
            <span class="text-blue-600">TOKO</span> ALAT KESEHATAN
        </a>

        <button class="text-gray-600 md:hidden focus:outline-none" type="button" onclick="toggleNavbar()">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <div class="hidden md:flex space-x-6">
            @if (!auth()->check())
                <a href="/" class="text-black hover:text-blue-600 transition">Home</a>
                <a href="/products" class="text-black hover:text-blue-600 transition">Product</a>
            @endif
            @auth
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('kelola.show') }}" class="text-black hover:text-blue-600 transition">Kelola Users</a>
                    <a href="/kelola" class="text-black hover:text-blue-600 transition">Kelola Produk</a>
                    <a href="{{ route('category.index') }}" class="text-black hover:text-blue-600 transition">Kelola
                        Ketegori</a>
                    <a href="{{ route('status.index') }}" class="text-black hover:text-blue-600 transition">Kelola
                        status</a>
                @else
                    <a href="/" class="text-black hover:text-blue-600 transition">Home</a>
                    <a href="/products" class="text-black hover:text-blue-600 transition">Product</a>
                    <a href="/cart" class="text-black hover:text-blue-600 transition">Cart</a>
                    <a href="/summary" class="text-black hover:text-blue-600 transition">Summary</a>
                @endif
            @endauth
        </div>

        <div class="hidden md:flex items-center space-x-4">
            @auth
                <a href="/logout"
                    class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Logout</a>
                <a href="{{ route('account.index') }}" class="flex items-center">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff&size=64"
                        alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover">
                </a>
            @else
                <a href="/login" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Login</a>
            @endauth
        </div>
    </div>

    <div id="navbarCollapse" class="md:hidden flex flex-col space-y-4 mt-2">
        <a href="/" class="block text-black hover:text-blue-600 transition">Home</a>
        <a href="/products" class="block text-black hover:text-blue-600 transition">Product</a>

        @auth
            @if (auth()->user()->role == 'admin')
                <a href="/kelola" class="text-black hover:text-blue-600 transition">Kelola Produk</a>
                <a href="{{ route('category.index') }}" class="text-black hover:text-blue-600 transition">Kelola
                    Ketegori</a>
                <a href="{{ route('status.index') }}" class="text-black hover:text-blue-600 transition">Kelola
                    status</a>
            @else
                <a href="/cart" class="block text-black hover:text-blue-600 transition">Cart</a>
                <a href="/summary" class="block text-black hover:text-blue-600 transition">Summary</a>
            @endif
        @endauth

        @auth
            <a href="/logout"
                class="block px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 transition">Logout</a>
            <a href="{{ route('account.index') }}" class="flex items-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random&color=fff&size=64"
                    alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover">
            </a>
        @else
            <a href="/login" class="block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">Login</a>
        @endauth

    </div>
</nav>

<script>
    function toggleNavbar() {
        const navbarCollapse = document.getElementById('navbarCollapse');
        navbarCollapse.classList.toggle('hidden');
    }
</script>
