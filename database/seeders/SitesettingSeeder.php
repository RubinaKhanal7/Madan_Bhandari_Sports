<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SitesettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_settings')->insert([
            'title_ne' => '',
            'title_en' => 'Official Station',
            'slogan_ne' => '', 
            'slogan_en' => 'Serving your needs with dedication',
            'main_logo' => 'uploads/sitesetting/main_logo.png',
            'alt_logo' => 'uploads/sitesetting/alt_logo.png',
            'phone_no' => json_encode(['+977-9851071224', '+971-56-8348300']),
            'email' => json_encode(['info@bpwagle.com', 'support@bpwagle.com']),
            'established_year' => '2020',
            'description_ne' => '',
            'description_en' => 'This is a dedicated station for providing excellent services.',
            'socialmedia' => '1', 
            'google_map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.5838728332933!2d85.3486855148711!3d27.699253482795278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb1bdfeb28a41f%3A0xf0e4c10a1694fa53!2sAasha%20Tech!5e0!3m2!1sen!2snp!4v1674808462785!5m2!1sen!2snp',
            'is_active' => true,
        ]);
    }
}
