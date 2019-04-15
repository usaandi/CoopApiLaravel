<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPage;
use App\Services\coopService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Carbon\Carbon;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $currentPage;


    /**
     * Controller constructor.
     * @param int $currentPage
     */
    public function __construct(int $currentPage = 1)
    {
        $this->currentPage = $currentPage;
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


    public function pageInfo(coopService $coopService)
    {
        $arrayData = [];
        $data = $coopService->page($this->getCurrentPage());
        foreach ($data->results as $product) {
            $imageUrl = $product->images[0]->productimage;
            $arrayData  [] = [
                'name' => $product->name,
                'content_quantity' => $product->content_quantity,
                'weight_count_unit' => $product->weight_count_unit,
                'measure_unit' => $product->measure_unit,
                'brand_name' => $product->brand_name,
                'sell_price' => $product->sell_price,
                'productimage_url' => $imageUrl,

            ];
        };
        dd($arrayData);


        $itemCount = $data->count;
        $perPage = count($data->results);
        $maxPage = (int)ceil($itemCount / $perPage);

        if ($maxPage !== null) {
            for ($i = 1; $i <= $maxPage; $i++) {
                $this->setCurrentPage($i);
                //ProcessPage::dispatch($this->getCurrentPage());
            }
        }


    }
}
