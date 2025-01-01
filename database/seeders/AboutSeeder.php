<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'title' => 'Introduction',
            'slug' => 'introduction',
            'subtitle' => 'Who am I?',
            'image' => '1708111815-Lunar Oversea - Landscape.png',
            'description' => 'I am BP Wagle, a musician, composer, and singer, passionate about creating melodies that resonate with the soul. Music is my language, and through my compositions and performances, I aim to connect with people on a deep emotional level. ',
            'content' => 'I am BP Wagle, a musician, composer, and singer, passionate about creating melodies that resonate with the soul. Music is my language, and through my compositions and performances, I aim to connect with people on a deep emotional level. Whether it is crafting intricate harmonies or delivering heartfelt vocals, I am dedicated to pushing the boundaries of musical expression and sharing my art with the world. My journey as a musician is fueled by a love for creativity and a desire to inspire others through the power of sound.',


        ]);
        // About::factory()->count(1)->create();
    }
}
