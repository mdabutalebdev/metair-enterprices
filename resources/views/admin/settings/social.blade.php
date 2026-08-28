<x-admin-layout title="Social Links">
    <div class="max-w-2xl">
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.social.update') }}" class="bg-white rounded-xl border border-line p-5">
            @csrf @method('PUT')

            <div class="mb-4">
                <h2 class="font-bold flex items-center gap-2"><i class="fa-solid fa-share-nodes text-brand"></i>Footer Social Links</h2>
                <p class="text-sm text-muted mt-1">Add each social media URL and tick <span class="font-semibold">Active</span> to show it in the footer. Unticked ones stay saved but are hidden.</p>
            </div>

            <div class="space-y-3">
                @foreach(\App\Http\Controllers\Admin\SiteSettingController::SOCIAL_PLATFORMS as $key => $meta)
                    @php $active = ($settings[$key.'_active'] ?? '1') !== '0'; @endphp
                    <div class="flex items-center gap-3 border border-line rounded-lg p-3">
                        <span class="w-10 h-10 rounded-full bg-accent text-white grid place-items-center text-lg shrink-0">
                            <i class="fa-brands {{ $meta['icon'] }}"></i>
                        </span>
                        <div class="flex-1 min-w-0">
                            <label class="block text-sm font-semibold mb-1">{{ $meta['label'] }}</label>
                            <input type="text" name="{{ $key }}" value="{{ $settings[$key] ?? '' }}" placeholder="{{ $meta['placeholder'] }}"
                                   class="w-full h-10 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                        </div>
                        <label class="flex flex-col items-center gap-1 shrink-0 cursor-pointer select-none">
                            <span class="text-[11px] font-semibold text-muted">Active</span>
                            <input type="checkbox" name="{{ $key }}_active" value="1" @checked($active) class="w-5 h-5 accent-brand">
                        </label>
                    </div>
                @endforeach
            </div>

            <div class="pt-5">
                <button type="submit" class="btn-brand h-11 px-6"><i class="fa-solid fa-floppy-disk"></i>Save Social Links</button>
            </div>
        </form>
    </div>
</x-admin-layout>
