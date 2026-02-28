<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            [
                'question' => 'What is FPTP?',
                'answer' => 'First-Past-The-Post (FPTP) is an electoral system where the candidate who receives the most votes in a constituency wins a seat.',
                'category' => 'System',
            ],
            [
                'question' => 'What is PR?',
                'answer' => 'Proportional Representation (PR) is an electoral system where seats are allocated to parties based on the total number of votes they receive nationwide.',
                'category' => 'System',
            ],
            [
                'question' => 'When is the next election?',
                'answer' => 'The House of Representatives election is scheduled for March 5, 2026.',
                'category' => 'Dates',
            ],
            [
                'question' => 'How many seats are in the House of Representatives?',
                'answer' => 'There are 275 seats in total: 165 from FPTP and 110 from PR.',
                'category' => 'System',
            ],
            [
                'question' => 'Who is eligible to vote?',
                'answer' => 'Any Nepali citizen who has reached 18 years of age and is registered on the voter list.',
                'category' => 'Voter Info',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
