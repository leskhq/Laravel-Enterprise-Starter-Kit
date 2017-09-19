<?php

namespace App\Console\Commands;

use App\Libraries\Str;
use Illuminate\Console\Command;
use Settings;

class SettingSetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'settings:set
                            {key       : The key to set}
                            {value?    : (Optional) The value to save for the given key, if not given the value will be asked.}
                            {--encrypt : Defaults to false, boolean flag indicates if the value should be encrypted. If the value is asked it will not show on the console.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets the value of the given setting key';

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
                $message="";
                $value = $this->argument('value');
                $encrypt = $this->option('encrypt');

                if (Str::isNullOrEmptyString($value)) {
                    if ($encrypt) {
                        $value = $this->secret('Enter secret value:');
                        $message = "Setting [$key] set to encrypted value.";
                    } else {
                        $value = $this->ask('Enter value:');
                        $message = "Setting [$key] set to [$value].";
                    }
                } else {
                    $message = "Setting [$key] set to [$value].";
                }

                Settings::set($key, $value, $encrypt);
                Settings::save();
                $this->info($message);
            } else {
                $this->error("Missing 'key' argument.");
            }
        } catch (\Exception $ex) {
            $this->error("Exception: ". $ex->getMessage());
            $this->error("Stack trace: ". $ex->getTraceAsString());
        }
    }
}
