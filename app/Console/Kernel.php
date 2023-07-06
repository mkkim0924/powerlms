<?php

namespace App\Console;

use App\Console\Commands\Backup;
use App\Console\Commands\LiveLessonEventCron;
use App\Console\Commands\LiveLessonReminderCommand;
use App\Console\Commands\RefreshSite;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        if (config('backup.schedule') == 1) {
            $schedule->command(Backup::class)->daily();
        } elseif (config('backup.schedule') == 2) {
            $schedule->command(Backup::class)->weekly();
        } elseif (config('backup.schedule') == 3) {
            $schedule->command(Backup::class)->monthly();
        }

        $schedule->command(LiveLessonReminderCommand::class)->everyThreeMinutes()->withoutOverlapping();
        $schedule->command(LiveLessonEventCron::class)->everyFiveMinutes()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
