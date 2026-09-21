<?php

namespace App\Http\Controllers\Admin;

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function edit()
    {
        $settings = WebsiteSetting::getSetting();
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'business_name' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:20',
            'admin_whatsapp_number' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'tiktok_url' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'hero_images' => 'nullable|array|max:9',
            'hero_images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'hero_style' => 'nullable|in:layered,stack,grid,float',
            'hero_animation' => 'nullable|in:smooth,subtle,dramatic',
            'cod_message' => 'nullable|string',
            'delivery_information' => 'nullable|string',
            'about_us' => 'nullable|string',
            'footer_text' => 'nullable|string',
        ]);

        $settings = WebsiteSetting::getSetting();

        $settings->business_name = $request->business_name;
        $settings->phone_number = $request->phone_number;
        $settings->admin_whatsapp_number = $request->admin_whatsapp_number;
        $settings->email = $request->email;
        $settings->address = $request->address;
        $settings->facebook_url = $request->facebook_url;
        $settings->instagram_url = $request->instagram_url;
        $settings->tiktok_url = $request->tiktok_url;
        $settings->cod_message = $request->cod_message;
        $settings->delivery_information = $request->delivery_information;
        $settings->about_us = $request->about_us;
        $settings->footer_text = $request->footer_text;
        $settings->hero_style = $request->hero_style ?: 'layered';
        $settings->hero_animation = $request->hero_animation ?: 'smooth';

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('settings', 'public');
            $settings->logo = $path;
        }

        if ($request->hasFile('hero_images')) {
            $heroImages = [];
            foreach ($request->file('hero_images') as $heroImage) {
                $heroImages[] = $heroImage->store('hero', 'public');
            }
            $settings->hero_images = $heroImages;
        }

        $settings->save();

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully');
    }
}
