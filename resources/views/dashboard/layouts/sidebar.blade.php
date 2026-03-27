<aside
  id="sidebar"
  class="
    fixed
    md:static
    top-0
    left-0
    h-screen
    w-64
    text-white
    flex
    flex-col
    transform
    -translate-x-full
    md:translate-x-0
    transition-transform
    duration-300
    z-50
  "
  style="
    background:
    linear-gradient(
      135deg,
      hsl(220 50% 12%),
      hsl(220 45% 18%),
      hsl(145 40% 20%)
    );
  "
>

  <!-- Logo -->

  <div class="p-6">

    <h2 class="text-xl font-bold">

      🏏
      <span class="text-yellow-400">
        Adnan  Academy
      </span>

    </h2>

    <p class="text-sm text-gray-300">
      Player Dashboard
    </p>

  </div>



  <!-- Scrollable Menu -->

  <nav class="flex-1 overflow-y-auto px-6 space-y-3">

    <a
       href="{{ route('dashboard') }}"
      class="flex items-center gap-3 px-4 py-3 rounded-lg transition
      {{ request()->routeIs('dashboard') 
        ? 'bg-green-700/40 text-green-300' 
        : 'hover:bg-white/10' }}"
    >
      <i class="fa-solid fa-chart-line"></i> Performance
    </a>

    <a
      href="{{ route('matches') }}"
      class="flex items-center gap-3 px-4 py-3 rounded-lg transition
      {{ request()->routeIs('matches') 
        ? 'bg-green-700/40 text-green-300' 
        : 'hover:bg-white/10' }}"
    >
      <i class="fa-solid fa-trophy"></i> Matches
    </a>

    <a
       href="{{ route('feedback') }}"
      class="flex items-center gap-3 px-4 py-3 rounded-lg transition
      {{ request()->routeIs('feedback') 
        ? 'bg-green-700/40 text-green-300' 
        : 'hover:bg-white/10' }}"
    >
      <i class="fa-solid fa-comment"></i> Feedback
    </a>

    <a
     href="{{ route('rankings') }}"
      class="flex items-center gap-3 px-4 py-3 rounded-lg transition
      {{ request()->routeIs('rankings') 
        ? 'bg-green-700/40 text-green-300' 
        : 'hover:bg-white/10' }}"
    >
      <i class="fa-solid fa-trophy"></i> Rankings
    </a>

    <a
      href="{{ route('orders') }}"
      class="flex items-center gap-3 px-4 py-3 rounded-lg transition
      {{ request()->routeIs('orders') 
        ? 'bg-green-700/40 text-green-300' 
        : 'hover:bg-white/10' }}"
    >
      <i class="fa-solid fa-bag-shopping"></i> Orders
    </a>

    <a
      href="{{ route('user.chat') }}"
      class="flex items-center gap-3 px-4 py-3 rounded-lg transition
      {{ request()->routeIs('user.chat') 
        ? 'bg-green-700/40 text-green-300' 
        : 'hover:bg-white/10' }}"
    >
      <i class="fa-solid fa-bag-shopping"></i> Chat
    </a>

  </nav>



  <!-- Bottom Links -->

  <div class="p-6 border-t border-white/20 space-y-3">

    <a
      href="{{ route('profiles') }}"
      class="flex items-center gap-3 hover:text-yellow-400 transition"
    >
      <i class="fa-solid fa-user"></i> My Profile
    </a>

    <a
      href="/"
      class="flex items-center gap-3 hover:text-yellow-400 transition"
    >
      <i class="fa-solid fa-store"></i> Marketplace
    </a>

    <a
      href="/"
      class="flex items-center gap-3 hover:text-yellow-400 transition"
    >
      <i class="fa-solid fa-house"></i> Home
    </a>

    <a
      href="/"
      class="flex items-center gap-3 text-red-400 hover:text-red-500 transition"
    >
    <i class="fa-solid fa-right-from-bracket"></i> Logout
    </a>

  </div>

</aside>