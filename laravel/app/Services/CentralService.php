<?php

namespace App\Services;

use GuzzleHttp\Client;


class CentralService
{

    protected $client;
    const KUB_BASE_URI = '35.205.172.130';

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'https://' . self::KUB_BASE_URI, 'verify' => false]);

    }

    public function handle($pageData)
    {

        /*$jsonData = json_encode($pageData);*/
        $request = $this->client->request('POST', '/add', ['json' => $pageData]);
        dump($request);


    }
}