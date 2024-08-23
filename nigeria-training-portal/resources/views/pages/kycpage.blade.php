@extends('master')
@section('content-pages')

    <section id="view_kyc_verification">
        @foreach ($kyc as $kycs)
        <div class="kyc_section_grid">
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-regular fa-user"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Name</p>
                    <p class="kyc_tab_info-text">{{$kycs->user->name}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-regular fa-file-lines"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Document Type</p>
                    <p class="kyc_tab_info-text">{{$kycs->document_type}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-solid fa-file-invoice"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Document Number</p>
                    <p class="kyc_tab_info-text">{{$kycs->document_number}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Home Address</p>
                    <p class="kyc_tab_info-text">{{$kycs->home_address}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-solid fa-phone-volume"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Phone Number</p>
                    <p class="kyc_tab_info-text">{{$kycs->phone_number}}</p>
                </div>
            </div>
            <div class="kyc_tabs">
                <div class="kyc_tab_icon"><i class="fa-regular fa-calendar-days"></i></div>
                <div class="kyc_tab_info">
                    <p class="kyc_tab_info-header">Date of Bith</p>
                    <p class="kyc_tab_info-text">{{ \Carbon\Carbon::createFromFormat('Y-m-d', $kycs->date_of_birth)->format('d F Y') }}</p>
                </div>
            </div>
        </div>
        <h1 class="kyc_pic_header">KYC Images</h1>
        <div class="kyc_images_container">
            <a target="_blank" href="{{url("/kycdocuments/$kycs->kyc_selfie")}}" class="kyc_single_image_container">
                <p>KYC Selfie</p>
                <img src="{{asset("kycdocuments/$kycs->kyc_selfie")}}" alt="">
            </a>
            <a target="_blank" href="{{url("/kycdocuments/$kycs->front_document")}}" class="kyc_single_image_container">
                <p>KYC Front Document</p>
                <img src="{{asset("kycdocuments/$kycs->front_document")}}" alt="">
            </a>
            <a target="_blank" href="{{url("/kycdocuments/$kycs->back_document")}}" class="kyc_single_image_container">
                <p>KYC Back Document</p>
                <img src="{{asset("kycdocuments/$kycs->back_document")}}" alt="">
            </a>
        </div>
        <div class="kyc_page_button_container">
            <a class="withdraw_approve" href="{{url("/approve/kyc/$kycs->id")}}">Approve</a>
            <a class="withdraw_reject" href="{{url("/reject/kyc/$kycs->id")}}">Reject</a>
        </div>
        @endforeach
    </section>
@endsection