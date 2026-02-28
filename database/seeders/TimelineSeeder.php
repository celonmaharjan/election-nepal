<?php

namespace Database\Seeders;

use App\Models\ElectionTimeline;
use Illuminate\Database\Seeder;

class TimelineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timelines = [
            [
                'date' => '2026-01-01',
                'title' => 'Voter List Updates',
                'description' => 'Final update of the voter registration list by the Election Commission.',
                'is_completed' => true,
            ],
            [
                'date' => '2026-02-05',
                'title' => 'Candidate Nomination',
                'description' => 'Official nomination of candidates for both FPTP and PR systems.',
                'is_completed' => false,
            ],
            [
                'date' => '2026-03-05',
                'title' => 'Election Day',
                'description' => 'Voting begins across all constituencies of Nepal.',
                'is_completed' => false,
            ],
            [
                'date' => '2026-03-15',
                'title' => 'Result Declaration',
                'description' => 'Estimated date for the final declaration of results for all seats.',
                'is_completed' => false,
            ],
        ];

        foreach ($timelines as $timeline) {
            ElectionTimeline::create($timeline);
        }
    }
}
