@extends('frontend.layouts.app')

@section('title', 'CONQUEROR - Premium Streetwear')

@section('content')
 @php
    $hero_images = [];

    foreach (
        array_slice(
            \Illuminate\Support\Facades\Storage::disk('public')->files('hero'),
            0,
            9
        ) as $file
    ) {
        $hero_images[] = asset('storage/app/public/' . $file);
    }

    $hero_style = $settings->hero_style ?? 'layered';
    $hero_animation = $settings->hero_animation ?? 'smooth';
@endphp

    <!-- Hero Section -->
    <section class="hero hero-{{ $hero_style }} hero-{{ $hero_animation }}" id="conquerorHero">
        <div class="hero-backdrop"></div>
        <div class="hero-copy">
            <h1>CONQUEROR</h1>
            <h3>CONQUER YOUR STYLE</h3>
            <p>Premium streetwear built for confidence.</p>
            <a href="{{ route('products.index') }}" class="btn-hero">SHOP NOW</a>
        </div>

        <div class="hero-gallery">
            @foreach($hero_images as $index => $image)
                <div class="hero-photo hero-photo-{{ $index + 1 }}" data-depth="{{ 0.05 + ($index * 0.01) }}">
                    <img src="{{ $image }}" alt="CONQUEROR hero image {{ $index + 1 }}" loading="lazy" decoding="async">
                </div>
            @endforeach
        </div>
    </section>

    <style>
        .hero{position:relative; min-height:90vh; overflow:hidden; background:linear-gradient(180deg,#fff 0%,#f5f5f5 100%); color:#000; display:flex; align-items:center; justify-content:center; text-align:center;}
        .hero-backdrop{position:absolute; inset:0; background-image:radial-gradient(rgba(0,0,0,0.03) 1px, transparent 1px); background-size:18px 18px; opacity:.35; pointer-events:none;}
        .hero-copy{position:relative; z-index:3; max-width:760px; padding:120px 20px 80px;}
        .hero-copy h1{font-size:clamp(2.5rem, 6vw, 4.5rem); font-weight:900; letter-spacing:.18em; margin-bottom:.2rem; text-transform:uppercase; color:#000;}
        .hero-copy h3{font-size:clamp(1.1rem, 2.5vw, 1.6rem); font-weight:800; letter-spacing:.18em; margin-bottom:1rem; text-transform:uppercase; color:#333;}
        .hero-copy p{font-size:1.05rem; color:#555; letter-spacing:.04em; margin-bottom:1.8rem;}
        .btn-hero{display:inline-block; padding:14px 20px; background:#000; color:#fff; border:2px solid #000; text-decoration:none; font-weight:800; letter-spacing:.16em; text-transform:uppercase; transition:all .3s ease;}
        .btn-hero:hover{background:transparent; color:#000; border:2px solid #000;}
        .hero-gallery{position:absolute; inset:0; z-index:2; pointer-events:none;}
        .hero-photo{position:absolute; width:clamp(140px, 16vw, 250px); aspect-ratio: 4 / 5; overflow:hidden; border-radius:16px; border:1px solid rgba(0,0,0,.12); box-shadow:0 18px 50px rgba(0,0,0,.12); opacity:0; transform:translateY(18px) scale(.98); transition:transform .35s ease, box-shadow .35s ease, opacity .35s ease;}
        .hero-photo img{width:100%; height:100%; object-fit:cover; display:block; transition:transform .6s ease;}
        .hero-photo:hover{transform:translateY(-10px) scale(1.02) rotate(.5deg); box-shadow:0 28px 70px rgba(0,0,0,.18);}
        .hero-photo:hover img{transform:scale(1.06);}
        .hero-layered .hero-photo:nth-child(1){left:3%; top:10%;}
        .hero-layered .hero-photo:nth-child(2){left:7%; top:42%; width:clamp(120px, 13vw, 205px);}
        .hero-layered .hero-photo:nth-child(3){left:24%; bottom:6%; width:clamp(130px, 14vw, 210px);}
        .hero-layered .hero-photo:nth-child(4){left:40%; bottom:0; width:clamp(120px, 12vw, 190px);}
        .hero-layered .hero-photo:nth-child(5){left:56%; bottom:6%; width:clamp(130px, 14vw, 210px);}
        .hero-layered .hero-photo:nth-child(6){right:40%; bottom:0; width:clamp(120px, 12vw, 190px);}
        .hero-layered .hero-photo:nth-child(7){right:24%; bottom:6%; width:clamp(130px, 14vw, 210px);}
        .hero-layered .hero-photo:nth-child(8){right:7%; top:42%; width:clamp(120px, 13vw, 205px);}
        .hero-layered .hero-photo:nth-child(9){right:3%; top:10%;}
        .hero-grid .hero-gallery{display:grid; grid-template-columns:repeat(3, 1fr); gap:16px; padding:110px 4vw 40px; align-items:end;}
        .hero-grid .hero-photo{position:relative; inset:auto; width:100%; opacity:1; transform:none;}
        .hero-stack .hero-gallery{display:flex; align-items:flex-end; justify-content:center; gap:14px; padding:120px 4vw 30px;}
        .hero-stack .hero-photo{position:relative; inset:auto; opacity:1; transform:none; width:clamp(120px, 12vw, 180px);}
        .hero-float .hero-photo{animation:heroFloat 8s ease-in-out infinite;}
        .hero-subtle .hero-photo{animation-duration:12s;}
        .hero-dramatic .hero-photo{animation-duration:5.5s;}
        @keyframes heroFloat{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}
        @media (max-width:992px){.hero-copy{padding-top:110px}.hero-layered .hero-photo:nth-child(n){opacity:0;} .hero-layered .hero-photo:nth-child(1),.hero-layered .hero-photo:nth-child(3),.hero-layered .hero-photo:nth-child(5),.hero-layered .hero-photo:nth-child(7),.hero-layered .hero-photo:nth-child(9){opacity:1;}}
        @media (max-width:768px){.hero{min-height:72vh}.hero-copy{padding-top:90px}.hero-copy h1{letter-spacing:.12em}.hero-photo{display:none}.hero-grid .hero-photo,.hero-stack .hero-photo{display:none}.hero-layered .hero-photo:nth-child(1),.hero-layered .hero-photo:nth-child(5),.hero-layered .hero-photo:nth-child(9){display:block; width:120px; height:150px; top:auto; bottom:6%; opacity:1;}}
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hero = document.getElementById('conquerorHero');
            const photos = Array.from(hero.querySelectorAll('.hero-photo'));
            const touch = ('ontouchstart' in window) || navigator.maxTouchPoints > 0;

            hero.querySelector('.hero-copy h1').animate([{opacity:0, transform:'scale(.96)'}, {opacity:1, transform:'scale(1)'}], {duration:700, easing:'ease-out', fill:'forwards'});
            hero.querySelector('.hero-copy h3').animate([{opacity:0, transform:'translateY(12px)'}, {opacity:1, transform:'translateY(0)'}], {duration:700, delay:150, easing:'ease-out', fill:'forwards'});
            hero.querySelector('.hero-copy p').animate([{opacity:0, transform:'translateY(14px)'}, {opacity:1, transform:'translateY(0)'}], {duration:700, delay:300, easing:'ease-out', fill:'forwards'});
            hero.querySelector('.btn-hero').animate([{opacity:0, transform:'translateY(16px)'}, {opacity:1, transform:'translateY(0)'}], {duration:700, delay:450, easing:'ease-out', fill:'forwards'});

            photos.forEach((photo, index) => {
                photo.animate([{opacity:0, transform:'translateY(20px) scale(.97)'}, {opacity:1, transform:'translateY(0) scale(1)'}], {duration:700, delay:500 + (index * 120), easing:'ease-out', fill:'forwards'});
            });

            if (!touch && hero.classList.contains('hero-layered')) {
                hero.addEventListener('mousemove', function (e) {
                    const rect = hero.getBoundingClientRect();
                    const dx = (e.clientX - rect.left - rect.width / 2) / rect.width;
                    const dy = (e.clientY - rect.top - rect.height / 2) / rect.height;
                    photos.forEach(photo => {
                        const depth = parseFloat(photo.dataset.depth || '0.08');
                        photo.style.transform = `translate3d(${dx * depth * -35}px, ${dy * depth * -35}px, 0)`;
                    });
                });
                hero.addEventListener('mouseleave', function () {
                    photos.forEach(photo => photo.style.transform = 'translate3d(0,0,0)');
                });
            }
        });
    </script>

    <div class="container">
        <!-- Featured Categories -->
        @if(count($categories) > 0)
            <section style="padding: 80px 0; border-bottom: 1px solid #eee;">
                <div style="text-align: center; margin-bottom: 60px;">
                    <h2 style="font-size: 2.5rem; font-weight: 900; letter-spacing: 2px; text-transform: uppercase; margin: 0;">SHOP BY CATEGORY</h2>
                </div>
                <div class="row g-4">
                    @foreach($categories->take(6) as $category)
                        <div class="col-md-4 col-lg-2">
                            <a href="{{ route('categories.show', $category->slug) }}" class="category-card">
                                @if($category->image)
                                   <img src="{{ asset('storage/app/public/' . $category->image) }}" alt="{{ $category->name }}" class="category-image">
                                @else
                                    <div class="category-image" style="background-color: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                                        <i class="bi bi-tag" style="font-size: 2.5rem; color: #ddd;"></i>
                                    </div>
                                @endif
                                <div class="category-name">{{ $category->name }}</div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Featured Products -->
        @if(count($featuredProducts) > 0)
            <section style="padding: 80px 0;">
                <div style="text-align: center; margin-bottom: 60px;">
                    <h2 style="font-size: 2.5rem; font-weight: 900; letter-spacing: 2px; text-transform: uppercase; margin: 0;">NEW ARRIVALS</h2>
                </div>
                <div class="row g-4">
                    @foreach($featuredProducts as $product)
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="product-card">
                                <div class="product-image-wrapper">
                                    @if($product->main_image)
                                        <img src="{{ asset('storage/app/public/' . $product->main_image) }}" alt="{{ $product->name }}" class="product-image">
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
                                    <div class="product-price">
                                        @if($product->discount_price)
                                            <span class="discount">{{ currency_lkr($product->price) }}</span>
                                            {{ currency_lkr($product->discount_price) }}
                                        @else
                                            {{ currency_lkr($product->price) }}
                                        @endif
                                    </div>
                                    <a href="{{ route('products.show', $product->slug) }}" class="btn-add-cart" style="display: block; text-decoration: none;">VIEW PRODUCT</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- About Preview -->
        <section style="padding: 100px 0; text-align: center;">
            <div style="max-width: 700px; margin: 0 auto;">
                <h2 style="font-size: 2.2rem; font-weight: 900; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 30px;">ABOUT CONQUEROR</h2>
                <p style="font-size: 1.1rem; line-height: 1.8; color: #555; margin-bottom: 30px;">
                    {{ $settings->about_us ?? 'Premium streetwear designed for those who refuse to compromise. We create clothing that inspires confidence and commands respect.' }}
                </p>
                <a href="{{ route('about') }}" style="background-color: #000; color: #fff; border: 2px solid #000; padding: 15px 50px; font-weight: 800; font-size: 0.9rem; letter-spacing: 2px; text-transform: uppercase; cursor: pointer; display: inline-block; text-decoration: none; transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#fff'; this.style.color='#000';" onmouseout="this.style.backgroundColor='#000'; this.style.color='#fff';">LEARN MORE</a>
            </div>
        </section>
    </div>
@endsection
