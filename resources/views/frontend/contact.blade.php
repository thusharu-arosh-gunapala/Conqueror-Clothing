@extends('frontend.layouts.app')

@section('title', 'Contact Us - Conqueror Clothing')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4">Contact Us</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Get in Touch</h5>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" placeholder="Enter your name">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter your email">
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" placeholder="Enter subject">
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Contact Information</h5>
                    </div>
                    <div class="card-body">
                        @if($settings->phone_number)
                            <div class="mb-3">
                                <h6><i class="bi bi-telephone"></i> Phone</h6>
                                <p><a href="tel:{{ $settings->phone_number }}">{{ $settings->phone_number }}</a></p>
                            </div>
                        @endif

                        @if($settings->email)
                            <div class="mb-3">
                                <h6><i class="bi bi-envelope"></i> Email</h6>
                                <p><a href="mailto:{{ $settings->email }}">{{ $settings->email }}</a></p>
                            </div>
                        @endif

                        @if($settings->address)
                            <div class="mb-3">
                                <h6><i class="bi bi-geo-alt"></i> Address</h6>
                                <p>{{ $settings->address }}</p>
                            </div>
                        @endif

                        <hr>

                        <h6>Follow Us</h6>
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

                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-whatsapp"></i> WhatsApp</h5>
                    </div>
                    <div class="card-body text-center">
                        @if($settings->phone_number)
                            <p>Contact us via WhatsApp for quick responses!</p>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $settings->phone_number) }}" target="_blank" class="btn btn-success">
                                <i class="bi bi-whatsapp"></i> Chat with us
                            </a>
                        @else
                            <p>WhatsApp contact not configured</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
