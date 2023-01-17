<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class Wechat extends Controller
{
    public function generateScheme()
    {
        try {
            $client = new Client([
                'base_uri' => 'http://api.weixin.qq.com',
                'connect_timeout' => 10,
                'timeout' => 30,
            ]);
            $result = $client->request('POST', '/wxa/generatescheme',                 [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'charset' => 'utf-8'
                ]
            ]);
            $result = json_decode($result->getBody(), true);
            Log::info(json_encode($result));
            return $result;
        }catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return "error";
    }
}
