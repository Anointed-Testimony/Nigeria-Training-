<?php

namespace App\Console\Commands;

use App\Models\Ads;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class UpdateAdStatus extends Command
{
    protected $signature = 'ads:update-status';

    protected $description = 'Update status of adveert';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $ads = Ads::where('ads_status', 'active')->get();

        foreach ($ads as $ad) {
            $startDate = Carbon::parse($ad->updated_at);
            $now = Carbon::now();
            $diffInDays = $startDate->diffInDays($now);

            // If ad has been active for more than one week, update its status
            if ($diffInDays >= 7) {
                $ad->ads_status = 'completed';
                $ad->save();
            }
        }

        $this->info('Ad statuses updated successfully.');
    }
}
