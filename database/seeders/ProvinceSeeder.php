<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::create(['title' => 'काेशी प्रदेश', 'is_active' => true]);
        Province::create(['title' => 'मधेश प्रदेश', 'is_active' => true]);
        Province::create(['title' => 'बाग्मती प्रदेश', 'is_active' => true]);
        Province::create(['title' => 'गण्डकी प्रदेश', 'is_active' => true]);
        Province::create(['title' => 'लुम्बिनी प्रदेश', 'is_active' => true]);
        Province::create(['title' => 'कर्णाली प्रदेश', 'is_active' => true]);
        Province::create(['title' => 'सुदुरपश्चिम प्रदेश', 'is_active' => true]);
    }
}
