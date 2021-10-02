<?php

namespace App\Observers;

use App\Events;
use App\Jobs\AtualizaOdds;
class EventObserver
{
    /**
     * Handle the events "created" event.
     *
     * @param  \App\Events  $events
     * @return void
     */
    public function created(Events $events)
    {
        AtualizaOdds::dispatch($events);
    }

    /**
     * Handle the events "updated" event.
     *
     * @param  \App\Events  $events
     * @return void
     */
    public function updated(Events $events)
    {
        // AtualizaOdds::dispatch($events);
    }

    /**
     * Handle the events "deleted" event.
     *
     * @param  \App\Events  $events
     * @return void
     */
    public function deleted(Events $events)
    {
        //
    }

    /**
     * Handle the events "restored" event.
     *
     * @param  \App\Events  $events
     * @return void
     */
    public function restored(Events $events)
    {
        //
    }

    /**
     * Handle the events "force deleted" event.
     *
     * @param  \App\Events  $events
     * @return void
     */
    public function forceDeleted(Events $events)
    {
        //
    }
}
