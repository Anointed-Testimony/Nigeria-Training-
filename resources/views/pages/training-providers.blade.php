@extends('master')
@section('content-pages')
<section class="ad-section">
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
</section>
    @if (Auth::check() && Auth::user()->user_type === 'user')
        <div class="tutor-link-register-container">
            <a class="tutor-register-link" href="{{ url('/business-register') }}">Become a Business</a>
        </div>
    @endif
    <div class="providers-section">
        <h1>Business</h1>
        <div class="providers-select">
            <div class="events-month">
                <a style="background-color: #65B741" href="#" id="premium-tab">Premium</a>
                <a href="#" id="all-tab">All Businesses</a>
            </div>
        </div>
        <div class="providers-grid">
            @foreach ($allProviders as $allProvider)
            <div class="providers @if ($allProvider->subscription == "standard listing" || $allProvider->subscription == "enterprise listing") premium @endif" style="display: none;">
                <div class="providers-image">
                    <img src="{{asset("storage/users-avatar/{$allProvider->user->avatar}")}}" alt="">
                    @if ($allProvider->verification_badge == "true" && $allProvider->subscription == 'enterprise listing')
                    <div class="badge_container">
                        <img src="{{asset('assets/images/gold-verified.png')}}" alt="">
                    </div>
                    @elseif ($allProvider->verification_badge == "true" || $allProvider->subscription == 'standard listing')
                    <div class="badge_container">
                        <img src="{{asset('assets/images/clue-verified.png')}}" alt="">
                    </div>
                    @endif
                </div>
                <div class="providers-title">
                    {{$allProvider->businessname}}
                </div>
                <div class="providers-description">
                    {{$allProvider->description}}
                </div>
                <h4>Contact:</h4>
                <div class="providers-contact">
                    {{$allProvider->user->address}}
                </div>
                <a class="event-details" href="{{url("page/{$allProvider->business_slug}")}}">View Provider</a>
            </div>
            @endforeach
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const premiumTab = document.getElementById('premium-tab');
            const allTab = document.getElementById('all-tab');
            const premiumProviders = document.querySelectorAll('.providers.premium');
            const allProviders = document.querySelectorAll('.providers');

            premiumProviders.forEach(function(provider) {
                    provider.style.display = 'flex';
            });
    
            premiumTab.addEventListener('click', function(event) {
                event.preventDefault();
                allProviders.forEach(function(provider) {
                    if (provider.classList.contains('premium')) {
                        provider.style.display = 'flex';
                    } else {
                        provider.style.display = 'none';
                    }
                });
                premiumTab.style.backgroundColor = "#65B741"
                allTab.style.backgroundColor = "#999"
            });
    
            allTab.addEventListener('click', function(event) {
                event.preventDefault();
                allProviders.forEach(function(provider) {
                    provider.style.display = 'flex';
                });
                premiumTab.style.backgroundColor = "#999"
                allTab.style.backgroundColor = "#65B741"
            });
        });
    </script>
@endsection