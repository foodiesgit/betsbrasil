<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ResultJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $jogos;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($jogos)
    {
        $this->jogos = $jogos;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        

    }
}
