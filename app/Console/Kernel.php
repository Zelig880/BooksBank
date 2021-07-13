<?php

namespace App\Console;

use App\Jobs\BorrowerRemindersJob;
use App\Jobs\LenderRemindersJob;
use App\Jobs\PickupBookJob;
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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->job(new PickupBookJob())->dailyAt('12:00');
        $schedule->job(new BorrowerRemindersJob())->dailyAt('12:00');
        $schedule->job(new LenderRemindersJob())->dailyAt('12:00');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
