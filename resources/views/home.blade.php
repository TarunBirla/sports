@extends('layouts.app')

@section('content')


<div class="hero-strip">
  <div class="hero-inner">
    <div class="hero-tag">🏆 Level Up Your Game</div>
    <h1 class="hero-title">Train Hard.<br><em>Win Big.</em></h1>
    <p class="hero-sub">Expert-led trainings &amp; courses built for athletes at every level.</p>
  </div>
</div>
<main>

  <!-- ── Trainings ── -->
  <div class="section-header">
    <div class="section-label">
      <div class="section-icon icon-green"> 📚</div>
      <div>
        <div class="section-title">Products</div>
        <div class="section-count">6 programs available</div>
      </div>
    </div>
    <span style="font-size:0.8rem;color:var(--text-muted)">Physical &amp; live sessions</span>
  </div>

    <div class="grid">
        @foreach($products as $p)
            <div class="card">
            <div class="card-media" style="background:linear-gradient(135deg,#0a0f1f,#101828)">
                
                <div class="card-media-inner" style="background:rgba(59,130,246,0.12)">
                📚
                </div>

                <span class="card-media-tag tag-training">Products</span>
            </div>

            <div class="card-body">
                <div class="card-title">{{ $p->title }}</div>

                <div class="card-desc">
                    {{ Str::limit($p->description, 100) }}
                </div>
            </div>

            <div class="card-footer">
                <div class="price price-green">₹{{ $p->price }}</div>

               @if(auth()->check())
    <a href="{{ url('/cart/add/training/'.$p->id) }}" class="add-btn add-green">
        + Add to cart
    </a>
@else
    <a href="/login" class="add-btn add-green">
        + Add to cart
    </a>
@endif
               <a href="{{ url('product/'.$p->id) }}"
                class="add-btn add-green">
                + View
                </a>
            </div>
            </div>
        @endforeach
    </div>


  <!-- ── Courses ── -->
  <div class="section-header section-gap">
    <div class="section-label">
      <div class="section-icon icon-blue">
        
     🏋️</div>
      <div>
        <div class="section-title">Trainings</div>
        <div class="section-count">4 Trainings available</div>
      </div>
    </div>
    <span style="font-size:0.8rem;color:rgba(255,255,255,0.3)">Self-paced &amp; online</span>
  </div>

  <div class="grid">
        @foreach($courses as $c)
            <div class="card">
            <div class="card-media" style="background:linear-gradient(135deg,#0a0f1f,#101828)">
                
                <div class="card-media-inner" style="background:rgba(59,130,246,0.12)">
                   🏋️
                </div>

                <span class="card-media-tag tag-course">Training</span>
            </div>

            <div class="card-body">
                <div class="card-title">{{ $c->title }}</div>

                <div class="card-desc">
                    {{ Str::limit($c->description, 100) }}
                </div>
            </div>

            <div class="card-footer">
                <div class="price price-blue">₹{{ $c->price }}</div>

                @if(auth()->check())
    <a href="{{ url('/cart/add/course/'.$c->id) }}" class="add-btn add-blue">
        + Add to cart
    </a>
@else
    <a href="/login" class="add-btn add-blue">
        + Add to cart
    </a>
@endif
                 <a href="{{ url('course/'.$c->id) }}"
                class="add-btn add-blue">
                + View
                </a>
            </div>
            </div>
        @endforeach
    </div>
</main>

@endsection