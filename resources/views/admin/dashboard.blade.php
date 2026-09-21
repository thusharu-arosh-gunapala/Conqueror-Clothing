@extends('admin.layouts.app')

@section('page-title', 'Dashboard')
@section('title', 'Admin Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="dashboard-card">
                <h5>Total Orders</h5>
                <div class="number">{{ $totalOrders }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card secondary">
                <h5>New Orders</h5>
                <div class="number">{{ $newOrders }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card success">
                <h5>Delivered</h5>
                <div class="number">{{ $deliveredOrders }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card warning">
                <h5>Total Sales</h5>
                <div class="number">{{ currency_lkr($totalSalesAmount) }}</div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="dashboard-card danger">
                <h5>Total Products</h5>
                <div class="number">{{ $totalProducts }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card">
                <h5>Total Categories</h5>
                <div class="number">{{ $totalCategories }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card secondary">
                <h5>Low Stock</h5>
                <div class="number">{{ $lowStockProducts }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card success">
                <h5>Pending Orders</h5>
                <div class="number">{{ $pendingOrders }}</div>
            </div>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="mb-0">Recent Orders</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td><strong>{{ $order->order_number }}</strong></td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ currency_lkr($order->total_amount) }}</td>
                                <td>
                                    <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $order->status)) }}">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No orders yet</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
