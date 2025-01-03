<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Favicon;

class FaviconSeeder extends Seeder
{
    public function run()
    {
        Favicon::create([
            'fav_16' => 'favicon_16x16.png',
            'fav_32' => 'favicon_32x32.png',
            'fav_ico' => 'favicon.ico',
            'fav_apple' => 'favicon_apple.png',
            'fav_192' => 'favicon_192x192.png',
            'fav_512' => 'favicon_512x512.png',
            'site_manifest' => 'https://example.com/manifest.json',
            'is_active' => true,
        ]);
    }
}
