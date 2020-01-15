<?php

namespace App\Observers;

use App\WebPage;
use App\Jobs\CrawlWebPageJob;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class WebPageObserver
{
    /**
     * Handle the web page "created" event.
     *
     * @param \App\WebPage $webPage
     * @return void
     */
    public function created(WebPage $webPage)
    {
        Log::channel('crawler')->info("Web Page Created: ", [$webPage->id, $webPage->address]);
        CrawlWebPageJob::dispatch($webPage);
    }

    /**
     * Handle the web page "updated" event.
     *
     * @param \App\WebPage $webPage
     * @return void
     */
    public function updated(WebPage $webPage)
    {
        $changes = $webPage->getDirty();

        if (array_key_exists("address", $changes)) {
            Log::channel('crawler')->info("Web Page Updated: ", [$webPage->id, $webPage->address]);
            CrawlWebPageJob::dispatch($webPage);
        }
    }

    /**
     * Handle the web page "deleted" event.
     *
     * @param \App\WebPage $webPage
     * @return void
     */
    public function deleted(WebPage $webPage)
    {
        Log::channel('crawler')->info("Web Page Deleted: ", [$webPage->id, $webPage->address]);
        Storage::disk('public')->delete("/webpages/{$webPage->id}.html");
    }

    /**
     * Handle the web page "restored" event.
     *
     * @param \App\WebPage $webPage
     * @return void
     */
    public function restored(WebPage $webPage)
    {
        //
    }

    /**
     * Handle the web page "force deleted" event.
     *
     * @param \App\WebPage $webPage
     * @return void
     */
    public function forceDeleted(WebPage $webPage)
    {
        //
    }
}
