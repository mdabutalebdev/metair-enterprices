@props([
    'size' => 'md',            // sm | md | lg
    'primary' => 'text-brand', // colour of the first word
    'secondary' => 'text-accent', // colour of the remaining words
])

@php
    // Dynamic: the shop owner can rename the brand from Admin → Settings (site_name).
    $brandName = trim(\App\Models\SiteSetting::get('site_name') ?: 'METAIR ENTERPRISE');
    $parts = explode(' ', $brandName, 2);

    $top = [
        'sm' => 'text-base',
        'md' => 'text-lg sm:text-2xl',
        'lg' => 'text-2xl sm:text-3xl',
    ][$size] ?? 'text-lg sm:text-2xl';

    $bottom = [
        'sm' => 'text-[10px]',
        'md' => 'text-[10px] sm:text-[11px]',
        'lg' => 'text-[11px] sm:text-[13px]',
    ][$size] ?? 'text-[10px] sm:text-[11px]';
@endphp

<span {{ $attributes->merge(['class' => 'inline-block leading-none select-none']) }}>
    <span class="block font-extrabold uppercase {{ $primary }} {{ $top }}" style="letter-spacing:-.01em">{{ $parts[0] }}</span>
    @isset($parts[1])
        <span class="block font-semibold uppercase {{ $secondary }} {{ $bottom }}" style="letter-spacing:.32em">{{ $parts[1] }}</span>
    @endisset
</span>
