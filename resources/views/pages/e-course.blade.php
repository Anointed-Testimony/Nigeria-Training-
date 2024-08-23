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
<section class="events-section1">
    <h1>E-courses</h1>
    <div class="featured">
        <div class="events-container3">
            @foreach ($uploads as $upload)
            <div class="events1">
                <div style="z-index: 1" class="event-image-container2">
                    <img class="event-image1" src="{{asset("/images/$upload->featured_image")}}" alt="">
                </div>
                <div class="e_course-container">
                    <div style="color:#333" class="event-title">{{$upload->title}}</div>
                    <div class="e-course_desc" style="text-align: left" class="event-location">{!! $upload->description !!}</div>
                    <div class="event-date">Course Price: <span class="wallet-balance">{{$upload->price}}</span></div>
                    <div class="event-date">Course Duration: {{$upload->course_duration}} Hour(s)</div>
                    <div class="e_course-company">
                        @if(isset($usInfos[$upload->user_id]))
                        <div class="company-logo-container">
                            <img class="company-logo" src="{{ asset("storage/users-avatar/{$usInfos[$upload->user_id]->avatar}") }}" alt="">
                            @if ($usInfos[$upload->user_id]->business->verification_badge == "true" && $usInfos[$upload->user_id]->business->subscription == 'enterprise listing')
                                <div class="badge_container">
                                    <img src="{{asset('assets/images/gold-verified.png')}}" alt="">
                                </div>
                            @elseif ($usInfos[$upload->user_id]->business->verification_badge == "true" || $usInfos[$upload->user_id]->business->subscription == 'standard listing')
                            <div class="badge_container">
                                <img src="{{asset('assets/images/clue-verified.png')}}" alt="">
                            </div>
                            @endif
                        </div>
                        @endif
                
                        @if(isset($busInfos[$upload->user_id]))
                            <div class="company-name">{{$busInfos[$upload->user_id]->businessname}}</div>
                    @endif
                    </div>
                    @if (Auth::check() && Auth::user()->paidCourses()->where('course_id', $upload->id)->exists())                        
                        <a style="margin-left: -10px" class="event-details" href="{{ url("/e_course_page/$upload->slug_url") }}">Go To Course</a>
                    @elseif (Auth::check())
                        <a style="margin-left: -10px" class="event-details" href="{{ url("/$upload->slug_url/$upload->upload_type/$upload->id") }}">Enroll Now</a>
                    @else
                        <a style="margin-left: -10px" class="event-details" href="{{ route('login') }}">Enroll Now</a>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection