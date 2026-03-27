<header>
  <div class="header-inner">
    <a href="/" class="logo"><span>Adnan Cricket Academy  </span></a>
    <nav>
      <a href="/">Home</a>

      @if(auth()->check())
      <div class="nav-user">👋 {{ auth()->user()->name }}</div>
      <!-- <a href="/profile" class="btn btn-ghost">Profile</a> -->
      <a href="/dashboard" class="btn btn-ghost">Profile</a>
      <a href="/cart" class="btn btn-ghost cart-btn">
        🛒 Cart
      </a>
      <a href="/my-orders" class="btn btn-ghost">Orders</a>
      <a href="/logout" class="btn btn-danger">Logout</a>
      @else
      
      <a href="/login" class="btn btn-ghost">Login</a>
      <a href="/register" class="btn btn-accent">Register</a>
      <a href="/vendor/register" style="background:#fef3c7;color:#b45309;border:1px solid #fcd34d" class="btn">Become Seller</a>
     
      @endif
    </nav>
  </div>
</header>

<!-- Navbar -->

<header
  class="w-full fixed top-0 left-0 z-50
  bg-gradient-to-r from-[#0c1f3f] via-[#173a4d] to-[#1f6f43]
  shadow-md"
>

  <div
    class="max-w-7xl mx-auto px-6 py-4
    flex items-center justify-between"
  >

    <!-- Logo -->

    <div class="flex items-center space-x-3">

      <span class="text-2xl">🏏</span>

      <h1 class="text-xl font-bold tracking-wider">
        <span class="text-yellow-400">ELITE</span>
        <span class="text-white">CRICKET</span>
      </h1>

    </div>



    <!-- Desktop Navigation -->

    <nav
      class="hidden md:flex items-center space-x-8
      text-gray-200 font-medium"
    >

      <a href="#home" class="hover:text-white transition">
        Home
      </a>

      <a href="#about" class="hover:text-white transition">
        About
      </a>

      <a href="#programs" class="hover:text-white transition">
        Programs
      </a>

      <a href="#achievements" class="hover:text-white transition">
        Achievements
      </a>

      <a href="#gallery" class="hover:text-white transition">
        Gallery
      </a>

      <a href="#testimonials" class="hover:text-white transition">
        Testimonials
      </a>

      <a href="#shop" class="hover:text-white transition">
        Shop
      </a>

    </nav>



    <!-- Login Button -->

    <div class="hidden md:block">

      <a
        href="/login"
        class="bg-green-600 hover:bg-green-700
        text-white font-semibold
        px-5 py-2 rounded-lg
        transition duration-300"
      >
        Login / Register
      </a>

    </div>



    <!-- Mobile Menu Button -->

    <button
      onclick="toggleMenu()"
      class="md:hidden text-white text-2xl"
    >
      ☰
    </button>

  </div>



  <!-- Mobile Menu -->

  <div
    id="mobileMenu"
    class="hidden md:hidden
    bg-[#0c1f3f]
    text-gray-200
    px-6 pb-6 space-y-4"
  >

    <a href="#home" class="block hover:text-white">
      Home
    </a>

    <a href="#about" class="block hover:text-white">
      About
    </a>

    <a href="#programs" class="block hover:text-white">
      Programs
    </a>

    <a href="#achievements" class="block hover:text-white">
      Achievements
    </a>

    <a href="#gallery" class="block hover:text-white">
      Gallery
    </a>

    <a href="#testimonials" class="block hover:text-white">
      Testimonials
    </a>

    <a href="#shop" class="block hover:text-white">
      Shop
    </a>

    <a
      href="/login"
      class="block
      bg-green-600 hover:bg-green-700
      text-white text-center
      py-2 rounded-lg"
    >
      Login / Register
    </a>

  </div>

</header>



<script>

function toggleMenu()
{
  const menu = document.getElementById("mobileMenu");

  menu.classList.toggle("hidden");
}

</script>