<?php

namespace App\Console\Commands;

use App\Models\Candidate;
use App\Models\Constituency;
use App\Models\Party;
use App\Models\Province;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ScrapeKYC extends Command
{
    protected $signature = 'scrape:kyc';
    protected $description = 'Clean and Scrape all candidates and parties from knowyourcandidate.live API';

    public function handle()
    {
        error_log("Cleaning existing candidates for a fresh start...");
        Candidate::query()->delete();
        
        error_log("Starting full candidate scrape from knowyourcandidate.live...");
        
        $page = 1;
        $totalImported = 0;

        do {
            error_log("Fetching page $page...");
            $response = Http::get("https://www.knowyourcandidate.live/api/candidates", [
                'page' => $page,
                'perPage' => 100
            ]);

            if (!$response->successful()) {
                error_log("Failed to fetch page $page");
                break;
            }

            $data = $response->json();
            $items = $data['data']['items'] ?? [];
            
            foreach ($items as $item) {
                $province = Province::firstOrCreate(
                    ['name' => $item['province_name']],
                    ['number' => $this->getProvinceNumber($item['province_name'])]
                );

                $constituencyName = $item['district_name'] . ' ' . $item['constituency_number'];
                $constituency = Constituency::updateOrCreate(
                    ['name' => $constituencyName],
                    [
                        'number' => $item['constituency_number'],
                        'province_id' => $province->id,
                        'district' => $item['district_name'],
                        'type' => 'FPTP'
                    ]
                );

                $partyName = $this->normalizePartyName($item['party_name_en']);
                $party = null;
                
                if ($partyName !== 'Independent') {
                    $party = Party::updateOrCreate(
                        ['name' => $partyName],
                        [
                            'name_nepali' => $item['party_name_np'] ?? $partyName,
                            'abbreviation' => $this->generateAbbreviation($partyName),
                            'color_hex' => $this->getPartyColor($partyName),
                            'is_active' => true
                        ]
                    );
                }

                $ecId = $item['ec_candidate_id'] ?? $item['id'];
                $photo = "https://www.knowyourcandidate.live/candidates_profile/{$ecId}.jpg";

                Candidate::create([
                    'name' => $item['name_en'],
                    'name_nepali' => $item['name_np'],
                    'photo' => $photo,
                    'party_id' => $party ? $party->id : null,
                    'constituency_id' => $constituency->id,
                    'age' => $item['age_at_election'],
                    'gender' => $item['gender'],
                    'address' => $item['address_np'],
                    'education_level' => $this->parseEducationLevel($item['qualification_detail_np']),
                    'education_details' => $item['qualification_detail_np'],
                    'view_count' => $item['view_count'] ?? 0,
                    'is_incumbent' => ($item['vote_rank'] == 1),
                    'slug' => Str::slug($item['name_en']) . '-' . $ecId,
                ]);

                $totalImported++;
            }

            $pagination = $data['data']['pagination'];
            $hasNext = $pagination['hasNext'];
            $page++;

        } while ($hasNext);

        $this->fixMajorLeaders();

        error_log("Completed! Imported $totalImported candidates.");
    }

    private function parseEducationLevel($details)
    {
        return \App\Models\DataAlias::resolve($details, 'education');
    }

    private function fixMajorLeaders()
    {
        error_log("Applying final corrections for major leaders...");

        $leaders = [
            'kp-oli' => [
                'name' => 'K.P. Sharma Oli',
                'party' => 'CPN (Unified Marxist–Leninist)',
                'constituency' => 'Jhapa 5',
                'age' => 74,
                'is_incumbent' => true,
                'education_level' => 'Political Career'
            ],
            'balen-shah' => [
                'name' => 'Balen Shah',
                'party' => 'Rastriya Swatantra Party', // Updated per user request
                'constituency' => 'Jhapa 5', // Updated per user request
                'age' => 36,
                'is_incumbent' => true,
                'education_level' => 'Bachelor\'s Degree'
            ],
            'gagan-thapa' => [
                'name' => 'Gagan Kumar Thapa',
                'party' => 'Nepali Congress',
                'constituency' => 'Kathmandu 4',
                'age' => 49,
                'is_incumbent' => true,
                'education_level' => 'Master\'s Degree'
            ],
            'rabi-lamichhane' => [
                'name' => 'Rabi Lamichhane',
                'party' => 'Rastriya Swatantra Party',
                'constituency' => 'Chitwan 2',
                'age' => 51,
                'is_incumbent' => true,
                'education_level' => 'Undergraduate'
            ]
        ];

        foreach ($leaders as $key => $data) {
            // Find candidate by name
            $candidate = Candidate::where('name', 'ilike', '%' . $data['name'] . '%')->first();

            if ($candidate) {
                $party = Party::where('name', $data['party'])->first();
                $const = Constituency::where('name', $data['constituency'])->first();

                $candidate->update([
                    'party_id' => $party ? $party->id : $candidate->party_id,
                    'constituency_id' => $const ? $const->id : $candidate->constituency_id,
                    'age' => $data['age'],
                    'is_incumbent' => $data['is_incumbent'],
                    'education_level' => $data['education_level']
                ]);
                error_log("Fixed: " . $candidate->name);
            }
        }
    }

    private function normalizePartyName($name)
    {
        if (!$name || $name === 'Independent' || $name === 'स्वतन्त्र') return 'Independent';
        
        $name = str_replace([' (RSP)', ' (UML)', ' (Maoist)'], '', $name);
        
        if (Str::contains($name, 'Nepali Congress')) return 'Nepali Congress';
        if (Str::contains($name, 'Rastriya Swatantra Party')) return 'Rastriya Swatantra Party';
        if (Str::contains($name, 'CPN (Unified Marxist') || Str::contains($name, 'CPN (UML)')) return 'CPN (Unified Marxist–Leninist)';
        if (Str::contains($name, 'CPN (Maoist Centre)') || Str::contains($name, 'Maoist')) return 'CPN (Maoist Centre)';
        if (Str::contains($name, 'Rastriya Prajatantra Party')) return 'Rastriya Prajatantra Party';
        if (Str::contains($name, 'Janata Samajwadi Party')) return 'Janata Samajwadi Party';

        return $name;
    }

    private function getPartyColor($name)
    {
        $colors = [
            'Nepali Congress' => '#FF0000',
            'Rastriya Swatantra Party' => '#00ADEF',
            'CPN (Unified Marxist–Leninist)' => '#FF0000',
            'CPN (Maoist Centre)' => '#FF0000',
            'Rastriya Prajatantra Party' => '#FFFF00',
            'Janata Samajwadi Party' => '#00FF00',
        ];
        return $colors[$name] ?? '#' . substr(md5($name), 0, 6);
    }

    private function getProvinceNumber($name)
    {
        $map = [
            'Koshi Province' => 1,
            'Madhesh Province' => 2,
            'Bagmati Province' => 3,
            'Gandaki Province' => 4,
            'Lumbini Province' => 5,
            'Karnali Province' => 6,
            'Sudurpashchim Province' => 7,
        ];
        return $map[$name] ?? 0;
    }

    private function generateAbbreviation($name)
    {
        $manual = [
            'Nepali Congress' => 'NC',
            'Rastriya Swatantra Party' => 'RSP',
            'CPN (Unified Marxist–Leninist)' => 'CPN-UML',
            'CPN (Maoist Centre)' => 'CPN-MC',
            'Rastriya Prajatantra Party' => 'RPP',
            'Janata Samajwadi Party' => 'JSP',
        ];

        if (isset($manual[$name])) return $manual[$name];

        $words = explode(' ', $name);
        $abbr = '';
        foreach ($words as $w) {
            if (in_array(strtolower($w), ['of', 'the', 'and'])) continue;
            $abbr .= strtoupper(substr($w, 0, 1));
        }
        return $abbr ?: strtoupper(substr($name, 0, 3));
    }
}
