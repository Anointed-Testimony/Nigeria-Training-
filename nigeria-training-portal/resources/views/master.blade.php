<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/query.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cert.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/ntp-logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <script src="https://cdn.tiny.cloud/1/mkyaup5rx10x4g0h9h3iqvea4fx46wl690xfxnfu1c1ssrev/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: '#rte-editor',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
        });
    </script>
    <script>
        tinymce.init({
            selector: '#rte-editor-two',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            toolbar_mode: 'floating',
        });
    </script>
    <title>Nigeria Training Portal</title>
    <style>
        body {
            overflow: hidden;
        }
    </style>
    @notifyCss
</head>
<body>
    <x-notify::notify />
    <div id="preloader">
        <iframe src="https://lottie.host/embed/44eb6c2c-dbee-4342-8aec-adb9bdce6a76/KRInAaW9ER.json"></iframe>
    </div>
    @include('layouts.header')
    @yield('content-pages')
    @include('layouts.footer')

    <script>
        // JavaScript to hide the preloader when the content is fully loaded
        window.addEventListener('load', function(){
            var preloader = document.getElementById('preloader');
            setTimeout(function() {
                preloader.style.display = 'none';
                document.body.style.overflow = 'auto';
            }, 3000);
        });
    </script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        var owl = $('.owl-carousel');
        owl.owlCarousel({
            items:1,
            loop:false,
            margin:10,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            responsive:{
            0:{
                items:1
            },
            900:{
                items:2
            },
            1300:{
                items:3
            }
        }
        });
    </script>
    <script>
        $('#hero-img-container').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: true
        })
    </script>
    <script>
        $('.ad-section').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: true,
            prevArrow: false,
            nextArrow: false
        })
    </script>
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
                    // var avatarBaseUrl = "{{ asset('storage/users-avatar/') }}";
                    // var resultItem = '<div class="search_results">' +
                    //                     '<div class="search_results_image_container">' +
                    //                         '<img src="' + avatarBaseUrl + '/' + item.avatar + '" alt="">' +
                    //                     '</div>' +
                    //                     '<p class="search_results_text">' + item.businessname + '</p>' +
                    //                 '</div>';
                    // resultList.append(resultItem);
                    var avatarBaseUrl = "{{ asset('storage/users-avatar/') }}";
                    var resultItem = '<div class="search_results">' +
                                        '<div class="search_results_image_container">' +
                                            '<img src="' + avatarBaseUrl + '/' + item.avatar + '" alt="">';

                    if (item.verification_badge == "true" && item.subscription == 'enterprise listing')
                        resultItem += '<div class="badge_container">' +
                                        '<img src="{{asset('assets/images/gold-verified.png')}}" alt="">' +
                                    '</div>';
                    else if (item.verification_badge == "true" && item.subscription == 'standard listing')
                        resultItem += '<div class="badge_container">' +
                                        '<img src="{{asset('assets/images/clue-verified.png')}}" alt="">' +
                                    '</div>';

                    resultItem += '</div>' +
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#error').fadeIn();
            var timeout = 5000;
            var interval = 50;
            var numIntervals = timeout / interval;
            var progressStep = 100 / numIntervals;
            var progress = 0;
            var progressBar = $('#progress-bar');
            var progressInterval = setInterval(function () {
                progress += progressStep;
                progressBar.width(progress + '%');

                if (progress >= 100) {
                    // Hide the popup when the progress reaches 100%
                    $('#error').fadeOut();
                    clearInterval(progressInterval);
                }
            }, interval);
        });
    </script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
    $(document).ready( function () {
    $('#withdrawTable').DataTable();
} );
</script>
<script>
    $(document).ready( function () {
    $('#otherTable').DataTable();
} );
</script>

    @notifyJs
</body>
</html>