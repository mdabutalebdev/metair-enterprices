@php $editing = $banner->exists; @endphp

<form method="POST" action="{{ $editing ? route('admin.category-banners.update', $banner) : route('admin.category-banners.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border border-line p-5 max-w-xl space-y-4">
    @csrf
    @if($editing) @method('PUT') @endif

    @if($banner->image)
        <img src="{{ image_url($banner->image, 'Banner') }}" class="w-full h-40 object-cover rounded-lg border border-line bg-canvas">
    @endif

    <div>
        <label class="block text-sm font-medium mb-1">Category <span class="text-sale">*</span></label>
        <select name="category_id" class="w-full h-11 rounded-lg border border-line px-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
            <option value="">Select a category</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(old('category_id', $banner->category_id) == $cat->id)>{{ $cat->name }}</option>
            @endforeach
        </select>
        <p class="text-xs text-muted mt-1">This banner appears at the top of the selected category's product page.</p>
        @error('category_id')<span class="text-sale text-xs">{{ $message }}</span>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
    </div>

    <div class="grid sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Link (optional)</label>
            <input type="text" name="link" value="{{ old('link', $banner->link) }}" placeholder="https://... or /shop?..." class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Sort Order</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order ?? 0) }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Banner Image</label>
        <input type="file" name="image" accept="image/*" class="w-full text-sm file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand-light file:text-brand file:font-semibold">
        <label class="block text-xs text-muted mb-1 mt-2">or Image URL</label>
        <input type="text" name="image_url" placeholder="https://..." class="w-full h-10 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        <p class="text-xs text-muted mt-1">Wide banner (≈16:5) shown across the top of the category page.</p>
        @error('image')<span class="text-sale text-xs">{{ $message }}</span>@enderror
    </div>

    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $editing ? $banner->is_active : true)) class="accent-brand">Active</label>

    <div class="flex gap-2 pt-2">
        <button type="submit" class="btn-brand h-11 px-6">{{ $editing ? 'Update' : 'Save' }}</button>
        <a href="{{ route('admin.category-banners.index') }}" class="h-11 px-4 rounded-lg border border-line inline-flex items-center text-sm">Cancel</a>
    </div>
</form>
