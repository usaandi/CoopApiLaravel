<?php

namespace App\Services;

use GuzzleHttp\Client;


class CentralService
{

    protected $client;
    protected $data;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => '']);

    }

    public function handle($pageData)
    {
        $this->data = $pageData;

    }
}