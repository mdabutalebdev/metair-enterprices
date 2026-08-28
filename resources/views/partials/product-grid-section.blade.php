{{-- Centered-header product grid section (KindiMart "Popular Products" / "New
     Arrivals" style). Expects: $eyebrow, $title, $subtitle, $products, $viewAll. --}}
@if($products->isNotEmpty())
    <section class="container-x mt-8">
        {{-- Centered header --}}
        <div class="text-center mb-6">
            <div class="flex items-center justify-center gap-3 mb-2">
                <span class="w-8 h-px bg-accent/50"></span>
                <span class="text-accent text-[11px] font-bold tracking-[0.2em] uppercase">{{ $eyebrow }}</span>
                <span class="w-8 h-px bg-accent/50"></span>
            </div>
            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight">{{ $title }}</h2>
            @if(!empty($subtitle))
                <p class="text-muted text-sm mt-1">{{ $subtitle }}</p>
            @endif
        </div>

        {{-- Grid of up to 12 cards --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2">
            @foreach($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        {{-- View All button --}}
        <div class="text-center mt-6">
            <a href="{{ $viewAll }}" class="inline-flex items-center gap-2 border border-accent/60 text-accent font-medium text-sm px-5 h-10 rounded-full hover:bg-accent hover:text-white hover:border-accent transition">
                View All Products <i class="fa-solid fa-arrow-right text-xs"></i>
            </a>
        </div>
    </section>
@endif
