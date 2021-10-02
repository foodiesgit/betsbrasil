<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Events;
class AtualizaOdds implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    private $event;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Events $event)
    {
        $this->event = $event;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        app('App\Http\Controllers\ApiController')->atualizaOdds($this->event->id);
        app('App\Http\Controllers\ApiController')->somaTotalOdds($this->event->id);
    }
}
