<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('socialmedia')->insert([
            'facebook_link' => 'https://facebook.com/example',
            'instagram_link' => 'https://instagram.com/example',
            'snapchat_link' => 'https://snapchat.com/add/example',
            'linkedin_link' => 'https://linkedin.com/in/example',
            'tiktok_link' => 'https://tiktok.com/@example',
            'youtube_link' => 'https://youtube.com/channel/example',
            'twitter_link' => 'https://twitter.com/example',
            'embed_fbpage' => '<iframe src="https://www.facebook.com/plugins/page.php?href=https://facebook.com/example"></iframe>',
            
        ]);
    }
}
