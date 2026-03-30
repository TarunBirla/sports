@extends('layouts.app')

@section('content')

<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --gold: #c8a45e;
        --gold-light: #f5edd8;
        --ink: #1a1a2e;
        --ink-soft: #3d3d56;
        --cream: #faf8f5;
        --sage: #4a7c59;
        --sage-light: #e8f2eb;
        --red-soft: #e05252;
        --border: #e8e4dc;
        --blue: #3b6cf8;
        --blue-light: #eef1fe;
    }

    * { box-sizing: border-box; }
    body { font-family: 'DM Sans', sans-serif; background: var(--cream); margin: 0; }
    .serif { font-family: 'Playfair Display', serif; }

    /* ── Hero Banner ── */
    .course-hero {
        background: linear-gradient(135deg, #1a1a2e 0%, #2d2d4a 60%, #3b3b5e 100%);
        padding: 60px 0 0;
        position: relative;
        overflow: hidden;
    }
    .course-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .hero-inner {
        max-width: 1400px; margin: auto; padding: 0 24px;
        display: grid; grid-template-columns: 1fr 360px; gap: 40px; align-items: end;
    }
    .hero-left { padding-bottom: 40px; }
    .hero-right { position: relative; }

    /* Breadcrumb */
    .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 13px; color: #8888aa; margin-bottom: 20px; flex-wrap: wrap; }
    .breadcrumb a { color: var(--gold); text-decoration: none; }
    .breadcrumb a:hover { opacity: .75; }

    /* Course type badge */
    .type-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(200,164,94,0.15); color: var(--gold);
        border: 1px solid rgba(200,164,94,0.3);
        font-size: 11px; font-weight: 700; letter-spacing: 1.2px;
        text-transform: uppercase; padding: 5px 14px; border-radius: 50px;
        margin-bottom: 18px;
    }

    .hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem; font-weight: 700; color: #fff;
        line-height: 1.25; margin-bottom: 16px;
    }
    .hero-desc { color: #b0b0cc; font-size: 15px; line-height: 1.75; margin-bottom: 22px; max-width: 560px; }

    .hero-meta { display: flex; flex-wrap: wrap; gap: 18px; margin-bottom: 24px; }
    .hero-meta-item { display: flex; align-items: center; gap: 7px; font-size: 13px; color: #c0c0d8; }
    .hero-meta-item strong { color: #fff; }

    .stars-wrap { display: flex; align-items: center; gap: 8px; }
    .stars { color: var(--gold); letter-spacing: 2px; font-size: 15px; }
    .rating-num { color: #fff; font-weight: 700; }
    .rating-count { color: #8888aa; font-size: 13px; }

    /* Floating enroll card */
    .enroll-card {
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.25);
        padding: 24px;
        position: sticky; top: 20px;
        margin-bottom: -20px;
    }
    .course-thumb {
        width: 100%; aspect-ratio: 16/9;
        border-radius: 12px; overflow: hidden;
        background: linear-gradient(135deg,#f0ede8,#e8e4dc);
        display: flex; align-items: center; justify-content: center;
        font-size: 60px; margin-bottom: 18px;
    }
    .course-thumb img { width: 100%; height: 100%; object-fit: cover; display: block; }

    .price-row { display: flex; align-items: center; gap: 10px; margin-bottom: 5px; }
    .price-main { font-family: 'Playfair Display', serif; font-size: 2rem; color: var(--ink); font-weight: 700; }
    .price-old { text-decoration: line-through; color: #bbb; font-size: 1rem; }
    .discount-chip { background: #fde8e8; color: var(--red-soft); font-size: 11px; font-weight: 700; padding: 3px 9px; border-radius: 50px; }
    .offer-note { font-size: 12px; color: var(--red-soft); font-weight: 600; margin-bottom: 16px; }

    .btn-enroll {
        display: block; width: 100%; text-align: center;
        background: var(--ink); color: #fff;
        padding: 15px; border-radius: 14px;
        font-size: 16px; font-weight: 700;
        text-decoration: none; margin-bottom: 10px;
        transition: background 0.2s, transform 0.15s;
        font-family: 'DM Sans', sans-serif;
    }
    .btn-enroll:hover { background: #2d2d4a; transform: translateY(-2px); }
    .btn-cart-sm {
        display: block; width: 100%; text-align: center;
        background: var(--gold); color: #fff;
        padding: 13px; border-radius: 14px;
        font-size: 15px; font-weight: 600;
        text-decoration: none; margin-bottom: 10px;
        transition: background 0.2s, transform 0.15s;
        font-family: 'DM Sans', sans-serif;
    }
    .btn-cart-sm:hover { background: #b8924e; transform: translateY(-2px); }
    .btn-wish-sm {
        display: block; width: 100%; text-align: center;
        background: #fff; color: var(--ink-soft);
        padding: 12px; border-radius: 14px;
        font-size: 14px; font-weight: 600;
        border: 1.5px solid var(--border); cursor: pointer;
        transition: border-color 0.2s, background 0.2s;
        font-family: 'DM Sans', sans-serif;
    }
    .btn-wish-sm:hover { border-color: var(--red-soft); background: #fde8e8; color: var(--red-soft); }

    .guarantee { text-align: center; font-size: 12px; color: #aaa; margin-top: 12px; }

    .card-includes { margin-top: 18px; padding-top: 16px; border-top: 1px solid var(--border); }
    .card-includes h4 { font-weight: 700; font-size: 13px; color: var(--ink); margin-bottom: 10px; text-transform: uppercase; letter-spacing: .5px; }
    .include-item { display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--ink-soft); padding: 5px 0; }

    /* ── Main Content ── */
    .content-wrap { max-width: 1400px; margin: 40px auto; padding: 0 24px; display: grid; grid-template-columns: 1fr 360px; gap: 40px; }
    .main-col { min-width: 0; }

    /* Section card */
    .section-card { background: #fff; border: 1px solid var(--border); border-radius: 20px; padding: 28px; margin-bottom: 24px; }
    .section-title { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 700; color: var(--ink); margin-bottom: 18px; }

    /* Learning outcomes */
    .outcomes-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
    .outcome-item { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: var(--ink-soft); line-height: 1.5; }
    .outcome-icon { color: var(--sage); font-size: 16px; margin-top: 1px; flex-shrink: 0; }

    /* Curriculum */
    .module { border: 1px solid var(--border); border-radius: 14px; overflow: hidden; margin-bottom: 10px; }
    .module-header {
        background: #f9f7f4; padding: 14px 18px;
        display: flex; justify-content: space-between; align-items: center;
        cursor: pointer; user-select: none;
    }
    .module-header:hover { background: #f0ede8; }
    .module-title { font-weight: 700; font-size: 14px; color: var(--ink); }
    .module-meta { font-size: 12px; color: #888; }
    .module-body { padding: 0 18px; }
    .lesson-item { display: flex; align-items: center; gap: 10px; padding: 11px 0; border-bottom: 1px solid var(--border); font-size: 14px; color: var(--ink-soft); }
    .lesson-item:last-child { border-bottom: none; }
    .lesson-icon { font-size: 15px; flex-shrink: 0; }
    .lesson-duration { margin-left: auto; font-size: 12px; color: #aaa; }
    .lesson-free { font-size: 10px; font-weight: 700; color: var(--sage); background: var(--sage-light); padding: 2px 7px; border-radius: 50px; }

    /* Instructor */
    .instructor-avatar {
        width: 72px; height: 72px; border-radius: 50%;
        background: var(--gold-light); display: flex; align-items: center;
        justify-content: center; font-size: 28px; font-weight: 700;
        color: var(--gold); flex-shrink: 0;
    }
    .instructor-stats { display: flex; gap: 20px; margin-top: 14px; flex-wrap: wrap; }
    .inst-stat { text-align: center; }
    .inst-stat-num { font-weight: 700; color: var(--ink); font-size: 18px; }
    .inst-stat-label { font-size: 12px; color: #888; }

    /* Reviews */
    .review-card { background: var(--cream); border: 1px solid var(--border); border-radius: 14px; padding: 18px; margin-bottom: 12px; }
    .reviewer-avatar { width: 40px; height: 40px; border-radius: 50%; background: var(--gold-light); display: flex; align-items: center; justify-content: center; font-weight: 700; color: var(--gold); font-size: 15px; flex-shrink: 0; }

    /* Tabs */
    .tab-nav { display: flex; gap: 0; border-bottom: 2px solid var(--border); margin-bottom: 24px; overflow-x: auto; }
    .tab-btn { background: none; border: none; padding: 12px 20px; font-size: 14px; font-weight: 600; cursor: pointer; color: #888; font-family: 'DM Sans', sans-serif; border-bottom: 2px solid transparent; margin-bottom: -2px; white-space: nowrap; transition: color 0.2s, border-color 0.2s; }
    .tab-btn.active { color: var(--ink); border-bottom-color: var(--gold); }
    .tab-content { display: none; }
    .tab-content.active { display: block; }

    /* Progress bar */
    .progress-bar { height: 6px; background: #eee; border-radius: 99px; overflow: hidden; flex: 1; }
    .progress-fill { height: 100%; background: var(--gold); border-radius: 99px; }

    /* Requirements */
    .req-item { display: flex; align-items: flex-start; gap: 10px; font-size: 14px; color: var(--ink-soft); padding: 7px 0; }

    /* Info table */
    .info-table { width: 100%; border-collapse: collapse; font-size: 14px; }
    .info-table td { padding: 11px 14px; border-bottom: 1px solid var(--border); }
    .info-table tr:last-child td { border-bottom: none; }
    .info-table td:first-child { color: #888; font-weight: 500; width: 45%; }
    .info-table td:last-child { color: var(--ink); font-weight: 600; }

    /* Right sidebar sticky */
    .sidebar-col { }

    /* Share row */
    .share-row { display: flex; gap: 8px; margin-top: 16px; }
    .share-btn { flex: 1; padding: 9px; border-radius: 10px; border: 1.5px solid var(--border); background: #fff; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 6px; color: var(--ink-soft); transition: background 0.2s; font-family: 'DM Sans', sans-serif; }
    .share-btn:hover { background: var(--cream); }

    @media (max-width: 768px) {
        .hero-inner { grid-template-columns: 1fr; }
        .hero-right { display: none; }
        .content-wrap { grid-template-columns: 1fr; }
        .sidebar-col { order: -1; }
        .outcomes-grid { grid-template-columns: 1fr; }
        .hero-title { font-size: 1.8rem; }
        .enroll-card { position: static; margin-bottom: 0; }
    }
</style>

{{-- ══════════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════════ --}}
<div class="course-hero">
    <div class="hero-inner">

        {{-- Left: Course Info --}}
        <div class="hero-left">

            
           

            {{-- Badge --}}
            <div class="type-badge">🎓 Professional Training</div>

            {{-- Title --}}
            <h1 class="hero-title">{{ $course->title }}</h1>

            {{-- Description --}}
            <p class="hero-desc">{{ $course->description }}</p>

            {{-- Rating --}}
            <div class="stars-wrap mb-4">
                <span class="rating-num">4.8</span>
                <span class="stars">★★★★★</span>
                <span class="rating-count">(1,240 ratings) • 4,500+ students</span>
            </div>

            {{-- Meta --}}
            <div class="hero-meta">
                <div class="hero-meta-item">👤 Created by <strong>&nbsp;Expert Trainer</strong></div>
                <div class="hero-meta-item">🕐 Last updated <strong>&nbsp;March 2025</strong></div>
                <div class="hero-meta-item">🌐 <strong>English</strong></div>
                <div class="hero-meta-item">📜 <strong>Certificate Included</strong></div>
            </div>

        </div>

        {{-- Right: Enroll Card (desktop) --}}
        <div class="hero-right">
            <div class="enroll-card">

                {{-- Thumbnail --}}
                <div class="course-thumb">
                    @if(!empty($course->image))
                        <img src="{{ asset('courses/'.$course->image) }}" alt="{{ $course->title }}">
                    @else
                        🎓
                    @endif
                </div>

                <div class="price-row">
                    <span class="price-main">£{{ number_format($course->price, 2) }}</span>
                    <span class="price-old">£{{ number_format($course->price * 1.4, 2) }}</span>
                   
                </div>
                
                <a href="{{ url('/cart/add/course/'.$course->id) }}" class="btn-cart-sm">🛒 Add to Cart</a>
               
            </div>
        </div>

    </div>
</div>

{{-- ══════════════════════════════════════════════
     MAIN CONTENT
══════════════════════════════════════════════ --}}
<div class="content-wrap">

    {{-- ── Main Column ── --}}
    <div class="main-col">

        {{-- What You'll Learn --}}
        <div class="section-card">
            <h2 class="section-title">📚 What You'll Learn</h2>
            <div class="outcomes-grid">
                @foreach([
                    'Fundamentals of batting, bowling & fielding techniques',
                    'Proper stance, grip, and shot selection for batting',
                    'Fast bowling and spin bowling techniques',
                    'Fielding drills including catching, throwing & agility',
                    'Match awareness and game strategy development',
                    'Fitness training for stamina, strength & endurance',
                    'Practice sessions with real match scenarios',
                    'Performance tracking and improvement techniques',
                ] as $outcome)
                <div class="outcome-item">
                    <span class="outcome-icon">✔</span>
                    {{ $outcome }}
                </div>
                @endforeach
            </div>
        </div>

        {{-- Tabs: Curriculum / Requirements / Reviews / Info --}}
        <div class="section-card">
            <div class="tab-nav">
                <!-- <button class="tab-btn active" onclick="openTab(event,'t-curriculum')">🗂️ Curriculum</button> -->
                <button class="tab-btn" onclick="openTab(event,'t-requirements')">📋 Requirements</button>
                <!-- <button class="tab-btn" onclick="openTab(event,'t-reviews')">⭐ Reviews</button> -->
                <button class="tab-btn" onclick="openTab(event,'t-instructor')">👤 Instructor</button>
                <button class="tab-btn" onclick="openTab(event,'t-faq')">💬 FAQ</button>
            </div>

            {{-- CURRICULUM --}}
            <!-- <div id="t-curriculum" class="tab-content active">
                <p style="font-size:13px;color:#888;margin-bottom:16px;">
                    6 modules • 28 lessons • 18 hours total
                </p>
                @foreach([
                    ['Module 1: Foundations', '5 lessons', '2h 30m', [
                        ['🎥','Introduction & Overview','8:24','free'],
                        ['🎥','Core Concepts Explained','22:10','free'],
                        ['📝','Foundations Quiz','—',''],
                        ['🎥','Setting Up Your Workspace','18:45',''],
                        ['📁','Starter Resources','—',''],
                    ]],
                    ['Module 2: Core Skills', '6 lessons', '3h 15m', [
                        ['🎥','Skill Building Part 1','30:00',''],
                        ['🎥','Skill Building Part 2','28:15',''],
                        ['🎥','Applied Practice','25:40',''],
                        ['📝','Core Skills Assignment','—',''],
                        ['🎥','Expert Techniques','35:00',''],
                        ['📁','Module Resources','—',''],
                    ]],
                    ['Module 3: Advanced Topics', '5 lessons', '4h 00m', [
                        ['🎥','Advanced Methodology','40:00',''],
                        ['🎥','Complex Scenarios','38:30',''],
                        ['📝','Advanced Assessment','—',''],
                        ['🎥','Industry Case Study','45:00',''],
                        ['🎥','Performance Optimisation','50:00',''],
                    ]],
                ] as [$modTitle, $lessonCount, $duration, $lessons])
                <div class="module">
                    <div class="module-header" onclick="toggleModule(this)">
                        <div>
                            <div class="module-title">{{ $modTitle }}</div>
                            <div class="module-meta">{{ $lessonCount }} • {{ $duration }}</div>
                        </div>
                        <span style="color:var(--gold);font-size:18px;">›</span>
                    </div>
                    <div class="module-body" style="display:none;">
                        @foreach($lessons as [$icon, $title, $dur, $free])
                        <div class="lesson-item">
                            <span class="lesson-icon">{{ $icon }}</span>
                            <span>{{ $title }}</span>
                            @if($free)
                                <span class="lesson-free">FREE</span>
                            @endif
                            <span class="lesson-duration">{{ $dur }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div> -->

            {{-- REQUIREMENTS --}}
            <div id="t-requirements" class="tab-content">
                <h4 style="font-weight:700;color:var(--ink);margin-bottom:14px;">Prerequisites</h4>
                    @foreach([
                        'No prior cricket experience required — beginners welcome',
                        'Basic fitness level recommended for training sessions',
                        'Bring your own cricket kit (bat, gloves, pads optional)',
                        'Strong interest in learning and improving cricket skills'
                    ] as $req)
                    <div class="req-item"><span style="color:var(--gold);">◆</span> {{ $req }}</div>
                 @endforeach
            </div>

            {{-- INSTRUCTOR --}}
            <div id="t-instructor" class="tab-content">
                <div style="display:flex;gap:16px;align-items:flex-start;flex-wrap:wrap;">
                    <div class="instructor-avatar">ET</div>
                    <div style="flex:1;min-width:200px;">
                        <div style="font-weight:700;font-size:17px;color:var(--ink);">Expert Trainer</div>
                        <div style="font-size:13px;color:#888;margin-bottom:10px;">Senior Training Specialist & Performance Coach</div>
                        <div class="stars" style="font-size:13px;">★★★★★</div>
                        <div class="instructor-stats">
                            <div class="inst-stat"><div class="inst-stat-num">4.8</div><div class="inst-stat-label">Rating</div></div>
                            <div class="inst-stat"><div class="inst-stat-num">12k+</div><div class="inst-stat-label">Students</div></div>
                            <div class="inst-stat"><div class="inst-stat-num">18</div><div class="inst-stat-label">Courses</div></div>
                            <div class="inst-stat"><div class="inst-stat-num">8 yrs</div><div class="inst-stat-label">Experience</div></div>
                        </div>
                    </div>
                </div>
                <p style="font-size:14px;color:var(--ink-soft);line-height:1.75;margin-top:18px;">
                   An experienced cricket coach with over 8 years of professional training expertise, specializing in batting, bowling, and fielding techniques. The coach has trained players at district and state levels, focusing on skill development, match performance, and fitness. Their practical coaching approach ensures players improve consistently and gain confidence for real match situations.
                </p>
            </div>

            {{-- FAQ --}}
            <div id="t-faq" class="tab-content">
                @foreach([
                    ['Is this training suitable for beginners?','Yes, the program is designed for beginners as well as intermediate players.'],
                    ['What equipment do I need?','Basic cricket kit is recommended, but beginners can start without full equipment.'],
                    ['Are there live practice matches?','Yes, regular practice matches are conducted to improve real-game performance.'],
                    ['Will fitness training be included?','Yes, sessions include fitness, stamina, and agility training.'],
                    ['Do I get a certificate?','Yes, a training completion certificate will be provided.'],
                ] as [$q,$a])
                <details style="border-bottom:1px solid var(--border);padding:16px 0;cursor:pointer;">
                    <summary style="font-weight:600;color:var(--ink);font-size:15px;list-style:none;display:flex;justify-content:space-between;">
                        {{ $q }} <span style="color:var(--gold);flex-shrink:0;margin-left:8px;">+</span>
                    </summary>
                    <p style="color:var(--ink-soft);font-size:14px;line-height:1.75;margin:10px 0 0;">{{ $a }}</p>
                </details>
                @endforeach
            </div>

        </div>

    </div>

    {{-- ── Sidebar Column ── --}}
    <div class="sidebar-col">

        {{-- Mobile enroll card --}}
        <div class="enroll-card" style="display:none;" id="mobileCard">
            {{-- same card content omitted for brevity, shown on desktop --}}
        </div>

        {{-- Course Details Card --}}
        <div class="section-card" style="margin-bottom:20px;">
            <h3 class="section-title" style="font-size:1.1rem;">📋 Training Details</h3>
            <table class="info-table">
                <tr><td>Level</td><td>All Levels</td></tr>
                <tr><td>Duration</td><td>Weekly Sessions</td></tr>
                <tr><td>Modules</td><td>6 Modules</td></tr>
                <tr><td>Lessons</td><td>28 Lessons</td></tr>
                <tr><td>Language</td><td>English</td></tr>
                <tr><td>Category</td><td>{{ optional($course->category)->name ?? '—' }}</td></tr>
                <tr><td>Last Updated</td><td>March 2025</td></tr>
            </table>
        </div>

        {{-- Tags --}}
        <div class="section-card">
            <h3 class="section-title" style="font-size:1.1rem;">🏷️ Tags</h3>
            <div style="display:flex;flex-wrap:wrap;gap:8px;">
                @foreach(['Cricket','Batting','Bowling','Fielding','Fitness','Coaching','Sports Training','Academy'] as $tag)                <span style="background:var(--cream);border:1px solid var(--border);border-radius:50px;padding:5px 13px;font-size:12px;color:var(--ink-soft);font-weight:500;">{{ $tag }}</span>
                @endforeach
            </div>
        </div>

    </div>
</div>

<script>
function openTab(e, id) {
    document.querySelectorAll('.tab-content').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    e.currentTarget.classList.add('active');
}

function toggleModule(header) {
    const body = header.nextElementSibling;
    const icon = header.querySelector('span');
    const isOpen = body.style.display !== 'none';
    body.style.display = isOpen ? 'none' : 'block';
    icon.style.transform = isOpen ? '' : 'rotate(90deg)';
    icon.style.transition = 'transform 0.2s';
}

function toggleWish(btn) {
    btn.textContent = btn.textContent.includes('🤍') ? '❤️ Wishlisted' : '🤍 Add to Wishlist';
}

// Open first module by default
document.addEventListener('DOMContentLoaded', () => {
    const first = document.querySelector('.module-header');
    if (first) toggleModule(first);
});
</script>

@endsection