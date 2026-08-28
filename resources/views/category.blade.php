<x-layout :title="$title">
    <div class="container-x py-5">
        {{-- Breadcrumb --}}
        <nav class="flex flex-wrap items-center gap-y-1 text-xs text-muted mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand">Home</a>
            <span class="mx-1">/</span>
            <a href="{{ route('shop') }}" class="hover:text-brand">Shop</a>
            <span class="mx-1">/</span>
            <span class="text-ink">{{ $activeCategory->name }}</span>
        </nav>

        {{-- ===== Dynamic category banner(s) — managed from Admin → Category Banners ===== --}}
        @if($categoryBanners->isNotEmpty())
            <div class="mb-6"
                 x-data="{ i: 0, n: {{ $categoryBanners->count() }},
                           init() { if (this.n > 1) setInterval(() => { this.i = (this.i + 1) % this.n }, 5000) } }">
                <div class="relative rounded-2xl overflow-hidden shadow-card bg-brand-light" style="height: clamp(120px, 18vw, 260px);">
                    @foreach($categoryBanners as $idx => $banner)
                        <a href="{{ $banner->link ?: '#' }}" @if(empty($banner->link)) onclick="return false" @endif
                           class="absolute inset-0"
                           x-show="i === {{ $idx }}" x-transition.opacity.duration.600ms
                           @if($idx !== 0) style="display:none" @endif>
                            <img src="{{ image_url($banner->image, $activeCategory->name) }}" alt="{{ $banner->title ?? $activeCategory->name }}"
                                 class="w-full h-full object-cover">
                        </a>
                    @endforeach

                    @if($categoryBanners->count() > 1)
                        <div class="absolute bottom-3 inset-x-0 flex justify-center gap-1.5 z-10">
                            @foreach($categoryBanners as $idx => $b)
                                <button type="button" @click="i = {{ $idx }}" aria-label="Slide {{ $idx + 1 }}"
                                        class="w-2.5 h-2.5 rounded-full transition"
                                        :class="i === {{ $idx }} ? 'bg-accent' : 'bg-white/60 hover:bg-white'"></button>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif

        {{-- Result count + sort (the category name is already shown by the banner & breadcrumb) --}}
        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
            <p class="text-muted text-sm">
                Showing {{ $products->firstItem() ?? 0 }}–{{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
            </p>

            <form method="GET" class="flex items-center gap-2">
                {{-- Preserve the category (and any other params) when sorting. --}}
                @foreach(request()->except(['sort', 'page']) as $k => $v)
                    @if(is_array($v))
                        @foreach($v as $vv)<input type="hidden" name="{{ $k }}[]" value="{{ $vv }}">@endforeach
                    @else
                        <input type="hidden" name="{{ $k }}" value="{{ $v }}">
                    @endif
                @endforeach
                <label class="text-sm text-muted hidden sm:block">Sort:</label>
                <select name="sort" onchange="this.form.submit()" class="h-10 rounded-lg border border-line bg-white px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                    <option value="" @selected(request('sort')==='')>Latest</option>
                    <option value="price_low" @selected(request('sort')==='price_low')>Price: Low to High</option>
                    <option value="price_high" @selected(request('sort')==='price_high')>Price: High to Low</option>
                    <option value="popular" @selected(request('sort')==='popular')>Top Rated</option>
                </select>
            </form>
        </div>

        {{-- Products (full-width grid) --}}
        @if($products->isEmpty())
            <div class="bg-white rounded-xl border border-line p-12 text-center text-muted">
                <i class="fa-solid fa-box-open text-5xl mb-3 opacity-30"></i>
                <p>No products found in this category yet.</p>
            </div>
        @else
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3">
                @foreach($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-layout>
