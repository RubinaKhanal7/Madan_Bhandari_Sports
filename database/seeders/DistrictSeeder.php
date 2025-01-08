<?php

namespace Database\Seeders;

use App\Models\District;
use Illuminate\Database\Seeder;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Koshi Province (province_id = 1)
        District::create(['title' => 'भाेजपुर', 'province_id' => 1]);
        District::create(['title' => 'धनकुटा', 'province_id' => 1]);
        District::create(['title' => 'इलाम', 'province_id' => 1]);
        District::create(['title' => 'झापा', 'province_id' => 1]);
        District::create(['title' => 'खोटाङ', 'province_id' => 1]);
        District::create(['title' => 'माेरङ', 'province_id' => 1]);
        District::create(['title' => 'ओखलढुंगा', 'province_id' => 1]);
        District::create(['title' => 'पांचथर', 'province_id' => 1]);
        District::create(['title' => 'संखुवासभा', 'province_id' => 1]);
        District::create(['title' => 'सोलुखुम्बु', 'province_id' => 1]);
        District::create(['title' => 'सुनसरी', 'province_id' => 1]);
        District::create(['title' => 'ताप्लेजुंग', 'province_id' => 1]);
        District::create(['title' => 'तेह्रथुम', 'province_id' => 1]);
        District::create(['title' => 'उदयपुर', 'province_id' => 1]);

        // Madhesh Province (province_id = 2)
        District::create(['title' => 'पर्सा', 'province_id' => 2]);
        District::create(['title' => 'बारा', 'province_id' => 2]);
        District::create(['title' => 'रौतहट', 'province_id' => 2]);
        District::create(['title' => 'सर्लाही', 'province_id' => 2]);
        District::create(['title' => 'धनुषा', 'province_id' => 2]);
        District::create(['title' => 'सिराहा', 'province_id' => 2]);
        District::create(['title' => 'महोत्तरी', 'province_id' => 2]);
        District::create(['title' => 'सप्तरी', 'province_id' => 2]);

        // Bagmati Province (province_id = 3)
        District::create(['title' => 'सिन्धुली', 'province_id' => 3]);
        District::create(['title' => 'रामेछाप', 'province_id' => 3]);
        District::create(['title' => 'दोलखा', 'province_id' => 3]);
        District::create(['title' => 'भक्तपुर', 'province_id' => 3]);
        District::create(['title' => 'धादिङ्ग', 'province_id' => 3]);
        District::create(['title' => 'काठमाडौँ', 'province_id' => 3]);
        District::create(['title' => 'काभ्रेपलान्चोक', 'province_id' => 3]);
        District::create(['title' => 'ललितपुर', 'province_id' => 3]);
        District::create(['title' => 'नुवाकोट', 'province_id' => 3]);
        District::create(['title' => 'रसुवा', 'province_id' => 3]);
        District::create(['title' => 'सिन्धुपाल्चोक', 'province_id' => 3]);
        District::create(['title' => 'चितवन', 'province_id' => 3]);
        District::create(['title' => 'मकवानपुर', 'province_id' => 3]);

        // Gandaki Province (province_id = 4)
        District::create(['title' => 'बाग्लुङ्ग', 'province_id' => 4]);
        District::create(['title' => 'गोरखा', 'province_id' => 4]);
        District::create(['title' => 'कास्की', 'province_id' => 4]);
        District::create(['title' => 'लम्जुङ्ग', 'province_id' => 4]);
        District::create(['title' => 'मनाङ्ग', 'province_id' => 4]);
        District::create(['title' => 'मुस्तांग', 'province_id' => 4]);
        District::create(['title' => 'म्याग्दी', 'province_id' => 4]);
        District::create(['title' => 'नवलपुर', 'province_id' => 4]);
        District::create(['title' => 'पर्वत', 'province_id' => 4]);
        District::create(['title' => 'स्याङ्गजा', 'province_id' => 4]);
        District::create(['title' => 'तनहूँ', 'province_id' => 4]);

        // Lumbini Province (province_id = 5)
        District::create(['title' => 'कपिलवस्तु', 'province_id' => 5]);
        District::create(['title' => 'परासी', 'province_id' => 5]);
        District::create(['title' => 'रुपन्देही', 'province_id' => 5]);
        District::create(['title' => 'अर्घाखाँची', 'province_id' => 5]);
        District::create(['title' => 'गुल्मी', 'province_id' => 5]);
        District::create(['title' => 'पाल्पा', 'province_id' => 5]);
        District::create(['title' => 'दाङ्ग', 'province_id' => 5]);
        District::create(['title' => 'प्युठान', 'province_id' => 5]);
        District::create(['title' => 'रोल्पा', 'province_id' => 5]);
        District::create(['title' => 'पूर्वी रुकुम', 'province_id' => 5]);
        District::create(['title' => 'वाँके', 'province_id' => 5]);
        District::create(['title' => 'वर्दिया', 'province_id' => 5]);

        // Karnali Province (province_id = 6)
        District::create(['title' => 'पश्चिम रुकुम', 'province_id' => 6]);
        District::create(['title' => 'सल्यान', 'province_id' => 6]);
        District::create(['title' => 'डोल्पा', 'province_id' => 6]);
        District::create(['title' => 'हुम्ला', 'province_id' => 6]);
        District::create(['title' => 'जुम्ला', 'province_id' => 6]);
        District::create(['title' => 'कालिकोट', 'province_id' => 6]);
        District::create(['title' => 'मुगु', 'province_id' => 6]);
        District::create(['title' => 'सुर्खेत', 'province_id' => 6]);
        District::create(['title' => 'दैलेख', 'province_id' => 6]);
        District::create(['title' => 'जाजरकोट', 'province_id' => 6]);

        // Sudurpaschim Province (province_id = 7)
        District::create(['title' => 'कैलाली', 'province_id' => 7]);
        District::create(['title' => 'अछाम', 'province_id' => 7]);
        District::create(['title' => 'डोटी', 'province_id' => 7]);
        District::create(['title' => 'वझाङ्ग', 'province_id' => 7]);
        District::create(['title' => 'वाजुरा', 'province_id' => 7]);
        District::create(['title' => 'कंचनपुर', 'province_id' => 7]);
        District::create(['title' => 'डडेल्धुरा', 'province_id' => 7]);
        District::create(['title' => 'वैतडी', 'province_id' => 7]);
        District::create(['title' => 'दार्चुला', 'province_id' => 7]);
    }
}
