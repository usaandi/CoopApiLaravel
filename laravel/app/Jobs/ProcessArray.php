<?php

namespace App\Jobs;

use App\Services\CentralService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class ProcessArray
 * @package App\Jobs
 */
class ProcessArray implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var
     */
    protected $data;


    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */

    public function getData()
    {
        return $this->data;
    }

    /**
     * Execute the job.
     *
     * @param CentralService $centralService
     * @return void
     */
    public function handle(CentralService $centralService)
    {
        $centralService->handle($this->getData());

    }
}
