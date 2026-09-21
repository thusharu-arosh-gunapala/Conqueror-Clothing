<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%$search%")
                  ->orWhere('customer_name', 'like', "%$search%")
                  ->orWhere('customer_phone', 'like', "%$search%");
            });
        }

        $orders = $query->latest()->paginate(15);
        $statuses = ['New', 'Pending', 'Confirmed', 'Processing', 'Delivered', 'Cancelled'];

        return view('admin.orders.index', compact('orders', 'statuses'));
    }

    public function show(Order $order)
    {
        $order->load('items');
        $settings = WebsiteSetting::getSetting();
        return view('admin.orders.show', compact('order', 'settings'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:New,Pending,Confirmed,Processing,Delivered,Cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.show', $order)->with('success', 'Order status updated');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }

    public function print(Order $order)
    {
        $order->load('items');
        $settings = WebsiteSetting::getSetting();
        return view('admin.orders.print', compact('order', 'settings'));
    }
}
