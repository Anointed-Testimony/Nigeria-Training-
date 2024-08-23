<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nigeria Tutor Registration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/query.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cert.css')}}">
</head>
<body>
    <section class="tutor-background-section" role="img" aria-label="Tutor registration background image">
        <div class="tutor-signup-container">
            <div class="tutor-signup-first-container">
                <h1 class="tutor-signup-header">Become a Business,<br>
                    share your Works!
                </h1>
                <p class="tutor-signup-description">Welcome to the Nigeria Training Portal, where thousands of people find the perfect business daily. <br><br>

                    From Accounting, Marketing, Finance, Management, Entrepreneurship, and Business Law, there many traning providers.
                </p>
                <div>
                    📅 <span style="font-weight: 600; font-size:18px">Upload your Workshops</span> <br><br>

                    🧑💻 Give lessons  <span style="font-weight: 600; font-size:18px">Receive payments</span> <br><br>

                    💵 Set your rates <span style="font-weight: 600; font-size:18px"> List your courses on our premium listings</span>
                </div>
                <div>
                    Register with Nigeria Training Portal and start providing trainings! 
                </div>
            </div>
            <form class="tutor-register-form" method="POST" action="{{route('business.signup')}}">
                @csrf
                <div class="tutor-register-image">
                    <img src="{{asset('assets/images/ntp-logo.png')}}" alt="">
                </div>
                <div class="tutor-inputs-container">
                    <label for="">Enter Business Name</label>
                    <input type="text" id="businessname" name="businessname" placeholder="Enter Business Name">
                </div>
                <div class="tutor-inputs-container">
                    <label for="">Website</label>
                    <input type="text" id="website" name="website" placeholder="Enter website">
                </div>
                <div class="tutor-inputs-container">
                    <label for="">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person" placeholder="Enter Contact Person">
                </div>
                <div class="tutor-inputs-container">
                    <label for="">Description</label>
                   <textarea name="description" id="description" placeholder="Input Your Description here"></textarea>
                </div>
                <button class="tutor-register-button">Become a Business</button>
            </form>
        </div>
    </section>

    <script>
        document.getElementById('rate_per_hour').addEventListener('input', function (e) {
            let value = e.target.value.replace(/,/g, '').replace(/₦/g, '');
            if (!isNaN(value) && value !== '') {
                value = parseFloat(value).toLocaleString('en-NG', {
                    style: 'currency',
                    currency: 'NGN',
                    minimumFractionDigits: 0
                });
                e.target.value = value;
            } else {
                e.target.value = '';
            }
        });

        document.getElementById('rate_per_hour').addEventListener('keypress', function (e) {
            if (isNaN(String.fromCharCode(e.which)) && e.which !== 44 && e.which !== 46) {
                e.preventDefault();
            }
        });
    </script>
</body>
</html>
