<header>
  <div class="header-inner">
    <a href="/" class="logo">⚡<span>Sports</span>Academy</a>
    <nav>
      <a href="/">Home</a>

      @if(auth()->check())
      <div class="nav-user">👋 {{ auth()->user()->name }}</div>
      <a href="/profile" class="btn btn-ghost">Profile</a>
      <a href="/cart" class="btn btn-ghost cart-btn">
        🛒 Cart
        <span class="cart-badge">3</span>
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