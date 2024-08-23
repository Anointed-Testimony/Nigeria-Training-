<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/query.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/popup.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/ntp-logo.png')}}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login</title>
    @notifyCss
</head>
<body>
    <x-notify::notify />
    @if($errors->has('password'))
    <div class="alert alert-danger">
        <div class="popup" id="error">
            <div class="popup-content">
                <div class="title">
                    <h3>Sorry :(</h3>
                </div>
                <p class="para">{{ $errors->first('password') }}</p>
                <div class="progress-container">
                    <div id="progress-bar"></div>
                </div>
            </div>

        </div>
    </div>
    @endif

    <section class="login-section">
        <form method="POST" action="{{route('signin')}}" class="login-texts">
            @csrf
            <div class="singup-logo">
                <img class="object-cover" src="{{asset('assets/images/ntp-logo.png')}}" alt="">
            </div>
            <h1>Welcome Back</h1>
            <p>Welcome back! Please enter your details</p>
            <div class="login-forms">
                <div class="login-input">
                    <label for="">Email</label>
                    <input type="email" name="email">
                </div>
                <div class="login-input">
                    <label for="">Password</label>
                    <input type="password" name="password">
                </div>
                <div class="login-extras">
                    <div class="remember_container">
                        <input type="checkbox">
                        <label for="">Remember me</label>
                    </div>
                    <a href="{{route('reset')}}">Forgot Password</a>
                </div>
            </div>
            <button class="login-button" type="submit">Sign In</button>
            <div class="login_options">
                <p>Don't have an account yet?</p>
                <a href="{{route('signup')}}">Sign up</a>
            </div>
        </form>
        <div class="login-image-container">
            <img class="login-image" src="{{asset('assets/images/log.png')}}" alt="">
        </div>
    </section>
    
<script src="{{asset('assets/js/script.js')}}"></script>
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
@notifyJs
</body>
</html>