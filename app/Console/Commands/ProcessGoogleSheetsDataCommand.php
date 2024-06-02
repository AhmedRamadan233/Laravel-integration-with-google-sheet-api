<?php

namespace App\Console\Commands;

use App\Jobs\ProcessGoogleSheetsData;
use Illuminate\Console\Command;

class ProcessGoogleSheetsDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sheets:process';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // dd("ss");
        ProcessGoogleSheetsData::dispatch();
        $this->info('Google Sheets data processing job has been dispatched to the queue.');


    }
}
