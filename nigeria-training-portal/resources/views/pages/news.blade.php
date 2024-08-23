@extends('master')
@section('content-pages')
    <h1 class="news_top_header">Fresh News</h1>
    <p class="news_top_text">Stay informed with our bit-sized articles</p>
    <div class="news-full-section">
        <div class="ads_side_flex">
            @foreach ($rightnews as $rightnew)
            <a href="{{url('//'."$rightnew->ads_link")}}" class="featured-ad">
                <img src="{{asset("adsbanner/$rightnew->ads_banner")}}" alt="">
            </a>
            @endforeach
        </div>
        <div class="news_inner_grid">
            @foreach ($allnews as $newsItem)
                <a href="{{ url('newspage/' . $newsItem->news_url) }}" target="_blank" class="news-container-inner">
                    <div class="news_image">
                        <img src="{{ asset('newsimage/' . $newsItem->featured_image) }}" alt="{{ $newsItem->title }}">
                    </div>
                    <h1 class="news-title">{{ $newsItem->title }}</h1>
                    <div class="news-content font-light">
                        {!! $newsItem->news_content !!}
                    </div>
                </a>
            @endforeach
        </div>
        
        
        <div class="ads_side_flex">
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
        </div>
    </div>
@endsection