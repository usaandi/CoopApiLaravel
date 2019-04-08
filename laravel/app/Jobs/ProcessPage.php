<?php

namespace App\Jobs;

use App\Services\coopService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessPage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var coopService
     */
    protected $coopService;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(coopService $coop)
    {
        $this->coopService = $coop;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
    }
}
