@extends('master')
@section('content-pages')
    <section class="ad-section">
        @foreach ($inpages as $inpage)
        <a href="{{url("//$inpage->ads_link")}}" target="_blank" class="rotate-ad">
            <img src="{{asset("adsBanner/$inpage->ads_banner")}}" alt="">
        </a>
        @endforeach
    </section>
    <section class="events-section">
        <h1>Events in Africa</h1>
        <div class="event-dates-container">
            <a href="#"><i class="fa-solid fa-angles-left"></i>2023 Events</a>
            <div style="text-align: center">2024 Events - showing event(s) for January 2024</div>
            <a href="#">2025 Events<i class="fa-solid fa-angles-right"></i></a>
        </div>
        <div class="events-month">
            <a href="#">Jan</a>
            <a href="#">Feb</a>
            <a href="#">Mar</a>
            <a href="#">April</a>
            <a href="#">May</a>
            <a href="#">June</a>
            <a href="#">July</a>
            <a href="#">Aug</a>
            <a href="#">Sep</a>
            <a href="#">Oct</a>
            <a href="#">Nov</a>
            <a href="#">Dec</a>
        </div>
        <div class="featured">
            <div class="events-container2">
                @if ($africa->count() == 0)
                    <div style="position: absolute; left:50%; translateX(-50%)">No Events</div>
                @else
                @foreach ($africa as $upload)
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
                    
                    <div class="company-logo-container">
                        <img class="event-image" src="{{ asset("/storage/users-avatar/{$upload->users->avatar}") }}" alt="">
                    </div>

                    <div class="company-name">{{$upload->user->businessname}}</div>
            
                    <a class="event-details" href="{{url("/$upload->slug_url/$upload->upload_type/$upload->id")}}">View Details</a>
                </div>
            @endforeach 
                @endif
            </div>
        </div>
    </section>
@endsection