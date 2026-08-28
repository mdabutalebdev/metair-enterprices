<footer class="text-white mt-10" style="background-color: #0f2249;">
    <div class="container-x py-10 grid grid-cols-2 md:grid-cols-4 gap-8 text-sm">
        <div class="col-span-2 md:col-span-1">
            <div class="bg-white rounded-lg px-3 py-2.5 inline-block mb-3">
                <x-brand-wordmark size="md" />
            </div>
            <p class="leading-relaxed">{{ $settings['footer_text'] ?? 'METAIR ENTERPRISE - Your trusted online shopping platform.' }}</p>
            {{-- Social icons — fully managed in Admin → Social Links. Each shows only
                 when it has a URL AND its "Active" box is ticked. --}}
            @php
                $socials = [
                    ['key' => 'facebook',  'icon' => 'fa-facebook-f',  'href' => $settings['facebook']  ?? ''],
                    ['key' => 'instagram', 'icon' => 'fa-instagram',   'href' => $settings['instagram'] ?? ''],
                    ['key' => 'tiktok',    'icon' => 'fa-tiktok',      'href' => $settings['tiktok']    ?? ''],
                    ['key' => 'linkedin',  'icon' => 'fa-linkedin-in', 'href' => $settings['linkedin']  ?? ''],
                    ['key' => 'whatsapp',  'icon' => 'fa-whatsapp',    'href' => !empty($settings['whatsapp']) ? 'https://wa.me/'.$settings['whatsapp'] : ''],
                    ['key' => 'youtube',   'icon' => 'fa-youtube',     'href' => $settings['youtube']   ?? ''],
                ];
            @endphp
            <div class="flex items-center gap-2.5 mt-4 text-base">
                @foreach($socials as $s)
                    @php $flag = $settings[$s['key'].'_active'] ?? null; @endphp
                    {{-- Visibility depends on the Active checkbox alone. If never configured
                         (flag unset), fall back to "show when a URL exists". --}}
                    @php $show = $flag === null ? !empty($s['href']) : ($flag === '1'); @endphp
                    @if($show)
                        <a href="{{ $s['href'] ?: '#' }}" target="_blank" rel="noopener" aria-label="{{ ucfirst($s['key']) }}" class="w-9 h-9 grid place-items-center rounded-full bg-accent text-white hover:opacity-80 transition"><i class="fa-brands {{ $s['icon'] }}"></i></a>
                    @endif
                @endforeach
            </div>
        </div>

        <div>
            <h4 class="text-white font-bold mb-3">Information</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('page', 'about') }}" class="hover:text-white transition">About Us</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-white transition">Contact Us</a></li>
                <li><a href="{{ route('page', 'terms') }}" class="hover:text-white transition">Terms &amp; Conditions</a></li>
                <li><a href="{{ route('page', 'privacy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                <li><a href="{{ route('page', 'refund-policy') }}" class="hover:text-white transition">Return &amp; Refund</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-bold mb-3">Support</h4>
            <ul class="space-y-2">
                <li><a href="{{ route('page', 'how-to-order') }}" class="hover:text-white transition">How to Order</a></li>
                <li><a href="{{ route('track') }}" class="hover:text-white transition">Order Tracking</a></li>
                <li><a href="{{ route('page', 'shipping') }}" class="hover:text-white transition">Shipping &amp; Delivery</a></li>
                <li><a href="{{ route('page', 'faq') }}" class="hover:text-white transition">FAQ</a></li>
                <li><a href="{{ route('wishlist.index') }}" class="hover:text-white transition">Wishlist</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text-white font-bold mb-3">Contact Us</h4>
            <ul class="space-y-2">
                <li class="flex items-start gap-2"><i class="fa-solid fa-location-dot mt-1 text-white"></i><span>{{ $settings['address'] ?? 'Dhaka, Bangladesh' }}</span></li>
                <li><a href="tel:{{ $settings['phone'] ?? '' }}" class="flex items-center gap-2 hover:text-white"><i class="fa-solid fa-phone text-white"></i>{{ $settings['phone'] ?? '' }}</a></li>
                @if(!empty($settings['whatsapp']))<li><a href="https://wa.me/{{ $settings['whatsapp'] }}" target="_blank" class="flex items-center gap-2 hover:text-white"><i class="fa-brands fa-whatsapp text-white"></i>WhatsApp</a></li>@endif
                <li><a href="mailto:{{ $settings['email'] ?? '' }}" class="flex items-center gap-2 hover:text-white"><i class="fa-solid fa-envelope text-white"></i>{{ $settings['email'] ?? '' }}</a></li>
            </ul>
            <div class="flex items-center gap-2 mt-4 text-white text-xs">
                <i class="fa-solid fa-truck-fast"></i> Cash on Delivery available
            </div>
        </div>
    </div>

    <div class="border-t border-white/10">
        <div class="container-x py-4 text-xs text-white flex flex-col sm:flex-row items-center sm:justify-between gap-1.5">
            <div>Copyright © {{ max((int) date('Y'), 2026) }} <span class="font-semibold text-white">{{ $settings['site_name'] ?? 'METAIR ENTERPRISE' }}</span></div>
            <div class="flex items-center gap-1 text-white/80">
                Created by:
                <a href="https://www.extrainweb.com/" target="_blank" rel="noopener" class="font-semibold text-white hover:text-accent transition">Extrain Web</a>
            </div>
        </div>
    </div>
</footer>

