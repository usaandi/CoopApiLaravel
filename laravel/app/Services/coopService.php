<?php
/**
 * Created by PhpStorm.
 * User: opilane
 * Date: 08.04.2019
 * Time: 14:00
 */

namespace App\Services;


use GuzzleHttp\Client;

use Illuminate\Support\Facades\Cache;

class coopService
{
    /**
     * @var Client
     */
    private $client;

    /**
     * coopService constructor.
     * @param Client $client ,
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function page($pageNumber)
    {
        $data = $this->getPageData($pageNumber);

        if ($data !== null) {
            return \GuzzleHttp\json_decode($data);
        }
    }

    /**
     *
     * @param $page
     * @return mixed
     */
    protected function getCache($page)
    {
        if (Cache::has($page)) {
            return (Cache::get($page));
        } else {
            return null;
        }
    }

    protected function storeCache($page, $data)
    {
        Cache::put($page, $data, now()->addHours(48));
        return Cache::get($page);

    }

    protected function getPageData($pageNumber)
    {
        $dataFromCache = null;
        if ($pageNumber) {
            $dataFromCache = $this->getCache($pageNumber);
            if ($dataFromCache !== null) {
                return $dataFromCache;
            } else {
                $response = $this->client->get('https://ecoop.ee/api/v1/products?page=' . $pageNumber);
                $data = $response->getBody()->getContents();

                return $dataFromCache = $this->storeCache($pageNumber, $data);
            }
        }
        return null;

    }

}