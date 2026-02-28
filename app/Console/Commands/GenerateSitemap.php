<?php

namespace App\Console\Commands;

use App\Models\Candidate;
use App\Models\Constituency;
use App\Models\Party;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the XML sitemap for SEO';

    public function handle()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setPriority(1.0)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY))
            ->add(Url::create('/candidates')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/parties')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/constituencies')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY))
            ->add(Url::create('/results')->setPriority(0.9)->setChangeFrequency(Url::CHANGE_FREQUENCY_HOURLY))
            ->add(Url::create('/how-it-works')->setPriority(0.7)->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY))
            ->add(Url::create('/news')->setPriority(0.8)->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY));

        Candidate::all()->each(function (Candidate $candidate) use ($sitemap) {
            $sitemap->add(Url::create("/candidates/{$candidate->slug}")->setPriority(0.6));
        });

        Party::all()->each(function (Party $party) use ($sitemap) {
            $sitemap->add(Url::create("/parties/{$party->id}")->setPriority(0.6));
        });

        Constituency::all()->each(function (Constituency $constituency) use ($sitemap) {
            $sitemap->add(Url::create("/constituencies/{$constituency->id}")->setPriority(0.6));
        });

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully.');
    }
}
