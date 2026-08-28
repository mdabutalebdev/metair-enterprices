<x-admin-layout title="Requests">
    {{-- Inline CSS: the compiled Tailwind bundle is fixed at build time, so this view
         uses plain classes for the details modal. --}}
    <style>
        .rq-btn { width: 2rem; height: 2rem; display: grid; place-items: center; border: 0; border-radius: 8px; background: transparent; cursor: pointer; transition: background .15s ease; }
        .rq-eye { color: var(--color-brand); }
        .rq-eye:hover { background: var(--color-brand-light); }
        .rq-del { color: var(--color-sale); }
        .rq-del:hover { background: #fee2e2; }

        .rq-backdrop { position: fixed; inset: 0; z-index: 60; background: rgba(15, 23, 42, .55); display: grid; place-items: center; padding: 1rem; }
        .rq-modal { background: #fff; width: 100%; max-width: 40rem; border-radius: 16px; overflow: hidden; box-shadow: 0 24px 60px rgba(0, 0, 0, .28); display: flex; flex-direction: column; max-height: 88vh; }
        .rq-head { background: var(--color-brand); color: #fff; padding: 1rem 1.25rem; display: flex; align-items: flex-start; justify-content: space-between; gap: 1rem; }
        .rq-head h3 { margin: 0; font-size: 1.05rem; font-weight: 800; }
        .rq-head p { margin: .15rem 0 0; font-size: .75rem; opacity: .9; }
        .rq-close { width: 2rem; height: 2rem; flex: 0 0 auto; border: 0; border-radius: 9999px; background: rgba(255, 255, 255, .18); color: #fff; cursor: pointer; display: grid; place-items: center; transition: background .15s ease; }
        .rq-close:hover { background: rgba(255, 255, 255, .32); }

        .rq-body { padding: 1.1rem 1.25rem; overflow-y: auto; }
        .rq-grid { display: grid; grid-template-columns: 1fr 1fr; gap: .85rem 1rem; }
        .rq-item .k { font-size: .7rem; color: var(--color-muted); }
        .rq-item .v { font-weight: 600; color: var(--color-ink); word-break: break-word; }
        .rq-item .v a { color: inherit; text-decoration: none; }
        .rq-item .v a:hover { color: var(--color-brand); }
        .rq-item.full { grid-column: 1 / -1; }
        .rq-msg { white-space: pre-wrap; font-weight: 400; line-height: 1.6; }

        .rq-foot { padding: .9rem 1.25rem; border-top: 1px solid var(--color-line); display: flex; gap: .5rem; justify-content: flex-end; flex-wrap: wrap; }
        .rq-action { height: 2.5rem; padding: 0 1rem; border-radius: 8px; border: 1px solid var(--color-line); background: #fff; color: var(--color-ink); font-size: .8125rem; font-weight: 600; display: inline-flex; align-items: center; gap: .4rem; text-decoration: none; cursor: pointer; }
        .rq-action:hover { border-color: var(--color-brand); color: var(--color-brand); }
    </style>

    <div x-data="{ open: false, r: {} }" @keydown.escape.window="open = false">
        <div class="flex items-center justify-between mb-4 gap-3">
            <h1 class="text-xl font-bold">Requests</h1>
            <p class="text-muted text-sm">{{ $requests->total() }} total</p>
        </div>

        <div class="bg-white rounded-xl border border-line overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-canvas text-muted text-left">
                        <tr>
                            <th class="px-4 py-3 font-semibold">Name</th>
                            <th class="px-4 py-3 font-semibold">Product</th>
                            <th class="px-4 py-3 font-semibold">Contact</th>
                            <th class="px-4 py-3 font-semibold">Location</th>
                            <th class="px-4 py-3 font-semibold">Date</th>
                            <th class="px-4 py-3 font-semibold text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-line">
                        @forelse($requests as $req)
                            <tr class="hover:bg-canvas">
                                <td class="px-4 py-3">
                                    <div class="font-semibold">{{ $req->full_name }}</div>
                                    @if($req->company)<div class="text-xs text-muted">{{ $req->company }}</div>@endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2.5">
                                        <img src="{{ image_url($req->product?->main_image, $req->product_name ?? 'Product') }}" alt="" class="w-10 h-10 rounded object-cover border border-line shrink-0 bg-canvas">
                                        <span>{{ $req->product_name ?? $req->product?->name ?? '—' }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <div><i class="fa-solid fa-envelope mr-1 text-muted"></i>{{ $req->email }}</div>
                                    @if($req->phone)<div><i class="fa-solid fa-phone mr-1 text-muted"></i>{{ $req->phone }}</div>@endif
                                </td>
                                <td class="px-4 py-3 text-muted text-xs">{{ collect([$req->city, $req->state, $req->country])->filter()->join(', ') ?: '—' }}</td>
                                <td class="px-4 py-3 text-muted text-xs">{{ $req->created_at->format('d M, Y h:i A') }}</td>
                                <td class="px-4 py-3">
                                    <div class="flex items-center justify-end gap-1">
                                        <button type="button" class="rq-btn rq-eye" title="View details"
                                                @click="r = {{ \Illuminate\Support\Js::from([
                                                    'name' => $req->full_name,
                                                    'company' => $req->company,
                                                    'email' => $req->email,
                                                    'phone' => $req->phone,
                                                    'country' => $req->country,
                                                    'state' => $req->state,
                                                    'city' => $req->city,
                                                    'postal' => $req->postal_code,
                                                    'product' => $req->product_name ?? $req->product?->name,
                                                    'product_image' => image_url($req->product?->main_image, $req->product_name ?? 'Product'),
                                                    'message' => $req->message,
                                                    'date' => $req->created_at->format('d M, Y h:i A'),
                                                ]) }}; open = true">
                                            <i class="fa-regular fa-eye"></i>
                                        </button>
                                        <form method="POST" action="{{ route('admin.requests.destroy', $req) }}" onsubmit="return confirm('Delete this request?')">
                                            @csrf @method('DELETE')
                                            <button class="rq-btn rq-del" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="px-4 py-10 text-center text-muted">No requests yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">{{ $requests->links() }}</div>

        {{-- Details modal (opened by the eye icon) --}}
        <div x-show="open" x-cloak class="rq-backdrop" @click.self="open = false">
            <div class="rq-modal" x-transition.opacity>
                <div class="rq-head">
                    <div>
                        <h3 x-text="r.name"></h3>
                        <p x-text="r.date"></p>
                    </div>
                    <button type="button" class="rq-close" @click="open = false" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>

                <div class="rq-body">
                    <div class="rq-grid">
                        <div class="rq-item full" x-show="r.product">
                            <div class="k">Product</div>
                            <div class="v" style="display:flex; align-items:center; gap:.6rem;">
                                <img :src="r.product_image" :alt="r.product" style="width:52px; height:52px; border-radius:8px; object-fit:cover; border:1px solid var(--color-line); background:var(--color-canvas); flex:0 0 auto;">
                                <span x-text="r.product"></span>
                            </div>
                        </div>
                        <div class="rq-item" x-show="r.company">
                            <div class="k">Company</div>
                            <div class="v" x-text="r.company"></div>
                        </div>
                        <div class="rq-item">
                            <div class="k">Email</div>
                            <div class="v"><a :href="'mailto:' + r.email" x-text="r.email"></a></div>
                        </div>
                        <div class="rq-item" x-show="r.phone">
                            <div class="k">Phone</div>
                            <div class="v"><a :href="'tel:' + r.phone" x-text="r.phone"></a></div>
                        </div>
                        <div class="rq-item" x-show="r.country">
                            <div class="k">Country</div>
                            <div class="v" x-text="r.country"></div>
                        </div>
                        <div class="rq-item" x-show="r.state">
                            <div class="k">State / Division</div>
                            <div class="v" x-text="r.state"></div>
                        </div>
                        <div class="rq-item" x-show="r.city">
                            <div class="k">City</div>
                            <div class="v" x-text="r.city"></div>
                        </div>
                        <div class="rq-item" x-show="r.postal">
                            <div class="k">Postal code</div>
                            <div class="v" x-text="r.postal"></div>
                        </div>
                        <div class="rq-item full" x-show="r.message">
                            <div class="k">Message</div>
                            <div class="v rq-msg" x-text="r.message"></div>
                        </div>
                    </div>
                </div>

                <div class="rq-foot">
                    <a class="rq-action" x-show="r.email" :href="'mailto:' + r.email"><i class="fa-solid fa-reply"></i>Reply by Email</a>
                    <a class="rq-action" x-show="r.phone" :href="'tel:' + r.phone"><i class="fa-solid fa-phone"></i>Call</a>
                    <button type="button" class="rq-action" @click="open = false">Close</button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
