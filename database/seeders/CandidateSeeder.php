<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Constituency;
use App\Models\Party;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CandidateSeeder extends Seeder
{
    public function run(): void
    {
        $parties = Party::all();
        $constituencies = Constituency::all();

        // 1. Seed Real/Major Leaders with VERIFIED URLs and AGES
        $this->seedMajorLeaders();

        // 2. Realistic Nepali Names
        $firstNames = ['Ram', 'Sita', 'Hari', 'Krishna', 'Surya', 'Binod', 'Anita', 'Nabina', 'Ramesh', 'Sarita', 'Laxmi', 'Arjun', 'Prakash', 'Suman', 'Bimal', 'Kiran', 'Ganesh', 'Mahesh', 'Rajendra', 'Shiva'];
        $lastNames = ['Sharma', 'Thapa', 'Karki', 'Magar', 'Rai', 'Gurung', 'Pandey', 'Adhikari', 'Paudel', 'Chhetri', 'Dahal', 'Oli', 'Shrestha', 'Tamang', 'Yadav', 'Jha', 'Chaudhary', 'Mahato', 'Bhandari'];

        // 3. Programmatically fill others
        foreach ($constituencies as $constituency) {
            $existingCount = Candidate::where('constituency_id', $constituency->id)->count();
            $needed = 4 - $existingCount; 

            for ($i = 0; $i < $needed; $i++) {
                $party = $parties->random();
                $name = $firstNames[array_rand($firstNames)] . " " . $lastNames[array_rand($lastNames)];
                
                $photo = "https://ui-avatars.com/api/?name=" . urlencode($name) . "&size=256&background=random&color=fff";
                
                Candidate::create([
                    'name' => $name,
                    'name_nepali' => "उम्मेदवार " . $name,
                    'photo' => $photo,
                    'party_id' => rand(0, 6) == 0 ? null : $party->id,
                    'constituency_id' => $constituency->id,
                    'age' => rand(25, 70),
                    'gender' => rand(0, 3) == 0 ? 'Female' : 'Male',
                    'education_level' => ['Bachelor', 'Master', 'SLC'][rand(0, 2)],
                    'is_incumbent' => false,
                    'slug' => Str::slug($name) . '-' . Str::random(5),
                    'manifesto_summary' => 'Committed to local development and prosperity.',
                    'assets_declared' => ['Cash' => rand(1, 5) . 'M'],
                ]);
            }
        }
    }

    private function seedMajorLeaders()
    {
        $nc = Party::where('abbreviation', 'NC')->first();
        $uml = Party::where('abbreviation', 'CPN-UML')->first();
        $mc = Party::where('abbreviation', 'CPN-MC')->first();
        $rsp = Party::where('abbreviation', 'RSP')->first();
        $rpp = Party::where('abbreviation', 'RPP')->first();

        // Exact ages as of early 2026
        $majors = [
            [
                'name' => 'K.P. Sharma Oli',
                'slug' => 'kp-oli',
                'party' => $uml,
                'const' => 'Jhapa 5',
                'age' => 74,
                'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/d/dd/The_Prime_Minister_of_Nepal%2C_Shri_KP_Sharma_Oli_at_Bangkok%2C_in_Thailand_on_April_04%2C_2025_%28cropped%29.jpg/500px-The_Prime_Minister_of_Nepal%2C_Shri_KP_Sharma_Oli_at_Bangkok%2C_in_Thailand_on_April_04%2C_2025_%28cropped%29.jpg'
            ],
            [
                'name' => 'Sher Bahadur Deuba',
                'slug' => 'sher-bahadur-deuba',
                'party' => $nc,
                'const' => 'Dadeldhura 1',
                'age' => 79,
                'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Sher_Bahadur_Deuba_November_2021_crop.jpg/500px-Sher_Bahadur_Deuba_November_2021_crop.jpg'
            ],
            [
                'name' => 'Pushpa Kamal Dahal',
                'slug' => 'pushpa-kamal-dahal',
                'party' => $mc,
                'const' => 'Gorkha 2',
                'age' => 71,
                'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/8/88/Prime_Minister_of_Nepal_Pushpa_Kamal_Dahal_%22Prachanda%22.jpg/500px-Prime_Minister_of_Nepal_Pushpa_Kamal_Dahal_%22Prachanda%22.jpg'
            ],
            [
                'name' => 'Rabi Lamichhane',
                'slug' => 'rabi-lamichhane',
                'party' => $rsp,
                'const' => 'Chitwan 2',
                'age' => 51,
                'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/2f/Rabi_Lamichhane_RSP.jpg/500px-Rabi_Lamichhane_RSP.jpg'
            ],
            [
                'name' => 'Gagan Thapa',
                'slug' => 'gagan-thapa',
                'party' => $nc,
                'const' => 'Kathmandu 4',
                'age' => 49,
                'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/29/Gagan_Thapa_%E0%A4%97%E0%A4%97%E0%A4%A8_%E0%A4%A5%E0%A4%BE%E0%A4%AA%E0%A4%BE_Member_of_Parliament%2C_Pratinidhi_Sabha_%28cropped%29.jpg/500px-Gagan_Thapa_%E0%A4%97%E0%A4%97%E0%A4%A8_%E0%A4%A5%E0%A4%BE%E0%A4%AA%E0%A4%BE_Member_of_Parliament%2C_Pratinidhi_Sabha_%28cropped%29.jpg'
            ],
            [
                'name' => 'Toshina Karki',
                'slug' => 'toshina-karki',
                'party' => $rsp,
                'const' => 'Lalitpur 3',
                'age' => 36,
                'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Toshima_Karki_-_RSP.jpg/500px-Toshima_Karki_-_RSP.jpg'
            ],
            [
                'name' => 'Balen Shah',
                'slug' => 'balen-shah',
                'party' => null,
                'const' => 'Kathmandu 5',
                'age' => 35,
                'photo' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1e/Balen_Shah_-_Mayor_of_Kathmandu.png/500px-Balen_Shah_-_Mayor_of_Kathmandu.png'
            ]
        ];

        foreach ($majors as $m) {
            $c = Constituency::where('name', $m['const'])->first();
            if ($c) {
                Candidate::updateOrCreate(
                    ['slug' => $m['slug']],
                    [
                        'name' => $m['name'],
                        'photo' => $m['photo'],
                        'party_id' => $m['party'] ? $m['party']->id : null,
                        'constituency_id' => $c->id,
                        'is_incumbent' => true,
                        'age' => $m['age']
                    ]
                );
            }
        }
    }
}
