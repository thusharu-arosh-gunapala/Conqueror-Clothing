<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Category;
use App\Models\Product;
use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::query()->where('is_featured', true)
            ->where('status', true)
            ->with('category', 'images')
            ->take(12)
            ->get();

        $categories = Category::query()->where('status', true)->get();
        $settings = WebsiteSetting::getSetting();
        $hero_images = is_array($settings->hero_images) ? $settings->hero_images : [];

        if (empty($hero_images)) {
            try {
                $hero_images = array_map(
                    fn ($file) => public_storage_url($file),
                    array_slice(Storage::disk('public')->files('hero'), 0, 9)
                );
            } catch (\Throwable $e) {
                $hero_images = [];
            }
        } else {
            $hero_images = array_map(function ($path) {
                return str_starts_with($path, 'http') ? $path : asset('storage/' . $path);
            }, array_slice($hero_images, 0, 9));
        }

        return view('frontend.home', compact('featuredProducts', 'categories', 'settings', 'hero_images'));
    }

    public function about()
    {
        $settings = WebsiteSetting::getSetting();
        return view('frontend.about', compact('settings'));
    }

    public function contact()
    {
        $settings = WebsiteSetting::getSetting();
        return view('frontend.contact', compact('settings'));
    }
}
