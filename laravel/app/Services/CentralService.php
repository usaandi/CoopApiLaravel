<?php

namespace App\Services;

use GuzzleHttp\Client;


class CentralService
{

    protected $client;
    protected $data;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://192.168.99.100:3000']);

    }

    public function handle($pageData)
    {
        var_dump(json_encode($pageData));
        $this->data = $pageData;

    }
}