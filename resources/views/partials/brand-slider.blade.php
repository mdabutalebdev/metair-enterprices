{{-- ===== Brands — auto-sliding logo strip (expects $brands) =====
     A continuous marquee of brand logos. The track is duplicated once so the
     loop is seamless; it pauses on hover. Managed in Admin → Brands (tick
     "Show in home Brands slider"). Plain CSS so it deploys with this file alone. --}}
@if($brands->isNotEmpty())
    <style>
        .brand-strip { overflow: hidden; position: relative; -webkit-mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent); mask-image: linear-gradient(90deg, transparent, #000 6%, #000 94%, transparent); }
        .brand-track { display: flex; width: max-content; gap: 1rem; animation: brand-scroll 40s linear infinite; }
        .brand-strip:hover .brand-track { animation-play-state: paused; }
        @keyframes brand-scroll { from { transform: translateX(0); } to { transform: translateX(-50%); } }

        .brand-chip {
            flex: 0 0 auto; width: 150px; height: 88px;
            display: grid; place-items: center; padding: .85rem 1rem;
            background: #fff; border: 1px solid var(--color-line); border-radius: 14px;
        }
        .brand-chip img { max-width: 100%; max-height: 100%; object-fit: contain; }
        .brand-chip span { font-weight: 700; font-size: .95rem; color: var(--color-brand); text-align: center; line-height: 1.2; }

        @media (min-width: 640px) { .brand-chip { width: 180px; height: 100px; } }
        @media (prefers-reduced-motion: reduce) { .brand-track { animation: none; } .brand-strip { overflow-x: auto; } }
    </style>

    <section class="bg-white mt-3">
        <div class="container-x py-5">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg sm:text-xl font-extrabold flex items-center gap-2">
                    <span class="w-1.5 h-6 rounded-full bg-accent inline-block"></span>Top Brands
                </h2>
                <a href="{{ route('shop') }}" class="text-brand text-sm font-semibold hover:underline">View All →</a>
            </div>

            <div class="brand-strip">
                <div class="brand-track">
                    {{-- Rendered twice for a seamless infinite loop. --}}
                    @foreach($brands->concat($brands) as $brand)
                        <a href="{{ route('shop', ['brand' => $brand->slug]) }}" class="brand-chip" aria-label="{{ $brand->name }}" title="{{ $brand->name }}">
                            @if($brand->logo)
                                <img src="{{ image_url($brand->logo, $brand->name) }}" alt="{{ $brand->name }}" loading="lazy">
                            @else
                                <span>{{ $brand->name }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif
