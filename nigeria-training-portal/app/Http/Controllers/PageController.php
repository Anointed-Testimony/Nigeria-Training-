<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ads;
use App\Models\News;
use App\Models\User;
use App\Models\Tutor;
use App\Models\AdType;
use App\Models\upload;
use App\Models\Reviews;
use App\Models\Business;
use App\Models\Category;
use App\Models\ChMessage;
use App\Models\Featuring;
use App\Models\PlanPrice;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\Paid_courses;
use App\Models\Participants;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Models\DefaultImages;
use App\Models\KycVerification;
use App\Http\Controllers\Controller;
use App\Models\Bookings;
use Cloudinary\Api\Upload\UploadApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Cloudinary\Transformation\DefaultImage;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    //
    public function home(){
        $uploads = upload::where('featured', 1)->get();
        $results = [];
        $usInfos = [];
        $busInfos = [];
        
        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                // if ($remainingDays > 0) {
                //     $date .= ', ' . $remainingDays . ' days';
                // }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];

            $userfoId = $load->user_id;

            // User Info

            $usInfo = User::find($userfoId);
            $usInfos[$userfoId] = $usInfo;

            //Business Info
            $busInfo = $usInfo->business;
            $busInfos[$userfoId] = $busInfo;

        }

        $trainCount = Session::get('trainCount');

        $banners = Ads::where('ads_type', 'promoted banner')
        ->where('ads_status', 'active') 
        ->get();

        $homesides = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'homepage banner')  
        ->get();

        $randomNews = News::inRandomOrder()->take(2)->get();
        $featuredBusiness = Business::where('featured', 1)->get();
        $defaultImages = DefaultImages::all();

        return view('pages.home', compact('uploads','results','usInfos','busInfos','trainCount','banners','homesides','randomNews','featuredBusiness','defaultImages'));
    }
    public function e_course_page($slug_url)
    {
        $course = upload::where('upload_type', 'e-course')->where('slug_url', $slug_url)->first();
        if (Auth::check()) {
            $user = Auth::user();
            $hasPaid = $user->paidCourses()->where('course_id', $course->id)->exists();

            if ($hasPaid) {
                return view('pages.e_course_page', compact('course'));
            }
        }
        return redirect("$course->slug_url/e-course/$course->id");
    }
    public function events(){
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();


        $uploads = Upload::whereBetween('start_date', [$currentMonthStart, $currentMonthEnd])->get();
        $results = [];
        $usInfos = [];
        $busInfos = [];
        
        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
            $userfoId = $load->user_id;
        
            // User Info (using eager loading)
            $usInfo = User::with('business')->find($userfoId);
            
            if ($usInfo) {
                $usInfos[$userfoId] = $usInfo;
                
                // Business Info
                $busInfo = $usInfo->business;
                $busInfos[$userfoId] = $busInfo;
            } else {
                // Handle the case where user info is not found
                // You may want to log an error or take appropriate action
            }
        }
        

        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();

        $defaultImages = DefaultImages::all();
        return view('pages.events', compact('uploads','results','usInfos','busInfos','inpages','defaultImages'));
    }
    public function getEventsForMonth($month, $year)
    {
        $selectedMonth = Carbon::create($year, $month, 1);
        $uploads = Upload::whereYear('start_date', $selectedMonth->year)
                         ->whereMonth('start_date', $selectedMonth->month)
                         ->with('user')
                         ->with('users')
                         ->get();

        $results = [];

        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        return response()->json([
            'uploads' => $uploads,
            'results' => $results
        ]);
    }
    public function getEventsForYear($year)
    {
        $selectedYear = Carbon::createFromFormat('Y', $year)->startOfYear();

        // Get uploads for the selected year
        $uploads = Upload::whereYear('start_date', $selectedYear->year)
                        ->whereMonth('start_date', $selectedYear->month)
                         ->with('user')
                         ->with('users')
                         ->get();
        // dd($selectedYear->month);
        $results = [];

        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        return response()->json([
            'uploads' => $uploads,
            'results' => $results
        ]);
    }
    public function workshops(){
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();
        $uploads = upload::where('upload_type', 'workshop')->whereBetween('start_date', [$currentMonthStart, $currentMonthEnd])->get();
        $results = [];
        $usInfos = [];
        $busInfos = [];
        
        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            // $monthAbbreviation = $startDate->format('M');
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];

            $userfoId = $load->user_id;

            // User Info

            $usInfo = User::find($userfoId);
            $usInfos[$userfoId] = $usInfo;

            //Business Info
            $busInfo = $usInfo->business;
            $busInfos[$userfoId] = $busInfo;

        }
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();
        $defaultImages = DefaultImages::all();

        return view('pages.workshop', compact('uploads','results','usInfos','busInfos','inpages','defaultImages'));
    }
    public function getWorkForMonth($month, $year)
    {
        $selectedMonth = Carbon::create($year, $month, 1);
        $uploads = Upload::whereYear('start_date', $selectedMonth->year)
                         ->whereMonth('start_date', $selectedMonth->month)
                         ->where('upload_type', 'workshop')
                         ->with('user')
                         ->with('users')
                         ->get();

        $results = [];

        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        return response()->json([
            'uploads' => $uploads,
            'results' => $results
        ]);
    }
    public function getWorkForYear($year)
    {
        $selectedYear = Carbon::createFromFormat('Y', $year)->startOfYear();

        // Get uploads for the selected year
        $uploads = Upload::whereYear('start_date', $selectedYear->year)
                        ->whereMonth('start_date', $selectedYear->month)
                         ->where('upload_type', 'workshop')
                         ->with('user')
                         ->with('users')
                         ->get();
        // dd($selectedYear->month);
        $results = [];

        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        return response()->json([
            'uploads' => $uploads,
            'results' => $results
        ]);
    }
    public function virtual_program(){
        $currentMonthStart = Carbon::now()->startOfMonth();
        $currentMonthEnd = Carbon::now()->endOfMonth();

        $uploads = upload::where('upload_type', 'virtual-program')->whereBetween('start_date', [$currentMonthStart, $currentMonthEnd])->get();
        $results = [];
        $usInfos = [];
        $busInfos = [];
        
        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];

            $userfoId = $load->user_id;

            // User Info

            $usInfo = User::find($userfoId);
            $usInfos[$userfoId] = $usInfo;

            //Business Info
            $busInfo = $usInfo->business;
            $busInfos[$userfoId] = $busInfo;
        }
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();
        

        $defaultImages = DefaultImages::all();

        return view('pages.virtual_program',compact('uploads','results','usInfos','busInfos','inpages','defaultImages'));
    }
    public function getVirtualForMonth($month, $year)
    {
        $selectedMonth = Carbon::create($year, $month, 1);
        $uploads = Upload::whereYear('start_date', $selectedMonth->year)
                         ->whereMonth('start_date', $selectedMonth->month)
                         ->where('upload_type', 'virtual-program')
                         ->with('user')
                         ->with('users')
                         ->get();

        $results = [];

        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        return response()->json([
            'uploads' => $uploads,
            'results' => $results
        ]);
    }
    public function getVirtualForYear($year)
    {
        $selectedYear = Carbon::createFromFormat('Y', $year)->startOfYear();

        // Get uploads for the selected year
        $uploads = Upload::whereYear('start_date', $selectedYear->year)
                        ->whereMonth('start_date', $selectedYear->month)
                         ->where('upload_type', 'virtual-program')
                         ->with('user')
                         ->with('users')
                         ->get();
        // dd($selectedYear->month);
        $results = [];

        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        return response()->json([
            'uploads' => $uploads,
            'results' => $results
        ]);
    }
    public function e_course(){
        $usInfos = []; 
        $busInfos = [];
        $uploads = upload::where('upload_type', 'e-course')->get();
        
        foreach ($uploads as $load) {
            $uploadId = $load->id;

            $userfoId = $load->user_id;

            // User Info

            $usInfo = User::find($userfoId);
            $usInfos[$userfoId] = $usInfo;

            //Business Info
            $busInfo = $usInfo->business;
            $busInfos[$userfoId] = $busInfo;

        }
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();
        $defaultImages = DefaultImages::all();

        return view('pages.e-course',compact('uploads','usInfos','busInfos','inpages','defaultImages'));
    }
    public function businesses(){
        $allProviders = Business::where('business_type', 'LIKE', '%training provider%')->get();
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();


        $defaultImages = DefaultImages::all();
        return view('pages.training-providers',compact('allProviders','inpages','defaultImages'));
    }
    public function tutor(){
        // $profile = Auth::user()->avatar;
        $tutors = User::where('user_type', 'tutor')
        ->whereHas('tutor', function ($query) {
            $query->where('status', 'approved');
        })
        ->with('tutor.categories')
        ->get();
        // dd($tutors);
        return view('pages.tutor', compact('tutors'));
    }
    public function tutorPage(int $id, string $firstname)
    {
        $tutor = Tutor::find($id);    
        if (!$tutor) {
            notify()->error('Tutor not found');
            return redirect()->back();
        }
    
        $user = User::find($tutor->user_id);
        $profile = $user->avatar;
    
        if (!$user) {
            notify()->error('Tutor not found');
            return redirect()->back();
        }
    
        $inputFirstnameLowercase = strtolower($firstname);
        $userFirstnameLowercase = strtolower($user->firstname);

        if ($inputFirstnameLowercase !== $userFirstnameLowercase) {
            notify()->error('Tutor not found');
            return redirect()->back();
        }

        $related = Tutor::where('category', $tutor->category)
        ->where('id', '!=', $tutor->id)
        ->get();

        $reviews = Reviews::with('user')->where('tutor_id', $tutor->id)->get();

        $students = Bookings::where('tutor_id', $tutor->id)
                            ->where('status', 'paid')->get();

        $hasPaidBooking = false;

        // Check if the user is authenticated
        if (Auth::check()) {
            $student = Auth::user();

            // Check if the authenticated user has any 'paid' bookings for this tutor
            $hasPaidBooking = Bookings::where('student_id', $student->id)
                ->where('tutor_id', $tutor->id)
                ->where('status', 'paid')
                ->exists();
        }
        return view('pages.tutorpage', compact('user', 'tutor', 'profile', 'related','reviews', 'students','hasPaidBooking'));
    }
    
    public function signup(){
        return view('pages.signup');
    }
    public function login(){
        return view('pages.login');
    }
    public function pages($slug_url, $upload_type, $id)
    {
        $post = Upload::where('slug_url', $slug_url)
            ->where('upload_type', $upload_type)
            ->where('id', $id)
            ->get();
    
        $results = [];
        $usInfos = [];
        $busInfos = [];
    
        foreach ($post as $load) {
            $uploadId = $load->id;
    
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
    
            $dayDifference = $startDate->diffInDays($endDate);
    
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
    
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
    
            $userfoId = $load->user_id;
    
            // User Info
            $usInfo = User::find($userfoId);
            $usInfos[$userfoId] = $usInfo;
    
            // Business Info
            $busInfo = $usInfo->business;
    
            // Format the website URL
            if ($busInfo && !preg_match("~^(?:f|ht)tps?://~i", $busInfo->website)) {
                $busInfo->website = 'http://' . $busInfo->website;
            }
    
            $busInfos[$userfoId] = $busInfo;
        }
    
        if ($post->isEmpty()) {
            abort(Response::HTTP_NOT_FOUND);
        } else {
            return view('pages.landingpage', compact('post', 'results', 'usInfos', 'busInfos'));
        }
    }
    
    public function reset(){
        return view('auth.passwords.email');
    }
    public function dashboard(){
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'deposit')
            ->orderBy('created_at', 'desc')
            ->get();
        $walTransactions = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'withdraw')
            ->orderBy('created_at', 'desc')
            ->get();
        $othersTransactions = Transaction::whereNotIn('transaction_type', ['deposit', 'withdraw'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        $firstName = $user->firstname;
        $lastName = $user->lastname;
        $firstLetterFirstName = substr($firstName, 0, 1);
        $firstLetterLastName = substr($lastName, 0, 1);
        $user = Auth::user();
        $profile = $user->avatar;
        $businessName = $website = $description = $contact_person = null;
        if ($user->user_type == "business"){
            $businessName = $user->business->businessname;
            $website = $user->business->website;
            $description = $user->business->description;
            $contact_person = $user->business->contact_person;
        }

        $upload = upload::where('user_id', $user->id)->get();
        $compupload = upload::where('user_id', $user->id)
        ->where('end_date', '<', Carbon::now())
        ->get();
        $myCourses = Paid_courses::join('uploads', 'paid_courses.course_id', '=', 'uploads.id')
            ->where('paid_courses.user_id', $user->id)
            ->where('uploads.end_date', '<', Carbon::now())
            ->get();
        $allCourses = Paid_courses::where('user_id', Auth::id())->get();
        // dd($allCourses);
        $ads = Ads::where('user_id', $user->id)->get();
        $adsCount = Ads::where('user_id', $user->id)->count();
        $workUpload = upload::where('user_id', $user->id)
        ->where('upload_type', 'workshop')
        ->count();
        $eventUpload = upload::where('user_id', $user->id)
        ->where('upload_type', 'events')
        ->count();
        $ecourseUpload = upload::where('user_id', $user->id)
        ->where('upload_type', 'e-course')
        ->count();
        $vprogramUpload = upload::where('user_id', $user->id)
        ->where('upload_type', 'virtual-program')
        ->count();

        $loads = Upload::all(); 

        $results = [];
        
        foreach ($loads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ' ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        }    
        
        $notifications = $user->unreadNotifications;
        $readnotifications = $user->readNotifications;
        $unreadCount = $notifications->count();
        $readCount = $user->readNotifications->count();

        // foreach($readnotifications as $notifying){
        //     dd($notifying->data['title']);
        // }

        $messageNotifications = ChMessage::where('to_id', $user->id)->where('seen', '0')->get();
        // dd($messageNotifications->count());

        // metrics per days
        $sevenDaysAgo = Carbon::now()->subDays(7);
        $fourtDaysAgo = Carbon::now()->subDays(14);
        $thirtDaysAgo = Carbon::now()->subDays(30);

        $sevenUpload = upload::where('user_id', $user->id)->where('created_at', '>=', $sevenDaysAgo)->get();
        $fourtUpload = upload::where('user_id', $user->id)->where('created_at', '>=', $fourtDaysAgo)->get();
        $thirtUpload = upload::where('user_id', $user->id)->where('created_at', '>=', $thirtDaysAgo)->get();

        // Featured
        $allFeatured = Featuring::all();
        // plan price
        $allPlans = PlanPrice::all();
        $adPrices = AdType::all();

        //bookings

        $bookings = null;
        if($user->user_type == 'tutor'){
            $bookings = Bookings::where('tutor_id', $user->tutor->id)->get();
        }else if($user->user_type == 'user'){
            $bookings = Bookings::where('student_id', $user->id)->get();
        }

        $categories = Category::all();
        return view('pages.dashboard', compact('firstLetterFirstName','firstLetterLastName','businessName','website','description', 'profile','upload','contact_person','results','transactions','workUpload','eventUpload','ecourseUpload','vprogramUpload','notifications','unreadCount','readCount','readnotifications','ads','adsCount','myCourses','compupload','allCourses','messageNotifications','walTransactions','othersTransactions','sevenUpload','fourtUpload','thirtUpload','allFeatured','allPlans','adPrices','bookings','categories'));
    }
     public function admin(){

        $alltransactions = Transaction::all();

        $allUsers = User::where('user_type', 'user')->get();
        $allBusinesses = User::where('user_type', 'business')->get();
        $allProfessionals = User::where('user_type', 'tutor')->get();
        $pendingWithrawals = Transaction::where('status', 'pending')->get();
        $pendingKycs = KycVerification::where('status', 'pending')->get();

        $usCount = User::where('user_type', 'user')->count();
        $busCount = User::where('user_type', 'business')->count();
        $proCount = User::where('user_type', 'tutor')->count();
        $workCount = upload::where('upload_type', 'workshop')->count();
        $evenCount = upload::where('upload_type', 'events')->count();
        $virtCount = upload::where('upload_type', 'virtual-program')->count();
        $eCount = upload::where('upload_type', 'e-course')->count();
        $countKyc = KycVerification::where('status', 'pending')->count();
        $countAds = Ads::count();
        $allnews = News::all();
        $allAds = Ads::all();
        $allCategories = Category::all();
        $defaultImages = DefaultImages::all();
        return view('pages.admin', compact('usCount','busCount','proCount','workCount','evenCount','virtCount','eCount','alltransactions', 'allUsers','allBusinesses','allProfessionals','pendingWithrawals','pendingKycs','countKyc','countAds','allAds','allnews','allCategories','defaultImages'));
    }

    public function viewVerification($id){
        $kyc = KycVerification::where('id', $id)->get();
        // dd($kyc->id);
        return view('pages.kycpage',compact('kyc'));
    }
    public function tutorVerification($id){
        $user = User::find($id);
        // dd($kyc->id);
        return view('pages.tutor-verify',compact('user'));
    }

    public function approveAd($id){
        $approve = Ads::findOrFail($id);

        return view('pages.approvead', compact('approve'));
    }
    public function cert(Request $request, $course_id){
        $ref = $request->reference;
    
        $existingParticipants = Participants::where('reference', $ref)->get();

        if($existingParticipants->count() > 0) {
            $particips = $existingParticipants;
        } else {
            // If no participants exist, create new ones
            $participants = $request->input('participants');
    
            foreach ($participants as $participant) {
                Participants::create([
                    'user_id' => Auth::id(),
                    'course_id' => $course_id,
                    'reference' => $ref,
                    'participant_name' => $participant,
                    'certificate_reference_id' => Str::random(10)
                ]);
            }
    
            // Retrieve newly created participants
            $particips = Participants::where('reference', $ref)->get();
        }
    
        return view('pages.certificate_template', compact('particips'));
    }
    public function news(){
        $allAds = Ads::where('ads_type', 'inpage banner')->get();

        // Shuffle the ads randomly
        $shuffledAds = $allAds->shuffle();
        
        // Take three ads for the right side
        $rightnews = $shuffledAds->splice(0, 3);
        
        // Take three ads for the left side
        $leftnews = $shuffledAds->splice(0, 3);

        $allnews = News::all();
        $defaultImages = DefaultImages::all();
        return view('pages.news',compact('rightnews','leftnews','allnews','defaultImages'));
    }
    public function businesspage($businessname){
        $business = Business::where('business_slug', $businessname)->first();
        $uploads = Upload::where('user_id', $business->user_id)->get();
        // dd($businessUploads);

        $results = [];
        $usInfos = [];
        $busInfos = [];
        
        foreach ($uploads as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                // if ($remainingDays > 0) {
                //     $date .= ', ' . $remainingDays . ' days';
                // }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];

            $userfoId = $load->user_id;

            // User Info

            $usInfo = User::find($userfoId);
            $usInfos[$userfoId] = $usInfo;

            //Business Info
            $busInfo = $usInfo->business;
            $busInfos[$userfoId] = $busInfo;

        }

        if ($business == null) {
            abort(Response::HTTP_NOT_FOUND);
        } else {
            return view('pages.businesspage', compact('business','uploads','results','usInfos','busInfos'));
        }
    }
    public function freevents(){
        $freevents = Upload::where('price', '0')->get();


        $results = [];
        
        foreach ($freevents as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();
        return view('pages.free-events', compact('freevents','results','inpages'));
    }
    public function africaevents(){
        $iso2Codes = [
            'DZ', 'AO', 'BJ', 'BW', 'BF', 'BI', 'CV', 'CM', 'CF', 'TD', 'KM', 'CD', 'CG',
            'DJ', 'EG', 'GQ', 'ER', 'SZ', 'ET', 'GA', 'GM', 'GH', 'GN', 'GW', 'CI', 'KE',
            'LS', 'LR', 'LY', 'MG', 'MW', 'ML', 'MR', 'MU', 'MA', 'MZ', 'NA', 'NE', 'NG',
            'RW', 'ST', 'SN', 'SC', 'SL', 'SO', 'ZA', 'SS', 'SD', 'TZ', 'TG', 'TN', 'UG',
            'ZM', 'ZW'
        ];
        $africa = upload::whereIn('country', $iso2Codes)->get();
        $results = [];
        
        foreach ($africa as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();
        return view('pages.africa-events', compact('africa','results','inpages'));
    }
    public function asiaevents(){
        $iso2CodesAsia = [
            'AF', 'AM', 'AZ', 'BH', 'BD', 'BT', 'BN', 'KH', 'CN', 'CY', 'GE', 'IN', 'ID',
            'IR', 'IQ', 'IL', 'JP', 'JO', 'KZ', 'KW', 'KG', 'LA', 'LB', 'MY', 'MV', 'MN',
            'MM', 'NP', 'KP', 'OM', 'PK', 'PS', 'PH', 'QA', 'SA', 'SG', 'KR', 'LK', 'SY',
            'TW', 'TJ', 'TH', 'TL', 'TR', 'TM', 'AE', 'UZ', 'VN', 'YE'
        ];
        $asia = upload::whereIn('country', $iso2CodesAsia)->get();
        $results = [];
        
        foreach ($asia as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();
        return view('pages.asia-events', compact('asia','results','inpages'));
    }
    public function europevents(){
        $iso2CodesEurope = [
            'AL', 'AD', 'AM', 'AT', 'AZ', 'BY', 'BE', 'BA', 'BG', 'HR', 'CY', 'CZ', 'DK',
            'EE', 'FI', 'FR', 'GE', 'DE', 'GR', 'HU', 'IS', 'IE', 'IT', 'KZ', 'LV', 'LI',
            'LT', 'LU', 'MT', 'MD', 'MC', 'ME', 'NL', 'MK', 'NO', 'PL', 'PT', 'RO', 'RU',
            'SM', 'RS', 'SK', 'SI', 'ES', 'SE', 'CH', 'TR', 'UA', 'GB', 'VA'
        ];
        $europe = upload::whereIn('country', $iso2CodesEurope)->get();
        $results = [];
        
        foreach ($europe as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();
        return view('pages.europe-events', compact('europe','results','inpages'));
    }
    public function nigeriaevents(){
        $nigeria = upload::where('country', 'NG')->get();
        $results = [];
        
        foreach ($nigeria as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();
        return view('pages.nigeria-events', compact('nigeria','results','inpages'));
    }
    public function northevents(){
        $iso2CodesNorthAmerica = [
            'AG', 'BS', 'BB', 'BZ', 'CA', 'CR', 'CU', 'DM', 'DO', 'SV', 'GD', 'GT', 'HT',
            'HN', 'JM', 'MX', 'NI', 'PA', 'KN', 'LC', 'VC', 'TT', 'US'
        ];
        $north = upload::whereIn('country', $iso2CodesNorthAmerica)->get();
        $results = [];
        
        foreach ($north as $load) {
            $uploadId = $load->id;
        
            $startDate = Carbon::parse($load->start_date);
            $endDate = Carbon::parse($load->end_date);
        
            $dayDifference = $startDate->diffInDays($endDate);
        
            if ($dayDifference > 7) {
                $weekDifference = floor($dayDifference / 7);
                $remainingDays = $dayDifference % 7;
                $date = $weekDifference . ' weeks';
                if ($remainingDays > 0) {
                    $date .= ', ' . $remainingDays . ' days';
                }
                $date .= ', ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            } else {
                $date = $dayDifference . ' days, ' . $startDate->format('M.j') . ' - ' . $endDate->format('M.j, Y');
            }
        
            $results[] = [
                'uploadId' => $uploadId,
                'date' => $date,
            ];
        
        }
        $inpages = Ads::inRandomOrder()->limit(1)
        ->where('ads_status', 'active')
        ->where('ads_type', 'inpage banner')  
        ->get();
        return view('pages.north-events', compact('north','results','inpages'));
    }
    public function comingSoon(){
        return view('pages.coming-soon');
    }
    public function newspage($news_url) {
        $news = News::where('news_url', $news_url)->first();
    
        $inpages = Ads::inRandomOrder()
            ->where('ads_status', 'active')
            ->where('ads_type', 'inpage banner')
            ->limit(1)
            ->get();
    
        $randomNews = News::where('news_url', '!=', $news_url) // exclude the current news
            ->inRandomOrder()
            ->take(2)
            ->get();
    
        $defaultImages = DefaultImages::all();
        return view('pages.newspage', compact('news', 'inpages', 'randomNews','defaultImages'));
    }
    public function tutorSignup(){
        if (auth()->user()->user_type == 'business') {
            return redirect('/');
        }
        $allCategories = Category::all();
        return view('pages.tutorsignup', compact('allCategories'));
    }

    public function businessRegister(){
        if (auth()->user()->user_type == 'tutor') {
            return redirect('/');
        }
        $allCategories = Category::all();
        return view('pages.business-register', compact('allCategories'));
    }
    public function aboutUs(){
        return view('pages.about-us');
    }
    public function faq(){
        return view('pages.faq');
    }
    public function privacy_policy(){
        return view('pages.privacy-policy');
    }
    public function terms_conditions(){
        return view('pages.terms-conditions');
    }
    public function contact(){
        return view('pages.contact-us');
    }
    public function currency_converter(){
        return view('pages.currency-converter');
    }
}
