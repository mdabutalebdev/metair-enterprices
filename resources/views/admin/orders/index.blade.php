<x-admin-layout title="Orders">
    <form method="GET" class="flex items-end gap-2 mb-4 flex-wrap">
        <div>
            <label class="block text-[11px] font-semibold text-muted mb-0.5">Customer name</label>
            <div class="relative">
                <input type="text" name="name" value="{{ request('name') }}" placeholder="Filter by name..." class="w-52 h-10 rounded-lg border border-line pl-9 pr-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
                <i class="fa-solid fa-user absolute left-3 top-3 text-muted text-sm"></i>
            </div>
        </div>
        <div>
            <label class="block text-[11px] font-semibold text-muted mb-0.5">Phone number</label>
            <div class="relative">
                <input type="text" name="phone" value="{{ request('phone') }}" placeholder="Filter by phone..." class="w-52 h-10 rounded-lg border border-line pl-9 pr-3 text-sm bg-white focus:outline-none focus:ring-2 focus:ring-brand/30">
                <i class="fa-solid fa-phone absolute left-3 top-3 text-muted text-sm"></i>
            </div>
        </div>
        <div>
            <label class="block text-[11px] font-semibold text-muted mb-0.5">Status</label>
            <select name="status" class="h-10 rounded-lg border border-line px-3 text-sm bg-white">
                <option value="">All Statuses</option>
                @foreach(\App\Models\Order::STATUS_LABELS as $key => $label)
                    <option value="{{ $key }}" @selected(request('status')===$key)>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <button class="h-10 px-4 rounded-lg bg-brand text-white text-sm font-semibold"><i class="fa-solid fa-filter"></i> Filter</button>
        @if(request()->hasAny(['name','phone','status','q']))
            <a href="{{ route('admin.orders.index') }}" class="h-10 px-3 inline-flex items-center rounded-lg border border-line text-sm text-muted hover:bg-canvas">Clear</a>
        @endif
    </form>

    <div x-data="{ 
        selectAll: false, 
        selected: [], 
        toggleAll() { 
            this.selectAll = !this.selectAll; 
            if(this.selectAll) { this.selected = {{ $orders->pluck('id')->toJson() }}; } else { this.selected = []; }
        }
    }">
        <form method="POST" action="{{ route('admin.orders.bulk_print') }}" target="_blank">
            @csrf
            <div class="flex justify-end mb-3" x-show="selected.length > 0" x-cloak>
                <button type="submit" class="h-10 px-4 rounded-lg bg-ink text-white text-sm font-semibold flex items-center gap-2">
                    <i class="fa-solid fa-print"></i> Print Selected Invoices (<span x-text="selected.length"></span>)
                </button>
            </div>

            <div class="bg-white rounded-xl border border-line overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-canvas text-muted text-left">
                            <tr>
                                <th class="px-4 py-3 w-10"><input type="checkbox" @click="toggleAll()" :checked="selectAll" class="accent-brand w-4 h-4 rounded border-line"></th>
                                <th class="px-4 py-3 font-semibold">Order No</th>
                                <th class="px-4 py-3 font-semibold">Customer</th>
                                <th class="px-4 py-3 font-semibold">Products</th>
                                <th class="px-4 py-3 font-semibold">Total</th>
                                <th class="px-4 py-3 font-semibold">Payment</th>
                                <th class="px-4 py-3 font-semibold">Status</th>
                                <th class="px-4 py-3 font-semibold text-right"></th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-line">
                            @forelse($orders as $order)
                                <tr class="hover:bg-canvas">
                                    <td class="px-4 py-3"><input type="checkbox" name="order_ids[]" value="{{ $order->id }}" x-model="selected" class="accent-brand w-4 h-4 rounded border-line"></td>
                                    <td class="px-4 py-3"><a href="{{ route('admin.orders.show', $order) }}" class="font-semibold text-brand">{{ $order->order_number }}</a><div class="text-xs text-muted">{{ $order->created_at->format('d M, g:i A') }}</div></td>
                                    <td class="px-4 py-3">{{ $order->name }}<div class="text-xs text-muted">{{ $order->phone }}</div></td>
                                    <td class="px-4 py-3">{{ $order->items_count }} items</td>
                                    <td class="px-4 py-3 font-bold">{{ bdt($order->total) }}</td>
                                    <td class="px-4 py-3"><span class="text-xs">{{ $order->payment_method === 'cod' ? 'COD' : 'Mobile' }}</span></td>
                                    <td class="px-4 py-3"><span class="text-xs font-semibold px-2 py-1 rounded-full bg-brand-light text-brand">{{ \App\Models\Order::STATUS_LABELS[$order->status] ?? $order->status }}</span></td>
                                    <td class="px-4 py-3 text-right">
                                        <div class="flex items-center justify-end gap-1">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="w-8 h-8 grid place-items-center rounded-lg hover:bg-brand-light text-brand" title="View"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="w-8 h-8 grid place-items-center rounded-lg hover:bg-brand-light text-brand" title="Invoice"><i class="fa-solid fa-file-invoice"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="8" class="px-4 py-10 text-center text-muted">No orders yet.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-4">{{ $orders->links() }}</div>
</x-admin-layout>
