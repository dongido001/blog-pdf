<?php

namespace App\Http\Helpers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use GuzzleHttp\Client;

class Helper
{
    public static function Request($endpoint, $method = 'GET') {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $endpoint,
        ]);

        $response = $client->request($method, $endpoint)->getBody();

        return $response;
    }
}
