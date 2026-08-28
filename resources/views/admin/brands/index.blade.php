<x-admin-layout title="Brands">
    <div class="flex items-center justify-between mb-4">
        <p class="text-muted text-sm">{{ $brands->count() }} brands</p>
        <a href="{{ route('admin.brands.create') }}" class="btn-brand h-10 px-4"><i class="fa-solid fa-plus"></i>New Brand</a>
    </div>

    <div class="bg-white rounded-xl border border-line overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-canvas text-muted text-left">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Logo</th>
                        <th class="px-4 py-3 font-semibold">Name</th>
                        <th class="px-4 py-3 font-semibold">Products</th>
                        <th class="px-4 py-3 font-semibold">On Home</th>
                        <th class="px-4 py-3 font-semibold">Active</th>
                        <th class="px-4 py-3 font-semibold text-right">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse($brands as $brand)
                        <tr class="hover:bg-canvas">
                            <td class="px-4 py-3">
                                <div class="w-14 h-14 rounded-lg border border-line bg-white grid place-items-center overflow-hidden">
                                    @if($brand->logo)
                                        <img src="{{ image_url($brand->logo, $brand->name) }}" alt="{{ $brand->name }}" class="max-w-full max-h-full object-contain">
                                    @else
                                        <i class="fa-solid fa-image text-muted/40 text-xl"></i>
                                    @endif
                                </div>
                            </td>
                            <td class="px-4 py-3">
                                <span class="font-semibold">{{ $brand->name }}</span>
                                <div class="text-xs text-muted">{{ $brand->slug }}</div>
                            </td>
                            <td class="px-4 py-3">{{ $brand->products_count }}</td>
                            <td class="px-4 py-3">
                                @if($brand->show_on_home)<span class="text-brand"><i class="fa-solid fa-check"></i></span>@else<span class="text-muted">—</span>@endif
                            </td>
                            <td class="px-4 py-3">
                                @if($brand->is_active)<span class="text-xs font-bold text-brand bg-brand-light px-2 py-0.5 rounded-full">Active</span>@else<span class="text-xs text-muted">Inactive</span>@endif
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.brands.edit', $brand) }}" class="w-8 h-8 grid place-items-center rounded-lg hover:bg-brand-light text-brand"><i class="fa-solid fa-pen"></i></a>
                                    <form method="POST" action="{{ route('admin.brands.destroy', $brand) }}" onsubmit="return confirm('Delete this brand?')">
                                        @csrf @method('DELETE')
                                        <button class="w-8 h-8 grid place-items-center rounded-lg hover:bg-red-50 text-sale"><i class="fa-solid fa-trash-can"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="px-4 py-10 text-center text-muted">No brands yet. Click "New Brand" to add one.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
