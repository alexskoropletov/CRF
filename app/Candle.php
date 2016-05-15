<?php

namespace App;

use App\Lib\OandaApi;
use Illuminate\Database\Eloquent\Model;
use App\Instrument;

class Candle extends Model
{
    public static function getOandaList($instrument, $startFrom) {
        $list = [];
        if($response = OandaApi::getCandleList($instrument, $startFrom)) {
            $list = json_decode($response, true)['candles'];
        }
        return $list;
    }

    public static function updateFromOanda($debug = false) {
        $instrumentList = Instrument::where('update', '=', 1)->get();
        foreach($instrumentList as $instrument) {
            self::trace(sprintf("Updating candles for %s", $instrument->name), $debug);
            $startFrom = '2000-01-01T00:00:00Z';
            if ($lastCandle = Candle::where("instrument", "=", $instrument->id)->orderBy('time', 'DESC')->first()) {
                $startFrom = str_replace(" ", "T", $lastCandle->time) . "Z";
            }
            $oandaList = Candle::getOandaList($instrument->code, $startFrom);
            foreach ($oandaList as $candle) {
                self::trace($candle['time'], $debug);
                $item = new Candle();
                $item->instrument = $instrument->id;
                $item->time = $candle['time'];
                $item->cost = serialize($candle);
                $item->save();
            }
            self::trace(sprintf("Candles for %s updated", $instrument->name), $debug);
            sleep(1);
        }
    }

    public static function trace($text, $debug = false) {
        if ($debug) {
            echo $text . PHP_EOL;
        }
    }
}
