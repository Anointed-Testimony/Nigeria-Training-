@extends('master')
@section('content-pages')
<script src="https://cdn.tailwindcss.com"></script>
    @if(Session::has('free-registration'))
    <div style="z-index: 9999" class="alert alert-danger">
        <div class="popup" id="error">
            <div class="popup-content">
                <div class="title">
                    <h3 style="color: #3d8a60">Congrats <i style="color: white; background-color:#3d8a60; border-radius:50%; padding:5px" class="fa-solid fa-check"></i></h3>
                </div>
                <p class="para">{{ Session::get('free-registration') }}</p>
                <div class="progress-container">
                    <div id="progress-bar"></div>
                </div>
            </div>

        </div>
    </div>
    @endif
    <section class="page_container">
        <div class="featured_container-box">
@foreach ($post as $posts)
            <div class="featured_container">
                <div class="page_featured-image-container">
                    <img src="{{ asset("/images/$posts->featured_image") }}" alt="">
                </div>
                <div class="page_buttons">
                    <a id="page_scroll-register" href="{{ url('chat/' . $posts->user_id) }}">Chat with us</a>
                    @if($posts->material)
                    <a id="page_button-download" href="{{ route('download', ['filename' => $posts->material]) }}">Download Material</a>
                    @else
                        <p>No material available</p>
                    @endif
                    @auth
                    <a id="page_button-register" onclick="register()" href="javascript:void(0)">Register Now</a>
                    @else
                    <a id="page_button-register" href="javascript:void(0)" onclick="loginFirst()">Register Now</a>
                    @endauth
                </div>
                <div style="text-align: center" class="featured_subtext"><i class="fa-solid fa-circle-info"></i> Satisfaction Guaranteed</div>
                <div class="featured_text">
                    <h3 style="font-weight: bold">Includes</h3>
                    <div style="margin-top: 10px" class="featured_subtext">
                        <i class="fa-solid fa-headset"></i>
                        <p>Customer Support</p>
                    </div>
                    {{-- <div class="featured_subtext">
                        <i class="fa-solid fa-laptop"></i>
                        <p>Access on Mobile and TV</p>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="page_heading--container">
            @if($post)
                <h1>{{$posts->title}}</h1>               
        @else
            <p>No post found.</p>
        @endif
            @if ($posts->upload_type == 'e-course')
            <p>Course Duration: {{ $posts->course_duration }} Hour(s)</p>
            @else
            @foreach ($results as $result)
            @if ($result['uploadId'] == $posts->id)
            <p>Date: {{ $result['date'] }}</p>
            @endif
            @endforeach
            @endif
                @if ($posts->price == '0') 
                    <p>Workshop fee: Free</p>
                    @else
                    <div style="display: flex; align-items:center; gap:5px"><p>Workshop Fee:</p><p id="upload_price" class="wallet-balance">{{$posts->price}}</p></div>
                @endif
            @if ($posts->upload_type == 'virtual-program')
                <p>Location: {{$posts->host_app}}</p>
            @elseif ($posts->upload_type == 'workshop')                
                <p>Location: {{$posts->address}}, {{$posts->country}}</p>
            @elseif ($posts->upload_type == 'events')                
                <p>Location: {{$posts->address}}, {{$posts->country}}</p>
            @elseif ($posts->upload_type == 'e-course')                
                <p>E-Course</p>
            @endif
            @foreach ($busInfos as $busInfo)
            <p>Website: <a class="text-[#65B741] font-bold  hover:underline" target="_blank" href="{{ $busInfo->website }}" class="business-website">{{ $busInfo->website }}</a></p>
        @endforeach
            <div class="heading_course--info">
                @if(isset($usInfos[$posts->user_id]))
                <div class="heading_course--image">
                    <img src="{{ asset("/storage/users-avatar/{$usInfos[$posts->user_id]->avatar}") }}" alt="">
                    @if ($usInfos[$posts->user_id]->business->verification_badge == true && $usInfos[$posts->user_id]->business->subscription == 'enterprise listing')
                    <div class="badge_container">
                        <img src="{{asset('assets/images/gold-verified.png')}}" alt="">
                    </div>
                    @elseif ($usInfos[$posts->user_id]->business->verification_badge == "true" || $usInfos[$posts->user_id]->business->subscription == 'standard listing')
                    <div class="badge_container">
                        <img src="{{asset('assets/images/clue-verified.png')}}" alt="">
                    </div>
                    @endif
                </div>
                @endif
                @if(isset($busInfos[$posts->user_id]))
                <p>{{$busInfos[$posts->user_id]->businessname}}</p>
                @endif
            </div>
        </div>
        <div class="page_information">   
            <div class="page_buttons page_buttons_display">
                <a id="page_scroll-register" href="{{ url('http://127.0.0.1:8000/chat/' . $posts->user_id) }}">Chat with us</a>
                @if($posts->material)
                <a id="page_button-download" href="{{ route('download', ['filename' => $posts->material]) }}">Download Material</a>
                @else
                    <p>No material available</p>
                @endif
                @auth
                <a id="page_button-register" onclick="register()" href="javascript:void(0)">Register Now</a>
                @else
                <a id="page_button-register" href="javascript:void(0)" onclick="loginFirst()">Register Now</a>
                @endauth
            </div>
            <h1 class="font-bold underline">Course Description:</h1>         
            <p>
                {!! $posts->description !!}
            </p>
            <div class="page_buttons">
                <a id="page_scroll-register" href="{{ url('chat/' . $posts->user_id) }}">Chat with us</a>
                @if($posts->material)
                <a id="page_button-download" href="{{ route('download', ['filename' => $posts->material]) }}">Download Material</a>
                @else
                    <p>No material available</p>
                @endif
                @auth
                <a id="page_button-register" onclick="register()" href="javascript:void(0)">Register Now</a>
                @else
                <a id="page_button-register" href="javascript:void(0)" onclick="loginFirst()">Register Now</a>
                @endauth
            </div>
        </div>
    </section>  
    <div id="register_info-modal">
    @auth
        <form action="{{route('withdraw')}}" method="POST" class="">
            @csrf
            <div id="withdraw_modal_content" class="withdraw_modal_content">
                <div class="withdraw-head">
                    <p class="withdraw-head-text">Register for this {{ucfirst($posts->upload_type)}}</p>
                    <i id="with_modalClose" class="fa-solid fa-xmark"></i>
                </div>
                <hr class="withdraw-first-divider">
                <p style="display: none" class="withdraw-caution">Withdrawals are final. Confirm your details and available balance before initiating. Proceed with caution.!</p>
                <div class="withdraw-input">
                    <label for="">Name</label>
                    <input value="{{Auth::user()->name}}" name="amount" type="text" placeholder="Enter Your Name">
                </div>
                <div class="withdraw-input">
                    <label for="">Email</label>
                    <input id="regemail" value="{{Auth::user()->email}}" name="amount" type="text" placeholder="Enter Your Email">
                </div>
                <div class="withdraw-input">
                    <label for="">Phone Number</label>
                    <input value="{{Auth::user()->telephone}}" name="amount" type="text" placeholder="Enter Your Phone Number">
                </div>
                <div class="withdraw-input">
                    <label for="">No. of Participants</label>
                    <input id="regparticipants" value="1" name="amount" type="number" placeholder="Enter No. of Participants">
                </div>
                <div class="withdraw-input">
                    <label for="">Password Confirmation</label>
                    <input name="pay_password" id="pay_password" type="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                </div>
                @if ($posts->price == '0')
                    <div class="withdraw-input">
                        <a style="text-decoration: none; font-size:13px" href="{{url('/free_registation')}}" class="withdraw_request_button">Complete Registration</a>
                    </div>
                @else
                    <button onclick="showPaymentSelect()" type="button" class="withdraw_request_button">Proceed</button>
                @endif
            </div>

            <div id="select_paymemt-modal">
                <div class="select_payment-container">
                    <p style="color: #699a5d; font-size:18px; font-weight:600;display:flex;justify-content:space-between; align-items:center">Choose Payment Option <i onclick="closeSelect()" class="fa-solid fa-xmark"></i></p>
                    <hr style="border:1px solid #ccc; margin-top:15px">
                    <p style="background-color: #eee; color:#699a5d;padding:10px;font-size:12px;margin-top:20px;border-radius:5px;">Subscription to this course. Note the subtotal for this course is ₦{{$posts->price}}. Proceed with caution!</p>
                    <div style="margin-top: 20px; display:flex;flex-direction:column; justify-content:space-around; height:150px">
                        <button onclick="payCourseWithWallet('{{ Auth::user()->id }}')" type="button" style="color:#999; display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-wallet"></i>Pay from Wallet</button>
                        <button type="button" onclick="paystackFunc(document.getElementById('regemail').value , document.getElementById('regparticipants').value).value" style="color:#999;display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-building-columns"></i>Pay from Bank</button>               
                        @if ($posts->upload_type == 'events' || $posts->upload_type == 'workshop')
                        <button type="button" style="color:#999;display:flex; gap:20px; justify-content:center;padding:10px 15px;background-color:transparent; border: 1px solid #eee; border-radius:5px;"><i style="color: #699a5d" class="fa-solid fa-street-view"></i>Pay At Venue</button>  
                        @endif
                    </div>
                </div>
            </div>
        </form>
    @endauth
    </div>
@endforeach
    <script src="https://js.paystack.co/v2/inline.js"></script>
    <script src="{{asset('assets/js/scroll.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        function paystackFunc(userEmail, part) {
            const payPassword = document.getElementById('pay_password').value;
            $.ajax({
                type: "POST",
                url: "{{ route('check-password') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    password: payPassword
                },
                success: function(response){
                    if (response.status == 'success') {
                        const realamount = document.getElementById('upload_price').textContent;
                        const numericPrice = realamount.replace(/₦|,/g, '').trim();
                        const finamount = numericPrice * part;
    
                        let paystack = PaystackPop.setup({
                            key: 'pk_live_34cf0528cd04ac9d4f4675db08bf427bfa1509ad',
                            email: userEmail,
                            amount: finamount * 100,
                            ref: '' + Math.floor((Math.random() * 1000000000) + 1),
    
                            callback: function(response) {
                                let reference = response.reference;
                                
                                $.ajax({
                                    type: "POST",
                                    url: "{{URL::to('verify-payment')}}/" + reference,
                                    data: {
                                        _token: '{{ csrf_token() }}',
                                        price: finamount,
                                        courseId: '{{ $posts->id }}',
                                        @auth
                                        userId: '{{ Auth::user()->id }}',                                            
                                        @endauth
                                        participants: document.getElementById('regparticipants').value,
                                        pay_password: payPassword,
                                        reference: reference 
                                    },
                                    success: function(response){
                                        console.log(response);
                                        if (response.status == 401) {
                                            window.location.reload();
                                        } else {
                                            window.location.reload();
                                        }
                                    }
                                });
                            },
    
                            onClose: function(response) {
                            },
                        });
    
                        paystack.openIframe();
                    } else {
                        window.location.reload();
                    }
                }
            });
        }
    </script>
    <script>
        function payCourseWithWallet(id){
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            const amount =  document.getElementById('upload_price').textContent
            const part = document.getElementById('regparticipants').value
            const numericPrice = parseFloat(amount.replace(/[^\d.]/g, ''));
            const reference = '' + Math.floor((Math.random() * 1000000000) + 1);
            const realAmount = numericPrice * part
            console.log(realAmount)
        
            const payPassword = document.getElementById('pay_password').value;
            $.ajax({
                type: "POST",
                url:  '/check-password/',
                data: {
                    _token: csrfToken,
                    password: payPassword
                },
                success: function(response){
                if (response.status == 'success') {
                    $.ajax({
                    type: "POST",
                    url: "{{URL::to('pay-course')}}/" + reference,
                    data: {
                        _token: csrfToken,
                        price: realAmount,
                        courseId: '{{ $posts->id }}',
                        @auth
                        userId: '{{ Auth::user()->id }}',
                        @endauth
                        participants: part,
                        pay_password: payPassword,
                        reference: reference 
                    },
                    success: function(response) {
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                            // window.location.reload();
                        } else {
                            window.location.reload();
                            // Handle other cases if needed
                        }
                    }
                });
                } else {
                    window.location.reload();
                }
                }  
        
            });
        }
    </script>
    <script>
        function loginFirst(){
            fetch('/login-first').then(window.location.reload())
        }
    </script>
@endsection