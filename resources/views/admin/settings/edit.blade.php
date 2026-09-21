@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Website Settings</h2>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Business Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="business_name" class="form-label">Business Name</label>
                            <input type="text" class="form-control @error('business_name') is-invalid @enderror" 
                                   id="business_name" name="business_name" 
                                   value="{{ old('business_name', $settings->business_name ?? '') }}">
                            @error('business_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="logo" class="form-label">Logo</label>
                            
                            @if($settings && $settings->logo)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $settings->logo) }}" 
                                         alt="Logo" 
                                         style="max-width: 200px; max-height: 100px;">
                                    <div>
                                        <small class="text-muted">Current Logo</small>
                                    </div>
                                </div>
                            @endif

                            <input type="file" class="form-control @error('logo') is-invalid @enderror" 
                                   id="logo" name="logo" accept="image/jpeg,image/png,image/jpg">
                            <small class="text-muted">JPG, PNG (Max: 2MB)</small>
                            @error('logo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                   id="email" name="email" 
                                   value="{{ old('email', $settings->email ?? '') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" 
                                   id="phone_number" name="phone_number" 
                                   value="{{ old('phone_number', $settings->phone_number ?? '') }}"
                                   placeholder="+92-300-000-0000">
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="admin_whatsapp_number" class="form-label">Admin WhatsApp Number</label>
                            <input type="text" class="form-control @error('admin_whatsapp_number') is-invalid @enderror" 
                                   id="admin_whatsapp_number" name="admin_whatsapp_number" 
                                   value="{{ old('admin_whatsapp_number', $settings->admin_whatsapp_number ?? '') }}"
                                   placeholder="92300000000">
                            <small class="text-muted">Format: Country code + number (no spaces or +)</small>
                            @error('admin_whatsapp_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                      id="address" name="address" rows="2">{{ old('address', $settings->address ?? '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Social Media</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="facebook_url" class="form-label">Facebook URL</label>
                            <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" 
                                   id="facebook_url" name="facebook_url" 
                                   value="{{ old('facebook_url', $settings->facebook_url ?? '') }}"
                                   placeholder="https://facebook.com/...">
                            @error('facebook_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="instagram_url" class="form-label">Instagram URL</label>
                            <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" 
                                   id="instagram_url" name="instagram_url" 
                                   value="{{ old('instagram_url', $settings->instagram_url ?? '') }}"
                                   placeholder="https://instagram.com/...">
                            @error('instagram_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="tiktok_url" class="form-label">TikTok URL</label>
                            <input type="url" class="form-control @error('tiktok_url') is-invalid @enderror" 
                                   id="tiktok_url" name="tiktok_url" 
                                   value="{{ old('tiktok_url', $settings->tiktok_url ?? '') }}"
                                   placeholder="https://tiktok.com/@...">
                            @error('tiktok_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card mb-3">
                    <div class="card-header">
                        <h5 class="mb-0">Website Content</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="hero_style" class="form-label">Hero Style</label>
                                <select class="form-select @error('hero_style') is-invalid @enderror" id="hero_style" name="hero_style">
                                    <option value="layered" {{ old('hero_style', $settings->hero_style ?? 'layered') === 'layered' ? 'selected' : '' }}>Layered Floating</option>
                                    <option value="float" {{ old('hero_style', $settings->hero_style ?? '') === 'float' ? 'selected' : '' }}>Floating Showcase</option>
                                    <option value="stack" {{ old('hero_style', $settings->hero_style ?? '') === 'stack' ? 'selected' : '' }}>Stacked Lookbook</option>
                                    <option value="grid" {{ old('hero_style', $settings->hero_style ?? '') === 'grid' ? 'selected' : '' }}>Clean Grid</option>
                                </select>
                                @error('hero_style')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="hero_animation" class="form-label">Hero Animation</label>
                                <select class="form-select @error('hero_animation') is-invalid @enderror" id="hero_animation" name="hero_animation">
                                    <option value="smooth" {{ old('hero_animation', $settings->hero_animation ?? 'smooth') === 'smooth' ? 'selected' : '' }}>Smooth</option>
                                    <option value="subtle" {{ old('hero_animation', $settings->hero_animation ?? '') === 'subtle' ? 'selected' : '' }}>Subtle</option>
                                    <option value="dramatic" {{ old('hero_animation', $settings->hero_animation ?? '') === 'dramatic' ? 'selected' : '' }}>Dramatic</option>
                                </select>
                                @error('hero_animation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="hero_images" class="form-label">Hero Showcase Images</label>
                            @php
                                $heroImages = is_array($settings->hero_images ?? null) ? $settings->hero_images : [];
                            @endphp
                            @if(!empty($heroImages))
                                <div class="row g-2 mb-3">
                                    @foreach($heroImages as $heroImage)
                                        <div class="col-6 col-md-4 col-lg-3">
                                            <img src="{{ asset('storage/' . $heroImage) }}" alt="Hero image" class="img-fluid border" style="height: 120px; width: 100%; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <input type="file" class="form-control @error('hero_images') is-invalid @enderror" id="hero_images" name="hero_images[]" accept="image/jpeg,image/png,image/jpg,image/webp" multiple>
                            <small class="text-muted">Upload up to 9 images for the homepage hero. Leave empty to keep current images.</small>
                            @error('hero_images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="cod_message" class="form-label">Cash on Delivery Message</label>
                            <textarea class="form-control @error('cod_message') is-invalid @enderror" 
                                      id="cod_message" name="cod_message" rows="2">{{ old('cod_message', $settings->cod_message ?? '') }}</textarea>
                            <small class="text-muted">Shown during checkout</small>
                            @error('cod_message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="delivery_information" class="form-label">Delivery Information</label>
                            <textarea class="form-control @error('delivery_information') is-invalid @enderror" 
                                      id="delivery_information" name="delivery_information" rows="2">{{ old('delivery_information', $settings->delivery_information ?? '') }}</textarea>
                            <small class="text-muted">Delivery terms and conditions</small>
                            @error('delivery_information')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="about_us" class="form-label">About Us</label>
                            <textarea class="form-control @error('about_us') is-invalid @enderror" 
                                      id="about_us" name="about_us" rows="3">{{ old('about_us', $settings->about_us ?? '') }}</textarea>
                            <small class="text-muted">Shown on About page</small>
                            @error('about_us')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="footer_text" class="form-label">Footer Text</label>
                            <textarea class="form-control @error('footer_text') is-invalid @enderror" 
                                      id="footer_text" name="footer_text" rows="2">{{ old('footer_text', $settings->footer_text ?? '') }}</textarea>
                            <small class="text-muted">Displayed in website footer</small>
                            @error('footer_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Save Settings</button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Information</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            <strong>WhatsApp Format:</strong><br>
                            <code>92300123456</code>
                        </p>
                        <p class="mb-2">
                            <strong>Email Format:</strong><br>
                            <code>info@example.com</code>
                        </p>
                        <p class="mb-0">
                            <strong>Social URLs:</strong><br>
                            Use full URLs with https://
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
