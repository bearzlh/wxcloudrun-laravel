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
            $result = $client->request('POST', '/wxa/generatescheme',
                [
                'json' => [
                    "is_expire"=>true,
                    "expire_type"=>1,
                    "expire_interval"=>1,
                    "env_version"=>"release"
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
