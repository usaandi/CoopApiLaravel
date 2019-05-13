<?php

namespace App\Services;

use GuzzleHttp\Client;


class CentralService
{

    protected $client;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => 'http://192.168.99.100:3000']);

    }

    public function handle($pageData)
    {

        $jsonData = json_encode($pageData);
        var_dump(json_encode($pageData));
        $request =$this->client->request('POST', '/add', ['json' =>  $pageData ]);
        echo $request;
        /*  var_dump($request);*/

    }
}