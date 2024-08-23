@extends('master')
@section('content-pages')
<main>
    <div class="w-full grid grid-cols-5 h-full px-5 gap-10">
        <div class="col-span-3 flex flex-col gap-7">
            <div class="w-inherit h-[500px] overflow-hidden">
                <img class="object-cover w-[100%] h-[100%]" src="/newsimage/{{$news->featured_image}}" alt="Article Image">
            </div>
            <div class="font-bold text-2xl">
                {{$news->title}}
            </div>
            <div>
                {!! $news->news_content !!}
            </div>
        </div>
        <div class="col-span-2 w-full">
            <div class="bg-[#e6e6e6] p-2 w-full rounded-md">Related News</div>
            @foreach ($randomNews as $news)
                <div class="news-container mt-3">
                    <div class="news-image">
                        <img src="{{asset("newsimage/{$news->featured_image}")}}" alt="">
                    </div>
                    <a class="newspage-link" href="{{url("newspage/{$news->news_url}")}}">{{$news->title}}</a>
                </div>
            @endforeach
        </div>
    </div>
</main>
@endsection