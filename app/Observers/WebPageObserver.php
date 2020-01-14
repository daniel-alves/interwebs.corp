<?php

namespace App\Observers;

use App\WebPage;
use App\Jobs\CrawlWebPageJob;

class WebPageObserver
{
    /**
     * Handle the web page "created" event.
     *
     * @param  \App\WebPage  $webPage
     * @return void
     */
    public function created(WebPage $webPage)
    {
        CrawlWebPageJob::dispatch($webPage);
    }

    /**
     * Handle the web page "updated" event.
     *
     * @param  \App\WebPage  $webPage
     * @return void
     */
    public function updated(WebPage $webPage)
    {
        if (is_null($webPage["visited_at"]))
            CrawlWebPageJob::dispatch($webPage);
    }

    /**
     * Handle the web page "deleted" event.
     *
     * @param  \App\WebPage  $webPage
     * @return void
     */
    public function deleted(WebPage $webPage)
    {
        //
    }

    /**
     * Handle the web page "restored" event.
     *
     * @param  \App\WebPage  $webPage
     * @return void
     */
    public function restored(WebPage $webPage)
    {
        //
    }

    /**
     * Handle the web page "force deleted" event.
     *
     * @param  \App\WebPage  $webPage
     * @return void
     */
    public function forceDeleted(WebPage $webPage)
    {
        //
    }
}
