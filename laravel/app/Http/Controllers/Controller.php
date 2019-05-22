<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPage;
use App\Services\CoopService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $currentPage = 1;


    /**
     * Controller constructor.
     * @param int $currentPage
     */
    public function __construct()
    {

    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     */
    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }


    public function pageInfo(CoopService $coopService)
    {
        $data = $coopService->page($this->currentPage);

        $itemCount = $data->count;
        $perPage = count($data->results);
        $maxPage = (int)ceil($itemCount / $perPage);
        if ($maxPage !== null) {
            for ($i = $this->currentPage; $i <= $maxPage; $i++) {


                ProcessPage::dispatch($this->currentPage);
            }
        }


    }
}
