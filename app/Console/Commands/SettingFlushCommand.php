<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Settings;

class SettingFlushCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:flush';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush and forget all settings';

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
        try {
            Settings::flush();
            Settings::save();
            $this->info("Settings flushed.");
        } catch (\Exception $ex) {
            $this->error("Exception: ". $ex->getMessage());
            $this->error("Stack trace: ". $ex->getTraceAsString());
        }
    }
}
