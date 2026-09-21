@extends('frontend.layouts.app')

@section('title', $category->name . ' - Conqueror Clothing')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">{{ $category->name }}</h1>

        @if($category->description)
            <p class="lead mb-4">{{ $category->description }}</p>
        @endif

        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Filters</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="{{ route('categories.show', $category->slug) }}">
                            <!-- Search -->
                            <div class="mb-3">
                                <label for="search" class="form-label">Search</label>
                                <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Product name...">
                            </div>

                            <!-- Price Range -->
                            <div class="mb-3">
                                <label for="min_price" class="form-label">Min Price</label>
                                <input type="number" class="form-control" id="min_price" name="min_price" value="{{ request('min_price') }}" placeholder="0">
                            </div>

                            <div class="mb-3">
                                <label for="max_price" class="form-label">Max Price</label>
                                <input type="number" class="form-control" id="max_price" name="max_price" value="{{ request('max_price') }}" placeholder="1000">
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                            <a href="{{ route('categories.show', $category->slug) }}" class="btn btn-outline-secondary w-100 mt-2">Clear</a>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products -->
            <div class="col-md-9">
                @if($products->count() > 0)
                    <div class="row g-4">
                        @foreach($products as $product)
                            <div class="col-md-6 col-lg-4">
                                <div class="product-card">
                                    @if($product->main_image)
                                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="product-image">
                                    @else
                                        <div class="product-image" style="background-color: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-image" style="font-size: 2rem; color: #ddd;"></i>
                                        </div>
                                    @endif
                                    <div class="product-info">
                                        <div class="product-name">
                                            <a href="{{ route('products.show', $product->slug) }}" style="text-decoration: none; color: inherit;">
                                                {{ $product->name }}
                                            </a>
                                        </div>
                                        <div class="product-price">
                                            @if($product->discount_price)
                                                <span class="discount">{{ currency_lkr($product->price) }}</span>
                                                {{ currency_lkr($product->discount_price) }}
                                            @else
                                                {{ currency_lkr($product->price) }}
                                            @endif
                                        </div>
                                        <a href="{{ route('products.show', $product->slug) }}" class="btn btn-sm btn-primary w-100">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                @else
                    <div class="alert alert-info">No products found in this category.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
