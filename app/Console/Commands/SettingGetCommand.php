<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Setting;

class SettingGetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setting:get {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieves the value of the given setting key';

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
            if ($key = $this->argument('key')) {
                $this->line($key . "=" . Setting::get($key));
            } else {
                $this->error("Missing 'key' argument.");
            }
        } catch (\Exception $ex) {
            $this->error("Exception: ". $ex->getMessage());
            $this->error("Stack trace: ". $ex->getTraceAsString());
        }
    }
}
