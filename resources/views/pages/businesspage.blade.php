@extends('master')
@section('content-pages')
<script src="https://cdn.tailwindcss.com"></script>
    <section class="business-page-section">
        <div class="business-page-logo">
            <img src="{{asset("storage/users-avatar/{$business->user->avatar}")}}" alt="">
            @if ($business->verification_badge == "true" && $business->subscription == 'enterprise listing')
            <div class="badge_container">
                <img src="{{asset('assets/images/gold-verified.png')}}" alt="">
            </div>
            @elseif ($business->verification_badge == "true" || $business->subscription == 'standard listing')
            <div class="badge_container">
                <img src="{{asset('assets/images/clue-verified.png')}}" alt="">
            </div>
            @endif
        </div>
        <div class="business-container">
            <h1 style="color: #0d0c22">{{$business->businessname}}</h1>
            <p style="font-weight: 500">{{$business->user->address}}</p>
            <p>{{ucfirst($business->business_type)}}</p>
        </div>
    </section>

    <section class="page-description">
        <p class="text-left">{!! $business->description !!}</p>
    </section>

    <section class="mt-3 px-5 flex flex-col w-full gap-2">
        <h2>Library</h2>
        <hr class="flex-1 border-[1px] border-[#65b741] bg-[#65B741]">
    </section>
    <div class="providers-grid">
        @foreach ($uploads as $upload)
        @if ($upload->upload_type !== "e-course")
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
                        @if ($usInfos[$upload->user_id]->business->verification_badge == true && $usInfos[$upload->user_id]->business->subscription == 'enterprise listing')
                            <div class="badge_container">
                                <img src="{{asset('assets/images/gold-verified.png')}}" alt="">
                            </div>
                        @elseif ($usInfos[$upload->user_id]->business->verification_badge == true || $usInfos[$upload->user_id]->business->subscription == 'standard listing')
                        <div class="badge_container">
                            <img src="{{asset('assets/images/clue-verified.png')}}" alt="">
                        </div>
                        @endif
                    </div>
                @endif
                
                @if(isset($busInfos[$upload->user_id]))
                    <div class="company-name">{{$busInfos[$upload->user_id]->businessname}}</div>
                @endif
                
                <a class="event-details" href="{{url("/$upload->slug_url/$upload->upload_type/$upload->id")}}">View Details</a>
            </div>
        @else
        @foreach ($uploads->where('upload_type', 'e-course') as $upload)
        <div class="events">
            <div class="event-image-container">
                <img class="event-image" src="{{ asset("/images/$upload->featured_image") }}" alt="">
            </div>
            <div class="event-title">{{$upload->title}}</div>
            <p class="event-date">{{ $upload->course_duration}} Hour(s)</p>
            @if ($upload->upload_type == "virtual-program")                    
                <div class="event-location">{{$upload->host_app}}</div>
            @else 
                <div class="event-location">{{$upload->state}} State, {{$upload->country}}</div>
            @endif

            @if(isset($usInfos[$upload->user_id]))
                <div class="company-logo-container">
                    <img class="event-image" src="{{ asset("/storage/users-avatar/{$usInfos[$upload->user_id]->avatar}") }}" alt="">
                    @if ($usInfos[$upload->user_id]->business->verification_badge == true && $usInfos[$upload->user_id]->business->subscription == 'enterprise listing')
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

            <a class="event-details" href="{{url("/$upload->slug_url/$upload->upload_type/$upload->id")}}">View Details</a>
        </div>
    @endforeach
        @endif
    @endforeach
    </div>


@endsection