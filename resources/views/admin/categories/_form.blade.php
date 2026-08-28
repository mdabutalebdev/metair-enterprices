@php $editing = $category->exists; @endphp

<form method="POST" action="{{ $editing ? route('admin.categories.update', $category) : route('admin.categories.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl border border-line p-5 max-w-lg space-y-4">
    @csrf
    @if($editing) @method('PUT') @endif

    <div>
        <label class="block text-sm font-medium mb-1">Name (English) <span class="text-sale">*</span></label>
        <input type="text" name="name_en" value="{{ old('name_en', $category->name_en) }}" required class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        @error('name_en')<span class="text-sale text-xs">{{ $message }}</span>@enderror
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Name (Bangla)</label>
        <input type="text" name="name_bn" value="{{ old('name_bn', $category->name_bn) }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        @error('name_bn')<span class="text-sale text-xs">{{ $message }}</span>@enderror
    </div>

    {{-- Category image (square thumbnail / fallback) --}}
    <div>
        <label class="block text-sm font-medium mb-1">Category Image (square)</label>
        @if($category->image)
            <img src="{{ image_url($category->image, $category->name_en) }}" class="w-20 h-20 rounded-lg object-cover border border-line mb-2">
        @endif
        <input type="file" name="image" accept="image/*" class="w-full text-sm file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand-light file:text-brand file:font-semibold">
        <p class="text-xs text-muted mt-1">Your own photo/icon from your PC. Shown on the home "Featured Categories" slider — takes priority over the picked icon below.</p>
        @error('image')<span class="text-sale text-xs">{{ $message }}</span>@enderror
    </div>

    {{-- Home promo image (wide banner-style card, image#4 look) --}}
    <div>
        <label class="block text-sm font-medium mb-1">Home Promo Image (wide)</label>
        @if($category->promo_image)
            <img src="{{ image_url($category->promo_image, $category->name_en) }}" class="w-full h-28 rounded-lg object-cover border border-line mb-2">
        @endif
        <input type="file" name="promo_image" accept="image/*" class="w-full text-sm file:mr-3 file:py-2 file:px-3 file:rounded-lg file:border-0 file:bg-brand-light file:text-brand file:font-semibold">
        <p class="text-xs text-muted mt-1">Wide promotional image for the home "Featured Categories" cards (landscape ≈16:10 looks best).</p>
        @error('promo_image')<span class="text-sale text-xs">{{ $message }}</span>@enderror
    </div>

    {{-- Icon picker — click a ready-made icon, or upload a Category Image above for
         a fully custom look. Shown directly so the admin never has to type a
         FontAwesome class name by hand. --}}
    @php
        $iconChoices = ['🔌','💡','🔋','⚡','🧯','🌞','🔧','⚙️','🖥️','📱','🎧','📷','🚗','🏠','🍳','🧴','👗','👟','⌚','⚽','📚','🛒','🧸','🐾','🌱','🎮','🖨️','🎁','❄️','📶','🔒','🧵'];
    @endphp
    <div x-data="{ icon: {{ \Illuminate\Support\Js::from(old('icon', $category->icon)) }} }">
        <label class="block text-sm font-medium mb-1">Icon</label>
        <div class="grid grid-cols-8 sm:grid-cols-11 gap-1.5 p-3 rounded-lg border border-line bg-canvas/50 mb-2">
            @foreach($iconChoices as $emoji)
                <button type="button" @click="icon = '{{ $emoji }}'"
                        class="w-9 h-9 rounded-lg grid place-items-center text-lg bg-white border transition"
                        :class="icon === '{{ $emoji }}' ? 'border-brand ring-2 ring-brand/30' : 'border-line hover:border-brand/40'">
                    {{ $emoji }}
                </button>
            @endforeach
        </div>
        <input type="text" name="icon" x-model="icon" placeholder="Pick an icon above, or type a FontAwesome class e.g. fa-solid fa-plug"
               class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
        <p class="text-xs text-muted mt-1">Used when no Category Image is uploaded above. Click an icon, or type any emoji / FontAwesome class here.</p>
    </div>
    <div>
        <label class="block text-sm font-medium mb-1">Sort Order</label>
        <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order ?? 0) }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
    </div>

    <div class="space-y-2 border-t border-line pt-3">
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="show_in_nav" value="1" @checked(old('show_in_nav', $editing ? $category->show_in_nav : true)) class="accent-brand">Show in top navigation menu</label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="show_on_home" value="1" @checked(old('show_on_home', $editing ? $category->show_on_home : false)) class="accent-brand">Show on home "Featured Categories" slider</label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $editing ? $category->is_active : true)) class="accent-brand">Active</label>
    </div>

    <div class="flex gap-2 pt-2">
        <button type="submit" class="btn-brand h-11 px-6">{{ $editing ? 'Update' : 'Save' }}</button>
        <a href="{{ route('admin.categories.index') }}" class="h-11 px-4 rounded-lg border border-line inline-flex items-center text-sm">Cancel</a>
    </div>
</form>
