<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Candle;

class UpdateCandlesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crf:update {entity=candles}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update candles from Oanda';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Candle::updateFromOanda(true);
    }
}
