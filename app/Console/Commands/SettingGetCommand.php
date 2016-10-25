<?php

namespace App\Console\Commands;

use App\Libraries\Arr;
use App\Libraries\Str;
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
                $value = Setting::get($key);
                if (Str::isNullOrEmptyString($value)) {
                    $this->comment("No setting found or empty setting.");
                } else if (is_array($value)) {
                    $value = Arr::dot($value);
                    foreach($value as $key2 => $value2) {
                        $this->line("$key.$key2=$value2");
                    }
                } else {
                    $this->line($key . "=" . $value);
                }
            } else {
                $this->error("Missing 'key' argument.");
            }
        } catch (\Exception $ex) {
            $this->error("Exception: ". $ex->getMessage());
            $this->error("Stack trace: ". $ex->getTraceAsString());
        }
    }
}
