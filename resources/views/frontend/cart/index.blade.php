@extends('frontend.layouts.app')

@section('title', 'Shopping Cart - Conqueror Clothing')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Shopping Cart</h1>

        @if(count($cart) > 0)
            <div class="row">
                <div class="col-md-8">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Size/Color</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $key => $item)
                                    <tr>
                                        <td>
                                            @if($item['main_image'])
                                                <img src="{{ asset('storage/' . $item['main_image']) }}" alt="{{ $item['product_name'] }}" style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px;">
                                            @endif
                                            {{ $item['product_name'] }}<br>
                                            <small class="text-muted">Code: {{ $item['product_code'] }}</small>
                                        </td>
                                        <td>{{ $item['size'] }} / {{ $item['color'] }}</td>
                                        <td>{{ currency_lkr($item['price']) }}</td>
                                        <td>
                                            <input type="number" class="form-control" style="width: 70px;" value="{{ $item['quantity'] }}" min="1" onchange="updateCart('{{ $key }}', this.value)">
                                        </td>
                                        <td>{{ currency_lkr($item['price'] * $item['quantity']) }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="removeFromCart('{{ $key }}')">Remove</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="cart-summary">
                        <h5>Order Summary</h5>
                        <hr>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Subtotal:</span>
                            <span>{{ currency_lkr($total) }}</span>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <span>Shipping:</span>
                            <span>Calculated at checkout</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-4" style="font-size: 1.2rem; font-weight: bold;">
                            <span>Total:</span>
                            <span>{{ currency_lkr($total) }}</span>
                        </div>

                        <a href="{{ route('checkout') }}" class="btn btn-primary btn-lg w-100 mb-2">
                            Proceed to Checkout
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary btn-lg w-100 mb-2">
                            Continue Shopping
                        </a>
                        <button class="btn btn-outline-danger btn-lg w-100" onclick="clearCart()">Clear Cart</button>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-info">
                <h5>Your cart is empty</h5>
                <p>Start shopping to add items to your cart!</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Shop Now</a>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function updateCart(cartKey, quantity) {
            fetch('{{ route("cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    cart_key: cartKey,
                    quantity: parseInt(quantity)
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Error: ' + data.message);
                }
            });
        }

        function removeFromCart(cartKey) {
            if (confirm('Remove this item from cart?')) {
                fetch('{{ route("cart.remove") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        cart_key: cartKey
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + data.message);
                    }
                });
            }
        }

        function clearCart() {
            if (confirm('Clear entire cart?')) {
                fetch('{{ route("cart.clear") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }
    </script>
@endsection
