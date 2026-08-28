@props(['product'])

@php $inWishlist = in_array($product->id, $wishlistIds ?? []); @endphp

{{-- Flat product card — thin gray border, sharp corners (no rounding), square
     image, red discount badge, orange price, rating + "X sold". On hover the
     Add-to-Cart and Wishlist icons slide in (top-right). --}}
<div class="group relative bg-white border border-[#e5e7eb] hover:border-accent/50 transition overflow-hidden flex flex-col h-full">
    <div class="relative">
        @if($product->discount_percent > 0)
            <span class="absolute top-2 left-2 z-10 bg-rose-600 text-white text-[11px] font-bold px-2 py-1 rounded-md">-{{ $product->discount_percent }}%</span>
        @endif

        {{-- Hover action icons — cart + wishlist (wishlist stays visible when saved) --}}
        <div class="absolute top-2 right-2 z-10 flex flex-col gap-2">
            <button type="button" data-add-cart="{{ $product->id }}" aria-label="Add to cart"
                    class="w-8 h-8 rounded-full bg-white shadow-md grid place-items-center text-ink hover:bg-accent hover:text-white transition-all opacity-0 translate-x-1 group-hover:opacity-100 group-hover:translate-x-0">
                <i class="fa-solid fa-cart-shopping text-xs"></i>
            </button>
            <button type="button" data-wishlist="{{ $product->id }}" aria-label="Add to wishlist"
                    class="w-8 h-8 rounded-full bg-white shadow-md grid place-items-center hover:bg-accent hover:text-white transition-all translate-x-0 {{ $inWishlist ? 'opacity-100 is-active' : 'opacity-0 translate-x-1 group-hover:opacity-100 group-hover:translate-x-0' }}">
                <i class="fa-{{ $inWishlist ? 'solid' : 'regular' }} fa-heart text-xs" @if($inWishlist) style="color:#ef4444" @endif></i>
            </button>
        </div>

        <a href="{{ route('product.show', $product) }}" class="block aspect-square bg-canvas overflow-hidden">
            <img src="{{ image_url($product->main_image, $product->name) }}" alt="{{ $product->name }}" loading="lazy"
                 class="w-full h-full object-cover">
        </a>
    </div>

    <div class="p-2.5 flex flex-col flex-1">
        <h3 class="text-sm font-bold leading-snug clamp-2 min-h-[2.5em] text-ink">
            <a href="{{ route('product.show', $product) }}" class="hover:text-brand transition">{{ $product->name }}</a>
        </h3>

        <div class="flex items-center flex-wrap gap-x-1.5 mt-1.5">
            <span class="text-accent font-extrabold text-[15px]">{{ bdt($product->price) }}</span>
            @if($product->old_price && $product->old_price > $product->price)
                <span class="text-muted text-[12px] line-through">{{ bdt($product->old_price) }}</span>
                <span class="text-accent text-[12px] font-bold">-{{ $product->discount_percent }}%</span>
            @endif
        </div>

        <div class="flex items-center gap-1.5 mt-1 text-[12px] text-muted">
            <i class="fa-solid fa-star text-amber-400"></i>
            <span class="font-semibold text-ink">{{ number_format((float) $product->rating, 1) }}</span>
            <span class="text-line">|</span>
            <span>{{ $product->sold_count }} sold</span>
        </div>
    </div>
</div>
