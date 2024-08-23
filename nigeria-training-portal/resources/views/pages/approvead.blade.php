@extends('master')
@section('content-pages')

    <section id="view_kyc_verification">
        <div class="kyc_section_grid">
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-regular fa-user"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Name</p>
                    <p class="kyc_tab_info-text">{{$approve->user->name}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-regular fa-file-lines"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Ad Type</p>
                    <p class="kyc_tab_info-text">{{ucfirst($approve->ads_type)}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-solid fa-file-invoice"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Ad Link</p>
                    <p class="kyc_tab_info-text">{{$approve->ads_link}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Impressions</p>
                    <p class="kyc_tab_info-text">{{$approve->impressions}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-solid fa-phone-volume"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Clicks</p>
                    <p class="kyc_tab_info-text">{{$approve->clicks}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-regular fa-calendar-days"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Date</p>
                    <p class="kyc_tab_info-text">{{ \Carbon\Carbon::parse($approve->created_at)->format('d F Y') }}</p>

                </div>
            </div>
        </div>
        <h1 class="kyc_pic_header">Ad Banner</h1>
        <div>
            <div class="ad_approve_banner">
                <img src="{{asset("adsbanner/$approve->ads_banner")}}" alt="">
            </div>
        </div>
        @if ($approve->ads_status == 'pending')
            <div class="kyc_page_button_container">
                <a class="withdraw_approve" href="{{url("/approve/ad/$approve->id")}}">Approve</a>
                <a class="withdraw_reject" href="{{url("/reject/ad/$approve->id")}}">Reject</a>
            </div>
        @endif
    </section>
@endsection