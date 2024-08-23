<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/query.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Verify Email Address</title>
</head>
<body>
    <section class="verify-background">
        <div class="first-background"></div>
        <div class="second-background"></div>
    </section>
    <section class="verify-section">
        <h1 style="color: #666">Verify your email</h1>
        <p style="color: #999">You will need to verify email to complete registration</p>
        <img class="email-image" src="{{asset('assets/images/email.png')}}" alt="">
        <p style="color: #999; text-align:center">An email has been sent to {{ Auth::user()->email }} with a link to verify your account.If you have not received the email after a few minutes, please check your spam folder.
        </p>
        <div class="email-buttons">
            <form class="resend-form"  method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="">Send Email</button>
            </form>
            <form class="email-change"  method="POST" action="">
                @csrf
                <button type="submit" class="">Change Email</button>
            </form>
        </div>
    </section>
</body>
</html>
