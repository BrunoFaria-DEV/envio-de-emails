<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\SendEmails::class
    ];
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {      
        foreach (['00:00', '06:00', '12:00', '18:00'] as $time) {
            $schedule->command('backup:clean')->dailyAt(\Carbon\Carbon::createFromFormat('H:i', $time)->subHour()->format('H:i'));
            $schedule->command('backup:run --only-db')->dailyAt($time);
        }
        $schedule->command('mail:send')
                 ->everyMinute()
                 ->withoutOverlapping()
                 ->sendOutputTo(storage_path('logs/mail.send.log'));
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
