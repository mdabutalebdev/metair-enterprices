<x-admin-layout title="Order #{{ $order->order_number }}">
    <div class="flex items-center justify-between mb-4 gap-3 flex-wrap">
        <a href="{{ route('admin.orders.index') }}" class="text-sm text-muted hover:text-brand inline-block"><i class="fa-solid fa-arrow-left mr-1"></i>Orders</a>
        <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="btn-brand h-10 px-4 inline-flex items-center gap-2">
            <i class="fa-solid fa-file-invoice"></i>View / Print Invoice
        </a>
    </div>

    <div class="grid lg:grid-cols-[1fr_320px] gap-6">
        {{-- Items --}}
        <div class="space-y-6">
            <div class="bg-white rounded-xl border border-line p-5">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-bold">Order Items</h2>
                    <span class="text-xs text-muted">{{ $order->created_at->format('d M Y, g:i A') }}</span>
                </div>
                <div class="divide-y divide-line">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-3 py-3">
                            <div class="flex-1"><div class="font-semibold text-sm">{{ $item->name }}</div><div class="text-xs text-muted">{{ $item->quantity }} × {{ bdt($item->price) }}</div></div>
                            <div class="font-bold">{{ bdt($item->subtotal) }}</div>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-line mt-3 pt-3 space-y-1 text-sm">
                    <div class="flex justify-between"><span class="text-muted">Subtotal</span><span>{{ bdt($order->subtotal) }}</span></div>
                    <div class="flex justify-between"><span class="text-muted">Delivery</span><span>{{ bdt($order->shipping_fee) }}</span></div>
                    <div class="flex justify-between font-bold text-lg border-t border-line pt-2"><span>Total</span><span class="text-brand">{{ bdt($order->total) }}</span></div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-line p-5 text-sm">
                <h2 class="font-bold mb-3">Customer & Delivery</h2>
                <div class="grid sm:grid-cols-2 gap-2 text-muted">
                    <div><span class="text-ink font-semibold">Name:</span> {{ $order->name }}</div>
                    <div><span class="text-ink font-semibold">Mobile:</span> {{ $order->phone }}</div>
                    <div class="sm:col-span-2"><span class="text-ink font-semibold">Address:</span> {{ $order->address }}{{ $order->thana ? ', '.$order->thana : '' }}{{ $order->district ? ', '.$order->district : '' }}{{ $order->division ? ', '.$order->division : '' }}</div>
                    <div><span class="text-ink font-semibold">Area:</span> {{ $order->delivery_zone === 'inside_dhaka' ? 'Inside Dhaka' : 'Outside Dhaka' }}</div>
                    <div><span class="text-ink font-semibold">Payment:</span> {{ $order->payment_method === 'cod' ? 'Cash on Delivery' : 'Mobile Banking' }}</div>
                    @if($order->payment_method === 'mobile_banking')
                        <div><span class="text-ink font-semibold">Channel:</span> {{ $order->payment_channel ? ucfirst($order->payment_channel) : '—' }}</div>
                        <div><span class="text-ink font-semibold">Sender Number:</span> {{ $order->payment_sender_number ?: '—' }}</div>
                        <div><span class="text-ink font-semibold">Transaction ID:</span> {{ $order->payment_txn_id ?: '—' }}</div>
                    @endif
                    @if($order->notes)<div class="sm:col-span-2"><span class="text-ink font-semibold">Note:</span> {{ $order->notes }}</div>@endif
                </div>
            </div>
        </div>

        {{-- Status update --}}
        <div class="bg-white rounded-xl border border-line p-5 h-fit">
            <h2 class="font-bold mb-4">Update Status</h2>
            <form method="POST" action="{{ route('admin.orders.status', $order) }}" class="space-y-3">
                @csrf @method('PATCH')
                <div>
                    <label class="block text-sm font-medium mb-1">Order Status</label>
                    <select name="status" class="w-full h-11 rounded-lg border border-line px-3 text-sm bg-white">
                        @foreach(\App\Models\Order::STATUS_LABELS as $key => $label)
                            <option value="{{ $key }}" @selected($order->status===$key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-1">Payment Status</label>
                    <select name="payment_status" class="w-full h-11 rounded-lg border border-line px-3 text-sm bg-white">
                        @foreach(['unpaid' => 'Unpaid', 'paid' => 'Paid', 'failed' => 'Failed'] as $key => $label)
                            <option value="{{ $key }}" @selected($order->payment_status===$key)>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn-brand w-full h-11">Update</button>
            </form>
        </div>
    </div>
</x-admin-layout>
