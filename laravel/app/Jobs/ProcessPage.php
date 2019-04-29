<?php

namespace App\Jobs;

use App\Services\coopService;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class ProcessPage
 * @package App\Jobs
 */
class ProcessPage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    protected $pageNumber;


    public function __construct($pageNumber)
    {

        $this->pageNumber = $pageNumber;
    }

    /**
     * @return mixed
     */
    public function getPageNumber()
    {
        return $this->pageNumber;
    }

    /**
     * @param mixed $pageNumber
     */
    public function setPageNumber($pageNumber): void
    {
        $this->pageNumber = $pageNumber;
    }


    public function handle(coopService $coopApiService)
    {
        $arrayData = [];
        $data = $coopApiService->page($this->getPageNumber());


        foreach ($data->results as $product) {
            $imageUrl = $product->images[0]->productimage;
            $arrayData   = [
                'name' => $product->name,
                'content_quantity' => $product->content_quantity,
                'weight_count_unit' => $product->weight_count_unit,
                'measure_unit' => $product->measure_unit,
                'brand_name' => $product->brand_name,
                'sell_price' => $product->sell_price,
                'productimage_url' => $imageUrl,

            ];

            ProcessArray::dispatch($arrayData);

        };



    }
}
