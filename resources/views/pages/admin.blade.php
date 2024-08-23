<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tiny.cloud/1/mkyaup5rx10x4g0h9h3iqvea4fx46wl690xfxnfu1c1ssrev/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <title>Admin Dashboard</title>
    @notifyCss
</head>
<body>
    <x-notify::notify />
    <section class="admin_full-section">
        <section class="side_section">
            <div class="admin_side_section">
                <div class="admin-logo">
                    <img src="{{asset('assets/images/ntp-logo.png')}}" alt="">
                </div>
                <div class="admin_tabs-container">
                    <div id="admin_side-dash" class="transaction_back admin_tab"><i class="fa-solid fa-chart-column"></i>Dashboard</div>
                    <div id="admin_side-users" class="admin_tab"><i class="fa-solid fa-users"></i>All Users</div>
                    <div id="admin_side-business" class="admin_tab"><i class="fa-solid fa-briefcase"></i>All Business</div>
                    <div id="admin_side-prof" class="admin_tab"><i class="fa-solid fa-user-tie"></i>All Tutors</div>
                    <div id="admin_side-approve" class="admin_tab"><i class="fa-solid fa-money-bill-transfer"></i>Approve Withdrawals</div>
                    <div id="admin_side-kyc" class="admin_tab"><i class="fa-solid fa-id-card"></i>KYC Verification</div>
                    <div id="admin_side-advert" class="admin_tab"><i class="fa-solid fa-bullseye"></i></i>Advert Manager</div>
                    <div id="admin_side-news" class="admin_tab"><i class="fa-solid fa-newspaper"></i>News & Articles</div>
                    <div id="admin_side-category" class="admin_tab"><i class="fa-solid fa-layer-group"></i></i>Categories</div>
                    <div id="admin_side-settings" class="admin_tab"><i class="fa-solid fa-gear"></i>Settings</div>
                </div>
            </div>
        </section>
        <section class="admin_info-section">
            <div class="admin_info-top-section">
                <div class="top-icon-container">
                    <a href="#"><i class="fa-regular fa-bell"></i></a>
                    <a href="#"><i class="fa-solid fa-user-lock"></i></a>
                    <a href="{{url('/logout')}}"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                </div>
            </div>
            <section id="admin_dashboard_section">
                <div class="admin_top-subsection">
                    <p class="transaction_text-heading">Dashboard</p >
                    <div class="transaction_tabs">
                        <p id="all_days" class="transaction_tabs_back">All Time</p>
                        <p id="dash_seven">Last 7 days</p>
                        <p id="dash_fourt">Last 14 days</p>
                        <p id="dash_thirty">Last 30 days</p>
                    </div>
                </div>
                <div class="transaction_dashboard">
                    <div class="dashboard_metrics">
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-money-bill-wave"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Profits</p>
                                <p class="wallet-balance">{{Auth::user()->wallet_balance}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-users"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Users</p>
                                <p class="metrics-text" id="users_count">{{$usCount}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-briefcase"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Business</p>
                                <p class="metrics-text" id="business_count">{{$busCount}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-user-tie"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Tutors</p>
                                <p class="metrics-text" id="prof_count">{{$proCount}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-users-gear"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Workshops</p>
                                <p class="metrics-text" id="work_count">{{$workCount}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-regular fa-calendar"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Events</p>
                                <p class="metrics-text" id="events_count">{{$evenCount}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-laptop"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">E-Courses</p>
                                <p class="metrics-text" id="e-course_count">{{$eCount}}</p>
                            </div>
                        </div>
                        <div class="dashboard_metrics-container">
                            <div class="dashboard_metrics-icon"><i class="fa-solid fa-globe"></i></div>
                            <div>
                                <p class="dashboard_stats_heading">Virtual Program</p>
                                <p class="metrics-text" id="v-program_count">{{$virtCount}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="admin_top-subsection">
                    <p class="transaction_text-heading">All Transactions</p >
                    <div class="transaction_tabs">
                        <p onclick="transall()" id="admin_all_check" class="transaction_tabs_back">All</p>
                        <p onclick="filterTransaction('deposit')" id="admin_all_depo">Deposit</p>
                        <p onclick="filterTransaction('withdraw')" id="admin_all_withdraw">Withdrawal</p>
                        <p onclick="filterTransaction('subscribe')" id="admin_all_subscribe">Others</p>
                    </div>
                </div>
                <div class="transaction_dashboard">
                    <table id="myTable" class="styled-table">
                        <thead>
                            <tr>
                                <th>User Details</th>
                                <th>Amount</th>
                                <th>Transaction Status</th>
                                <th>Transaction Type</th>
                                <th>Reference</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody id="admintransactionsBody">
                            @foreach ($alltransactions as $alltransaction)
                            <tr class="transactions-row" data-all="alltrans" data-transaction="{{$alltransaction->transaction_type}}">
                                <td class="table_user-info">
                                    <div class="table_user-info-logo">
                                            <img src="{{ asset("/storage/users-avatar/{$alltransaction->user->avatar}") }}" alt="">
                                    </div>
                                    <div>{{ ($alltransaction->user)->name }}</div> 
                                </td>
                                <td class="wallet-balance">{{ $alltransaction->amount }}</td>
                                @if ($alltransaction->status === 'success')
                                    <td><p class="success_status">{{ $alltransaction->status }}</p></td>
                                @elseif ($alltransaction->status === 'failed')
                                    <td><p class="failed_status">{{ $alltransaction->status }}</p></td>
                                @elseif ($alltransaction->status === 'pending')
                                    <td><p class="pending_status">{{ $alltransaction->status }}</p></td>
                                @endif
                                <td>{{ ucfirst($alltransaction->transaction_type) }}</td>
                                <td>{{ $alltransaction->reference }}</td>
                                <td>{{ $alltransaction->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> 
                <div style="margin-top: 20px; text-align:center" class="trans_error"></div> 
                </div>
            </section>
            <section id="admin_users_section">
                <div class="admin_user-top-subsection">
                    <p class="transaction_text-heading">All users</p >
                    <div class="transaction_tabs">
                        <p id="all_usdays" class="transaction_tabs_back">All Time</p>
                        <p id="dash_usseven">Last 7 days</p>
                        <p id="dash_usfourt">Last 14 days</p>
                        <p id="dash_usthirt">Last 30 days</p>
                    </div>
                </div>
                <div class="admin_user_full_section">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>User Details</th>
                                <th>KYC Status</th>
                                <th>Telephone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody id="user-table-body">
                            @foreach ($allUsers as $allUser)
                                <tr>
                                    <td>
                                        <div class="user_details_container">
                                            <div class="user_details_container_logo">
                                                <img src="{{asset("/storage/users-avatar/$allUser->avatar")}}" alt="">
                                            </div>
                                            <div>
                                                <p class="user_details_name">{{$allUser->name}}</p>
                                                <p class="user_details_email">{{$allUser->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    @if ($allUser->kyc_status === 'verified')
                                    <td><p class="success_status">{{ $allUser->kyc_status }}</p></td>
                                    @elseif ($allUser->kyc_status === 'rejected' || $allUser->kyc_status === 'not verified')
                                        <td><p class="failed_status">{{ $allUser->kyc_status }}</p></td>
                                    @elseif ($allUser->kyc_status === 'pending')
                                        <td><p class="pending_status">{{ $allUser->kyc_status }}</p></td>
                                    @endif
                                    <td>{{$allUser->telephone}}</td>
                                    <td>{{$allUser->address}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <section id="admin_business_section">
                <div class="admin_user-top-subsection">
                    <p class="transaction_text-heading">All Business</p >
                    <div class="transaction_tabs">
                        <p id="all_busdays" class="transaction_tabs_back">All Time</p>
                        <p id="dash_busseven">Last 7 days</p>
                        <p id="dash_busfourt">Last 14 days</p>
                        <p id="dash_busthirt">Last 30 days</p>
                    </div>
                </div>
                <div class="admin_user_full_section">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>User Details</th>
                                <th>KYC Status</th>
                                <th>Subscription</th>
                                <th>Verification Badge</th>
                                <th>Telephone</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody  id="user-business-body">
                            @foreach ($allBusinesses as $allBusiness)
                                <tr>
                                    <td>
                                        <div class="user_details_container">
                                            <div class="user_details_container_logo">
                                                <img src="{{asset("/storage/users-avatar/$allBusiness->avatar")}}" alt="">
                                            </div>
                                            <div>
                                                <p class="user_details_name">{{$allBusiness->name}}</p>
                                                <p class="user_details_email">{{$allBusiness->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    @if ($allBusiness->kyc_status === 'verified')
                                    <td><p class="success_status">{{ $allBusiness->kyc_status }}</p></td>
                                    @elseif ($allBusiness->status === 'rejected' || $allBusiness->kyc_status === 'not verified')
                                        <td><p class="failed_status">{{ $allBusiness->kyc_status }}</p></td>
                                    @elseif ($allBusiness->kyc_status === 'pending')
                                        <td><p class="pending_status">{{ $allBusiness->kyc_status }}</p></td>
                                    @endif
                                    <td>{{ucfirst($allBusiness->business->subscription)}}</td>
                                    <td>{{ucfirst($allBusiness->business->verification_badge)}}</td>
                                    <td>{{$allBusiness->telephone}}</td>
                                    <td>{{$allBusiness->address}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <section id="admin_prof_section">
                <div class="admin_user-top-subsection">
                    <p class="transaction_text-heading">All Professionals</p >
                    <div class="transaction_tabs">
                        <p class="transaction_tabs_back">All Time</p>
                        <p>Last 7 days</p>
                        <p>Last 14 days</p>
                        <p>Last 30 days</p>
                    </div>
                </div>
                <div class="admin_user_full_section">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>User Details</th>
                                <th>Status</th>
                                <th>KYC Status</th>
                                <th>Telephone</th>
                                <th>Address</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allProfessionals as $allProfessional)
                                <tr>
                                    <td>
                                        <div class="user_details_container">
                                            <div class="user_details_container_logo">
                                                <img src="{{asset("/storage/users-avatar/$allProfessional->avatar")}}" alt="">
                                            </div>
                                            <div>
                                                <p class="user_details_name">{{$allProfessional->name}}</p>
                                                <p class="user_details_email">{{$allProfessional->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ucfirst($allProfessional->tutor->status)}}</td>
                                    @if ($allUser->kyc_status == 'not verified')
                                        <td><p class="kyc_not_verified">{{$allProfessional->kyc_status}}</p></td>
                                    @else
                                        <td><p class="kyc_verified">{{$allProfessional->kyc_status}}</p></td>
                                    @endif
                                    <td>{{$allProfessional->telephone}}</td>
                                    <td>{{$allProfessional->address}}</td>
                                    <td>
                                        <a href="{{url("/view/tutor/$allProfessional->id")}}" class="withdraw_view">View</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <section id="admin_approve_section">
                <div class="admin_user-top-subsection">
                    <p class="transaction_text-heading">Pending Withdrawals</p >
                    <div class="transaction_tabs">
                        <p class="transaction_tabs_back">All Time</p>
                        <p>Last 7 days</p>
                        <p>Last 14 days</p>
                        <p>Last 30 days</p>
                    </div>
                </div>
                <div class="admin_user_full_section">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>User Details</th>
                                <th>Reference</th>
                                <th>Status</th>
                                <th>Amount</th>
                                <th>Approve/Reject</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingWithrawals as $pendingWithrawal)
                                <tr>
                                    <td>
                                        <div class="user_details_container">
                                            <div class="user_details_container_logo">
                                                <img src="{{ asset("/storage/users-avatar/{$pendingWithrawal->user->avatar}") }}" alt="">
                                            </div>
                                            <div>
                                                <p class="user_details_name">{{$pendingWithrawal->user->name}}</p>
                                                <p class="user_details_email">{{$pendingWithrawal->user->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{$pendingWithrawal->reference}}</td>
                                    @if ($pendingWithrawal->status === 'success')
                                    <td><p class="success_status">{{ $pendingWithrawal->status }}</p></td>
                                    @elseif ($pendingWithrawal->status === 'failed')
                                        <td><p class="failed_status">{{ $pendingWithrawal->status }}</p></td>
                                    @elseif ($pendingWithrawal->status === 'pending')
                                        <td><p class="pending_status">{{ $pendingWithrawal->status }}</p></td>
                                    @endif
                                    <td class="wallet-balance">{{$pendingWithrawal->amount}}</td>
                                    <td>
                                        <div class="withdraw_approve_reject--container">
                                            <button data-request-id="{{ $pendingWithrawal->id }}" class="withdraw_approve">Approve</button>
                                            <button class="withdraw_reject">Reject</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>
            <section id="admin_kyc_verification">
                <div class="admin_user-top-subsection">
                    <p class="transaction_text-heading">Pending Verifications</p >
                    <div class="transaction_tabs">
                        <p class="transaction_tabs_back">All Time</p>
                        <p>Last 7 days</p>
                        <p>Last 14 days</p>
                        <p>Last 30 days</p>
                    </div>
                </div>
                <div class="admin_user_full_section">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>User Details</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pendingKycs as $pendingKyc)
                                <tr>
                                    <td>
                                        <div class="user_details_container">
                                            <div class="user_details_container_logo">
                                                <img src="{{ asset("/storage/users-avatar/{$pendingKyc->user->avatar}") }}" alt="">
                                            </div>
                                            <div>
                                                <p class="user_details_name">{{$pendingKyc->user->name}}</p>
                                                <p class="user_details_email">{{$pendingKyc->user->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td><p class="pending_status">{{ $pendingKyc->status }}</p></td>
                                    <td>
                                        <a href="{{url("/view/kyc/$pendingKyc->id")}}" class="withdraw_view">View</a>
                                    </td>
                                    <td>{{$pendingKyc->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($countKyc == '0')
                        <h1 class="pending-header">No Pending Verifications</h1>
                    @endif
                </div>
            </section>
            <section id="admin_ads_section">
                <div class="admin_user-top-subsection">
                    <p class="transaction_text-heading">All Ads</p >
                    <div class="transaction_tabs">
                        <p class="transaction_tabs_back">All Ads</p>
                        <p>Pending</p>
                        <p>Active</p>
                        <p>Rejected</p>
                        <p>Completed</p>
                    </div>
                </div>
                <div class="admin_user_full_section">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>User Details</th>
                                <th>Status</th>
                                <th>Ad Type</th>
                                <th>View</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allAds as $allAd)
                                <tr>
                                    <td>
                                        <div class="user_details_container">
                                            <div class="user_details_container_logo">
                                                <img src="{{ asset("/storage/users-avatar/{$allAd->user->avatar}") }}" alt="">
                                            </div>
                                            <div>
                                                <p class="user_details_name">{{$allAd->user->name}}</p>
                                                <p class="user_details_email">{{$allAd->user->email}}</p>
                                            </div>
                                        </div>
                                    </td>
                                    {{-- <td><p class="pending_status">{{ $allAd->ads_status }}</p></td> --}}
                                    @if ($allAd->ads_status === 'active')
                                    <td><p class="success_status">{{ $allAd->ads_status }}</p></td>
                                    @elseif ($allAd->ads_status === 'rejected')
                                        <td><p class="failed_status">{{ $allAd->ads_status }}</p></td>
                                    @elseif ($allAd->ads_status === 'pending')
                                        <td><p class="pending_status">{{ $allAd->ads_status }}</p></td>
                                    @endif
                                    <td><p>{{ ucfirst($allAd->ads_type) }}</p></td> 
                                    <td>
                                        <a href="{{url("/view/ad/$allAd->id")}}" class="withdraw_view">View</a>
                                    </td>                                   
                                    <td>{{$allAd->created_at->diffForHumans()}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($countAds == '0')
                        <h1 class="pending-header">No Ads</h1>
                    @endif
                </div>
            </section>
            <section id="admin_news_section">
                <div class="top-news-section">
                    <h1 style="color: #999;font-size:20px; font-weight:500">All News</h1>
                    <button onclick="openCreateGroup()" id="header_button" class="header_button">Create News +</button>
                </div>
                <div class="news_grid">
                    @foreach ($allnews as $allnew)
                    <div style="margin-top: 30px;" class="allupload">
                        <div class="allupload-images">
                            <img src="{{ asset("newsimage/$allnew->featured_image") }}" alt="">
                        </div>
                        <div class="allupload-text">
                            <h1 class="news_clamp">{{$allnew->title}}</h1>
                            <div style="color: #eee" class="news-content font-normal">{!! $allnew->news_content !!}</div>
                            <div class="allupload-logo-container">
                                <div class="allupload-logo">
                                    <img src='{{ asset("storage/users-avatar/" . Auth::user()->avatar) }}' alt="">
                                </div>
                                <p>{{ Auth::user()->name }}</p>
                            </div>
                        </div>
                        <div class="change_buttons">
                            <a onclick="openEditNewsModal({{$allnew->id}})" id="edit">Edit</a>
                            <form action="{{url('delete-news/'. $allnew->id)}}" method="post">
                                <button id="delete">Delete</button>
                            </form>
                        </div>
                    </div>
                @endforeach
                </div>
            </section>
            <section id="category_section">
                <div class="admin-category-container">
                    <div class="form-container">
                        <form method="POST" action="{{route('createCategory')}}" id="create-category-form" enctype="multipart/form-data">
                            @csrf
                            <h1>Create New Category</h1>
                            <div class="form-group">
                                <label for="category-name">Category Name</label>
                                <input type="text" id="category-name" name="category_name" required>
                            </div>
                            <div class="form-group">
                                <label for="category-description">Description</label>
                                <textarea id="category-description" name="category_description" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category-image">Upload Image</label>
                                <input type="file" id="category-image" name="category_image" accept="image/*" required>
                            </div>
                            <button type="submit">Create Category</button>
                        </form>
                    </div>
                    <div class="categories-container">
                        <h1>Categories</h1>
                        @foreach ($allCategories as $category)
                        <div class="category-card">
                            <img src="{{asset("categoryimages/{$category->category_image}")}}" alt="Category Image">
                            <div class="category-info">
                                <h2>{{$category->name}}</h2>
                                <p>{{$category->description}}</p>
                                <p class="course-count">Courses: 10</p>
                            </div>
                            <div class="category-actions">
                                <button class="edit-btn">Edit</button>
                                <button class="delete-btn">Delete</button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
            <section id="setting_section">
                <div class="default-top-banners">
                    <h1 class="home-banner-heading">Default Home Top Banners</h1>
                    <hr style="margin-top: 10px">
                    <div class="default-home-banners-container">
                        @foreach ($defaultImages->where('banner_name', 'Home Top Banner') as $hometopbanner)
                            <div class="default-home-banner">
                                <img src="{{ asset("defaultimages/{$hometopbanner->image_location}") }}" alt="">
                                <i class="fa-solid fa-pen home-banner_edit"></i>
                                <form action="{{ url("banner-delete/{$hometopbanner->id}") }}" method="POST">
                                    @csrf
                                    <button type="submit" class="fa-solid fa-trash home-banner-delete"></button>
                                </form>
                            </div>
                        @endforeach
                        <i id="addHomeTopBanner" class="fa-solid fa-plus home-banner_add" onclick="openAddImageModal('top')"></i>
                    </div>
                </div>
                
                <div class="default-top-banners" style="margin-top: 20px">
                    <h1 class="home-banner-heading">Default Home Promoted Sliding Banners</h1>
                    <hr style="margin-top: 10px">
                    <div class="default-home-banners-container">
                        @foreach ($defaultImages->where('banner_name', 'Home Promoted Banner') as $hometopbanner)
                            <div class="default-home-promoted-banner">
                                <img src="{{ asset("defaultimages/{$hometopbanner->image_location}") }}" alt="">
                                <i class="fa-solid fa-pen home-banner_edit"></i>
                                <form action="{{ url("banner-delete/{$hometopbanner->id}") }}" method="POST">
                                    @csrf
                                    <button type="submit" class="fa-solid fa-trash home-banner-delete"></button>
                                </form>
                            </div>
                        @endforeach
                        <i id="addHomePromotedBanner" class="fa-solid fa-plus home-banner_add" onclick="openAddImageModal('promoted')"></i>
                    </div>
                </div>
                
                <div class="default-top-banners" style="margin-top: 20px">
                    <h1 class="home-banner-heading">Default Inpage Sliding Banners</h1>
                    <hr style="margin-top: 10px">
                    <div class="default-home-banners-container">
                        @foreach ($defaultImages->where('banner_name', 'Inpage Promoted Banner') as $hometopbanner)
                            <div class="default-home-promoted-banner">
                                <img src="{{ asset("defaultimages/{$hometopbanner->image_location}") }}" alt="">
                                <i class="fa-solid fa-pen home-banner_edit"></i>
                                <form action="{{ url("banner-delete/{$hometopbanner->id}") }}" method="POST">
                                    @csrf
                                    <button type="submit" class="fa-solid fa-trash home-banner-delete"></button>
                                </form>
                            </div>
                        @endforeach
                        <i id="addHomePromotedBanner" class="fa-solid fa-plus home-banner_add" onclick="openAddImageModal('inpage')"></i>
                    </div>
                </div>

                <div class="default-top-banners" style="margin-top: 20px">
                    <h1 class="home-banner-heading">Default Home Side Banners</h1>
                    <hr style="margin-top: 10px">
                    <div class="default-home-banners-container">
                        @foreach ($defaultImages->where('banner_name', 'Home Side Banner') as $hometopbanner)
                            <div class="default-home-side-banner">
                                <img src="{{ asset("defaultimages/{$hometopbanner->image_location}") }}" alt="">
                                <i class="fa-solid fa-pen home-banner_edit"></i>
                                <form action="{{ url("banner-delete/{$hometopbanner->id}") }}" method="POST">
                                    @csrf
                                    <button type="submit" class="fa-solid fa-trash home-banner-delete"></button>
                                </form>
                            </div>
                        @endforeach
                        <i id="addHomePromotedBanner" class="fa-solid fa-plus home-banner_add" onclick="openAddImageModal('side')"></i>
                    </div>
                </div>
            </section>
            <form id="formHomeBanner" action="{{ route('add.promoted-banner') }}" enctype="multipart/form-data" method="POST">
                @csrf
                @include('layouts.changeimage')
            </form>
        </section>
    </section>
@include('layouts.newsmodal')
<div style="display: none" id="editnews">
    @include('layouts.editnewsmodal')
</div>

<script src="{{asset('assets/js/script.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>


<script>
    tinymce.init({
        selector: '#blog-editor-edit',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.withdraw_approve', function() {
            var withdrawalId = $(this).data('request-id');
            approveWithdrawalRequest(withdrawalId );
            // console.log(requestId)
        });
        function approveWithdrawalRequest(withdrawalId) {
        $.ajax({
            url: '/withdrawal-request/' + withdrawalId + '/approve',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('success');
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert(xhr.responseText)
                console.error(xhr.responseText);
            }
        });
    }
    });
</script>
</script>
<script>
    function openAddImageModal(type) {
        if (type === 'top') {
            document.getElementById('formHomeBanner').action = "{{ route('add.top-banner') }}";
            document.getElementById('changeImageContainer').style.display = 'block';
        } else if (type === 'promoted') {
            document.getElementById('formHomeBanner').action = "{{ route('add.promoted-banner') }}";
            document.getElementById('changeImageContainer').style.display = 'block';
        } else if (type === 'inpage'){
            document.getElementById('formHomeBanner').action = "{{ route('add.inpage-banner') }}";
            document.getElementById('changeImageContainer').style.display = 'block';
        } else if(type === 'side'){
            document.getElementById('formHomeBanner').action = "{{ route('add.side-banner') }}";
            document.getElementById('changeImageContainer').style.display = 'block';
        }
    }
</script>
<script>
    function openEditNewsModal(newsId) {
        document.getElementById('editnews').style.display = 'block';
        $('#editNewsForm').attr('action', `/updatenews/${newsId}`);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/editnews/' + newsId,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken 
            },
            success: function(response) {
                $('#editNewsTitle').val(response.title);
                tinymce.get('blog-editor-edit').setContent(response.news_content);
                // $('#editNewsContent').val(response.content);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
</script>
<script>
    tinymce.init({
        selector: '#blog-editor',
        plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        toolbar_mode: 'floating',
    });
</script>
<script>
    function closenewsEditModal(){
        document.getElementById('editnews').style.display = 'none';
    }
    function closenewsModal(){
        document.getElementById('register_info-modal').style.display = 'none';
    }
</script>
@notifyJs
</body>
</body>
</html>