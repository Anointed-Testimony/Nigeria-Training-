@extends('master')
@section('content-pages')
<script src="https://cdn.tailwindcss.com"></script>
<section class="py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="mb-16">
        <h2
          class="text-4xl font-manrope text-center font-bold text-gray-900 leading-[3.25rem]"
        >
          Frequently asked questions
        </h2>
      </div>
      <div class="accordion-group" data-accordion="default-accordion">
        <div
          class="accordion border border-solid border-gray-300 p-4 rounded-xl transition duration-500 accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4 active"
          id="basic-heading-one-with-icon"
        >
          <button
            class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
            aria-controls="basic-collapse-one-with-icon"
            onclick="toggleAccordion(this)"
          >
            <h5 class="font-bold text-lg text-[#65B741]">We would like you to partner with us</h5>
            <i class="fa-solid fa-minus"></i>
          </button>
          <div
            id="basic-collapse-one-with-icon"
            class="accordion-content w-full overflow-hidden pr-4"
            aria-labelledby="basic-heading-one"
            style="max-height: 250px;"
          >
            <p class="text-base text-gray-900 font-normal leading-6">
                Please note that our policy (see "about us“) does not allow us to partner in anyway with training providers or event organizers. This is to ensure that we are able to maintain our neutrality and impartiality at all times. So, our mantra is "what applies to one, applies to all". <br>

                To this end, we ask that you please upload your upcoming program on the site and take advantage of the promotional / advertising options (banner advert placement and premium listing subscription) available on the site to promote it.
                
            </p>
          </div>
        </div>
        <div
          class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
          id="basic-heading-two-with-icon"
        >
          <button
            class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
            aria-controls="basic-collapse-two-with-icon"
            onclick="toggleAccordion(this)"
          >
            <h5 class="font-bold text-lg text-[#65B741]">How do I book for courses or make enquiries on the website?</h5>
            <i class="fa-solid fa-plus"></i>
          </button>
          <div
            id="basic-collapse-two-with-icon"
            class="accordion-content w-full overflow-hidden pr-4 hidden"
            aria-labelledby="basic-heading-two"
          >
            <p class="text-base text-gray-900 font-normal leading-6 ">
                To attend or inquire about any conference/course listed on the site, please follow these steps: <br>
                •	Browse through the site to select your preferred course <br>
                •	Click on the course (it opens the details page) <br>
                •	Click on the "register now" or "chat with us" button to drop a message for the course provider <br>
                •	The course provider will get your message and contact you.
                
            </p>
          </div>
        </div>
        <div
          class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
          id="basic-heading-three-with-icon"
        >
          <button
            class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
            aria-controls="basic-collapse-three-with-icon"
            onclick="toggleAccordion(this)"
          >
            <h5 class="font-bold text-lg text-[#65B741]">How do I find events in the state where I reside?</h5>
            <i class="fa-solid fa-plus"></i>
          </button>
          <div
            id="basic-collapse-three-with-icon"
            class="accordion-content w-full overflow-hidden pr-4 hidden"
            aria-labelledby="basic-heading-three"
          >
            <p class="text-base text-gray-900 font-normal leading-6">
                There are two ways to find events in any state in Nigeria, <br>
                1. On the search bar at the top of the website, take the following steps: <br>
                •	Click on "Use Advanced Search" <br>
                •	Select "Nigeria" in the "Select Country" box, <br>
                •	Select your state in the dropdown presented to you <br>
                •	Click "Search" <br>
                2. Click "More Menu" on the upper right corner of the website, <br>
                •	The website will shift sideways to reveal a set of menu options, <br>
                •	Click on "Events in Nigeria" <br>

            </p>
          </div>
        </div>
        <div
          class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
          id="basic-heading-three-with-icon"
        >
          <button
            class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
            aria-controls="basic-collapse-three-with-icon"
            onclick="toggleAccordion(this)"
          >
          <h5 class="font-bold text-lg text-[#65B741]">I need training in Digital Marketing or Fashion Design.</h5>
          <i class="fa-solid fa-plus"></i>
          </button>
          <div
            id="basic-collapse-three-with-icon"
            class="accordion-content w-full overflow-hidden pr-4 hidden"
            aria-labelledby="basic-heading-three"
            
          >
            <p class="text-base text-gray-900 font-normal leading-6">
                There are two ways to find training in any specific category on the website: <br><br>

                1. Select the category from the list of categories in the footer of the website. In this case, the information required is to be found in two different categories – Marketing and Fashion categories. Each of these links will take you directly to the respective categories. <br><br>

                2. Click "More Menu" on the upper right corner of the website,
                The website will shift sideways to reveal a set of menu options, Select "Events by Category"
                Once on the right category, browse through the list of available training, make a choice and use either the "register now" or "chat with us" button to indicate your interest in attending the training.

            </p>
          </div>
        </div>
        <div
        class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
        id="basic-heading-three-with-icon"
      >
        <button
          class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
          aria-controls="basic-collapse-three-with-icon"
          onclick="toggleAccordion(this)"
        >
        <h5 class="font-bold text-lg text-[#65B741]">It has been very difficult for us to sign up and start posting schedules.</h5>
        <i class="fa-solid fa-plus"></i>
        </button>
        <div
          id="basic-collapse-three-with-icon"
          class="accordion-content w-full overflow-hidden pr-4 hidden"
          aria-labelledby="basic-heading-three"
          
        >
          <p class="text-base text-gray-900 font-normal leading-6">
            Our sign up process is quite easy and straightforward. Simply click the "add business" button on the top right corner of our website and fill the form that comes up.
            However If your business information is already on our site, follow the following steps <br><br>
            •	On at the top of any page on our site, click the login button. You will be redirected to the login page. <br>
            •	Enter your email and password then “Login” <br>
            •	If you cannot remember your password, just click the "forgot password" button. <br>
            •	You will be prompted to enter your email. Enter your email address and the security code, then you click "submit" <br>
            •	An email containing a new log in password will be sent to your email box. <br>
            •	Use your email and this password to log in <br>
            
          </p>
        </div>
      </div>
      <div
      class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
      id="basic-heading-three-with-icon"
    >
      <button
        class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
        aria-controls="basic-collapse-three-with-icon"
        onclick="toggleAccordion(this)"
      >
      <h5 class="font-bold text-lg text-[#65B741]">I will like to attend any of your conference/seminar that is related to Sales/Business Administration, but my employer will need an invitation letter from you, what can you do on this?</h5>
      <i class="fa-solid fa-plus"></i>
      </button>
      <div
        id="basic-collapse-three-with-icon"
        class="accordion-content w-full overflow-hidden pr-4 hidden"
        aria-labelledby="basic-heading-three"
        
      >
        <p class="text-base text-gray-900 font-normal leading-6">
            To get an invitation to attend any conference/course listed on the site, you need to get in touch with the training provider offering the course. To do this, please follow these steps: <br><br>
            •	Browse through the site to select your preferred course <br>
            •	Click on the course (it opens up the details page) <br>
            •	Click on the "chat with us" button and drop a message for the course provider

        </p>
      </div>
    </div>
    <div
    class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
    id="basic-heading-three-with-icon"
  >
    <button
      class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
      aria-controls="basic-collapse-three-with-icon"
      onclick="toggleAccordion(this)"
    >
    <h5 class="font-bold text-lg text-[#65B741]">I am a staff of the above Commission kindly feed me with more details about the procedure on how to participate to the various courses/seminars/workshop.</h5>
    <i class="fa-solid fa-plus"></i>
    </button>
    <div
      id="basic-collapse-three-with-icon"
      class="accordion-content w-full overflow-hidden pr-4 hidden"
      aria-labelledby="basic-heading-three"
      
    >
      <p class="text-base text-gray-900 font-normal leading-6">
        To participate in the various workshops and seminars, please take the following steps: <br><br>
        •	Browse through the site  to select your preferred course <br>
        •	Click on the course (it opens up the details page) <br>
        •	Click on the "chat with us" button and drop a message for the course provider <br>
        •	The course provider will get your message and contact you. <br>
        •	Where the provider does not get in touch with you, please use the "contact us" button on the site to let us know. We will call the provider to have them contact you as soon as possible.
        
      </p>
    </div>
  </div>
  <div
  class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
  id="basic-heading-three-with-icon"
>
  <button
    class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
    aria-controls="basic-collapse-three-with-icon"
    onclick="toggleAccordion(this)"
  >
  <h5 class="font-bold text-lg text-[#65B741]">What is the fee for the training?</h5>
  <i class="fa-solid fa-plus"></i>
  </button>
  <div
    id="basic-collapse-three-with-icon"
    class="accordion-content w-full overflow-hidden pr-4 hidden"
    aria-labelledby="basic-heading-three"
    
  >
    <p class="text-base text-gray-900 font-normal leading-6">
        We cannot help unless we know the exact training you need. Please click on any of the courses on our list. You will be redirected to the page where you will get all the information you need. Where you still need further information, use either the "register now" or "chat with us" button on the events details page to send a specific message to the training provider. Alternatively, you may use the "contact us" button on the site to get in touch with us.
    </p>
  </div>
</div>
<div
class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
id="basic-heading-three-with-icon"
>
<button
  class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
  aria-controls="basic-collapse-three-with-icon"
  onclick="toggleAccordion(this)"
>
<h5 class="font-bold text-lg text-[#65B741]">How do I register my business on your platform?</h5>
<i class="fa-solid fa-plus"></i>
</button>
<div
  id="basic-collapse-three-with-icon"
  class="accordion-content w-full overflow-hidden pr-4 hidden"
  aria-labelledby="basic-heading-three"
  
>
  <p class="text-base text-gray-900 font-normal leading-6">
    Registering your business (free) on our platform is quite easy and straightforward. To register, simply click the "Add Business button at the top right corner of the website
  </p>
</div>
</div>
<div
class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
id="basic-heading-three-with-icon"
>
<button
  class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
  aria-controls="basic-collapse-three-with-icon"
  onclick="toggleAccordion(this)"
>
<h5 class="font-bold text-lg text-[#65B741]">How do I advertise on Nigeria Training Portal website?</h5>
<i class="fa-solid fa-plus"></i>
</button>
<div
  id="basic-collapse-three-with-icon"
  class="accordion-content w-full overflow-hidden pr-4 hidden"
  aria-labelledby="basic-heading-three"
  
>
  <p class="text-base text-gray-900 font-normal leading-">
    There are three ways to do training advertisement on our website, they include: <br><br>
•	Free course listing <br>
•	Premium course/business listing (paid service)  <br>
•	Banner advert placement (paid service) <br> <br>

A click on any of the above links will take you to the relevant page for more information.
Note that to upload your courses (free) on the website; you will need to first upload your business details using the "Add Business button. The process of subscribing / signing up

  </p>
</div>
</div>
<div
class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
id="basic-heading-three-with-icon"
>
<button
  class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
  aria-controls="basic-collapse-three-with-icon"
  onclick="toggleAccordion(this)"
>
<h5 class="font-bold text-lg text-[#65B741]">Please I want to know how we can get our company's listing on your portal. How much does it also take to advertise?</h5>
<i class="fa-solid fa-plus"></i>
</button>
<div
  id="basic-collapse-three-with-icon"
  class="accordion-content w-full overflow-hidden pr-4 hidden"
  aria-labelledby="basic-heading-three"
  
>
  <p class="text-base text-gray-900 font-normal leading-6">
    To get your company's listing on our portal and start uploading your courses on our website, all you have to do is upload your business information using the “Add Business” button at the top left corner of the website, wait for a message confirming your business listing has been activated, sign in with the information provided, then start uploading your courses using the “Add Event/Courses” button. <br><br>

    Generally, our service offerings include the following: <br>
    •	Free course listing <br>
    •	Free business listing <br>
    •	Premium course/business listing (paid service) <br>
    •	Banner advert placement (paid service) <br>
    
  </p>
</div>
</div>
<div
class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
id="basic-heading-three-with-icon"
>
<button
  class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
  aria-controls="basic-collapse-three-with-icon"
  onclick="toggleAccordion(this)"
>
<h5 class="font-bold text-lg text-[#65B741]">What does Nigeria Training Portal do?</h5>
<i class="fa-solid fa-plus"></i>
</button>
<div
  id="basic-collapse-three-with-icon"
  class="accordion-content w-full overflow-hidden pr-4 hidden"
  aria-labelledby="basic-heading-three"
  
>
  <p class="text-base text-gray-900 font-normal leading-6">
    Nigeria Training Portal provides Information on upcoming training, conferences, seminars, workshop and other learning opportunities in Nigeria and around the world. Nigeria Training Portal is not a training outfit and so does not train. We are an <span class="font-bold">all-in-one training hub</span>, a place where training providers can showcase their courses and where intending trainees can come to look for training from the comfort of their homes and offices anywhere in the world. We also provide information (and web links) on training providers, venue providers, training equipment suppliers, event managers etc.
  </p>
</div>
</div>
<div
class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
id="basic-heading-three-with-icon"
>
<button
  class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
  aria-controls="basic-collapse-three-with-icon"
  onclick="toggleAccordion(this)"
>
<h5 class="font-bold text-lg text-[#65B741]">How do I become an online tutor at Nigeria Training Portal?</h5>
<i class="fa-solid fa-plus"></i>
</button>
<div
  id="basic-collapse-three-with-icon"
  class="accordion-content w-full overflow-hidden pr-4 hidden"
  aria-labelledby="basic-heading-three"
  
>
  <p class="text-base text-gray-900 font-normal leading-6">
    1.	Provide some basic information about yourself <br>
    2.	Upload your headshot photo <br>
    3.	Describe your strengths as a tutor <br>
    4.	Record a short video introduction (up to 2 mins long) <br>
    5.	Choose your availability <br><br>
    
    When you complete registration, our Tutor Success team will review your profile within 5 business days. Once your profile is approved, students from around the world will see it on Nigeria Training Portal and will be able to book lessons with you.
    
    
  </p>
</div>
</div>
<div
class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
id="basic-heading-three-with-icon"
>
<button
  class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
  aria-controls="basic-collapse-three-with-icon"
  onclick="toggleAccordion(this)"
>
<h5 class="font-bold text-lg text-[#65B741]">What computer equipment do I need to teach on Nigeria Training Profile?</h5>
<i class="fa-solid fa-plus"></i>
</button>
<div
  id="basic-collapse-three-with-icon"
  class="accordion-content w-full overflow-hidden pr-4 hidden"
  aria-labelledby="basic-heading-three"
  
>
  <p class="text-base text-gray-900 font-normal leading-6">
    You will need a laptop or a desktop computer, a stable internet connection, a webcam, and a microphone for conducting lessons.
  </p>
</div>
</div>
<div
class="accordion border border-solid border-gray-300 p-4 rounded-xl accordion-active:bg-indigo-50 accordion-active:border-indigo-600 mb-8 lg:p-4"
id="basic-heading-three-with-icon"
>
<button
  class="accordion-toggle group inline-flex items-center justify-between text-left text-lg font-normal leading-8 text-gray-900 w-full transition duration-500 hover:text-indigo-600 accordion-active:font-medium accordion-active:text-indigo-600"
  aria-controls="basic-collapse-three-with-icon"
  onclick="toggleAccordion(this)"
>
<h5 class="font-bold text-lg text-[#65B741]">What kind of tutors does NTP look for?</h5>
<i class="fa-solid fa-plus"></i>
</button>
<div
  id="basic-collapse-three-with-icon"
  class="accordion-content w-full overflow-hidden pr-4 hidden"
  aria-labelledby="basic-heading-three"
  
>
  <p class="text-base text-gray-900 font-normal leading-6">
    No specific certification or teaching experience is required! We welcome tutors who: <br>
    1.	Enjoy sharing knowledge and making a difference in students’ lives <br>
    2.	Have outstanding communication skills <br>
    3.	Are willing to provide a personalized learning experience to international students <br>
  </p>
</div>
</div>
      </div>
    </div>
  </section>
                                          
@endsection