<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\SettingAllCommand::class,
        \App\Console\Commands\SettingGetCommand::class,
        \App\Console\Commands\SettingSetCommand::class,
        \App\Console\Commands\SettingLoadCommand::class,
        \App\Console\Commands\SettingClearCommand::class,
        \App\Console\Commands\SettingForgetCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')
                 ->hourly();
    }
}
