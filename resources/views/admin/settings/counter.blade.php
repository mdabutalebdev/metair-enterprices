<x-admin-layout title="Flash Counter">
    <div class="max-w-xl">
        @if(session('success'))
            <div class="mb-4 rounded-lg bg-green-50 border border-green-200 text-green-700 px-4 py-3 text-sm">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('admin.counter.update') }}" class="bg-white rounded-xl border border-line p-5 space-y-4">
            @csrf @method('PUT')

            <div>
                <h2 class="font-bold flex items-center gap-2"><i class="fa-solid fa-stopwatch text-brand"></i>Flash Sale Counter</h2>
                <p class="text-sm text-muted mt-1">Set the date &amp; time the home page "Flash" countdown ticks down to. Leave empty to hide the countdown.</p>
            </div>

            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="flash_enabled" value="1" @checked(($settings['flash_enabled'] ?? '1') !== '0') class="w-5 h-5 accent-brand">
                Show the countdown timer on the home Flash section
            </label>

            <div>
                <label class="block text-sm font-medium mb-1">Countdown ends at</label>
                @php
                    $current = $settings['flash_end_at'] ?? null;
                    $val = $current ? \Illuminate\Support\Carbon::parse($current)->format('Y-m-d\TH:i') : '';
                @endphp
                <input type="datetime-local" name="flash_end_at" value="{{ $val }}"
                       class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                <p class="text-xs text-muted mt-1">The timer shows the remaining Hours : Minutes : Seconds until this moment.</p>
            </div>

            <div class="pt-2">
                <button type="submit" class="btn-brand h-11 px-6"><i class="fa-solid fa-floppy-disk"></i>Save Counter</button>
            </div>
        </form>
    </div>
</x-admin-layout>
