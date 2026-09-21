@extends('admin.layouts.app')

@section('page-title', 'View Order')
@section('title', 'Order Details')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Order {{ $order->order_number }}</h5>
                        <div>
                            @if($order->customer_whatsapp)
                                <a href="https://wa.me/{{ $order->customer_whatsapp }}" target="_blank" class="btn btn-sm btn-success">
                                    <i class="bi bi-whatsapp"></i> WhatsApp
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h6 class="mb-3">Customer Information</h6>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                            <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                            @if($order->customer_email)
                                <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <p><strong>Address:</strong> {{ $order->delivery_address }}</p>
                            <p><strong>City:</strong> {{ $order->city }}</p>
                        </div>
                    </div>

                    <hr>

                    <h6 class="mb-3">Order Items</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Size/Color</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <strong>{{ $item->product_name }}</strong><br>
                                            <small class="text-muted">{{ $item->product_code }}</small>
                                        </td>
                                        <td>{{ $item->size }} / {{ $item->color }}</td>
                                        <td>{{ currency_lkr($item->price) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ currency_lkr($item->subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($order->order_notes)
                        <hr>
                        <p><strong>Order Notes:</strong></p>
                        <p>{{ $order->order_notes }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Order Status</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.orders.update-status', $order) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status" required>
                                <option value="New" {{ $order->status == 'New' ? 'selected' : '' }}>New</option>
                                <option value="Pending" {{ $order->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Confirmed" {{ $order->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="Processing" {{ $order->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                                <option value="Delivered" {{ $order->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="Cancelled" {{ $order->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    </form>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Summary</h5>
                </div>
                <div class="card-body">
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i A') }}</p>
                    <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
                    <hr>
<p style="font-size: 1.3rem;"><strong>Total:</strong> {{ currency_lkr($order->total_amount) }}</p>

                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.orders.print', $order) }}" target="_blank" class="btn btn-outline-primary">
                            <i class="bi bi-printer"></i> Print Invoice
                        </a>
                        <form method="DELETE" action="{{ route('admin.orders.destroy', $order) }}" style="display: inline;" onsubmit="return confirm('Delete this order?');">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger w-100">
                                <i class="bi bi-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
