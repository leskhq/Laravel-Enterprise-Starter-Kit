<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Setting;

class SettingClearCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setting:clear';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clear and forget all settings';

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
            Setting::clear();
            Setting::save();
            $this->info("Settings cleared.");
        } catch (\Exception $ex) {
            $this->error("Exception: ". $ex->getMessage());
            $this->error("Stack trace: ". $ex->getTraceAsString());
        }
    }
}
