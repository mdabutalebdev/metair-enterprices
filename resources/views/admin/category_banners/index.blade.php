<x-admin-layout title="Category Banners">
    <div class="flex items-center justify-between mb-4">
        <p class="text-muted text-sm">{{ $banners->count() }} banner(s) — shown at the top of each category page</p>
        <a href="{{ route('admin.category-banners.create') }}" class="btn-brand h-10 px-4"><i class="fa-solid fa-plus"></i>New Banner</a>
    </div>

    <div class="grid sm:grid-cols-2 gap-4">
        @forelse($banners as $banner)
            <div class="bg-white rounded-xl border border-line overflow-hidden">
                <img src="{{ image_url($banner->image, 'Banner') }}" class="w-full h-40 object-cover bg-canvas">
                <div class="p-4">
                    <div class="flex items-center justify-between gap-2">
                        <span class="font-semibold truncate">{{ $banner->title ?? 'Untitled' }}</span>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-brand-light text-brand shrink-0">{{ $banner->category?->name ?? '— no category —' }}</span>
                    </div>
                    <div class="text-xs text-muted mt-1 truncate">{{ $banner->link ?? '—' }}</div>
                    <div class="flex items-center gap-2 mt-3">
                        <a href="{{ route('admin.category-banners.edit', $banner) }}" class="h-8 px-3 rounded-lg bg-brand-light text-brand text-sm font-semibold inline-flex items-center gap-1"><i class="fa-solid fa-pen"></i>Edit</a>
                        <form method="POST" action="{{ route('admin.category-banners.destroy', $banner) }}" onsubmit="return confirm('Delete this banner?')">
                            @csrf @method('DELETE')
                            <button class="h-8 px-3 rounded-lg bg-red-50 text-sale text-sm font-semibold inline-flex items-center gap-1"><i class="fa-solid fa-trash-can"></i>Delete</button>
                        </form>
                        @unless($banner->is_active)<span class="text-xs text-muted ml-auto">Inactive</span>@endunless
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-2 bg-white rounded-xl border border-line p-10 text-center text-muted">No category banners yet. Add one to show it at the top of a category page.</div>
        @endforelse
    </div>
</x-admin-layout>
