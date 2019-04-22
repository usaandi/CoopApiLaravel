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

/**
 * Class coopService
 * @package App\Services
 */
class coopService
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * coopService constructor.
     *
     */
    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://ecoop.ee/api/v1/products']);
    }

    public function page($pageNumber)
    {
        $data = $this->getPageData($pageNumber);

        if ($data !== null) {
            return \GuzzleHttp\json_decode($data);
        }
        return null;
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
        }
        return null;

    }

    protected function storeCache($page, $data)
    {
        Cache::put($page, $data, now()->addHours(1));
        return Cache::get($page);

    }

    protected function getPageData($pageNumber)
    {

        $params = [
            'query' => [
                'page' => $pageNumber
            ]];

        $dataFromCache = null;
        if ($pageNumber) {
            $dataFromCache = $this->getCache($pageNumber);
            if ($dataFromCache !== null) {

                return $dataFromCache;
            } else {

                $response = $this->client->request('GET', '', $params);
                $data = $response->getBody()->getContents();
                return $dataFromCache = $this->storeCache($pageNumber, $data);
            }
        }
        return $dataFromCache;

    }

}