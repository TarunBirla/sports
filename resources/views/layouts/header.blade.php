<header class="bg-white shadow-md sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

        <!-- Logo -->
        <h1 class="text-2xl font-bold text-blue-600">
            Sports Academy
        </h1>

        <!-- Menu -->
        <div class="flex items-center gap-6">

            <a href="/" class="hover:text-blue-500 font-medium">Home</a>

            @if(auth()->check())

                <span class="text-gray-700 font-semibold">
                    👋 {{ auth()->user()->name }}
                </span>

                <a href="/profile" class="hover:text-blue-500">Profile</a>

                <a href="/cart" class="relative hover:text-blue-500">
                    Cart
                </a>

                <a href="/my-orders" class="hover:text-blue-500">
                    Orders
                </a>

                <a href="/logout"
                   class="bg-red-500 text-white px-4 py-1 rounded hover:bg-red-600">
                    Logout
                </a>

            @else

                <a href="/login" class="hover:text-blue-500">Login</a>

                <a href="/register"
                   class="bg-green-500 text-white px-4 py-1 rounded hover:bg-green-600">
                    Register
                </a>

                <a href="/vendor/register"
                   class="bg-yellow-500 text-black px-4 py-1 rounded hover:bg-yellow-400">
                    Become Seller
                </a>

            @endif

        </div>
    </div>
</header>