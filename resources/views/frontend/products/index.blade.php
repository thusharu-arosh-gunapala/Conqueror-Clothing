@extends('frontend.layouts.app')

@section('title', 'CONQUEROR - PRODUCTS')

@section('content')
    <style>
        .products-header {
            background-color: #000;
            color: #fff;
            padding: 60px 0;
            text-align: center;
            border-bottom: 1px solid #222;
        }

        .products-header h1 {
            font-size: 2.8rem;
            font-weight: 900;
            letter-spacing: 3px;
            text-transform: uppercase;
            margin: 0;
        }

        .filter-section {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #eee;
            margin-bottom: 40px;
        }

        .filter-title {
            font-size: 0.9rem;
            font-weight: 800;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 15px;
            color: #000;
        }

        .filter-section input,
        .filter-section select {
            border: 1px solid #ddd !important;
            border-radius: 0 !important;
            padding: 12px !important;
            font-size: 0.9rem;
            background-color: #fff;
        }

        .filter-section input:focus,
        .filter-section select:focus {
            border-color: #000 !important;
            box-shadow: none;
            outline: none;
        }

        .btn-filter {
            background-color: #000;
            border: 2px solid #000;
            color: #fff;
            width: 100%;
            padding: 12px;
            border-radius: 0;
            cursor: pointer;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
        }

        .btn-filter:hover {
            background-color: #fff;
            color: #000;
        }

        .btn-clear {
            background-color: transparent;
            border: 2px solid #999;
            color: #666;
            width: 100%;
            padding: 12px;
            border-radius: 0;
            cursor: pointer;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .btn-clear:hover {
            border-color: #000;
            color: #000;
        }

        .product-count {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 30px;
            letter-spacing: 0.5px;
        }

        .no-products {
            text-align: center;
            padding: 60px 20px;
        }

        .no-products i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .no-products p {
            font-size: 1.1rem;
            color: #666;
        }
    </style>

    <!-- Products Header -->
    <div class="products-header">
        <h1>PRODUCTS</h1>
    </div>

    <div class="container" style="padding: 60px 0;">
        <div class="row">
            <!-- Sidebar Filters -->
            <div class="col-lg-3 mb-4">
                <div class="filter-section">
                    <form method="GET" action="{{ route('products.index') }}">
                        <!-- Search -->
                        <div class="mb-4">
                            <p class="filter-title">SEARCH</p>
                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Product name...">
                        </div>

                        <!-- Category Filter -->
                        <div class="mb-4">
                            <p class="filter-title">CATEGORY</p>
                            <select class="form-select" id="category" name="category">
                                <option value="">ALL CATEGORIES</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Price Range -->
                        <div class="mb-4">
                            <p class="filter-title">PRICE RANGE</p>
                            <input type="number" class="form-control" id="min_price" name="min_price" value="{{ request('min_price') }}" placeholder="Min price">
                        </div>

                        <div class="mb-4">
                            <input type="number" class="form-control" id="max_price" name="max_price" value="{{ request('max_price') }}" placeholder="Max price">
                        </div>

                        <button type="submit" class="btn-filter">FILTER</button>
                        <a href="{{ route('products.index') }}" class="btn-clear">CLEAR</a>
                    </form>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9">
                @if($products->count() > 0)
                    <p class="product-count">SHOWING {{ $products->count() }} PRODUCTS</p>
                    <div class="row g-4">
                        @foreach($products as $product)
                            <div class="col-md-6 col-lg-4">
                                <div class="product-card">
                                    <div class="product-image-wrapper">
                                        @if($product->main_image)
                                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="product-image">
                                        @else
                                            <div style="background-color: #f5f5f5; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%;">
                                                <i class="bi bi-image" style="font-size: 3rem; color: #ddd;"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="product-info">
                                        @if($product->product_code)
                                            <div class="product-code">{{ $product->product_code }}</div>
                                        @endif
                                        <div class="product-name">
                                            <a href="{{ route('products.show', $product->slug) }}" style="text-decoration: none; color: inherit;">
                                                {{ $product->name }}
                                            </a>
                                        </div>
                                        <small style="font-size: 0.8rem; color: #666; text-transform: uppercase; letter-spacing: 0.5px;">{{ $product->category->name }}</small>
                                        <div class="product-price mt-2">
                                            @if($product->discount_price)
                                                <span class="discount">{{ currency_lkr($product->price) }}</span>
                                                {{ currency_lkr($product->discount_price) }}
                                            @else
                                                {{ currency_lkr($product->price) }}
                                            @endif
                                        </div>
                                        <a href="{{ route('products.show', $product->slug) }}" class="btn-add-cart">VIEW PRODUCT</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    @if($products->hasPages())
                        <div style="margin-top: 50px; text-align: center;">
                            {{ $products->links() }}
                        </div>
                    @endif
                @else
                    <div class="no-products">
                        <i class="bi bi-search"></i>
                        <p>NO PRODUCTS FOUND</p>
                        <p style="font-size: 0.95rem; color: #999;">Try adjusting your filters or search terms.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
