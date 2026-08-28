<x-layout>
    {{-- ===== Hero: admin-managed auto-sliding banner (multiple images) =====
         Fully dynamic — upload hero slides from Admin → Banners (type: hero).
         Whatever images are uploaded slide automatically here. --}}
    <style>
        [data-hero-dot] { background-color: rgba(244, 102, 26, 0.5) !important; }
        [data-hero-dot].bg-accent, [data-hero-dot].bg-white { background-color: rgba(244, 102, 26, 1) !important; opacity: 1 !important; }
    </style>
    <section class="container-x pt-3 sm:pt-4">
        {{-- Every slide shares one fixed aspect ratio + object-cover, so no matter what
             sizes are uploaded from Admin → Banners, all banners render at the exact
             same height. --}}
        <div data-hero class="relative rounded-2xl overflow-hidden shadow-card bg-brand-light">
            <div data-hero-track class="flex transition-transform duration-500 ease-out">
                @forelse($centerSlides as $slide)
                    <a href="{{ $slide->link ?? '#' }}" class="w-full shrink-0 block">
                        <img src="{{ image_url($slide->image, 'METAIR ENTERPRISE') }}" alt="{{ $slide->title }}"
                             class="w-full aspect-[16/7] sm:aspect-[1193/415] object-cover">
                    </a>
                @empty
                    <div class="w-full aspect-[16/7] sm:aspect-[1193/415] bg-accent grid place-items-center text-white text-2xl font-bold tracking-wide">METAIR ENTERPRISE</div>
                @endforelse
            </div>

            @if($centerSlides->count() > 1)
                <button type="button" data-hero-prev class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/85 hover:bg-white grid place-items-center shadow text-ink">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button type="button" data-hero-next class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 w-9 h-9 sm:w-11 sm:h-11 rounded-full bg-white/85 hover:bg-white grid place-items-center shadow text-ink">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
                <div class="absolute bottom-3 inset-x-0 flex justify-center gap-1.5">
                    @foreach($centerSlides as $i => $b)
                        <button type="button" data-hero-dot class="w-2.5 h-2.5 rounded-full bg-white/50 {{ $i === 0 ? 'bg-accent' : '' }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    {{-- ===== Trust bar (image#2 style) ===== --}}
    <section class="container-x mt-4">
        <div class="rounded-xl overflow-hidden grid grid-cols-1 sm:grid-cols-3 text-white" style="background: var(--color-brand-dark);">
            @foreach([
                ['fa-shield-halved', 'Safe Payment'],
                ['fa-truck-fast', 'Fast Delivery'],
                ['fa-rotate-left', 'Free Return'],
            ] as $i => $t)
                <div class="flex items-center justify-center gap-2.5 py-2.5 px-4 {{ $i > 0 ? 'sm:border-l border-white/10' : '' }}">
                    <i class="fa-solid {{ $t[0] }} text-accent text-base"></i>
                    <span class="font-bold text-sm">{{ $t[1] }}</span>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ===== Featured Categories — horizontal icon-card slider (KindiMart style) =====
         Each card shows whatever the admin picked in Admin → Categories: an uploaded
         image (their own photo/icon from their PC), a chosen emoji icon, or a
         FontAwesome icon as the last-resort fallback. Flat cards — no hover motion,
         per the reference design. Plain CSS so this deploys by editing this file alone. --}}
    @if($categories->isNotEmpty())
        <style>
            .fcat-scroll { display: flex; gap: .65rem; overflow-x: auto; scroll-snap-type: x mandatory; padding: .25rem .25rem 1rem; scrollbar-width: none; -ms-overflow-style: none; }
            .fcat-scroll::-webkit-scrollbar { display: none; }
            .fcat-card {
                scroll-snap-align: start; flex: 0 0 auto; width: 118px;
                display: flex; flex-direction: column; align-items: center; text-align: center;
                background: transparent; border: 1px solid var(--color-line); border-radius: 14px;
                padding: 1rem .5rem .85rem; text-decoration: none;
            }
            @media (min-width: 640px) { .fcat-card { width: 140px; padding: 1.25rem .6rem 1rem; } }
            .fcat-icon { width: 56px; height: 56px; display: grid; place-items: center; margin-bottom: .6rem; }
            .fcat-icon img { width: 100%; height: 100%; object-fit: contain; }
            .fcat-icon .fcat-emoji { font-size: 2.25rem; line-height: 1; }
            .fcat-icon i { font-size: 1.7rem; color: var(--color-accent); }
            .fcat-name { font-weight: 700; font-size: .8rem; color: var(--color-ink); line-height: 1.25; }

            .fcat-arrow {
                position: absolute; top: 50%; translate: 0 -50%; z-index: 10;
                width: 34px; height: 34px; border-radius: 999px; display: grid; place-items: center;
                background: #fff; border: 1px solid var(--color-line); box-shadow: 0 2px 8px rgba(16,24,40,.1);
                color: var(--color-ink); cursor: pointer;
            }
            .fcat-arrow:hover { background: var(--color-accent-light); }
        </style>

        <section class="bg-white mt-3">
            <div data-row class="container-x py-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg sm:text-xl font-extrabold flex items-center gap-2">
                    <span class="w-1.5 h-6 rounded-full bg-accent inline-block"></span>Featured Categories
                </h2>
                <a href="{{ route('shop') }}" class="text-brand text-sm font-semibold hover:underline">View All →</a>
            </div>

            <div class="relative">
                <button type="button" data-row-prev class="fcat-arrow hidden sm:grid -left-3"><i class="fa-solid fa-chevron-left text-xs"></i></button>

                <div data-row-scroll class="fcat-scroll">
                    @foreach($categories as $cat)
                        <a href="{{ route('shop', ['category' => $cat->slug]) }}" class="fcat-card" aria-label="{{ $cat->name }}">
                            <span class="fcat-icon">
                                @if($cat->image)
                                    <img src="{{ image_url($cat->image, $cat->name) }}" alt="{{ $cat->name }}" loading="lazy">
                                @elseif($cat->icon && !str_starts_with($cat->icon, 'fa-'))
                                    <span class="fcat-emoji">{{ $cat->icon }}</span>
                                @else
                                    <i class="{{ $cat->icon ?? 'fa-solid fa-tag' }}"></i>
                                @endif
                            </span>
                            <span class="fcat-name">{{ $cat->name }}</span>
                        </a>
                    @endforeach
                </div>

                <button type="button" data-row-next class="fcat-arrow hidden sm:grid -right-3"><i class="fa-solid fa-chevron-right text-xs"></i></button>
            </div>
            </div>
        </section>
    @endif

    {{-- ===== Flash Sale — countdown timer + horizontal cards (right after category) ===== --}}
    @include('partials.flash-sale', ['products' => $flashSale, 'viewAll' => route('shop', ['flash_sale' => 1])])

    {{-- ===== Best Sellers — product grid (right below Flash Sale) =====
         Wrapped in a white panel (like Flash Sale) so the cards sit on white,
         not the grey page background. --}}
    @if($bestSelling->isNotEmpty())
        <section class="container-x mt-4">
            <div class="bg-white rounded-2xl border border-line shadow-soft p-3 sm:p-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg sm:text-xl font-extrabold flex items-center gap-2">
                        <span class="w-1.5 h-6 rounded-full bg-accent inline-block"></span>Best Sellers
                    </h2>
                    <a href="{{ route('shop') }}" class="text-brand text-sm font-semibold hover:underline whitespace-nowrap">See More ›</a>
                </div>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2">
                    @foreach($bestSelling as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    {{-- ===== Popular Products — centered-header grid (replaces old Featured row) ===== --}}
    @include('partials.product-grid-section', [
        'eyebrow'  => "What's Hot Right Now",
        'title'    => 'Popular Products',
        'subtitle' => 'Trending items loved by our customers worldwide.',
        'products' => $featured,
        'viewAll'  => route('shop'),
    ])

    {{-- ===== Brands auto-slider (white band, before New Arrivals) ===== --}}
    @include('partials.brand-slider', ['brands' => $brands])

    {{-- ===== New Arrivals — centered-header grid ===== --}}
    @include('partials.product-grid-section', [
        'eyebrow'  => 'Just Landed',
        'title'    => 'New Arrivals',
        'subtitle' => "Freshly added products you don't want to miss.",
        'products' => $newArrival,
        'viewAll'  => route('shop'),
    ])

    {{-- ===== All Products grid with Load More ===== --}}
    @if($homeProducts->total() > 0)
        <section class="container-x mt-5"
                 x-data="{
                    page: 1,
                    loading: false,
                    hasMore: {{ $homeProducts->hasMorePages() ? 'true' : 'false' }},
                    async loadMore() {
                        if (this.loading || !this.hasMore) return;
                        this.loading = true;
                        const next = this.page + 1;
                        try {
                            const res = await fetch(`{{ route('home.load-more') }}?page=${next}`, { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
                            const data = await res.json();
                            this.$refs.grid.insertAdjacentHTML('beforeend', data.html);
                            this.page = next;
                            this.hasMore = data.hasMore;
                        } catch (e) {
                            console.error('Load more failed', e);
                        } finally {
                            this.loading = false;
                        }
                    }
                 }">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-extrabold flex items-center gap-2">
                    <span class="w-1.5 h-6 rounded-full bg-accent inline-block"></span>All Products
                </h2>
                <a href="{{ route('shop') }}" class="text-brand text-sm font-semibold hover:underline">View All →</a>
            </div>

            <div x-ref="grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3">
                @include('partials.home-products', ['products' => $homeProducts])
            </div>

            <div class="text-center mt-6" x-show="hasMore" x-cloak>
                <button type="button" @click="loadMore()" :disabled="loading"
                        class="btn-brand h-11 px-8 inline-flex items-center justify-center gap-2 disabled:opacity-60">
                    <span x-show="!loading">Load More</span>
                    <span x-show="loading" x-cloak class="inline-flex items-center gap-2"><i class="fa-solid fa-spinner fa-spin"></i> Loading...</span>
                </button>
            </div>
        </section>
    @endif

    {{-- ===== Customer reviews (sliding) ===== --}}
    @include('partials.reviews', ['testimonials' => $testimonials])
</x-layout>
