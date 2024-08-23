@extends('master')
@section('content-pages')

    <section id="view_kyc_verification">
        {{-- @foreach ($user as $kycs) --}}
        <div class="kyc_section_grid">
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-regular fa-user"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Name</p>
                    <p class="kyc_tab_info-text">{{$user->name}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-regular fa-file-lines"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Rate Per Hour</p>
                    <p class="kyc_tab_info-text">{{$user->tutor->rate_per_hour}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-solid fa-file-invoice"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Availability</p>
                    <p class="kyc_tab_info-text">{{ucfirst($user->tutor->availability)}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Description</p>
                    <p class="kyc_tab_info-text">{{$user->tutor->description}}</p>
                </div>
            </div>
            {{-- <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-solid fa-phone-volume"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Phone Number</p>
                    <p class="kyc_tab_info-text">{{$kycs->phone_number}}</p>
                </div>
            </div> --}}
            {{-- <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-regular fa-calendar-days"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Date of Bith</p>
                    <p class="kyc_tab_info-text">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $kycs->date_of_birth)->format('d F Y') }}</p>
                </div>
            </div> --}}
        </div>
        <h1 class="kyc_pic_header">About Images</h1>
        <div class="kyc_images_container" style="grid-template-columns: 1fr 1fr">
            <a target="_blank" href="{{url("/headshots/{$user->tutor->headshot}")}}" class="kyc_single_image_container">
                <p>HeadShot Photo</p>
                <img src="{{asset("/headshots/{$user->tutor->headshot}")}}" alt="">
            </a>
            <a target="_blank" href="{{ url('/about-videos/' . $user->tutor->video) }}" class="kyc_single_image_container">
                <p>Short Video about Self</p>
                <video controls>
                    <source src="{{ asset('/about-videos/' . $user->tutor->video) }}" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </a>
            {{-- <a target="_blank" href="{{url("/kycdocuments/$kycs->back_document")}}" class="kyc_single_image_container">
                <p>KYC Back Document</p>
                <img src="{{asset("kycdocuments/$kycs->back_document")}}" alt="">
            </a> --}}
        </div>
        <div class="kyc_page_button_container">
            <a class="withdraw_approve" href="{{url("/approve/tutor/{$user->tutor->id}")}}">Approve</a>
            <a class="withdraw_reject" href="{{url("/reject/tutor/{$user->tutor->id}")}}">Reject</a>
        </div>
        {{-- @endforeach --}}
    </section>
@endsection