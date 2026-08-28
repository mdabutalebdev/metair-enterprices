@php $editing = $banner->exists; @endphp

<form method="POST" action="{{ $editing ? route('admin.banners.update', $banner) : route('admin.banners.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border border-line p-5 max-w-xl space-y-4">
    @csrf
    @if($editing) @method('PUT') @endif

    @if($banner->image)
        <img src="{{ image_url($banner->image, 'Banner') }}" class="w-full h-40 object-cover rounded-lg border border-line bg-canvas">
    @endif

    <div>
        <label class="block text-sm font-medium mb-1">Title</label>
        <input type="text" name="title" value="{{ old('title', $banner->title) }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
    </div>
    <div class="grid sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Type <span class="text-sale">*</span></label>
            <select name="type" class="w-full h-11 rounded-lg border border-line px-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
                <option value="hero" @selected(old('type', $banner->type)==='hero')>Center Slider (Hero)</option>
                <option value="left" @selected(old('type', $banner->type)==='left')>Left Promo Banner</option>
                <option value="right" @selected(old('type', $banner->type)==='right')>Right Promo Banner</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Order (sort)</label>
            <input type="number" name="sort_order" value="{{ old('sort_order', $banner->sort_order ?? 0) }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        </div>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Link</label>
        <input type="text" name="link" value="{{ old('link', $banner->link) }}" placeholder="/shop?flash=1" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Upload Image</label>
        <input type="file" name="image" accept="image/*" class="w-full text-sm file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand-light file:text-brand file:font-semibold">
        <label class="block text-xs text-muted mb-1 mt-2">Or Image URL</label>
        <input type="text" name="image_url" placeholder="https://..." class="w-full h-10 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
    </div>
    <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $editing ? $banner->is_active : true)) class="accent-brand">Active</label>

    <div class="flex gap-2 pt-2">
        <button type="submit" class="btn-brand h-11 px-6">{{ $editing ? 'Update' : 'Save' }}</button>
        <a href="{{ route('admin.banners.index') }}" class="h-11 px-4 rounded-lg border border-line inline-flex items-center text-sm">Cancel</a>
    </div>
</form>
