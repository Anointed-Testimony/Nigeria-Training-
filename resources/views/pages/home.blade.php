@extends('master')
@section('content-pages')
<section class="hero-section">
    <div class="hero-section-links-container">
        <div class="hero-links-container"><i class="fa-regular fa-calendar"></i><a href="{{route('events')}}">All Events</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-briefcase"></i><a href="#">Corporate Program</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-computer"></i><a href="#">ICT Program</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-screwdriver-wrench"></i><a href="#">Vocational Program</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-helmet-safety"></i><a href="#">Bootcamp & Summit</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-globe"></i><a href="{{route('virtual_program')}}">Virtual Program</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-door-open"></i><a href="{{route('free.events')}}">Free & Open Events</a></div>
        <div class="hero-links-container"><i class="fa-regular fa-flag"></i><a href="{{route('nigeria.events')}}">Events in Nigeria</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-earth-africa"></i><a href="{{route('africa.events')}}">Events in Africa</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-earth-asia"></i><a href="{{route('asia.events')}}">Events in Asia</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-earth-europe"></i><a href="{{route('europe.events')}}">Events in Europe</a></div>
        <div class="hero-links-container"><i class="fa-solid fa-earth-americas"></i><a href="{{route('north.events')}}">Events in North America</a></div>
    </div>
    <div id="hero-img-container" class="hero-image-container">
        @foreach ($defaultImages->where('banner_name', 'Home Top Banner') as $hometopbanner)
        @php
            $imageLink = $hometopbanner->image_link;
            if (!preg_match("~^(?:f|ht)tps?://~i", $imageLink)) {
                $imageLink = "http://{$imageLink}";
            }
        @endphp
            <a class="hero-image-container-link" href="{{ $imageLink }}" target="_blank">
                <img id="hero-img" src="{{ asset("defaultimages/{$hometopbanner->image_location}") }}" alt="">
            </a>
        @endforeach

    </div>
</section>
<section id="promoted_banner" class="ad-section">
    @foreach ($defaultImages->where('banner_name', 'Home Promoted Banner') as $hometopbanner)
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
</section>
<section class="featured-section">
    <div class="featured-events">
        <div class="featured">
            <h1>Featured Contents</h1>
            <div class="events-container">
                {{-- @foreach ($uploads as $upload)
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
            @endforeach             --}}
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
                            <div class="event-location">{{$upload->address}}, {{$upload->country}}</div>
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
                @endif
            @endforeach

            </div>
        </div>
        <div id="swiper" class="swiper">
            <h1>Featured E-courses</h1>
            <div id="swipe" class="owl-carousel events-container">
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
            </div>
        </div>
    </div>
    
    <div style="margin-top:50px" class="featured-ads">
        <form class="certificate_verify_form" id="certsearchForm">
            <input type="search" name="certificateId" id="certificateId" placeholder="Verify Certificate">
            <button>Verify</button>
        </form>
        <div class="featured-ad-section">
            @foreach ($defaultImages->where('banner_name', 'Home Side Banner')->shuffle()->take(1) as $hometopbanner)
            @php
            $imageLink = $hometopbanner->image_link;
            if (!preg_match("~^(?:f|ht)tps?://~i", $imageLink)) {
                $imageLink = "http://{$imageLink}";
            }
            @endphp
            <a href="{{$imageLink}}" target="_blank" class="featured-ad">
                <img src="{{ asset("defaultimages/{$hometopbanner->image_location}") }}" alt="">
            </a>
            @endforeach
        </div>
        <div class="training-provider">
            <div class="training-provider-header">Featured Tutors</div>
            {{-- <div class="training-provider-container">
                <div class="tutor-box" style="background-image: url('https://c.superprof.com/i/m/14518642/600/20240416130913/14518642.webp')">
                    <div class="tutor-name-container">
                        <p class="tutor-name">Sammad</p>
                        <p class="tutor-category">App Developer</p>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="training-provider">
            <div class="training-provider-header">Featured Business</div>
            @foreach ($featuredBusiness as $featuredBusinesses)
            <a href="{{url("page/{$featuredBusinesses->business_slug}")}}" class="training-provider-container">
                <div class="training-provider-logo">
                    <img src="{{asset("storage/users-avatar/{$featuredBusinesses->user->avatar}")}}" alt="">
                </div>
                <div class="training-provider-name">{{$featuredBusinesses->businessname}}</div>
            </a>
            @endforeach
        </div>
        <div class="training-provider">
            <div class="training-provider-header">Featured Resources</div>
        </div>
        <div class="training-provider">
            <div class="training-provider-header">News/Updates</div>
            @foreach ($randomNews as $news)
                <div class="news-container">
                    <div class="news-image">
                        <img src="{{asset("newsimage/{$news->featured_image}")}}" alt="">
                    </div>
                    <a class="news-link" href="{{url("newspage/{$news->news_url}")}}">{{$news->title}}</a>
                </div>
            @endforeach
        </div>
        <div class="training-provider">
            <div class="training-provider-header">Featured Venue</div>
        </div>
        <div class="training-provider">
            <div class="training-provider-header">Featured Vacancy</div>
        </div>
        <div class="training-provider">
            <div class="training-provider-header">Search Events by Tags</div>
        </div>
    </div>
</section>
<div id="certificateModal" style="display: none;">
    {{-- <div class="container">
        <img class="frame" src="{{ asset('images/cert.frame.jpg') }}" alt="certification" border="0">  
        <div class="centered">
            <span style="font-weight:bold">Certificate of Completion</span></br></br>
            <span><i>This is to certify that</i></span>
            </br></br>
            <span style="font-weight:bold">{{ ucfirst($particip['participant_name']) }}</span></br></br>
            <span><i>has completed the course</i></span></br></br>
            <span style="font-weight:bold; width:500px; display:inline-block">{{ $particip->host->title }}</span>
            <div class="cert_ref_id">
                <h6>Certificate Id</h6>
                <p >{{ $particip->certificate_reference_id }}</p>
            </div>
        </div>
    </div> --}}
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
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
$(document).ready(function() {
    $('#certsearchForm').submit(function(e) {
        e.preventDefault();
        var certificateId = $('#certificateId').val();
        
        $.ajax({
            url: '/search-certificate',
            method: 'GET',
            data: { certificateId: certificateId },
            success: function(response) {
                if (response.success) {
                    var certificate = response.certificate;
                    var modalContent = `
                        <div id="cert-show" class="container">
                            <img class="frame" src="{{ asset('images/cert.frame.jpg') }}" alt="certification" border="0">  
                            <div class="centered">
                                <span style="font-weight:bold">Certificate of Completion</span></br></br>
                                <span><i>This is to certify that</i></span>
                                </br></br>
                                <span style="font-weight:bold">${certificate.participant_name}</span></br></br>
                                <span><i>has completed the course</i></span></br></br>
                                <span style="font-weight:bold; width:500px; display:inline-block">${certificate.host.title}</span>
                                <div class="cert_ref_id">
                                    <h6>Certificate Id</h6>
                                    <p>${certificate.certificate_reference_id}</p>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#certificateModal').html(modalContent).show();
                    
                    // Add event listener for clicking outside the modal
                    const certFormShow = document.getElementById('cert-show');
                    const certForm = document.getElementById('certsearchForm');
                    window.addEventListener('click', function(event) {
                        if (!certFormShow.contains(event.target) && !certForm.contains(event.target)) {
                            document.getElementById('certificateModal').style.display = "none";
                        }
                    });
                } else {
                    window.location.reload();
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});



</script>
@endsection