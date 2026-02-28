<?php

namespace App\Services;

use App\Models\NewsArticle;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use SimpleXMLElement;

class ScraperService
{
    public function scrapeFromRSS()
    {
        $feeds = [
            'Online Khabar' => 'https://www.onlinekhabar.com/feed',
            'Kathmandu Post' => 'https://kathmandupost.com/rss'
        ];

        foreach ($feeds as $source => $url) {
            try {
                $response = Http::get($url);
                if ($response->successful()) {
                    $xml = new SimpleXMLElement($response->body());
                    $items = $xml->channel->item;

                    foreach ($items as $item) {
                        $title = (string) $item->title;
                        
                        // Only save if it looks related to politics/election
                        if (Str::contains(strtolower($title), ['election', 'politics', 'party', 'minister', 'vote', 'candidate', 'nepal'])) {
                            NewsArticle::updateOrCreate(
                                ['title' => $title],
                                [
                                    'slug' => Str::slug($title) . '-' . Str::random(5),
                                    'summary' => (string) $item->description,
                                    'content' => (string) $item->description,
                                    'source' => $source,
                                    'source_url' => (string) $item->link,
                                    'published_at' => date('Y-m-d H:i:s', strtotime((string) $item->pubDate)),
                                    'category' => 'National',
                                    'is_featured' => false
                                ]
                            );
                        }
                    }
                }
            } catch (\Exception $e) {
                \Log::error("RSS Scrape Error for $source: " . $e->getMessage());
            }
        }
    }

    public function scrapeNews()
    {
        // Keeping the mock version for safety, but primary will be RSS
        $this->scrapeFromRSS();
    }
}
