<?php

namespace App\Jobs;

use App\WebPage;
use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
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

        try {
            $client = new Client(['http_errors' => false, 'connect_timeout' => 5.0, 'read_timeout' => 5.0, 'timeout' => 5]);
            $result = $client->get($this->webPage["address"]);

            $this->updateWebPage($result->getStatusCode());

            $this->saveFile($result->getBody()->getContents());

        } catch(\Exception $e) {
            Log::channel('crawler')->error($e->getMessage());
        }

        Log::channel('crawler')->info("End crawling Web Page!");
    }

    /**
     * update the status code and visit date in the WebPage record
     *
     * @param int $statusCode
     * @throws \Exception
     */
    private function updateWebPage($statusCode) {
        $date = new \DateTime('now');

        $this->webPage["status_code"] = $statusCode;
        $this->webPage["visited_at"] = $date->format("Y-m-d H:i:s");

        $this->webPage->update();
    }

    /**
     * process the crawled web page HTML and saves in the public storage
     *
     * @param string $pageContents
     */
    private function saveFile($pageContents) {
        $dom = new \DOMDocument();

        //desabilita um warning que gera pq o documento carregado é HTML 5 mas não tem a tag DOCTYPE
        \libxml_use_internal_errors(true);
        $dom->loadHTML($pageContents);
        \libxml_use_internal_errors(false);

        //remove todos os javascripts
        $allScripts = $dom->getElementsByTagName("script");
        foreach ($allScripts as $script) {
            $script->parentNode->removeChild($script);
        }

        //remove a ação dos links
        $allLinks = $dom->getElementsByTagName("a");
        foreach ($allLinks as $link) {
            $link->setAttribute('href', 'javascript:;');
        }

        if ($this->webPage["status_code"] == Response::HTTP_OK) {
            Storage::disk('public')->put("/webpages/{$this->webPage["id"]}.html", $dom->saveHTML());
        }
    }
}
