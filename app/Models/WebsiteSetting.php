<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'business_name',
        'logo',
        'phone_number',
        'admin_whatsapp_number',
        'email',
        'address',
        'facebook_url',
        'instagram_url',
        'tiktok_url',
        'cod_message',
        'delivery_information',
        'about_us',
        'footer_text',
        'hero_images',
        'hero_style',
        'hero_animation',
    ];

    protected $casts = [
        'hero_images' => 'array',
    ];

    public static function getSetting($key = null)
    {
        $setting = self::query()->first();

        if (!$setting) {
            $setting = self::create();
        }

        if ($key) {
            return $setting->$key ?? null;
        }

        return $setting;
    }
}
