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




<section id="shop" class="bg-gray-100 py-12">
    <div class="max-w-7xl mx-auto px-6">

        <!-- HEADER -->
        <div class="text-center mb-16">
           

            <h2 class="text-4xl md:text-5xl font-bold text-gray-900">
                Cricket <span class="text-yellow-500">Shop</span>
            </h2>
        </div>

        <!-- ================= COURSES ================= -->
        <div class="mb-20">
            <h3 class="text-2xl font-bold mb-8">🏋️ Trainings</h3>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach($courses as $c)
                <div class="bg-white rounded-xl overflow-hidden border shadow-sm hover:shadow-lg transition">

                    <!-- IMAGE -->
                    <img src="{{ $c->image ? asset('courses/'.$c->image) : asset('assets/default.jpg') }}"
                         class="w-full h-48 object-cover" />

                    <div class="p-6">

                        <!-- CATEGORY -->
                        <p class="text-green-600 text-sm mb-1">
                            {{ $c->category->name ?? 'Training' }}
                        </p>

                        <!-- TITLE -->
                        <h3 class="font-semibold text-gray-900">
                            {{ $c->title }}
                        </h3>

                        <!-- DESC -->
                        <p class="text-sm text-gray-500 mt-2">
                            {{ $c->description }}
                        </p>

                        <!-- PRICE + ACTION -->
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-yellow-500 font-semibold text-lg">
                                £{{ $c->price }}
                            </span>

                            <div class="flex gap-2">
                                <a href="{{ url('course/'.$c->id) }}"
                                   class="bg-gray-200 px-3 py-1 rounded text-sm">
                                    View
                                </a>

                                <a href="{{ url('/cart/add/course/'.$c->id) }}"
                                   class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                    +Add to Cart
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>

            <div class="text-center mt-10">
                <a href="/all-courses"
                   class="border px-6 py-2 rounded-lg hover:bg-gray-200">
                    View All Trainings →
                </a>
            </div>
        </div>

        <!-- ================= PRODUCTS ================= -->
        <div>
            <h3 class="text-2xl font-bold mb-8">📚 Products</h3>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                @foreach($products as $p)
                <div class="bg-white rounded-xl overflow-hidden border shadow-sm hover:shadow-lg transition">

                    <!-- IMAGE -->
                    <img src="{{ $p->image ? asset('products/'.$p->image) : asset('assets/default.jpg') }}"
                         class="w-full h-48 object-cover" />

                    <div class="p-6">

                        <!-- CATEGORY -->
                        <p class="text-green-600 text-sm mb-1">
                            {{ $p->category->name ?? 'Product' }}
                        </p>

                        <!-- TITLE -->
                        <h3 class="font-semibold text-gray-900">
                            {{ $p->title }}
                        </h3>

                        <!-- DESC -->
                        <p class="text-sm text-gray-500 mt-2">
                            {{ $p->description}}
                        </p>

                        <!-- PRICE + ACTION -->
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-yellow-500 font-semibold text-lg">
                                £{{ $p->price }}
                            </span>

                            <div class="flex gap-2">
                                <a href="{{ url('product/'.$p->id) }}"
                                   class="bg-gray-200 px-3 py-1 rounded text-sm">
                                    View
                                </a>

                                <a href="{{ url('/cart/add/training/'.$p->id) }}"
                                   class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                    +Add to Cart
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>

            <div class="text-center mt-10">
                <a href="/all-products"
                   class="border px-6 py-2 rounded-lg hover:bg-gray-200">
                    View All Products →
                </a>
            </div>
        </div>

    </div>
</section>


   

    <section id="about" class="bg-gray-100 py-24">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">

            <!-- Image -->

            <div data-aos="fade-right">
                <img src="{{ asset('assets/coaching.jpg') }}" alt="Cricket Training" class="rounded-2xl shadow-lg w-full" />
            </div>

            <!-- Content -->

            <div data-aos="fade-left">

                <p class="text-green-600 tracking-widest text-sm font-semibold mb-4">
                    ABOUT US
                </p>

                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                    Building Champions
                    <br />

                    <span class="text-yellow-500">
                        Since 2009
                    </span>
                </h2>

                <p class="text-gray-600 mt-6 leading-relaxed">
                    Elite Cricket Academy is a premier cricket training institution
                    dedicated to nurturing raw talent into world-class cricketers.
                    With state-of-the-art facilities, experienced coaches, and a
                    data-driven approach, we provide comprehensive training
                    programs for all age groups.
                </p>

                <!-- Features -->

                <div class="grid grid-cols-2 gap-6 mt-8">

                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 bg-green-600 rounded-full"></span>

                        <span class="text-gray-800">
                            Professional Coaches
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 bg-green-600 rounded-full"></span>

                        <span class="text-gray-800">
                            Indoor Nets
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 bg-green-600 rounded-full"></span>

                        <span class="text-gray-800">
                            Video Analysis
                        </span>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 bg-green-600 rounded-full"></span>

                        <span class="text-gray-800">
                            Fitness Training
                        </span>
                    </div>

                </div>

            </div>

        </div>
    </section>

    <section id="programs" class="py-24 text-white"
        style=" background: linear-gradient(135deg,hsl(220 50% 12%) 0%,hsl(220 45% 18%) 50%,hsl(145 40% 20%) 100%);">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Heading -->

            <div class="text-center mb-16" data-aos="fade-up">
                <p class="text-green-400 tracking-[0.25em] text-sm mb-4">
                    OUR PROGRAMS
                </p>

                <h2 class="text-4xl md:text-5xl font-bold">
                    Coaching
                    <span class="text-yellow-400">
                        Programs
                    </span>
                </h2>
            </div>

            <!-- Cards -->

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Card 1 -->

                <div class="bg-[#132842] rounded-xl p-8 hover:-translate-y-2 transition duration-300" data-aos="fade-up">
                    <div class="w-14 h-14 flex items-center justify-center bg-green-500/20 rounded-lg mb-6">
                        🎯
                    </div>

                    <h3 class="text-xl font-semibold mb-3">
                        Batting Mastery
                    </h3>

                    <p class="text-gray-300 text-sm leading-relaxed">
                        Master every shot from cover drives to pull shots
                        with our specialized batting program.
                    </p>

                    <div class="flex justify-between text-sm text-gray-400 mt-6">
                        <span>⏱ 3 Months</span>
                        <span>📊 All Levels</span>
                    </div>
                </div>

                <!-- Card 2 -->

                <div class="bg-[#132842] rounded-xl p-8 hover:-translate-y-2 transition duration-300" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="w-14 h-14 flex items-center justify-center bg-green-500/20 rounded-lg mb-6">
                        ⚡
                    </div>

                    <h3 class="text-xl font-semibold mb-3">
                        Fast Bowling
                    </h3>

                    <p class="text-gray-300 text-sm leading-relaxed">
                        Develop pace, swing, and accuracy with
                        biomechanical analysis and targeted drills.
                    </p>

                    <div class="flex justify-between text-sm text-gray-400 mt-6">
                        <span>⏱ 4 Months</span>
                        <span>📊 Intermediate</span>
                    </div>
                </div>

                <!-- Card 3 -->

                <div class="bg-[#132842] rounded-xl p-8 hover:-translate-y-2 transition duration-300" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="w-14 h-14 flex items-center justify-center bg-green-500/20 rounded-lg mb-6">
                        🛡
                    </div>

                    <h3 class="text-xl font-semibold mb-3">
                        Wicket Keeping
                    </h3>

                    <p class="text-gray-300 text-sm leading-relaxed">
                        Sharpen reflexes, learn positioning,
                        and master the art of keeping.
                    </p>

                    <div class="flex justify-between text-sm text-gray-400 mt-6">
                        <span>⏱ 3 Months</span>
                        <span>📊 All Levels</span>
                    </div>
                </div>

                <!-- Card 4 -->

                <div class="bg-[#132842] rounded-xl p-8 hover:-translate-y-2 transition duration-300" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="w-14 h-14 flex items-center justify-center bg-green-500/20 rounded-lg mb-6">
                        🏆
                    </div>

                    <h3 class="text-xl font-semibold mb-3">
                        Tournament Prep
                    </h3>

                    <p class="text-gray-300 text-sm leading-relaxed">
                        Intensive match-simulation training designed
                        to prepare players for competitive cricket.
                    </p>

                    <div class="flex justify-between text-sm text-gray-400 mt-6">
                        <span>⏱ 2 Months</span>
                        <span>📊 Advanced</span>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <section id="achievements" class="bg-gray-100 py-24">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Heading -->

            <div class="text-center mb-16" data-aos="fade-up">
                <p class="text-green-600 tracking-[0.25em] text-sm mb-4">
                    OUR PRIDE
                </p>

                <h2 class="text-4xl md:text-5xl font-bold text-gray-900">
                    Player
                    <span class="text-yellow-500">
                        Achievements
                    </span>
                </h2>
            </div>

            <!-- Content -->

            <div class="grid lg:grid-cols-2 gap-16 items-center">

                <!-- Achievement List -->

                <div class="space-y-6" data-aos="fade-right">

                    <div class="flex items-center bg-white rounded-xl p-6 shadow-sm border">
                        <div class="text-yellow-500 font-bold text-xl w-20">
                            2024
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">
                                National U-19 Championship
                            </h4>

                            <p class="text-gray-500 text-sm">
                                Winners
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white rounded-xl p-6 shadow-sm border">
                        <div class="text-yellow-500 font-bold text-xl w-20">
                            2023
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">
                                State Premier League
                            </h4>

                            <p class="text-gray-500 text-sm">
                                Runners-up
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white rounded-xl p-6 shadow-sm border">
                        <div class="text-yellow-500 font-bold text-xl w-20">
                            2023
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">
                                Best Academy Award
                            </h4>

                            <p class="text-gray-500 text-sm">
                                Regional
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white rounded-xl p-6 shadow-sm border">
                        <div class="text-yellow-500 font-bold text-xl w-20">
                            2022
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">
                                International Youth Cup
                            </h4>

                            <p class="text-gray-500 text-sm">
                                Semi-finalists
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white rounded-xl p-6 shadow-sm border">
                        <div class="text-yellow-500 font-bold text-xl w-20">
                            2022
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">
                                5 Players Selected
                            </h4>

                            <p class="text-gray-500 text-sm">
                                State Team
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center bg-white rounded-xl p-6 shadow-sm border">
                        <div class="text-yellow-500 font-bold text-xl w-20">
                            2021
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-900">
                                District Championship
                            </h4>

                            <p class="text-gray-500 text-sm">
                                Winners
                            </p>
                        </div>
                    </div>

                </div>

                <!-- Image -->

                <div data-aos="fade-left">
                    <img src="{{ asset('assets/trophy.jpg') }}" alt="Cricket Achievement"
                        class="rounded-2xl shadow-lg w-full" />
                </div>

            </div>

        </div>
    </section>


    <section id="gallery" class="py-24 hero-gradient">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Heading -->

            <div class="text-center mb-16" data-aos="fade-up">
                <p class="text-green-400 font-semibold tracking-[0.2em] uppercase text-sm mb-2">
                    Gallery
                </p>

                <h2 class="text-4xl md:text-5xl font-bold text-white">
                    Our
                    <span class="text-yellow-400">
                        Moments
                    </span>
                </h2>
            </div>

            <!-- Gallery Grid -->

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 auto-rows-[200px]">

                <!-- Image 1 -->

                <div class="rounded-lg overflow-hidden col-span-2 row-span-2" data-aos="zoom-in">
                    <img src="{{ asset('assets/player-batting.jpg') }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                </div>

                <!-- Image 2 -->

                <div class="rounded-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="100">
                    <img src="{{ asset('assets/player-bowling.jpg') }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                </div>

                <!-- Image 3 -->

                <div class="rounded-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{ asset('assets/coaching.jpg') }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                </div>

                <!-- Image 4 -->

                <div class="rounded-lg overflow-hidden col-span-2" data-aos="zoom-in" data-aos-delay="300">
                    <img src="{{ asset('assets/trophy.jpg') }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                </div>

                <!-- Image 5 -->

                <div class="rounded-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="400">
                    <img src="{{ asset('assets/hero-cricket.jpg') }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                </div>

                <!-- Image 6 -->

                <div class="rounded-lg overflow-hidden" data-aos="zoom-in" data-aos-delay="500">
                    <img src="{{ asset('assets/equipment.jpg') }}"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" />
                </div>

            </div>

        </div>
    </section>


    <section id="testimonials" class="bg-gray-100 py-24">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Heading -->

            <div class="text-center mb-16" data-aos="fade-up">
                <p class="text-green-600 tracking-[0.25em] text-sm mb-4">
                    TESTIMONIALS
                </p>

                <h2 class="text-4xl md:text-5xl font-bold text-gray-900">
                    What People
                    <span class="text-yellow-500">
                        Say
                    </span>
                </h2>
            </div>

            <!-- Testimonials Grid -->

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Card -->

                <div class="bg-white p-8 rounded-xl border shadow-sm hover:shadow-lg transition" data-aos="fade-up">
                    <div class="text-yellow-400 mb-4 text-lg">
                        ★★★★★
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed italic">
                        "The coaching here transformed my batting technique.
                        I went from scoring 20s to consistent 50s in just 3 months."
                    </p>

                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-900">
                            Rahul Sharma
                        </h4>

                        <p class="text-sm text-gray-500">
                            U-19 Player
                        </p>
                    </div>
                </div>

                <!-- Card -->

                <div class="bg-white p-8 rounded-xl border shadow-sm hover:shadow-lg transition" data-aos="fade-up"
                    data-aos-delay="100">
                    <div class="text-yellow-400 mb-4 text-lg">
                        ★★★★★
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed italic">
                        "The academy's approach to fitness and discipline
                        is outstanding. My son has become more focused
                        both on and off the field."
                    </p>

                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-900">
                            Priya Patel
                        </h4>

                        <p class="text-sm text-gray-500">
                            Parent
                        </p>
                    </div>
                </div>

                <!-- Card -->

                <div class="bg-white p-8 rounded-xl border shadow-sm hover:shadow-lg transition" data-aos="fade-up"
                    data-aos-delay="200">
                    <div class="text-yellow-400 mb-4 text-lg">
                        ★★★★★
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed italic">
                        "The video analysis and data-driven coaching
                        gave me insights I never had before.
                        Truly world-class training."
                    </p>

                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-900">
                            Amit Kumar
                        </h4>

                        <p class="text-sm text-gray-500">
                            State Player
                        </p>
                    </div>
                </div>

                <!-- Card -->

                <div class="bg-white p-8 rounded-xl border shadow-sm hover:shadow-lg transition" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="text-yellow-400 mb-4 text-lg">
                        ★★★★★
                    </div>

                    <p class="text-gray-600 text-sm leading-relaxed italic">
                        "Working at Elite Cricket Academy is a privilege.
                        The infrastructure and support we get to train
                        young talent is unmatched."
                    </p>

                    <div class="mt-6">
                        <h4 class="font-semibold text-gray-900">
                            Deepak Singh
                        </h4>

                        <p class="text-sm text-gray-500">
                            Coach
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>
    


@endsection