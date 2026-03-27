@extends('layouts.app')

@section('content')
<section id="shop" class="bg-gray-100 py-12">
<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- TITLE -->
    <div class="text-center mb-12">
        
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900">
            All <span class="text-yellow-500">Products</span>
        </h2>
    </div>

    <!-- PRODUCTS GRID -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($products as $p)
        <div class="bg-white rounded-xl overflow-hidden border shadow-sm hover:shadow-lg transition duration-300">

            <!-- IMAGE -->
            <div class="relative">
                <img src="{{ $p->image ? asset('products/'.$p->image) : asset('assets/default.jpg') }}"
                     class="w-full h-52 object-cover">

                <!-- CATEGORY BADGE -->
                <span class="absolute top-3 left-3 bg-green-600 text-white text-xs px-3 py-1 rounded-full">
                    {{ $p->category->name ?? 'Product' }}
                </span>
            </div>

            <!-- CONTENT -->
            <div class="p-5">

                <!-- TITLE -->
                <h3 class="font-semibold text-gray-900 text-lg">
                    {{ $p->title }}
                </h3>

                <!-- DESCRIPTION -->
                <p class="text-sm text-gray-500 mt-2">
                    {{ Str::limit($p->description, 70) }}
                </p>

                <!-- PRICE + ACTION -->
                <div class="flex items-center justify-between mt-5">

                    <span class="text-yellow-500 font-bold text-lg">
                        £{{ $p->price }}
                    </span>

                    <div class="flex gap-2">

                        <!-- VIEW -->
                        <a href="{{ url('product/'.$p->id) }}"
                           class="px-3 py-1 bg-gray-200 rounded text-sm hover:bg-gray-300">
                            View
                        </a>

                        <!-- CART -->
                        @if(auth()->check())
                            <a href="{{ url('/cart/add/training/'.$p->id) }}"
                               class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700">
                           + Add to Cart
                            </a>
                        @else
                            <a href="/login"
                               class="px-3 py-1 bg-green-600 text-white rounded text-sm">
                                + Add to Cart
                            </a>
                        @endif

                    </div>

                </div>

            </div>
        </div>
        @endforeach

    </div>

    <!-- PAGINATION -->
    <div class="mt-10 flex justify-center">
        {{ $products->links() }}
    </div>

</div>
</section>

@endsection