@extends('frontend.layouts.app')

@section('title', 'Checkout - Conqueror Clothing')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Cash on Delivery Checkout</h1>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Delivery Information</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('order.place') }}">
                            @csrf

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="customer_name" class="form-label">Full Name *</label>
                                    <input type="text" class="form-control @error('customer_name') is-invalid @enderror" id="customer_name" name="customer_name" required value="{{ old('customer_name') }}">
                                    @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="customer_phone" class="form-label">Phone Number *</label>
                                    <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror" id="customer_phone" name="customer_phone" required value="{{ old('customer_phone') }}">
                                    @error('customer_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="customer_whatsapp" class="form-label">WhatsApp Number (Optional)</label>
                                    <input type="tel" class="form-control" id="customer_whatsapp" name="customer_whatsapp" value="{{ old('customer_whatsapp') }}">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="customer_email" class="form-label">Email (Optional)</label>
                                    <input type="email" class="form-control" id="customer_email" name="customer_email" value="{{ old('customer_email') }}">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="delivery_address" class="form-label">Delivery Address *</label>
                                <textarea class="form-control @error('delivery_address') is-invalid @enderror" id="delivery_address" name="delivery_address" rows="3" required>{{ old('delivery_address') }}</textarea>
                                @error('delivery_address') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="city" class="form-label">City / Area *</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" required value="{{ old('city') }}">
                                @error('city') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="order_notes" class="form-label">Order Notes (Optional)</label>
                                <textarea class="form-control" id="order_notes" name="order_notes" rows="3">{{ old('order_notes') }}</textarea>
                            </div>

                            <div class="alert alert-info">
                                <h5>Payment Method: Cash on Delivery</h5>
                                <p>{{ $settings->cod_message ?? 'Payment will be collected on delivery.' }}</p>
                                @if($settings->delivery_information)
                                    <p class="mb-0">{{ $settings->delivery_information }}</p>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">Place Order</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="cart-summary">
                    <h5>Order Summary</h5>
                    <hr>

                    <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                        @php $total = 0; @endphp
                        @foreach(session('cart', []) as $item)
                            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                            <div class="mb-2 pb-2" style="border-bottom: 1px solid #eee;">
                                <div class="d-flex justify-content-between">
                                    <span>{{ $item['product_name'] }}</span>
                                    <span>{{ currency_lkr($subtotal) }}</span>
                                </div>
                                <small class="text-muted">
                                    {{ $item['size'] }} / {{ $item['color'] }} x {{ $item['quantity'] }}
                                </small>
                            </div>
                        @endforeach
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between mb-4" style="font-size: 1.3rem; font-weight: bold;">
                        <span>Total:</span>
                        <span>{{ currency_lkr($total) }}</span>
                    </div>

                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i> Secure order
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
