@extends('frontend.layouts.app')

@section('title', $product->name . ' - Conqueror Clothing')

@section('content')
    <div class="container my-5">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('categories.show', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                <li class="breadcrumb-item active">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <!-- Product Images -->
            <div class="col-md-5">
                <div class="card mb-3">
                    @if($product->main_image)
                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="card-img-top" id="mainImage" style="height: 400px; object-fit: cover;">
                    @else
                        <div class="card-img-top" style="height: 400px; background-color: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-image" style="font-size: 3rem; color: #ddd;"></i>
                        </div>
                    @endif
                </div>

                <!-- Additional Images -->
                @if($product->images->count() > 0)
                    <div class="d-flex gap-2">
                        @if($product->main_image)
                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="Main" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;" onclick="changeImage(this.src)">
                        @endif
                        @foreach($product->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover; cursor: pointer;" onclick="changeImage(this.src)">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Product Details -->
            <div class="col-md-7">
                <h1>{{ $product->name }}</h1>
                <small class="text-muted">Category: <a href="{{ route('categories.show', $product->category->slug) }}">{{ $product->category->name }}</a></small>

                <div class="my-4">
                    <div class="product-price">
                        @if($product->discount_price)
                            <span class="discount" style="font-size: 1.5rem;">{{ currency_lkr($product->price) }}</span>
                            <span style="font-size: 2rem; font-weight: bold; color: #667eea;">{{ currency_lkr($product->discount_price) }}</span>
                            <span style="color: #28a745; margin-left: 10px;">(Save {{ currency_lkr($product->price - $product->discount_price) }})</span>
                        @else
                            <span style="font-size: 2rem; font-weight: bold; color: #667eea;">{{ currency_lkr($product->price) }}</span>
                        @endif
                    </div>
                </div>

                <!-- Product Description -->
                <div class="mb-4">
                    <h5>Description</h5>
                    <p>{{ $product->description }}</p>
                </div>

                <!-- Product Code -->
                <div class="mb-4">
                    <small class="text-muted">Product Code: <strong>{{ $product->product_code }}</strong></small>
                </div>

                <!-- Stock Status -->
                <div class="mb-4">
                    @if($product->stock_quantity > 0)
                        <span class="badge bg-success">In Stock ({{ $product->stock_quantity }} available)</span>
                    @else
                        <span class="badge bg-danger">Out of Stock</span>
                    @endif
                </div>

                <!-- Add to Cart Form -->
                @if($product->stock_quantity > 0)
                    <form id="addToCartForm">
                        @csrf

                        <!-- Size Selection -->
                        @php $sizes = json_decode($product->sizes, true) ?? []; @endphp
                        @if(!empty($sizes))
                            <div class="mb-3">
                                <label for="size" class="form-label">Select Size *</label>
                                <select class="form-select" id="size" name="size" required>
                                    <option value="">-- Choose a size --</option>
                                    @foreach($sizes as $size)
                                        <option value="{{ $size }}">{{ $size }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Color Selection -->
                        @php $colors = json_decode($product->colors, true) ?? []; @endphp
                        @if(!empty($colors))
                            <div class="mb-3">
                                <label for="color" class="form-label">Select Color *</label>
                                <select class="form-select" id="color" name="color" required>
                                    <option value="">-- Choose a color --</option>
                                    @foreach($colors as $color)
                                        <option value="{{ $color }}">{{ $color }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- Quantity -->
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" min="1" max="{{ $product->stock_quantity }}" value="1" required>
                        </div>

                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <button type="button" class="btn btn-primary btn-lg w-100" onclick="addToCart(event)">
                            <i class="bi bi-bag-plus"></i> Add to Cart
                        </button>
                    </form>
                @endif
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <section class="my-5">
                <h3>Related Products</h3>
                <div class="row g-4">
                    @foreach($relatedProducts as $related)
                        <div class="col-md-6 col-lg-3">
                            <div class="product-card">
                                @if($related->main_image)
                                    <img src="{{ asset('storage/' . $related->main_image) }}" alt="{{ $related->name }}" class="product-image">
                                @else
                                    <div class="product-image" style="background-color: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-image" style="font-size: 2rem; color: #ddd;"></i>
                                    </div>
                                @endif
                                <div class="product-info">
                                    <div class="product-name">
                                        <a href="{{ route('products.show', $related->slug) }}" style="text-decoration: none; color: inherit;">
                                            {{ $related->name }}
                                        </a>
                                    </div>
                                    <div class="product-price">
                                        @if($related->discount_price)
                                            <span class="discount">{{ currency_lkr($related->price) }}</span>
                                            {{ currency_lkr($related->discount_price) }}
                                        @else
                                            {{ currency_lkr($related->price) }}
                                        @endif
                                    </div>
                                    <a href="{{ route('products.show', $related->slug) }}" class="btn btn-sm btn-outline-primary w-100">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function changeImage(src) {
            document.getElementById('mainImage').src = src;
        }

        function addToCart(event) {
            event.preventDefault();

            const form = document.getElementById('addToCartForm');
            const formData = new FormData(form);

            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Update cart count
                    document.getElementById('cartCount').textContent = data.cartCount;
                    form.reset();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => Promise.reject(err));
                }
                return response.json();
            })
            .then(data => {
                alert(data.message);
                // Update cart count
                document.getElementById('cartCount').textContent = data.cartCount;
                form.reset();
            })
            .catch(error => {
                const message = error.message || (error.errors ? Object.values(error.errors).flat().join('\n') : 'An unknown error occurred');
                alert('Error: ' + message);
            });
        }
    </script>
@endsection
