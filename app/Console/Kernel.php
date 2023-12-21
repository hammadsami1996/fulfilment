<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\FetchOrderCorn::class,
    ];

    /**
     * Define the application's command schedule.
     */
//    protected function schedule(Schedule $schedule)
//    {
//         $schedule->command('fetchorder:corn')->everyMinute();
//    }

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('fetchOrderCorn')
            ->everyMinute()
            ->withoutOverlapping()
            ->sendOutputTo(storage_path('logs/fetchOrderCorn.log'));
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
