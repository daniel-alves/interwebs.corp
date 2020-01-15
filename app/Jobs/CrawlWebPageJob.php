<?php

namespace App\Jobs;

use App\WebPage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CrawlWebPageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $webPage;

    /**
     * Create a new job instance.
     *
     * @param WebPage $webPage
     * @return void
     */
    public function __construct(WebPage $webPage)
    {
        $this->webPage = $webPage;
    }

    /**
     * Execute the job
     *
     * @throws \Exception
     */
    public function handle()
    {
        Log::channel('crawler')->info("Start crawling Web Page: ", [$this->webPage["address"]]);

        $client = new Client();
        $result = $client->get($this->webPage["address"]);

        $date = new \DateTime('now');

        $this->webPage["status_code"] = $result->getStatusCode();
        $this->webPage["visited_at"] = $date->format("Y-m-d H:i:s");

        Storage::put("/webpages/{$this->webPage["id"]}", $result->getBody());

        $this->webPage->update();
        Log::channel('crawler')->info("End crawling Web Page!");
    }
}
