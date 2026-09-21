<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();
        $newOrders = Order::where('status', 'New')->count();
        $pendingOrders = Order::where('status', 'Pending')->count();
        $confirmedOrders = Order::where('status', 'Confirmed')->count();
        $deliveredOrders = Order::where('status', 'Delivered')->count();
        $cancelledOrders = Order::where('status', 'Cancelled')->count();
        $lowStockProducts = Product::where('stock_quantity', '<', 10)->count();
        $totalSalesAmount = Order::where('status', 'Delivered')->sum('total_amount');

        $recentOrders = Order::latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'newOrders',
            'pendingOrders',
            'confirmedOrders',
            'deliveredOrders',
            'cancelledOrders',
            'lowStockProducts',
            'totalSalesAmount',
            'recentOrders'
        ));
    }
}
