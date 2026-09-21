@extends('frontend.layouts.app')

@section('title', 'Order Success - CONQUEROR Clothing')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body text-center" style="padding: 40px;">
                        <div style="font-size: 4rem; color: #D4AF37; margin-bottom: 20px;">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>

                        <h2 class="mb-3" style="color: #1a1a1a;">Order Placed Successfully!</h2>
                        <p class="text-muted mb-2">Thank you for your order. We're sending your details to WhatsApp now.</p>
                        
                        @if($whatsappLink)
                            <p class="text-success mb-4" style="font-size: 0.95rem;">
                                <i class="bi bi-whatsapp"></i> <strong>WhatsApp notification is being sent...</strong>
                            </p>
                        @endif

                        <div class="alert alert-info mb-4" style="background-color: #f5f1e8; border: 1px solid #E8D5C4; color: #1a1a1a;">
                            <strong style="color: #D4AF37;">Order Number:</strong> {{ $order->order_number }}
                        </div>

                        <!-- Order Details -->
                        <div class="card mb-4" style="background-color: #f9f9f9; border: none;">
                            <div class="card-body">
                                <h5 class="text-start mb-3">Order Details</h5>

                                <div class="row text-start mb-3">
                                    <div class="col-md-6">
                                        <p><strong>Customer Name:</strong> {{ $order->customer_name }}</p>
                                        <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                                        @if($order->customer_whatsapp)
                                            <p><strong>WhatsApp:</strong> {{ $order->customer_whatsapp }}</p>
                                        @endif
                                        @if($order->customer_email)
                                            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Delivery Address:</strong> {{ $order->delivery_address }}</p>
                                        <p><strong>City:</strong> {{ $order->city }}</p>
                                        <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y H:i A') }}</p>
                                    </div>
                                </div>

                                <hr>

                                <h5 class="text-start mb-3">Order Items</h5>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Size/Color</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>{{ $item->product_name }} ({{ $item->product_code }})</td>
                                                <td>{{ $item->size }} / {{ $item->color }}</td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ currency_lkr($item->price) }}</td>
                                                <td>{{ currency_lkr($item->subtotal) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <hr>

                                @if($order->order_notes)
                                    <div class="mb-3 text-start">
                                        <strong>Order Notes:</strong>
                                        <p>{{ $order->order_notes }}</p>
                                    </div>
                                @endif

                                <div class="text-end">
                                    <p class="mb-0">
                                        <strong>Total Amount:</strong>
                                        <span style="font-size: 1.3rem; color: #D4AF37;">{{ currency_lkr($order->total_amount) }}</span>
                                    </p>
                                    <small class="text-muted">Payment Method: {{ $order->payment_method }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- WhatsApp Status -->
                        @if($whatsappLink)
                            <div class="alert alert-info mb-4" style="background-color: #f5f1e8; border: 1px solid #E8D5C4;">
                                <i class="bi bi-info-circle"></i> <strong>Your order details are being sent to WhatsApp.</strong>
                                <br><small>If a WhatsApp window doesn't open, click the button below to send manually.</small>
                            </div>
                            <div class="mb-4">
                                <a href="{{ $whatsappLink }}" id="whatsappBtn" target="_blank" class="btn btn-lg" style="background-color: #25D366; color: white; border: none; font-weight: 600;">
                                    <i class="bi bi-whatsapp"></i> Resend Order on WhatsApp
                                </a>
                            </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('home') }}" class="btn btn-lg" style="background-color: #1a1a1a; color: #D4AF37; border: 2px solid #D4AF37; font-weight: 600;">
                                <i class="bi bi-house-door"></i> Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-4" style="background-color: #f5f1e8; border: 1px solid #E8D5C4;">
                    <h5 style="color: #D4AF37;">What's Next?</h5>
                    <ul class="mb-0" style="color: #1a1a1a;">
                        <li><i class="bi bi-whatsapp" style="color: #25D366;"></i> <strong>Order sent to WhatsApp:</strong> Your order details have been automatically sent to our WhatsApp</li>
                        <li>We will confirm your order and provide delivery details</li>
                        <li>Payment will be collected on delivery (Cash on Delivery)</li>
                        <li>Thank you for shopping with CONQUEROR Clothing!</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @if($whatsappLink)
    <script>
        // Auto-open WhatsApp link when page loads
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                // Check if the page is being viewed (not in background)
                if (document.visibilityState === 'visible') {
                    window.open('{{ $whatsappLink }}', '_blank', 'width=500,height=600');
                }
            }, 1000); // 1 second delay to allow page to fully load
        });
    </script>
    @endif
@endsection
