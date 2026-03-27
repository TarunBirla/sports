<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendor Panel — Sports Academy</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap"
    rel="stylesheet">
  <style>
    *,
    *::before,
    *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0
    }

    :root {
      --bg: #f0f6ff;
      --surface: #ffffff;
      --surface-2: #e8f1fd;
      --border: #d0e2f7;
      --border-strong: #a8c8f0;
      --text-primary: #0d1f3c;
      --text-secondary: #4a6890;
      --text-muted: #8aaac8;
      --accent: #1a6fd4;
      --accent-light: #e3eefd;
      --accent-hover: #1558b0;
      --gold: #b45309;
      --gold-light: #fef3c7;
      --gold-border: #fcd34d;
      --green: #16a34a;
      --green-light: #dcfce7;
      --green-border: #86efac;
      --red: #dc2626;
      --red-light: #fee2e2;
      --sidebar-w: 240px;
    }

    html {
      scroll-behavior: smooth
    }

    body {
      background: var(--bg);
      color: var(--text-primary);
      font-family: 'DM Sans', sans-serif;
      font-size: 16px;
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
    }

    /* ── Sidebar ── */
    
    .sidebar {
  width: var(--sidebar-w);
  height: 100vh;
  overflow-y: auto;   /* ✅ SCROLL ENABLE */
  background: var(--surface);
  border-right: 1px solid var(--border);
  display: flex;
  flex-direction: column;
  position: fixed;
  top: 0;
  left: 0;
  z-index: 50;
}
.sidebar::-webkit-scrollbar {
  width: 6px;
}
.sidebar::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 10px;
}

    .sidebar-brand {
      padding: 1.5rem 1.25rem 1.25rem;
      border-bottom: 1px solid var(--border);
    }

    .sidebar-logo {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.35rem;
      letter-spacing: 0.05em;
      color: var(--text-primary);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .sidebar-logo span {
      color: var(--accent)
    }

    .sidebar-sub {
      font-size: 0.72rem;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-top: 3px;
    }

    .sidebar-nav {
      padding: 1rem 0.75rem;
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 3px;
    }

    .nav-label {
      font-size: 0.68rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--text-muted);
      padding: 0.75rem 0.75rem 0.35rem;
    }

    .nav-link {
      display: flex;
      align-items: center;
      gap: 10px;
      padding: 9px 12px;
      border-radius: 9px;
      font-size: 0.875rem;
      font-weight: 500;
      color: var(--text-secondary);
      text-decoration: none;
      transition: all 0.15s;
    }

    .nav-link:hover {
      background: var(--accent-light);
      color: var(--accent)
    }

    .nav-link.active {
      background: var(--accent-light);
      color: var(--accent);
      font-weight: 600
    }

    .nav-link.danger:hover {
      background: var(--red-light);
      color: var(--red)
    }

    .nav-icon {
      width: 30px;
      height: 30px;
      border-radius: 7px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 0.9rem;
      flex-shrink: 0;
    }

    .sidebar-vendor {
      padding: 1rem 1.25rem;
      border-top: 1px solid var(--border);
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .vendor-avatar {
      width: 36px;
      height: 36px;
      border-radius: 50%;
      background: var(--gold-light);
      border: 1px solid var(--gold-border);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1rem;
      flex-shrink: 0;
    }

    .vendor-name {
      font-size: 0.85rem;
      font-weight: 600;
      color: var(--text-primary)
    }

    .vendor-type {
      font-size: 0.7rem;
      font-weight: 600;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--gold);
    }

    /* ── Main ── */
    .main {
      margin-left: var(--sidebar-w);
      flex: 1;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    /* ── Topbar ── */
    .topbar {
      background: var(--surface);
      border-bottom: 1px solid var(--border);
      padding: 0 1.75rem;
      height: 64px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 40;
      box-shadow: 0 1px 8px rgba(26, 111, 212, 0.06);
    }

    .topbar-title {
      font-family: 'Bebas Neue', sans-serif;
      font-size: 1.4rem;
      letter-spacing: 0.05em;
      color: var(--text-primary);
    }

    .topbar-right {
      display: flex;
      align-items: center;
      gap: 10px
    }

    .topbar-badge {
      display: flex;
      align-items: center;
      gap: 6px;
      padding: 5px 12px;
      border-radius: 8px;
      background: var(--gold-light);
      border: 1px solid var(--gold-border);
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--gold);
    }

    /* ── Content ── */
    .content {
      flex: 1;
      padding: 2rem 1.75rem
    }

    /* ── Footer ── */
    .panel-footer {
      background: var(--surface);
      border-top: 1px solid var(--border);
      padding: 1rem 1.75rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .panel-footer span {
      font-size: 0.8rem;
      color: var(--text-muted)
    }

    .panel-footer strong {
      color: var(--text-secondary)
    }

    /* ── Responsive ── */
    @media(max-width:768px) {
      .sidebar {
        transform: translateX(-100%)
      }

      .main {
        margin-left: 0
      }
    }
  </style>
</head>

<body>

  <!-- ═══ SIDEBAR ═══ -->
  <aside class="sidebar">

    <div class="sidebar-brand">
      <div class="sidebar-logo">🏪 <span>Adnan Cricket Academy</span></div>
      <div class="sidebar-sub">Vendor Panel</div>
    </div>

    <nav class="sidebar-nav">

      <div class="nav-label">Main</div>

      <a href="/vendor/dashboard" class="nav-link {{ request()->is('vendor/dashboard*') ? 'active' : '' }}">
        <div class="nav-icon" style="background:var(--accent-light)">📊</div>
        Dashboard
      </a>

        <a href="/vendor/training" class="nav-link {{ request()->is('vendor/training') ? 'active' : '' }}">
          <div class="nav-icon" style="background:var(--green-light)">🏋️</div>
          Products
        </a>

        <a href="/vendor/training/order" class="nav-link {{ request()->is('vendor/training/order') ? 'active' : '' }}">
          <div class="nav-icon" style="background:#fef3c7">📦</div>
          Product Orders
        </a>

        <a href="/vendor/course" class="nav-link {{ request()->is('vendor/course') ? 'active' : '' }}">
          <div class="nav-icon" style="background:#dbeafe">📚</div>
          Training
        </a>

        <a href="/vendor/course/order" class="nav-link {{ request()->is('vendor/course/order') ? 'active' : '' }}">
          <div class="nav-icon" style="background:#fef3c7">📦</div>
          Training Orders
        </a>
        <a href="/stats/create/10/5/13" class="nav-link {{ request()->is('vendor/course/order') ? 'active' : '' }}">
          <div class="nav-icon" style="background:#fef3c7">📦</div>
          Add Stats
        </a>

        <a href="/vendor/userlist" class="nav-link {{ request()->is('vendor/userlist*') ? 'active' : '' }}">
        <div class="nav-icon" style="background:#e0f2fe">👤</div>
        All User
      </a>
      <a href="/vendor/transactiondetails" class="nav-link {{ request()->is('vendor/transactiondetails*') ? 'active' : '' }}">
        <div class="nav-icon" style="background:#e0f2fe">📦</div>
        Transaction Details
      </a>
      <a href="/vendor/performance" class="nav-link {{ request()->is('vendor/performance*') ? 'active' : '' }}">
        <div class="nav-icon" style="background:#e0f2fe"> 📊</div>
        Performance
      </a>
      <a href="/vendor/coach" class="nav-link {{ request()->is('vendor/coach*') ? 'active' : '' }}">
        <div class="nav-icon" style="background:#e0f2fe">👤</div>
        Coach
      </a>
      <a href="/vendor/bordcast" class="nav-link {{ request()->is('vendor/bordcast*') ? 'active' : '' }}">
        <div class="nav-icon" style="background:#e0f2fe">📊</div>
        Broadcast
      </a>

      <a href="/vendor/profile" class="nav-link {{ request()->is('vendor/profile*') ? 'active' : '' }}">
        <div class="nav-icon" style="background:#e0f2fe">👤</div>
        Profile
      </a>

      <a href="/vendor/chat" class="nav-link {{ request()->is('vendor/chat*') ? 'active' : '' }}">
        <div class="nav-icon" style="background:#e0f2fe">👤</div>
        Chat
      </a>




      <a href="/vendor/logout" class="nav-link danger">
        <div class="nav-icon" style="background:var(--red-light)">🚪</div>
        Logout
      </a>

    </nav>



  </aside>


  <!-- ═══ MAIN ═══ -->
  <div class="main">

    <!-- Topbar -->
    <div class="topbar">
      <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
      <div class="topbar-right">
        <div class="topbar-badge">
          🏪 Vendor Portal
        </div>
      </div>
    </div>

    <!-- Page content -->
    <div class="content">
      @yield('content')
      @stack('scripts')

    </div>

    <!-- Footer -->
    <div class="panel-footer">
      <span>© <strong>Adnan Cricket Academy</strong> Vendor Panel 2026</span>
      <span style="font-size:0.75rem;color:var(--text-muted)">Need help? Contact support</span>
    </div>

  </div>
<script src="https://unpkg.com/lucide@latest"></script>
</body>

</html>