@extends('master')
@section('content-pages')
    <section class="ad-section">
        @if ($inpages->isEmpty())
            @foreach ($defaultImages->where('banner_name', 'Inpage Promoted Banner') as $hometopbanner)
                @php
                    $imageLink = $hometopbanner->image_link;
                    if (!preg_match("~^(?:f|ht)tps?://~i", $imageLink)) {
                        $imageLink = "http://{$imageLink}";
                    }
                @endphp
                <a onclick="countClick(event)" href="{{ $imageLink }}" target="_blank" class="rotate-ad">
                    <img id="{{$hometopbanner->id}}" src="{{ asset("defaultimages/{$hometopbanner->image_location}") }}" alt="">
                </a>
            @endforeach
        @else
            @foreach ($inpages as $inpage)
                <a href="{{ url("//$inpage->ads_link") }}" target="_blank" class="rotate-ad">
                    <img src="{{ asset("adsBanner/$inpage->ads_banner") }}" alt="">
                </a>
            @endforeach
        @endif
    </section>
    <section class="events-section">
        <h1>All Workshops</h1>
        <div class="event-dates-container">
            <a href="#" class="year-link workshop" id="prevYear"><i class="fa-solid fa-angles-left"></i></a>
            <div style="text-align: center" class="workshop" id="currentYearMonth"></div>
            <a href="#" class="year-link workshop" id="nextYear"><i class="fa-solid fa-angles-right"></i></a>
        </div>
        <div class="events-month">
            <a href="#" class="month-link workshop" data-month="1">Jan</a>
            <a href="#" class="month-link workshop" data-month="2">Feb</a>
            <a href="#" class="month-link workshop" data-month="3">Mar</a>
            <a href="#" class="month-link workshop" data-month="4">April</a>
            <a href="#" class="month-link workshop" data-month="5">May</a>
            <a href="#" class="month-link workshop" data-month="6">June</a>
            <a href="#" class="month-link workshop" data-month="7">July</a>
            <a href="#" class="month-link workshop" data-month="8">Aug</a>
            <a href="#" class="month-link workshop" data-month="9">Sep</a>
            <a href="#" class="month-link workshop" data-month="10">Oct</a>
            <a href="#" class="month-link workshop" data-month="11">Nov</a>
            <a href="#" class="month-link workshop" data-month="12">Dec</a>
        </div>
        <div class="featured">
            <div class="events-container2">
                @if ($uploads->count() == 0)
                    <div style="position: absolute; left:50%; transform: translate(-50%)">No Workshop For this month</div>
                @else
                @foreach ($uploads as $upload)
                <div class="events">
                    <div class="event-image-container">
                        <img class="event-image" src="{{ asset("/images/$upload->featured_image") }}" alt="">
                    </div>
                    <div class="event-title">{{$upload->title}}</div>
                    @foreach ($results as $result)
                    @if ($result['uploadId'] == $upload->id)
                    <p class="event-date">{{ $result['date'] }}</p>
                    @endif
                    @endforeach
                    @if ($upload->upload_type == "virtual-program")                    
                    <div class="event-location">{{$upload->host_app}}</div>
                    @else 
                        <div class="event-location">{{$upload->state}} State, {{$upload->country}}</div>
                    @endif
                    
                    @if(isset($usInfos[$upload->user_id]))
                        <div class="company-logo-container">
                            <img class="event-image" src="{{ asset("/storage/users-avatar/{$usInfos[$upload->user_id]->avatar}") }}" alt="">
                        </div>
                    @endif
            
                    @if(isset($busInfos[$upload->user_id]))
                        <div class="company-name">{{$busInfos[$upload->user_id]->businessname}}</div>
                    @endif
            
                    <a class="event-details" href="{{url("/$upload->slug_url/$upload->upload_type/$upload->id")}}">View Details</a>
                </div>
            @endforeach 
                @endif
        </div>
        <div class="work_error"></div> 
        </div>
    </section>
@endsection