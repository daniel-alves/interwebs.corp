<?php

namespace App\Jobs;

use App\WebPage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use GuzzleHttp\Client;
use \Illuminate\Http\Response;

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
        $client = new Client();
        $result = $client->get($this->webPage["address"]);

        $date = new \DateTime('now');

        $this->webPage["status_code"] = $result->getStatusCode();
        $this->webPage["content"] = $result->getBody();
        $this->webPage["visited_at"] = $date->format("Y-m-d H:i:s");

        $this->webPage->update();
    }
}
