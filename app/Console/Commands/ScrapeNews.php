<?php

namespace App\Console\Commands;

use App\Services\ScraperService;
use Illuminate\Console\Command;

class ScrapeNews extends Command
{
    protected $signature = 'scrape:news';
    protected $description = 'Scrape latest election news from official sources';

    public function handle(ScraperService $scraper)
    {
        $this->info('Starting news scrape...');
        $scraper->scrapeNews();
        $this->info('News scrape completed successfully.');
    }
}
