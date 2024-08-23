@extends('master')
@section('content-pages')

    <section class="course_full_section">
        <div class="course_modules">
            <p class="course_name_intro">Course</p>
            <p class="course_name">{{$course->title}}</p>
            <div class="course_sections_container">
                @foreach ($course->sections as $eachcourse)
                <div class="course_sections_box">
                    <div class="course_sections_first">
                        <p>{{$eachcourse->section_title}}</p>
                        <i onclick="dropdownVideos(this)" class="fa-solid fa-chevron-down"></i>
                    </div>
                    <div class="course_section_videos">
                        @foreach ($eachcourse->videos as $videos)
                        <div class="course_single_video">
                            <div class="course_single_video_title_no">
                                <p class="course_single_video_no"></p>
                                <p onclick="changeVideo(this)" name="{{$videos->video_link}}" class="course_single_video_title video_link">{{$videos->video_name}}</->
                            </div>
                            <p class="duration">{{$videos->duration}} mins</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="course_display_section">
            <div class="course_display_videos">
                <p></p>
                <div class="video_container">
                    <video id="myVideo" controls controlsList="nodownload">
                        <source id="mySource" src="{{$course->sections[0]->videos[0]->video_link}}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                </div>
            </div>
        </div>
    </section>


    <script>
        var video = document.getElementById('myVideo');
        video.addEventListener('contextmenu', function(e) {
            if (video.controlsList.value !== "nodownload") {
            video.controlsList.value = "nodownload";
            }
            e.preventDefault();
        });
    </script>

@endsection