<?php
namespace App\Http\Middleware;

use Closure;
use App\Models\upload;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CheckUploadLimit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        
        if (!$user) {
            // Handle the case where user is not authenticated
            abort(401, 'Unauthenticated');
        }
        
        $business = $user->business;

        if (!$business) {
            // Handle the case where user does not have a business associated
            abort(403, 'Unauthorized');
        }

        $uploadLimit = $business->subscription === 'basic listing' ? 10 : 100;
        $userId = $business->user_id;
        $uploadsCount = Upload::where('user_id', $userId)->count();
        Log::info('Uploads Count: ' . $uploadsCount);

        if ($uploadsCount >= $uploadLimit) {
            notify()->error('Upload limit exceeded. Please upgrade your account.');
            return redirect()->back();
        }

        return $next($request);
    }
}