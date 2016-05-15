<?php

namespace App\Lib;

use Guzzle\Http\Client;
use Illuminate\Support\Facades\Config;

class OandaApi {

    public static function getInstrumentList() {
        return self::request('instruments', ['accountId' => Config::get('oanda.account_id')]);
    }

    public static function getCandleList($instrument, $startFrom) {
        return self::request(
            'candles',
            [
                'instrument' => $instrument,
                'granularity' => 'H2',
                'count' => '1000',
                'start' => $startFrom,
                'includeFirst' => 'false'
            ]
        );
    }

    public static function request($command = '', $parameters = []) {
        $client = new Client();
        $res = $client->get(self::getUrl($command, $parameters));
        $res->addHeader('Authorization', 'Bearer ' . Config::get('oanda.token'));
        $response = $res->send();
        if($response->getStatusCode() == 200) {
            return $response->getBody(true);
        }
    }

    public static function getUrl($command = '', $parameters = []) {
        $url = Config::get('oanda.api') . $command;
        if (count($parameters)) {
            $url .= "?" . implode("&", array_map(
                    function($value, $key) {
                        return $key . "=" . $value;
                    },
                    $parameters,
                    array_keys($parameters))
                );
        }
        return $url;
    }
}