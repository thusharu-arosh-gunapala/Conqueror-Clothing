<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CONQUEROR - Premium Streetwear')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: #111;
            background-color: #fff;
            line-height: 1.6;
        }

        /* NAVBAR */
        .navbar {
            background-color: #000 !important;
            padding: 18px 0;
            border-bottom: 2px solid #1a1a1a;
        }

        .navbar-brand {
            font-weight: 900;
            font-size: 1.8rem;
            color: #fff !important;
            letter-spacing: 4px;
            text-transform: uppercase;
            font-family: 'Courier New', monospace;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            font-kerning: auto;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .navbar .nav-link {
            color: #999 !important;
            margin: 0 18px;
            transition: color 0.3s ease;
            font-weight: 600;
            font-size: 0.85rem;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .navbar .nav-link:hover {
            color: #fff !important;
        }

        .navbar .nav-link.active {
            color: #fff !important;
        }

        .cart-icon {
            position: relative;
            font-size: 1.2rem;
            color: #fff;
            cursor: pointer;
            transition: color 0.3s;
        }

        .cart-icon:hover {
            color: #ccc;
        }

        .cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #000;
            color: #fff;
            border: 2px solid #fff;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.65rem;
            font-weight: 800;
        }

        /* HERO SECTION */
        .hero {
            background: linear-gradient(90deg, #000 0%, #1a1a1a 100%);
            color: white;
            padding: 140px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        /*
        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 'url("data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 1200 600%22><defs><pattern id=%22grid%22 width=%22100%22 height=%22100%22 patternUnits=%22userSpaceOnUse%22><path d=%22M 100 0 L 0 0 0 100%22 fill=%22none%22 stroke=%22rgba(255,255,255,0.03)%22 stroke-width=%221%22/></pattern></defs><rect width=%221200%22 height=%22600%22 fill=%22url(%23grid)%22/></svg>")';
            pointer-events: none;
        }
        */

        .hero h1 {
            font-size: 4rem;
            font-weight: 900;
            margin-bottom: 20px;
            letter-spacing: 4px;
            position: relative;
            z-index: 1;
            text-transform: uppercase;
            line-height: 1.1;
        }

        .hero p {
            font-size: 1.15rem;
            margin-bottom: 40px;
            color: #ccc;
            font-weight: 400;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
            text-transform: uppercase;
        }

        .btn-hero {
            background-color: #fff;
            color: #000;
            border: 2px solid #fff;
            padding: 15px 50px;
            font-weight: 800;
            font-size: 0.9rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            text-decoration: none;
            position: relative;
            z-index: 1;
        }

        .btn-hero:hover {
            background-color: transparent;
            color: #fff;
        }

        /* PRODUCT CARDS */
        .product-card {
            border: none;
            border-radius: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            height: 100%;
            background: #fff;
            box-shadow: none;
            position: relative;
        }

        .product-card:hover {
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            transform: translateY(-10px);
        }

        .product-image-wrapper {
            position: relative;
            width: 100%;
            height: 320px;
            background-color: #f5f5f5;
            overflow: hidden;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.08);
        }

        .product-info {
            padding: 25px 18px;
        }

        .product-name {
            font-weight: 700;
            margin-bottom: 12px;
            min-height: 50px;
            font-size: 1rem;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-code {
            font-size: 0.75rem;
            color: #888;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .product-price {
            font-size: 1.3rem;
            font-weight: 800;
            color: #000;
            margin-bottom: 18px;
        }

        .product-price .discount {
            text-decoration: line-through;
            color: #999;
            font-size: 0.9rem;
            margin-right: 12px;
            font-weight: 500;
        }

        .btn-add-cart {
            background-color: #000;
            border: 2px solid #000;
            color: #fff;
            width: 100%;
            padding: 14px;
            border-radius: 0;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 0.8rem;
        }

        .btn-add-cart:hover {
            background-color: #fff;
            color: #000;
        }

        /* CATEGORY CARDS */
        .category-card {
            text-align: center;
            border: none;
            border-radius: 0;
            overflow: hidden;
            transition: all 0.4s ease;
            text-decoration: none;
            color: inherit;
            box-shadow: none;
            position: relative;
        }

        .category-card:hover {
            box-shadow: 0 20px 50px rgba(0,0,0,0.15);
            transform: translateY(-10px);
        }

        .category-image {
            width: 100%;
            height: 220px;
            object-fit: cover;
            background-color: #f5f5f5;
        }

        .category-name {
            padding: 25px;
            font-weight: 700;
            font-size: 1.1rem;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 1px;
            background-color: #f9f9f9;
        }

        /* FOOTER */
        .footer {
            background-color: #000;
            color: #ccc;
            padding: 70px 0 40px;
            margin-top: 100px;
            border-top: 1px solid #222;
        }

        .footer h5 {
            color: #fff;
            margin-bottom: 25px;
            font-weight: 700;
            font-size: 1rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .footer p {
            font-size: 0.9rem;
            line-height: 1.8;
            color: #999;
        }

        .footer a {
            color: #ccc;
            text-decoration: none;
            transition: color 0.3s;
            font-size: 0.9rem;
        }

        .footer a:hover {
            color: #fff;
        }

        .footer ul {
            list-style: none;
            padding: 0;
        }

        .footer ul li {
            margin-bottom: 12px;
        }

        .social-links {
            margin-top: 20px;
            display: flex;
            gap: 15px;
        }

        .social-links a {
            display: inline-flex;
            width: 45px;
            height: 45px;
            background-color: transparent;
            border: 2px solid #333;
            border-radius: 0;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            color: #ccc;
            font-size: 1.1rem;
        }

        .social-links a:hover {
            background-color: #fff;
            border-color: #fff;
            color: #000;
        }

        .footer-bottom {
            padding-top: 30px;
            border-top: 1px solid #222;
            margin-top: 40px;
            text-align: center;
            color: #666;
            font-size: 0.85rem;
        }

        /* ALERTS */
        .alert {
            border-radius: 0;
            margin: 20px 0;
            border: 1px solid #ddd;
        }

        .alert-danger {
            background-color: #fff5f5;
            border-color: #ff6b6b;
            color: #c92a2a;
        }

        .alert-success {
            background-color: #f0fdf4;
            border-color: #22c55e;
            color: #166534;
        }

        .alert-info {
            background-color: #f0f9ff;
            border-color: #0284c7;
            color: #0c4a6e;
        }

        /* CART SUMMARY */
        .cart-summary {
            background-color: #f5f5f5;
            padding: 30px;
            border-radius: 0;
            border: 1px solid #ddd;
            box-shadow: none;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.2rem;
                letter-spacing: 2px;
            }

            .hero p {
                font-size: 0.95rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            .navbar .nav-link {
                margin: 8px 0;
                font-size: 0.8rem;
            }

            .product-name {
                font-size: 0.9rem;
            }

            .btn-hero {
                padding: 12px 35px;
                font-size: 0.8rem;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid px-4">
            <a class="navbar-brand" href="{{ route('home') }}">
                CONQUEROR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" style="border-color: #fff; background-color: #1a1a1a;">
                <span class="navbar-toggler-icon" style="background-image: url(&quot;data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255, 255, 255, 0.55)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e&quot;);"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">NEW ARRIVALS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('products.index') }}">PRODUCTS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">CONTACT</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <span class="cart-icon" id="cartIcon">
                                <i class="bi bi-bag-fill"></i>
                                <span class="cart-count" id="cartCount">0</span>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if($errors->any())
        <div class="container mt-4">
            <div class="alert alert-danger">
                <strong>Error!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if(session('success'))
        <div class="container mt-4">
            <div class="alert alert-success">
                <strong>Success!</strong> {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="container mt-4">
            <div class="alert alert-danger">
                <strong>Error!</strong> {{ session('error') }}
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>CONQUEROR</h5>
                    <p>Premium streetwear designed for confidence. Built tough, worn bold.</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>QUICK LINKS</h5>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('products.index') }}">Products</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>CONTACT</h5>
                    @if($settings->phone_number)
                        <p><i class="bi bi-telephone"></i> <a href="tel:{{ $settings->phone_number }}">{{ $settings->phone_number }}</a></p>
                    @endif
                    @if($settings->email)
                        <p><i class="bi bi-envelope"></i> <a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></p>
                    @endif
                    @if($settings->address)
                        <p><i class="bi bi-geo-alt"></i> {{ $settings->address }}</p>
                    @endif
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5>FOLLOW</h5>
                    <div class="social-links">
                        @if($settings->facebook_url)
                            <a href="{{ $settings->facebook_url }}" target="_blank" title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                        @endif
                        @if($settings->instagram_url)
                            <a href="{{ $settings->instagram_url }}" target="_blank" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                        @endif
                        @if($settings->tiktok_url)
                            <a href="{{ $settings->tiktok_url }}" target="_blank" title="TikTok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; 2024 CONQUEROR. All Rights Reserved. Built for Confidence.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Update cart count
        function updateCartCount() {
            const cart = localStorage.getItem('cart');
            const cartItems = cart ? JSON.parse(cart) : {};
            const count = Object.keys(cartItems).length;
            document.getElementById('cartCount').textContent = count;
        }

        // Initialize cart count on page load
        updateCartCount();

        // Listen for cart updates
        window.addEventListener('storage', updateCartCount);
    </script>
    @yield('scripts')
</body>
</html>
