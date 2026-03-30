<header>
  <div class="header-inner">
    <header class="w-full fixed top-0 left-0 z-50
  bg-gradient-to-r from-[#0c1f3f] via-[#173a4d] to-[#1f6f43]
  shadow-md">

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

<div class="relative">

    <!-- USER BUTTON -->
    <button onclick="toggleUserMenu()" 
        class="flex items-center gap-2 bg-white px-3 py-2 rounded-lg hover:bg-gray-100 transition text-black">

        👤 {{ auth()->user()->name }}
        <span class="text-xs">▼</span>
    </button>

    <!-- DROPDOWN -->
    <div id="userDropdown"
        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg overflow-hidden z-50">

        <a href="/dashboard"
           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            👤 Dashboard
        </a>

        <a href="/cart"
           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            🛒 Cart
        </a>

        <a href="/my-orders"
           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            📦 Orders
        </a>

        <div class="border-t"></div>

        <a href="/logout"
           class="block px-4 py-2 text-red-500 hover:bg-red-50">
            🚪 Logout
        </a>

    </div>

</div>

@else

            <a href="/login"
              class="px-4 py-2 rounded-lg border border-white text-gray-200 hover:bg-white hover:text-[#0c1f3f] transition">
              Login
            </a>

            <a href="/register"
              class="px-4 py-2 rounded-lg border border-white text-gray-200 hover:bg-white hover:text-[#0c1f3f] transition">
              Register
            </a>

            {{-- <a href="/vendor/register"
              class="px-4 py-2 rounded-lg border border-white text-gray-200 hover:bg-white hover:text-[#0c1f3f] transition">
              Become Seller
            </a> --}}

          @endif

        </nav>

        <!-- Mobile Menu Button -->
        <button onclick="toggleMenu()" class="md:hidden text-white text-2xl">
          ☰
        </button>

      </div>

      <!-- Mobile Menu -->
      <div id="mobileMenu" class="hidden md:hidden bg-[#0c1f3f] text-gray-200 px-6 pb-6 space-y-4">

        <a href="/" class="block">Home</a>
        <a href="#about" class="block">About</a>
        <a href="#programs" class="block">Programs</a>
        <a href="#shop" class="block">Shop</a>
         <a href="/dashboard" class="block">
            Dashboard
        </a>

      @if(auth()->check())

<div class="relative">

    <!-- USER BUTTON -->
    <button onclick="toggleUserMenu()" 
        class="flex items-center gap-2 bg-white px-3 py-2 rounded-lg hover:bg-gray-100 transition text-black">

        👤 {{ auth()->user()->name }}
        <span class="text-xs">▼</span>
    </button>

    <!-- DROPDOWN -->
    <div id="userDropdown"
        class="hidden absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg overflow-hidden z-50">

        <a href="/dashboard"
           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            👤 Dashboard
        </a>

        <a href="/cart"
           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            🛒 Cart
        </a>

        <a href="/my-orders"
           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
            📦 Orders
        </a>

        <div class="border-t"></div>

        <a href="/logout"
           class="block px-4 py-2 text-red-500 hover:bg-red-50">
            🚪 Logout
        </a>

    </div>

</div>

@else

          <a href="/login"
            class="px-4 py-2 rounded-lg border border-white text-white hover:bg-white hover:text-[#0c1f3f] transition">
            Login
          </a>

          <a href="/register"
            class="px-4 py-2 rounded-lg border border-white text-white hover:bg-white hover:text-[#0c1f3f] transition">
            Register
          </a>

          {{-- <a href="/vendor/register"
            class="px-4 py-2 rounded-lg border border-white text-white hover:bg-white hover:text-[#0c1f3f] transition">
            Become Seller
          </a> --}}

        @endif

      </div>

    </header>
  </div>
</header>

<!-- Navbar -->




<script>

  function toggleMenu() {
    const menu = document.getElementById("mobileMenu");

    menu.classList.toggle("hidden");
  }

</script>

<script>
function toggleUserMenu() {
    document.getElementById("userDropdown").classList.toggle("hidden");
}

// Close when click outside
window.addEventListener('click', function(e) {
    let dropdown = document.getElementById("userDropdown");
    if (!e.target.closest('.relative')) {
        dropdown.classList.add("hidden");
    }
});
</script>