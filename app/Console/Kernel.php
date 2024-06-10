<?php

namespace App\Console;

use App\Notifications\RentExpirationReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Models\Tennants;
use Illuminate\Support\Facades\Notification;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $tennants = Tennants::where('end_date', '>=', Carbon::now()->addMonths(2))
                              ->where('end_date', '<=', Carbon::now()->addMonths(3))
                              ->get();
    
            foreach ($tennants as $tenant) {
                Notification::send($tenant, new RentExpirationReminder($tenant));
            }
        })->daily();
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
