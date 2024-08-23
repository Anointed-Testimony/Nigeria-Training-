<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/query.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="{{asset('assets/images/ntp-logo.png')}}" type="image/x-icon">
    <title>Sign Up on Nigeria Training Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="signup-section">
        <div class="signup-image">
            <img src="{{asset('assets/images/signup-image.png')}}" alt="">
        </div>
        <div class="signup-form-container">
            <div class="w-[70px] h-[70px] singup-logo">
                <img class="object-cover" src="{{asset('assets/images/ntp-logo.png')}}" alt="">
            </div>
            <p class="signup-text">Sign Up</p>
            <form class="signup-form" method="POST" action="{{url('/register/user')}}">
                @csrf
                <div id="user-section" class="user-section" style="position: relative">
                    <div class="user user-section1">
                        <div class="input-container">
                            <div class="input-form">
                                <label for="">First Name</label>
                                <input class="@error('firstname') is-invalid @enderror" type="text" name="firstname" value="{{ old('firstname') }}"  autocomplete="firstname" autofocus placeholder="Enter First Name">
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 10px; position:absolute; bottom:-10px; left:0px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-form">
                                <label for="">Last Name</label>
                                <input class="@error('lastname') is-invalid @enderror" type="text" name="lastname" value="{{ old('lastname') }}"  autocomplete="lastname" autofocus placeholder="Enter Last Name">
                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <p style="font-size: 10px; position:absolute; bottom:-10px; left:0px">{{ $message }}</p>
                                </span>
                            @enderror
                            </div>
                            <div class="input-form">
                                <label for="">Email</label>
                                <input class="@error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}"  autocomplete="email"  placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <p style="font-size: 10px; position:absolute; bottom:-10px; left:0px">{{ $message }}</p>
                                </span>
                            @enderror
                            </div>
                            <div class="input-form">
                                <label for="">Password</label>
                                <input class="@error('password') is-invalid @enderror" type="password" name="password"  autocomplete="new-password"  id="password" placeholder="Password">
                                <i id="show" class="fa-solid fa-eye-slash"></i>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 10px; position:absolute; bottom:-10px; left:0px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-form">
                                <label for="">Confirm Password</label>
                                <input class="@error('password') is-invalid @enderror" type="password" name="password_confirmation" id="con-password"  autocomplete="new-password" placeholder="Confirm Password">
                                <i id="con-show" class="fa-solid fa-eye-slash"></i>
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <p style="font-size: 10px; position:absolute; bottom:-10px; left:0px">{{ $message }}</p>
                                </span>
                            @enderror
                            </div>
                            <div class="input-form">
                                <label for="">Telephone</label>
                                <input type="text" name="telephone" required placeholder="Enter Telephone no.">
                            </div>
                            <div class="input-form">
                                <label for="">Address</label>
                                <input type="text" name="address" required placeholder="Enter Address">
                            </div>
                            <div class="input-form">
                                <label for="">Industry</label>
                                <select name="industry" id="" required>
                                    <option disabled selected value="">Select Category</option>
                                    <option value="accounting">Accounting</option>
                                    <option value="actuary-insurance">Actuary and Insurance</option>
                                    <option value="administrative-secretarial">Administrative and Secretarial</option>
                                    <option value="agriculture-rural-development">Agriculture and Rural Development</option>
                                    <option value="art-craft">Art and Craft</option>
                                    <option value="aviation-maritime">Aviation and Maritime</option>
                                    <option value="banking-finance">Banking and Finance</option>
                                    <option value="catering-hotel-management">Catering and Hotel Management</option>
                                    <option value="conferences-seminars">Conferences AGM Seminars</option>
                                    <option value="corporate-governance">Corporate Governance</option>
                                    <option value="csr">Corporate Social Responsibility (CSR)</option>
                                    <option value="customer-service-support">Customer Service and Support</option>
                                    <option value="drivers-driving">Drivers and Driving</option>
                                    <option value="e-learning">E-Learning</option>
                                    <option value="economic-management">Economic Management</option>
                                    <option value="education">Education</option>
                                    <option value="energy-power">Energy and Power</option>
                                    <option value="engineering-technical-skills">Engineering and Technical Skills</option>
                                    <option value="entrepreneurship-business-development">Entrepreneurship and Business Development</option>
                                    <option value="event-planning-management">Event Planning and Management</option>
                                    <option value="executive-education">Executive Education</option>
                                    <option value="general-management">General Management</option>
                                    <option value="hse">Health, Safety and Environment (HSE)</option>
                                    <option value="human-resource-management">Human Resource Management</option>
                                    <option value="ict">Information and Communications Technology</option>
                                    <option value="internal-audit-fraud">Internal Audit and Fraud</option>
                                    <option value="international-training">International Training</option>
                                    <option value="leadership">Leadership</option>
                                    <option value="legal-legislative">Legal and Legislative</option>
                                    <option value="logistics-supply-chain">Logistics and Supply Chain Management</option>
                                    <option value="management-consulting">Management Consulting</option>
                                    <option value="marketing-sales-management">Marketing and Sales Management</option>
                                    <option value="media-communication">Media and Communication</option>
                                    <option value="ngos-donor-projects">NGOs and Donor Funded Projects</option>
                                    <option value="nursing-midwifery">Nursing and Midwifery</option>
                                    <option value="oil-gas">Oil and Gas</option>
                                    <option value="operations-management">Operations Management</option>
                                    <option value="pre-retirement-new-beginnings">Pre-Retirement and New Beginnings</option>
                                    <option value="project-management">Project Management</option>
                                    <option value="protocol-travel-tourism">Protocol, Travel and Tourism</option>
                                    <option value="public-sector-ppp">Public Sector and PPP</option>
                                    <option value="quality-management">Quality Management</option>
                                    <option value="real-estate-management">Real Estate Management</option>
                                    <option value="report-speech-writing">Report and Speech Writing</option>
                                    <option value="research-methodology-analytics">Research Methodology and Analytics</option>
                                    <option value="risk-management">Risk Management</option>
                                    <option value="security-crime-prevention">Security and Crime Prevention</option>
                                    <option value="sports-fitness">Sports and Fitness</option>
                                    <option value="strategic-management">Strategic Management</option>
                                    <option value="telecommunications">Telecommunications</option>
                                    <option value="time-self-management">Time and Self Management</option>
                                    <option value="vocational-education-training">Vocational Education and Training</option>
                                    <option value="women-gender-issues">Women and Gender Issues</option>
                                </select>
                            </div>
                            <div class="input-form">
                                <label for="">Country</label>
                                <select class="country" required name="country">
                                    <option value="" selected disabled>Select Country</option>
                                </select>
                            </div>
                            <div class="input-form">
                                <label for="">State</label>
                                <select name="state" class="state" required></select>
                            </div>
                            <div class="signup-type">
                                <p>Gender</p>
                                <div>
                                    <input type="radio" name="gender" required value="male" checked>
                                    <label for="">Male</label>
                                    <input type="radio" value="female" required name="gender">
                                    <label for="">Female</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit" id="userSubmitBtn">Submit</button>
                    </div>
                    <div style="margin-top: 60px" class="login_options">
                        <p>Have an account?</p>
                        <a href="{{route('login')}}">Login</a>
                    </div>
                </div>
            </form>
            <form id="business-section" method="POST" action="{{url('/register/user')}}">
                @csrf
                <input type="radio" name="user_type" value="business" checked hidden>
                <div style="position: relative">
                    <div class="business user-section1">
                        <div class="input-container">
                            <div class="input-form">
                                <label for="">Business Name</label>
                                <input type="text" name="businessname"  placeholder="Enter First Name">
                            </div>
                            <div class="input-form">
                                <label for="">Business Email</label>
                                <input type="email" name="email" placeholder="Enter First Name">
                            </div>
                            <div class="input-form">
                                <label for="">Password</label>
                                <input type="password" name="password" id="password2" placeholder="Password">
                                <i id="show" class="fa-solid fa-eye-slash"></i>
                            </div>
                            <div class="input-form">
                                <label for="">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="con-password2" placeholder="Confirm Password">
                                <i id="con-show" class="fa-solid fa-eye-slash"></i>
                            </div> 
                            <div class="input-form">
                                <label for="">First Name</label>
                                <input class="@error('firstname') is-invalid @enderror" type="text" name="firstname" value="{{ old('firstname') }}"  autocomplete="firstname" autofocus placeholder="Enter First Name">
                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <p style="font-size: 10px; position:absolute; bottom:-10px; left:0px">{{ $message }}</p>
                                    </span>
                                @enderror
                            </div>
                            <div class="input-form">
                                <label for="">Last Name</label>
                                <input class="@error('lastname') is-invalid @enderror" type="text" name="lastname" value="{{ old('lastname') }}"  autocomplete="lastname" autofocus placeholder="Enter First Name">
                                @error('lastname')
                                <span class="invalid-feedback" role="alert">
                                    <p style="font-size: 10px; position:absolute; bottom:-10px; left:0px">{{ $message }}</p>
                                </span>
                            @enderror
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: -20px" class="business user-section2">
                        <div class="signup-type2">
                            <p>Business Type</p>
                            <div>
                                <input type="checkbox" value="training provider" name="business_type[]" checked>
                                <label for="">Training Providers</label>
                                <input type="checkbox" value="consultant" name="business_type[]">
                                <label for="">Consultant</label>
                            </div>
                        </div>
                        <div class="input-container">
                            <div class="input-form">
                                <label for="">Address</label>
                                <input type="text" name="address" placeholder="Enter Address">
                            </div>
                            <div class="input-form">
                                <label for="">Country</label>
                                <select name="country" class="country">
                                    
                                </select>
                            </div>
                            <div class="input-form">
                                <label for="">State</label>
                                <select name="state" class="state">
            
                                </select>
                            </div>
                            <div class="input-form">
                                <label for="">Specialization</label>
                                <select name="specialization" id=""></select>
                            </div>
                            <div class="input-form">
                                <label for="">Telephone</label>
                                <input type="number" name="telephone" placeholder="Enter Telephone Number">
                            </div>
                            <div class="input-form">
                                <label for="">Website</label>
                                <input type="text" name="website" placeholder="Enter Website">
                            </div>
                        </div>
                    </div>
                    <div class="business user-section1">
                        <div class="input-container">    
                            <div class="input-form">
                                <label for="">Contact Person</label>
                                <input type="text" name="contact_person" placeholder="Contact Person">
                            </div>
                                                   
                        </div>
                        <div class="input-form">
                            <textarea name="description" cols="30" rows="10" maxlength="255" placeholder="Describe Your Business"></textarea>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="button" id="businessPrevBtn">Back</button>
                        <button type="button" id="businessNextBtn">Next</button>
                        <button type="submit" id="businessSubmitBtn">Submit</button>
                    </div>
                    <div style="margin-top: 60px" class="login_options">
                        <p>Have an account?</p>
                        <a href="{{route('login')}}">Login</a>
                    </div>
                </div>
            </form>
            <form method="POST" action="{{url('/register/user')}}">
                @csrf
                <input type="radio" name="user_type" value="professional" checked hidden>
                <div id="professional-section" style="position: relative">
                    <div class="professional user-section1">
                        <div class="input-container">
                            <div class="input-form">
                                <label for="">First Name</label>
                                <input type="text" name="firstname" placeholder="Enter First Name">
                            </div>
                            <div class="input-form">
                                <label for="">Last Name</label>
                                <input type="text" name="lastname" placeholder="Enter Last Name">
                            </div>
                            <div class="input-form">
                                <label for="">Email</label>
                                <input type="email" name="email" placeholder="Enter Email">
                            </div>
                            <div class="input-form">
                                <label for="">Password</label>
                                <input type="password" name="password" id="password3" placeholder="Password">
                                <i id="show" class="fa-solid fa-eye-slash"></i>
                            </div>
                            <div class="input-form">
                                <label for="">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="con-password3" placeholder="Confirm Password">
                                <i id="con-show" class="fa-solid fa-eye-slash"></i>
                            </div>
                            <div class="input-form">
                                <label for="">Date of Birth</label>
                                <input class="@error('date_of_birth') is-invalid @enderror" type="date" name="date_of_birth" value="{{ old('date_of_birth') }}"  autocomplete="date_of_birth" autofocus>
                            </div>
                        </div>
                    </div>
                    <div style="margin-top: -20px" class="professional user-section2">
                        <div class="signup-type2">
                            <p>Professional Type</p>
                            <div>
                                <input type="checkbox" value="Events Manager" name="professional_type[]" checked>
                                <label for="">Events Manager</label>
                                <input type="checkbox" value="Facilitators" name="professional_type[]">
                                <label for="">Facilitators</label>
                            </div>
                        </div>
                        <div class="input-container">
                            <div class="input-form">
                                <label for="">Address</label>
                                <input type="text" name="address" placeholder="Enter Address">
                            </div>
                            <div class="input-form">
                                <label for="">Country</label>
                                <select name="country" class="country">
                                    
                                </select>
                            </div>
                            <div class="input-form">
                                <label for="">State</label>
                                <select name="state" class="state">
            
                                </select>
                            </div>
                            <div class="input-form">
                                <label for="">Specialization</label>
                                <input type="text" name="specialization">
                            </div>
                            <div class="input-form">
                                <label for="">Contact Person</label>
                                <input type="text" name="contact_person" placeholder="Contact Person">
                            </div>
                            <div class="input-form">
                                <label for="">Telephone</label>
                                <input type="text" name="telephone" required placeholder="Enter Telephone no.">
                            </div>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="button" id="professionalPrevBtn">Back</button>
                        <button type="button" id="professionalNextBtn">Next</button>
                        <button type="submit" id="professionalSubmitBtn">Submit</button>
                    </div>
                    <div style="margin-top: 60px" class="login_options">
                        <p>Have an account?</p>
                        <a href="{{route('login')}}">Login</a>
                    </div>
                </div>
            </form>
        </div>

    </section>

<script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>