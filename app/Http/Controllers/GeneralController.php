<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use FFMpeg\FFMpeg;
use App\Models\Ads;
use FFMpeg\FFProbe;
use App\Models\News;
use App\Models\User;
use App\Models\Tutor;
use Yabacon\Paystack;
use App\Models\AdType;
use App\Models\upload;
use App\Models\Reviews;
use App\Models\Bookings;
use App\Models\Business;
use App\Models\Category;
use App\Mail\ReceiptMail;
use App\Models\Featuring;
use App\Models\Certificate;
use App\Models\Transaction;
use Illuminate\Support\Str;
use App\Models\CourseVideos;
use App\Models\Paid_courses;
use App\Models\Participants;
use Illuminate\Http\Request;
use App\Models\DefaultImages;
use App\Models\KycVerification;
use FFMpeg\Coordinate\TimeCode;
use App\Models\E_Course_Sections;
use App\Notifications\Withdrawal;
use App\Notifications\PaidCourses;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\ChMessage as Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Yabacon\Paystack\Exception\ApiException;
use App\Notifications\FundWalletNotification;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Symfony\Component\Process\Exception\ProcessFailedException;

 class GeneralController extends Controller
{
    protected $perPage = 30;

    // public function newupload(Request $request)
    // {
    //     ini_set('max_execution_time', 3600);
    //     $imageName = rand(11111, 99999) . '.' . $request->file('featured_image')->getClientOriginalExtension();
    //     $matName = rand(11111, 99999) . '.' . $request->file('material')->getClientOriginalExtension();

    //     $destinationPath = 'images';
    //     $matdestinationPath = 'materials';
    //     $upload_success = $request->file('featured_image')->move($destinationPath, $imageName);
    //     $upload_success_mat = $request->file('material')->move($matdestinationPath, $matName);

    //     // Save data to database
    //     $uploads = new upload();
    //     $uploads->user_id = Auth::user()->id;
    //     $uploads->featured_image = $imageName;
    //     $uploads->title = $request->title;
    //     $uploads->category = $request->category;
    //     $uploads->upload_type = $request->upload_type;
    //     $uploads->start_date = $request->start_date;
    //     $uploads->end_date = $request->end_date;
    //     $numericValue = intval(preg_replace("/[^0-9]/", "", $request->price));
    //     $uploads->price = $numericValue;
    //     $uploads->country = $request->country;
    //     $uploads->address = $request->address;
    //     $uploads->material = $matName;
    //     $uploads->description = $request->description;
    //     $uploads->slug_url = Str::slug($request->title);
    //     $uploads->featured_image = $imageName;
    //     $uploads->save();

    //     $course_id = $uploads->id;

    //     if ($request->upload_type == 'e-course') {
    //         // Retrieve sections and section IDs from the request
    //         $sections = $request->input('section_title');
    //         $sectionIds = $request->input('sectionId');
        
    //         // Iterate through each section and its associated video data
    //         foreach ($sections as $index => $section) {
    //             // Create the course section

    //             // dd($sectionIds);
    //             $courseSection = E_Course_Sections::create([
    //                 'course_id' => $course_id,
    //                 'section_title' => $section,
    //                 'section_id' => $sectionIds[$index], 
    //             ]);
        
    //             // Get the videos for the current section
    //             $videoData = $request->videos[$sectionIds[$index]] ?? [];
        
    //             $ffmpeg = FFMpeg::create();
    //             if ($request->hasFile('videos.' . $sectionIds[$index] . '.video_file')) {
    //                 // Get the array of uploaded video files
    //                 $videoFiles = $request->file('videos.' . $sectionIds[$index] . '.video_file');
                    
    //                 foreach ($videoFiles as $key => $videoFile) {
    //                     $video = $ffmpeg->open($videoFile->getPathname());

    //                     $durationInSeconds = $video->getStreams()->first()->get('duration');
    //                     $durationInMinutes = round($durationInSeconds / 60);
            
    //                 $durationInMinutes = round($durationInSeconds / 60);
    //                     // Upload video to Cloudinary
    //                     $uploadedVideo = Cloudinary::upload($videoFile->getRealPath(), [
    //                         "folder" => "videos",
    //                         "resource_type" => "video"
    //                     ])->getSecurePath();
                
    //                     // Get the corresponding video title
    //                     $videoTitle = $videoData['video_name'][$key];
    //                     // Store file information in the database
    //                     CourseVideos::create([
    //                         'course_id' => $course_id,
    //                         'section_id' => $sectionIds[$index],
    //                         'video_name' => $videoTitle,
    //                         'video_link' => $uploadedVideo,
    //                         'duration' => $durationInMinutes
    //                     ]);
    //                 }
    //             }
    //         }
    //     }
        

    //     notify()->success('Upload Successful');
    //     return redirect('/dashboard');
    // }

    // public function newupload(Request $request)
    // {
    //     // Set maximum execution time for the script
    //     ini_set('max_execution_time', 3600);

    //     // Define validation rules
    //     $validator = Validator::make($request->all(), [
    //         'featured_image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'material' => 'required|file|mimes:pdf,doc,docx',
    //         'title' => 'required|string|max:255',
    //         'category' => 'required|string|max:255',
    //         'upload_type' => 'required|string|max:255',
    //         'start_date' => 'required|date',
    //         'end_date' => 'required|date|after:start_date',
    //         'price' => 'required|numeric',
    //         'country' => 'required|string|max:255',
    //         'address' => 'required|string|max:255',
    //         'description' => 'required|string',
    //         'section_title' => 'required_if:upload_type,e-course|array',
    //         'section_title.*' => 'required|string|max:255',
    //         'sectionId' => 'required_if:upload_type,e-course|array',
    //         'sectionId.*' => 'required|integer',
    //         'videos.*.video_file' => 'required_if:upload_type,e-course|array',
    //         'videos.*.video_file.*' => 'file|mimes:mp4,avi,wmv|max:50000',
    //         'videos.*.video_name.*' => 'required|string|max:255'
    //     ]);

    //     // Check if validation fails
    //     if ($validator->fails()) {
    //         // Iterate through the errors and use notify to display them
    //         foreach ($validator->errors()->all() as $error) {
    //             notify()->error($error);
    //         }
    //         // Redirect back with input
    //         return redirect()->back()->withInput();
    //     }

    //     // Generate random image and material names
    //     $imageName = rand(11111, 99999) . '.' . $request->file('featured_image')->getClientOriginalExtension();
    //     $matName = rand(11111, 99999) . '.' . $request->file('material')->getClientOriginalExtension();

    //     // Set destination paths
    //     $destinationPath = 'images';
    //     $matdestinationPath = 'materials';

    //     // Move uploaded files
    //     $upload_success = $request->file('featured_image')->move($destinationPath, $imageName);
    //     $upload_success_mat = $request->file('material')->move($matdestinationPath, $matName);

    //     // Create new upload record
    //     $uploads = new Upload();
    //     $uploads->user_id = Auth::user()->id;
    //     $uploads->featured_image = $imageName;
    //     $uploads->title = $request->title;
    //     $uploads->category = $request->category;
    //     $uploads->upload_type = $request->upload_type;
    //     $uploads->start_date = $request->start_date;
    //     $uploads->end_date = $request->end_date;
    //     $uploads->price = intval(preg_replace("/[^0-9]/", "", $request->price));
    //     $uploads->country = $request->country;
    //     $uploads->address = $request->address;
    //     $uploads->material = $matName;
    //     $uploads->description = $request->description;
    //     $uploads->slug_url = Str::slug($request->title);
    //     $uploads->save();

    //     $course_id = $uploads->id;

    //     if ($request->upload_type == 'e-course') {
    //         $sections = $request->input('section_title');
    //         $sectionIds = $request->input('sectionId');
            
    //         foreach ($sections as $index => $section) {
    //             $courseSection = E_Course_Sections::create([
    //                 'course_id' => $course_id,
    //                 'section_title' => $section,
    //                 'section_id' => $sectionIds[$index], 
    //             ]);

    //             $videoData = $request->videos[$sectionIds[$index]] ?? [];
    //             $ffmpeg = FFMpeg::create();

    //             if ($request->hasFile('videos.' . $sectionIds[$index] . '.video_file')) {
    //                 $videoFiles = $request->file('videos.' . $sectionIds[$index] . '.video_file');
                    
    //                 foreach ($videoFiles as $key => $videoFile) {
    //                     $video = $ffmpeg->open($videoFile->getPathname());
    //                     $durationInSeconds = $video->getStreams()->first()->get('duration');
    //                     $durationInMinutes = round($durationInSeconds / 60);

    //                     $uploadedVideo = Cloudinary::upload($videoFile->getRealPath(), [
    //                         "folder" => "videos",
    //                         "resource_type" => "video"
    //                     ])->getSecurePath();

    //                     $videoTitle = $videoData['video_name'][$key];

    //                     CourseVideos::create([
    //                         'course_id' => $course_id,
    //                         'section_id' => $sectionIds[$index],
    //                         'video_name' => $videoTitle,
    //                         'video_link' => $uploadedVideo,
    //                         'duration' => $durationInMinutes
    //                     ]);
    //                 }
    //             }
    //         }
    //     }

    //     notify()->success('Upload Successful');
    //     return redirect('/dashboard');
    // }

    public function newupload(Request $request)
    {
        // Set maximum execution time for the script
        ini_set('max_execution_time', 3600);

        // Define validation rules
        $validator = Validator::make($request->all(), [
            'featured_image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'material' => 'nullable|file|mimes:pdf,doc,docx',  // Make material nullable
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'upload_type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'price' => 'required',
            'country' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'section_title' => 'required_if:upload_type,e-course|array',
            'section_title.*' => 'required|string|max:255',
            'sectionId' => 'required_if:upload_type,e-course|array',
            'sectionId.*' => 'required|integer',
            'videos.*.video_file' => 'required_if:upload_type,e-course|array',
            'videos.*.video_file.*' => 'file|mimes:mp4,avi,wmv|max:50000',
            'videos.*.video_name.*' => 'required|string|max:255'
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                notify()->error($error);
            }
            return redirect()->back()->withInput();
        }

        // Generate random image name
        $imageName = rand(11111, 99999) . '.' . $request->file('featured_image')->getClientOriginalExtension();
        $destinationPath = 'images';
        $request->file('featured_image')->move($destinationPath, $imageName);

        // Handle material file if uploaded
        $matName = null;
        if ($request->hasFile('material')) {
            $matName = rand(11111, 99999) . '.' . $request->file('material')->getClientOriginalExtension();
            $matdestinationPath = 'materials';
            $request->file('material')->move($matdestinationPath, $matName);
        }

        // Create new upload record
        $uploads = new Upload();
        $uploads->user_id = Auth::user()->id;
        $uploads->featured_image = $imageName;
        $uploads->title = $request->title;
        $uploads->category = $request->category;
        $uploads->upload_type = $request->upload_type;
        $uploads->start_date = $request->start_date;
        $uploads->end_date = $request->end_date;
        $uploads->price = intval(preg_replace("/[^0-9]/", "", $request->price));
        $uploads->country = $request->country;
        $uploads->address = $request->address;
        $uploads->material = $matName;  // Material can be null now
        $uploads->description = $request->description;
        $uploads->slug_url = Str::slug($request->title);
        $uploads->save();

        $course_id = $uploads->id;

        if ($request->upload_type == 'e-course') {
            $sections = $request->input('section_title');
            $sectionIds = $request->input('sectionId');
            
            foreach ($sections as $index => $section) {
                $courseSection = E_Course_Sections::create([
                    'course_id' => $course_id,
                    'section_title' => $section,
                    'section_id' => $sectionIds[$index], 
                ]);

                $videoData = $request->videos[$sectionIds[$index]] ?? [];
                $ffmpeg = FFMpeg::create();

                if ($request->hasFile('videos.' . $sectionIds[$index] . '.video_file')) {
                    $videoFiles = $request->file('videos.' . $sectionIds[$index] . '.video_file');
                    
                    foreach ($videoFiles as $key => $videoFile) {
                        $video = $ffmpeg->open($videoFile->getPathname());
                        $durationInSeconds = $video->getStreams()->first()->get('duration');
                        $durationInMinutes = round($durationInSeconds / 60);

                        $uploadedVideo = Cloudinary::upload($videoFile->getRealPath(), [
                            "folder" => "videos",
                            "resource_type" => "video"
                        ])->getSecurePath();

                        $videoTitle = $videoData['video_name'][$key];

                        CourseVideos::create([
                            'course_id' => $course_id,
                            'section_id' => $sectionIds[$index],
                            'video_name' => $videoTitle,
                            'video_link' => $uploadedVideo,
                            'duration' => $durationInMinutes
                        ]);
                    }
                }
            }
        }

        notify()->success('Upload Successful');
        return redirect('/dashboard');
    }

    public function updateProfilePic(Request $request)
    {
        $request->validate([
            'profile_pic' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('profile_pic')) {
            $imageName = rand(11111, 99999) . '.' . $request->file('profile_pic')->getClientOriginalExtension();
            $destinationPath = 'storage/users-avatar';
            $upload_success = $request->file('profile_pic')->move($destinationPath, $imageName);
            $user->avatar = $imageName;
            $user->save([]);
        }

        notify()->success('Your Profile has been updated');
        return redirect()->back();
    }

    public function destroy($id){
        $upload = upload::find($id);

        if (!$upload) {
            return redirect()->back()->with('error', 'Upload not found!');
        }
        $upload->delete();
        notify()->error('Your upload has been deleted successfully');
        return redirect('/dashboard');
    }
    public function download($filename)
    {
        // Construct the full path to the file
        $filePath = public_path('materials/' . $filename);

        // Check if the file exists
        if (file_exists($filePath)) {
            notify()->success('Download has started');
            return response()->download($filePath, $filename);
        } else {
            // Handle file not found scenario
            abort(404);
        }
    }
    // pay for course with bank paystack
    public function verifyTransaction($reference, Request $request)
    {

        $user =Auth::user();


        $newpaid = new Paid_courses();
        $newpaid->user_id = $request->userId;
        $newpaid->course_id = $request->courseId;
        $newpaid->reference = $reference;
        $newpaid->course_price = $request->price;
        $newpaid->participants = $request->participants;
        $newpaid->save();   

        notify()->success('Payment Successful');

        $courseInfo = upload::findOrFail($request->courseId);
        $ownerInfo = User::findOrFail($courseInfo->user_id);
        $walletBalance = $ownerInfo->wallet_balance;
        $walletBalance += $request->price;
        $ownerInfo->wallet_balance = $walletBalance;
        $ownerInfo->save();

        $transactionDetails = [
            "status" => "success",
            "merchant" => $ownerInfo->name,
            "amount" => $request->price,
            "description" => "Purchase of " . $courseInfo->title,
            "reference" => $reference,
            "date" => $newpaid->updated_at
        ];

        $transactionDetails = new Transaction();
        $transactionDetails->user_id = Auth::id();
        $transactionDetails->transaction_type = 'Course Payment';
        $transactionDetails->status = 'success';
        $transactionDetails->amount = $request->price;
        $transactionDetails->reference = $reference;
        $transactionDetails->save();

        $message = $request->participants ." person(s) just purchased " . $courseInfo->title; 
        $title = "New Sales"; 
        if ($courseInfo->upload_type == 'e-course') {
            $courseSlug = $courseInfo->slug_url;
            $courseUrl = '/e_course_page/' . $courseSlug;
            return response()->json(['redirect_url' => $courseUrl]);
        }

        Mail::to($user->email)->send(new ReceiptMail($user, $transactionDetails));
        $loggedInUserMessage = "Thank you for purchasing " . $courseInfo->title . "!";
        $loggedInUserTitle = "New Purchase";
        $ownerInfo->notify(new PaidCourses($message, $request->userId, $title, $ownerInfo->id));
        auth()->user()->notify(new PaidCourses($loggedInUserMessage, $request->userId, $loggedInUserTitle, auth()->user()));
        $sec = 'sk_live_b6816f6e2878ebca747ccbd924f77582a75deaff045727461c6cf4b505ecf9e5dad178ee1f413e7f';
        $curl = curl_init();  
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $sec",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $new_data = json_decode($response);

        return[$new_data];
    }

    //fund wallet
    public function fundWallet($reference, Request $request)
    {
        $sec = 'sk_live_b6816f6e2878ebca747ccbd924f77582a75deaff045727461c6cf4b505ecf9e5dad178ee1f413e7f';
        $curl = curl_init();  
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $sec",
            "Cache-Control: no-cache",
            ),
        ));
        
        $numericAmount = $request->numericAmount;
        $response = curl_exec($curl);
        $err = curl_error($curl);



        curl_close($curl);

        $new_data = json_decode($response);
        if ($new_data->status === true) {
            
            $user = Auth::user();
            $user->wallet_balance += $numericAmount;
            $user->save();
            $admin = User::where('user_type', 'admin')->first();
            $admin->wallet_balance += $numericAmount * 0.03;
            // dd($admin->wallet_balance);
            $admin->save();
            

            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->transaction_type = 'deposit';
            $transaction->amount = $numericAmount;
            $transaction->status = 'success'; 
            $transaction->reference = $reference;
            $transaction->save();

            $message = "A deposit of ₦" . number_format($numericAmount) . " was made!"; 
            $title = "New Deposit"; 
            $user->notify(new FundWalletNotification($message, $user->id, $title));

            notify()->success('Your Wallet has been funded');
            return[$new_data];
        } else {
            $user = Auth::user();
            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->transaction_type = 'deposit';
            $transaction->amount = $new_data->data->amount / 100;
            $transaction->status = 'failed'; 
            $transaction->reference = $reference;
            $transaction->save();
            return redirect()->route('dashboard')->with('error', 'Payment failed. Please try again.');
        }
    }

    // withdraw from wallet
    public function withdrawFromWallet(Request $request)
    {
        $user = Auth::user();
        $walletBalance = $user->wallet_balance;
        $walletBalance = preg_replace("/[^0-9]/", "", $walletBalance);
        $walletBalance = (int)$walletBalance;
        $withdrawamount = $request->amount;
        $withdrawamount = preg_replace("/[^0-9]/", "", $withdrawamount);
        $withdrawamount = (int)$withdrawamount;
    
        $passcheck = Hash::check($request->password, $user->password);
    
        if($walletBalance >= $withdrawamount){
            if ($passcheck) {
                $transact = new Transaction();
                $transact->user_id = $user->id;
                $transact->transaction_type = 'withdraw';
                $numericValue = intval(preg_replace("/[^0-9]/", "", $request->amount));
                $transact->amount = $numericValue;
                $transact->status = 'pending'; 
                $transact->reference = rand(1, 1000000000);
                $transact->save();

                $message = "A withdrawal of ₦" . number_format($numericValue) . " was made!"; 
                $title = "New Withdrawal"; 
                $user->notify(new Withdrawal($message, $user->id, $title));
                notify()->success('Withdrawal Request Successful');
                return redirect()->back();
            } else {
                notify()->error('Wrong Password');
                return redirect()->back();
            }
        }else{
            notify()->error('Insufficient Balance');
            return redirect()->back();
        }
    }
    
    public function clearTable()
    {
        $tableName = 'course_videos';

        DB::table($tableName)->truncate();

        return "Table $tableName cleared successfully!";
    }

    public function days(){
        $sevenDaysAgo = Carbon::now()->subDays(7);
        $fourtDaysAgo = Carbon::now()->subDays(14);
        $thirtDaysAgo = Carbon::now()->subDays(30);


        //user count
        $usCount = User::where('user_type', 'user')->count();
        $usCount7 = User::where('user_type', 'user')->where('created_at', '>=', $sevenDaysAgo)->count();
        $usCount14 = User::where('user_type', 'user')->where('created_at', '>=', $fourtDaysAgo)->count();
        $usCount31 = User::where('user_type', 'user')->where('created_at', '>=', $thirtDaysAgo)->count();


        // business count
        $busCount = User::where('user_type', 'business')->count();
        $busCount7 = User::where('user_type', 'business')->where('created_at', '>=', $sevenDaysAgo)->count();
        $busCount14 = User::where('user_type', 'business')->where('created_at', '>=', $fourtDaysAgo)->count();
        $busCount31 = User::where('user_type', 'business')->where('created_at', '>=', $thirtDaysAgo)->count();

        // prof count
        $proCount = User::where('user_type', 'professional')->count();
        $proCount7 = User::where('user_type', 'professional')->where('created_at', '>=', $sevenDaysAgo)->count();
        $proCount14 = User::where('user_type', 'professional')->where('created_at', '>=', $fourtDaysAgo)->count();
        $proCount31 = User::where('user_type', 'professional')->where('created_at', '>=', $thirtDaysAgo)->count();

        // work count
        $workCount = upload::where('upload_type', 'workshop')->count();
        $workCount7 = upload::where('upload_type', 'workshop')->where('created_at', '>=', $sevenDaysAgo)->count();
        $workCount14 = upload::where('upload_type', 'workshop')->where('created_at', '>=', $fourtDaysAgo)->count();
        $workCount31 = upload::where('upload_type', 'workshop')->where('created_at', '>=', $thirtDaysAgo)->count();

        // events count
        $evenCount = upload::where('upload_type', 'events')->count();
        $evenCount7 = upload::where('upload_type', 'events')->where('created_at', '>=', $sevenDaysAgo)->count();
        $evenCount14 = upload::where('upload_type', 'events')->where('created_at', '>=', $fourtDaysAgo)->count();
        $evenCount31 = upload::where('upload_type', 'events')->where('created_at', '>=', $thirtDaysAgo)->count();

        // v-program count
        $virtCount = upload::where('upload_type', 'virtual-program')->count();
        $virtCount7 = upload::where('upload_type', 'virtual-program')->where('created_at', '>=', $sevenDaysAgo)->count();
        $virtCount14 = upload::where('upload_type', 'virtual-program')->where('created_at', '>=', $fourtDaysAgo)->count();
        $virtCount31 = upload::where('upload_type', 'virtual-program')->where('created_at', '>=', $thirtDaysAgo)->count();


        // e-course count
        $eCount = upload::where('upload_type', 'e-course')->count();
        $eCount7 = upload::where('upload_type', 'e-course')->where('created_at', '>=', $sevenDaysAgo)->count();
        $eCount14 = upload::where('upload_type', 'e-course')->where('created_at', '>=', $fourtDaysAgo)->count();
        $eCount31 = upload::where('upload_type', 'e-course')->where('created_at', '>=', $thirtDaysAgo)->count();


        return response()->json([
            'usCount' => $usCount,
            'usCount7' => $usCount7,
            'usCount14' => $usCount14,
            'usCount31' => $usCount31,
            'busCount' => $busCount,
            'busCount7' => $busCount7,
            'busCount14' => $busCount14,
            'busCount31' => $busCount31,
            'proCount' => $proCount,
            'proCount7' => $proCount7,
            'proCount14' => $proCount14,
            'proCount31' => $proCount31,
            'workCount' => $workCount,
            'workCount7' => $workCount7,
            'workCount14' => $workCount14,
            'workCount31' => $workCount31,
            'evenCount' => $evenCount,
            'evenCount7' => $evenCount7,
            'evenCount14' => $evenCount14,
            'evenCount31' => $evenCount31,
            'virtCount' => $virtCount,
            'virtCount7' => $virtCount7,
            'virtCount14' => $virtCount14,
            'virtCount31' => $virtCount31,
            'eCount' => $eCount,
            'eCount7' => $eCount7,
            'eCount14' => $eCount14,
            'eCount31' => $eCount31,
        ]);
    }

    public function userdays(){
        $sevenDaysAgo = Carbon::now()->subDays(7);
        $fourtDaysAgo = Carbon::now()->subDays(14);
        $thirtDaysAgo = Carbon::now()->subDays(30);

        $usCount = User::where('user_type', 'user')->get();
        $usCount7 = User::where('user_type', 'user')->where('created_at', '>=', $sevenDaysAgo)->get();
        $usCount14 = User::where('user_type', 'user')->where('created_at', '>=', $fourtDaysAgo)->get();
        $usCount31 = User::where('user_type', 'user')->where('created_at', '>=', $thirtDaysAgo)->get();
        
        $busCount = User::where('user_type', 'business')->with('business')->get();
        $busCount7 = User::where('user_type', 'business')->where('created_at', '>=', $sevenDaysAgo)->with('business')->get();
        $busCount14 = User::where('user_type', 'business')->where('created_at', '>=', $fourtDaysAgo)->with('business')->get();
        $busCount31 = User::where('user_type', 'business')->where('created_at', '>=', $thirtDaysAgo)->with('business')->get();

        return response()->json([
            'usCount' => $usCount,
            'usCount7' => $usCount7,
            'usCount14' => $usCount14,
            'usCount31' => $usCount31,
            'busCount' => $busCount,
            'busCount7' => $busCount7,
            'busCount14' => $busCount14,
            'busCount31' => $busCount31,
        ]);
    }

    public function fetchWithdrawals(Request $request)
    {
        $user = auth()->user();
        $alltransactions = Transaction::with('user')->get();
        $formattedalltransact = $alltransactions->map(function ($transaction) {
            $transaction->formatted_created_at = $transaction->created_at->diffForHumans();
            return $transaction;
            });

        $adminalldeposit = Transaction::where('transaction_type', 'deposit')
                                ->orderBy('created_at', 'desc')
                                ->with('user') 
                                ->get();
        $formattedallDeposits = $adminalldeposit->map(function ($deposits) {
            $deposits->formatted_created_at = $deposits->created_at->diffForHumans();
            return $deposits;
            });
        $adminallwithdraw = Transaction::where('transaction_type', 'withdraw')
                                ->with('user') 
                                ->get();
        $formattedallwithdraw = $adminallwithdraw->map(function ($withdraws) {
            $withdraws->formatted_created_at = $withdraws->created_at->diffForHumans();
            return $withdraws;
            });
        $adminallsubscribe = Transaction::where('transaction_type', 'subscribe')
                                ->with('user') 
                                ->get();
        $formattedallsubscribe = $adminallsubscribe->map(function ($subscribe) {
            $subscribe->formatted_created_at = $subscribe->created_at->diffForHumans();
            return $subscribe;
            });
        
        $withdrawals = Transaction::where('user_id', $user->id)
                                   ->where('transaction_type', 'withdraw')
                                   ->orderBy('created_at', 'desc')
                                   ->with('user') 
                                   ->get();
        $formattedWithdrawals = $withdrawals->map(function ($withdrawal) {
            $withdrawal->formatted_created_at = $withdrawal->created_at->diffForHumans();
            return $withdrawal;
        });
                                   
        $deposit = Transaction::where('user_id', $user->id)
                                   ->where('transaction_type', 'deposit')
                                   ->orderBy('created_at', 'desc')
                                   ->get();

        $formatteDeposits = $deposit->map(function ($deposits) {
        $deposits->formatted_created_at = $deposits->created_at->diffForHumans();
        return $deposits;
        });
        $subscription = Transaction::where('user_id', $user->id)
                                   ->where('transaction_type', 'subscribe')
                                   ->orderBy('created_at', 'desc')
                                   ->get();
        return response()->json([
            'transactions' => $formattedWithdrawals,
            'deposits' => $formatteDeposits,
            'subscriptions' => $subscription,
            'alldeposits' => $formattedallDeposits,
            'allwithdraws' => $formattedallwithdraw,
            'allsubscribe' => $formattedallsubscribe,
            'alltransactions' => $alltransactions
        ]);
    }

    public function approve(Request $request, $withdrawalRequestId)
    {
        $withdrawalRequest = Transaction::findOrFail($withdrawalRequestId);
    
        $user = User::find($withdrawalRequest->user_id);
    
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }
        $walletBalance = $user->wallet_balance;
        $withdrawalAmount = $withdrawalRequest->amount;
        if ($walletBalance < $withdrawalAmount) {
            return response()->json(['error' => 'Insufficient balance'], 400);
        } else {
            // Update withdrawal request status to 'success' and save
            $withdrawalRequest->status = 'success';
            $withdrawalRequest->save();
            $user->wallet_balance -= $withdrawalAmount;
            $user->save();
            
            return redirect()->back();
        }
    }
    
    public function freeRegistration(){
        Session::flash('free-registration', 'You have successfully registered for this course');
        return redirect()->back();
    }

    public function markAsRead($notificationId)
    {
        // dd($notificationId);
        if($notificationId){
            auth()->user()->notifications->where('id', $notificationId)->markAsRead();
            return back();
        }
    }

    public function editUpload($id)
    {
        $upload = upload::findOrFail($id);
        return response()->json($upload);
    }

    public function updateUpload(Request $request, $id)
    {
        $upload = Upload::findOrFail($id);

        if ($request->hasFile('featured_image')) {
            $imageName = rand(11111, 99999) . '.' . $request->file('featured_image_edit')->getClientOriginalExtension();
            $destinationPath = 'images';
            $upload_success = $request->file('featured_image')->move($destinationPath, $imageName);
            $upload->featured_image = $imageName;
        }
    
        if ($request->hasFile('material')) {
            $matName = rand(11111, 99999) . '.' . $request->file('material_edit')->getClientOriginalExtension();
            $matdestinationPath = 'materials';
            $upload_success_mat = $request->file('material')->move($matdestinationPath, $matName);
            $upload->material = $matName;
        }
   
        if ($request->hasFile('video')) {
            $vidName = rand(11111, 99999) . '.' . $request->file('video_edit')->getClientOriginalExtension();
    
            $viddestinationPath = 'videos';
            $upload_success_vid = $request->file('video')->move($viddestinationPath, $vidName);
            $upload->video = $vidName;
        }

        // $upload->update($request->except(['featured_image', 'material', 'video']));
        $upload->description = $request->description_edit;
        $upload->title = $request->title_edit;
        $upload->category = $request->category_edit;
        $upload->start_date = $request->start_date_edit;
        $upload->end_date = $request->end_date_edit;
        $upload->price = $request->price_edit;
        $upload->country = $request->country_edit;
        $upload->address = $request->address_edit;
        $upload->save();
        // dd($request->description);

        notify()->success('Upload updated successfully');
        return redirect()->back();
    }
    
    public function updateAccount(Request $request){
        $user =Auth::user();
        $user->account_number = $request->account_number;
        $user->account_name = $request->account_name;
        $user->bank_account = $request->bank_account;
        $user->save();
        return redirect()->back();
    }


    // change plan with paystack payment
    public function standardSubscription(Request $request, $reference)
    {
        $user = Auth::user();
        $amount = $request->amount;
        $adminprofit = $amount * 0.03;
        // dd($amount);
        $admin = User::where('user_type', 'admin')->first();
        $admin->wallet_balance += $adminprofit;
        $admin->save();
        if (!$user) {
            abort(403, 'Unauthorized action.');
        }
    
        $business = $user->business;
    
        if (!$business) {
            abort(404, 'Business not found.');
        }
    
        if($request->planType == 'standard listing'){
            $randFeatures = Upload::where('user_id', $business->user_id)
                 ->orderBy('created_at', 'desc')
                 ->where('featured', 0)
                 ->take(5)
                 ->get();
            foreach($randFeatures as $randFeature){
                $randFeature->featured = 1;
                $randFeature->save();
            }
        }elseif($request->planType == 'enterprise listing'){
            $randFeatures = Upload::where('user_id', $business->user_id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            foreach($randFeatures as $randFeature){
                $randFeature->featured = 1;
                $randFeature->save();
            }
        }
        $business->subscription = $request->planType;
        $business->verification_badge = 'true';
        $business->save();

        $transactionDetails = new Transaction();
        $transactionDetails->user_id = Auth::id();
        $transactionDetails->transaction_type = 'Plan Payment';
        $transactionDetails->status = 'success';
        $transactionDetails->amount = $amount;
        $transactionDetails->reference = $reference;
        $transactionDetails->save();
    
        notify()->success('Successfully migrated to ' . ucfirst($request->planType));
        return redirect()->back();
    }

    // change plan with wallet    
    public function standardWalletSubscription(Request $request, $reference)
    {
        $user = Auth::user();
        $amount = $request->amount;
    
        if ($user->wallet_balance >= $amount) {
            $business = $user->business;
            // $subscription = ($amount == '100000') ? 'enterprise listing' : 'standard listing';

            if($request->planType == 'standard listing'){
                $randFeatures = Upload::where('user_id', $business->user_id)
                     ->orderBy('created_at', 'desc')
                     ->where('featured', 0)
                     ->take(5)
                     ->get();
                foreach($randFeatures as $randFeature){
                    $randFeature->featured = 1;
                    $randFeature->save();
                }
            }elseif($request->planType == 'enterprise listing'){
                $randFeatures = Upload::where('user_id', $business->user_id)
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
                foreach($randFeatures as $randFeature){
                    $randFeature->featured = 1;
                    $randFeature->save();
                }
            }
    
            $business->subscription = $request->planType;
            $business->verification_badge = 'true';
            $business->save();
    
            $user->wallet_balance -= $amount;
            $user->save();
            $transactionDetails = new Transaction();
            $transactionDetails->user_id = Auth::id();
            $transactionDetails->transaction_type = 'Plan Payment';
            $transactionDetails->status = 'success';
            $transactionDetails->reference = $reference;
            $transactionDetails->save();
    
            notify()->success('Successfully migrated to ' . ucfirst($request->planType));
        } else {
            notify()->error('Insufficient balance');
        }
    }

    public function kycVerification(Request $request){

        $selfie = rand(11111, 99999) . '.' . $request->file('kyc_selfie')->getClientOriginalExtension();
        $front = rand(11111, 99999) . '.' . $request->file('front_document')->getClientOriginalExtension();
        $back = rand(11111, 99999) . '.' . $request->file('back_document')->getClientOriginalExtension();
        $destinationPath = 'kycdocuments';
        $upload_success = $request->file('kyc_selfie')->move($destinationPath, $selfie);
        $upload_success_mat = $request->file('front_document')->move($destinationPath, $front);
        $upload_success_vid = $request->file('back_document')->move($destinationPath, $back);
        $kyc = new KycVerification();

        $kyc->user_id = Auth::user()->id;
        $kyc->home_address = $request->home_address;
        $kyc->kyc_selfie = $selfie;
        $kyc->phone_number = $request->phone_number;
        $kyc->date_of_birth = $request->date_of_birth;
        $kyc->document_type = $request->document_type;
        $kyc->country = $request->country;
        $kyc->document_number = $request->document_number;
        $kyc->front_document = $front;
        $kyc->back_document = $back;
        $kyc->status = 'pending';
        $kyc->save();

        $user = Auth::user();
        $user->kyc_status = 'pending';
        $user->save();
        notify()->success('KYC Verification in progress');
        return redirect()->back();
    }

    public function approveKyc($id){
        $approve = KycVerification::findOrFail($id);
        $approve->status = 'verified';
        $approve->save();

        $userId = $approve->user_id;
        $user = User::findOrFail($userId);
        $user->kyc_status = 'verified';
        $user->save();
        notify()->success('KYC Aprroved');
        return redirect('/admin');
    }
    public function rejectKyc($id){
        $approve = KycVerification::findOrFail($id);
        $approve->status = 'rejected';
        $approve->save();

        $userId = $approve->user_id;
        $user = User::findOrFail($userId);
        $user->kyc_status = 'rejected';
        $user->save();
        notify()->success('KYC Rejected');
        return redirect('/admin');
    }
    public function approveTutor($id){
        $approve = Tutor::findOrFail($id);
        $approve->status = 'approved';
        $approve->save();
        notify()->success('Tutor Aprroved');
        return redirect('/admin');
    }
    public function rejectTutor($id){
        $approve = Tutor::findOrFail($id);
        $approve->status = 'rejected';
        $approve->save();
        notify()->success('Tutor Rejected');
        return redirect('/admin');
    }
    public function searchController(Request $request){    
        $query = $request->input('query');

        $results = User::where('name', 'like', "%$query%")
        ->where('user_type', 'business')
        ->join('businesses', 'users.id', '=', 'businesses.user_id')
        ->orderByRaw("businesses.subscription = 'enterprise listing' DESC")
        ->with('business')
        ->get();

        $events = upload::where('title', 'like', "%$query%")
        ->where('upload_type', 'events')
        ->with('user')
        ->get();
        $work = upload::where('title', 'like', "%$query%")
        ->where('upload_type', 'workshop')
        ->with('user')
        ->get();

        $trainCount = User::where('name', 'like', "%$query%")
                        ->where('user_type', 'business')
                        ->count();
        $evenCount = upload::where('title', 'like', "%$query%")
                        ->where('upload_type', 'events')
                        ->count();
        $workCount = upload::where('title', 'like', "%$query%")
                        ->where('upload_type', 'workshop')
                        ->count();


        return response()->json([
            'results' => $results,
            'trainCount' => $trainCount,
            'events' => $events,
            'work' => $work,
            'evenCount' => $evenCount,
            'workCount' => $workCount,
        ]);
    }

    public function adsSubmit(Request $request){

        $banner = rand(11111, 99999) . '.' . $request->file('ads_banner')->getClientOriginalExtension();
        $destinationPath = 'adsbanner';
        $upload_success = $request->file('ads_banner')->move($destinationPath, $banner);

        $ads = new Ads();
        $ads->user_id = Auth::user()->id;
        $ads->ads_type = $request->ads_type;
        $ads->ads_status = 'pending';
        $ads->ads_banner = $banner;
        $ads->ads_link = $request->ads_link;
        $ads->save();
        notify()->success('Ads Submitted For Review');
        return redirect()->back();
    }

    public function approveAd($id){
        $approve = Ads::findOrFail($id);
        $approve->ads_status = 'active';
        $approve->date_of_approval = Carbon::now();
        $approve->save();

        notify()->success('Ad Approved');
        return redirect('/admin');
    }   

    public function rejectAd($id){
        $approve = Ads::findOrFail($id);
        $approve->ads_status = 'rejected';
        $approve->save();

        $adtype = AdType::where('name', $approve->ads_type)->first();
        $price = $adtype->price;

        $ownerId = $approve->user_id;
        $user = User::findOrFail($ownerId);
        $admin = User::where('user_type', 'admin')->first();

        $user->wallet_balance+= $price;
        $user->save();
        $admin->wallet_balance-= $price;
        $admin->save();

        notify()->error('Ad Rejected');
        return redirect('/admin');
    }

    public function getTopBannerImages(Request $request)
    {
        $banners = Ads::where('ads_type', 'top banner')
                        ->where('ads_status', 'active')
                        ->select('ads_banner', 'ads_link','id') 
                        ->get();
        $images = $banners->map(function ($banner) {
            return [
                'image_url' => asset('adsbanner/' . $banner->ads_banner),
                'link' => $banner->ads_link,
                'id' => $banner->id,
            ];
        })->toArray();
        return response()->json($images);
    }
    public function getpromotedBannerImages(Request $request)
    {
        $banners = Ads::where('ads_type', 'promoted banner')
                        ->where('ads_status', 'active')
                        ->select('ads_banner', 'ads_link','id') 
                        ->get();
        $images = $banners->map(function ($banner) {
            return [
                'image_url' => asset('adsbanner/' . $banner->ads_banner),
                'link' => $banner->ads_link,
                'id' => $banner->id,
            ];
        })->toArray();
        return response()->json($images);
    }

    public function checkPassword(Request $request)
    {
        $user = Auth::user();
        $userPassword = $user->password;
        if (Hash::check($request->password, $userPassword)) {
            return response()->json(['status' => 'success']);
        } else {
            notify()->error('Wrong Password');
            return response()->json(['status' => 'error']);
        }
    }

    // pay course with wallet

    public function payCourseWithWallet($reference, Request $request)
    {
        $user = Auth::user();
        $walletBal = $user->wallet_balance;
        $amount = $request->price;

        if($walletBal >= $amount){
            $newpaid = new Paid_courses();
            $newpaid->user_id = $request->userId;
            $newpaid->course_id = $request->courseId;
            $newpaid->reference = $reference;
            $newpaid->course_price = $request->price;
            $newpaid->participants = $request->participants;
            $newpaid->save();   
    
            notify()->success('Payment Successful');
    
            $courseInfo = upload::findOrFail($request->courseId);
            $ownerInfo = User::findOrFail($courseInfo->user_id);
            $walletBalance = $ownerInfo->wallet_balance;
            $walletBalance += $request->price;
            $ownerInfo->wallet_balance = $walletBalance;
            $ownerInfo->save();

            $walletBal -= $request->price;
            $user->wallet_balance = $walletBal;
            $user->save();

            $transactionDetails = new Transaction();
            $transactionDetails->user_id = Auth::id();
            $transactionDetails->transaction_type = 'Course Payment';
            $transactionDetails->status = 'success';
            $transactionDetails->reference = $reference;
            $transactionDetails->save();
    
    
            $message = $request->participants ." person(s) just purchased " . $courseInfo->title; 
            $title = "New Sales"; 
            if ($courseInfo->upload_type == 'e-course') {
                $courseSlug = $courseInfo->slug_url;
                $courseUrl = '/e_course_page/' . $courseSlug;
                return response()->json(['redirect_url' => $courseUrl]);
            }

            $loggedInUserMessage = "Thank you for purchasing " . $courseInfo->title . "!";
            $loggedInUserTitle = "New Purchase";
            $ownerInfo->notify(new PaidCourses($message, $request->userId, $title, $ownerInfo->id));
            auth()->user()->notify(new PaidCourses($loggedInUserMessage, $request->userId, $loggedInUserTitle, auth()->user()));
            return response()->json(['redirect_url' => '/dashboard']);
        }else{
            notify()->error('Insufficient Balance');
            return response()->json(['redirect_url' => '/dashboard']);
        }
        
    }

    //pay ads with wallet 
    public function adsWallet($reference, Request $request){
        $user = Auth::user();
        $walletBal = $user->wallet_balance;
        $price = $request->price;

        $admin = User::where('user_type', 'admin')->first();
        $admin->wallet_balance += $price;
        $admin->save();

        if($walletBal >= $price){
            $banner = rand(11111, 99999) . '.' . $request->file('adBanner')->getClientOriginalExtension();
            $destinationPath = 'adsbanner';
            $upload_success = $request->file('adBanner')->move($destinationPath, $banner);


            $ads = new Ads();
            $ads->user_id = $user->id;
            $ads->ads_type = $request->adType;
            $ads->ads_status = 'pending';
            $ads->ads_link = $request->adLink;
            $ads->reference = $reference;
            $ads->ads_banner = $banner;
            $ads->payment_source = "wallet";
            $ads->save();

            $walletBal -= $request->price;
            $user->wallet_balance = $walletBal;
            $user->save();
            $transactionDetails = new Transaction();
            $transactionDetails->user_id = Auth::id();
            $transactionDetails->transaction_type = 'Ads Payment';
            $transactionDetails->status = 'success';
            $transactionDetails->amount = $price;
            $transactionDetails->reference = $reference;
            $transactionDetails->save();

            notify()->success('Ads Submitted for Review');
        }else{
            notify()->error('Innsufficient Balance');
        }
    }

    // pay ads with bank
    public function adsPaystack($reference, Request $request){
        // dd('hi');
        $user = Auth::user();
        $amount = $request->price;
        $paycharges = $amount * 0.03;

        $adminprofit = $amount + $paycharges;
        // dd($adminprofit);

        $sec = 'sk_live_b6816f6e2878ebca747ccbd924f77582a75deaff045727461c6cf4b505ecf9e5dad178ee1f413e7f';
        $curl = curl_init();  
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $sec",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $new_data = json_decode($response);


        if($user){
            $banner = rand(11111, 99999) . '.' . $request->file('adBanner')->getClientOriginalExtension();
            $destinationPath = 'adsbanner';
            $upload_success = $request->file('adBanner')->move($destinationPath, $banner);


            $ads = new Ads();
            $ads->user_id = $user->id;
            $ads->ads_type = $request->adType;
            $ads->ads_status = 'pending';
            $ads->ads_link = $request->adLink;
            $ads->reference = $reference;
            $ads->ads_banner = $banner;
            $ads->payment_source = "bank";
            $ads->save();

            $admin = User::where('user_type', 'admin')->first();
            $admin->wallet_balance += $adminprofit;
            $admin->save();

            notify()->success('Ads Submitted for Review');
            $transactionDetails = new Transaction();
            $transactionDetails->user_id = Auth::id();
            $transactionDetails->transaction_type = 'Ads Payment';
            $transactionDetails->status = 'success';
            $transactionDetails->amount = $amount;
            $transactionDetails->reference = $reference;
            $transactionDetails->save();
            return[$new_data];
        }else{
            notify()->error('Error Processing Payment');
        }
    }
    public function impressions(Request $request)
    {
        $advertisement = Ads::findOrFail($request->ad_id);
        $advertisement->increment('impressions');

    }
    public function clicks(Request $request)
    {
        $advertisement = Ads::findOrFail($request->ad_id);
        $advertisement->increment('clicks');

    }
    public function getFeaturePrice(Request $request)
    {
        // Validate the request
        $request->validate([
            'type' => 'required|string', // Assuming 'type' is the parameter sent in the request
        ]);



        // Retrieve the feature price based on the type
        $featureType = $request->input('type');
        $feature = Featuring::where('feature_name', $featureType)->first();

        // Check if the feature exists
        if ($feature) {
            // Return the feature price as JSON
            return response()->json([
                'feature_price' => $feature->feature_price,
            ]);
        } else {
            // If the feature doesn't exist, return an error response
            return response()->json([
                'error' => 'Feature not found',
            ], 404);
        }
    }

    // pay for featuring with wallet
    public function featuresAdsWallet(Request $request){
        $validatedData = $request->validate([
            'uploadId' => 'nullable|exists:uploads,id',
            'featureType' => 'required|string|exists:featurings,feature_name',
        ]);
    
        $user = Auth::user();
        $featureType = Featuring::where('feature_name', $validatedData['featureType'])->first();
    
        if ($user->wallet_balance >= $featureType->feature_price) {
            // Determine the feature type and process accordingly
            if ($featureType->feature_name == 'business') {
                $user->business->featured = 1;
                $user->wallet_balance -= $featureType->feature_price;
                $user->save();
                $user->business->save();
            } elseif ($featureType->feature_name == 'tutor') {
                $user->professional->featured = 1;
                $user->wallet_balance -= $featureType->feature_price;
                $user->save();
                $user->professional->save();
            } else {
                // Ensure uploadId is provided for non-business and non-tutor features
                if (isset($validatedData['uploadId'])) {
                    $upload = Upload::findOrFail($validatedData['uploadId']);
                    $upload->featured = 1;
                    $upload->date_of_featuring = Carbon::now();
                    $upload->save();
                    $user->wallet_balance -= $featureType->feature_price;
                    $user->save();
                } else {
                    return response()->json(['error' => 'Upload ID is required for this feature type'], 400);
                }
            }
            notify()->success('Featured Successful');
        } else {
            notify()->error('Insufficient Balance');
        }
    }
    

    // pay for featuring with paystack
    public function featuresAdsPay($reference, Request $request){
        $sec = 'sk_live_b6816f6e2878ebca747ccbd924f77582a75deaff045727461c6cf4b505ecf9e5dad178ee1f413e7f';
        $curl = curl_init();  
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $sec",
            "Cache-Control: no-cache",
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        $new_data = json_decode($response);

        // dd($request->featureType);
        if($request->featureType == 'business'){
            $user = Auth::user();
            $business = Business::where('user_id', $user->id)->first();
            if($business && $business->featured == 0){
                $business->featured = 1;
                $business->save();
                notify()->success('Sucessfully featured business');
                return redirect()->back();
            }
        }
        $upload = upload::findOrFail($request->uploadId);
        $featureType = Featuring::where('feature_name', $request->featureType)->first();
        dd($featureType);
        $user = Auth::user();

        $upload->featured = 1;
        $upload->date_of_featuring = Carbon::now();
        $upload->save();
        notify()->success('Featured Succesful');

        return[$new_data];
    }
    public function store(Request $request, $course_id)
    {
        $participants = $request->input('participants');

        foreach ($participants as $participant) {
            Participants::create([
                'user_id' => Auth::id(),
                'course_id' => $course_id,
                'reference' => $request->reference,
                'participant_name' => $participant
            ]);
        }

        return redirect()->back();
    }
    public function certificate($courseId, Request $request){
        $cert = new Certificate();
        $cert->user_id = Auth::id();
        $cert->course_id = $courseId;
        $cert->host_name = $request->host_name;
        $cert->save();

        $ready = upload::findOrFail($courseId);
        $ready->certificate_status = 'ready';
        $ready->save();

        return redirect()->back();
    }

    public function searchCertificate(Request $request)
    {
        $certificateId = $request->input('certificateId');
        $certificate = Participants::with('host')->where('certificate_reference_id', $certificateId)->first();

        if ($certificate) {
            return response()->json([
                'success' => true,
                'certificate' => $certificate
            ]);
        } else {
            notify()->error('Certificate not Found');
            return response()->json([
                'success' => false,
                'message' => 'Certificate not found.'
            ]);
        }
    }
    public function postnews(Request $request){
        $news = new News();
        $news->admin_id = Auth::id();
        $news->title = $request->title;
        $news->news_content = $request->news_content;
        $news->news_url = Str::slug($request->title);
        if ($request->hasFile('featured_image')) {
            $imageName = rand(11111, 99999) . '.' . $request->file('featured_image')->getClientOriginalExtension();
            $destinationPath = 'newsimage';
            $upload_success = $request->file('featured_image')->move($destinationPath, $imageName);
            $news->featured_image = $imageName;
        }           
        $news->save();
        notify()->success('Post Successful');
        return redirect()->back();
    }
    public function deleteNews($id)
    {
        $news = News::find($id);
        if (!$news) {
            notify()->error('News item not found');
            return redirect()->back();
        }

        $news->delete();

        notify()->success('News item deleted successfully');

        return redirect()->back();
    }

    public function loginFirst(){
        notify()->error(('Pls Login First'));
        return redirect()->back();
    }
    public function swap(Request $request){
        $current_feature = $request->current_upload_id;
        $next_feature = $request->swap_upload_id;

        $current = upload::findOrFail($current_feature);
        $current->featured = 0;
        $current->save();

        $next = upload::findOrFail($next_feature);
        $next->featured = 1;
        $next->save();

        notify()->success('Swap successful');
        return redirect()->back();
    }

    public function createCategory(Request $request){
        $newcategory = new Category();

        $newcategory->name = $request->category_name;
        $newcategory->description = $request->category_description;
        $imageName = rand(11111, 99999) . '.' . $request->file('category_image')->getClientOriginalExtension();
        $destinationPath = 'categoryimages';
        $upload_success = $request->file('category_image')->move($destinationPath, $imageName);
        $newcategory->category_image = $imageName;
        $newcategory->slug =  Str::slug($newcategory->name);
        $newcategory->save();

        notify()->success('Category Created');
        return redirect()->back();
    }
    public function addTopBanner(Request $request){
        $imageName = rand(11111, 99999) . '.' . $request->file('banner_image')->getClientOriginalExtension();
        $destinationPath = 'defaultimages';
        $upload_success = $request->file('banner_image')->move($destinationPath, $imageName);
        
        $banner = new DefaultImages();
        $banner->image_location = $imageName;
        $banner->banner_name = 'Home Top Banner';
        $banner->image_link = $request->image_link;
        $banner->save();
        return redirect()->back();
    }
    public function addPromotedBanner(Request $request){
        $imageName = rand(11111, 99999) . '.' . $request->file('banner_image')->getClientOriginalExtension();
        $destinationPath = 'defaultimages';
        $upload_success = $request->file('banner_image')->move($destinationPath, $imageName);
        
        $banner = new DefaultImages();
        $banner->image_location = $imageName;
        $banner->banner_name = 'Home Promoted Banner';
        $banner->image_link = $request->image_link;
        $banner->save();
        return redirect()->back();
    }
    public function addInpageBanner(Request $request){
        $imageName = rand(11111, 99999) . '.' . $request->file('banner_image')->getClientOriginalExtension();
        $destinationPath = 'defaultimages';
        $upload_success = $request->file('banner_image')->move($destinationPath, $imageName);
        
        $banner = new DefaultImages();
        $banner->image_location = $imageName;
        $banner->banner_name = 'Inpage Promoted Banner';
        $banner->image_link = $request->image_link;
        $banner->save();
        return redirect()->back();
    }
    public function addSideBanner(Request $request){
        $imageName = rand(11111, 99999) . '.' . $request->file('banner_image')->getClientOriginalExtension();
        $destinationPath = 'defaultimages';
        $upload_success = $request->file('banner_image')->move($destinationPath, $imageName);
        
        $banner = new DefaultImages();
        $banner->image_location = $imageName;
        $banner->banner_name = 'Home Side Banner';
        $banner->image_link = $request->image_link;
        $banner->save();
        return redirect()->back();
    }
    public function deleteBanner($id) {
        $banner = DefaultImages::findOrFail($id);
        
        $count = DefaultImages::where('banner_name', $banner->banner_name)->count();
        
        if ($count <= 1) {
            notify()->error('Cannot delete the last banner of this type.');
            return redirect()->back();
        }
        
        $banner->delete();
        notify()->success('Banner Deleted');
        return redirect()->back();
    }
    public function tutorRegister(Request $request){
        $formattedPrice = $request->input('rate_per_hour');
        $priceWithoutSymbol = str_replace('₦', '', $formattedPrice);
        $priceWithoutCommas = str_replace(',', '', $priceWithoutSymbol);
        $rph = intval($priceWithoutCommas);

        $imageName = rand(11111, 99999) . '.' . $request->file('headshot')->getClientOriginalExtension();
        $destinationPath = 'headshots';
        $upload_success = $request->file('headshot')->move($destinationPath, $imageName);
        $vidName = rand(11111, 99999) . '.' . $request->file('video')->getClientOriginalExtension();
        $viddestinationPath = 'about-videos';
        $upload_success = $request->file('video')->move($viddestinationPath, $vidName);

        $user = Auth::user();
        $user->user_type = 'tutor';
        $user->save();

        $tutor = new Tutor();
        $tutor->user_id = $user->id;
        $tutor->category = $request->category;
        $tutor->description = $request->description;
        $tutor->rate_per_hour = $rph;
        $tutor->availability = $request->availability;
        $tutor->headshot = $imageName;
        $tutor->video= $vidName;

        $tutor->save();
        
        notify()->success('Tutor Registration Successful');
        return redirect('/dashboard');
    }
    public function businessRegister(Request $request){

        $user = Auth::user();
        $user->user_type = 'business';
        $user->save();

        $business = new Business();
        $business->user_id = $user->id;
        $business->businessname = $request->businessname;
        $business->website = $request->website;
        $business->description = $request->description;
        $business->subscription = 'basic listing';
        $business->verification_badge = false;
        $business->business_type = 'training provider';
        $business->contact_person = $request->contact_person;
        $business->business_slug = Str::slug($request->businessname);
        $business->save();
        
        notify()->success('Business Registration Successful');
        return redirect('/dashboard');
    }
    public function reviewsStore(Request $request)
    {
        // dd($request->tutor_id);
        // Validate the request
        $validatedData = $request->validate([
            'review' => 'required|string|max:500',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // Store the review and rating
        $review = new Reviews();
        $review->content = $validatedData['review'];
        $review->rating = $validatedData['rating'];
        $review->user_id = auth()->id(); // If user authentication is required
        $review->tutor_id = $request->tutor_id;
        $review->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Thank you for your review!');
    }

    public function createBooking(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]{11}$/',
            'sessionType' => 'required|in:online,physical',
            'sessionDate' => 'required|date|after:now',
            'duration' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $tutor = Tutor::findOrFail($request->tutor_id);
        $ratePerHour = $tutor->rate_per_hour; 
        $totalAmount = $ratePerHour * $request->duration; 

        $booking = new Bookings();
        $booking->student_id = Auth::id(); 
        $booking->tutor_id = $request->tutor_id; 
        $booking->address = $request->address; 
        $booking->phone = $request->phone; 
        $booking->session_type = $request->sessionType; 
        $booking->start_time = Carbon::parse($request->sessionDate); 
        $booking->duration = $request->duration; 
        $booking->end_time = $this->calculateEndTime($request->sessionDate, $request->duration); 
        $booking->notes = $request->notes; 
        $booking->status = 'pending'; 
        $booking->rate = $ratePerHour; 
        $booking->total_amount = $totalAmount; 
        $booking->save(); 


       notify()->success('Booking request submitted successfully! The tutor will review your request.');
        return redirect()->back();
    }
    protected function calculateEndTime($startTime, $duration)
    {
        return Carbon::parse($startTime)->addHours($duration); 
    }
    public function rejectBooking($id)
    {
        $booking = Bookings::findOrFail($id); 
        $booking->status = 'rejected'; 
        $booking->save(); 


        notify()->success('Booking rejected successfully.');
        return redirect()->back()->with('success', 'Booking rejected successfully.');
    }
    public function confirmBooking($id)
    {
        $booking = Bookings::findOrFail($id); 
        $booking->status = 'confirmed'; 
        $booking->save(); 

        notify()->success('Booking Confirmed successfully.');
        return redirect()->back()->with('success', 'Booking Confirmed successfully.');
    }

    public function payForBookingPaystack(Request $request, $reference)
    {
        $validatedData = $request->validate([
            'numericAmount' => 'required|numeric|min:0',
            'email' => 'required|email'
        ]);

        $numericAmount = $validatedData['numericAmount'];

        $paystackSecretKey = env('PAYSTACK_SECRET_KEY');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $paystackSecretKey",
                "Cache-Control: no-cache",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {

            return response()->json([
                'status' => false,
                'message' => 'Payment verification failed. Please try again.'
            ], 500);
        }

        // Decode the JSON response
        $new_data = json_decode($response);

        if (!$new_data || !isset($new_data->status)) {

            return response()->json([
                'status' => false,
                'message' => 'Invalid response from payment gateway.'
            ], 500);
        }

        // Check transaction success
        if ($new_data->status === true && $new_data->data->status === 'success') {
            $user = Auth::user();
            $tutor = Tutor::find($request->tutorId);
            $booking = Bookings::find($request->bookingId);

            $tutor->user->wallet_balance = $numericAmount;
            $tutor->user->save();

            $booking->status = 'paid';
            $booking->save();
           
            
            return response()->json([
                'status' => true,
                'message' => 'Wallet has been successfully funded.'
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Payment failed. Please try again.'
            ]);
        }
    }

    public function editNews($id)
    {
        $news = News::findOrFail($id);
        return response()->json($news);
    }

    public function updatenews(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $news->title = $request->input('title', $news->title);
        $news->news_content = $request->input('news_content', $news->news_content);
        $news->news_url = Str::slug($request->input('title', $news->title));

        // Check if a new featured image is uploaded
        if ($request->hasFile('featured_image')) {
            // Delete the old featured image if it exists
            // if ($news->featured_image) {
            //     $oldImagePath = public_path('newsimage/' . $news->featured_image);
            //     if (file_exists($oldImagePath)) {
            //         unlink($oldImagePath);
            //     }
            // }

            // Upload the new featured image
            $imageName = rand(11111, 99999) . '.' . $request->file('featured_image')->getClientOriginalExtension();
            $destinationPath = 'newsimage';
            $upload_success = $request->file('featured_image')->move($destinationPath, $imageName);
            $news->featured_image = $imageName;
        }

        // Save the updated news item
        $news->save();

        // Notify the user of success
        notify()->success('Update Successful');

        // Redirect back to the previous page
        return redirect()->back();
    }

    public function updateFeaturedAds($uploadId){
        $id = $uploadId;

        $upload = upload::findOrFail($uploadId);

        if($upload->featured == 1){
            $upload->featured = 0;
            $upload->save();
            notify()->success('Featured Ads Unset Successfully');
            return redirect()->back();
        }else {
            $upload->featured = 1;
            $upload->save();
            notify()->success('Featured Ads Set Successfully');
            return redirect()->back();
        }
    }

}
