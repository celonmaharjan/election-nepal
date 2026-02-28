<?php

namespace App\Console\Commands;

use App\Models\Candidate;
use App\Models\Constituency;
use App\Models\Party;
use Illuminate\Console\Command;
use DOMDocument;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ImportRealCandidates extends Command
{
    protected $signature = 'import:real-candidates';
    protected $description = 'Import real candidates from Wikipedia HTML and fetch real photos';

    public function handle()
    {
        $file = base_path('election_2022.html');
        if (!file_exists($file)) {
            $this->error("File not found: $file");
            return;
        }

        $html = file_get_contents($file);
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        
        $tables = $dom->getElementsByTagName('table');
        $foundTable = null;

        foreach ($tables as $table) {
            $headerText = $table->textContent;
            if (str_contains($headerText, 'Constituency') && str_contains($headerText, 'Elected MP') && str_contains($headerText, 'Party')) {
                $foundTable = $table;
                break;
            }
        }

        if (!$foundTable) {
            $this->error("Results table not found.");
            return;
        }

        $rows = $foundTable->getElementsByTagName('tr');
        $count = 0;

        foreach ($rows as $row) {
            $cols = $row->getElementsByTagName('td');
            
            if ($cols->length >= 4) {
                $constituencyName = trim($cols->item(0)->textContent);
                $candidateName = trim($cols->item(1)->textContent);
                $partyName = trim($cols->item(3)->textContent);

                $candidateName = preg_replace('/\[.*?\]/', '', $candidateName);
                $candidateName = trim($candidateName);
                
                if (empty($constituencyName) || empty($candidateName)) continue;

                $constituency = Constituency::where('name', $constituencyName)->first();

                if ($constituency) {
                    $party = Party::where('name', 'like', '%' . $partyName . '%')
                        ->orWhere('abbreviation', 'like', '%' . $partyName . '%')
                        ->first();
                    
                    if (!$party) {
                        if (str_contains($partyName, 'Congress')) $party = Party::where('abbreviation', 'NC')->first();
                        if (str_contains($partyName, 'UML')) $party = Party::where('abbreviation', 'CPN-UML')->first();
                        if (str_contains($partyName, 'Maoist')) $party = Party::where('abbreviation', 'CPN-MC')->first();
                    }

                    // Fetch real photo URL from Wikipedia API
                    $photo = $this->getWikiPhoto($candidateName);

                    Candidate::updateOrCreate(
                        ['constituency_id' => $constituency->id, 'is_incumbent' => true],
                        [
                            'name' => $candidateName,
                            'name_nepali' => $candidateName, 
                            'party_id' => $party ? $party->id : null,
                            'photo' => $photo ?: 'https://ui-avatars.com/api/?name=' . urlencode($candidateName) . '&size=256&background=random',
                            'slug' => Str::slug($candidateName) . '-' . Str::random(5),
                            'is_incumbent' => true
                        ]
                    );
                    $this->info("Imported: $candidateName ($constituencyName)");
                    $count++;
                }
            }
        }

        $this->info("Imported $count real winning candidates with photos.");
    }

    private function getWikiPhoto($name)
    {
        try {
            $response = Http::get("https://en.wikipedia.org/w/api.php", [
                'action' => 'query',
                'titles' => $name,
                'prop' => 'pageimages',
                'format' => 'json',
                'pithumbsize' => 500,
                'redirects' => 1
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $pages = $data['query']['pages'] ?? [];
                foreach ($pages as $page) {
                    if (isset($page['thumbnail']['source'])) {
                        return $page['thumbnail']['source'];
                    }
                }
            }
        } catch (\Exception $e) {
            return null;
        }
        return null;
    }
}
