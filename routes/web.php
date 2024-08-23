<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CronJobController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['reset' => false]);
Route::get('/', [App\Http\Controllers\PageController::class, 'home'])->name('home');
Route::get('/events', [App\Http\Controllers\PageController::class, 'events'])->name('events');
Route::get('/workshops', [App\Http\Controllers\PageController::class, 'workshops'])->name('workshops');
Route::get('/virtual_program', [App\Http\Controllers\PageController::class, 'virtual_program'])->name('virtual_program');
Route::get('/e-courses', [App\Http\Controllers\PageController::class, 'e_course'])->name('e_course');
Route::get('/businesses', [App\Http\Controllers\PageController::class, 'businesses'])->name('businesses');
Route::get('/tutor', [App\Http\Controllers\PageController::class, 'tutor'])->name('tutor');
Route::get('/signup', [App\Http\Controllers\PageController::class, 'signup'])->name('signup');
Route::get('/login', [App\Http\Controllers\PageController::class, 'login'])->name('login');
Route::get('/login-first', [App\Http\Controllers\GeneralController::class, 'loginFirst'])->name('login.first');
Route::get('/e_course_page/{slug_url}', [App\Http\Controllers\PageController::class, 'e_course_page'])->name('e_course_page');
Route::get('/about-us', [PageController::class, 'aboutUs'])->name('about.us');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/privacy-policy', [PageController::class, 'privacy_policy'])->name('privacy_policy');
Route::get('/terms-conditions', [PageController::class, 'terms_conditions'])->name('terms.conditions');
Route::get('/page/{businessname}', [PageController::class, 'businesspage'])->name('business.page');
Route::get('/contact-us', [PageController::class, 'contact'])->name('contact.us');
Route::get('/currency-converter', [PageController::class, 'currency_converter'])->name('currency.converter');
Route::middleware(['admin'])->group(function () {
    Route::get('/approve/kyc/{id}',[\App\Http\Controllers\GeneralController::class, 'approveKyc'])->name('kycApprove');
    Route::get('/reject/kyc/{id}',[\App\Http\Controllers\GeneralController::class, 'rejectKyc'])->name('kycReject');
    Route::get('/approve/tutor/{id}',[\App\Http\Controllers\GeneralController::class, 'approveTutor'])->name('tutorApprove');
    Route::get('/reject/tutor/{id}',[\App\Http\Controllers\GeneralController::class, 'rejectTutor'])->name('tutorReject');
    Route::get('/approve/ad/{id}',[\App\Http\Controllers\GeneralController::class, 'approveAd'])->name('approveAd');
    Route::get('/reject/ad/{id}',[\App\Http\Controllers\GeneralController::class, 'rejectAd'])->name('rejectAd');
    Route::get('/view/ad/{id}',[\App\Http\Controllers\PageController::class, 'approveAd'])->name('approveAd');
    Route::get('/view/kyc/{id}',[\App\Http\Controllers\PageController::class, 'viewVerification'])->name('viewVerify');
    Route::get('/view/tutor/{id}',[\App\Http\Controllers\PageController::class, 'tutorVerification'])->name('tutorVerify');
    Route::get('/admin', [App\Http\Controllers\PageController::class, 'admin'])->name('admin')->middleware('verified');
    Route::get('/admin/withdrawals', [GeneralController::class, 'fetchWithdrawals'])->name('admin.withdrawals');
    Route::get('/participants/{course_id}', [GeneralController::class, 'store'])->name('store.participant');
});
Route::get('/{slug_url}/{upload_type}/{id}', [App\Http\Controllers\PageController::class, 'pages'])
    ->where([
        'slug_url' => '[a-zA-Z0-9_-]+', 
        'upload_type' => '[a-zA-Z_-]+',   
        'id' => '[0-9]+'                 
    ])
    ->name('pages');
    Route::post('/register/user', [AuthController::class, 'register'])->name('registernew');
    Route::post('/login/user', [AuthController::class, 'signin'])->name('signin');
    Route::get('/events/{month}/{year}', [PageController::class, 'getEventsForMonth'])->name('events.month');
    Route::get('/events-year/{year}', [PageController::class, 'getEventsForYear'])->name('events.year');
    Route::get('/workshop/{month}/{year}', [PageController::class, 'getWorkForMonth'])->name('work.month');
    Route::get('/workshop-year/{year}', [PageController::class, 'getWorkForYear'])->name('work.year');
    Route::get('/virtual/{month}/{year}', [PageController::class, 'getvirtualForMonth'])->name('virtual.month');
    Route::get('/virtual-year/{year}', [PageController::class, 'getvirtualForYear'])->name('virtual.year');
    Route::post('/search', [GeneralController::class, 'searchController'])->name('search');
    Route::get('/free-events', [PageController::class, 'freevents'])->name('free.events');
    Route::get('/africa-events', [PageController::class, 'africaevents'])->name('africa.events');
    Route::get('/europe-events', [PageController::class, 'europevents'])->name('europe.events');
    Route::get('/asia-events', [PageController::class, 'asiaevents'])->name('asia.events');
    Route::get('/north-america-events', [PageController::class, 'northevents'])->name('north.events');
    Route::get('/nigeria-events', [PageController::class, 'nigeriaevents'])->name('nigeria.events');
    Route::get('/coming-soon', [PageController::class, 'comingSoon'])->name('coming.soon');
    Route::get('/news', [PageController::class, 'news'])->name('news');
    Route::get('/newspage/{news_url}', [PageController::class, 'newspage'])->name('newspage');
    Route::get('/tutorpage/{id}/{firstname}', [PageController::class, 'tutorpage'])->name('tutorpage');


    Route::middleware(['auth'])->group(function () {
        Route::post('/editUpload/{id}', [App\Http\Controllers\GeneralController::class, 'editUpload'])->name('editUpload');
        Route::post('/editnews/{id}', [App\Http\Controllers\GeneralController::class, 'editNews'])->name('edit.news');
        Route::post('/updatenews/{id}', [App\Http\Controllers\GeneralController::class, 'updatenews'])->name('update.news');
        Route::post('/ads-pay/{reference}', [GeneralController::class, 'adsPaystack'])->name('adsPaystack');
        Route::post('/update', [AuthController::class, 'update'])->name('update');
        Route::post('/profile', [GeneralController::class, 'updateProfilePic'])->name('profile');
        Route::get('/download/{filename}', [GeneralController::class, 'download'])->name('download');
        Route::post('/verify-payment/{reference}', [GeneralController::class, 'verifyTransaction'])->name('verify');
        Route::post('/pay-course/{reference}', [GeneralController::class, 'payCourseWithWallet'])->name('payCourseWithWallet');
        Route::get('/fund-wallet/{reference}', [GeneralController::class, 'fundWallet'])->name('fundwallet');
        Route::post('/pay-ads-wallet/{reference}', [GeneralController::class, 'adsWallet'])->name('adsWallet');
        Route::post('/pay-featureads-wallet/{reference}', [GeneralController::class, 'featuresAdsWallet'])->name('featuresAdsWallet');
        Route::get('/pay-featureads/{reference}', [GeneralController::class, 'featuresAdsPay'])->name('featuresAdsPay');
        Route::post('/withdraw-wallet', [GeneralController::class, 'withdrawFromWallet'])->name('withdraw');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard')->middleware('verified');
        Route::get('/reset/password', [PageController::class, 'reset'])->name('reset');
        Route::get('/clear-table', [GeneralController::class, 'clearTable']);
        Route::get('/get-days', [GeneralController::class, 'days']);
        Route::get('/user-days', [GeneralController::class, 'userdays']);
        Route::get('/free_registation', [GeneralController::class, 'freeRegistration']);
        Route::post('/mark-as-read/{notificationId}', [GeneralController::class, 'markAsRead'])->name('notifications.markAsRead');
        Route::post('/withdrawal-request/{withdrawalRequest}/approve', [GeneralController::class, 'approve'])->name('withdrawal-request.approve');
        Route::post('/updateAccount', [GeneralController::class, 'updateAccount'])->name('updateAccount');
        Route::post('/standard/subscription/{reference}', [GeneralController::class, 'standardSubscription'])->name('standardSubscription');
        Route::post('/standard/wallet/subscription/{reference}', [GeneralController::class, 'standardWalletSubscription'])->name('standardWalletSubscription');
        Route::post('/kyc/verify', [GeneralController::class, 'kycVerification'])->name('kycVerify');
        Route::post('/record', [GeneralController::class, 'impressions'])->name('record');
        Route::post('/click', [GeneralController::class, 'clicks'])->name('clicks');
        Route::post('/ads/submit', [GeneralController::class, 'adsSubmit'])->name('adsSubmit');
        Route::get('/get-top-banner-images', [GeneralController::class, 'getTopBannerImages'])->name('get_top_banner_images');
        Route::get('/get-promoted-banner-images', [GeneralController::class, 'getpromotedBannerImages'])->name('getpromotedBannerImages');
        Route::post('/check-password', [GeneralController::class, 'checkPassword'])->name('check-password');
        Route::get('/getFeaturePrice', [GeneralController::class, 'getFeaturePrice'])->name('feature.price');
        Route::get('/cert-host/{courseId}', [PageController::class, 'cert'])->name('cert.host');
        Route::get('/create-certificate/{courseId}', [GeneralController::class, 'certificate'])->name('certificate');
        Route::post('/post/news', [GeneralController::class, 'postnews'])->name('post.news');
        Route::get('/delete-news/{id}', [GeneralController::class, 'deleteNews'])->name('delete.news');
        Route::post('/swap', [GeneralController::class, 'swap'])->name('swap');
        Route::post('/create-category', [GeneralController::class, 'createCategory'])->name('createCategory');
        Route::get('/check-ads', [CronJobController::class, 'checkAds'])->name('check.ads');
        Route::post('/add-top-banner', [GeneralController::class, 'addTopBanner'])->name('add.top-banner');
        Route::post('/add-promoted-banner', [GeneralController::class, 'addPromotedBanner'])->name('add.promoted-banner');
        Route::post('/add-inpage-banner', [GeneralController::class, 'addInpageBanner'])->name('add.inpage-banner');
        Route::post('add-side-banner', [GeneralController::class, 'addSideBanner'])->name('add.side-banner');
        Route::post('banner-delete/{id}', [GeneralController::class, 'deleteBanner'])->name('delete.banner');
        Route::get('/tutor-register', [PageController::class, 'tutorSignup'])->name('tutorRegister');
        Route::post('/become-tutor', [GeneralController::class, 'tutorRegister'])->name('tutor.register');
        Route::get('/business-register', [PageController::class, 'businessRegister'])->name('business.register');
        Route::post('/business-signup', [GeneralController::class, 'businessRegister'])->name('business.signup');
        Route::post('/reviews', [GeneralController::class, 'reviewsStore'])->name('reviews.store');
        Route::post('/create-bookings', [GeneralController::class, 'createBooking'])->name('createBookings.store');
        Route::get('approve-booking/{id}', [GeneralController::class, 'confirmBooking'])->name('confirm.booking');
        Route::get('reject-booking/{id}', [GeneralController::class, 'rejectBooking'])->name('reject.booking');
        Route::get('/pay-for-bookings/{reference}', [GeneralController::class, 'payForBookingPaystack'])->name('paystack.booking');
    });

Auth::routes([
    'verify' => true
]);

Route::middleware(['check.upload.limit'])->group(function () {
    Route::post('/updateUpload/{id}', [App\Http\Controllers\GeneralController::class, 'updateUpload'])->name('updateUpload');
    Route::post('/upload', [App\Http\Controllers\GeneralController::class, 'newupload'])->name('upload');    
    Route::get('/delete/{id}', [App\Http\Controllers\GeneralController::class, 'destroy'])->name('delete');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
