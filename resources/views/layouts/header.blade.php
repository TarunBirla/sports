<header>
  <div class="header-inner">
   <header
  class="w-full fixed top-0 left-0 z-50
  bg-gradient-to-r from-[#0c1f3f] via-[#173a4d] to-[#1f6f43]
  shadow-md"
>

  <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

    <!-- Logo -->
    <a href="/" class="flex items-center space-x-3">
      <span class="text-2xl">🏏</span>
      <h1 class="text-xl font-bold tracking-wider">
        <span class="text-yellow-400">Adnan Cricket</span>
        <span class="text-white">Academy</span>
      </h1>
    </a>

    <!-- Desktop Navigation -->
    <nav class="hidden md:flex items-center space-x-6 text-gray-200 font-medium">

      <a href="/" class="hover:text-white transition">Home</a>
      <a href="#about" class="hover:text-white transition">About</a>
      <a href="#programs" class="hover:text-white transition">Programs</a>
      <a href="#testimonials" class="hover:text-white transition">Testimonials</a>

      @if(auth()->check())

        <span class="text-sm">👋 {{ auth()->user()->name }}</span>

        <a href="/dashboard" class="hover:text-white">Profile</a>

        <a href="/cart" class="relative hover:text-white">
          🛒 Cart
        </a>

        <a href="/my-orders" class="hover:text-white">Orders</a>

        <a href="/logout"
           class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
          Logout
        </a>

      @else

        <a href="/login"
           class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
          Login
        </a>

        <a href="/register"
           class="bg-yellow-400 hover:bg-yellow-500 text-black px-4 py-2 rounded-lg">
          Register
        </a>

        <a href="/vendor/register"
           class="bg-white text-green-700 px-4 py-2 rounded-lg border">
          Become Seller
        </a>

      @endif

    </nav>

    <!-- Mobile Menu Button -->
    <button onclick="toggleMenu()" class="md:hidden text-white text-2xl">
      ☰
    </button>

  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu"
       class="hidden md:hidden bg-[#0c1f3f] text-gray-200 px-6 pb-6 space-y-4">

    <a href="/" class="block">Home</a>
    <a href="#about" class="block">About</a>
    <a href="#programs" class="block">Programs</a>
    <a href="#shop" class="block">Shop</a>

    @if(auth()->check())

      <div class="text-sm">👋 {{ auth()->user()->name }}</div>

      <a href="/dashboard" class="block">Dashboard</a>

      <a href="/cart" class="block">🛒 Cart</a>

      <a href="/my-orders" class="block">Orders</a>

      <a href="/logout"
         class="block bg-red-500 text-white text-center py-2 rounded-lg">
        Logout
      </a>

    @else

      <a href="/login"
         class="block bg-green-600 text-white text-center py-2 rounded-lg">
        Login
      </a>

      <a href="/register"
         class="block bg-yellow-400 text-black text-center py-2 rounded-lg">
        Register
      </a>

      <a href="/vendor/register"
         class="block bg-white text-green-700 text-center py-2 rounded-lg">
        Become Seller
      </a>

    @endif

  </div>

</header>
  </div>
</header>

<!-- Navbar -->




<script>

function toggleMenu()
{
  const menu = document.getElementById("mobileMenu");

  menu.classList.toggle("hidden");
}

</script>