<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Panel</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
  --bg:       #0d0f14;
  --surface:  #13161e;
  --surface2: #1a1e2a;
  --border:   rgba(255,255,255,0.06);
  --accent:   #4f8ef7;
  --accent2:  #7c5cf7;
  --success:  #22d3a0;
  --danger:   #f75f5f;
  --text:     #e8eaf0;
  --muted:    #6b7280;
  --sidebar-w: 240px;
}

body {
  font-family: 'DM Sans', sans-serif;
  background: var(--bg);
  color: var(--text);
  min-height: 100vh;
}

/* ─── SIDEBAR ─────────────────────────────────────────── */
.sidebar {
  width: var(--sidebar-w);
  background: var(--surface);
  height: 100vh;
  position: fixed;
  top: 0; left: 0;
  display: flex;
  flex-direction: column;
  border-right: 1px solid var(--border);
  z-index: 100;
}

.sidebar-logo {
  padding: 28px 24px 20px;
  border-bottom: 1px solid var(--border);
}

.sidebar-logo h2 {
  font-family: 'Syne', sans-serif;
  font-size: 20px;
  font-weight: 800;
  letter-spacing: -0.5px;
  background: linear-gradient(135deg, var(--accent), var(--accent2));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.sidebar-logo span {
  font-size: 11px;
  color: var(--muted);
  font-weight: 400;
  display: block;
  margin-top: 2px;
}

.sidebar-nav {
  flex: 1;
  padding: 20px 14px;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.nav-label {
  font-size: 10px;
  text-transform: uppercase;
  letter-spacing: 1.5px;
  color: var(--muted);
  padding: 12px 10px 6px;
  font-weight: 500;
}

.sidebar a {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--muted);
  text-decoration: none;
  padding: 10px 14px;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 500;
  transition: all 0.2s ease;
  position: relative;
}

.sidebar a .icon {
  font-size: 16px;
  width: 20px;
  text-align: center;
}

.sidebar a:hover {
  background: rgba(79,142,247,0.1);
  color: var(--accent);
}

.sidebar a.active {
  background: linear-gradient(135deg, rgba(79,142,247,0.15), rgba(124,92,247,0.1));
  color: var(--text);
  border: 1px solid rgba(79,142,247,0.2);
}

.sidebar a.active::before {
  content: '';
  position: absolute;
  left: 0; top: 50%;
  transform: translateY(-50%);
  width: 3px; height: 60%;
  background: linear-gradient(var(--accent), var(--accent2));
  border-radius: 0 2px 2px 0;
}

.sidebar-footer {
  padding: 14px;
  border-top: 1px solid var(--border);
}

.sidebar-footer a {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--danger) !important;
  padding: 10px 14px;
  border-radius: 10px;
  font-size: 14px;
  font-weight: 500;
  text-decoration: none;
  transition: all 0.2s;
}

.sidebar-footer a:hover {
  background: rgba(247,95,95,0.1);
}

/* ─── MAIN ─────────────────────────────────────────────── */
.main {
  margin-left: var(--sidebar-w);
  min-height: 100vh;
}

/* ─── TOPBAR ───────────────────────────────────────────── */
.topbar {
  background: var(--surface);
  border-bottom: 1px solid var(--border);
  padding: 0 32px;
  height: 60px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: sticky;
  top: 0;
  z-index: 50;
}

.topbar-title {
  font-family: 'Syne', sans-serif;
  font-size: 17px;
  font-weight: 700;
  color: var(--text);
}

.topbar-right {
  display: flex;
  align-items: center;
  gap: 16px;
}

.avatar {
  width: 34px; height: 34px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--accent), var(--accent2));
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  font-weight: 700;
  color: #fff;
}

.badge-dot {
  width: 8px; height: 8px;
  background: var(--success);
  border-radius: 50%;
  border: 2px solid var(--surface);
  margin-left: -12px;
  margin-top: 22px;
}

/* ─── CONTENT WRAPPER ─────────────────────────────────── */
.content-wrap {
  padding: 32px;
}

/* ─── PAGE HEADER ─────────────────────────────────────── */
.page-header {
  margin-bottom: 28px;
}

.page-header h1 {
  font-family: 'Syne', sans-serif;
  font-size: 26px;
  font-weight: 800;
  color: var(--text);
  letter-spacing: -0.5px;
}

.page-header p {
  font-size: 13px;
  color: var(--muted);
  margin-top: 4px;
}

/* ─── STAT CARDS ──────────────────────────────────────── */
.cards {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
  gap: 18px;
  margin-bottom: 32px;
}

.card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 16px;
  padding: 22px 20px;
  position: relative;
  overflow: hidden;
  transition: transform 0.2s, border-color 0.2s;
  animation: fadeUp 0.5s ease both;
}

.card:hover {
  transform: translateY(-3px);
  border-color: rgba(79,142,247,0.2);
}

.card::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(79,142,247,0.04), transparent);
  pointer-events: none;
}

.card-icon {
  font-size: 26px;
  margin-bottom: 14px;
  display: block;
}

.card-label {
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: var(--muted);
  font-weight: 500;
}

.card-value {
  font-family: 'Syne', sans-serif;
  font-size: 32px;
  font-weight: 800;
  color: var(--text);
  line-height: 1;
  margin-top: 6px;
}

.card-glow {
  position: absolute;
  right: -20px; bottom: -20px;
  width: 80px; height: 80px;
  border-radius: 50%;
  opacity: 0.08;
  filter: blur(20px);
}

/* ─── TABLE ───────────────────────────────────────────── */
.table-wrap {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 16px;
  overflow: hidden;
}

.table-wrap table {
  width: 100%;
  border-collapse: collapse;
}

.table-wrap thead th {
  background: var(--surface2);
  padding: 14px 18px;
  text-align: left;
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: var(--muted);
  font-weight: 600;
  font-family: 'Syne', sans-serif;
  border-bottom: 1px solid var(--border);
}

.table-wrap tbody tr {
  border-bottom: 1px solid var(--border);
  transition: background 0.15s;
}

.table-wrap tbody tr:last-child { border-bottom: none; }

.table-wrap tbody tr:hover { background: rgba(255,255,255,0.02); }

.table-wrap tbody td {
  padding: 14px 18px;
  font-size: 14px;
  color: var(--text);
}

.table-wrap tbody td:first-child {
  color: var(--muted);
  font-size: 12px;
  font-weight: 500;
}

/* ─── BADGE ───────────────────────────────────────────── */
.badge {
  display: inline-block;
  padding: 3px 10px;
  border-radius: 20px;
  font-size: 11px;
  font-weight: 600;
  letter-spacing: 0.3px;
}

.badge-green  { background: rgba(34,211,160,0.12); color: var(--success); }
.badge-blue   { background: rgba(79,142,247,0.12); color: var(--accent); }
.badge-purple { background: rgba(124,92,247,0.12); color: var(--accent2); }
.badge-red    { background: rgba(247,95,95,0.12);  color: var(--danger); }

/* ─── EMPTY STATE ─────────────────────────────────────── */
.empty-state {
  padding: 60px 20px;
  text-align: center;
  color: var(--muted);
}

.empty-state .emoji { font-size: 40px; margin-bottom: 12px; display: block; }
.empty-state p { font-size: 14px; }

/* ─── LOGIN ───────────────────────────────────────────── */
.login-page {
  min-height: 100vh;
  background: var(--bg);
  display: flex;
  align-items: center;
  justify-content: center;
  position: relative;
  overflow: hidden;
}

.login-page::before {
  content: '';
  position: absolute;
  top: -200px; left: 50%;
  transform: translateX(-50%);
  width: 600px; height: 600px;
  background: radial-gradient(circle, rgba(79,142,247,0.12) 0%, transparent 70%);
  pointer-events: none;
}

.login-box {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 20px;
  padding: 40px;
  width: 100%;
  max-width: 400px;
  position: relative;
  z-index: 1;
}

.login-box h2 {
  font-family: 'Syne', sans-serif;
  font-size: 24px;
  font-weight: 800;
  margin-bottom: 6px;
  background: linear-gradient(135deg, var(--accent), var(--accent2));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.login-box p {
  font-size: 13px;
  color: var(--muted);
  margin-bottom: 28px;
}

.form-group { margin-bottom: 18px; }

.form-group label {
  display: block;
  font-size: 12px;
  font-weight: 600;
  color: var(--muted);
  text-transform: uppercase;
  letter-spacing: 0.8px;
  margin-bottom: 7px;
}

.form-group input {
  width: 100%;
  background: var(--surface2);
  border: 1px solid var(--border);
  border-radius: 10px;
  padding: 12px 16px;
  font-size: 14px;
  color: var(--text);
  font-family: 'DM Sans', sans-serif;
  outline: none;
  transition: border-color 0.2s;
}

.form-group input:focus {
  border-color: var(--accent);
}

.form-group input::placeholder { color: var(--muted); }

.btn-login {
  width: 100%;
  padding: 13px;
  background: linear-gradient(135deg, var(--accent), var(--accent2));
  color: #fff;
  border: none;
  border-radius: 10px;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  font-family: 'DM Sans', sans-serif;
  margin-top: 8px;
  transition: opacity 0.2s, transform 0.15s;
}

.btn-login:hover { opacity: 0.9; transform: translateY(-1px); }
.btn-login:active { transform: translateY(0); }

.error-msg {
  margin-top: 14px;
  padding: 10px 14px;
  background: rgba(247,95,95,0.1);
  border: 1px solid rgba(247,95,95,0.2);
  border-radius: 8px;
  color: var(--danger);
  font-size: 13px;
}

/* ─── ANIMATION ───────────────────────────────────────── */
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(16px); }
  to   { opacity: 1; transform: translateY(0); }
}

.card:nth-child(1) { animation-delay: 0.05s; }
.card:nth-child(2) { animation-delay: 0.10s; }
.card:nth-child(3) { animation-delay: 0.15s; }
.card:nth-child(4) { animation-delay: 0.20s; }
.card:nth-child(5) { animation-delay: 0.25s; }
</style>
</head>
<body>

<div class="sidebar">
  <div class="sidebar-logo">
    <h2>⚡ AdminX</h2>
    <span>Control Panel v2.0</span>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-label">Overview</div>
    <a href="/admin/dashboard" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
      <span class="icon">▣</span> Dashboard
    </a>

    <div class="nav-label">Manage</div>
    <a href="/admin/users" class="{{ request()->is('admin/users') ? 'active' : '' }}">
      <span class="icon">👤</span> Users
    </a>
    <a href="/admin/vendors" class="{{ request()->is('admin/vendors') ? 'active' : '' }}">
      <span class="icon">🏪</span> Vendors
    </a>
    <a href="/admin/orders" class="{{ request()->is('admin/orders') ? 'active' : '' }}">
      <span class="icon">📦</span> Orders
    </a>
  </nav>

  <div class="sidebar-footer">
    <a href="/admin/logout">
      <span class="icon">⏻</span> Logout
    </a>
  </div>
</div>

<div class="main">
  <div class="topbar">
    <span class="topbar-title">@yield('page_title', 'Dashboard')</span>
    <div class="topbar-right">
      <div style="text-align:right">
        <div style="font-size:13px;font-weight:600">Admin</div>
        <div style="font-size:11px;color:var(--muted)">Super Admin</div>
      </div>
      <div style="position:relative">
        <div class="avatar">A</div>
        <div class="badge-dot"></div>
      </div>
    </div>
  </div>

  <div class="content-wrap">
    @yield('content')
  </div>
</div>

</body>
</html>