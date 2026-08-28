{{-- Flash Sale — live countdown timer + horizontal compact product cards.
     Matches the KindiMart reference: a white rounded card holding the "Flash ⚡"
     title, an orange HH:MM:SS countdown, a "Shop More" link, then a scrollable
     row of compact cards (image + discount badge + price). Expects $products,
     $viewAll. --}}
@if($products->isNotEmpty())
    @php
        // Countdown target + on/off are managed in Admin → Counter.
        $flashEndRaw = \App\Models\SiteSetting::get('flash_end_at');
        $flashEnabled = (\App\Models\SiteSetting::get('flash_enabled') ?? '1') !== '0';
        $flashEndMs = $flashEndRaw ? \Illuminate\Support\Carbon::parse($flashEndRaw)->timestamp * 1000 : null;
        $showTimer = $flashEnabled && $flashEndMs;
    @endphp
    <section data-row class="container-x mt-4">
        <div class="bg-white rounded-2xl border border-line shadow-soft p-3 sm:p-4">
            <div class="flex items-center justify-between gap-3 mb-3">
                <div class="flex items-center gap-3 min-w-0">
                    <h2 class="text-lg sm:text-xl font-extrabold shrink-0">Flash</h2>
                    @if($showTimer)
                        <div x-data="{ end: {{ $flashEndMs }}, hh:'00', mm:'00', ss:'00',
                                tick(){ let s = Math.max(0, Math.floor((this.end - Date.now())/1000));
                                        this.hh = String(Math.floor(s/3600)).padStart(2,'0');
                                        this.mm = String(Math.floor((s%3600)/60)).padStart(2,'0');
                                        this.ss = String(s%60).padStart(2,'0'); } }"
                             x-init="tick(); setInterval(() => tick(), 1000)"
                             class="flex items-center gap-1 shrink-0">
                            <span class="min-w-[30px] text-center bg-accent text-white font-bold text-sm px-1.5 py-1 rounded-md tabular-nums" x-text="hh"></span>
                            <span class="text-accent font-bold">:</span>
                            <span class="min-w-[30px] text-center bg-accent text-white font-bold text-sm px-1.5 py-1 rounded-md tabular-nums" x-text="mm"></span>
                            <span class="text-accent font-bold">:</span>
                            <span class="min-w-[30px] text-center bg-accent text-white font-bold text-sm px-1.5 py-1 rounded-md tabular-nums" x-text="ss"></span>
                        </div>
                    @endif
                </div>
                <a href="{{ $viewAll }}" class="text-brand text-sm font-semibold hover:underline whitespace-nowrap shrink-0">Shop More ›</a>
            </div>

            <div data-row-scroll class="flex gap-3 overflow-x-auto no-scrollbar snap-x pb-1">
                @foreach($products as $product)
                    <a href="{{ route('product.show', $product) }}"
                       class="w-32 sm:w-36 shrink-0 snap-start bg-white rounded-lg border border-line hover:border-accent/50 overflow-hidden transition">
                        <div class="relative aspect-square bg-canvas overflow-hidden">
                            @if($product->discount_percent > 0)
                                <span class="absolute top-2 left-2 z-10 bg-rose-600 text-white text-[11px] font-bold px-2 py-1 rounded-md">-{{ $product->discount_percent }}%</span>
                            @endif
                            <img src="{{ image_url($product->main_image, $product->name) }}" alt="{{ $product->name }}" loading="lazy" class="w-full h-full object-cover">
                        </div>
                        <div class="p-2 flex items-center flex-wrap gap-x-1.5">
                            <span class="text-accent font-extrabold text-sm">{{ bdt($product->price) }}</span>
                            @if($product->old_price && $product->old_price > $product->price)
                                <span class="text-muted text-[11px] line-through">{{ bdt($product->old_price) }}</span>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
@endif
