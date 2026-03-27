@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 py-6 grid grid-cols-12 gap-6">

    

    <!-- COURSES -->
    <div class="col-span-12">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @foreach($courses as $c)
            <div class="card">
                    <div class="card-media" style="background:linear-gradient(135deg,#0a0f1f,#101828)">

                        @if($c->image)
                            <img src="{{ asset('courses/' . $c->image) }}" class="w-full h-full object-cover rounded-t-lg">
                        @else
                            <div class="flex items-center justify-center h-full text-white">
                                📚
                            </div>
                        @endif

                        <span class="card-media-tag tag-course"> {{ $c->category->name ?? 'No Category' }}</span>
                    </div>

                    <div class="card-body">
                        <div class="card-title">{{ $c->title }}</div>

                        <div class="card-desc">
                            {{ Str::limit($c->description, 100) }}
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="price price-blue">£{{ $c->price }}<span class="text-[12px]">/Per Month</span></div>

                        @if(auth()->check())
                            <a href="{{ url('/cart/add/course/' . $c->id) }}" class="add-btn add-blue">
                                + Add cart
                            </a>
                        @else
                            <a href="/login" class="add-btn add-blue">
                                + Add cart
                            </a>
                        @endif
                        <a href="{{ url('course/' . $c->id) }}" class="add-btn add-blue">
                            + View
                        </a>
                    </div>
                </div>
            @endforeach

        </div>

        <!-- PAGINATION -->
        <div class="mt-6">
            {{ $courses->links() }}
        </div>

    </div>

</div>

@endsection