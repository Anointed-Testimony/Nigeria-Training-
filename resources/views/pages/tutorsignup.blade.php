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
                <h1 class="tutor-signup-header">Become a tutor,<br>
                    share your passion!
                </h1>
                <p class="tutor-signup-description">Welcome to the Nigeria's #1 private tutoring platform, where thousands of people find the perfect professional daily. <br><br>

                    From Accounting, Marketing, Finance, Management, Entrepreneurship, and Business Law, there many subjects to teach.
                </p>
                <div>
                    📅 <span style="font-weight: 600; font-size:18px">Organize your schedule</span> <br><br>

                    🧑💻 Give lessons  <span style="font-weight: 600; font-size:18px">online or in person</span> <br><br>

                    💵 Set your rates <span style="font-weight: 600; font-size:18px"> (between ₦20k and ₦80k per hour)</span>
                </div>
                <div>
                    Register with Nigeria Training Portal and start giving private lessons today! 
                </div>
            </div>
            <form class="tutor-register-form" method="POST" action="{{route('tutor.register')}}" enctype="multipart/form-data">
                @csrf
                <div class="tutor-register-image">
                    <img src="{{asset('assets/images/ntp-logo.png')}}" alt="">
                </div>
                <div class="tutor-inputs-container">
                    <label for="">Choose Category</label>
                    <select name="category" id="">
                        @foreach ($allCategories as $allCategory)
                            <option value="{{$allCategory->id}}">{{$allCategory->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div style="display: flex; justify-content:space-between; align-items:center">
                    <div class="tutor-inputs-container">
                        <label for="">Rate per Hour (₦)</label>
                        <input type="text" id="rate_per_hour" name="rate_per_hour" placeholder="Enter rate">
                    </div>
                    <div class="tutor-inputs-container" style="border: none">
                        <label for="">Upload HeadShot</label>
                        <input style="border: none" type="file" name="headshot" accept=".png, .jpg, .jpeg">
                    </div>
                </div>
                <div class="tutor-inputs-container">
                    <label for="">Description</label>
                   <textarea name="description" id="description" placeholder="Input Your Description..."></textarea>
                </div>
                <div class="tutor-upload-container">
                    <div class="tutor-first-upload-container">
                        <p style="font-size: 10px">Record and upload a short video about yourself</p>
                        <input type="file" name="video" id="upload_front">
                    </div>
                    <div class="tutor-inputs-container">
                        <label for="">Choose Availability</label>
                        <select name="availability" id="">
                            <option value="virtual">Virtual</option>
                            <option value="physical">Physical</option>
                            <option value="both">Both</option>
                        </select>
                    </div>
                </div>
                <button class="tutor-register-button">Become a Tutor</button>
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
