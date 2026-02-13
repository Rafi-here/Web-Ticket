<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        $settings = [
            // General
            ['key' => 'site_name', 'value' => 'TIX', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_description', 'value' => 'Platform pemesanan tiket bioskop modern', 'type' => 'text', 'group' => 'general'],
            ['key' => 'logo_type', 'value' => 'text', 'type' => 'text', 'group' => 'general'],
            ['key' => 'logo_text', 'value' => 'TIX', 'type' => 'text', 'group' => 'general'],
            ['key' => 'logo_image', 'value' => null, 'type' => 'image', 'group' => 'general'],
            ['key' => 'favicon', 'value' => null, 'type' => 'image', 'group' => 'general'],

            // Theme
            ['key' => 'theme_color', 'value' => '#3b82f6', 'type' => 'text', 'group' => 'theme'],
            ['key' => 'default_theme', 'value' => 'light', 'type' => 'text', 'group' => 'theme'],

            // Contact
            ['key' => 'contact_email', 'value' => 'support@tix.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_phone', 'value' => '021-12345678', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'address', 'value' => 'Jakarta, Indonesia', 'type' => 'text', 'group' => 'contact'],

            // Social Media
            ['key' => 'facebook_url', 'value' => 'https://facebook.com/tix', 'type' => 'text', 'group' => 'social'],
            ['key' => 'instagram_url', 'value' => 'https://instagram.com/tix', 'type' => 'text', 'group' => 'social'],
            ['key' => 'twitter_url', 'value' => 'https://twitter.com/tix', 'type' => 'text', 'group' => 'social'],

            // System
            ['key' => 'maintenance_mode', 'value' => 'false', 'type' => 'boolean', 'group' => 'system'],
            ['key' => 'ticket_expiry_hours', 'value' => '12', 'type' => 'integer', 'group' => 'system'],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['key' => 'site_name'],
                [
                    'value' => 'TIX',
                    'type' => 'text',
                ]
            );
        }
    }
}
