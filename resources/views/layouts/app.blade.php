<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Adnan Cricket Academy – Cricket Coaching</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        *,*::before,*::after{box-sizing:border-box;margin:0;padding:0}

        :root{
        --bg:#fff;
        --surface:#ffffff;
        --surface-2:#e8f1fd;
        --border:#d0e2f7;
        --border-strong:#a8c8f0;
        --text-primary:#0d1f3c;
        --text-secondary:#4a6890;
        --text-muted:#8aaac8;
        --accent:#1a6fd4;
        --accent-light:#e3eefd;
        --accent-hover:#1558b0;
        --green:#2563eb;
        --green-light:#dbeafe;
        --green-border:#93c5fd;
        --blue:#2563eb;
        --blue-light:#dbeafe;
        --blue-border:#93c5fd;
        --red:#dc2626;
        --red-light:#fee2e2;
        }

        html{scroll-behavior:smooth}

        body{
        background:var(--bg);
        color:var(--text-primary);
        font-family:'DM Sans',sans-serif;
        font-size:16px;
        line-height:1.6;
        min-height:100vh;
        }

        /* ── Header ── */
        header{
        position:sticky;top:0;z-index:100;
        background:rgba(255,255,255,0.92);
        backdrop-filter:blur(12px);
        border-bottom:1px solid var(--border);
        box-shadow:0 1px 12px rgba(26,111,212,0.07);
        }
        .header-inner{
        max-width:1280px;margin:0 auto;padding:0 2rem;
        height:68px;display:flex;align-items:center;justify-content:space-between;
        }
        .logo{
        font-family:'Bebas Neue',sans-serif;
        font-size:1.8rem;letter-spacing:0.04em;
        color:var(--text-primary);display:flex;align-items:center;gap:8px;
        text-decoration:none;
        }
        .logo span{color:var(--accent)}
        nav{display:flex;align-items:center;gap:6px}
       
        .btn-accent{background:var(--accent);color:#fff}
        .btn-accent:hover{background:var(--accent-hover)}
        .btn-ghost{
        background:var(--accent-light);color:var(--accent);
        border:1px solid var(--blue-border);
        }
        .btn-ghost:hover{background:#c8dff9}
        .btn-danger{background:var(--red-light);color:var(--red);border:1px solid #fca5a5}
        .btn-danger:hover{background:#fecaca}
        .nav-user{
        display:flex;align-items:center;gap:8px;
        padding:5px 12px;border-radius:8px;
        background:var(--surface-2);border:1px solid var(--border);
        font-size:0.875rem;font-weight:500;color:var(--text-primary);
        }
        .cart-btn{position:relative}
        .cart-badge{
        position:absolute;top:-6px;right:-6px;
        background:var(--accent);color:#fff;
        font-size:10px;font-weight:700;
        width:18px;height:18px;border-radius:50%;
        display:flex;align-items:center;justify-content:center;
        }

        /* ── Hero strip ── */
        .hero-strip{
        background:linear-gradient(135deg,#c8dff9 0%,#ddeeff 40%,#e8f4ff 100%);
        border-bottom:1px solid var(--border);
        padding:4rem 2rem 3rem;
        position:relative;overflow:hidden;
        }
        .hero-strip::before{
        content:'SPORTS ACADEMY';
        position:absolute;right:-2rem;top:50%;transform:translateY(-50%);
        font-family:'Bebas Neue',sans-serif;font-size:12rem;
        color:rgba(26,111,212,0.07);letter-spacing:0.02em;
        white-space:nowrap;pointer-events:none;line-height:1;
        }
        .hero-inner{max-width:1280px;margin:0 auto}
        .hero-tag{
        display:inline-flex;align-items:center;gap:8px;
        background:rgba(26,111,212,0.1);
        border:1px solid rgba(26,111,212,0.3);
        border-radius:20px;padding:4px 14px;
        font-size:0.75rem;font-weight:600;letter-spacing:0.08em;
        color:var(--accent);text-transform:uppercase;margin-bottom:1rem;
        }
        .hero-title{
        font-family:'Bebas Neue',sans-serif;
        font-size:clamp(2.5rem,6vw,4.5rem);letter-spacing:0.03em;
        line-height:1;margin-bottom:0.5rem;color:var(--text-primary);
        }
        .hero-title em{color:var(--accent);font-style:normal}
        .hero-sub{color:var(--text-secondary);font-size:1rem;max-width:520px}

        /* ── Main ── */
        main{max-width:1280px;margin:0 auto;padding:3rem 2rem 6rem}

        /* ── Section header ── */
        .section-header{
        display:flex;align-items:flex-end;justify-content:space-between;
        margin-bottom:2rem;
        border-bottom:1.5px solid var(--border);
        padding-bottom:1.25rem;
        }
        .section-label{display:flex;align-items:center;gap:12px}
        .section-icon{
        width:44px;height:44px;border-radius:10px;
        display:flex;align-items:center;justify-content:center;font-size:1.25rem;
        }
        .icon-green{background:var(--green-light)}
        .icon-blue{background:var(--blue-light)}
        .section-title{
        font-family:'Bebas Neue',sans-serif;
        font-size:1.9rem;letter-spacing:0.05em;color:var(--text-primary);
        }
        .section-count{font-size:0.8rem;color:var(--text-muted);font-weight:500}
        .section-gap{margin-top:4.5rem}

        /* ── Grid ── */
        .grid{
        display:grid;
        grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
        gap:1.25rem;
        }

        /* ── Card ── */
        .card{
        background:var(--surface);
        border:1px solid var(--border);
        border-radius:16px;overflow:hidden;
        transition:transform 0.22s,border-color 0.22s,box-shadow 0.22s;
        display:flex;flex-direction:column;
        }
        .card:hover{
        transform:translateY(-4px);
        border-color:var(--border-strong);
        box-shadow:0 12px 36px rgba(26,111,212,0.13);
        }
        .card-media{
        height:180px;
        display:flex;align-items:center;justify-content:center;
        position:relative;overflow:hidden;
        }
        .card-media-inner{
        width:72px;height:72px;border-radius:50%;
        display:flex;align-items:center;justify-content:center;font-size:2rem;
        }
        .card-media-tag{
        position:absolute;top:12px;left:12px;
        font-size:0.7rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;
        padding:3px 10px;border-radius:20px;
        }
        .tag-training{background:var(--green-light);color:var(--green);border:1px solid var(--green-border)}
        .tag-course{background:var(--blue-light);color:var(--blue);border:1px solid var(--blue-border)}
        .card-body{padding:1.25rem;flex:1;display:flex;flex-direction:column;gap:8px}
        .card-title{font-size:1.05rem;font-weight:600;line-height:1.3;color:var(--text-primary)}
        .card-desc{font-size:0.85rem;color:var(--text-secondary);line-height:1.55;flex:1}
        .card-footer{
        padding:1rem 1.25rem;
        border-top:1px solid var(--border);
        display:flex;align-items:center;justify-content:space-between;
        background:var(--surface-2);
        }
        .price{font-family:'Bebas Neue',sans-serif;font-size:1.6rem;letter-spacing:0.03em}
        .price-green{color:var(--green)}
        .price-blue{color:var(--blue)}
        .add-btn{
        display:inline-flex;align-items:center;gap:6px;
        padding:8px 18px;border-radius:8px;
        font-size:0.85rem;font-weight:600;
        text-decoration:none;transition:all 0.18s;
        }
        .add-green{background:var(--green-light);color:var(--green);border:1px solid var(--green-border)}
        .add-green:hover{background:#bbf7d0;border-color:#4ade80}
        .add-blue{background:var(--blue-light);color:var(--blue);border:1px solid var(--blue-border)}
        .add-blue:hover{background:#bfdbfe;border-color:#60a5fa}

        /* ── Footer ── */
        footer{
        border-top:1px solid var(--border);
        background:var(--surface);
        padding:2rem;text-align:center;
        color:var(--text-muted);font-size:0.8rem;
        }
        footer strong{color:var(--text-secondary)}

        /* ── Responsive ── */
        @media(max-width:640px){
        .header-inner{padding:0 1rem}
        nav a:not(.btn){display:none}
        .hero-strip{padding:2.5rem 1rem 2rem}
        .hero-strip::before{font-size:5rem}
        main{padding:2rem 1rem 4rem}
        .section-header{flex-direction:column;align-items:flex-start;gap:8px}
        .grid{grid-template-columns:1fr}
        }

        /* ── Animations ── */
        @keyframes fadeUp{from{opacity:0;transform:translateY(16px)}to{opacity:1;transform:translateY(0)}}
        .card{animation:fadeUp 0.4s ease both}
        .card:nth-child(1){animation-delay:.05s}
        .card:nth-child(2){animation-delay:.1s}
        .card:nth-child(3){animation-delay:.15s}
        .card:nth-child(4){animation-delay:.2s}
        .card:nth-child(5){animation-delay:.25s}
        .card:nth-child(6){animation-delay:.3s}
    </style>
</head>
<body>


@include('layouts.header')
@yield('content')

@include('layouts.footer')
