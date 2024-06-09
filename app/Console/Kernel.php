<?php

namespace App\Console;

use App\Mail\RentExpirationReminder;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Carbon\Carbon;
use App\Models\Tennants;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        

        $schedule->call(function () {
            $threeMonthsFromNow = Carbon::now()->addMonths(3);

            $expiringTennants = Tennants::where('end_date', '<=', $threeMonthsFromNow)
                                         ->where('end_date', '>', Carbon::now())
                                         ->get();
    
            foreach ($expiringTennants as $tennant) {
                // Send the email to the administrator
                Mail::to('yooxing11@gmail.com')->send(new RentExpirationReminder($tennant));
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
