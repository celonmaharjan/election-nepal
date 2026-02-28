<?php

namespace Database\Seeders;

use App\Models\Party;
use Illuminate\Database\Seeder;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $parties = [
            [
                'name' => 'Nepali Congress',
                'name_nepali' => 'नेपाली कांग्रेस',
                'abbreviation' => 'NC',
                'founded_year' => 1947,
                'ideology' => 'Social Democracy',
                'color_hex' => '#FF0000',
                'logo_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Flag_of_the_Nepali_Congress.svg/320px-Flag_of_the_Nepali_Congress.svg.png',
                'description' => 'The oldest and largest democratic party of Nepal.',
            ],
            [
                'name' => 'CPN (Unified Marxist–Leninist)',
                'name_nepali' => 'नेकपा (एमाले)',
                'abbreviation' => 'CPN-UML',
                'founded_year' => 1991,
                'ideology' => 'Marxism–Leninism / People\'s Multiparty Democracy',
                'color_hex' => '#FF0000',
                'logo_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a2/CPN-UML_logo.png/320px-CPN-UML_logo.png',
                'description' => 'One of the major communist parties in Nepal.',
            ],
            [
                'name' => 'CPN (Maoist Centre)',
                'name_nepali' => 'नेकपा (माओवादी केन्द्र)',
                'abbreviation' => 'CPN-MC',
                'founded_year' => 1994,
                'ideology' => 'Marxism–Leninism–Maoism',
                'color_hex' => '#FF0000',
                'logo_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3b/Nepal_Communist_Party_%28Maoist_Centre%29_logo.svg/320px-Nepal_Communist_Party_%28Maoist_Centre%29_logo.svg.png',
                'description' => 'Former rebel party led by Pushpa Kamal Dahal (Prachanda).',
            ],
            [
                'name' => 'Rastriya Swatantra Party',
                'name_nepali' => 'राष्ट्रिय स्वतन्त्र पार्टी',
                'abbreviation' => 'RSP',
                'founded_year' => 2022,
                'ideology' => 'Constitutional Liberalism / Populism',
                'color_hex' => '#00ADEF',
                'logo_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/Rastriya_Swatantra_Party_Logo.png/320px-Rastriya_Swatantra_Party_Logo.png',
                'description' => 'A new party led by Rabi Lamichhane focusing on good governance.',
            ],
            [
                'name' => 'Rastriya Prajatantra Party',
                'name_nepali' => 'राष्ट्रिय प्रजातन्त्र पार्टी',
                'abbreviation' => 'RPP',
                'founded_year' => 1990,
                'ideology' => 'Constitutional Monarchism / Hindu Nationalism',
                'color_hex' => '#FFFF00',
                'logo_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/RPP_Logo.png/320px-RPP_Logo.png',
                'description' => 'A party advocating for the restoration of the monarchy and a Hindu state.',
            ],
            [
                'name' => 'Janata Samajwadi Party',
                'name_nepali' => 'जनता समाजवादी पार्टी',
                'abbreviation' => 'JSP',
                'founded_year' => 2020,
                'ideology' => 'Socialism / Regionalism',
                'color_hex' => '#00FF00',
                'logo_image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/Flag_of_Janata_Samajwadi_Party%2C_Nepal.svg/320px-Flag_of_Janata_Samajwadi_Party%2C_Nepal.svg.png',
                'description' => 'A major regional party focusing on the Madhesh region.',
            ],
        ];

        foreach ($parties as $party) {
            Party::updateOrCreate(['abbreviation' => $party['abbreviation']], $party);
        }
    }
}
