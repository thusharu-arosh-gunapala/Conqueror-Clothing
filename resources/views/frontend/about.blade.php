@extends('frontend.layouts.app')

@section('title', 'About Us - CONQUEROR Clothing')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">About CONQUEROR Clothing</h1>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5>Our Story</h5>
                        <p>{{ $settings->about_us ?? 'At CONQUEROR Clothing, we believe that fashion is for everyone. We are committed to providing high-quality, stylish, and affordable clothing for all occasions.' }}</p>

                        <hr>

                        <h5>Why Choose Us?</h5>
                        <ul>
                            <li>High-quality products</li>
                            <li>Affordable prices</li>
                            <li>Wide variety of styles</li>
                            <li>Fast and reliable delivery</li>
                            <li>Excellent customer service</li>
                            <li>Easy returns and exchanges</li>
                        </ul>

                        <hr>

                        <h5>Contact Information</h5>
                        <div>
                            @if($settings->phone_number)
                                <p><i class="bi bi-telephone"></i> <strong>Phone:</strong> {{ $settings->phone_number }}</p>
                            @endif
                            @if($settings->email)
                                <p><i class="bi bi-envelope"></i> <strong>Email:</strong> {{ $settings->email }}</p>
                            @endif
                            @if($settings->address)
                                <p><i class="bi bi-geo-alt"></i> <strong>Address:</strong> {{ $settings->address }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-bag-check" style="font-size: 3rem; color: #667eea; margin-bottom: 20px;"></i>
                        <h5>Quality Guaranteed</h5>
                        <p>All our products are carefully selected and quality-checked</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body text-center">
                        <i class="bi bi-truck" style="font-size: 3rem; color: #667eea; margin-bottom: 20px;"></i>
                        <h5>Fast Delivery</h5>
                        <p>Quick and reliable delivery to your doorstep</p>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body text-center">
                        <i class="bi bi-headset" style="font-size: 3rem; color: #667eea; margin-bottom: 20px;"></i>
                        <h5>24/7 Support</h5>
                        <p>We're here to help anytime you need us</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
