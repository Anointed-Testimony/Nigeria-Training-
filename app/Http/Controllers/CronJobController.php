<?php

namespace App\Http\Controllers;

use App\Models\Ads;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CronJobController extends Controller
{
    //

    public function checkAds(){
        $activeAds = Ads::where('ads_status', 'active')->get();
        $currentTime = Carbon::now();
    
        foreach($activeAds as $activeAd){
            $timeDifference = $currentTime->diffInDays($activeAd->updated_at);
            if($timeDifference > 7){
                $activeAd->ads_status = 'completed';
                $activeAd->save();
            }
        }
    }
}
