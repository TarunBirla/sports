<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Login</title>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
:root {
  --bg: #0d0f14; --surface: #13161e; --surface2: #1a1e2a;
  --border: rgba(255,255,255,0.06); --accent: #4f8ef7; --accent2: #7c5cf7;
  --danger: #f75f5f; --text: #e8eaf0; --muted: #6b7280;
}
body { font-family: 'DM Sans', sans-serif; background: var(--bg); color: var(--text); }

.login-page {
  min-height: 100vh;
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
  width: 700px; height: 700px;
  background: radial-gradient(circle, rgba(79,142,247,0.1) 0%, transparent 65%);
  pointer-events: none;
}

.login-page::after {
  content: '';
  position: absolute;
  bottom: -200px; right: -100px;
  width: 500px; height: 500px;
  background: radial-gradient(circle, rgba(124,92,247,0.08) 0%, transparent 65%);
  pointer-events: none;
}

.login-box {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: 20px;
  padding: 44px 40px;
  width: 100%;
  max-width: 400px;
  position: relative;
  z-index: 1;
  animation: fadeUp 0.5s ease both;
}

.login-brand {
  font-family: 'Syne', sans-serif;
  font-size: 20px;
  font-weight: 800;
  background: linear-gradient(135deg, var(--accent), var(--accent2));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  margin-bottom: 28px;
  display: block;
}

.login-box h2 {
  font-family: 'Syne', sans-serif;
  font-size: 24px;
  font-weight: 800;
  color: var(--text);
  margin-bottom: 6px;
}

.login-box p {
  font-size: 13px;
  color: var(--muted);
  margin-bottom: 30px;
}

.form-group { margin-bottom: 18px; }

.form-group label {
  display: block;
  font-size: 11px;
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
  transition: border-color 0.2s, box-shadow 0.2s;
}

.form-group input:focus {
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(79,142,247,0.1);
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

@keyframes fadeUp {
  from { opacity: 0; transform: translateY(20px); }
  to   { opacity: 1; transform: translateY(0); }
}
</style>
</head>
<body>

<div class="login-page">
  <div class="login-box">
    <span class="login-brand">⚡ AdminX</span>
    <h2>Welcome back</h2>
    <p>Sign in to access your control panel</p>

    <form method="POST" action="/admin/login">
      @csrf

      <div class="form-group">
        <label>Email Address</label>
        <input name="email" type="email" placeholder="admin@example.com" required>
      </div>

      <div class="form-group">
        <label>Password</label>
        <input name="password" type="password" placeholder="••••••••" required>
      </div>

      <button type="submit" class="btn-login">Sign In →</button>

      @if(session('error'))
        <div class="error-msg">⚠ {{ session('error') }}</div>
      @endif
    </form>
  </div>
</div>

</body>
</html>