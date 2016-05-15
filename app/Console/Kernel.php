<?php

namespace App\Console;

use App\Candle;
use App\Instrument;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\UpdateCandlesCommand::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function() {
            Instrument::updateFromOanda();
        })->hourly();
        $schedule->call(function() {
            Candle::updateFromOanda();
        })->hourly();
    }
}
