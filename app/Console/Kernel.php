<?php

namespace App\Console;

use App\Models\Ads;
use Illuminate\Support\Carbon;
use App\Console\Commands\UpdateAdStatus;
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
        // $schedule->command(UpdateAdStatus::class)->hourly();
        $schedule->call(function(){
            $ads = Ads::where('ads_status', 'active')->get();

            foreach ($ads as $ad) {
                $startDate = Carbon::parse($ad->updated_at);
                $now = Carbon::now();
                $diffInDays = $startDate->diffInDays($now);
    
                // If ad has been active for more than one week, update its status
                if ($diffInDays < 7) {
                    $ad->ads_status = 'active';
                    $ad->save();
                }
            }
        })->everyMinute();
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
