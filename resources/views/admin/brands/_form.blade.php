@php $editing = $brand->exists; @endphp

<form method="POST" action="{{ $editing ? route('admin.brands.update', $brand) : route('admin.brands.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border border-line p-5 max-w-lg space-y-4">
    @csrf
    @if($editing) @method('PUT') @endif

    <div>
        <label class="block text-sm font-medium mb-1">Brand Name <span class="text-sale">*</span></label>
        <input type="text" name="name" value="{{ old('name', $brand->name) }}" required class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        @error('name')<span class="text-sale text-xs">{{ $message }}</span>@enderror
    </div>

    {{-- Brand logo / image --}}
    <div>
        <label class="block text-sm font-medium mb-1">Brand Image (logo)</label>
        @if($brand->logo)
            <div class="w-28 h-28 rounded-lg border border-line bg-white grid place-items-center overflow-hidden mb-2 p-2">
                <img src="{{ image_url($brand->logo, $brand->name) }}" class="max-w-full max-h-full object-contain">
            </div>
        @endif
        <input type="file" name="logo" accept="image/*" class="w-full text-sm file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand-light file:text-brand file:font-semibold">
        <p class="text-xs text-muted mt-1">Shown in the home "Brands" slider and on the product detail page. A transparent PNG on a light background looks best.</p>
        @error('logo')<span class="text-sale text-xs">{{ $message }}</span>@enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $brand->sort_order ?? 0) }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        <p class="text-xs text-muted mt-1">Lower numbers appear first.</p>
    </div>

    <div class="space-y-2 border-t border-line pt-3">
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="show_on_home" value="1" @checked(old('show_on_home', $editing ? $brand->show_on_home : true)) class="accent-brand">Show in home "Brands" slider</label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $editing ? $brand->is_active : true)) class="accent-brand">Active</label>
    </div>

    <div class="flex gap-2 pt-2">
        <button type="submit" class="btn-brand h-11 px-6">{{ $editing ? 'Update' : 'Save' }}</button>
        <a href="{{ route('admin.brands.index') }}" class="h-11 px-4 rounded-lg border border-line inline-flex items-center text-sm">Cancel</a>
    </div>
</form>
