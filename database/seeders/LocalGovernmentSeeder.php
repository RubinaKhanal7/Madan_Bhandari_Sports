<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\LocalGovernment;
use Illuminate\Database\Seeder;

class LocalGovernmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // District 1 = Bhojpur
        LocalGovernment::create(['title' => 'भोजपुर नगरपालिका', 'district_id' => 1, 'is_active' => true]);
        LocalGovernment::create(['title' => 'षडानन्द नगरपालिका', 'district_id' => 1, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हतुवागढ़ी गाउँपालिका', 'district_id' => 1, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रामप्रसाद राइ गाउँपालिका', 'district_id' => 1, 'is_active' => true]);
        LocalGovernment::create(['title' => 'आमचोक गाउँपालिका', 'district_id' => 1, 'is_active' => true]);
        LocalGovernment::create(['title' => 'टेम्केमैयुङ गाउँपालिका', 'district_id' => 1, 'is_active' => true]);
        LocalGovernment::create(['title' => 'अरूण गाउँपालिका', 'district_id' => 1, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पौवादुङमा गाउँपालिका', 'district_id' => 1, 'is_active' => true]);
        LocalGovernment::create(['title' => 'साल्पासिलिछो गाउँपालिका', 'district_id' => 1, 'is_active' => true]);

      // District 2 = Dhankuta
      LocalGovernment::create(['title' => 'धनकुटा नगरपालिका', 'district_id' => 2, 'is_active' => true]);
      LocalGovernment::create(['title' => 'पख्रिबास नगरपालिका', 'district_id' => 2, 'is_active' => true]);
      LocalGovernment::create(['title' => 'महालक्ष्मी नगरपालिका', 'district_id' => 2, 'is_active' => true]);
      LocalGovernment::create(['title' => 'सागुरीगढी गाउँपालिका', 'district_id' => 2, 'is_active' => true]);
      LocalGovernment::create(['title' => 'चौविसे गाउँपालिका', 'district_id' => 2, 'is_active' => true]);
      LocalGovernment::create(['title' => 'सहिदभुमी गाउँपालिका', 'district_id' => 2, 'is_active' => true]);
      LocalGovernment::create(['title' => 'छथर जोरपाटी गाउँपालिका', 'district_id' => 2, 'is_active' => true]);

      // District 3 = Ilam
      LocalGovernment::create(['title' => 'इलाम नगरपालिका', 'district_id' => 3, 'is_active' => true]);
      LocalGovernment::create(['title' => 'देउमाइ नगरपालिका', 'district_id' => 3, 'is_active' => true]);
      LocalGovernment::create(['title' => 'माइ नगरपालिका', 'district_id' => 3, 'is_active' => true]);
      LocalGovernment::create(['title' => 'सुर्योदया नगरपालिका', 'district_id' => 3, 'is_active' => true]);
      LocalGovernment::create(['title' => 'फाकफोकथुम गाउँपालिका', 'district_id' => 3, 'is_active' => true]);
      LocalGovernment::create(['title' => 'माईजोगमाई गाउँपालिका', 'district_id' => 3, 'is_active' => true]);
      LocalGovernment::create(['title' => 'चुलाचुली गाउँपालिका', 'district_id' => 3, 'is_active' => true]);
      LocalGovernment::create(['title' => 'रोङ्ग गाउँपालिका', 'district_id' => 3, 'is_active' => true]);
      LocalGovernment::create(['title' => 'माङसेबुङ गाउँपालिका', 'district_id' => 3, 'is_active' => true]);
      LocalGovernment::create(['title' => 'सन्दकपुर गाउँपालिका', 'district_id' => 3, 'is_active' => true]);

      // District 4 = Jhapa
      LocalGovernment::create(['title' => 'मेचीनगर नगरपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'भद्रपुर नगरपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'विर्तामोड नगरपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'अर्जुनधारा नगरपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'कन्काई नगरपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'शिवशताक्षी नगरपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'गौरादह नगरपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'दमक नगरपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'बुद्धशान्ति गाउँपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'हल्दिबारी गाउँपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'कंचनकवाल गाउँपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'बाह्रदशी गाउँपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'झापा गाउँपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'गौरिगंज गाउँपालिका', 'district_id' => 4, 'is_active' => true]);
      LocalGovernment::create(['title' => 'कमल गाउँपालिका', 'district_id' => 4, 'is_active' => true]);

      // District 5 = Khotang
      LocalGovernment::create(['title' => 'दिक्तेल रुपाकोट मझुवागढी नगरपालिका', 'district_id' => 5, 'is_active' => true]);
      LocalGovernment::create(['title' => 'हलेसी तुवाचुङ नगरपालिका', 'district_id' => 5, 'is_active' => true]);
      LocalGovernment::create(['title' => 'खोटेहाङ गाउँपालिका', 'district_id' => 5, 'is_active' => true]);
      LocalGovernment::create(['title' => 'दिप्रुङ चुइचुम्मा गाउँपालिका', 'district_id' => 5, 'is_active' => true]);
      LocalGovernment::create(['title' => 'ऐसेलुखर्क गाउँपालिका', 'district_id' => 5, 'is_active' => true]);
      LocalGovernment::create(['title' => 'जन्तेढूङ्गा गाउँपालिका', 'district_id' => 5, 'is_active' => true]);
      LocalGovernment::create(['title' => 'केपिलासगढी गाउँपालिका', 'district_id' => 5, 'is_active' => true]);
      LocalGovernment::create(['title' => 'वराहपोखरी गाउँपालिका', 'district_id' => 5, 'is_active' => true]);
      LocalGovernment::create(['title' => 'रावाबेसी गाउँपालिका', 'district_id' => 5, 'is_active' => true]);
      LocalGovernment::create(['title' => 'साकेला गाउँपालिका', 'district_id' => 5, 'is_active' => true]);

      // District 6 = Morang
      LocalGovernment::create(['title' => 'विराटनगर महानगरपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'सुन्दरहरैचा नगरपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'बेलवारी नगरपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'पथरी शनिश्चरे नगरपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'उर्लाबारी नगरपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'रंगेली नगरपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'लेटांग भोगेटनी नगरपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'रतुवामाई नगरपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'सुनवर्शी नगरपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'केराबारी गाउँपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'मिक्लाजुंग गाउँपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'कानेपोखरी गाउँपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'बुढिगंगा गाउँपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'ग्रामथान गाउँपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'कटहरी गाउँपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'धनपालथान गाउँपालिका', 'district_id' => 6, 'is_active' => true]);
      LocalGovernment::create(['title' => 'जहदा गाउँपालिका', 'district_id' => 6, 'is_active' => true]);

        // District 7 = Okhaldhunga 
        LocalGovernment::create(['title' => 'सिद्धिचरण नगरपालिका', 'district_id' => 7, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चम्पादेवी गाउँपालिका', 'district_id' => 7, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुनकोशी गाउँपालिका', 'district_id' => 7, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लिखु गाउँपालिका', 'district_id' => 7, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चिसान्खुगढ़ी गाउँपालिका', 'district_id' => 7, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मोलुंग गाउँपालिका', 'district_id' => 7, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खिजिडेम्बा गाउँपालिका', 'district_id' => 7, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मानेभन्ज्यांग गाउँपालिका', 'district_id' => 7, 'is_active' => true]);

        // District 8 = Panchthar
        LocalGovernment::create(['title' => 'फिदिम नगरपालिका', 'district_id' => 8, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हिलिहाङ गाउँपालिका', 'district_id' => 8, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कुम्मायक गाउँपालिका', 'district_id' => 8, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मिक्लाजुंग गाउँपालिका', 'district_id' => 8, 'is_active' => true]);
        LocalGovernment::create(['title' => 'फलेलुंग गाउँपालिका', 'district_id' => 8, 'is_active' => true]);
        LocalGovernment::create(['title' => 'फाल्गुनन्द गाउँपालिका', 'district_id' => 8, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तुम्बेवा गाउँपालिका', 'district_id' => 8, 'is_active' => true]);
        LocalGovernment::create(['title' => 'याङवरक गाउँपालिका', 'district_id' => 8, 'is_active' => true]);

        // District 9 = Sankhuwasabha
        LocalGovernment::create(['title' => 'भोटखोला गाउँपालिका', 'district_id' => 9, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चैनपुर नगरपालिका', 'district_id' => 9, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चिचिला गाउँपालिका', 'district_id' => 9, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धर्मदेवी नगरपालिका', 'district_id' => 9, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खाँदबारी नगरपालिका', 'district_id' => 9, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मादी नगरपालिका', 'district_id' => 9, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मकलु गाउँपालिका', 'district_id' => 9, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पाँचखपन नगरपालिका', 'district_id' => 9, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सभापोखरी गाउँपालिका', 'district_id' => 9, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिलिचोंग गाउँपालिका', 'district_id' => 9, 'is_active' => true]);

        // District 10 = Solukhumbu
        LocalGovernment::create(['title' => 'सोलुदुधकुण्ड नगरपालिका', 'district_id' => 10, 'is_active' => true]);
        LocalGovernment::create(['title' => 'थुलुङ दुधकोशी गाउँपालिका', 'district_id' => 10, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नेचासल्यान गाउँपालिका', 'district_id' => 10, 'is_active' => true]);
        LocalGovernment::create(['title' => 'माप्य दुधकोशी गाउँपालिका', 'district_id' => 10, 'is_active' => true]);
        LocalGovernment::create(['title' => 'महाकुलुङ गाउँपालिका', 'district_id' => 10, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सोताङ गाउँपालिका', 'district_id' => 10, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लिखुपिके गाउँपालिका', 'district_id' => 10, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खुम्बु पासाङल्हमु गाउँपालिका', 'district_id' => 10, 'is_active' => true]);

        // District 11 = Sunsari
        LocalGovernment::create(['title' => 'इटहरी उपमहानगरपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धरान उपमहानगरपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ईनरुवा नगरपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दुहवी नगरपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रामधुनी-बासी नगरपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'वराहक्षेत्र नगरपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कोशी गाउँपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गढी गाउँपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बर्जु गाउँपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भोक्राहा गाउँपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हरिनगर गाउँपालिका', 'district_id' => 11, 'is_active' => true]);
        LocalGovernment::create(['title' => 'देवानगंज गाउँपालिका', 'district_id' => 11, 'is_active' => true]);

        // District 12 = Taplejung 
        LocalGovernment::create(['title' => 'फुङलिङ नगरपालिका', 'district_id' => 12, 'is_active' => true]);
        LocalGovernment::create(['title' => 'आठराई त्रिवेणी गाउँपालिका', 'district_id' => 12, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिदिङ्वा गाउँपालिका', 'district_id' => 12, 'is_active' => true]);
        LocalGovernment::create(['title' => 'फक्ताङलुङ गाउँपालिका', 'district_id' => 12, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मिक्वाखोला गाउँपालिका', 'district_id' => 12, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मेरिङदेन गाउँपालिका', 'district_id' => 12, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मैवाखोला गाउँपालिका', 'district_id' => 12, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पाथिभरा याङवरक गाउँपालिका', 'district_id' => 12, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिरीजङ्घा गाउँपालिका', 'district_id' => 12, 'is_active' => true]);

        // District 13 = Terhathum 
        LocalGovernment::create(['title' => 'आठराई गाउँपालिका', 'district_id' => 13, 'is_active' => true]);
        LocalGovernment::create(['title' => 'छथर गाउँपालिका', 'district_id' => 13, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लालीगुराँस नगरपालिका', 'district_id' => 13, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मेन्छयायेम गाउँपालिका', 'district_id' => 13, 'is_active' => true]);
        LocalGovernment::create(['title' => 'म्याङ्ग्लूङ्ग नगरपालिका', 'district_id' => 13, 'is_active' => true]);
        LocalGovernment::create(['title' => 'फेदाप गाउँपालिका', 'district_id' => 13, 'is_active' => true]);

        // District 14 = Udayapur
        LocalGovernment::create(['title' => 'त्रियुगा नगरपालिका', 'district_id' => 14, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कटारी नगरपालिका ', 'district_id' => 14, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चौडनडीगढ़ी नगरपालिका ', 'district_id' => 14, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बेलाका नगरपालिका ', 'district_id' => 14, 'is_active' => true]);
        LocalGovernment::create(['title' => 'उदयपुरगढी गाउँपालिका', 'district_id' => 14, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रौतामाई गाउँपालिका', 'district_id' => 14, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ताप्ली गाउँपालिका', 'district_id' => 14, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लिम्चुङ्ग्बुङ गाउँपालिका', 'district_id' => 14, 'is_active' => true]);

        
        // MADHESH PROVINCE
        
      // District 15 = Parsa
        LocalGovernment::create(['title' => 'बिरगंज महानगरपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बहुदरमाई नगरपालिका ', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पर्सागढी नगरपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पोखरिया नगरपालिका ', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बिन्दबासिनी गाउँपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धोबीनी गाउँपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'छिपहरमाई गाउँपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जगरनाथपुर गाउँपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जिरा भवानी गाउँपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कालिकामाई गाउँपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पकाहा मैनपुर गाउँपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पटेर्वा सुगौली गाउँपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सखुवा प्रसौनी गाउँपालिका', 'district_id' => 15, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ठोरी गाउँपालिका', 'district_id' => 15, 'is_active' => true]);

        // District 16 = Bara
        LocalGovernment::create(['title' => 'कलैया उपमहानगरपालिका ', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जीतपुर सिमरा उपमहानगरपालिका ', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कोल्हवी नगरपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'निजगढ नगरपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'महागढीमाई नगरपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिम्रौनगढ नगरपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पचरौता नगरपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'फेटा गाउँपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'विश्रामपुर गाउँपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'प्रसौनी गाउँपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'आदर्श कोतवाल गाउँपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'करैयामाई गाउँपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'देवताल गाउँपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'परवानीपुर गाउँपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बारागढी गाउँपालिका', 'district_id' => 16, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुवर्ण गाउँपालिका', 'district_id' => 16, 'is_active' => true]);

        // District 17 = Rautahat
        LocalGovernment::create(['title' => 'बौधीमाई नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बृन्दावन नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चन्द्रपुर नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'देवाही गोनाही नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गढीमाई नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गरुडा नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गौर नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गुजरा नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ईशनाथ नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कटहरिया नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'माधव नारायण नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मौलापुर नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'परोहा नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'फतुवाबिजयपुर नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राजदेवी नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राजपुर नगरपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दुर्गा भगवती गाउँपालिका', 'district_id' => 17, 'is_active' => true]);
        LocalGovernment::create(['title' => 'यमुनामाई गाउँपालिका', 'district_id' => 17, 'is_active' => true]);

        
       // District 18 = Sarlahi
        LocalGovernment::create(['title' => 'बागमती नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बलरा नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बरहथवा नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गोडैटा नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हरिवन नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हरिपुर नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हरिपुर्वा नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ईश्वरपुर नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कविलासी नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लालबन्दी नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मलंगवा नगरपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बसबरीया गाउँपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'विष्णु गाउँपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ब्रह्मपुरी गाउँपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चक्रघट्टा गाउँपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चन्द्रनगर गाउँपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धनकौल गाउँपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कौडेना गाउँपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पर्सा गाउँपालिका', 'district_id' => 18, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रामनगर गाउँपालिका', 'district_id' => 18, 'is_active' => true]);
        
        // District 19 = Dhanusha
        LocalGovernment::create(['title' => 'जनकपुरधाम उपमहानगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'क्षिरेश्वरनाथ नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गणेशमान चारनाथ नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धनुषाधाम नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नगराइन नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'विदेह नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मिथिला नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शहीदनगर नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सबैला नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कमला नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मिथिला बिहारी नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हंसपुर नगरपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जनकनन्दिनी गाउँपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बटेश्वर गाउँपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मुखियापट्टी मुसहरमिया गाउँपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लक्ष्मीनिया गाउँपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'औरही गाउँपालिका', 'district_id' => 19, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धनौजी गाउँपालिका', 'district_id' => 19, 'is_active' => true]);
        
        
        // District 20 = Siraha 
        LocalGovernment::create(['title' => 'लहान नगरपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धनगढीमाई नगरपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिरहा नगरपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गोलबजार नगरपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मिर्चियाँ नगरपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कल्याणपुर नगरपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कर्जन्हा नगरपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुखीपुर नगरपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भगवानपुर गाउँपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'औरही गाउँपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'विष्णुपुर गाउँपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बरियारपट्टी गाउँपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लक्ष्मीपुर पतारी गाउँपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नरहा गाउँपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सखुवानान्कारकट्टी गाउँपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'अर्नमा गाउँपालिका', 'district_id' => 20, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नवराजपुर गाउँपालिका', 'district_id' => 20, 'is_active' => true]);
        
        
        // District 21 = Mahottari
        LocalGovernment::create(['title' => 'औरही नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बलवा नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बर्दिबास नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भँगाहा नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गौशाला नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जलेश्वर नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लोहरपट्टी नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मनरा शिसवा नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मटिहानी नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रामगोपालपुर नगरपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'एकडारा गाउँपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'महोत्तरी गाउँपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पिपरा गाउँपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'साम्सी गाउँपालिका', 'district_id' => 21, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सोनमा गाउँपालिका', 'district_id' => 21, 'is_active' => true]);

        // District 22 = Saptari
        LocalGovernment::create(['title' => 'बोदेबरसाईन नगरपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'डाक्नेश्वरी नगरपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हनुमाननगर कङ्‌कालिनी नगरपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कञ्चनरुप नगरपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खडक नगरपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शम्भुनाथ नगरपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सप्तकोशी नगरपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुरुङ्‍गा नगरपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राजविराज नगरपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'अग्निसाइर कृष्णासवरन गाउँपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बलान-बिहुल गाउँपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राजगढ गाँउपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बिष्णुपुर गाउँपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'छिन्नमस्ता गाउँपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'महादेवा गाउँपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रुपनी गाउँपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तिलाठी कोईलाडी गाउँपालिका', 'district_id' => 22, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तिरहुत गाउँपालिका', 'district_id' => 22, 'is_active' => true]);

        
       // District 23 = Sindhuli
        LocalGovernment::create(['title' => 'सुनकोशी गाउँपालिका', 'district_id' => 23, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हरिहरपुरगढी गाउँपालिका', 'district_id' => 23, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तिनपाटन गाउँपालिका', 'district_id' => 23, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मरिण गाउँपालिका', 'district_id' => 23, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गोलन्जर गाउँपालिका', 'district_id' => 23, 'is_active' => true]);
        LocalGovernment::create(['title' => 'फिक्कल गाउँपालिका', 'district_id' => 23, 'is_active' => true]);
        LocalGovernment::create(['title' => 'घ्याङलेख गाउँपालिका', 'district_id' => 23, 'is_active' => true]);

        // District 24 = Ramechhap
        LocalGovernment::create(['title' => 'मन्थली नगरपालिका', 'district_id' => 24, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रामेछाप नगरपालिका', 'district_id' => 24, 'is_active' => true]);
        LocalGovernment::create(['title' => 'उमाकुण्ड गाउँपालिका', 'district_id' => 24, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खाँडादेवी गाउँपालिका', 'district_id' => 24, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दोरम्बा गाउँपालिका', 'district_id' => 24, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गोकुलगङ्गा गाउँपालिका', 'district_id' => 24, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लिखु तामाकोशी गाउँपालिका', 'district_id' => 24, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुनापती गाउँपालिका', 'district_id' => 24, 'is_active' => true]);

        // District 25 = Dolakha
        LocalGovernment::create(['title' => 'भिमेश्वर नगरपालिका', 'district_id' => 25, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जिरी नगरपालिका', 'district_id' => 25, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कालिन्चोक गाउँपालिका', 'district_id' => 25, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मेलुङ्ग गाउँपालिका', 'district_id' => 25, 'is_active' => true]);
        LocalGovernment::create(['title' => 'विगु गाउँपालिका', 'district_id' => 25, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गौरीशङ्कर गाउँपालिका', 'district_id' => 25, 'is_active' => true]);
        LocalGovernment::create(['title' => 'वैतेश्वर गाउँपालिका', 'district_id' => 25, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शैलुङ्ग गाउँपालिका', 'district_id' => 25, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तामाकोशी गाउँपालिका', 'district_id' => 25, 'is_active' => true]);

        // District 26 = Bhaktapur
        LocalGovernment::create(['title' => 'भक्तपुर नगरपालिका', 'district_id' => 26, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चाँगुनारायण नगरपालिका', 'district_id' => 26, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मध्यपुर ठिमि नगरपालिका', 'district_id' => 26, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुर्यविनायक नगरपालिका', 'district_id' => 26, 'is_active' => true]);

        
       // District 27 = Dhading
        LocalGovernment::create(['title' => 'धुनीबेंशी नगरपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'निलकण्ठ नगरपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खनियाबास गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गजुरी गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गल्छी गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गङ्गाजमुना गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ज्वालामूखी गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'थाक्रे गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नेत्रावती डबजोङ गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बेनीघाट रोराङ्ग गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रुवी भ्याली गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिद्धलेक गाउँपालिका', 'district_id' => 27, 'is_active' => true]);
        LocalGovernment::create(['title' => 'त्रिपुरासुन्दरी गाउँपालिका', 'district_id' => 27, 'is_active' => true]);

        // District 28 = Kathmandu
        LocalGovernment::create(['title' => 'काठमांडाै महानगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बुढानिलकण्ठ नगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तार्केश्वर नगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गाेकर्णेश्वर नगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चन्द्रागिरी नगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'टाेखा नगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कागेश्वरी नगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नागार्जुन नगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'किर्तिपुर नगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दक्षिणकाली नगरपालिका', 'district_id' => 28, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शंकरपरु नगरपालिका', 'district_id' => 28, 'is_active' => true]);

        
      // District 29 = Kavrepalanchok
        LocalGovernment::create(['title' => 'धुलिखेल नगरपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बनेपा नगरपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पनौती नगरपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पाँचखाल नगरपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नमोबुद्ध नगरपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मण्डनदेउपुर नगरपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खानीखोला गाउँपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चौंरी देउराली गाउँपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तेमाल गाउँपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बेथानचोक गाउँपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भुम्लु गाउँपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'महाभारत गाउँपालिका', 'district_id' => 29, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रोशी गाउँपालिका', 'district_id' => 29, 'is_active' => true]);

        // District 30 = Lalitpur
        LocalGovernment::create(['title' => 'ललितपुर महानगरपालिका', 'district_id' => 30, 'is_active' => true]);
        LocalGovernment::create(['title' => 'महालक्ष्मी नगरपालिका', 'district_id' => 30, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गोदावरी नगरपालिका', 'district_id' => 30, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कोन्ज्योसोम गाउँपालिका', 'district_id' => 30, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बाग्मति गाउँपालिका', 'district_id' => 30, 'is_active' => true]);
        LocalGovernment::create(['title' => 'महाङ्काल गाउँपालिका', 'district_id' => 30, 'is_active' => true]);

        
       // District 31 = Nuwakot
        LocalGovernment::create(['title' => 'विदुर नगरपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बेलकोटगढी नगरपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ककनी गाउँपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पञ्चकन्या गाउँपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लिखु गाउँपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दुप्चेश्वर गाउँपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शिवपुरी गाउँपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तादी गाउँपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुर्यगढी गाउँपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तारकेश्वर गाउँपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'किस्पाङ गाउँपालिका', 'district_id' => 31, 'is_active' => true]);
        LocalGovernment::create(['title' => 'म्यागङ गाउँपालिका', 'district_id' => 31, 'is_active' => true]);

        // District 32 = Rasuwa
        LocalGovernment::create(['title' => 'उत्तरगया गाउँपालिका', 'district_id' => 32, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कालिका गाउँपालिका', 'district_id' => 32, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गाेसाइकुण्ड गाउँपालिका', 'district_id' => 32, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नाैकुण्ड गाउँपालिका', 'district_id' => 32, 'is_active' => true]);
        LocalGovernment::create(['title' => 'आमाछोदिन्ग्मो गाउँपालिका', 'district_id' => 32, 'is_active' => true]);

        
       // District 33 = Sindhupalchok
        LocalGovernment::create(['title' => 'चौतारा साँगाचोकगढी नगरपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बाह्रविसे नगरपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मेलम्ची नगरपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बलेफी गाउँपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुनकोशी गाउँपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'इन्द्रावती गाउँपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जुगल गाउँपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पाँचपोखरी थाङपाल गाउँपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भोटेकोशी गाउँपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लिसंखु पाखर गाउँपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हेलम्बु गाउँपालिका', 'district_id' => 33, 'is_active' => true]);
        LocalGovernment::create(['title' => 'त्रिपुरासुन्दरी गाउँपालिका', 'district_id' => 33, 'is_active' => true]);

        // District 34 = Chitwan
        LocalGovernment::create(['title' => 'भरतपुर महानगरपालिका', 'district_id' => 34, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कालिका नगरपालिका', 'district_id' => 34, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खैरहनी नगरपालिका', 'district_id' => 34, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मादी नगरपालिका', 'district_id' => 34, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रत्ननगर नगरपालिका', 'district_id' => 34, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राप्ती नगरपालिका', 'district_id' => 34, 'is_active' => true]);
        LocalGovernment::create(['title' => 'इक्षाकामना गाँउपालिका', 'district_id' => 34, 'is_active' => true]);

       // District 35 = Makwanpur
        LocalGovernment::create(['title' => 'हेटौडा उपमहानगरपालिका', 'district_id' => 35, 'is_active' => true]);
        LocalGovernment::create(['title' => 'थाहा नगरपालिका', 'district_id' => 35, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भीमफेदी गाउँपालिका', 'district_id' => 35, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मकवानपुरगढी गाउँपालिका', 'district_id' => 35, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मनहरी गाउँपालिका', 'district_id' => 35, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राक्सिराङ्ग गाउँपालिका', 'district_id' => 35, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बकैया गाउँपालिका', 'district_id' => 35, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बाग्मति गाउँपालिका', 'district_id' => 35, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कैलाश गाउँपालिका', 'district_id' => 35, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ईन्द्र सरोवर गाउँपालिका', 'district_id' => 35, 'is_active' => true]);

        // Gandaki Province
        // District 36 = Baglung
        LocalGovernment::create(['title' => 'बागलुङ नगरपालिका', 'district_id' => 36, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ढोरपाटन नगरपालिका', 'district_id' => 36, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गल्कोट नगरपालिका', 'district_id' => 36, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जैमूनी नगरपालिका', 'district_id' => 36, 'is_active' => true]);
        LocalGovernment::create(['title' => 'वरेङ गाउँपालिका', 'district_id' => 36, 'is_active' => true]);
        LocalGovernment::create(['title' => 'काठेखोला गाउँपालिका', 'district_id' => 36, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तमानखोला गाउँपालिका', 'district_id' => 36, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ताराखोला गाउँपालिका', 'district_id' => 36, 'is_active' => true]);
        LocalGovernment::create(['title' => 'निसीखोला गाउँपालिका', 'district_id' => 36, 'is_active' => true]);
        LocalGovernment::create(['title' => 'वडिगाड गाउँपालिका', 'district_id' => 36, 'is_active' => true]);

        // District 37 = Gorkha
        LocalGovernment::create(['title' => 'गोरखा नगरपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पालुङटार नगरपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुलिकाेट गाँउपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिरानचोक गाउँपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'अजिरकोट गाउँपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चुम नुव्री गाउँपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धार्चे गाउँपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भिमसेनथापा गाउँपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शहिद लखन गाउँपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'आरूघाट गाउँपालिका', 'district_id' => 37, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गण्डकी गाउँपालिका', 'district_id' => 37, 'is_active' => true]);

        // District 38 = Kaski
        LocalGovernment::create(['title' => 'पोखरा महानगरपालिका', 'district_id' => 38, 'is_active' => true]);
        LocalGovernment::create(['title' => 'अन्नपुर्ण गाउँपालिका', 'district_id' => 38, 'is_active' => true]);
        LocalGovernment::create(['title' => 'माछापुछ्रे गाउँपालिका', 'district_id' => 38, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मादी गाउँपालिका', 'district_id' => 38, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रूपा गाउँपालिका', 'district_id' => 38, 'is_active' => true]);

        // District 39 = Lamjhung
        LocalGovernment::create(['title' => 'बेसीशहर नगरपालिका', 'district_id' => 39, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दोर्दी गाउँपालिका', 'district_id' => 39, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दूधपोखरी गाउँपालिका', 'district_id' => 39, 'is_active' => true]);
        LocalGovernment::create(['title' => 'क्व्होलासोथार गाउँपालिका', 'district_id' => 39, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मध्यनेपाल नगरपालिका', 'district_id' => 39, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मर्स्याङदी गाउँपालिका', 'district_id' => 39, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रार्इनास नगरपालिका', 'district_id' => 39, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुन्दरबजार नगरपालिका', 'district_id' => 39, 'is_active' => true]);

          
        // District 40 = Manang
        LocalGovernment::create(['title' => 'चामे गाउँपालिका', 'district_id' => 40, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नासोँ गाउँपालिका', 'district_id' => 40, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नार्पा भूमि  गाउँपालिका', 'district_id' => 40, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मनाङ डिस्याङ गाउँपालिका', 'district_id' => 40, 'is_active' => true]);

        // District 41 = Mustang 
        LocalGovernment::create(['title' => 'घरपझोङ गाउँपालिका', 'district_id' => 41, 'is_active' => true]);
        LocalGovernment::create(['title' => 'थासाङ गाउँपालिका', 'district_id' => 41, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बारागुङ मुक्तिक्षेत्र गाउँपालिका', 'district_id' => 41, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लोमन्थाङ गाउँपालिका', 'district_id' => 41, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लो-थेकर दामोदरकुण्ड गाउँपालिका', 'district_id' => 41, 'is_active' => true]);

        // District 42 = Myagdi
        LocalGovernment::create(['title' => 'बेनी नगरपालिका', 'district_id' => 42, 'is_active' => true]);
        LocalGovernment::create(['title' => 'अन्नपुर्ण गाउँपालिका', 'district_id' => 42, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धवलागिरी गाउँपालिका', 'district_id' => 42, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मंगला गाउँपालिका', 'district_id' => 42, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मालिका गाउँपालिका', 'district_id' => 42, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रघुगंगा गाउँपालिका', 'district_id' => 42, 'is_active' => true]);

        // District 43 = Nawalpur
        LocalGovernment::create(['title' => 'कावासोती नगरपालिका', 'district_id' => 43, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गैडाकोट नगरपालिका', 'district_id' => 43, 'is_active' => true]);
        LocalGovernment::create(['title' => 'देवचुली नगरपालिका', 'district_id' => 43, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मध्यविन्दु नगरपालिका', 'district_id' => 43, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बौदीकाली गाउँपालिका', 'district_id' => 43, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बुलिङटार गाउँपालिका', 'district_id' => 43, 'is_active' => true]);
        LocalGovernment::create(['title' => 'विनयी त्रिवेणी गाउँपालिका', 'district_id' => 43, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हुप्सेकोट गाउँपालिका', 'district_id' => 43, 'is_active' => true]);

          
         // District 44 = Parbat
            LocalGovernment::create(['title' => 'कुश्मा नगरपालिका', 'district_id' => 44, 'is_active' => true]);
            LocalGovernment::create(['title' => 'फलेवास नगरपालिका', 'district_id' => 44, 'is_active' => true]);
            LocalGovernment::create(['title' => 'जलजला गाउँपालिका', 'district_id' => 44, 'is_active' => true]);
            LocalGovernment::create(['title' => 'पैयूं गाउँपालिका', 'district_id' => 44, 'is_active' => true]);
            LocalGovernment::create(['title' => 'महाशिला गाउँपालिका', 'district_id' => 44, 'is_active' => true]);
            LocalGovernment::create(['title' => 'मोदी गाउँपालिका', 'district_id' => 44, 'is_active' => true]);
            LocalGovernment::create(['title' => 'विहादी गाउँपालिका', 'district_id' => 44, 'is_active' => true]);

            // District 45 = Syangja
            LocalGovernment::create(['title' => 'गल्याङ नगरपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'चापाकोट नगरपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'पुतलीबजार नगरपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'भीरकोट नगरपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'वालिङ नगरपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'अर्जुन चौपारी गाउँपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'आँधीखोला गाउँपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'कालीगण्डकी गाउँपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'फेदीखोला गाउँपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'हरिनास गाउँपालिका', 'district_id' => 45, 'is_active' => true]);
            LocalGovernment::create(['title' => 'विरुवा गाउँपालिका', 'district_id' => 45, 'is_active' => true]);

            // District 46 = Tanahun
            LocalGovernment::create(['title' => 'भानु नगरपालिका', 'district_id' => 46, 'is_active' => true]);
            LocalGovernment::create(['title' => 'भिमाद नगरपालिका', 'district_id' => 46, 'is_active' => true]);
            LocalGovernment::create(['title' => 'व्यास नगरपालिका', 'district_id' => 46, 'is_active' => true]);
            LocalGovernment::create(['title' => 'शुक्लागण्डकी नगरपालिका', 'district_id' => 46, 'is_active' => true]);
            LocalGovernment::create(['title' => 'आँबुखैरेनी गाउँपालिका', 'district_id' => 46, 'is_active' => true]);
            LocalGovernment::create(['title' => 'देवघाट गाउँपालिका', 'district_id' => 46, 'is_active' => true]);
            LocalGovernment::create(['title' => 'बन्दिपुर गाउँपालिका', 'district_id' => 46, 'is_active' => true]);
            LocalGovernment::create(['title' => 'ऋषिङ्ग गाउँपालिका', 'district_id' => 46, 'is_active' => true]);
            LocalGovernment::create(['title' => 'घिरिङ गाउँपालिका', 'district_id' => 46, 'is_active' => true]);
            LocalGovernment::create(['title' => 'म्याग्दे गाउँपालिका', 'district_id' => 46, 'is_active' => true]);

          
          // Lumbini Province
         // District 47 = Kapilvastu
        LocalGovernment::create(['title' => 'कपिलवस्तु नगरपालिका', 'district_id' => 47, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बाणगंगा नगरपालिका', 'district_id' => 47, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बुद्धभुमी नगरपालिका', 'district_id' => 47, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शिवराज नगरपालिका', 'district_id' => 47, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कृष्णनगर नगरपालिका', 'district_id' => 47, 'is_active' => true]);
        LocalGovernment::create(['title' => 'महाराजगंज नगरपालिका', 'district_id' => 47, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मायादेवी गाउँपालिका', 'district_id' => 47, 'is_active' => true]);
        LocalGovernment::create(['title' => 'यसोधरा गाउँपालिका', 'district_id' => 47, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शुद्धोधन गाउँपालिका', 'district_id' => 47, 'is_active' => true]);
        LocalGovernment::create(['title' => 'विजयनगर गाउँपालिका', 'district_id' => 47, 'is_active' => true]);

        // District 48 = Parasi
        LocalGovernment::create(['title' => 'बर्दघाट नगरपालिका', 'district_id' => 48, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रामग्राम नगरपालिका', 'district_id' => 48, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुनवल नगरपालिका', 'district_id' => 48, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुस्ता गाउँपालिका', 'district_id' => 48, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पाल्हीनन्दन गाउँपालिका', 'district_id' => 48, 'is_active' => true]);
        LocalGovernment::create(['title' => 'प्रतापपुर गाउँपालिका', 'district_id' => 48, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सरावल गाउँपालिका', 'district_id' => 48, 'is_active' => true]);

        // District 49 = Rupandehi
        LocalGovernment::create(['title' => 'बुटवल उपमहानगरपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'देवदह नगरपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लुम्बिनी सांस्कृतिक नगरपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सैनामैना नगरपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिद्धार्थनगर नगरपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तिलोत्तमा नगरपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गैडहवा गाउँपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कञ्चन गाउँपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कोटहीमाई गाउँपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मर्चवारी गाउँपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मायादेवी गाउँपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ओमसतीया गाउँपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रोहिणी गाउँपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सम्मरीमाई गाउँपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सियारी गाउँपालिका', 'district_id' => 49, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शुद्धोधन गाउँपालिका', 'district_id' => 49, 'is_active' => true]);

          
         // District 50 = Arghakhanchi
        LocalGovernment::create(['title' => 'सन्धिखर्क नगरपालिका', 'district_id' => 50, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शितगंगा नगरपालिका', 'district_id' => 50, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भूमिकास्थान नगरपालिका', 'district_id' => 50, 'is_active' => true]);
        LocalGovernment::create(['title' => 'छत्रदेव गाउँपालिका', 'district_id' => 50, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पाणिनी गाउँपालिका', 'district_id' => 50, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मालारानी गाउँपालिका', 'district_id' => 50, 'is_active' => true]);

        // District 51 = Gulmi
        LocalGovernment::create(['title' => 'मुसिकोट नगरपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रेसुङ्गा नगरपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ईस्मा गाउँपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कालीगण्डकी गाउँपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गुल्मीदरवार गाउँपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सत्यवती गाउँपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चन्द्रकोट गाउँपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रुरुक्षेत्र गाउँपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'छत्रकोट गाउँपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'धुर्कोट गाउँपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मदाने गाउँपालिका', 'district_id' => 51, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मालिका गाउँपालिका', 'district_id' => 51, 'is_active' => true]);

          
        // District 52 = Palpa
        LocalGovernment::create(['title' => 'तानसेन नगरपालिका', 'district_id' => 52, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रामपुर नगरपालिका', 'district_id' => 52, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रैनादेवी छहरा गाउँपालिका', 'district_id' => 52, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रिब्दीकोट गाउँपालिका', 'district_id' => 52, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बगनासकाली गाउँपालिका', 'district_id' => 52, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रम्भा गाउँपालिका', 'district_id' => 52, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पूर्वखोला गाउँपालिका', 'district_id' => 52, 'is_active' => true]);
        LocalGovernment::create(['title' => 'निस्दी गाउँपालिका', 'district_id' => 52, 'is_active' => true]);
        LocalGovernment::create(['title' => 'माथागढी गाउँपालिका', 'district_id' => 52, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तिनाउ गाउँपालिका', 'district_id' => 52, 'is_active' => true]);

        // District 53 = Dang
        LocalGovernment::create(['title' => 'घोराही उपमहानगरपालिका', 'district_id' => 53, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तुल्सीपुर उपमहानगरपालिका', 'district_id' => 53, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लमही नगरपालिका', 'district_id' => 53, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गढवा गाउँपालिका', 'district_id' => 53, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राजपुर गाउँपालिका', 'district_id' => 53, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शान्तिनगर गाउँपालिका', 'district_id' => 53, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राप्ती गाउँपालिका', 'district_id' => 53, 'is_active' => true]);
        LocalGovernment::create(['title' => 'वंगलाचुली गाउँपालिका', 'district_id' => 53, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दंगीशरण गाउँपालिका', 'district_id' => 53, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बबई गाउँपालिका', 'district_id' => 53, 'is_active' => true]);

          
        // District 54 = Pyuthan
        LocalGovernment::create(['title' => 'प्यूठान नगरपालिका', 'district_id' => 54, 'is_active' => true]);
        LocalGovernment::create(['title' => 'स्वर्गद्वारी नगरपालिका', 'district_id' => 54, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गौमुखी गाउँपालिका', 'district_id' => 54, 'is_active' => true]);
        LocalGovernment::create(['title' => 'माण्डवी गाउँपालिका', 'district_id' => 54, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सरुमारानी गाउँपालिका', 'district_id' => 54, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मल्लरानी गाउँपालिका', 'district_id' => 54, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नौबहिनी गाउँपालिका', 'district_id' => 54, 'is_active' => true]);
        LocalGovernment::create(['title' => 'झिमरुक गाउँपालिका', 'district_id' => 54, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ऐरावती गाउँपालिका', 'district_id' => 54, 'is_active' => true]);

        // District 55 = Rolpa
        LocalGovernment::create(['title' => 'रोल्पा नगरपालिका', 'district_id' => 55, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रुन्टीगढी गाउँपालिका', 'district_id' => 55, 'is_active' => true]);
        LocalGovernment::create(['title' => 'त्रिवेणी गाउँपालिका', 'district_id' => 55, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुनिल स्मृति गाउँपालिका', 'district_id' => 55, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लुङ्ग्री गाउँपालिका', 'district_id' => 55, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुनछहरी गाउँपालिका', 'district_id' => 55, 'is_active' => true]);
        LocalGovernment::create(['title' => 'थवाङ गाउँपालिका', 'district_id' => 55, 'is_active' => true]);
        LocalGovernment::create(['title' => 'माडी गाउँपालिका', 'district_id' => 55, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गंगादेव गाउँपालिका', 'district_id' => 55, 'is_active' => true]);
        LocalGovernment::create(['title' => 'परिवर्तन गाउँपालिका', 'district_id' => 55, 'is_active' => true]);

          
         // District 56 = East Rukum
        LocalGovernment::create(['title' => 'भूमे गाउँपालिका', 'district_id' => 56, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पुथा उत्तरगंगा गाउँपालिका', 'district_id' => 56, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिस्ने गाउँपालिका', 'district_id' => 56, 'is_active' => true]);

        // District 57 = Banke
        LocalGovernment::create(['title' => 'नेपालगंज उपमहानगरपालिका', 'district_id' => 57, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कोहलपुर नगरपालिका', 'district_id' => 57, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राप्ती सोनारी गाउँपालिका', 'district_id' => 57, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नरैनापुर गाउँपालिका', 'district_id' => 57, 'is_active' => true]);
        LocalGovernment::create(['title' => 'डुडुवा गाउँपालिका', 'district_id' => 57, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जानकी गाउँपालिका', 'district_id' => 57, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खजुरा गाउँपालिका', 'district_id' => 57, 'is_active' => true]);
        LocalGovernment::create(['title' => 'वैजनाथ गाउँपालिका', 'district_id' => 57, 'is_active' => true]);

        // District 58 = Bardiya
        LocalGovernment::create(['title' => 'गुलरिया नगरपालिका', 'district_id' => 58, 'is_active' => true]);
        LocalGovernment::create(['title' => 'राजापुर नगरपालिका', 'district_id' => 58, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मधुवन नगरपालिका', 'district_id' => 58, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ठाकुरबाबा नगरपालिका', 'district_id' => 58, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बाँसगढी नगरपालिका', 'district_id' => 58, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बारबर्दिया नगरपालिका', 'district_id' => 58, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बढैयाताल गाउँपालिका', 'district_id' => 58, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गेरुवा गाउँपालिका', 'district_id' => 58, 'is_active' => true]);

          
          // Karnali Province
         // District 59 = West Rukum
            LocalGovernment::create(['title' => 'मुसिकोट नगरपालिका', 'district_id' => 59, 'is_active' => true]);
            LocalGovernment::create(['title' => 'चौरजहारी नगरपालिका', 'district_id' => 59, 'is_active' => true]);
            LocalGovernment::create(['title' => 'आठबिसकोट नगरपालिका', 'district_id' => 59, 'is_active' => true]);
            LocalGovernment::create(['title' => 'बाँफिकोट गाउँपालिका', 'district_id' => 59, 'is_active' => true]);
            LocalGovernment::create(['title' => 'त्रिवेणी गाउँपालिका', 'district_id' => 59, 'is_active' => true]);
            LocalGovernment::create(['title' => 'सानीभेरी गाउँपालिका', 'district_id' => 59, 'is_active' => true]);

            // District 60 = Salyan
            LocalGovernment::create(['title' => 'शारदा नगरपालिका', 'district_id' => 60, 'is_active' => true]);
            LocalGovernment::create(['title' => 'बागचौर नगरपालिका', 'district_id' => 60, 'is_active' => true]);
            LocalGovernment::create(['title' => 'बनगाड कुपिण्डे नगरपालिका', 'district_id' => 60, 'is_active' => true]);
            LocalGovernment::create(['title' => 'कालीमाटी गाउँपालिका', 'district_id' => 60, 'is_active' => true]);
            LocalGovernment::create(['title' => 'त्रिवेणी गाउँपालिका', 'district_id' => 60, 'is_active' => true]);
            LocalGovernment::create(['title' => 'कपुरकोट गाउँपालिका', 'district_id' => 60, 'is_active' => true]);
            LocalGovernment::create(['title' => 'छत्रेश्वरी गाउँपालिका', 'district_id' => 60, 'is_active' => true]);
            LocalGovernment::create(['title' => 'कुमाख गाउँपालिका', 'district_id' => 60, 'is_active' => true]);
            LocalGovernment::create(['title' => 'सिद्ध कुमाख गाउँपालिका', 'district_id' => 60, 'is_active' => true]);
            LocalGovernment::create(['title' => 'दार्मा गाउँपालिका', 'district_id' => 60, 'is_active' => true]);

          
        // District 61 = Dolpa
        LocalGovernment::create(['title' => 'ठूली भेरी नगरपालिका', 'district_id' => 61, 'is_active' => true]);
        LocalGovernment::create(['title' => 'त्रिपुरासुन्दरी नगरपालिका', 'district_id' => 61, 'is_active' => true]);
        LocalGovernment::create(['title' => 'डोल्पो बुद्ध गाउँपालिका', 'district_id' => 61, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शे फोक्सुन्डो गाउँपालिका', 'district_id' => 61, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जगदुल्ला गाउँपालिका', 'district_id' => 61, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मुड्केचुला गाउँपालिका', 'district_id' => 61, 'is_active' => true]);
        LocalGovernment::create(['title' => 'काईके गाउँपालिका', 'district_id' => 61, 'is_active' => true]);
        LocalGovernment::create(['title' => 'छार्का ताङसोङ गाउँपालिका', 'district_id' => 61, 'is_active' => true]);

        // District 62 = Humla
        LocalGovernment::create(['title' => 'सिमकोट गाउँपालिका', 'district_id' => 62, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नाम्खा गाउँपालिका', 'district_id' => 62, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खार्पुनाथ गाउँपालिका', 'district_id' => 62, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सर्केगाड गाउँपालिका', 'district_id' => 62, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चंखेली गाउँपालिका', 'district_id' => 62, 'is_active' => true]);
        LocalGovernment::create(['title' => 'अदानचुली गाउँपालिका', 'district_id' => 62, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ताँजाकोट गाउँपालिका', 'district_id' => 62, 'is_active' => true]);

        // District 63 = Jumla
        LocalGovernment::create(['title' => 'चन्दननाथ नगरपालिका', 'district_id' => 63, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कनकासुन्दरी गाउँपालिका', 'district_id' => 63, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिंजा गाउँपालिका', 'district_id' => 63, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हिमा गाउँपालिका', 'district_id' => 63, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तिला गाउँपालिका', 'district_id' => 63, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गुठिचौर गाउँपालिका', 'district_id' => 63, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तातोपानी गाउँपालिका', 'district_id' => 63, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पातारासी गाउँपालिका', 'district_id' => 63, 'is_active' => true]);

          
         // District 64 = Kalikot
            LocalGovernment::create(['title' => 'खाँडाचक्र नगरपालिका', 'district_id' => 64, 'is_active' => true]);
            LocalGovernment::create(['title' => 'रास्कोट नगरपालिका', 'district_id' => 64, 'is_active' => true]);
            LocalGovernment::create(['title' => 'तिलागुफा नगरपालिका', 'district_id' => 64, 'is_active' => true]);
            LocalGovernment::create(['title' => 'पचालझरना गाउँपालिका', 'district_id' => 64, 'is_active' => true]);
            LocalGovernment::create(['title' => 'सान्नी त्रिवेणी गाउँपालिका', 'district_id' => 64, 'is_active' => true]);
            LocalGovernment::create(['title' => 'नरहरिनाथ गाउँपालिका', 'district_id' => 64, 'is_active' => true]);
            LocalGovernment::create(['title' => 'शुभ कालिका गाउँपालिका', 'district_id' => 64, 'is_active' => true]);
            LocalGovernment::create(['title' => 'महावै गाउँपालिका', 'district_id' => 64, 'is_active' => true]);
            LocalGovernment::create(['title' => 'पलाता गाउँपालिका', 'district_id' => 64, 'is_active' => true]);

            // District 65 = Mugu
            LocalGovernment::create(['title' => 'छायाँनाथ रारा नगरपालिका', 'district_id' => 65, 'is_active' => true]);
            LocalGovernment::create(['title' => 'मुगुम कार्मारोंग गाउँपालिका', 'district_id' => 65, 'is_active' => true]);
            LocalGovernment::create(['title' => 'सोरु गाउँपालिका', 'district_id' => 65, 'is_active' => true]);
            LocalGovernment::create(['title' => 'खत्याड गाउँपालिका', 'district_id' => 65, 'is_active' => true]);

            // District 66 = Surkhet
            LocalGovernment::create(['title' => 'बीरेन्द्रनगर नगरपालिका', 'district_id' => 66, 'is_active' => true]);
            LocalGovernment::create(['title' => 'भेरीगंगा नगरपालिका', 'district_id' => 66, 'is_active' => true]);
            LocalGovernment::create(['title' => 'गुर्भाकोट नगरपालिका', 'district_id' => 66, 'is_active' => true]);
            LocalGovernment::create(['title' => 'पञ्चपुरी नगरपालिका', 'district_id' => 66, 'is_active' => true]);
            LocalGovernment::create(['title' => 'लेकवेशी नगरपालिका', 'district_id' => 66, 'is_active' => true]);
            LocalGovernment::create(['title' => 'चौकुने गाउँपालिका', 'district_id' => 66, 'is_active' => true]);
            LocalGovernment::create(['title' => 'बराहताल गाउँपालिका', 'district_id' => 66, 'is_active' => true]);
            LocalGovernment::create(['title' => 'चिङ्गाड गाउँपालिका', 'district_id' => 66, 'is_active' => true]);
            LocalGovernment::create(['title' => 'सिम्ता गाउँपालिका', 'district_id' => 66, 'is_active' => true]);

         // District 67 = Dailekh
            LocalGovernment::create(['title' => 'नारायण नगरपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'दुल्लु नगरपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'आठबीस नगरपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'चामुण्डा विन्द्रासैनी नगरपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'ठाँटीकाँध गाउँपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'भैरवी गाउँपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'महावु गाउँपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'नौमुले गाउँपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'डुंगेश्वर गाउँपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'गुराँस गाउँपालिका', 'district_id' => 67, 'is_active' => true]);
            LocalGovernment::create(['title' => 'भगवतीमाई गाउँपालिका', 'district_id' => 67, 'is_active' => true]);

            // District 68 = Jajarkot
            LocalGovernment::create(['title' => 'भेरी नगरपालिका', 'district_id' => 68, 'is_active' => true]);
            LocalGovernment::create(['title' => 'छेडागाड नगरपालिका', 'district_id' => 68, 'is_active' => true]);
            LocalGovernment::create(['title' => 'नलगाड नगरपालिका', 'district_id' => 68, 'is_active' => true]);
            LocalGovernment::create(['title' => 'जुनीचाँदे गाउँपालिका', 'district_id' => 68, 'is_active' => true]);
            LocalGovernment::create(['title' => 'कुसे गाउँपालिका', 'district_id' => 68, 'is_active' => true]);
            LocalGovernment::create(['title' => 'बारेकोट गाउँपालिका', 'district_id' => 68, 'is_active' => true]);
            LocalGovernment::create(['title' => 'शिवालय गाउँपालिका', 'district_id' => 68, 'is_active' => true]);

          // Sudhurpaschim Province 
       // District 69 = Kailali
        LocalGovernment::create(['title' => 'धनगढी उपमहानगरपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लम्कीचुहा नगरपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'टिकापुर नगरपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'घोडाघोडी नगरपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भजनी नगरपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गोदावरी नगरपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गौरीगंगा नगरपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जानकी गाउँपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बर्गगोरिया गाउँपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मोहन्याल गाउँपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कैलारी गाउँपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जोशीपुर गाउँपालिका', 'district_id' => 69, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चुरे गाउँपालिका', 'district_id' => 69, 'is_active' => true]);

        // District 70 = Achham
        LocalGovernment::create(['title' => 'मंगलसेन नगरपालिका', 'district_id' => 70, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कमलबजार नगरपालिका', 'district_id' => 70, 'is_active' => true]);
        LocalGovernment::create(['title' => 'साँफेबगर नगरपालिका', 'district_id' => 70, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पन्चदेवल विनायक नगरपालिका', 'district_id' => 70, 'is_active' => true]);
        LocalGovernment::create(['title' => 'रामारोशन गाउँपालिका', 'district_id' => 70, 'is_active' => true]);
        LocalGovernment::create(['title' => 'चौरपाटी गाउँपालिका', 'district_id' => 70, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तुर्माखाँद गाउँपालिका', 'district_id' => 70, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मेल्लेख गाउँपालिका', 'district_id' => 70, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ढँकारी गाउँपालिका', 'district_id' => 70, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बान्नीगडीजैगड गाउँपालिका', 'district_id' => 70, 'is_active' => true]);

          
        // District 71 = Doti
        LocalGovernment::create(['title' => 'दिपायल सिलगढी नगरपालिका', 'district_id' => 71, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शिखर नगरपालिका', 'district_id' => 71, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पूर्वीचौकी गाउँपालिका', 'district_id' => 71, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बड्डी केदार गाउँपालिका', 'district_id' => 71, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जोरायल गाउँपालिका', 'district_id' => 71, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सायल गाउँपालिका', 'district_id' => 71, 'is_active' => true]);
        LocalGovernment::create(['title' => 'आदर्श गाउँपालिका', 'district_id' => 71, 'is_active' => true]);
        LocalGovernment::create(['title' => 'के.आई.सिं. गाउँपालिका', 'district_id' => 71, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बोगटान गाउँपालिका', 'district_id' => 71, 'is_active' => true]);

        // District 72 = Bajhang
        LocalGovernment::create(['title' => 'जयपृथ्वी नगरपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बुंगल नगरपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'तलकोट गाउँपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मष्टा गाउँपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'छान्ना गाउँपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'थलारा गाउँपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बित्थडचिर गाउँपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुर्मा गाउँपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'छब्बीसपाथिभेरा गाउँपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दुर्गाथली गाउँपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'केदारस्यु गाउँपालिका', 'district_id' => 72, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सइपाल गाउँपालिका', 'district_id' => 72, 'is_active' => true]);

          
          
        // District 73 = Bajura
        LocalGovernment::create(['title' => 'बडीमालिका नगरपालिका', 'district_id' => 73, 'is_active' => true]);
        LocalGovernment::create(['title' => 'त्रिवेणी नगरपालिका', 'district_id' => 73, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बुढीगंगा नगरपालिका', 'district_id' => 73, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गौमुल गाउँपालिका', 'district_id' => 73, 'is_active' => true]);
        LocalGovernment::create(['title' => 'जगन्‍नाथ गाउँपालिका', 'district_id' => 73, 'is_active' => true]);
        LocalGovernment::create(['title' => 'स्वामिकार्तिक खापर गाउँपालिका', 'district_id' => 73, 'is_active' => true]);
        LocalGovernment::create(['title' => 'खप्तड छेडेदह गाउँपालिका', 'district_id' => 73, 'is_active' => true]);
        LocalGovernment::create(['title' => 'हिमाली गाउँपालिका', 'district_id' => 73, 'is_active' => true]);

        // District 74 = Kanchanpur
        LocalGovernment::create(['title' => 'वेदकोट नगरपालिका', 'district_id' => 74, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बेलौरी नगरपालिका', 'district_id' => 74, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भीमदत्त नगरपालिका', 'district_id' => 74, 'is_active' => true]);
        LocalGovernment::create(['title' => 'महाकाली नगरपालिका', 'district_id' => 74, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शुक्लाफाँटा नगरपालिका', 'district_id' => 74, 'is_active' => true]);
        LocalGovernment::create(['title' => 'कृष्णपुर नगरपालिका', 'district_id' => 74, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पुर्नवास नगरपालिका', 'district_id' => 74, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लालझाँडी गाउँपालिका', 'district_id' => 74, 'is_active' => true]);
        LocalGovernment::create(['title' => 'बेलडाँडी गाउँपालिका', 'district_id' => 74, 'is_active' => true]);

        // District 75 = Dadeldhura
        LocalGovernment::create(['title' => 'अमरगढी नगरपालिका', 'district_id' => 75, 'is_active' => true]);
        LocalGovernment::create(['title' => 'परशुराम नगरपालिका', 'district_id' => 75, 'is_active' => true]);
        LocalGovernment::create(['title' => 'आलिताल गाउँपालिका', 'district_id' => 75, 'is_active' => true]);
        LocalGovernment::create(['title' => 'भागेश्वर गाउँपालिका', 'district_id' => 75, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नवदुर्गा गाउँपालिका', 'district_id' => 75, 'is_active' => true]);
        LocalGovernment::create(['title' => 'अजयमेरु गाउँपालिका', 'district_id' => 75, 'is_active' => true]);
        LocalGovernment::create(['title' => 'गन्यापधुरा गाउँपालिका', 'district_id' => 75, 'is_active' => true]);

        
       // District 76 = Baitadi
        LocalGovernment::create(['title' => 'दशरथचन्द नगरपालिका', 'district_id' => 76, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पाटन नगरपालिका', 'district_id' => 76, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मेलौली नगरपालिका', 'district_id' => 76, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पुर्चौडी नगरपालिका', 'district_id' => 76, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सुर्नया गाउँपालिका', 'district_id' => 76, 'is_active' => true]);
        LocalGovernment::create(['title' => 'सिगास गाउँपालिका', 'district_id' => 76, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शिवनाथ गाउँपालिका', 'district_id' => 76, 'is_active' => true]);
        LocalGovernment::create(['title' => 'पञ्चेश्वर गाउँपालिका', 'district_id' => 76, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दोगडाकेदार गाउँपालिका', 'district_id' => 76, 'is_active' => true]);
        LocalGovernment::create(['title' => 'डिलाशैनी गाउँपालिका', 'district_id' => 76, 'is_active' => true]);

        // District 77 = Darchula
        LocalGovernment::create(['title' => 'महाकाली नगरपालिका', 'district_id' => 77, 'is_active' => true]);
        LocalGovernment::create(['title' => 'शैल्यशिखर नगरपालिका', 'district_id' => 77, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मालिकार्जुन गाउँपालिका', 'district_id' => 77, 'is_active' => true]);
        LocalGovernment::create(['title' => 'अपि हिमाल गाउँपालिका', 'district_id' => 77, 'is_active' => true]);
        LocalGovernment::create(['title' => 'दुहु गाउँपालिका', 'district_id' => 77, 'is_active' => true]);
        LocalGovernment::create(['title' => 'नौगाड गाउँपालिका', 'district_id' => 77, 'is_active' => true]);
        LocalGovernment::create(['title' => 'मार्मा गाउँपालिका', 'district_id' => 77, 'is_active' => true]);
        LocalGovernment::create(['title' => 'लेकम गाउँपालिका', 'district_id' => 77, 'is_active' => true]);
        LocalGovernment::create(['title' => 'ब्यास गाउँपालिका', 'district_id' => 77, 'is_active' => true]);

    }
}
