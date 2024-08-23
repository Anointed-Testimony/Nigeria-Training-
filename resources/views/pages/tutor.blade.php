@extends('master')
@section('content-pages')
    @if (Auth::check() && Auth::user()->user_type === 'user')
        <div class="tutor-link-register-container">
            <a class="tutor-register-link" href="{{ url('/tutor-register') }}">Become a Tutor</a>
        </div>
    @endif
    <section class="tutor-hero-section">
        <h1 class="tutor-header">Find the <br> perfect tutor</h1>
        <form action="">
            <div class="tutor-search-form-container">
                <input type="text">
                <button>Search</button>
            </div>
        </form>
        <div class="tutor-categories-container">
            <div class="tutor-single-category">
                <i class="fa-solid fa-building-columns"></i>
                <p>Accounting & Finanace</p>
            </div>
            <div class="tutor-single-category">
                <i class="fa-solid fa-palette"></i>
                <p>Art & Craft</p>
            </div>
            <div class="tutor-single-category">
                <i class="fa-solid fa-lightbulb"></i>
                <p>Energy & Power</p>
            </div>
            <div class="tutor-single-category">
                <i class="fa-solid fa-user-graduate"></i>
                <p>Executive Education</p>
            </div>
            <div class="tutor-single-category">
                <i class="fa-solid fa-book-open-reader"></i>
                <p>Leadership</p>
            </div>
        </div>
    </section>
    <section class="tutor-display-full-section">
        <section class="tutor-container">
            @foreach ($tutors as $tutor)
            <a href="{{ url("/tutorpage/{$tutor->tutor->id}/" . strtolower($tutor->firstname)) }}" class="tutor-box" style="background-image: url('{{ asset("storage/users-avatar/{$tutor->avatar}") }}')">
                <div class="tutor-name-container">
                    <p class="tutor-name">{{$tutor->firstname}}</p>
                    <p class="tutor-category">{{$tutor->tutor->categories->name}}</p>
                </div>
            </a>
            @endforeach

        </section>
        <section class="tutor-cta-box" style="background-image: url('https://c.superprof.com/style/images/home/v4/become-teacher.webp')">
            <div class="tutor-cta-inner-box">
                <h1 class="tutor-cta-inner-box-heading">You can become a great tutor too!</h1>
                <p style="margin-top: 15px; color:white">Share your knowledge, live off your passion and become your own boss</p>
                <a class="tutor-cta-button" href="{{url('/faq')}}">Find Out More</a>
            </div>
        </section>
        <section class="tutor-categories-section">
            <h1 class="tutor-category-heading">Learn whatever you want</h1>
            <section class="tutor-container">
                <div class="tutor-category-box" style="background-image: url('https://www.investopedia.com/thmb/2RLRrnmeDEoU3BECEWQ46o8kU9k=/1000x667/filters:no_upscale():max_bytes(150000):strip_icc()/cryptocurrency-f6026a2012a14aaa9ef8a1c277fde0f7.jpg')">
                    <div class="tutor-category-box-bottom">
                        CryptoCurrency
                    </div>
                </div>
                <div class="tutor-category-box" style="background-image: url('https://media.istockphoto.com/id/1371081916/photo/content-wording-on-wooden-cubes-with-speech-bubbles.jpg?b=1&s=612x612&w=0&k=20&c=T-o7cdrw0oZ62_rUKEht92EVIemV1CElnvEnwHiMGNM=')">
                    <div class="tutor-category-box-bottom">
                        Content Creation
                    </div>
                </div>
                <div class="tutor-category-box" style="background-image: url('https://i.pinimg.com/originals/00/8c/75/008c75173308d7ae83aadb3d011303f1.jpg')">
                    <div class="tutor-category-box-bottom">
                        Guitar Playing
                    </div>
                </div>
                <div class="tutor-category-box" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/2/20/Economics.jpg')">
                    <div class="tutor-category-box-bottom">
                        Economics
                    </div>
                </div>
            </section>
        </section>
    </section>
@endsection