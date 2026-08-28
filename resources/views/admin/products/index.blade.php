<x-admin-layout title="Product Management">
    <form method="GET" class="flex items-end justify-between mb-4 gap-3 flex-wrap">
        <div class="flex items-end gap-2 flex-wrap">
            <div class="relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search products..." class="w-56 h-10 rounded-lg border border-line pl-9 pr-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
                <i class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-muted text-sm"></i>
            </div>

            {{-- Stock filter: quick presets --}}
            <div>
                <label class="block text-[11px] font-semibold text-muted mb-0.5">Stock</label>
                <select name="stock_below" class="h-10 rounded-lg border border-line px-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
                    <option value="">All stock</option>
                    <option value="1" @selected(request('stock_below')==='1')>Out of stock (0)</option>
                    <option value="10" @selected(request('stock_below')==='10')>Below 10</option>
                    <option value="15" @selected(request('stock_below')==='15')>Below 15</option>
                    <option value="20" @selected(request('stock_below')==='20')>Below 20</option>
                    <option value="50" @selected(request('stock_below')==='50')>Below 50</option>
                </select>
            </div>

            {{-- Stock filter: custom min / max range --}}
            <div>
                <label class="block text-[11px] font-semibold text-muted mb-0.5">Custom range</label>
                <div class="flex items-center gap-1">
                    <input type="number" name="stock_min" value="{{ request('stock_min') }}" placeholder="Min" min="0" class="w-20 h-10 rounded-lg border border-line px-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
                    <span class="text-muted">–</span>
                    <input type="number" name="stock_max" value="{{ request('stock_max') }}" placeholder="Max" min="0" class="w-20 h-10 rounded-lg border border-line px-2 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
                </div>
            </div>

            <button type="submit" class="btn-brand h-10 px-4"><i class="fa-solid fa-filter"></i>Filter</button>
            @if(request()->hasAny(['q','stock_below','stock_min','stock_max']))
                <a href="{{ route('admin.products.index') }}" class="h-10 px-3 inline-flex items-center rounded-lg border border-line text-sm text-muted hover:bg-canvas">Clear</a>
            @endif
        </div>
        <a href="{{ route('admin.products.create') }}" class="btn-brand h-10 px-4"><i class="fa-solid fa-plus"></i>New Product</a>
    </form>

    <div class="mb-3 text-sm text-muted">{{ $products->total() }} product(s) found</div>

    <div class="bg-white rounded-xl border border-line overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-canvas text-muted text-left">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Product</th>
                        <th class="px-4 py-3 font-semibold">Category</th>
                        <th class="px-4 py-3 font-semibold">Price</th>
                        <th class="px-4 py-3 font-semibold">Stock</th>
                        <th class="px-4 py-3 font-semibold">Tags</th>
                        <th class="px-4 py-3 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse($products as $product)
                        <tr class="hover:bg-canvas">
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <img src="{{ image_url($product->main_image, $product->name) }}" class="w-10 h-10 rounded-lg object-cover bg-canvas shrink-0">
                                    <span class="font-semibold clamp-2 max-w-[200px]">{{ $product->name }}</span>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-muted">{{ $product->category?->name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <span class="font-bold text-brand">{{ bdt($product->price) }}</span>
                                @if($product->old_price)<span class="text-xs text-muted line-through ml-1">{{ bdt($product->old_price) }}</span>@endif
                            </td>
                            <td class="px-4 py-3">{{ $product->stock }}</td>
                            <td class="px-4 py-3">
                                <div class="flex flex-wrap gap-1">
                                    @if($product->is_flash_sale)<span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-sale/10 text-sale">Flash</span>@endif
                                    @if($product->is_featured)<span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-amber-100 text-amber-700">Featured</span>@endif
                                    @if($product->is_best_seller)<span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-accent/10 text-accent">Best</span>@endif
                                    @if($product->is_new_arrival)<span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-brand-light text-brand">New</span>@endif
                                    @if(!$product->is_active)<span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-gray-200 text-gray-600">Inactive</span>@endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="w-8 h-8 grid place-items-center rounded-lg hover:bg-brand-light text-brand"><i class="fa-solid fa-pen"></i></a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Delete this product?')">
                                        @csrf @method('DELETE')
                                        <button class="w-8 h-8 grid place-items-center rounded-lg hover:bg-red-50 text-sale"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-10 text-center text-muted">No products yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">{{ $products->links() }}</div>
</x-admin-layout>
