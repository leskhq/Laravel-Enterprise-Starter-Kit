<?php

namespace App\Console\Commands;

use App\Exceptions\FileNotFoundException;
use App\Libraries\Str;
use Illuminate\Console\Command;
use Setting;

class SettingLoadCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setting:load
                            {env?    : (Optional) The name of the environment settings file to load, if not given the name is look up against \'APP_ENV\' in the \'.env\' file.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'loads the settings from a file';

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
        $envName = $this->argument('env');

        if (Str::isNullOrEmptyString($envName)) {
            $envName = env('APP_ENV', 'production');
        }

        try {
            $cnt = Setting::load($envName);
            Setting::save();
            if (0 == $cnt) {
                $this->warn(trans('admin/settings/general.status.no-settings-loaded', ['env' => $envName]));
            } else {
                $this->info(trans('admin/settings/general.status.settings-loaded', ['number' => $cnt, 'env' => $envName]));
            }
        }
        catch (FileNotFoundException $fnfx) {
            $this->error(trans('admin/settings/general.status.settings-file-not-found', ['env' => $envName]));
        }
        catch (\Exception $ex) {
            $this->error("Exception: ". $ex->getMessage());
            $this->error("Stack trace: ". $ex->getTraceAsString());
        }
    }
}
