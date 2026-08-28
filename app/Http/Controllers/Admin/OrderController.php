<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('items')
            ->when($request->name, fn ($query, $name) => $query->where('name', 'like', "%{$name}%"))
            ->when($request->phone, fn ($query, $phone) => $query->where('phone', 'like', "%{$phone}%"))
            ->when($request->q, fn ($query, $q) => $query->where(fn ($sub) => $sub
                ->where('order_number', 'like', "%{$q}%")
                ->orWhere('name', 'like', "%{$q}%")
                ->orWhere('phone', 'like', "%{$q}%")))
            ->when($request->status, fn ($query, $status) => $query->where('status', $status))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'payments');

        return view('admin.orders.show', compact('order'));
    }

    /** Single printable / downloadable invoice for one order. */
    public function invoice(Order $order)
    {
        $order->load('items.product');

        return view('admin.orders.invoice', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,processing,shipped,delivered,cancelled'],
        ]);

        $order->update($data);

        return back()->with('status', 'Order status updated.');
    }

    public function bulkPrint(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
        ]);

        $orders = Order::with('items.product')->whereIn('id', $request->order_ids)->get();

        return view('admin.orders.bulk-print', compact('orders'));
    }
}
