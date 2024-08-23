
<section id="topsection">
    {{-- <header>
        <ul class="header-list">
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ url('/signup') }}">Sign-Up</a></li>
                @if (Auth::check() && Auth::user()->user_type === 'business' && Auth::user()->business->subscription == 'basic listing')
                <li><a href="#">Go Premium</a></li>
                 @endif
                @if (Auth::check() && Auth::user()->user_type === 'user')
                <li><a href="{{ url('/business-register') }}">Add/Upload</a></li>
                 @endif
            @else
                @if(Auth::user()->email_verified_at)
                    <p>Welcome, {{ Auth::user()->firstname }}</p>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @endif
                <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
            @endguest
        </ul>
    </header> --}}
    <nav class="navbar">
        <div class="nav-logo-container">
            <a href="{{route('home')}}"><img class="nav-logo" src="{{asset('assets/images/ntp-logo.png')}}" alt=""></a>
        </div>
        <a class="nav-links" href="{{route('events')}}">All Events</a>
        <a class="nav-links" href="{{route('workshops')}}">Workshop</a>
        <a class="nav-links" href="{{route('virtual_program')}}">Virtual Program</a>
        <a class="nav-links" href="{{route('e_course')}}">E-course</a>
        <a class="nav-links" href="{{route('tutor')}}">Tutors</a>
        <a class="nav-links" href="{{route('businesses')}}">Businesses</a>
        <a class="nav-links" href="{{route('coming.soon')}}">Resources</a>
        <a class="nav-links" href="{{route('coming.soon')}}">Media</a>

        <ul class="header-list ms-7">
            @guest
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ url('/signup') }}">Sign-Up</a></li>
                @if (Auth::check() && Auth::user()->user_type === 'business' && Auth::user()->business->subscription == 'basic listing')
                <li><a href="#">Go Premium</a></li>
                 @endif
                @if (Auth::check() && Auth::user()->user_type === 'user')
                <li><a href="{{ url('/business-register') }}">Add/Upload</a></li>
                 @endif
            @else
                @if(Auth::user()->email_verified_at)
                    <p>Welcome, {{ Auth::user()->firstname }}</p>
                    <li><a href="{{ route('logout') }}">Logout</a></li>
                @endif
                <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
            @endguest
        </ul>
        <i id="dropdown" class="menu fa-solid fa-bars"></i>
    </nav>
    <div id="dropdown-menu">
        <div><a class="dropdown-links" href="{{route('events')}}">All Events</a></div>
        <div><a class="dropdown-links" href="{{route('workshops')}}">Workshop</a></div>
        <div><a class="dropdown-links" href="{{route('virtual_program')}}">Virtual Program</a></div>
        <div><a class="dropdown-links" href="{{route('e_course')}}">E-course</a></div>
        {{-- <div><a class="dropdown-links" href="">Training Providers</a></div> --}}
        <div><a class="dropdown-links" href="{{route('businesses')}}">Businesses</a></div>
        <div><a class="dropdown-links" href="{{route('coming.soon')}}">Resources</a></div>
        <div><a class="dropdown-links" href="{{route('coming.soon')}}">Event Center</a></div>
        <div><a class="dropdown-links" href="{{route('coming.soon')}}">Equipment</a></div>
        <div><a class="dropdown-links" href="{{route('coming.soon')}}">Jobs</a></div>
        <div><a class="dropdown-links" href="{{route('coming.soon')}}">Media</a></div>
    </div>
</section>

<form id="serachForm" class="search-form" action="">
    <input id="searchInput" type="search" name="search-input" class="search-input" placeholder="What are you looking for? type, location, events, training">
    <div style="z-index: 1000" id="searchResultContainer">
        <div class="search_top">
            <div class="search_top_tabs">
                <p id="trainText" class="search_back">Training Providers()</p>
                <p id="evenText">Events()</p>
                <p id="workText">Workshops()</p>
            </div>
            <hr class="search_divider">
        </div>
        <div id="searchBoxResults" class="search_results_container">
        </div>
        <div id="eventsBoxResults" class="search_results_container">
        </div>
        <div id="workBoxResults" class="search_results_container">
        </div>
    </div>
    <button class="search-button">Search</button>
</form>
