@extends('layouts.app')

@section('content')


    <div class="relative overflow-hidden h-[400px] ">

        @foreach($banners as $key => $b)
            <div
                class="slide absolute w-full h-full transition-opacity duration-700 {{ $key == 0 ? 'opacity-100' : 'opacity-0' }}">

                <img src="/banners/{{ $b->image }}" class="w-full h-full object-cover">

               <div class="absolute inset-0 flex flex-col items-center justify-center text-center text-white px-4">
    
    <h1 class="text-3xl md:text-5xl font-bold">
        {{ $b->title }}
    </h1>

    <p class="text-sm md:text-lg mt-3 max-w-xl">
        {{ $b->description }}
    </p>

</div>

            </div>
        @endforeach

    </div>
    <script>
        let slides = document.querySelectorAll('.slide');
        let index = 0;

        setInterval(() => {
            slides.forEach((s, i) => {
                s.style.opacity = i === index ? '1' : '0';
            });

            index = (index + 1) % slides.length;
        }, 3000);
    </script>

    <main>

       


        <!-- ── Courses ── -->
        <div class="section-header section-gap">
            <div class="section-label">
                <div class="section-icon icon-blue">

                    🏋️</div>
                <div>
                    <div class="section-title">Trainings</div>
                </div>
            </div>
        </div>
        

        <div class="grid">
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
                        <div class="price price-blue">£{{ $c->price }}<span class="text-[12px]">/ Per Month</span></div>

                        @if(auth()->check())
                            <a href="{{ url('/cart/add/course/' . $c->id) }}" class="add-btn add-blue">
                                + Add to cart
                            </a>
                        @else
                            <a href="/login" class="add-btn add-blue">
                                + Add to cart
                            </a>
                        @endif
                        <a href="{{ url('course/' . $c->id) }}" class="add-btn add-blue">
                            + View
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mb-4 mt-6">
            <a href="/all-courses" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">
                View All
            </a>
        </div>

         <!-- ── Trainings ── -->


        <div class="section-header">
            <div class="section-label">
                <div class="section-icon icon-green"> 📚</div>
                <div>
                    <div class="section-title">Products</div>
                </div>
            </div>
        </div>

       

        <div class="grid">
            @foreach($products as $p)
                <div class="card">
                    <div class="card-media relative" style="background:#000">

                        @if($p->image)
                            <img src="{{ asset('products/' . $p->image) }}" class="w-full h-full object-cover rounded-t-lg">
                        @else
                            <div class="flex items-center justify-center h-full text-white">
                                📚
                            </div>
                        @endif

                        <!-- CATEGORY BADGE -->
                        <span class="card-media-tag tag-training absolute top-2 left-2">
                            {{ $p->category->name ?? 'No Category' }}
                        </span>

                    </div>

                    <div class="card-body">
                        <div class="card-title">{{ $p->title }}</div>

                        <div class="card-desc">
                            {{ Str::limit($p->description, 100) }}
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="price price-green">£{{ $p->price }}<span class="text-[12px]">/ Per Month</span></div>

                        @if(auth()->check())
                            <a href="{{ url('/cart/add/training/' . $p->id) }}" class="add-btn add-green">
                                + Add to cart
                            </a>
                        @else
                            <a href="/login" class="add-btn add-green">
                                + Add to cart
                            </a>
                        @endif
                        <a href="{{ url('product/' . $p->id) }}" class="add-btn add-green">
                            + View
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mb-4 mt-6">
            <a href="/all-products"
                class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm hover:bg-blue-700 transition">
                View All
            </a>
        </div>

    </main>

@endsection




@extends('layouts.app')

@section('title','Home')

@section('content')




    

    


@endsection