{{-- ===== Top bar (KindiMart style) ===== --}}
<div class="hidden lg:block bg-canvas text-[#6b7280] text-[11.5px] border-b border-line">
    <div class="container-x flex items-center justify-between h-9">
        <div class="flex items-center gap-4">
            <a href="tel:{{ $settings['phone'] ?? '' }}" class="flex items-center gap-1.5 hover:text-accent transition">
                <i class="fa-solid fa-phone text-[11px]"></i>{{ $settings['phone'] ?? '' }}
            </a>
            @if(!empty($settings['email']))
                <span class="w-px h-3.5 bg-line"></span>
                <a href="mailto:{{ $settings['email'] }}" class="flex items-center gap-1.5 hover:text-accent transition">
                    <i class="fa-solid fa-envelope text-[11px]"></i>{{ $settings['email'] }}
                </a>
            @endif
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('page', 'terms') }}" class="hover:text-accent transition">Terms &amp; Conditions</a>
            <span class="text-line">•</span>
            <a href="{{ route('page', 'privacy') }}" class="hover:text-accent transition">Privacy Policy</a>
            <span class="text-line">•</span>
            <a href="{{ route('page', 'refund-policy') }}" class="hover:text-accent transition">Refund Policy</a>
        </div>
    </div>
</div>

{{-- ===== Main header (white) ===== --}}
<header class="bg-white text-ink sticky top-0 z-40 border-b border-line">
    <div class="container-x">
        <div class="relative flex items-center justify-between gap-3 lg:gap-4 py-2 min-h-[76px]">
            {{-- Mobile hamburger --}}
            <button type="button" class="lg:hidden text-2xl -ml-1 text-ink relative z-10" @click="mobileMenu = true" aria-label="Menu">
                <i class="fa-solid fa-bars"></i>
            </button>

            {{-- Logo — centered on mobile, left-aligned on desktop --}}
            <a href="{{ route('home') }}" class="shrink-0 absolute left-1/2 -translate-x-1/2 lg:static lg:translate-x-0" aria-label="{{ $settings['site_name'] ?? 'METAIR ENTERPRISE' }}">
                <x-brand-wordmark size="md" />
            </a>

            {{-- Search (desktop) — pill with "All" scope + search icon + mic + Search button (KindiMart style) --}}
            <form action="{{ route('shop') }}" method="GET" class="hidden md:flex flex-1 max-w-4xl lg:max-w-5xl mx-auto" data-search>
                <div class="relative w-full">
                    <div class="flex items-center h-12 rounded-full border-2 border-accent bg-white pl-5">
                        <i class="fa-solid fa-magnifying-glass text-sm text-muted shrink-0"></i>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('messages.search_placeholder') }}" autocomplete="off" data-search-input
                               class="flex-1 min-w-0 pl-2 pr-1 text-ink text-sm bg-white placeholder:text-muted focus:outline-none">

                        <button type="submit" class="shrink-0 h-10 mr-1 px-5 rounded-full bg-accent text-white font-semibold hover:bg-accent-dark flex items-center gap-2 transition">
                            <i class="fa-solid fa-magnifying-glass"></i><span class="hidden sm:inline">Search</span>
                        </button>
                    </div>
                    <div data-search-results class="hidden absolute top-[calc(100%+6px)] left-0 right-0 bg-white rounded-xl border border-line shadow-2xl overflow-hidden z-50 max-h-[70vh] overflow-y-auto"></div>
                </div>
            </form>

            {{-- Icons (right) — All Products / Sign In / Wishlist / Cart (thin outline, KindiMart style) --}}
            <div class="flex items-center gap-3 sm:gap-4 lg:gap-5 ml-auto relative z-10">
                <button type="button" class="md:hidden w-9 grid place-items-center text-xl text-ink" @click="searchOpen = !searchOpen" aria-label="Search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>

                <a href="{{ route('shop') }}" class="hidden lg:flex flex-col items-center gap-0.5 text-[#334155] hover:text-accent transition" aria-label="All Products">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
                    <span class="text-[11px] font-normal">All Products</span>
                </a>

                <a href="{{ route('account') }}" class="hidden sm:flex flex-col items-center gap-0.5 text-[#334155] hover:text-accent transition" aria-label="{{ auth()->check() ? __('messages.account') : 'Sign In' }}">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <span class="text-[11px] font-normal">{{ auth()->check() ? __('messages.account') : 'Sign In' }}</span>
                </a>

                <a href="{{ route('wishlist.index') }}" class="hidden sm:flex flex-col items-center gap-0.5 text-[#334155] hover:text-accent transition" aria-label="{{ __('messages.wishlist') }}">
                    <span class="relative">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
                        <span data-wishlist-count class="absolute -top-1.5 -right-2 min-w-[16px] h-4 px-1 rounded-full bg-accent text-white text-[10px] font-bold grid place-items-center">{{ $wishlistCount ?? 0 }}</span>
                    </span>
                    <span class="text-[11px] font-normal">{{ __('messages.wishlist') }}</span>
                </a>

                <button type="button" class="flex flex-col items-center gap-0.5 text-[#334155] hover:text-accent transition" @click="cartOpen = true" aria-label="{{ __('messages.cart') }}">
                    <span class="relative text-accent">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
                        <span data-cart-count class="absolute -top-1.5 -right-2 min-w-[16px] h-4 px-1 rounded-full bg-accent text-white text-[10px] font-bold grid place-items-center">{{ $cartCount ?? 0 }}</span>
                    </span>
                    <span class="text-[11px] font-normal hidden sm:block">{{ __('messages.cart') }}</span>
                </button>
            </div>
        </div>

        {{-- Search (mobile, expandable) --}}
        <div x-show="searchOpen" x-cloak x-transition class="md:hidden pb-3">
            <form action="{{ route('shop') }}" method="GET" class="relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('messages.search_placeholder') }}"
                       class="w-full h-11 rounded-lg pl-4 pr-12 text-ink text-sm bg-canvas border border-line placeholder:text-muted focus:outline-none focus:border-brand">
                <button type="submit" class="absolute right-1 top-1 bottom-1 px-4 rounded-md bg-accent text-white">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </div>

    {{-- ===== Category nav (orange, desktop) — auto-sliding marquee (KindiMart style) ===== --}}
    <style>
        .mcat-marq-wrap { display: flex; align-items: center; flex: 1 1 0%; overflow: hidden; position: relative; height: 100%; }
        .mcat-marq { display: flex; align-items: center; width: max-content; gap: .25rem; animation: mcatScroll 45s linear infinite; }
        .mcat-marq-wrap:hover .mcat-marq { animation-play-state: paused; }
        @keyframes mcatScroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }
        @media (prefers-reduced-motion: reduce) { .mcat-marq { animation: none; } .mcat-marq-wrap { overflow-x: auto; } }
    </style>
    <nav class="hidden lg:block bg-accent text-white">
        <div class="container-x">
            <div class="flex items-stretch gap-1 h-11">
                {{-- "All" (left, fixed) --}}
                <a href="{{ route('shop') }}"
                   class="shrink-0 flex items-center gap-2 h-11 px-4 font-normal text-[13px] text-white/90 hover:text-white hover:bg-black/10 transition whitespace-nowrap">
                    <i class="fa-solid fa-cart-shopping"></i> All
                </a>

                {{-- Category links — auto-sliding marquee (rendered ×2 for a seamless loop) --}}
                <div class="mcat-marq-wrap">
                    <div class="mcat-marq">
                        @foreach($navCategories->concat($navCategories) as $cat)
                            <a href="{{ route('shop', ['category' => $cat->slug]) }}"
                               class="shrink-0 flex items-center gap-1.5 px-3 py-2 text-[13px] text-white/90 hover:text-white rounded-md hover:bg-black/10 transition whitespace-nowrap {{ request('category') === $cat->slug ? 'bg-black/10 text-white' : '' }}">
                                <i class="{{ $cat->icon ?? 'fa-solid fa-tag' }} text-[13px]"></i>{{ $cat->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>

{{-- ===== Mobile menu drawer ===== --}}
<div x-show="mobileMenu" x-cloak class="fixed inset-0 z-50 lg:hidden" @keydown.escape.window="mobileMenu = false">
    <div x-show="mobileMenu" x-transition.opacity class="absolute inset-0 bg-black/50" @click="mobileMenu = false"></div>
    <div x-show="mobileMenu"
         x-transition:enter="transition ease-out duration-200" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-150" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full"
         class="absolute inset-y-0 left-0 w-80 max-w-[85%] bg-white flex flex-col">
        <div class="bg-white border-b border-line p-4 flex items-center justify-between">
            <a href="{{ route('home') }}" aria-label="{{ $settings['site_name'] ?? 'METAIR ENTERPRISE' }}"><x-brand-wordmark size="sm" /></a>
            <button @click="mobileMenu = false" class="text-2xl text-ink"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <nav class="flex-1 overflow-y-auto p-2">
            <a href="{{ route('home') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-canvas"><i class="fa-solid fa-house w-5 text-brand"></i>{{ __('messages.home') }}</a>
            <a href="{{ route('shop') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-canvas"><i class="fa-solid fa-bag-shopping w-5 text-brand"></i>{{ __('messages.shop') }}</a>
            @foreach($navCategories as $cat)
                <a href="{{ route('shop', ['category' => $cat->slug]) }}" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-canvas"><i class="{{ $cat->icon ?? 'fa-solid fa-tag' }} w-5 text-brand"></i>{{ $cat->name }}</a>
            @endforeach
            <a href="{{ route('wishlist.index') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-canvas"><i class="fa-regular fa-heart w-5 text-brand"></i>{{ __('messages.wishlist') }}</a>
            <a href="{{ route('contact') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-canvas"><i class="fa-solid fa-headset w-5 text-brand"></i>{{ __('messages.contact') }}</a>
            <a href="{{ route('account') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-canvas"><i class="fa-regular fa-user w-5 text-brand"></i>{{ auth()->check() ? __('messages.account') : 'Sign In' }}</a>
            <a href="{{ route('track') }}" class="flex items-center gap-3 px-3 py-3 rounded-lg hover:bg-canvas"><i class="fa-solid fa-truck-fast w-5 text-brand"></i>Track Order</a>
        </nav>
    </div>
</div>
