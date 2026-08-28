<x-layout :title="'Request Options - '.$product->name">
    @php
        $countries = ['Bangladesh', 'India', 'Pakistan', 'Nepal', 'Bhutan', 'Sri Lanka', 'Maldives', 'Myanmar',
            'Saudi Arabia', 'United Arab Emirates', 'Qatar', 'Kuwait', 'Oman', 'Bahrain',
            'Malaysia', 'Singapore', 'United States', 'United Kingdom', 'Canada', 'Australia', 'Other'];
        $divisions = ['Dhaka', 'Chattogram', 'Khulna', 'Rajshahi', 'Barishal', 'Sylhet', 'Rangpur', 'Mymensingh', 'Other'];
    @endphp

    <div class="container-x py-6">
        {{-- Breadcrumb --}}
        <nav class="flex flex-wrap items-center gap-y-1 text-xs text-muted mb-3">
            <a href="{{ route('home') }}" class="hover:text-brand">Home</a>
            <span class="mx-1">/</span>
            <a href="{{ route('shop') }}" class="hover:text-brand">Shop</a>
            <span class="mx-1">/</span>
            <a href="{{ route('product.show', $product) }}" class="hover:text-brand break-words">{{ $product->name }}</a>
            <span class="mx-1">/</span>
            <span class="text-ink">Request Options</span>
        </nav>

        <div class="bg-white rounded-xl border border-line p-5 sm:p-7">
            <h1 class="text-lg sm:text-xl font-extrabold text-brand mb-5 break-words">{{ $product->name }}</h1>

            @if(session('success'))
                <div class="bg-brand-light border border-brand/20 text-brand rounded-lg p-3 mb-4 text-sm flex items-center gap-2"><i class="fa-solid fa-circle-check"></i>{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-sale rounded-lg p-3 mb-4 text-sm">
                    @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
                </div>
            @endif

            <div class="grid md:grid-cols-2 gap-6 lg:gap-10">
                {{-- ===== Left: request form ===== --}}
                <form method="POST" action="{{ route('product.request.store', $product) }}" class="space-y-4 order-2 md:order-1">
                    @csrf

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">First name <span class="text-sale">*</span></label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" required class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Last name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Company</label>
                        <input type="text" name="company" value="{{ old('company') }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Contact email <span class="text-sale">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="example@domain.com" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Phone</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Country</label>
                            <select name="country" class="w-full h-11 rounded-lg border border-line px-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
                                <option value="">Choose a country</option>
                                @foreach($countries as $c)
                                    <option value="{{ $c }}" @selected(old('country', 'Bangladesh') === $c)>{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">State / Division</label>
                            <select name="state" class="w-full h-11 rounded-lg border border-line px-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
                                <option value="">Choose a state</option>
                                @foreach($divisions as $d)
                                    <option value="{{ $d }}" @selected(old('state') === $d)>{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">City</label>
                            <input type="text" name="city" value="{{ old('city') }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Postal code</label>
                            <input type="text" name="postal_code" value="{{ old('postal_code') }}" class="w-full h-11 rounded-lg border border-line px-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Message</label>
                        <textarea name="message" rows="4" placeholder="Tell us what options or quantity you need..." class="w-full rounded-lg border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand/30">{{ old('message') }}</textarea>
                    </div>

                    <label class="flex items-start gap-2 text-sm">
                        <input type="checkbox" name="consent" value="1" @checked(old('consent')) required class="accent-brand mt-1">
                        <span>By sending this request I agree to be contacted regarding my question. <span class="text-sale">*</span></span>
                    </label>

                    <div class="pt-1">
                        <button type="submit" class="btn-brand h-11 px-8 gap-2"><i class="fa-solid fa-paper-plane"></i>Send</button>
                    </div>
                </form>

                {{-- ===== Right: product image (dynamic to the current product) ===== --}}
                <div class="order-1 md:order-2">
                    <div class="rounded-xl border border-line bg-canvas overflow-hidden aspect-square md:sticky md:top-24">
                        <img src="{{ image_url($product->main_image, $product->name) }}" alt="{{ $product->name }}" class="w-full h-full object-contain">
                    </div>
                    <p class="text-center text-sm text-muted mt-2">{{ $product->name }}</p>
                </div>
            </div>
        </div>
    </div>
</x-layout>
