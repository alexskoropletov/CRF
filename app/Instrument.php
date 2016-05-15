<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Lib\OandaApi;

class Instrument extends Model
{
    public static function getOandaList() {
        $list = [];
        if($response = OandaApi::getInstrumentList()) {
            $response = json_decode($response, true);
            foreach($response['instruments'] as $item) {
                $list[$item['instrument']] = $item;
            }
        }
        return $list;
    }

    public static function updateFromOanda() {
        $oandaList = self::getOandaList();
        $list = array_map(function($item) {
            return $item['code'];
        }, self::all()->toArray());
        foreach ($oandaList as $val) {
            if (!in_array($val['instrument'], $list)) {
                $item = new Instrument();
                $item->code = $val['instrument'];
                $item->name = $val['displayName'];
                $item->pip = $val['pip'];
                $item->maxTradeUnits = $val['maxTradeUnits'];
                $item->save();
            }
        }
    }
}
