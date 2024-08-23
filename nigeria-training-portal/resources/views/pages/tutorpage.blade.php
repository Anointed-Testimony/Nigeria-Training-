<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/query.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/cert.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>{{$user->name}} | Tutor</title>
</head>
<body>
    @include('layouts.header')
    <section class="w-[900px] p-[25px] h-full grid grid-cols-3 mx-auto my-[60px] gap-[20px] max-[900px]:w-[700px] max-[700px]:flex max-[700px]:flex-col max-[700px]:flex-col-reverse max-[700px]:items-start max-[700px]:w-auto">
        <div class="flex flex-col gap-[1px] col-span-2">
            <h2 class="text-[#6a6f73] text-[35px] font-semibold">Tutor</h2>
            <h1 class="text-[#2d2f31] text-[40px] font-bold">{{$user->name}}</h1>
            <p>{{$tutor->categories->name}}</p>
            <p class="bg-[#598b4d] font-bold py-[5px] px-[10px] self-start mt-[20px] text-[15px] text-[#fff]">Nigeria Training Portal Tutor Partner</p>
            <div class="mt-[50px] flex gap-[35px]">
                <div class="flex flex-col gap-[5px]">
                    <h3 class="text-[18px] text-[#706f73] font-bold">Total Students</h3>
                    <p class="text-[25px] text-[#020202] font-bold">{{$students->count()}}</p>
                </div>
            </div>
            <p class="text-[18px] text-[#020202] font-semibold mt-[30px]">About Me</p>
            <p class="text-[#999] text-[15px]">{{$tutor->description}}</p>
            <p class="font-bold mt-10">Reviews({{$reviews->count()}})</p>
            <hr class="mt-[10px]">
            @foreach ($reviews as $review)
            <div class="w-full mt-2 h-auto border-solid border-2 rounded-lg p-3 flex flex-col gap-5">
                <p>{{ $review->content }}</p>
                <div class="w-full flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full">
                            <img class="object-cover rounded-full" src="{{ asset('/storage/users-avatar/' . ($review->user->avatar ?? 'default-avatar.png')) }}" alt="{{ $review->user->name }}">
                        </div>
                        <p class="font-semibold text-[#242351]">{{ $review->user->name }}</p>
                    </div>
                    <div class="text-[#598b4d] text-[13px]">
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $review->rating)
                                <i class="fa-solid fa-star"></i>
                            @else
                                <i class="fa-regular fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
        @endforeach
            @if ($hasPaidBooking)
            <form action="{{route('reviews.store')}}" method="POST" class="mt-10 flex flex-col gap-3">
                @csrf
                <textarea name="review" id="review" class="w-full h-[150px] rounded-md border-[1px] p-4" placeholder="Add Review Here..."></textarea>
                
                <div class="flex justify-between items-center">
                    <div class="text-[#598b4d] text-[13px] star-rating">
                        <span class="star" data-value="1"><i class="fa-regular fa-star"></i></span>
                        <span class="star" data-value="2"><i class="fa-regular fa-star"></i></span>
                        <span class="star" data-value="3"><i class="fa-regular fa-star"></i></span>
                        <span class="star" data-value="4"><i class="fa-regular fa-star"></i></span>
                        <span class="star" data-value="5"><i class="fa-regular fa-star"></i></span>
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0">
                    <input type="hidden" name="tutor_id" value="{{$tutor->id}}">
                    <button type="submit" class="text-[#fff] bg-[#598b4d] px-2 py-2 text-sm rounded-lg">Add Review</button>
                </div>
            </form>
            @endif
            <p class="text-[18px] text-[#020202] font-semibold mt-[30px]">Related Tutors</p>
            <hr class="mt-[10px]">
            @foreach ($related as $relate)
                <div class="grid grid-cols-2 gap-[10px] w-full mt-[30px] max-[960px]:grid-cols-2 max-[560px]:grid-cols-1">
                    <div class="flex flex-col gap-[5px] cursor-pointer">
                        <div class="w-full h-[200px] rounded-tr-[20px] rounded-tl-[20px] overflow-hidden">
                            <img class="w-full h-full object-cover" src="{{asset("storage/users-avatar/{$relate->user->avatar}")}}" alt="">
                        </div>
                        <div class="text-[18px] font-bold text-[#242351]">{{$relate->user->name}}</div>
                        <p class="line-clamp-3">{{$relate->description}}</p>
                        <div class="flex gap-[5px] items-center">
                            <p class="font-bold">3.0</p>
                            <div class="text-[#598b4d] text-[13px]"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-regular fa-star"></i><i class="fa-regular fa-star"></i></div>
                            <p class="text-[13px]">(500,000)</p>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="flex flex-col gap-[15px] w-full mt-[10px]">
                <a href="#" class="p-[20px] flex items-center justify-center gap-[2px] border-solid border-[1px] border-[#020202] hover:bg-[#020202] hidden hover:text-[#fff] max-[700px]:flex"><i class="fa-solid fa-book-bookmark"></i> Book Now</a>
                <a href="#" class="p-[20px] flex items-center justify-center gap-[2px] border-solid border-[1px] border-[#020202] hover:bg-[#020202] hidden hover:text-[#fff] max-[700px]:flex"><i class="fa-solid fa-headset"></i> Chat Now</a>
            </div>
        </div>
        <div class="flex flex-col items-center col-span-1 gap-[50px] max-[700px]:gap-0">
            <div class="w-[200px] h-[200px] rounded-full">
                <img class="w-full object-cover h-full object-top rounded-full" src="{{ asset("storage/users-avatar/$profile") }}" alt="">
            </div>
            <div class="flex flex-col gap-[15px] w-full">
                <a onclick="openHireModal()" class="w-[150px] h-[44px] flex items-center cursor-pointer justify-center gap-[2px] border-solid border-[1px] border-[#020202] self-center hover:bg-[#020202] hover:text-[#fff] max-[700px]:hidden"><i class="fa-solid fa-book-bookmark"></i> Book Now</a>
                <a href="{{url("/chat/$user->id")}}" class="w-[150px] h-[44px] flex items-center cursor-pointer justify-center gap-[2px] border-solid border-[1px] border-[#020202] self-center hover:bg-[#020202] hover:text-[#fff] max-[700px]:hidden"><i class="fa-solid fa-headset"></i> Chat Now</a>
            </div>
        </div>
    </section>
    <section id="hire-modal-container" class="hidden">
        <section class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center">
            <!-- Modal -->
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all max-w-lg w-full px-6 py-2">
                <!-- Close Button -->
                <div class="flex justify-end">
                    <button class="text-gray-400 hover:text-gray-500 focus:outline-none" aria-label="Close" onclick="closeHireModal()">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <!-- Modal Title -->
                <h2 class="text-2xl font-semibold text-center mb-4">Hire {{$user->name}}</h2>
        
                <!-- Form -->
                <form action="{{route('createBookings.store')}}" method="POST" id="hireForm">
                    @csrf
                    <!-- Address Field -->
                    <div class="mb-4">
                        <label for="address" class="block text-gray-700 font-medium mb-2">Address</label>
                        <input type="text" id="address" name="address" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#598b4d] transition duration-200" placeholder="Enter your address" required>
                    </div>
                    <input type="hidden" name="tutor_id" value="{{$tutor->id}}">
                    <!-- Phone Number Field -->
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 font-medium mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#598b4d] transition duration-200" placeholder="Enter your phone number" pattern="[0-9]{11}" title="Enter a 10-digit phone number" required>
                    </div>
        
                    <!-- Session Type -->
                    <div class="mb-4">
                        <label for="sessionType" class="block text-gray-700 font-medium mb-2">Session Type</label>
                        <select id="sessionType" name="sessionType" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#598b4d] transition duration-200" required>
                            <option value="" disabled selected>Select Session Type</option>
                            <option value="online">Online</option>
                            <option value="physical">Physical</option>
                        </select>
                    </div>
        
                    <!-- Date and Time -->
                    <div class="mb-4">
                        <label for="sessionDate" class="block text-gray-700 font-medium mb-2">Session Date & Time</label>
                        <input type="datetime-local" id="sessionDate" name="sessionDate" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#598b4d] transition duration-200" required>
                    </div>

                    <!-- Duration Field -->
                    <div class="mb-4">
                        <label for="duration" class="block text-gray-700 font-medium mb-2">Session Duration (Hours)</label>
                        <input type="number" id="duration" name="duration" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#598b4d] transition duration-200" placeholder="Enter session duration in hours" min="1" required>
                    </div>
        
                    <!-- Subject Selection -->
                    {{-- <div class="mb-4">
                        <label for="subject" class="block text-gray-700 font-medium mb-2">Select Subject</label>
                        <select id="subject" name="subject" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#598b4d] transition duration-200" required>
                            <option value="" disabled selected>Select a Subject</option>
                            @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}
        
                    <!-- Additional Notes -->
                    <div class="mb-4">
                        <label for="notes" class="block text-gray-700 font-medium mb-2">Additional Notes</label>
                        <textarea id="notes" name="notes" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-[#598b4d] transition duration-200" placeholder="Any additional information or requests" rows="3"></textarea>
                    </div>
        
                    <!-- Buttons -->
                    <div class="flex justify-end">
                        <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2 transition duration-200 hover:bg-gray-600 focus:outline-none" onclick="closeHireModal()">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-[#598b4d] text-white rounded-lg transition duration-200 hover:bg-[#457e38] focus:outline-none" onclick="submitHireForm()">Submit</button>
                    </div>
                </form>
            </div>
        </section>
    </section>
    @include('layouts.footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    document.getElementById('rating').value = value;
                    stars.forEach(s => s.querySelector('i').classList.remove('fa-solid'));
                    stars.forEach(s => s.querySelector('i').classList.add('fa-regular'));
                    this.querySelector('i').classList.add('fa-solid');
                    this.querySelector('i').classList.remove('fa-regular');
                    for (let i = 0; i < value; i++) {
                        stars[i].querySelector('i').classList.add('fa-solid');
                        stars[i].querySelector('i').classList.remove('fa-regular');
                    }
                });
            });
        });
    </script>
</body>
</html>