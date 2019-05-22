<?php

namespace App\Console\Commands;

use App\Jobs\ProcessPage;
use App\Services\CoopService;
use Illuminate\Console\Command;

class Fetch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:api {start=1} {length?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve data from Coop Api ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(CoopService $coopService)
    {
        $start = (int) $this->argument('start');
        $length = (int) $this->argument('length');

        $data = $coopService->page($start);

        $itemCount = $data->count;
        $perPage = count($data->results);
        $maxPage = (int)ceil($itemCount / $perPage);
        if($length) {
            $maxPage = $start + $length;
        }
        if ($maxPage !== null) {
            for ($i = $start; $i <= $maxPage; $i++) {

                ProcessPage::dispatch($i);
            }
        }
    }
}
