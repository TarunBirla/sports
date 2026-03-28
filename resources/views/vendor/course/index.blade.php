@extends('vendor.layout')

@section('page_title', 'My trainings')

@section('content')

<div >

    {{-- Section header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:2rem;padding-bottom:1.25rem;border-bottom:1.5px solid #d0e2f7">
        <div style="display:flex;align-items:center;gap:12px">
            <div style="width:44px;height:44px;border-radius:10px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:1.25rem">📚</div>
            <div>
                <div style="font-family:'Bebas Neue',sans-serif;font-size:1.9rem;letter-spacing:0.05em;color:#0d1f3c">My training</div>
                <div style="font-size:0.8rem;color:#8aaac8;font-weight:500">{{ count($courses) }} training(s) listed</div>
            </div>
        </div>
        <a href="/vendor/course/create"
           style="display:inline-flex;align-items:center;gap:6px;padding:9px 20px;border-radius:10px;background:#1a6fd4;color:#fff;font-size:0.875rem;font-weight:600;text-decoration:none;transition:background 0.18s"
           onmouseover="this.style.background='#1558b0'"
           onmouseout="this.style.background='#1a6fd4'"
        >+ Add training</a>
    </div>

    @if(count($courses) === 0)

        {{-- Empty state --}}
        <div style="text-align:center;padding:4rem 2rem;background:#fff;border:1px solid #d0e2f7;border-radius:16px">
            <div style="font-size:3rem;margin-bottom:1rem">📚</div>
            <div style="font-family:'Bebas Neue',sans-serif;font-size:1.5rem;letter-spacing:0.05em;color:#0d1f3c;margin-bottom:0.5rem">No courses yet</div>
            <p style="color:#8aaac8;font-size:0.9rem;margin-bottom:1.5rem">Create your first training to start selling.</p>
            <a href="/vendor/course/create"
               style="display:inline-flex;align-items:center;gap:6px;padding:10px 24px;border-radius:10px;background:#1a6fd4;color:#fff;font-size:0.9rem;font-weight:600;text-decoration:none"
            >+ Add Your First training</a>
        </div>

    @else

        {{-- Table card --}}
        <div style="background:#fff;border:1px solid #d0e2f7;border-radius:16px;overflow:hidden;box-shadow:0 4px 16px rgba(26,111,212,0.07)">

            {{-- Table header --}}
            <div style="display:grid;grid-template-columns:1fr 120px 140px;padding:10px 1.25rem;background:#f0f6ff;border-bottom:1.5px solid #d0e2f7">
                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8aaac8">Title</div>
                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8aaac8">Price</div>
                <div style="font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#8aaac8;text-align:right">Actions</div>
            </div>

            {{-- Rows --}}
            @foreach($courses as $c)
            <div style="display:grid;grid-template-columns:1fr 120px 140px;padding:1rem 1.25rem;border-bottom:1px solid #e8f1fd;align-items:center;transition:background 0.15s"
                 onmouseover="this.style.background='#f8fbff'"
                 onmouseout="this.style.background='transparent'"
            >
                {{-- Title --}}
                <div style="display:flex;align-items:center;gap:10px">
                    <div style="width:36px;height:36px;border-radius:8px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0">
                        @if($c->image)
                        <img src="{{ asset('courses/'.$c->image) }}" width="100">
                        @endif
                    </div>
                    <div>
                        <div style="font-size:0.925rem;font-weight:600;color:#0d1f3c">{{ $c->title }}</div>
                        <div style="font-size:0.75rem;color:#8aaac8;margin-top:1px">{{ $c->category->name ?? 'No Category' }}</div>
                    </div>
                </div>

                {{-- Price --}}
                <div style="font-family:'Bebas Neue',sans-serif;font-size:1.2rem;letter-spacing:0.03em;color:#2563eb">£{{ number_format($c->price, 2) }}</div>

                {{-- Actions --}}
                <div style="display:flex;align-items:center;gap:6px;justify-content:flex-end">
                    <a href="/vendor/course/edit/{{ $c->id }}"
                       style="display:inline-flex;align-items:center;gap:4px;padding:6px 14px;border-radius:8px;background:#e3eefd;color:#1a6fd4;font-size:0.8rem;font-weight:600;text-decoration:none;border:1px solid #93c5fd;transition:background 0.18s"
                       onmouseover="this.style.background='#c8dff9'"
                       onmouseout="this.style.background='#e3eefd'"
                    >✏️ Edit</a>

                    <form method="POST" action="/vendor/course/delete/{{ $c->id }}"
                          onsubmit="return confirm('Delete \'{{ addslashes($c->title) }}\'? This cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            style="display:inline-flex;align-items:center;gap:4px;padding:6px 14px;border-radius:8px;background:#fee2e2;color:#dc2626;font-size:0.8rem;font-weight:600;border:1px solid #fca5a5;cursor:pointer;transition:background 0.18s;font-family:'DM Sans',sans-serif"
                            onmouseover="this.style.background='#fecaca'"
                            onmouseout="this.style.background='#fee2e2'"
                        >🗑 Delete</button>
                    </form>
                </div>

            </div>
            @endforeach

        </div>

        {{-- Summary strip --}}
        <div style="margin-top:1rem;display:flex;align-items:center;justify-content:space-between;padding:0.75rem 1rem;background:#f0f6ff;border:1px solid #d0e2f7;border-radius:10px">
            <span style="font-size:0.8rem;color:#4a6890;font-weight:500">Showing {{ count($courses) }} training(s)</span>
            <a href="/vendor/course/create"
               style="font-size:0.8rem;font-weight:600;color:#1a6fd4;text-decoration:none"
               onmouseover="this.style.textDecoration='underline'"
               onmouseout="this.style.textDecoration='none'"
            >+ Add another</a>
        </div>

    @endif

</div>

@endsection