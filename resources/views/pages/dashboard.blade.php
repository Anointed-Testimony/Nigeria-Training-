@extends('master')
@section('content-pages')
    @if(Session::has('login-success'))
    <div style="z-index: 9999" class="alert alert-danger">
        <div class="popup" id="error">
            <div class="popup-content">
                <div class="title">
                    <h3 style="color: #3d8a60">Welcome Back <i style="color: white; background-color:#3d8a60; border-radius:50%; padding:5px" class="fa-solid fa-check"></i></h3>
                </div>
                <p class="para">{{ Session::get('login-success') }}</p>
                <div class="progress-container">
                    <div id="progress-bar"></div>
                </div>
            </div>

        </div>
    </div>
    @elseif (Session::has('profile-update-success'))
        <div style="z-index: 9999" class="alert alert-danger">
            <div class="popup" id="error">
                <div class="popup-content">
                    <div class="title">
                        <h3 style="color: #3d8a60">Success<i style="color: white; background-color:#3d8a60; border-radius:50%; padding:5px" class="fa-solid fa-check"></i></h3>
                    </div>
                    <p class="para">{{ Session::get('profile-update-success') }}</p>
                    <div class="progress-container">
                        <div id="progress-bar"></div>
                    </div>
                </div>
    
            </div>
        </div>
    @elseif (Session::has('withdraw-request-sent'))
        <div style="z-index: 9999" class="alert alert-danger">
            <div class="popup" id="error">
                <div class="popup-content">
                    <div class="title">
                        <h3 style="color: #3d8a60">Success<i style="color: white; background-color:#3d8a60; border-radius:50%; padding:5px" class="fa-solid fa-check"></i></h3>
                    </div>
                    <p class="para">{{ Session::get('withdraw-request-sent') }}</p>
                    <div class="progress-container">
                        <div id="progress-bar"></div>
                    </div>
                </div>
    
            </div>
        </div>
        @elseif (Session::has('withdraw-wrong-password'))
        <div style="z-index: 9999" class="alert alert-danger">
            <div class="popup" id="error">
                <div class="popup-content">
                    <div class="title">
                        <h3>Sorry :(</h3>
                    </div>
                    <p class="para">{{ Session::get('withdraw-wrong-password') }}</p>
                    <div class="progress-container">
                        <div id="progress-bar"></div>
                    </div>
                </div>
    
            </div>
        </div>
        @elseif (Session::has('withdraw-insufficient-balance'))
        <div style="z-index: 9999" class="alert alert-danger">
            <div class="popup" id="error">
                <div class="popup-content">
                    <div class="title">
                        <h3>Sorry :(</h3>
                    </div>
                    <p class="para">{{ Session::get('withdraw-insufficient-balance') }}</p>
                    <div class="progress-container">
                        <div id="progress-bar"></div>
                    </div>
                </div>
    
            </div>
        </div>
    @endif
    
    {{-- <form id="serachForm" class="search-form" action="">
        <input id="searchInput" type="search" name="search-input" class="search-input" placeholder="What are you looking for? type, location, events, training">
        <div style="z-index: 1000" id="searchResultContainer">
            <div class="search_top">
                <div class="search_top_tabs">
                    <p id="trainText" class="search_back">Training Providers()</p>
                    <p id="evenText">Events()</p>
                    <p id="workText">Workshops()</p>
                    <p>Virtual Program()</p>
                    <p>Facilitators()</p>
                    <p>Consultants()</p>
                </div>
                <hr class="search_divider">
            </div>
            <div id="searchBoxResults" class="search_results_container">
            </div>
            <div id="eventsBoxResults" class="search_results_container">
            </div>
            <div id="workBoxResults" class="search_results_container">
            </div>
        </div>
        <button class="search-button">Search</button>
    </form> --}}
    <div class="profile-container">
        <div class="placeholder" style="background-image: url({{asset('assets/images/placeholder.jpg')}})">
            <form action="{{route('profile')}}" method="POST" enctype="multipart/form-data" style="display: flex; justify-content:center; align-items:center">
                @csrf
                <div class="profile_pic" style="background-color: none">
                    <img class="profile-img" src="{{asset("/storage/users-avatar/$profile")}}" alt="">
                </div>
                <label for="upload" class="camera" class="upload-label">
                    <i class="fa-solid fa-camera"></i>                    
                    <p>Upload Image</p>
                    <input type="file" name="profile_pic" id="upload" class="upload" accept=".png, .jpg" onchange="showSaveButton(); displayImages(this)">
                </label>
                <button style="margin-left: 20px; display:none" type="Submit" id="saveButton">Save</button>
            </form>
            <div style="color:white; font-size:20px; display:flex; gap:20px">
                <a style="position: relative" href="{{url('/chat')}}">
                    <i style="background-color: #bdbdbd;padding:10px; border-radius:50%" class="fa-regular fa-comment-dots"></i>
                    @if ($messageNotifications->count() == 0)
                    <div style="display: none" class="unread_not">{{$messageNotifications}}</div>
                    @else
                        <div class="unread_not">{{$messageNotifications->count()}}</div>
                    @endif
                </a>
                <div onclick="openNotification()" class="not-container">
                    <i style="background-color: #bdbdbd;padding:10px; border-radius:50%" class="fa-solid fa-bell"></i>
                    @if ($unreadCount == '0')
                        <div style="display: none" class="unread_not">{{$unreadCount}}</div>
                    @else
                        <div class="unread_not">{{$unreadCount}}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <section class="dashboard-container">
        <div class="edit_profile">
            <div class="profile_con">
                <p>Profile</p>
                <a id="edit_profile_link" href="javascript:void(0)">Edit Profile</a>
            </div>
            <div class="info_con">
                @if (Auth::user()->user_type === 'user')
                <div class="infos">
                    <i class="fa-solid fa-user"></i>
                    <p>{{ Auth::user()->firstname}} {{ Auth::user()->lastname }}</p>
                </div>
                <div class="infos">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>{{ Auth::user()->address}}</p>
                </div>
                <div class="infos">
                    <i class="fa-solid fa-envelope"></i>
                    <p class="dash_overflow">{{ Auth::user()->email}}</p>
                </div>
                <div class="infos">
                    <i class="fa-solid fa-phone"></i>
                    <p>{{ Auth::user()->telephone}}</p>
                </div>
                <div class="infos">
                    <i class="fa-solid fa-earth-americas"></i>
                    <p>{{ Auth::user()->country}}</p>
                </div>
                <div class="infos">
                    <i class="fa-solid fa-earth-africa"></i>
                    <p>{{ Auth::user()->state}}</p>
                </div>
                <div class="infos">
                    <i class="fa-regular fa-calendar"></i>
                    <p>{{ Auth::user()->date_of_birth}}</p>
                </div>
                @endif
                @if (Auth::user()->user_type === 'business' || Auth::user()->user_type === 'tutor')
                <div class="infos">
                    <i class="fa-solid fa-user"></i>
                    <p>{{ Auth::user()->firstname}} {{ Auth::user()->lastname }}</p>
                </div>
                <div class="infos">
                    <i class="fa-solid fa-location-dot"></i>
                    <p>{{ Auth::user()->address}}</p>
                </div>
                <div class="infos">
                    <i class="fa-solid fa-envelope"></i>
                    <p class="dash_overflow">{{ Auth::user()->email}}</p>
                </div>
                <div class="infos">
                    <i class="fa-solid fa-phone"></i>
                    <p>{{ Auth::user()->telephone}}</p>
                </div>
                @if (Auth::user()->user_type === 'business')
                    <div class="infos">
                        <i class="fa-solid fa-briefcase"></i>
                        <p>{{$businessName}}</p>
                    </div>
                    <div class="infos">
                        <i class="fa-solid fa-globe"></i>
                        <p>{{$website}}</p>
                    </div>
                @endif
                <div class="infos">
                    <i class="fa-solid fa-pen-to-square"></i>
                    @if (Auth::user()->user_type == 'business')
                    <p>{{Auth::user()->business->description}}</p>
                    @else
                    <p>{{Auth::user()->tutor->description}}</p>
                    @endif
                </div>
                @endif
            </div>
        </div>
        <div class="dashboard">
            <div class="dashboard-menus">
                @if (Auth::user()->user_type === 'user')
                <div id="paid-courses" class="back tab">
                    <i class="fa-solid fa-credit-card"></i>
                    <p>My Courses</p>
                </div>
                <div id="wallet" class="tab">
                    <i class="fa-solid fa-wallet"></i>
                    <p>Wallet</p>
                </div>
                <div id="cert" class="tab certificate_dropdown_container">
                    <i class="fa-solid fa-certificate"></i>
                    <p>Certificates</p>
                </div>
                <div id="kyc" class="tab">
                    <i class="fa-solid fa-id-card"></i>
                    <p>KYC Verification</p>
                </div>
                <div id="settings" class="tab">
                    <i class="fa-solid fa-gear"></i>
                    <p>Settings</p>
                </div>
                @endif
                @if (Auth::user()->user_type === 'business')
                <div id="allupload" class="back tab">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <p>All Uploads</p>
                </div>
                <div id="wallet" class="tab">
                    <i class="fa-solid fa-wallet"></i>
                    <p>Wallet</p>
                </div>
                <div id="metrics" class="tab">
                    <i class="fa-solid fa-chart-simple"></i>
                    <p>Metrics</p>
                </div>
                <div id="uploading" class="tab">
                    <i class="fa-solid fa-upload"></i>
                    <p>Upload</p>
                </div>
                <div id="settings" class="tab">
                    <i class="fa-solid fa-gear"></i>
                    <p>Settings</p>
                </div>
                <div id="kyc" class="tab">
                    <i class="fa-solid fa-id-card"></i>
                    <p>KYC Verification</p>
                </div>
                <div onclick="showDashMenu()" id="dash_more">
                    <i class="fa-solid fa-bars"></i>
                </div>
                @endif
                @if (Auth::user()->user_type === 'tutor')
                <div id="student" class="tab">
                    <i class="fa-solid fa-graduation-cap"></i>
                    <p>Bookings</p>
                </div>
                <div id="wallet" class="tab">
                    <i class="fa-solid fa-wallet"></i>
                    <p>Wallet</p>
                </div>
                <div id="settings" class="tab">
                    <i class="fa-solid fa-gear"></i>
                    <p>Settings</p>
                </div>
                <div id="kyc" class="tab">
                    <i class="fa-solid fa-id-card"></i>
                    <p>KYC Verification</p>
                </div>
                @if (Auth::user()->user_type == 'business')
                <div onclick="showDashMenu()" id="dash_more">
                    <i class="fa-solid fa-bars"></i>
                </div>
                @endif
                @endif
            </div>
            <div class="menu_dropdown">
                <div class="premium_listings_dropdown_container dropdown_container">
                    <i class="fa-solid fa-coins"></i>
                    <p>Premium Listings</p>
                </div>
                <div class="plan_dropdown_container dropdown_container">
                    <i class="fa-solid fa-check-to-slot"></i>
                    <p>Subscription plan</p>
                </div>
                <div class="ads_dropdown_container dropdown_container">
                    <i class="fa-solid fa-bullhorn"></i>
                    <p>Ads</p>
                </div>
                <div class="certificate_dropdown_container dropdown_container">
                    <i class="fa-solid fa-certificate"></i>
                    <p>Certificates</p>
                </div>
                <div class="feature_dropdown_container dropdown_container">
                    <i class="fa-solid fa-award"></i>
                    <p>Featurings</p>
                </div>
            </div>
            @if (Auth::user()->user_type == 'business')
            <section style="display: none" id="allupload-section">
                @if ($upload->count() == 0)
                    <div class="add_upload">
                        <p>Please add an upload</p>
                        <div onclick="openUpload()" class="add_box">Add +</div>
                    </div>
                @else
                <div class="allupload-courses">
                    @foreach ($upload as $uploads)
                        <div class="allupload">
                            <div class="allupload-images">
                                <img src="{{ asset("/images/$uploads->featured_image") }}" alt="">
                            </div>
                            <div class="allupload-text">
                                <h1>{{ $uploads->title }}</h1>
                                @foreach ($results as $result)
                                    @if ($result['uploadId'] == $uploads->id)
                                        <p>{{ $result['date'] }}</p>
                                    @endif
                                @endforeach
                                <p>{{$uploads->state}} State, {{$uploads->country}}</p>
                                <div class="allupload-logo-container">
                                    <div class="allupload-logo">
                                        <img src="{{ asset("/storage/users-avatar/$profile") }}" alt="">
                                    </div>
                                    <p>{{ $businessName }}</p>
                                </div>
                            </div>
                            <div class="change_buttons">
                                <a onclick="openUploadEdit({{$uploads->id}})" id="edit">Edit</a>
                                <a id="delete" href="{{url('delete/'. $uploads->id)}}">Delete</a>
                                <a onclick="clickFeature()" id="delete" href="#">Promote</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </section>
            @endif
            @if (Auth::user()->user_type == 'tutor')
                <section style="display: none" id="student-section">
                    {{-- <div class="w-full flex justify-around items-center mt-5">
                        <p class="border-b-2 p-3 hover:text-[#65b741] hover:border-[#65b741] cursor-pointer" onclick="showTutorBookings()">Enrolled Students</p>
                        <p class="border-b-2 p-3 hover:text-[#65b741] hover:border-[#65b741] cursor-pointer" onclick="showTutorBookings()">Booking</p>
                    </div> --}}
                    {{-- <div id="enrolledStudents">

                    </div> --}}
                    <div class="mt-5" id="bookings">
                        @if ($bookings->count() == 0)
                            <h1 class="text-center font-bold">You have no Bookings</h1>
                        @endif
                        @foreach ($bookings as $booking)
                        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl flex flex-row mb-6 overflow-hidden">
                            {{-- <div class="flex-none w-48 bg-cover" style="background-image: url('https://via.placeholder.com/150')">
                                <!-- You can use the image tag if you want -->
                                <!-- <img src="https://via.placeholder.com/150" alt="Tutor Image" class="w-full h-full object-cover"> -->
                            </div> --}}
                            <div class="flex flex-col p-4 w-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-1">User: {{$booking->user->name}}</h3>
                                        <p class="text-gray-600"><span class="font-semibold">Session Type:</span> {{ ucfirst($booking->session_type) }}</p>
                                        <p class="text-gray-600"><span class="font-semibold">Address:</span> {{$booking->address}}</p>
                                        <p class="text-gray-600"><span class="font-semibold">Phone:</span> {{$booking->phone}}</p>
                                    </div>
                                    <span class="
                                    @if ($booking->status === 'confirmed' || $booking->status === 'paid')
                                        bg-green-500
                                    @elseif ($booking->status === 'pending')
                                        bg-yellow-500
                                    @else
                                        bg-red-500
                                    @endif
                                    text-white text-sm font-medium px-2 py-1 rounded-full">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                </div>
                                <div class="mt-4">
                                    <p class="text-gray-600"><span class="font-semibold">Session Date:</span> {{ $booking->start_time }}</p>
                                    <p class="text-gray-600"><span class="font-semibold">Duration:</span> {{ $booking->duration }} hours</p>
                                    <p class="text-gray-600"><span class="font-semibold">Rate per Hour:</span> ₦{{ number_format($booking->rate, 2) }}</p>
                                    <p class="text-gray-600"><span class="font-semibold">Total Amount:</span> ₦{{ number_format($booking->total_amount, 2) }}</p>
                                    <p class="text-gray-600"><span class="font-semibold">Notes:</span> {{ $booking->notes ?? 'N/A' }}</p>
                                </div>
                                @if ($booking->status === 'pending')
                                <div class="flex justify-end mt-4 gap-3">
                                    <a href="{{url("approve-booking/$booking->id")}}" class="bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition">Approve</a>
                                    <a href="{{url("reject-booking/$booking->id")}}" class="bg-red-500 text-white text-sm font-medium px-4 py-2 rounded-lg shadow hover:bg-red-600 transition">Reject</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
            @endif
            <section style="display: none" id="upload-section">
                <div class="upload-form-container">
                    <form class="upload-form" action="{{route('upload')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="upload-form-content">
                            <h1>Upload information</h1>
                            <div class="upload-inner">
                                <div class="upload-info">
                                    <div class="upload-inputs-container">
                                        <div class="upload-inputs">
                                            <label for="">Title</label>
                                            <input type="text" name="title">
                                        </div>
                                        <div class="upload_type">
                                            <div class="upload-inputs">
                                                <label for="">Category</label>
                                                <select name="category" id="">
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->name}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="upload-inputs">
                                                <label for="">Type</label>
                                                <select name="upload_type" id="program-type" onclick="toggleInputs()">
                                                    {{-- <option value="events">Events</option> --}}
                                                    <option value="workshop">Workshop</option>
                                                    <option value="virtual-program">Virtual Program</option>
                                                    <option value="e-course">E-Course</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div id="date" class="upload_type">
                                            <div class="upload-inputs">
                                                <label for="">Start Date</label>
                                                <input type="date" name="start_date" id="">
                                            </div>
                                            <div class="upload-inputs">
                                                <label for="">End Date</label>
                                                <input type="date" name="end_date" id="">
                                            </div>
                                        </div>
                                        <div id="video" class="upload_type">
                                            <div class="upload-inputs">
                                                <label for="">No. of Course Sections</label>
                                                <input oninput="createSection()" id="course_duration" name="course_duration" type="number" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="upload-featured" id="featuredDiv"> 
                                    <label for="featured_image">
                                        <i class="fa-regular fa-image"></i> 
                                        <p>Upload Image</p>
                                    </label>
                                    <input type="file" name="featured_image" id="featured_image" class="featured_image" accept=".png, .jpg" onchange="displayImage(this)">
                                </div>
                            </div>
                            <div class="upload-section2">
                                <div class="upload-inputs">
                                    <label for="">Price(₦)</label>
                                    <input type="text" id="price" name="price" placeholder="Type 0 if free">
                                </div>
                                <div class="upload-inputs">
                                    <label for="">Country</label>
                                    <select name="country" class="country">
                                        <option value="" selected disabled>Select Country</option>
                                    </select>
                                </div>
                                <div class="upload-inputs">
                                    <label for="">Address</label>
                                    <input type="text" name="address">
                                    </select>
                                </div>
                                <div class="upload-input">
                                    <label for="">Brochure/Downloadable Material</label>
                                    <input type="file" name="material" id="">
                                </div>
                            </div>
                            <div class="upload-section2">
                                <div id="host" class="upload-inputs">
                                    <label for="">Host Application</label>
                                    <input type="text" placeholder="Whatsapp, Zoom...">
                                </div>
                            </div>
                            <div>
                                <div id="container" class="course_section">
                                    {{-- <div class="section_container">
                                        <label for="">Section 1</label>
                                        <div class="section_inputs">
                                            <i class="fa-solid fa-xmark"></i>
                                            <input type="text" placeholder="Section Title">
                                            <button>Add Video+</button>
                                        </div>
                                        <div class="section_video_inputs">
                                            <i class="fa-solid fa-xmark"></i>
                                            <input type="text" placeholder="Video Title">
                                            <input type="file" name="" id="">
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="upload-section3">
                                <textarea style="border: 1px solid #e5e7eb"  name="description" id="rte-editor" cols="30" rows="10" placeholder="Input upload description"></textarea>
                                <button class="upload_section-button" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <section style="display: none" id="wallet-section">
                <div class="wallet-container">
                    <div class="wallet-head-container">
                        <div>
                            <div class="profile_pic" style="background-color: none">
                                <img class="profile-img" src="{{asset("/storage/users-avatar/$profile")}}" alt="">
                            </div>
                        </div>
                        <div>{{Auth::user()->name}}</div>
                        <div class="wallet-balance" style="font-size: 20px">{{Auth::user()->wallet_balance}}</div>
                        <div class="wallet_fund_withdraw-buttons">
                            <button id="wallet_fund">Fund Wallet <i class="buttons-icon fa-solid fa-plus"></i></button>
                            <button id="wallet_withdraw">Withdraw <i class="buttons-icon fa-solid fa-minus"></i></button>
                        </div>
                    </div>
                    <h2 style="color: #999; text-align:center; margin-top:40px">Transaction History</h2>
                    <div class="transaction_buttons">
                        <button id="trans_depo" class="transaction_active_buttons transaction_allbutton" onclick="showDepositTable()">Deposit</button>
                        <button id="trans_withdraw" class="transaction_allbutton" onclick="showWithdrawalTable()">Withdrawal</button>
                        <button id="trans_others" class="transaction_allbutton" onclick="showOtherTable()">Others</button>
                    </div>
                    <div id="myTableContainer">
                        <table id="myTable" class="styled-table">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Transaction Status</th>
                                    <th>Reference</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="transactionsBody">
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td class="wallet-balance">{{ $transaction->amount }}</td>
                                    @if ($transaction->status === 'success')
                                        <td><p class="success_status">{{ $transaction->status }}</p></td>
                                    @elseif ($transaction->status === 'failed')
                                        <td><p class="failed_status">{{ $transaction->status }}</p></td>
                                    @elseif ($transaction->status === 'pending')
                                        <td><p class="pending_status">{{ $transaction->status }}</p></td>
                                    @endif
                                    <td>{{ $transaction->reference }}</td>
                                    <td>{{ $transaction->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>
                    <div id="withdrawTableContainer">
                        <table id="withdrawTable" class="styled-table">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Transaction Status</th>
                                    <th>Reference</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="transactionsBody">
                                @foreach ($walTransactions as $transaction)
                                <tr>
                                    <td class="wallet-balance">{{ $transaction->amount }}</td>
                                    @if ($transaction->status === 'success')
                                        <td><p class="success_status">{{ $transaction->status }}</p></td>
                                    @elseif ($transaction->status === 'failed')
                                        <td><p class="failed_status">{{ $transaction->status }}</p></td>
                                    @elseif ($transaction->status === 'pending')
                                        <td><p class="pending_status">{{ $transaction->status }}</p></td>
                                    @endif
                                    <td>{{ $transaction->reference }}</td>
                                    <td>{{ $transaction->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>
                    <div id="otherTableContainer">
                        <table id="otherTable" class="styled-table">
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Transaction Status</th>
                                    <th>Transaction Type</th>
                                    <th>Reference</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="transactionsBody">
                                @foreach ($othersTransactions as $transaction)
                                <tr>
                                    <td class="wallet-balance">{{ $transaction->amount }}</td>
                                    @if ($transaction->status === 'success')
                                        <td><p class="success_status">{{ $transaction->status }}</p></td>
                                    @elseif ($transaction->status === 'failed')
                                        <td><p class="failed_status">{{ $transaction->status }}</p></td>
                                    @elseif ($transaction->status === 'pending')
                                        <td><p class="pending_status">{{ $transaction->status }}</p></td>
                                    @endif
                                    <td>{{ $transaction->transaction_type }}</td>
                                    <td>{{ $transaction->reference }}</td>
                                    <td>{{ $transaction->created_at->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table> 
                    </div>
                                    
                </div>
            </section>
            <section style="display: none" id="metrics-section">
                <div class="business_prof_metrics">
                    <div class="dashboard_metrics">
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Workshops</p>
                                <p>{{$workUpload}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-users"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Events</p>
                                <p class="metrics-text" id="users_count">{{$eventUpload}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-briefcase"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">E-Course</p>
                                <p class="metrics-text" id="business_count">{{$ecourseUpload}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-user-tie"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Virtual Programs</p>
                                <p class="metrics-text" id="prof_count">{{$vprogramUpload}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="busi_top_metrics admin_top-subsection">

                    <p class="transaction_text-heading">Upload Metrics</p >
                    <div class="transaction_tabs">
                        <p id="allMetrics" class="transaction_tabs_back" onclick="showAllMetrics()">All Time</p>
                        <p id="sevenMetrics" onclick="showSevenMetrics()">Last 7 days</p>
                        <p id="fourtMetrics" onclick="showFourtMetrics()">Last 14 days</p>
                        <p id="thirtMetrics" onclick="showThirtMetrics()">Last 30 days</p>
                    </div>
                </div>
                <div id="allTimeMetrics">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Upload Info</th>
                                <th>Price</th>
                                <th>Upload Type</th>
                                <th>No.  of Registered Persons</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="admintransactionsBody">
                            @foreach ($upload as $uploads)
                            <tr>
                                <td class="table_user-info">
                                    <div class="table_user-info-logo">
                                        <img src="{{ asset("/images/$uploads->featured_image") }}" alt="">
                                    </div>
                                    <div class="upload_metrics_title">{{$uploads->title}}</div>
                                </td>
                                @if ($uploads->price == '0')
                                <td>Free</td>
                                @else
                                <td class="wallet-balance">{{$uploads->price}}</td>
                                @endif
                                <td>{{$uploads->upload_type}}</td>
                                @php
                                $totalParticipants = 0;
                                @endphp
                                
                                @foreach($uploads->participants as $participant)
                                    @php
                                    $totalParticipants += $participant->participants;
                                    @endphp
                                @endforeach
                                
                                <td>{{ $totalParticipants }}</td>
                                <td>{{$uploads->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
                <div style="display: none"  id="sevenDayMetrics">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Upload Info</th>
                                <th>Price</th>
                                <th>Upload Type</th>
                                <th>No.  of Registered Persons</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="admintransactionsBody">
                            @foreach ($sevenUpload as $uploads)
                            <tr>
                                <td class="table_user-info">
                                    <div class="table_user-info-logo">
                                        <img src="{{ asset("/images/$uploads->featured_image") }}" alt="">
                                    </div>
                                    <div class="upload_metrics_title">{{$uploads->title}}</div>
                                </td>
                                @if ($uploads->price == '0')
                                <td>Free</td>
                                @else
                                <td class="wallet-balance">{{$uploads->price}}</td>
                                @endif
                                <td>{{$uploads->upload_type}}</td>
                                @php
                                $totalParticipants = 0;
                                @endphp
                                
                                @foreach($uploads->participants as $participant)
                                    @php
                                    $totalParticipants += $participant->participants;
                                    @endphp
                                @endforeach
                                
                                <td>{{ $totalParticipants }}</td>
                                <td>{{$uploads->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
                <div style="display: none" id="fourteenDayMetrics">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Upload Info</th>
                                <th>Price</th>
                                <th>Upload Type</th>
                                <th>No.  of Registered Persons</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="admintransactionsBody">
                            @foreach ($fourtUpload as $uploads)
                            <tr>
                                <td class="table_user-info">
                                    <div class="table_user-info-logo">
                                        <img src="{{ asset("/images/$uploads->featured_image") }}" alt="">
                                    </div>
                                    <div class="upload_metrics_title">{{$uploads->title}}</div>
                                </td>
                                @if ($uploads->price == '0')
                                <td>Free</td>
                                @else
                                <td class="wallet-balance">{{$uploads->price}}</td>
                                @endif
                                <td>{{$uploads->upload_type}}</td>
                                @php
                                $totalParticipants = 0;
                                @endphp
                                
                                @foreach($uploads->participants as $participant)
                                    @php
                                    $totalParticipants += $participant->participants;
                                    @endphp
                                @endforeach
                                
                                <td>{{ $totalParticipants }}</td>
                                <td>{{$uploads->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
                <div style="display: none" id="thirtyDayMetrics">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Upload Info</th>
                                <th>Price</th>
                                <th>Upload Type</th>
                                <th>No.  of Registered Persons</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="admintransactionsBody">
                            @foreach ($thirtUpload as $uploads)
                            <tr>
                                <td class="table_user-info">
                                    <div class="table_user-info-logo">
                                        <img src="{{ asset("/images/$uploads->featured_image") }}" alt="">
                                    </div>
                                    <div class="upload_metrics_title">{{$uploads->title}}</div>
                                </td>
                                @if ($uploads->price == '0')
                                <td>Free</td>
                                @else
                                <td class="wallet-balance">{{$uploads->price}}</td>
                                @endif
                                <td>{{$uploads->upload_type}}</td>
                                @php
                                $totalParticipants = 0;
                                @endphp
                                
                                @foreach($uploads->participants as $participant)
                                    @php
                                    $totalParticipants += $participant->participants;
                                    @endphp
                                @endforeach
                                
                                <td>{{ $totalParticipants }}</td>
                                <td>{{$uploads->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
            </section>
            <section style="display: none" id="setting-section">
                <div class="settings-container">
                    <h1 class="settings-header">Your Account Settings</h1>
                    <p class="settings_add-payment_text">Add a payment account</p>

                    <form action="{{route('updateAccount')}}" method="POST">
                        @csrf
                        <div class="payment-section">
                            <div class="payment_method-input">
                                <label for="">Payment Bank Name</label>
                                <select name="bank_account" id="paymentBankName">
                                    @if (Auth::user()->bank_account == null)
                                    <option hidden selected > --Select a bank-- </option>
                                    @else
                                    <option value="{{Auth::user()->bank_account}}" selected >{{Auth::user()->bank_account}}</option>
                                    @endif
                                    <option value="Access Bank">Access Bank</option>
                                    <option value="Citi Bank">Citi Bank</option>
                                    <option value="Coronation Merchant Bank">Coronation Merchant Bank</option>
                                    <option value="EcoBank">EcoBank</option>
                                    <option value="Fidelity Bank">Fidelity Bank</option>
                                    <option value="First Bank of Nigeria">First Bank of Nigeria</option>
                                    <option value="First City Monument Bank (FCMB)">First City Monument Bank (FCMB)</option>
                                    <option value="FSDH Merchant Bank">FSDH Merchant Bank</option>
                                    <option value="Globus Bank">Globus Bank</option>
                                    <option value="Greenwich Merchant Bank">Greenwich Merchant Bank</option>
                                    <option value="Guarantee Trust Bank (GTB)">Guarantee Trust Bank (GTB)</option>
                                    <option value="Heritage Bank">Heritage Bank</option>
                                    <option value="Jaiz Bank">Jaiz Bank</option>
                                    <option value="Keystone Bank">Keystone Bank</option>
                                    <option value="Kuda MFB">Kuda MFB</option>
                                    <option value="Lotus Bank">Lotus Bank</option>
                                    <option value="Nova Merchant Bank">Nova Merchant Bank </option>
                                    <option value="Opay">OPAY</option>
                                    <option value="Polaris Bank">Polaris Bank</option>
                                    <option value="Providus Bank">Providus Bank</option>
                                    <option value="Rand Merchant Bank">Rand Merchant Bank </option>
                                    <option value="Stanbic IBTC Bank">Stanbic IBTC Bank</option>
                                    <option value="Standard Chartered Bank">Standard Chartered Bank</option>
                                    <option value="Sterling Bank">Sterling Bank </option>
                                    <option value="Suntrust Bank">Suntrust Bank </option>
                                    <option value="Taj Bank">Taj Bank</option>
                                    <option value="Titan Trust Bank">Titan Trust Bank</option>
                                    <option value="Union Bank Plc">Union Bank Plc</option>
                                    <option value="United Bank for Africa (UBA)">United Bank for Africa (UBA)</option>
                                    <option value="Unity Bank">Unity Bank</option>
                                    <option value="Wema Bank">Wema Bank</option>
                                    <option value="Zenith Bank">Zenith Bank</option>
                                </select>
                            </div>
                            <div class="payment_method-input">
                                <label for="">Payment Account Number</label>
                                <input value="{{Auth::user()->account_number}}" type="number" name="account_number">
                            </div>
                            <div class="payment_method-input">
                                <label for="">Holder's Name</label>
                                <input value="{{Auth::user()->account_name}}" type="text" name="account_name">
                            </div>
                            <button class="add_payment_account_button">Add payment account</button>
                        </div>
                    </form>

                    <div>
                        <p class="settings_add-payment_text">Update Account Password</p>

                        <form action="">
                            <div class="payment-section">
                                <div class="payment_method-input">
                                    <label for="">Current Password</label>
                                    <input type="password" placeholder="&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;">
                                </div>
                                <div class="payment_method-input">
                                    <label for="">Payment Account Number</label>
                                    <input type="password" placeholder="&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;">
                                </div>
                                <div class="payment_method-input">
                                    <label for="">New Password</label>
                                    <input type="password" placeholder="&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;&#8270;">
                                </div>
                                <button class="add_payment_account_button">Confirm New Password</button>
                            </div>
                        </form>
                    </div>
                    <div>
                        <p class="settings_add-payment_text">Delete My Account</p>
                        <div class="payment-section">
                            <form class="delete_form" action="">
                                <p class="delete_account-text">Every info about this account, transactions, affiliate links, sold product histories, personal details and other sensitive informations would be removed as you click <strong>Delete My Account!</strong>                            </p>
                                <button class="add_payment_account_button">Delete My Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            @if (Auth::user()->user_type == 'business')
            <section style="display: none" id="plan-section">
                <div class="plan_section_container">
                    <h1 class="plan_header">Plans</h1>
                    <p>{{Auth::user()->user_type}}</p>
                    <div class="sub_plan_container">
                        @if (Auth::user()->user_type === 'business')
                            @if (Auth::user()->business->subscription == 'standard listing' || Auth::user()->business->subscription == 'enterprise listing')
                            <div style="pointer-events: none" class="stan_plan_container2">
                                <h1 class="listing_heading">Standard Listing</h1>
                                <div class="listing_features">
                                    <ul>
                                        <li>Business Listing Free</li>
                                        <li>Event Listing: 100 Events</li>
                                        <li>Appeared Featured Training Provider</li>
                                        <li>Course Featured Credit – 5 Slots/Month</li>
                                        <li>Enable Ticketing/Web Pay </li>
                                    </ul>
                                </div>
                                <div class="listing_price">
                                    @foreach ($allPlans->where('plan_name', 'standard listing') as $allPlan)
                                    <p id="stanPlanPrice" class="wallet-balance">{{$allPlan->plan_price}}</p>
                                    @endforeach
                                </div>
                                @if (Auth::user()->business->subscription == 'standard listing')
                                    <i id="select_icon" style="display: block" class="fa-solid fa-square-check"></i>
                                @endif
                                <div class="bottom_color"></div>
                            </div>
                            @else
                            <div onclick="selectStanPlan()" class="stan_plan_container">
                                <h1 class="listing_heading">Standard Listing</h1>
                                <div class="listing_features">
                                    <ul>
                                        <li>Business Listing Free</li>
                                        <li>Event Listing: 100 Events</li>
                                        <li>Appeared Featured Training Provider</li>
                                        <li>Course Featured Credit – 5 Slots/Month</li>
                                        <li>Enable Ticketing/Web Pay </li>
                                    </ul>
                                </div>
                                <div class="listing_price">
                                    @foreach ($allPlans->where('plan_name', 'standard listing') as $allPlan)
                                    <p id="stanPlanPrice" class="wallet-balance">{{$allPlan->plan_price}}</p>
                                    @endforeach
                                </div>
                                <div class="select_box">                            
                                </div>
                                <i id="select_icon" class="fa-solid fa-square-check"></i>
                                <div class="bottom_color"></div>
                            </div>
                            @endif
                            @if (Auth::user()->business->subscription == 'enterprise listing')
                            <div style="pointer-events: none" class="ent_plan_container2">
                                <h1 class="listing_heading">Enterprise Listing</h1>
                                <div class="listing_features_two">
                                    <ul>
                                        <li>EVENT LISTING: 200 Event</li>
                                        <li>Appeared Featured Training Provider</li>
                                        <li>Dedicated URL with Own Logo</li>
                                        <li>Course Featured Credit – 10 Slots/Month</li>
                                        <li>Sponsored Story Credit – 1 per Month</li>
                                        <li>Included in Weekly Newsletter</li>
                                        <li>Listed in Quarter Nigeria Training Guide</li>
                                        <li>Enable Ticketing/Web Pay</li>
                                        <li>Appear on Top of Search Result Page</li>
                                        <li>Get Verification Badges - FREE</li>
                                    </ul>
                                </div>
                                <div class="listing_price_two">
                                    @foreach ($allPlans->where('plan_name', 'enterprise listing') as $allPlan)
                                    <p id="entPlanPrice" class="wallet-balance">{{$allPlan->plan_price}}</p>
                                    @endforeach
                                </div>
                                <i id="select_icon_two" style="display: block" class="fa-solid fa-square-check"></i>
                                <div class="bottom_color"></div>
                            </div>
                            @else
                            <div onclick="selectEntPlan()" class="ent_plan_container">
                                <h1 class="listing_heading">Enterprise Listing</h1>
                                <div class="listing_features_two">
                                    <ul>
                                        <li>EVENT LISTING: 200 Event</li>
                                        <li>Appeared Featured Training Provider</li>
                                        <li>Dedicated URL with Own Logo</li>
                                        <li>Course Featured Credit – 10 Slots/Month</li>
                                        <li>Sponsored Story Credit – 1 per Month</li>
                                        <li>Included in Weekly Newsletter</li>
                                        <li>Listed in Quarter Nigeria Training Guide</li>
                                        <li>Enable Ticketing/Web Pay</li>
                                        <li>Appear on Top of Search Result Page</li>
                                        <li>Get Verification Badges - FREE</li>
                                    </ul>
                                </div>
                                <div class="listing_price_two">
                                    @foreach ($allPlans->where('plan_name', 'enterprise listing') as $allPlan)
                                    <p id="entPlanPrice" class="wallet-balance">{{$allPlan->plan_price}}</p>
                                    @endforeach
                                </div>
                                <div class="select_box_two"></div>
                                <i id="select_icon_two" class="fa-solid fa-square-check"></i>
                                <div class="bottom_color"></div>
                            </div>
                            @endif
                        @endif
                    </div>
                </div>
            </section>
            @endif
            <section style="display: none" id="kyc-section">
                @if (Auth::user()->kyc_status == 'pending')
                <div class="pending_kyc">
                    <div>
                        <h1 class="kyc_header">KYC Verification</h1>
                            <p class="kyc_text_box">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nam suscipit reprehenderit ab quos ipsum sequi iusto expedita iste inventore illo, fugiat, hic voluptatum aut eum ipsam nisi quis, porro qui possimus saepe.</p>
                    </div>
                    <div class="pending_kyc_image">
                        <img src="{{asset('assets/images/pending-image.png')}}" alt="">
                    </div>
                </div>
                @elseif (Auth::user()->kyc_status == 'verified')
                <div class="pending_kyc">
                    <div>
                        <h1 class="kyc_header">KYC Verification</h1>
                            <p class="kyc_text_box">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nam suscipit reprehenderit ab quos ipsum sequi iusto expedita iste inventore illo, fugiat, hic voluptatum aut eum ipsam nisi quis, porro qui possimus saepe.</p>
                    </div>
                    <div class="pending_kyc_image">
                        <img src="{{asset('assets/images/verified-kyc.png')}}" alt="">
                    </div>
                </div>
                @elseif (Auth::user()->kyc_status == 'rejected')
                <div class="pending_kyc">
                    <div>
                        <h1 class="kyc_header">KYC Verification</h1>
                            <p class="kyc_text_box">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nam suscipit reprehenderit ab quos ipsum sequi iusto expedita iste inventore illo, fugiat, hic voluptatum aut eum ipsam nisi quis, porro qui possimus saepe.</p>
                    </div>
                    <div class="pending_kyc_image">
                        <img src="{{asset('assets/images/reject-kyc.png')}}" alt="">
                    </div>
                </div>
                @elseif (Auth::user()->kyc_status == 'not verified')
                <form action="{{route('kycVerify')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="kyc_container">
                        <h1 class="kyc_header">KYC Verification</h1>
                        <p class="kyc_text_box">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga nam suscipit reprehenderit ab quos ipsum sequi iusto expedita iste inventore illo, fugiat, hic voluptatum aut eum ipsam nisi quis, porro qui possimus saepe.</p>
                        <div class="kyc_first_grid">
                            <div class="upload-kyc" id="featuredDiv"> 
                                <label for="kyc_selfie">
                                    <i class="fa-regular fa-image"></i> 
                                    <p>Upload Selfie</p>
                                </label>
                                <input type="file" name="kyc_selfie" id="kyc_selfie" class="featured_image" accept=".png, .jpg" onchange="displayImage(this)">
                            </div>
                            <div class="kyc_inputs-container">
                                <div class="kyc_input">
                                    <label for="">Home Address</label>
                                    <input name="home_address" type="text" placeholder="5, Felix Obe Street Lagos">
                                </div>
                                <div class="kyc_input">
                                    <label for="">Phone Number</label>
                                    <input name="phone_number" type="text" placeholder="09048235890">
                                </div>
                                <div class="kyc_sub-grid">
                                    <div class="kyc_input-sub">
                                        <label for="">Date of Birth</label>
                                        <input name="date_of_birth" type="date" name="" id="">
                                    </div>
                                    <div class="kyc_input-sub">
                                        <label for="">Country</label>
                                        <select name="country" id="" class="country"></select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kyc_second_grid">
                            <div class="kyc_input-sub">
                                <label for="">Document Type</label>
                                <select name="document_type" id="" class="">
                                    <option value="NIN">Nin</option>
                                </select>
                            </div>
                            <div class="kyc_doc_no kyc_input-sub">
                                <label for="">Document Number</label>
                                <input name="document_number" type="text" placeholder="62066779900002">
                            </div>
                        </div>
                        <div class="kyc_front_back">
                            <label for="upload_front" class="kyc_front">
                                <div class="upload_front_inner">
                                    <i style="color: #999" class="fa-solid fa-cloud-arrow-up"></i>
                                    <p class="front-side-text">Front Side of your document</p>
                                    <p class="front-upload-text">Uplaod the front side of your document<br>
                                        Support PNG, JPG, PDF</p>
                                    <input type="file" name="front_document" id="upload_front">
                                </div>
                            </label>
                            <label for="upload_back" class="kyc_back">
                                <div class="upload_front_inner">
                                    <i style="color: #999" class="fa-solid fa-cloud-arrow-up"></i>
                                    <p class="front-side-text">Back Side of your document</p>
                                    <p class="front-upload-text">Uplaod the back side of your document<br>
                                        Support PNG, JPG, PDF</p>
                                    <input type="file" name="back_document" id="upload_back">
                                </div>
                            </label>
                        </div>
                        <div class="confirm_text">
                            <input type="checkbox" name="" id="">
                            <p>I confirm that I uploaded Goverment-issued ID photo. Including Picture, Telephone, Address and DOB</p>
                        </div>
                        <button type="submit" class="upload_continue">Continue</button>
                    </div>
                </form>
                @endif
            </section>
            <section style="display: none" id="ads-section">
                <div id="allads">
                    @if ($adsCount > '0')
                    <h1 style="color: #999; text-align:center; font-weight:500;margin-bottom:20px">All Ads</h1>
                    @endif
                    <div class="allads_grid">
                        @foreach ($ads as $ad)
                        <div class="allads_container">
                            <div class="allads_image_container">
                                <img src="{{asset("adsbanner/$ad->ads_banner")}}" alt="">
                            </div>
                            <div class="ad_statistics">
                                <div class="ads_status">
                                    <p>Status</p>
                                    @if ($ad->ads_status == 'pending')
                                    <div class="pending_status">&#9679;{{$ad->ads_status}}</div>
                                    @elseif ($ad->ads_status == 'active')
                                    <div class="success_status">&#9679;{{$ad->ads_status}}</div>
                                    @elseif ($ad->ads_status == 'rejected')
                                    <div class="failed_status">&#9679;{{$ad->ads_status}}</div>
                                    @endif
                                </div>
                                <div class="ads_divider"></div>
                                <div class="ads_status">
                                    <p>Impressions</p>
                                    <div>{{$ad->impressions}}</div>
                                </div>
                                <div class="ads_divider"></div>
                                <div class="ads_status">
                                    <p>Clicks</p>
                                    <div>{{$ad->clicks}}</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="not_running_ads">
                    @if ($adsCount == '0')
                    <h1 style="color: #999; text-align:center; font-weight:500;margin-top:20px">You Are Not Running Any Ads</h1>
                    @endif
                    <button onclick="openAds()" class="create_ad_button">Create Ad +</button>
                </div>

                <form method="POST" action="{{route('adsSubmit')}}" style="display: none" class="ads-inner-section" enctype="multipart/form-data">
                    @csrf
                    <h1 style="text-align: center; font-size:25px; font-weight:400">Fill Ads Information</h1>
                    <div class="ads_grid">
                        <label for="top_banner" class="top_banner">             
                            <i class="top_banner_svg fa-solid fa-tv"></i>
                            <h1 class="top_banner_head">Top Banner(860px X 500px)</h1>
                            <div class="banner_price_container">
                                @foreach ($adPrices->where('name', 'top banner') as $adPrice)
                                <h2 class="banner_price_head wallet-balance top-banner">{{$adPrice->price}}</h2>
                                @endforeach
                                <p class="banner_price_days">/week</p>
                            </div>
                            <input class="top_banner_radio" type="radio" value="top banner" onclick="changePrice()" name="ads_type" id="top_banner">
                        </label>
                        <label for="promoted_banner" class="promoted_banner">             
                            <i class="top_banner_svg fa-solid fa-tachograph-digital"></i>
                            <h1 class="top_banner_head">Promoted Banner(900px X 200px)</h1>
                            <div class="banner_price_container">
                                @foreach ($adPrices->where('name', 'promoted banner') as $adPrice)
                                <h2 class="banner_price_head wallet-balance promoted-banner">{{$adPrice->price}}</h2>
                                @endforeach
                                <p class="banner_price_days">/week</p>
                            </div>
                            <input class="top_banner_radio" type="radio" onclick="changePrice()" value="promoted banner" name="ads_type" id="promoted_banner">
                        </label>
                        <label for="side_banner" class="side_banner">             
                            <i class="top_banner_svg fa-solid fa-table-columns"></i>
                            <h1 class="top_banner_head">HomePage Side Banner(315px X 315px)</h1>
                            <div class="banner_price_container">
                                @foreach ($adPrices->where('name', 'homepage banner') as $adPrice)
                                <h2 class="banner_price_head wallet-balance homepage-banner">{{$adPrice->price}}</h2>
                                @endforeach
                                <p class="banner_price_days">/week</p>
                            </div>
                            <input class="top_banner_radio" onclick="changePrice()" value="homepage banner" type="radio" name="ads_type" id="side_banner">
                        </label>
                        <label for="inpage_banner" class="side_banner">             
                            <i class="top_banner_svg fa-solid fa-laptop"></i>
                            <h1 class="top_banner_head">In-Page Banner(900px X 200px)</h1>
                            <div class="banner_price_container">
                                @foreach ($adPrices->where('name', 'inpage banner') as $adPrice)
                                <h2 class="banner_price_head wallet-balance inpage-banner">{{$adPrice->price}}</h2>
                                @endforeach
                                <p class="banner_price_days">/week</p>
                            </div>
                            <input class="top_banner_radio" value="inpage banner" onclick="changePrice()" type="radio" name="ads_type" id="inpage_banner">
                        </label>
                    </div>

                    <div class="ads_info_container">
                        <div class="ads_info">
                            <label for="">Banner Image</label>
                            <input name="ads_banner" id="ad-banner" type="file">
                        </div>
                        <div class="ads_info">
                            <label for="">Website Link</label>
                            <input name="ads_link" type="text">
                        </div>
                    </div>
                    <button type="button" onclick="openAdPayment()" class="ads_submit">Procced</button>
                </form>
                <input type="text" value="" hidden  id="selected_ad">
            </section>
            <section style="display: none" id="feature-section">
                <div class="feature-inner-section">
                    <h2 class="feature_head"><i style="display: none" id="backIcon" onclick="backSection()" class="fa-solid fa-circle-left"></i> Feature/List a Content</h2>
                    <p class="feature_option_text">Select what you want to feature or list</p>
                    <div id="first-choose-section">
                        <div class="feature_type_container">
                            <label class="select_radio" for="virtual-program">
                                <input type="radio" value="virtual-program" name="feature_type" id="virtual-program">
                                @foreach ($allFeatured->where('feature_name', 'virtual-program') as $allFeature)
                                    <p>Virtual Program Featuring (<span class="wallet-balance">{{$allFeature->feature_price}}</span>/wk)</p>
                                @endforeach
                            </label>
                            <label class="select_radio" for="workshop">
                                <input type="radio" value="workshop" name="feature_type" id="workshop">
                                @foreach ($allFeatured->where('feature_name', 'e-course') as $allFeature)
                                <p>Workshop Featuring (<span class="wallet-balance">{{$allFeature->feature_price}}</span>/wk)</p>
                                @endforeach
                            </label>
                            <label class="select_radio" for="e-course">
                                <input type="radio" value="e-course" name="feature_type" id="e-course">
                                @foreach ($allFeatured->where('feature_name', 'virtual-program') as $allFeature)
                                <p>E-Course Featuring (<span class="wallet-balance">{{$allFeature->feature_price}}</span>/wk)</p>
                                @endforeach
                            </label>
                            @if (Auth::user()->user_type == 'tutor')
                                <label class="select_radio" for="tutor">
                                    <input type="radio" value="tutor" name="feature_type" id="tutor">
                                    @foreach ($allFeatured->where('feature_name', 'tutor') as $allFeature)
                                    <p>Tutor Featuring (<span class="wallet-balance">{{$allFeature->feature_price}}</span>/wk)</p>
                                    @endforeach
                                </label>
                            @endif
                            @if (Auth::user()->user_type == 'business')
                                @if (Auth::user()->business->featured == 0)
                                    <label class="select_radio" for="business">
                                        <input type="radio" name="feature_type" id="business" value="business">
                                        @foreach ($allFeatured->where('feature_name', 'business') as $allFeature)
                                        <p>Business Featuring (<span class="wallet-balance">{{$allFeature->feature_price}}</span>/wk)</p>
                                        @endforeach
                                    </label>
                                @else
                                    <div style="cursor: not-allowed; border:1px solid #999; align-items:center" class="select_radio">
                                        <div style="width: 15px; height:15px; border: 1px solid #999; border-radius:50%;"></div>
                                        @foreach ($allFeatured->where('feature_name', 'business') as $allFeature)
                                        <p style="color:#999">Business Featuring (<span class="wallet-balance">{{$allFeature->feature_price}}</span>/wk)</p>
                                        @endforeach
                                    </div>
                                @endif
                            @endif
                            <label  class="select_radio" for="resource">
                                <input type="radio" name="feature_type" value="resource" id="resource">
                                @foreach ($allFeatured->where('feature_name', 'resource') as $allFeature)
                                <p>Resource Featuring (<span class="wallet-balance">{{$allFeature->feature_price}}</span>/wk)</p>
                                @endforeach
                            </label>
                        </div>
                        <p id="error-option" style="text-align: center; color:red; font-size:15px; font-weight:300; display:none">Please select an option</p>
                        <button onclick="nextSection()" type="button" class="feature_proceed">Proceed</button>
                    </div>
                    <input id="selected_upload_price" type="text" hidden value="">
                    <div style="display: none" id="next_section">
                        <div class="your_events_container">
                            @foreach ($upload->where('featured', 0) as $uploads)
                                <label onclick="showButton()" data-type="{{$uploads->upload_type}}" class="events_select" for="select_{{$uploads->id}}">
                                    <div class="your_events_text">
                                        <p>{{$uploads->title}}</p>
                                        <input type="radio" name="select_upload" data-id="{{$uploads->id}}" id="select_{{$uploads->id}}">
                                    </div>
                                    <div class="your_events_image_container">
                                        <img src="{{asset("/images/$uploads->featured_image")}}" alt="">
                                    </div>
                                </label>
                            @endforeach
                        </div>
                        <button style="display: none" onclick="openFeaturePay()" id="fin-proc" type="button" class="feature_proceed">Proceed</button>
                    </div>
                </div>
            </section>
            <section style="display: none" id="certificate-section">
                @if (Auth::user()->user_type == 'business')
                <h1 style="color: #999; text-align:center">Create Certificates</h1>
                    <div class="certificates_grid">
                        <div class="border">
                            <h2 class="your_upload_title">Your Uploads</h2>
                            <div class="your_upload_flex">
                                @foreach ($compupload as $eachupload)
                                @if ($eachupload->certificate_status == 'ready')
                                <div class="single_upload_container_not_active">
                                    <div class="single_upload_info">
                                        <div class="single_upload_image">
                                            <img src="{{asset("images/$eachupload->featured_image")}}" alt="">
                                        </div>
                                        <p class="single_upload_title">{{$eachupload->title}}</p>
                                    </div>
                                    @if ($eachupload->certificate_status == 'not ready')
                                        <p class="upcoming">&#9679;not ready</p>
                                    @else
                                        <p class="active">&#9679;ready</p>
                                    @endif
                                </div>
                                @else
                                <div onclick="createCertificate({{$eachupload->id}})" class="single_upload_container">
                                    <div class="single_upload_info">
                                        <div class="single_upload_image">
                                            <img src="{{asset("images/$eachupload->featured_image")}}" alt="">
                                        </div>
                                        <p class="single_upload_title">{{$eachupload->title}}</p>
                                    </div>
                                    @if ($eachupload->certificate_status == 'not ready')
                                        <p class="upcoming">&#9679;not ready</p>
                                    @else
                                        <p class="active">&#9679;ready</p>
                                    @endif
                                </div>
                                @endif
                                @endforeach
                            </div>
                        </div>
                        <div class="border">
                            <form id="certificate-form" method="GET">

                            </form>
                        </div>
                    </div>
                @else
                <h1 style="color: #999; text-align:center">Get Certificates</h1>
                    <div class="certificates_grid">
                        <div class="border">
                            <h2 class="your_upload_title">Your Courses</h2>
                            <div class="your_upload_flex">
                                @foreach ($myCourses as $myCourse)
                                @if ($myCourse->participant->certificate_status == 'not ready')
                                    <div class="single_upload_container_not_active">
                                        <div class="single_upload_info">
                                            <div class="single_upload_image">
                                                <img src="{{ asset("images/{$myCourse->participant->featured_image}") }}" alt="">
                                            </div>
                                            <p class="single_upload_title">{{ $myCourse->participant->title }}</p>
                                        </div>
                                        @if ($myCourse->participant->certificate_status == 'not ready')
                                            <p class="upcoming">&#9679;not ready</p>
                                        @else
                                            <p class="active">&#9679;ready</p>
                                        @endif
                                    </div>
                                @else
                                    <div class="single_upload_container" onclick="showParticipantsInput({{ $myCourse->course_id }}, {{ $myCourse->participants }}, {{$myCourse->reference}})">
                                        <div class="single_upload_info">
                                            <div class="single_upload_image">
                                                <img src="{{ asset("images/{$myCourse->participant->featured_image}") }}" alt="">
                                            </div>
                                            <p class="single_upload_title">{{ $myCourse->participant->title }}</p>
                                        </div>
                                        @if ($myCourse->participant->certificate_status == 'not ready')
                                            <p class="upcoming">&#9679;not ready</p>
                                        @else
                                            <p class="active">&#9679;ready</p>
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                            
                            </div>
                        </div>
                        <div class="border">
                            <h1 style="color: #999; text-align:center">Get Certificates</h1>
                            <form id="participant-form" method="GET">

                            </form>
                        </div>
                    </div>
                @endif
            </section>
            <section style="display: none" id="premium-listing-section">
                All Your Premium Listings
                <table class="styled-table">
                    <thead>
                        <tr>
                            <th>Upload Info</th>
                            <th>Actions</th>
                            <th>Date Due</th>
                        </tr>
                    </thead>
                    <tbody id="admintransactionsBody">
                        @if ($upload->where('featured', 1)->count() == 0)
                            <tr>
                                <td colspan="3">
                                    <h1 style="color: #999; font-weight:500; font-size:25px; text-align:center">You have no premium listings</h1>
                                    <button onclick="openFeaturePage()" style="cursor: pointer" class="feature_proceed">Create a Premium Listing +</button>
                                </td>
                            </tr>
                        @else
                            @foreach ($upload->where('featured', 1) as $uploads)
                                <tr>
                                    <td class="table_user-info">
                                        <div class="table_user-info-logo">
                                            <img src="{{ asset("/images/$uploads->featured_image") }}" alt="">
                                        </div>
                                        <div class="upload_metrics_title">{{ $uploads->title }}</div>
                                    </td>
                                    <td>
                                        <p onclick="openSwap({{ $uploads->id }})" class="swap-button">
                                            <i class="fa-solid fa-arrows-rotate"></i>
                                            Swap
                                        </p>
                                        <p class="delete-button">
                                            <i class="fa-solid fa-trash"></i>
                                            Delete
                                        </p>
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($uploads->date_of_featuring)->addDays(7)->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </section>
            @if (Auth::user()->user_type == 'user')
                <section style="display: none" id="mycourse-section">
                    <div class="allupload-courses">
                        <div class="w-full flex justify-around items-center mt-5">
                            <p class="border-b-2 p-3 hover:text-[#65b741] hover:border-[#65b741] cursor-pointer" onclick="showStudentBookings()">Enrolled Courses</p>
                            <p class="border-b-2 p-3 hover:text-[#65b741] hover:border-[#65b741] cursor-pointer" onclick="showStudentBookings()">Booking</p>
                        </div>
                        <div id="enrolledCourses">
                            @if ($allCourses->count() > 0)
                            @foreach ($allCourses as $uploads)
                            <div class="allupload">
                                <div class="allupload-images">
                                    <img src="{{ asset("/images/{$uploads->participant->featured_image}") }}" alt="">
                                </div>
                                <div class="allupload-text">
                                    <h1>{{ $uploads->participant->title }}</h1>
                                    @foreach ($results as $result)
                                        @if ($result['uploadId'] == $uploads->participant->id)
                                            <p>{{ $result['date'] }}</p>
                                        @endif
                                    @endforeach
                                    <p>{{$uploads->participant->state}} State, {{$uploads->participant->country}}</p>
                                    <div class="allupload-logo-container">
                                        <div class="allupload-logo">
                                            <img src="{{ asset("/storage/users-avatar/{$uploads->participant->users->avatar}") }}" alt="">
                                        </div>
                                        <p>{{$uploads->participant->users->name}}</p>
                                    </div>
                                </div>
                                @if (now() > $uploads->participant->end_date)
                                    <div class="upload_bottom_color">Completed</div>
                                @elseif (now() >=$uploads->participant->start_date && now() <=$uploads->participant->end_date)
                                <div class="upload_bottom_color">Active</div>
                                @elseif (now() < $uploads->participant->start_date)
                                <div class="upload_bottom_color">Upcoming</div>
                                @endif
                            </div>
                        @endforeach
                            @else
                            <div class="add_upload">
                                <p>Pls purchase a course</p>
                                <div onclick="redirectPage()" class="add_box">Purchase +</div>
                            </div>
                            @endif
                        </div>
                        <div class="hidden" id="tutorBookings">
                            @if ($bookings->count() == 0)
                            <div class="w-full flex flex-col gap-2 justify-center items-center">
                                <p class="text-center">You have no Bookings</p>
                                <a href="{{url('/tutor')}}" class="add_box">Create a booking +</a>
                            </div>
                        @endif
                        @foreach ($bookings as $booking)
                        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-xl flex flex-row mb-6 overflow-hidden">
                            {{-- <div class="flex-none w-48 bg-cover" style="background-image: url('https://via.placeholder.com/150')">
                                <!-- You can use the image tag if you want -->
                                <!-- <img src="https://via.placeholder.com/150" alt="Tutor Image" class="w-full h-full object-cover"> -->
                            </div> --}}
                            <div class="flex flex-col p-4 w-full">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-1">Tutor: {{$booking->tutor->user->name}}</h3>
                                        <p class="text-gray-600"><span class="font-semibold">Session Type:</span> {{ ucfirst($booking->session_type) }}</p>
                                        <p class="text-gray-600"><span class="font-semibold">Address:</span> {{$booking->address}}</p>
                                        <p class="text-gray-600"><span class="font-semibold">Phone:</span> {{$booking->phone}}</p>
                                    </div>
                                    <span class="
                                    @if ($booking->status === 'confirmed' || $booking->status === 'paid')
                                        bg-green-500
                                    @elseif($booking->status === 'pending')
                                        bg-yellow-500
                                    @else
                                        bg-red-500
                                    @endif
                                    text-white text-sm font-medium px-2 py-1 rounded-full">
                                    {{ ucfirst($booking->status) }}
                                </span>
                                </div>
                                <div class="mt-4">
                                    <p class="text-gray-600"><span class="font-semibold">Session Date:</span> {{ $booking->start_time }}</p>
                                    <p class="text-gray-600"><span class="font-semibold">Duration:</span> {{ $booking->duration }} hours</p>
                                    <p class="text-gray-600"><span class="font-semibold">Rate per Hour:</span> ₦{{ number_format($booking->rate, 2) }}</p>
                                    <p class="text-gray-600"><span class="font-semibold">Total Amount:</span> ₦{{ number_format($booking->total_amount, 2) }}</p>
                                    <p class="text-gray-600"><span class="font-semibold">Notes:</span> {{ $booking->notes ?? 'N/A' }}</p>
                                    <input type="number" value="{{$booking->total_amount}}" hidden id="bookingAmount">
                                    <input type="number" value="{{$booking->tutor_id}}" hidden id="bookingTutorId">
                                    <input type="number" value="{{$booking->id}}" hidden id="bookingId">
                                </div>
                                @if ($booking->status === 'confirmed')
                                <div class="flex justify-end mt-4 gap-3">
                                    <a href="#" class="bg-blue-500 text-white text-sm font-medium px-4 py-2 rounded-lg shadow hover:bg-blue-600 transition" onclick="payBookingWithPaystack()">Pay Now</a>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </section>
    <section class="edit-form">
        <div id="edit_profile">
            <h1>Edit Profile</h1>
            <form class="update_form" action="{{route('update')}}" method="POST">
                @csrf
                <i style="cursor:pointer" id="update_close" class="fa-solid fa-xmark"></i>
                <div class="upload_grid">
                    <div class="upload-inputs">
                        <label for="">First Name</label>
                        <input type="text" value="{{ Auth::user()->firstname}}" name="firstname">
                    </div>
                    <div class="upload-inputs">
                        <label for="">Last Name</label>
                        <input type="text" value="{{ Auth::user()->lastname}}" name="lastname">
                    </div>
                    <div class="upload-inputs">
                        <label for="">Email Address</label>
                        <input type="email" value="{{ Auth::user()->email}}" name="email">
                    </div>
                    <div class="upload-inputs">
                        <label for="">Address</label>
                        <input type="text" value="{{ Auth::user()->address}}" name="address">
                    </div>
                    <div class="upload-inputs">
                        <label for="">Telephone</label>
                        <input type="text" value="{{ Auth::user()->telephone}}" name="telephone">
                    </div>
                    <div class="upload-inputs">
                        <label for="">Country</label>
                        <select name="country" class="country" value="{{ Auth::user()->country}}">
                            <option value="{{Auth::user()->country}}" selected>{{Auth::user()->country}}</option>
                        </select>
                    </div>
                    <div class="upload-inputs">
                        <label for="">State</label>
                        <select name="state" class="state">
                            <option value="{{Auth::user()->state}}" selected>{{Auth::user()->state}}</option>
                        </select>
                    </div>
                    @if (Auth::user()->user_type == 'business')
                        <div class="upload-inputs">
                            <label for="">Business Name</label>
                            <input id="busi" type="text" value="{{$businessName}}" name="businessname" >
                            {{-- <input id="businame" type="text" value="{{$businessName}}" name="name" hidden> --}}
                        </div>                        
                    @endif
                    <div class="upload-inputs">
                        <label for="">Industry</label>
                        <input type="text" value="{{Auth::user()->industry}}" name="industry">
                    </div>
                    <div class="upload-inputs">
                        @if (Auth::user()->user_type == 'business')
                        <label for="">Contact Person</label>
                        <input type="text" value="{{Auth::user()->business->contact_person}}" name="contact_person">
                        @endif
                    </div>
                    @if (Auth::user()->user_type == 'business' || Auth::user()->user_type == 'tutor')
                    <div class="upload-inputs">
                        <label for="">Description</label>
                        @if (Auth::user()->user_type == 'business')
                        <textarea class="update_text" name="description" cols="30" rows="5">{{Auth::user()->business->description}}</textarea>
                        @elseif (Auth::user()->user_type == 'tutor')
                        <textarea class="update_text" name="description" cols="30" rows="5">{{Auth::user()->tutor->description}}</textarea>
                        @endif
                    </div>
                    @endif
                </div>
                <button class="update_button" type="submit">Update</button>
            </form>
        </div>
    </section>

    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Fund Wallet</h2>
            <form id="fund-form">
            <label class="modal_label" for="email">Email:</label>
            <input value="{{Auth::user()->email}}" type="email" id="email" name="email" required>
            <label class="modal_label" for="amount">Amount:</label>
            <input type="text" id="amount" name="amount" oninput="formatAmount(this)">
            <button type="submit" class="pay-button">Pay</button>
            </form>
        </div>
    </div>
    <div id="withdraw_modal">
        <form action="{{route('withdraw')}}" method="POST" class="withdraw_modal_content">
            @csrf
            <div class="withdraw-head">
                <p class="withdraw-head-text">Make a Withdrawal</p>
                <i id="with_modalClose" class="fa-solid fa-xmark"></i>
            </div>
            <hr class="withdraw-first-divider">
            <p class="withdraw-caution">Withdrawals are final. Confirm your details and available balance before initiating. Proceed with caution.!</p>
            <div class="withdraw-input">
                <label for="">Withdrawal Amount</label>
                <input name="amount" type="text" oninput="formatAmount(this)" placeholder="Enter Your Desired Amount">
            </div>
            <div class="account_bank_account_container">
                <div class="account_bank_account">
                    <div class="account_bank_container">
                        <div class="account_bank_content">
                            <i class="fa-solid fa-building-columns"></i>
                            <p>Bank Name</p>
                        </div>
                        <p>{{Auth::user()->bank_account}}</p>
                    </div>
                    <div class="account_bank_container">
                        <div class="account_bank_content">
                            <i class="fa-solid fa-money-check"></i>
                            <p>Account Number</p>
                        </div>
                        <p>{{Auth::user()->account_number}}</p>
                    </div>
                </div>
                <div class="account_holder">
                    <div class="account_bank_container">
                        <div class="account_bank_content">
                            <i class="fa-solid fa-user-lock"></i>
                            <p>Account Holder's Name</p>
                        </div>
                        <p>{{Auth::user()->account_name}}</p>
                    </div>
                    <a id="go_to_settings" class="bank_account_links" href="javascript:void(0)">Go to Settings <i class="fa-solid fa-angles-right"></i></a>
                </div>
            </div>
            <div class="withdraw-input">
                <label for="">Password Confirmation</label>
                <input name="password" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            </div>
            <button class="withdraw_request_button">Withdrawal Request</button>
        </form>
    </div>
    <div id="notification-side">
        <div class="notification-side_top">
            <div class="read_unread-box">
                <div class="read_unread-container">
                    <p id="unread_button" onclick="unreadnotify()" class="not_active">Unread ({{$unreadCount}})</p>
                    <p id="read_button" onclick="readnotify()">Read ({{$readCount}})</p>
                </div>
                <p onclick="closeNotification()"><i class="fa-solid fa-xmark"></i></p>
            </div>
            <hr class="not_divider">
        </div>
        <div id="unreadnotifications">
            @foreach ($notifications as $notification)
            <div onclick="markAsRead('{{$notification->id}}')" class="notifications">
                <p class="not-title">{{$notification->data['title']}}</p>
                <p class="not_msg">{{$notification->data['message']}}</p>
                <p class="notification_date">{{$notification->created_at->diffForHumans()}}</p>
            </div>
            @endforeach
        </div>
        <div id="readnotifications">
            @foreach ($readnotifications as $notif)
            <div  class="notifications">
                <p class="not-title">{{$notif->data['title']}}</p>
                <p class="not_msg">{{$notif->data['message']}}</p>
                <p class="notification_date">{{$notif->created_at->diffForHumans()}}</p>
            </div>
            @endforeach
        </div>
    </div>
    <div id="edit_upload-container">
        <form method="POST" id="edit_upload-form" class="edit_upload-form" enctype="multipart/form-data">
            @csrf
            <div class="edit_forn-top">
                <h2 class="edit_upoad-form-header">Edit This Course <i onclick="closeUploadEdit()" id="closeUploadEdit" class="fa-solid fa-xmark"></i></h2>
                <hr style="margin-top: 10px">
            </div>

            <div class="edit-input-container">
                <div class="edit_first_container">
                    <div class="upload-inputs">
                        <label for="">Title</label>
                        <input type="text" name="title_edit">
                    </div> 
                    <div class="upload-inputs">
                        <label for="">Category</label>
                        <select name="category_edit" id="">
                            <option value=""></option>
                        </select>
                    </div>
                </div>
                <div style="height: 100%" class="upload-featured" id="featuredDivs"> 
                    <label for="edit_featured_image">
                        <i class="fa-regular fa-image"></i> 
                        <p>Upload Image</p>
                    </label>
                    <input type="file" name="featured_image_edit" id="edit_featured_image" class="featured_image" accept=".png, .jpg" onchange="displayImage(this)">
                </div>
            </div>
            <div  style="margin-top: 20px" class="upload_type">
                <div class="upload-inputs">
                    <label for="">Start Date</label>
                    <input type="date" name="start_date_edit" id="">
                </div>
                <div class="upload-inputs">
                    <label for="">End Date</label>
                    <input type="date" name="end_date_edit" id="">
                </div>
            </div>
            <div style="grid-template-columns: 2fr 2fr" class="upload-section2">
                <div class="upload-inputs">
                    <label for="">Price($)</label>
                    <input type="text" id="price" name="price_edit" placeholder="Type 0 if free">
                </div>
                <div class="upload-inputs">
                    <label for="">Country</label>
                    <select name="country_edit" class="country">
                        <option value="" selected disabled>Select Country</option>
                    </select>
                </div>
                <div class="upload-inputs">
                    <label for="">Address</label>
                    <input type="text" name="address_edit">
                </div>
                <div class="upload-input">
                    <label for="">Brochure/Downloadable Material</label>
                    <input type="file" id="material" name="material_edit">
                </div>
            </div>
            <div class="upload-section3">
                <textarea style="border: 1px solid #e5e7eb" name="description_edit" id="rte-editor-two" cols="30" rows="10"></textarea>
                <button class="upload_section-button" type="submit">Update</button>
            </div>
        </form>
    </div>
    <div id="select_paymemt-modal">
        <div class="select_payment-container">
            <p style="color: #699a5d; font-size:18px; font-weight:600;display:flex;justify-content:space-between; align-items:center">Choose Payment Option <i onclick="closePlanSelect()" class="fa-solid fa-xmark"></i></p>
            <hr style="border:1px solid #ccc; margin-top:15px">
            <p style="background-color: #eee; color:#699a5d;padding:10px;font-size:12px;margin-top:20px;border-radius:5px;">Subscription to this plan. Note the subtotal for this course is <span id="plan-show-price" class="wallet-balance"></span>. Proceed with caution!</p>
            <div style="margin-top: 20px; display:flex;flex-direction:column; justify-content:space-around; height:150px">
                <button onclick="payWallet('{{ Auth::user()->id }}')"  type="button" style="color:#999; display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-wallet"></i>Pay from Wallet</button>
                <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <hr style="flex: 1; border: none; border-top: 0.5px solid #eee;">
                    <p style="color:#999;margin: 0 10px;">Or</p>
                    <hr style="flex: 1; border: none; border-top: 0.5px solid #eee;">
                </div> 
                <button type="button" onclick="payPlan('{{ Auth::user()->email }}')" style="color:#999;display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-building-columns"></i>Pay from Bank</button>
            </div>
        </div>
    </div>
    <div id="select_paymemt-modal_two">
        <div class="select_payment-container">
            <p style="color: #699a5d; font-size:18px; font-weight:600;display:flex;justify-content:space-between; align-items:center">Choose Payment Option <i onclick="closePlanEntSelect()" class="fa-solid fa-xmark"></i></p>
            <hr style="border:1px solid #ccc; margin-top:15px">
            <p style="background-color: #eee; color:#699a5d;padding:10px;font-size:12px;margin-top:20px;border-radius:5px;">Subscription to this course. Note the subtotal for this course is <span id="plan-ent-show-price" class="wallet-balance"></span>. Proceed with caution!</p>
            <div style="margin-top: 20px; display:flex;flex-direction:column; justify-content:space-around; height:150px">
                <button  onclick="payEntWallet('{{ Auth::user()->id }}')" type="button" style="color:#999; display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-wallet"></i>Pay from Wallet</button>
                <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <hr style="flex: 1; border: none; border-top: 0.5px solid #eee;">
                    <p style="color:#999;margin: 0 10px;">Or</p>
                    <hr style="flex: 1; border: none; border-top: 0.5px solid #eee;">
                </div> 
                <button type="button" onclick="payEntPlan('{{ Auth::user()->email }}')" style="color:#999;display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-building-columns"></i>Pay from Bank</button>
            </div>
        </div>
    </div>
    <div id="ad_paymemt-modal">
        <div class="ad_payment-container">
            <p style="color: #699a5d; font-size:18px; font-weight:600;display:flex;justify-content:space-between; align-items:center">Choose Payment Option <i onclick="closeAdPlanSelect()" class="fa-solid fa-xmark"></i></p>
            <hr style="border:1px solid #ccc; margin-top:15px">
            <p style="background-color: #eee; color:#699a5d;padding:10px;font-size:12px;margin-top:20px;border-radius:5px;">Payment for this ad plan. Note the subtotal for this plan is <span id="selected_ad_price" class="wallet-balance"></span>. Proceed with caution!</p>
            <div style="margin-top: 20px; display:flex;flex-direction:column; justify-content:space-around; height:150px">
                <button  type="button" onclick="payWalletAds()" style="color:#999; display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-wallet"></i>Pay from Wallet</button>
                <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <hr style="flex: 1; border: none; border-top: 0.5px solid #eee;">
                    <p style="color:#999;margin: 0 10px;">Or</p>
                    <hr style="flex: 1; border: none; border-top: 0.5px solid #eee;">
                </div> 
                <button type="button" onclick="payAdsPay('{{Auth::user()->email}}')" style="color:#999;display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-building-columns"></i>Pay from Bank</button>
            </div>
        </div>
    </div>
    <div id="feature_paymemt-modal">
        <div class="ad_payment-container">
            <input id="featured_email" type="text" hidden value="{{Auth::user()->email}}">
            <p style="color: #699a5d; font-size:18px; font-weight:600;display:flex;justify-content:space-between; align-items:center">Choose Payment Option <i onclick="closePlanSelect()" class="fa-solid fa-xmark"></i></p>
            <hr style="border:1px solid #ccc; margin-top:15px">
            <p style="background-color: #eee; color:#699a5d;padding:10px;font-size:12px;margin-top:20px;border-radius:5px;">Payment for this ad plan. Note the subtotal for this plan is ₦<span id="selected_feature_price" class="wallet-balance"></span>. Proceed with caution!</p>
            <div style="margin-top: 20px; display:flex;flex-direction:column; justify-content:space-around; height:150px">
                <button  type="button" onclick="payWalletFeature()" style="color:#999; display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-wallet"></i>Pay from Wallet</button>
                <div style="width: 100%; display: flex; justify-content: center; align-items: center;">
                    <hr style="flex: 1; border: none; border-top: 0.5px solid #eee;">
                    <p style="color:#999;margin: 0 10px;">Or</p>
                    <hr style="flex: 1; border: none; border-top: 0.5px solid #eee;">
                </div> 
                <button onclick="payFeaturedAdsWithPaystack()" type="button" style="color:#999;display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-building-columns"></i>Pay from Bank</button>
            </div>
        </div>
    </div>
    @include('layouts.swap-popup')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script>
        $(document).ready(function () {
            $('#error').fadeIn();
            var timeout = 5000;
            var interval = 50;
            var numIntervals = timeout / interval;
            var progressStep = 100 / numIntervals;
            var progress = 0;
            var progressBar = $('#progress-bar');
            var progressInterval = setInterval(function () {
                progress += progressStep;
                progressBar.width(progress + '%');
    
                if (progress >= 100) {
                    $('#error').fadeOut();
                    clearInterval(progressInterval);
                }
            }, interval);
        });
    </script>
    <script>
        function displayImage(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    var parentElement = input.parentNode; // Get the parent element
                    parentElement.style.backgroundImage = 'url(' + e.target.result + ')';
                }
    
                reader.readAsDataURL(file);
            }
        }
        function displayImages(input) {
            var file = input.files[0];
            if (file) {
                var reader = new FileReader();
    
                reader.onload = function (e) {
                    var parentElement = document.querySelector('.profile_pic'); 
                    const profImg = document.querySelector('.profile-img')
                    
                    parentElement.style.backgroundImage = 'url(' + e.target.result + ')';
                    parentElement.style.backgroundSize = 'cover'; // Set background size to cover

                    profImg.style.display = 'none';
                }
    
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>
        function showSaveButton() {
            var fileInput = document.getElementById('upload');
            var saveButton = document.getElementById('saveButton');
    
            if (fileInput.files.length > 0) {
                saveButton.style.display = 'block';
            } else {
                saveButton.style.display = 'none';
            }
        }
    </script>
    <script>
        function toggleInputs() {
            var programType = document.getElementById("program-type").value;
            var virtualProgramInputs = document.getElementById("host");
            var otherInputs = document.getElementById("video");
            var date = document.getElementById("date");
    
            if (programType === "virtual-program") {
                virtualProgramInputs.style.display = "flex";
                otherInputs.style.display = "none";
                date.style.display = "grid"
            } else if(programType === "e-course"){
                virtualProgramInputs.style.display = "none";
                otherInputs.style.display = "block";
                date.style.display = "none"
            }else{
                virtualProgramInputs.style.display = "none";
                otherInputs.style.display = "none";
                date.style.display = "grid"
            }
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var priceInput = document.getElementById('price');
    
            priceInput.addEventListener('input', function() {
                var value = this.value;
                value = value.replace(/\D/g, '');        
                value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                this.value = value;
            });
        });
    </script>
    <script>
        function updateName() {
            var businessNameInput = document.getElementById("busi");
            var nameInput = document.getElementById("businame");
            nameInput.value = businessNameInput.value;
        }
    </script>
    <script>
        const amountElement = document.getElementById('amount');
        const amountValue = amountElement.value;
        const numericPrice = parseFloat(amountValue.replace(/,/g, ''));
        const paymentForm  = document.getElementById('fund-form');
        paymentForm.addEventListener("submit", payWithPaystack, false);

        function payWithPaystack(e){
            e.preventDefault();
            const numericAmount = parseFloat(document.getElementById("amount").value.replace(/[^\d.]/g, ""));
            oneamount= numericAmount * 0.03*100;
            totamount= numericAmount * 100;
            finamount= oneamount + totamount;

            let handler = PaystackPop.setup({
                key: 'pk_live_34cf0528cd04ac9d4f4675db08bf427bfa1509ad', 
                email: document.getElementById("email").value,
                amount: finamount,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1), 
                callback: function(response) {
                    let reference = response.reference;
                    
                    $.ajax({
                        type: "GET",
                        url: "{{URL::to('fund-wallet')}}/" + reference,
                        data: {
                            reference,
                            numericAmount
                        },
                        success: function(response){
                            console.log(response);
                            if (response[0].status == true) {
                                modal.style.display = "none";
                                window.location.reload();
                                // console.log('hi')
                            } else {
                                document.getElementById('popup').style.display = 'none'; 
                            }
                        }
                    });
            
                },
                onClose: function(response) {

                    modal.style.display = "none";
                    var div = document.createElement('div');
                    div.style.zIndex = "9999";
                    div.className = "alert alert-danger";
                    div.innerHTML = `
                    <div class="popup" id="error" style="display:block">
                        <div class="popup-content">
                            <div class="title">
                                <h3">Sorry :(</h3>
                            </div>
                            <p class="para">Payment Cancelled</p>
                            <div class="progress-container">
                                <div id="progress-bar"></div>
                            </div>
                        </div>

                    </div>`;
                        var fifthChild = document.body.children[3];
                        document.body.insertBefore(div, fifthChild);

                        $(document).ready(function () {
                            $('#error').fadeIn();
                            var timeout = 5000;
                            var interval = 50;
                            var numIntervals = timeout / interval;
                            var progressStep = 100 / numIntervals;
                            var progress = 0;
                            var progressBar = $('#progress-bar');
                            var progressInterval = setInterval(function () {
                                progress += progressStep;
                                progressBar.width(progress + '%');
                    
                                if (progress >= 100) {
                                    $('#error').fadeOut();
                                    clearInterval(progressInterval);
                                }
                            }, interval);
                        });
                    console.log(response)
                },
            });

            handler.openIframe();
        }      
    </script>  
    <script>
        // Define a JavaScript variable with the action URL
        var updateUploadUrl = "c";
        var baseUrl = "{{ asset('/images/') }}";
    </script>
    <script>
        const subscriptionUrl = "{{ URL::to('standard/subscription') }}";
        const subscriptionWalletUrl = "{{ URL::to('standard/wallet/subscription') }}";
        const adsPayUrl = "{{ URL::to('ads-pay') }}";
    </script>
    <script>
        function payWalletFeature() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var uploadId = null;
            
            // Check if neither 'business' nor 'tutor' input is checked
            if (!$('input[value="business"]').is(':checked') && !$('input[value="tutor"]').is(':checked')) {
                uploadId = $('input[name="select_upload"]:checked').attr('data-id');
            }
            
            var featureType = $('input[name="feature_type"]:checked').val();
            const reference = '' + Math.floor((Math.random() * 1000000000) + 1);
            
            $.ajax({
                type: "POST",
                url: "{{ URL::to('pay-featureads-wallet') }}/" + reference,
                headers: {
                    'X-CSRF-TOKEN': csrfToken 
                },
                data: {
                    uploadId: uploadId, // Include uploadId only if it exists
                    featureType: featureType
                },
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                }
            });
        }
    </script>
    <script>
        function payWalletAds() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            const price = document.getElementById('selected_ad').value;
            const adType = document.querySelector('input[name="ads_type"]:checked').value;
            const adLink = document.querySelector('input[name="ads_link"]').value;
            const reference = '' + Math.floor((Math.random() * 1000000000) + 1);
            const adBan = document.getElementById('ad-banner');
            const adBanner = adBan.files[0];

            var formData = new FormData();
            formData.append('reference', reference);
            formData.append('price', price);
            formData.append('adType', adType);
            formData.append('adLink', adLink);
            formData.append('adBanner', adBanner);

            $.ajax({
                type: "POST",
                url: "{{URL::to('pay-ads-wallet')}}/" + reference,
                headers: {
                    'X-CSRF-TOKEN': csrfToken 
                },
                data: formData,
                processData: false, 
                contentType: false,
                success: function(response) {
                    console.log(response);
                    window.location.reload();
                }
            });
        }
    </script>
    {{-- <script>
        function payAdsPay(email){
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        const amount = document.getElementById('selected_ad').value;
        const numericPrice = parseFloat(amount.replace(/[^\d.]/g, ''));
        const oneamount= numericPrice * 0.03*100;
        const totamount= numericPrice * 100;
        const finamount= oneamount + totamount;

        const adType = document.querySelector('input[name="ads_type"]:checked').value;
        const adLink = document.querySelector('input[name="ads_link"]').value;
        const reference = '' + Math.floor((Math.random() * 1000000000) + 1);
        const adBan = document.getElementById('ad-banner');
        const adBanner = adBan.files[0];

        var formData = new FormData();
        formData.append('reference', reference);
        formData.append('price', totamount);
        formData.append('adType', adType);
        formData.append('adLink', adLink);
        formData.append('adBanner', adBanner);

        let paystack = PaystackPop.setup({
            key: 'pk_live_34cf0528cd04ac9d4f4675db08bf427bfa1509ad',
            email: email,
            amount: finamount,
            ref: '' + Math.floor((Math.random() * 1000000000) + 1),

            callback: function (response) {
                let reference = response.reference;
                console.log(formData.get('price'))
                $.ajax({
                    type: "POST",
                    url: "{{ route('adsPaystack', ['reference' => ':reference']) }}".replace(':reference', reference),
                    headers: {
                        'X-CSRF-TOKEN': csrfToken 
                    },
                    data: {
                        formData : formData,
                    },

                    success: function (response) {
                        window.location.reload(); // Added parentheses to execute the function
                        if (response[0].status == true) {
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText); // Log any errors to the console
                    }
                });

            },

            onClose: function (response) {
            },

            // Removed the extra '}' here
        });

        paystack.openIframe();
        }
    </script> --}}
    <script>
        function payAdsPay(email) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            const amount = document.getElementById('selected_ad').value;
            const numericPrice = parseFloat(amount.replace(/[^\d.]/g, ''));
            const oneamount = numericPrice * 0.03 * 100;
            const totamount = numericPrice * 100;
            const finamount = oneamount + totamount;
    
            const adType = document.querySelector('input[name="ads_type"]:checked').value;
            const adLink = document.querySelector('input[name="ads_link"]').value;
            const reference = '' + Math.floor((Math.random() * 1000000000) + 1);
            const adBanner = document.getElementById('ad-banner').files[0];
    
            var formData = new FormData();
            formData.append('reference', reference);
            formData.append('price', amount); // Log the price here
            formData.append('adType', adType);
            formData.append('adLink', adLink);
            formData.append('adBanner', adBanner);
    
            // console.log('Price:', amount); // Log the price before sending the request
    
            let paystack = PaystackPop.setup({
                key: 'pk_live_34cf0528cd04ac9d4f4675db08bf427bfa1509ad',
                email: email,
                amount: finamount,
                ref: reference,
    
                callback: function (response) {
                    let reference = response.reference;
                    $.ajax({
                        type: "POST",
                        url: "{{ route('adsPaystack', ['reference' => ':reference']) }}".replace(':reference', reference),
                        headers: {
                            'X-CSRF-TOKEN': csrfToken 
                        },
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                            window.location.reload(); // Reload the page after successful payment
                            // You can handle response data here if needed
                        },
                        error: function (xhr, status, error) {
                            console.error(xhr.responseText); // Log any errors to the console
                        }
                    });
                }
            });
    
            paystack.openIframe();
        }
    </script>
    
    <script>    
        function payFeaturedAdsWithPaystack(){
            var uploadId = $('input[name="select_upload"]:checked').attr('data-id');
            var featureType = $('input[name="feature_type"]:checked').val();
            const numericAmount = parseFloat(document.getElementById("selected_upload_price").value.replace(/[^\d.]/g, ""));
            oneamount= numericAmount * 0.01*100;
            totamount= numericAmount * 100;
            finamount= oneamount + totamount;

            let handler = PaystackPop.setup({
                key: 'pk_live_34cf0528cd04ac9d4f4675db08bf427bfa1509ad', 
                email: document.getElementById("featured_email").value,
                amount: finamount,
                ref: ''+Math.floor((Math.random() * 1000000000) + 1), 
                callback: function(response) {
                    let reference = response.reference;
                    
                    $.ajax({
                        type: "GET",
                        url: "{{URL::to('pay-featureads')}}/" + reference,
                        data: {
                            reference,
                            oneamount,
                            featureType,
                            uploadId
                        },
                        success: function(response){
                            console.log(response);
                            window.location.reload();
                            // if (response[0].status == true) {
                            //     modal.style.display = "none";
                            //     window.location.reload();
                            //     // console.log('hi')
                            // } else {
                            //     document.getElementById('popup').style.display = 'none'; 
                            // }
                        }
                    });
            
                },
                onClose: function(response) {

                    modal.style.display = "none";
                    var div = document.createElement('div');
                    div.style.zIndex = "9999";
                    div.className = "alert alert-danger";
                    div.innerHTML = `
                    <div class="popup" id="error" style="display:block">
                        <div class="popup-content">
                            <div class="title">
                                <h3">Sorry :(</h3>
                            </div>
                            <p class="para">Payment Cancelled</p>
                            <div class="progress-container">
                                <div id="progress-bar"></div>
                            </div>
                        </div>

                    </div>`;
                        var fifthChild = document.body.children[3];
                        document.body.insertBefore(div, fifthChild);

                        $(document).ready(function () {
                            $('#error').fadeIn();
                            var timeout = 5000;
                            var interval = 50;
                            var numIntervals = timeout / interval;
                            var progressStep = 100 / numIntervals;
                            var progress = 0;
                            var progressBar = $('#progress-bar');
                            var progressInterval = setInterval(function () {
                                progress += progressStep;
                                progressBar.width(progress + '%');
                    
                                if (progress >= 100) {
                                    $('#error').fadeOut();
                                    clearInterval(progressInterval);
                                }
                            }, interval);
                        });
                    console.log(response)
                },
            });

            handler.openIframe();
        }      
    </script>  
    
    {{-- <script>
        $(document).ready(function() {
            $('#searchInput').on('input', function() {
                var query = $(this).val();
    
                if (query === '') {
                    $('#searchResults').empty();
                }
    
                $.ajax({
                    url: "{{ route('search') }}",
                    method: 'POST',
                    data: { query: query },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        displayResults(response);
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
    
            function displayResults(response) {
                var resultList = $('#searchBoxResults');
                var eventsList = $('#eventsBoxResults');
                var workList = $('#workBoxResults');
                resultList.empty();
                eventsList.empty();
                workList.empty();
    
                var results = response.results;
                var events = response.events;
                var work = response.work;
                const trainCount = response.trainCount;
    
                document.getElementById('trainText').textContent = 'Training Providers(' + trainCount + ')';
                document.getElementById('evenText').textContent = 'Events(' + response.evenCount + ')';
                document.getElementById('workText').textContent = 'Workshops(' + response.workCount + ')';
    
    
                $.each(results, function(index, item) {
                    var avatarBaseUrl = "{{ asset('storage/users-avatar/') }}";
                    var resultItem = '<div class="search_results">' +
                                        '<div class="search_results_image_container">' +
                                            '<img src="' + avatarBaseUrl + '/' + item.avatar + '" alt="">' +
                                        '</div>' +
                                        '<p class="search_results_text">' + item.businessname + '</p>' +
                                    '</div>';
                    resultList.append(resultItem);
                });
                $.each(events, function(index, item) {
                    var featuredBaseUrl = "{{ asset('images/') }}";
                    var resultItem = '<a href="/' + item.slug_url + '/' + item.upload_type + '/' + item.id + '" class="event_results">' +
                                        '<div class="event_results_image_container">' +
                                            '<img src="' + featuredBaseUrl + '/' + item.featured_image + '" alt="">' + 
                                        '</div>' +
                                        '<p class="search_event_title">' + item.title + '</p>' + 
                                    '</a>';
                    eventsList.append(resultItem);
                });
                $.each(work, function(index, item) {
                    var featuredBaseUrl = "{{ asset('images/') }}";
                    var resultItem = '<a href="/' + item.slug_url + '/' + item.upload_type + '/' + item.id + '" class="event_results">' +
                                        '<div class="event_results_image_container">' +
                                            '<img src="' + featuredBaseUrl + '/' + item.featured_image + '" alt="">' + 
                                        '</div>' +
                                        '<p class="search_event_title">' + item.title + '</p>' + 
                                    '</a>';
                    workList.append(resultItem);
                });
            }
        });
    </script>
    <script>
        document.getElementById('serachForm').addEventListener('submit', (e)=>{
            e.preventDefault();
        })
    </script> --}}

    <script>
        function showStudentBookings(){
            const tutorStudents = document.getElementById('enrolledCourses')
            const tutorBookings = document.getElementById('tutorBookings')

            if(tutorStudents.style.display === 'none'){
                tutorStudents.style.display = 'block'
                tutorBookings.style.display = 'none'
            } else {
                tutorStudents.style.display = 'none'
                tutorBookings.style.display = 'block'
            }
        }
    </script>

<script>
    // document.addEventListener('DOMContentLoaded', function () {
    // const paymentForm = document.getElementById('paymentForm');
    // paymentForm.addEventListener("submit", payWithPaystack, false);

    function payBookingWithPaystack() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    // e.preventDefault();

    const amountElement = document.getElementById('bookingAmount');
    const emailElement = '{{ Auth::user()->email }}'; // Render email directly in the script
    const tutorId = document.getElementById('bookingTutorId').value;
    const bookingId = document.getElementById('bookingId').value;

    if (!amountElement) {
        console.error('Amount element not found');
        return;
    }

    const amountValue = amountElement.value;
    const numericAmount = parseFloat(amountValue.replace(/[^\d.]/g, ""));
    if (isNaN(numericAmount)) {
        console.error('Invalid amount');
        return;
    }

    const email = emailElement;
    if (!email) {
        console.error('Email not provided');
        return;
    }

    const oneamount = numericAmount * 0.03 * 100;
    const totamount = numericAmount * 100;
    const finamount = oneamount + totamount;

    let handler = PaystackPop.setup({
        key: 'pk_test_ec63f7d3f340612917fa775bde47924bb4a90af7',
        email: email,
        amount: finamount,
        ref: '' + Math.floor((Math.random() * 1000000000) + 1),
        callback: function (response) {
            const reference = response.reference;
            console.log('Paystack callback invoked with reference:', reference);

            $.ajax({
                type: "GET",
                url: `/pay-for-bookings/${reference}`,
                data: {
                    numericAmount: numericAmount,
                    email: email,
                    tutorId: tutorId,
                    bookingId: bookingId
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    if (response.status === true) {
                        console.log('Payment successful:', response.message);
                        // alert('Payment successful: ' + response.message);
                        window.location.reload();
                    } else {
                        console.error('Payment failed:', response.message);
                        // alert('Payment failed: ' + response.message);
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', status, error);
                    // alert('An error occurred: ' + error);
                }
            });
        },
        onClose: function () {
            alert('Transaction was not completed, window closed.');
        }
    });

    handler.openIframe();
}

</script>


@endsection