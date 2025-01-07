<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('faqs')->insert([
            [
                'title' => 'What is Madan Bhandari Sports Academy?',
                'answer' => 'Madan Bhandari Sports Academy is an esteemed institution dedicated to providing world-class training and education in sports. It aims to nurture talented athletes and help them achieve excellence in their respective sports disciplines.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'How can I enroll in the academy?',
                'answer' => 'To enroll, you need to fill out the online enrollment form on our website or visit the academy in person. We accept new enrollments during specific admission cycles. You will be required to undergo a physical fitness test as part of the selection process.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'What sports programs are offered at the academy?',
                'answer' => 'We offer various sports programs including football, basketball, athletics, swimming, cricket, and more. The academy also provides specialized training programs tailored to the needs of athletes in different disciplines.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'What age group is eligible to join?',
                'answer' => 'The academy offers programs for athletes aged 8 and above. We have specific training tracks based on age and skill level, ensuring that every athlete receives appropriate guidance.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Are there any scholarships available?',
                'answer' => 'Yes, the academy offers scholarships for talented athletes based on their performance during trials. Scholarships are available for both tuition fees and training expenses.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'How can I contact the academy for more information?',
                'answer' => 'You can contact the Madan Bhandari Sports Academy via our official website’s contact form or by calling our office during business hours. We are also available on social media platforms.',
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
