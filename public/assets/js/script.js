const menu = document.getElementById('dropdown')
const dropdown = document.getElementById('dropdown-menu');
const show = document.getElementById('show')
const conShow = document.getElementById('con-show')
const pass = document.getElementById('password')
const conPass = document.getElementById('con-password')
if(menu){
  menu.addEventListener('click', (e)=>{
    if(menu.classList.contains('fa-bars')){
        dropdown.style.display = 'flex';
        menu.classList.add('fa-xmark')
        menu.classList.remove('fa-bars')
      } else{
        dropdown.style.display = 'none';
        menu.classList.remove('fa-xmark')
        menu.classList.add('fa-bars')
      }
  });

  // let defaultImagesWithLinks = [
  //     {
  //         image_url: 'assets/images/hero-banner.jpg',
  //         link: '127.0.0.1:8000/'
  //     },
  //     {
  //         image_url: 'http://127.0.0.1:8000/assets/images/hero-banner2.jpg',
  //         link: '127.0.0.1:8000/'
  //     }
  // ];
  // let imagesWithLinks = [];
  //   imagesWithLinks = defaultImagesWithLinks;
    
  //   function fetchImagesWithLinks() {
  //       fetch('/get-top-banner-images') 
  //       .then(response => response.json())
  //       .then(data => {
  //           imagesWithLinks = imagesWithLinks.concat(data);
  //           displayImageWithLink(0);
  //       })
  //       .catch(error => {
  //           // console.error/('Error fetching images with links:', error);
  //       });
  //   }

  // function displayImageWithLink(index) {
  //     if (document.getElementById('hero-img-container')) {
  //         const container = document.getElementById('hero-img-container');
  //         container.innerHTML = '';
  //         const link = document.createElement('a');
  //         link.href = '//' + imagesWithLinks[index].link; 
  //         link.target ='_blank'
  //         link.id = "ads_" + imagesWithLinks[index].id
  //         link.onclick = function() {
  //           var adId = imagesWithLinks[index].id;
  //           var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  //           fetch('/click', {
  //               method: 'POST',
  //               headers: {
  //                   'Content-Type': 'application/json',
  //                   'X-CSRF-TOKEN': csrfToken 
  //               },
  //               body: JSON.stringify({
  //                   ad_id: adId
  //               })
  //           })
  //           .then(response => {
  //               if (!response.ok) {
  //                   throw new Error('Network response was not ok');
  //               }
  //               // console.log('Click recorded successfully');
  //           })
  //           .catch(error => {
  //               // console.error('Error recording click:', error);
  //           });
  //       };
  //                 const img = document.createElement('img');
  //         img.src = imagesWithLinks[index].image_url; 
  //         img.id = 'hero-img';
  //         link.appendChild(img);
  //         container.appendChild(link);
  //         recordImpression(imagesWithLinks[index].id);
  //     }
  // }

  // fetchImagesWithLinks();
  // let currentIndex = 0;
  // function changeImage() {
  //     currentIndex = (currentIndex + 1) % imagesWithLinks.length;
  //     displayImageWithLink(currentIndex);
  // }
  // setInterval(changeImage, 5000);
}

function recordImpression(adId) {
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  fetch('/record', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken 
      },
      body: JSON.stringify({
          ad_id: adId
      })
  })
  .then(response => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      // console.log('Impression recorded successfully');
  })
  .catch(error => {
      // console.error('Error recording impression:', error);
  });
}

function countClicks(){
  console.log('hi')
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  // Make an AJAX request to record impression
  fetch('/clicks', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken 
      },
      body: JSON.stringify({
          ad_id: adId
      })
  })
  .then(response => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      // console.log('Click recorded successfully');
  })
  .catch(error => {
      // console.error('Error recording click:', error);
  });
}

if(show){
  show.addEventListener('click', (e)=>{
    if(pass.type === 'password'){
      pass.type = "text"
      show.classList.add('fa-eye')
      show.classList.remove('fa-eye-slash')
    }else{
      pass.type = "password"
      show.classList.remove('fa-eye')
      show.classList.add('fa-eye-slash')
    }
  })
}


if(conShow){
  conShow.addEventListener('click', (e)=>{
    if(conPass.type === 'password'){
      conPass.type = "text"
      conShow.classList.add('fa-eye')
      conShow.classList.remove('fa-eye-slash')
    }else{
      conPass.type = "password"
      conShow.classList.remove('fa-eye')
      conShow.classList.add('fa-eye-slash')
    }
  })
}

var config = {
  cUrl: 'https://api.countrystatecity.in/v1/countries',
  cKey: 'aklyRXZONlFKT054eU5WbHJJcFloOTlqaUJoaWpac1ZDUm5hYUJqVA=='
}

// Select all relevant select tags
const countrySelects = document.querySelectorAll('.country');
const stateSelects = document.querySelectorAll('.state');

function loadCountriesDropdown(countrySelects) {
  let apiEndPoint =  config.cUrl;

  fetch(apiEndPoint, {headers: {"X-CSCAPI-KEY": config.cKey}})
  .then(Response => Response.json())
  .then(data => {
    countrySelects.forEach(countrySelect => {
      data.forEach(country => {
        const option = document.createElement('option');
        option.value = country.iso2;
        option.textContent = country.name;
        countrySelect.appendChild(option);
      });
    });
  })
  .catch(error=> console.log('Error Loading Countries:', error));
}

function loadStatesDropdown(countrySelect, stateSelect) {
  const selectedCountry = countrySelect.value;

  stateSelect.innerHTML = '<option value="">Select State</option>';

  fetch(`${config.cUrl}/${selectedCountry}/states`, {headers: {"X-CSCAPI-KEY": config.cKey}})
  .then(Response => Response.json())
  .then(data => {
    data.forEach(state => {
      const option = document.createElement('option');
      option.value = state.name;
      option.textContent = state.name;
      stateSelect.appendChild(option);
    });
  })
  .catch(error=> console.log('Error Loading States:', error));
}

if (countrySelects.length > 0) {
  countrySelects.forEach((countrySelect, index) => {
    countrySelect.addEventListener('change', function () {
      loadStatesDropdown(countrySelect, stateSelects[index]);
    });
  });

  window.onload = function () {
    loadCountriesDropdown(countrySelects);
  };
}


// dashboard tabs
document.addEventListener('DOMContentLoaded', () => {
  const sections = {
    paid: document.getElementById('mycourse-section'),
    wallet: document.getElementById('wallet-section'),
    metrics: document.getElementById('metrics-section'),
    settings: document.getElementById('setting-section'),
    uploading: document.getElementById('upload-section'),
    allupload: document.getElementById('allupload-section'),
    student: document.getElementById('student-section'),
    kyc: document.getElementById('kyc-section'),
    plan: document.getElementById('plan-section'),
    ads: document.getElementById('ads-section'),
    feature: document.getElementById('feature-section'),
    certificate: document.getElementById('certificate-section'),
    premium: document.getElementById('premium-listing-section')
  };

  const tabs = {
    paid: document.getElementById('paid-courses'),
    wallet: document.getElementById('wallet'),
    metrics: document.getElementById('metrics'),
    settings: document.getElementById('settings'),
    uploading: document.getElementById('uploading'),
    allupload: document.getElementById('allupload'),
    student: document.getElementById('student'),
    kyc: document.getElementById('kyc'),
    plan: document.querySelector('.plan_dropdown_container'),
    ads: document.querySelector('.ads_dropdown_container'),
    feature: document.querySelector('.feature_dropdown_container'),
    certificate: document.querySelector('.certificate_dropdown_container'),
    premium: document.querySelector('.premium_listings_dropdown_container')
  };

  function hideAllSections() {
    for (let key in sections) {
      if (sections[key]) sections[key].style.display = 'none';
    }
  }

  function removeAllActiveClasses() {
    for (let key in tabs) {
      if (tabs[key]) tabs[key].classList.remove('back');
    }
  }

  function setActiveTab(id) {
    hideAllSections();
    removeAllActiveClasses();
    if (sections[id]) sections[id].style.display = 'block';
    if (tabs[id]) tabs[id].classList.add('back');
    localStorage.setItem('activeTab', id);
  }

  function restoreActiveTab() {
    const activeTab = localStorage.getItem('activeTab');
    if (activeTab && sections[activeTab]) {
      setActiveTab(activeTab);
    } else {
      setActiveTab('wallet'); // default tab
    }
  }

  restoreActiveTab();

  for (let key in tabs) {
    if (tabs[key]) {
      tabs[key].addEventListener('click', () => setActiveTab(key));
    }
  }
});

const editProfileLink = document.getElementById('edit_profile_link')
const updateShow = document.querySelector('.edit-form')
const closeIcon = document.getElementById('update_close')
const body = document.querySelector('body')

if(editProfileLink){
  editProfileLink.addEventListener('click', (e)=>{
    e.preventDefault();
    updateShow.style.display = "block"
    body.style.overflow = "hidden"
    window.addEventListener('click', function(event) {
      if (!document.querySelector('#edit_profile').contains(event.target) && !editProfileLink.contains(event.target)) {
        updateShow.style.display = "none"
        body.style.overflow = "visible"
      }
  });
  })
  closeIcon.addEventListener('click', (e)=>{
    updateShow.style.display = "none"
    body.style.overflow = "auto"
  })
}

function filterCards(selectedMonth) {

  var cards = document.querySelectorAll('.events');
  
  var cardsDisplayed = false; 


  cards.forEach(function(card) {
    
    var cardMonth = card.getAttribute('data-month');

    
    if (cardMonth === selectedMonth) {
      card.style.display = 'flex';
      cardsDisplayed = true; 
    } else {
      card.style.display = 'none';
    }
  });

  if (!cardsDisplayed) {
    var noCardsMessage = document.querySelector('.no-workshop-message');

    if (noCardsMessage) {
      noCardsMessage.parentNode.removeChild(noCardsMessage);
    }
    noCardsMessage = document.createElement('p');
    noCardsMessage.textContent = 'No workshop for this month';
    noCardsMessage.className = 'no-workshop-message'; 
    const noDisplay =document.querySelector('.work_error')
    noDisplay.appendChild(noCardsMessage); 
  } else {

    var noCardsMessage = document.querySelector('.no-workshop-message');

    if (noCardsMessage) {
      noCardsMessage.parentNode.removeChild(noCardsMessage);
    }
  }
}

function filterTransaction(selectedTransaction){
  var transrows = document.querySelectorAll('.transactions-row');
  
  var transsDisplayed = false; 


  transrows.forEach(function(transrow) {
    
    var transtype = transrow.getAttribute('data-transaction');

    
    if (transtype === selectedTransaction) {
      transrow.style.display = 'table-row';
      transsDisplayed = true; 
    } else {
      transrow.style.display = 'none';
    }
  });
  if (!transsDisplayed) {
    var noCardsMessage = document.querySelector('.no-workshop-message');

    if (noCardsMessage) {
      noCardsMessage.parentNode.removeChild(noCardsMessage);
    }
    noCardsMessage = document.createElement('p');
    noCardsMessage.textContent = 'No Transaction';
    noCardsMessage.className = 'no-workshop-message'; 
    const noDisplay =document.querySelector('.trans_error')
    noDisplay.appendChild(noCardsMessage); 
    noDisplay.style.display = 'block'
  } else {

    var noCardsMessage = document.querySelector('.no-workshop-message');

    if (noCardsMessage) {
      noCardsMessage.parentNode.removeChild(noCardsMessage);
    }
  }
}

const modal = document.getElementById("modal");

if(modal){
  var btn = document.getElementById("wallet_fund");

  var span = document.getElementsByClassName("close")[0];

  btn.onclick = function() {
    modal.style.display = "block";
    console.log('hi')
  }

  span.onclick = function() {
    modal.style.display = "none";
  }
}

function formatAmount(input) {
  // Remove non-digit characters
  var amount = input.value.replace(/\D/g, "");
  
  // Add ₦ sign
  amount = "₦" + amount;
  
  // Add comma after every three digits
  amount = amount.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  
  // Update input value
  input.value = amount;
}

const elements = document.querySelectorAll('.wallet-balance');

// Loop through each element
elements.forEach(element => {
  const rawValue = element.textContent.replace(/[^\d.]/g, ""); // Retain the decimal point
  const parts = rawValue.split('.'); // Split the raw value into integer and decimal parts
  const integerPart = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ","); // Format the integer part
  const formattedAmount = "₦" + (parts[1] ? integerPart + '.' + parts[1] : integerPart); // Concatenate integer and decimal parts
  element.textContent = formattedAmount;
});


const seven =  document.getElementById('dash_seven')
const fourt =  document.getElementById('dash_fourt')
const thirt =  document.getElementById('dash_thirty')
const all =  document.getElementById('all_days')
const user = document.getElementById('users_count')
const busCount = document.getElementById('business_count')
const proCount = document.getElementById('prof_count')
const workCount = document.getElementById('work_count')
const evCount = document.getElementById('events_count')
const ecourseCount = document.getElementById('e-course_count')
const vprogramCount = document.getElementById('v-program_count')
const allText = document.querySelectorAll('.metrics-text')

if(all){
  seven.addEventListener('click', (e) => {
    seven.classList.add('transaction_tabs_back')
    fourt.classList.remove('transaction_tabs_back')
    thirt.classList.remove('transaction_tabs_back')
    all.classList.remove('transaction_tabs_back')
    allText.forEach(element => {
      element.classList.toggle('dashboard_stats-text');
    });
    fetch('/get-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const usCount7 = data.usCount7;
            const busCount7 = data.busCount7;
            const proCount7 = data.proCount7;
            const workCount7 = data.workCount7;
            const evCount7 = data.evenCount7;
            const ecourseCount7 = data.eCount7;
            const vprogramCount7 = data.virtCount7;


            user.textContent = usCount7 !== undefined && usCount7 !== null ? usCount7 : '0';
            busCount.textContent = busCount7 !== undefined && busCount7 !== null ? busCount7 : '0';
            proCount.textContent = proCount7 !== undefined && proCount7 !== null ? proCount7 : '0';
            workCount.textContent = workCount7 !== undefined && workCount7 !== null ? workCount7 : '0';
            evCount.textContent = evCount7 !== undefined && evCount7 !== null ? evCount7 : '0';
            ecourseCount.textContent = ecourseCount7 !== undefined && ecourseCount7 !== null ? ecourseCount7 : '0';
            vprogramCount.textContent = vprogramCount7 !== undefined && vprogramCount7 !== null ? vprogramCount7 : '0';
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});
  fourt.addEventListener('click', (e) => {
    seven.classList.remove('transaction_tabs_back')
    fourt.classList.add('transaction_tabs_back')
    thirt.classList.remove('transaction_tabs_back')
    all.classList.remove('transaction_tabs_back')
    allText.forEach(element => {
      element.classList.toggle('dashboard_stats-text');
    });
    fetch('/get-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const usCount14 = data.usCount14;
            const busCount14 = data.busCount14;
            const proCount14 = data.proCount14;
            const workCount14 = data.workCount14;
            const evCount14 = data.evenCount14;
            const ecourseCount14 = data.eCount14;
            const vprogramCount14 = data.virtCount14;


            user.textContent = usCount14 !== undefined && usCount14 !== null ? usCount14 : '0';
            busCount.textContent = busCount14 !== undefined && busCount14 !== null ? busCount14 : '0';
            proCount.textContent = proCount14 !== undefined && proCount14 !== null ? proCount14 : '0';
            workCount.textContent = workCount14 !== undefined && workCount14 !== null ? workCount14 : '0';
            evCount.textContent = evCount14 !== undefined && evCount14 !== null ? evCount14 : '0';
            ecourseCount.textContent = ecourseCount14 !== undefined && ecourseCount14 !== null ? ecourseCount14 : '0';
            vprogramCount.textContent = vprogramCount14 !== undefined && vprogramCount14 !== null ? vprogramCount14 : '0';
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});
  thirt.addEventListener('click', (e) => {
    seven.classList.remove('transaction_tabs_back')
    fourt.classList.remove('transaction_tabs_back')
    thirt.classList.add('transaction_tabs_back')
    all.classList.remove('transaction_tabs_back')
    allText.forEach(element => {
      element.classList.toggle('dashboard_stats-text');
    });
    fetch('/get-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const usCount31 = data.usCount31;
            const busCount31 = data.busCount31;
            const proCount31 = data.proCount31;
            const workCount31 = data.workCount31;
            const evCount31 = data.evenCount31;
            const ecourseCount31 = data.eCount31;
            const vprogramCount31 = data.virtCount31;


            user.textContent = usCount31 !== undefined && usCount31 !== null ? usCount31 : '0';
            busCount.textContent = busCount31 !== undefined && busCount31 !== null ? busCount31 : '0';
            proCount.textContent = proCount31 !== undefined && proCount31 !== null ? proCount31 : '0';
            workCount.textContent = workCount31 !== undefined && workCount31 !== null ? workCount31 : '0';
            evCount.textContent = evCount31 !== undefined && evCount31 !== null ? evCount31 : '0';
            ecourseCount.textContent = ecourseCount31 !== undefined && ecourseCount31 !== null ? ecourseCount31 : '0';
            vprogramCount.textContent = vprogramCount31 !== undefined && vprogramCount31 !== null ? vprogramCount31 : '0';
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});
  all.addEventListener('click', (e) => {
    seven.classList.remove('transaction_tabs_back')
    fourt.classList.remove('transaction_tabs_back')
    thirt.classList.remove('transaction_tabs_back')
    all.classList.add('transaction_tabs_back')
    allText.forEach(element => {
      element.classList.toggle('dashboard_stats-text');
    });
    fetch('/get-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const usCount1 = data.usCount;
            const busCount1 = data.busCount;
            const proCount1 = data.proCount;
            const workCount1 = data.workCount;
            const evCount1 = data.evenCount;
            const ecourseCount1 = data.eCount;
            const vprogramCount1 = data.virtCount;


            user.textContent = usCount1 !== undefined && usCount1 !== null ? usCount1 : '0';
            busCount.textContent = busCount1 !== undefined && busCount1 !== null ? busCount1 : '0';
            proCount.textContent = proCount1 !== undefined && proCount1 !== null ? proCount1 : '0';
            workCount.textContent = workCount1 !== undefined && workCount1 !== null ? workCount1 : '0';
            evCount.textContent = evCount1 !== undefined && evCount1 !== null ? evCount1 : '0';
            ecourseCount.textContent = ecourseCount1 !== undefined && ecourseCount1 !== null ? ecourseCount1 : '0';
            vprogramCount.textContent = vprogramCount1 !== undefined && vprogramCount1 !== null ? vprogramCount1 : '0';
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
});

}

const withOpen = document.getElementById('wallet_withdraw')
const regButton = document.getElementById('register_info-modal')
const withModal = document.getElementById('withdraw_modal')
const withClose = document.getElementById('with_modalClose')

if(withOpen){
  withOpen.addEventListener('click',(e)=>{
    withModal.style.display = 'block'
  })
  withClose.addEventListener('click', (e)=>{
    withModal.style.display = 'none'
  })
  window.onclick = function(event) {
    if (event.target == withModal) {
      withModal.style.display = "none";
    }
  }
}
if(regButton && regButton.style.display == 'block'){
  withClose.addEventListener('click', (e)=>{
    regButton.style.display = 'none'
  })
  window.onclick = function(event) {
    if (event.target == regButton) {
      regButton.style.display = "none";
    }
  }
}

function transall(){
  console.log('[hi')
  const transrows = document.querySelectorAll('.transactions-row')

  document.querySelector('.trans_error').style.display = 'none'
  transrows.forEach(function(transrow) {    
      transrow.style.display = 'table-row';
      transsDisplayed = true;
  });
}

const adminDepo = document.getElementById('admin_all_depo')
const adminSub = document.getElementById('admin_all_subscribe')
const adminWith = document.getElementById('admin_all_withdraw')
const adminCheck = document.getElementById('admin_all_check')

if(adminDepo){
  adminDepo.addEventListener('click', (e)=>{
    adminDepo.classList.add('transaction_tabs_back')
    adminSub.classList.remove('transaction_tabs_back')
    adminWith.classList.remove('transaction_tabs_back')
    adminCheck.classList.remove('transaction_tabs_back')
  })
  adminSub.addEventListener('click', (e)=>{
    adminDepo.classList.remove('transaction_tabs_back')
    adminSub.classList.add('transaction_tabs_back')
    adminWith.classList.remove('transaction_tabs_back')
    adminCheck.classList.remove('transaction_tabs_back')
  })
  adminWith.addEventListener('click', (e)=>{
    adminDepo.classList.remove('transaction_tabs_back')
    adminSub.classList.remove('transaction_tabs_back')
    adminWith.classList.add('transaction_tabs_back')
    adminCheck.classList.remove('transaction_tabs_back')
  })
  adminCheck.addEventListener('click', (e)=>{
    adminDepo.classList.remove('transaction_tabs_back')
    adminSub.classList.remove('transaction_tabs_back')
    adminWith.classList.remove('transaction_tabs_back')
    adminCheck.classList.add('transaction_tabs_back')
  })
}

const adminTabs = document.querySelector('.admin_tabs-container')

if(adminTabs){
  const adminDash = document.getElementById('admin_side-dash')
  const adminUsers = document.getElementById('admin_side-users')
  const adminBusiness = document.getElementById('admin_side-business')
  const adminProf = document.getElementById('admin_side-prof')
  const adminUpload = document.getElementById('admin_side-uploads')
  const adminApprove = document.getElementById('admin_side-approve')
  const adminKyc = document.getElementById('admin_side-kyc')
  const adminAdvert = document.getElementById('admin_side-advert')
  const adminNews = document.getElementById('admin_side-news')
  const adminCategory = document.getElementById('admin_side-category')
  const adminSettings = document.getElementById('admin_side-settings')
  const adminDashSection = document.getElementById('admin_dashboard_section')
  const adminUserSection = document.getElementById('admin_users_section')
  const adminBusSection = document.getElementById('admin_business_section')
  const adminProfSection = document.getElementById('admin_prof_section')
  const adminApproveSection = document.getElementById('admin_approve_section')
  const adminKycSection = document.getElementById('admin_kyc_verification')
  const admiAdsSection = document.getElementById('admin_ads_section')
  const adminNewsSection = document.getElementById('admin_news_section')
  const adminCategorySection = document.getElementById('category_section')
  const adminSettingSection = document.getElementById('setting_section')
  const adminUploadsSection  = document.getElementById('admin_uploads_section')

  adminUsers.addEventListener('click',(e)=>{
    adminUsers.classList.add('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminCategory.classList.remove('transaction_back')
    adminUserSection.style.display = 'block'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'none'
    adminNewsSection.style.display = 'none'
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'none'
    adminUploadsSection.style.display = 'none'
  })
  adminBusiness.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminBusiness.classList.add('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'block'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'none'
    adminNewsSection.style.display = 'none'
    adminCategory.classList.remove('transaction_back')
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'none'
    adminUploadsSection.style.display = 'none'
  })
  adminProf.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.add('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'block'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'none'
    adminNewsSection.style.display = 'none'
    adminCategory.classList.remove('transaction_back')
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'none'
    adminUploadsSection.style.display = 'none'
  })
  adminKyc.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.add('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'block'
    admiAdsSection.style.display = 'none'
    adminNewsSection.style.display = 'none'
    adminCategory.classList.remove('transaction_back')
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'none'
    adminUploadsSection.style.display = 'none'
  })
  adminApprove.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.add('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'block'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'none'
    adminNewsSection.style.display = 'none'
    adminCategory.classList.remove('transaction_back')
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'none'
    adminUploadsSection.style.display = 'none'
  })
  adminAdvert.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.add('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'block'
    adminNewsSection.style.display = 'none'
    adminCategory.classList.remove('transaction_back')
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'none'
    adminUploadsSection.style.display = 'none'
  })
  adminNews.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.add('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'none'
    adminNewsSection.style.display = 'block'
    adminCategory.classList.remove('transaction_back')
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'none'
    adminUploadsSection.style.display = 'none'
  })
  adminCategory.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminCategory.classList.add('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'none'
    adminNewsSection.style.display = 'none'
    adminCategorySection.style.display = 'block'
    adminSettingSection.style.display = 'none'
    adminUploadsSection.style.display = 'none'
  })
  adminSettings.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminSettings.classList.add('transaction_back')
    adminCategory.classList.remove('transaction_back')
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'none'
    adminNewsSection.style.display = 'none'
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'block'
    adminUploadsSection.style.display = 'none'
  })
  adminDash.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.add('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'block'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'none'
    adminCategory.classList.remove('transaction_back')
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'none'
    adminUploadsSection.style.display = 'none'
  })
  adminUpload.addEventListener('click',(e)=>{
    adminUsers.classList.remove('transaction_back')
    adminDash.classList.remove('transaction_back')
    adminUpload.classList.add('transaction_back')
    adminBusiness.classList.remove('transaction_back')
    adminProf.classList.remove('transaction_back')
    adminApprove.classList.remove('transaction_back')
    adminKyc.classList.remove('transaction_back')
    adminAdvert.classList.remove('transaction_back')
    adminNews.classList.remove('transaction_back')
    adminSettings.classList.remove('transaction_back')
    adminUploadsSection.style.display = 'block'
    adminUserSection.style.display = 'none'
    adminDashSection.style.display = 'none'
    adminBusSection.style.display = 'none'
    adminProfSection.style.display = 'none'
    adminApproveSection.style.display = 'none'
    adminKycSection.style.display = 'none'
    admiAdsSection.style.display = 'none'
    adminCategory.classList.remove('transaction_back')
    adminCategorySection.style.display = 'none'
    adminSettingSection.style.display = 'none'
  })
}

function changeFeatured(uploadId){
  fetch(`/update-featured-ad/${uploadId}`)
  window.location.reload()
}

const goTo = document.getElementById('go_to_settings')
if(goTo){
  goTo.addEventListener('click', (e)=>{
    document.getElementById('settings').click();
    withModal.style.display = 'none'
  })
}

function register() {
  document.getElementById('register_info-modal').style.display = 'block';
  document.getElementById('withdraw_modal_content').style.display = 'block';
  document.getElementById('select_paymemt-modal').style.display = 'none';
}

function showPaymentSelect(){
  document.querySelector('.withdraw_modal_content').style.display = 'none'
  document.getElementById('select_paymemt-modal').style.display = 'block'
}

function closeSelect(){
  document.getElementById('register_info-modal').style.display = 'none';
}

const busseven =  document.getElementById('dash_busseven')
const busfourt =  document.getElementById('dash_busfourt')
const busthirt =  document.getElementById('dash_busthirt')
const busall =  document.getElementById('all_busdays')

if(busall){
  busseven.addEventListener('click', (e) => {
    busseven.classList.add('transaction_tabs_back')
    busfourt.classList.remove('transaction_tabs_back')
    busthirt.classList.remove('transaction_tabs_back')
    busall.classList.remove('transaction_tabs_back')
    fetch('/user-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const busCount7 = data.busCount7;
            const tableBody = document.querySelector('#user-business-body');
            tableBody.innerHTML = ''; // Clear existing content
            busCount7.forEach(userData => {
                const newRow = `
                    <tr>
                        <td>
                            <div class="user_details_container">
                                <div class="user_details_container_logo">
                                    <img src="/storage/users-avatar/${userData.avatar}" alt="">
                                </div>
                                <div>
                                    <p class="user_details_name">${userData.name}</p>
                                    <p class="user_details_email">${userData.email}</p>
                                </div>
                            </div>
                        </td>
                        <td>${userData.kyc_status === 'not verified' ? '<p class="kyc_not_verified">not verified</p>' : '<p class="kyc_verified">verified</p>'}</td>
                        <td>${userData.business.subscription.charAt(0).toUpperCase() + userData.business.subscription.slice(1)}</td>
                        <td>${userData.business.verification_badge.charAt(0).toUpperCase() + userData.business.verification_badge.slice(1)}</td>
                        <td>${userData.telephone}</td>
                        <td>${userData.address}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
              });

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
  });
  busfourt.addEventListener('click', (e) => {
    busseven.classList.remove('transaction_tabs_back')
    busfourt.classList.add('transaction_tabs_back')
    busthirt.classList.remove('transaction_tabs_back')
    busall.classList.remove('transaction_tabs_back')
    fetch('/user-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const busCount14 = data.busCount14;
            const tableBody = document.querySelector('#user-business-body');
            tableBody.innerHTML = ''; // Clear existing content
            busCount14.forEach(userData => {
                const newRow = `
                    <tr>
                        <td>
                            <div class="user_details_container">
                                <div class="user_details_container_logo">
                                    <img src="/storage/users-avatar/${userData.avatar}" alt="">
                                </div>
                                <div>
                                    <p class="user_details_name">${userData.name}</p>
                                    <p class="user_details_email">${userData.email}</p>
                                </div>
                            </div>
                        </td>
                        <td>${userData.kyc_status === 'not verified' ? '<p class="kyc_not_verified">not verified</p>' : '<p class="kyc_verified">verified</p>'}</td>
                        <td>${userData.business.subscription.charAt(0).toUpperCase() + userData.business.subscription.slice(1)}</td>
                        <td>${userData.business.verification_badge.charAt(0).toUpperCase() + userData.business.verification_badge.slice(1)}</td>
                        <td>${userData.telephone}</td>
                        <td>${userData.address}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
              });

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
  });
  busthirt.addEventListener('click', (e) => {
    busseven.classList.remove('transaction_tabs_back')
    busfourt.classList.remove('transaction_tabs_back')
    busthirt.classList.add('transaction_tabs_back')
    busall.classList.remove('transaction_tabs_back')
    fetch('/user-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const busCount30 = data.busCount31;
            const tableBody = document.querySelector('#user-business-body');
            tableBody.innerHTML = ''; // Clear existing content
            busCount30.forEach(userData => {
                const newRow = `
                    <tr>
                        <td>
                            <div class="user_details_container">
                                <div class="user_details_container_logo">
                                    <img src="/storage/users-avatar/${userData.avatar}" alt="">
                                </div>
                                <div>
                                    <p class="user_details_name">${userData.name}</p>
                                    <p class="user_details_email">${userData.email}</p>
                                </div>
                            </div>
                        </td>
                        <td>${userData.kyc_status === 'not verified' ? '<p class="kyc_not_verified">not verified</p>' : '<p class="kyc_verified">verified</p>'}</td>
                        <td>${userData.business.subscription.charAt(0).toUpperCase() + userData.business.subscription.slice(1)}</td>
                        <td>${userData.business.verification_badge.charAt(0).toUpperCase() + userData.business.verification_badge.slice(1)}</td>
                        <td>${userData.telephone}</td>
                        <td>${userData.address}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
              });

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
  });
  busall.addEventListener('click', (e) => {
    busseven.classList.remove('transaction_tabs_back')
    busfourt.classList.remove('transaction_tabs_back')
    busthirt.classList.remove('transaction_tabs_back')
    busall.classList.add('transaction_tabs_back')
    fetch('/user-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const busCount = data.busCount;
            const tableBody = document.querySelector('#user-business-body');
            tableBody.innerHTML = ''; // Clear existing content
            busCount.forEach(userData => {
                const newRow = `
                    <tr>
                        <td>
                            <div class="user_details_container">
                                <div class="user_details_container_logo">
                                    <img src="/storage/users-avatar/${userData.avatar}" alt="">
                                </div>
                                <div>
                                    <p class="user_details_name">${userData.name}</p>
                                    <p class="user_details_email">${userData.email}</p>
                                </div>
                            </div>
                        </td>
                        <td>${userData.kyc_status === 'not verified' ? '<p class="kyc_not_verified">not verified</p>' : '<p class="kyc_verified">verified</p>'}</td>
                        <td>${userData.business.subscription.charAt(0).toUpperCase() + userData.business.subscription.slice(1)}</td>
                        <td>${userData.business.verification_badge.charAt(0).toUpperCase() + userData.business.verification_badge.slice(1)}</td>
                        <td>${userData.telephone}</td>
                        <td>${userData.address}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
              });

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
  });
}


const usseven =  document.getElementById('dash_usseven')
const usfourt =  document.getElementById('dash_usfourt')
const usthirt =  document.getElementById('dash_usthirt')
const usall =  document.getElementById('all_usdays')

if(usall){
  usseven.addEventListener('click', (e) => {
    usseven.classList.add('transaction_tabs_back')
    usfourt.classList.remove('transaction_tabs_back')
    usthirt.classList.remove('transaction_tabs_back')
    usall.classList.remove('transaction_tabs_back')
    fetch('/user-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const usCount7 = data.usCount7;
            const tableBody = document.querySelector('#user-table-body');
            tableBody.innerHTML = ''; // Clear existing content
            usCount7.forEach(userData => {
                const newRow = `
                    <tr>
                        <td>
                            <div class="user_details_container">
                                <div class="user_details_container_logo">
                                    <img src="/storage/users-avatar/${userData.avatar}" alt="">
                                </div>
                                <div>
                                    <p class="user_details_name">${userData.name}</p>
                                    <p class="user_details_email">${userData.email}</p>
                                </div>
                            </div>
                        </td>
                        <td>${userData.kyc_status === 'not verified' ? '<p class="kyc_not_verified">not verified</p>' : '<p class="kyc_verified">verified</p>'}</td>
                        <td>${userData.business.subscription.charAt(0).toUpperCase() + userData.business.subscription.slice(1)}</td>
                        <td>${userData.business.verification_badge.charAt(0).toUpperCase() + userData.business.verification_badge.slice(1)}</td>
                        <td>${userData.telephone}</td>
                        <td>${userData.address}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
              });

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
  });
  usfourt.addEventListener('click', (e) => {
    usseven.classList.remove('transaction_tabs_back')
    usfourt.classList.add('transaction_tabs_back')
    usthirt.classList.remove('transaction_tabs_back')
    usall.classList.remove('transaction_tabs_back')
    fetch('/user-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const usCount14 = data.usCount14;
            const tableBody = document.querySelector('#user-table-body');
            tableBody.innerHTML = ''; // Clear existing content
            usCount14.forEach(userData => {
                const newRow = `
                    <tr>
                        <td>
                            <div class="user_details_container">
                                <div class="user_details_container_logo">
                                    <img src="/storage/users-avatar/${userData.avatar}" alt="">
                                </div>
                                <div>
                                    <p class="user_details_name">${userData.name}</p>
                                    <p class="user_details_email">${userData.email}</p>
                                </div>
                            </div>
                        </td>
                        <td>${userData.kyc_status === 'not verified' ? '<p class="kyc_not_verified">not verified</p>' : '<p class="kyc_verified">verified</p>'}</td>
                        <td>${userData.telephone}</td>
                        <td>${userData.address}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
              });

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
  });
  usthirt.addEventListener('click', (e) => {
    usseven.classList.remove('transaction_tabs_back')
    usfourt.classList.remove('transaction_tabs_back')
    usthirt.classList.add('transaction_tabs_back')
    usall.classList.remove('transaction_tabs_back')
    fetch('/user-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const usCount30 = data.usCount31;
            const tableBody = document.querySelector('#user-table-body');
            tableBody.innerHTML = ''; // Clear existing content
            usCount30.forEach(userData => {
                const newRow = `
                    <tr>
                        <td>
                            <div class="user_details_container">
                                <div class="user_details_container_logo">
                                    <img src="/storage/users-avatar/${userData.avatar}" alt="">
                                </div>
                                <div>
                                    <p class="user_details_name">${userData.name}</p>
                                    <p class="user_details_email">${userData.email}</p>
                                </div>
                            </div>
                        </td>
                        <td>${userData.kyc_status === 'not verified' ? '<p class="kyc_not_verified">not verified</p>' : '<p class="kyc_verified">verified</p>'}</td>
                        <td>${userData.telephone}</td>
                        <td>${userData.address}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
              });

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
  });
  usall.addEventListener('click', (e) => {
    usseven.classList.remove('transaction_tabs_back')
    usfourt.classList.remove('transaction_tabs_back')
    usthirt.classList.remove('transaction_tabs_back')
    usall.classList.add('transaction_tabs_back')
    fetch('/user-days')
        .then(response => response.json())
        .then(data => {
            // Access the specific data you need
            const usCount = data.usCount;
            const tableBody = document.querySelector('#user-table-body');
            tableBody.innerHTML = ''; // Clear existing content
            usCount.forEach(userData => {
                const newRow = `
                    <tr>
                        <td>
                            <div class="user_details_container">
                                <div class="user_details_container_logo">
                                    <img src="/storage/users-avatar/${userData.avatar}" alt="">
                                </div>
                                <div>
                                    <p class="user_details_name">${userData.name}</p>
                                    <p class="user_details_email">${userData.email}</p>
                                </div>
                            </div>
                        </td>
                        <td>${userData.kyc_status === 'not verified' ? '<p class="kyc_not_verified">not verified</p>' : '<p class="kyc_verified">verified</p>'}</td>
                        <td>${userData.telephone}</td>
                        <td>${userData.address}</td>
                    </tr>
                `;
                tableBody.insertAdjacentHTML('beforeend', newRow);
              });

        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
  });
}

function openNotification(){
  document.getElementById('topsection').style.position = 'sticky'
  document.getElementById('topsection').style.top = '0'
  document.getElementById('topsection').style.zIndex = '10'
  document.getElementById('notification-side').style.display = 'block'

  window.addEventListener('click', function(event) {
      if (!document.getElementById('notification-side').contains(event.target) && !document.querySelector('.not-container').contains(event.target)) {
        document.getElementById('notification-side').style.display = 'none';
        document.getElementById('topsection').style.position = 'relative'
        document.getElementById('notification-side').style.display = 'none'
          console.log('hi')
      }
  });
}


function closeNotification(){
  document.getElementById('topsection').style.position = 'relative'
  document.getElementById('notification-side').style.display = 'none'
}


function markAsRead(notificationId) {

  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    // Assuming you're making an AJAX request to update the notification status
    // Modify this code according to your backend implementation
    fetch('/mark-as-read/' + notificationId, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
    })
}

function openUploadEdit(uploadId){
  document.getElementById('edit_upload-container').style.display = 'block'
  var csrfToken = $('meta[name="csrf-token"]').attr('content');

  $.ajax({
    url: '/editUpload/' + uploadId,
    type: 'POST',
    headers: {
      'X-CSRF-TOKEN': csrfToken 
    },
    success: function(response) {
      $('input[name="title_edit"]').val(response.title);
      $('input[name="category_edit"]').val(response.category);
      $('input[name="start_date_edit"]').val(response.start_date);
      $('input[name="end_date_edit"]').val(response.end_date);
      $('input[name="price_edit"]').val(response.price);
      $('select[name="country_edit"]').val(response.country);
      $('input[name="address_edit"]').val(response.address);
      // $('textarea[name="description_edit"]').val(response.description);
      tinymce.get('rte-editor-two').setContent(response.description);
      var formAction = '/updateUpload/' + response.id; 
      $('#edit_upload-form').attr('action', formAction);
      var imageUrl = baseUrl + '/' + response.featured_image;
      $('#featuredDivs').css('background-image', 'url("' + imageUrl + '")');

      
    },
    error: function(xhr, status, error) {
      console.error('Error fetching post information:', error);
    }
  });
}
function closeUploadEdit(){
  document.getElementById('edit_upload-container').style.display = 'none'
}

function showFile(){
  document.getElementById('material_filename').style.display = 'none'
  document.getElementById('material').style.width = '100%'
  document.getElementById('material').style.overflow = 'none'
}

function readnotify(){
  document.getElementById('readnotifications').style.display = 'block'
  document.getElementById('read_button').classList.add('not_active')
  document.getElementById('unread_button').classList.remove('not_active')
  document.getElementById('unreadnotifications').style.display = 'none'
}
function unreadnotify(){
  document.getElementById('readnotifications').style.display = 'none'
  document.getElementById('read_button').classList.remove('not_active')
  document.getElementById('unread_button').classList.add('not_active')
  document.getElementById('unreadnotifications').style.display = 'block'
}

function showDashMenu() {
  var menuDropdown = document.querySelector('.menu_dropdown');
  var dashMore = document.getElementById('dash_more');

  menuDropdown.style.display = 'flex'

  // Close the menu dropdown when clicking outside of it
  window.addEventListener('click', function(event) {
    if (!menuDropdown.contains(event.target) && !dashMore.contains(event.target)) {
        menuDropdown.style.display = "none";
        console.log('hi')
    }
  });
}

function selectStanPlan(){
  document.querySelector('.select_box').style.display = 'none'
  document.getElementById('select_icon').style.display = 'block'
  document.querySelector('.select_box_two').style.display = 'block'
  document.getElementById('select_icon_two').style.display = 'none'
  document.getElementById('plan-show-price').textContent = document.getElementById('stanPlanPrice').textContent

  setTimeout((e) => {
    document.getElementById('select_paymemt-modal').style.display = 'block'
  }, 1000);
}
function selectEntPlan(){
  document.querySelector('.select_box_two').style.display = 'none'
  document.getElementById('select_icon_two').style.display = 'block'
  if(document.querySelector('.stan_plan_container')){
    document.querySelector('.select_box').style.display = 'block'
    document.getElementById('select_icon').style.display = 'none'
  }
  document.getElementById('plan-ent-show-price').textContent = document.getElementById('entPlanPrice').textContent

  setTimeout((e) => {
    document.getElementById('select_paymemt-modal_two').style.display = 'block'
  }, 1000);
}

function closePlanSelect(){
  document.querySelector('.select_box').style.display = 'block'
  document.getElementById('select_icon').style.display = 'none'
  document.getElementById('select_paymemt-modal').style.display = 'none';
}
function closePlanEntSelect(){
  document.querySelector('.select_box_two').style.display = 'block'
  document.querySelector('#select_icon_two').style.display = 'none'
  document.getElementById('select_paymemt-modal_two').style.display = 'none';
}
function closeAdPlanSelect(){
  document.getElementById('ad_paymemt-modal').style.display = 'none';
}

function payPlan(email) {
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  const amount =  document.getElementById('stanPlanPrice').textContent
  const numericPrice = parseFloat(amount.replace(/[^\d.]/g, ''));
  const oneamount= numericPrice * 0.03*100;
  const totamount= numericPrice * 100;
  const finamount= oneamount + totamount;
  const planType = 'standard listing';

  let paystack = PaystackPop.setup({
      key: 'pk_live_34cf0528cd04ac9d4f4675db08bf427bfa1509ad',
      email: email,
      amount: finamount,
      ref: '' + Math.floor((Math.random() * 1000000000) + 1),

      callback: function (response) {
          let reference = response.reference;

          $.ajax({
              type: "POST",
              url: subscriptionUrl + '/' + reference,
              headers: {
                  'X-CSRF-TOKEN': csrfToken 
              },
              data: {
                  reference: reference ,
                  amount: numericPrice,
                  planType: planType
              },
              success: function (response) {
                  console.log('hi');
                  window.location.reload(); // Added parentheses to execute the function
                  if (response[0].status == true) {
                  }
              },
              error: function (xhr, status, error) {
                  console.error(xhr.responseText); // Log any errors to the console
              }
          });

      },

      onClose: function (response) {
          var div = document.createElement('div');
          div.style.zIndex = "9999";
          div.className = "alert alert-danger";
          div.innerHTML = `
              <div class="popup" id="error" style="display:block">
                  <div class="popup-content">
                      <div class="title">
                          <h3>Sorry :(</h3>
                      </div>
                      <p class="para">Payment Cancelled</p>
                      <div class="progress-container">
                          <div id="progress-bar"></div>
                      </div>
                  </div>
              </div>`;
          var fifthChild = document.body.children[3];
          document.body.insertBefore(div, fifthChild);

          $(document).ready(function () {
              $('#error').fadeIn();
              var timeout = 2000;
              var interval = 50;
              var numIntervals = timeout / interval;
              var progressStep = 100 / numIntervals;
              var progress = 0;
              var progressBar = $('#progress-bar');
              var progressInterval = setInterval(function () {
                  progress += progressStep;
                  progressBar.width(progress + '%');

                  if (progress >= 100) {
                      $('#error').fadeOut();
                      clearInterval(progressInterval);
                  }
              }, interval);
          });
          console.log(response)
          document.getElementById('register_info-modal').style.display = 'none'
      },

      // Removed the extra '}' here
  });

  paystack.openIframe();
}

function payWallet(id){
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  const amount =  document.getElementById('stanPlanPrice').textContent
  const numericPrice = parseFloat(amount.replace(/[^\d.]/g, ''));
  const reference = '' + Math.floor((Math.random() * 1000000000) + 1);
  const planType = 'standard listing';
  
  $.ajax({
    type: "POST",
    url: subscriptionWalletUrl + '/' + reference,
    headers: {
          'X-CSRF-TOKEN': csrfToken 
      },
      data: {
          reference: reference,
          id: id,
          amount: numericPrice,
          planType: planType
      },
      success: function (response) {
        console.log(response);
        window.location.reload(); 
          if (response[0].status == true) {
          }
      },
      error: function (xhr, status, error) {
          console.error(xhr.responseText); 
      }
  });
}
function payEntWallet(id){
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  const amount =  document.getElementById('entPlanPrice').textContent
  const numericPrice = parseFloat(amount.replace(/[^\d.]/g, ''));
  const reference = '' + Math.floor((Math.random() * 1000000000) + 1);
  const planType = 'enterprise listing';
  
  $.ajax({
    type: "POST",
    url: subscriptionWalletUrl + '/' + reference,
    headers: {
          'X-CSRF-TOKEN': csrfToken 
      },
      data: {
          reference: reference,
          id: id,
          amount: numericPrice,
          planType: planType
      },
      success: function (response) {
        console.log(response);
        window.location.reload(); 
          if (response[0].status == true) {
          }
      },
      error: function (xhr, status, error) {
          console.error(xhr.responseText); // Log any errors to the console
      }
  });
}


function payEntPlan(email) {
  var csrfToken = $('meta[name="csrf-token"]').attr('content');
  const amount =  document.getElementById('entPlanPrice').textContent
  const numericPrice = parseFloat(amount.replace(/[^\d.]/g, ''));
  const oneamount= numericPrice * 0.03*100;
  const totamount= numericPrice * 100;
  const finamount= oneamount + totamount;
  const planType = 'enterprise listing';
  console.log(finamount);

  let paystack = PaystackPop.setup({
      key: 'pk_live_34cf0528cd04ac9d4f4675db08bf427bfa1509ad',
      email: email,
      amount: finamount,
      ref: '' + Math.floor((Math.random() * 1000000000) + 1),

      callback: function (response) {
          let reference = response.reference;

          $.ajax({
              type: "POST",
              url: subscriptionUrl + '/' + reference,
              headers: {
                  'X-CSRF-TOKEN': csrfToken 
              },
              data: {
                  reference: reference, 
                  amount: numericPrice,
                  planType: planType
              },
              success: function (response) {
                  console.log(response);
                  window.location.reload(); // Added parentheses to execute the function
                  if (response[0].status == true) {
                  }
              },
              error: function (xhr, status, error) {
                  console.error(xhr.responseText); // Log any errors to the console
              }
          });

      },

      onClose: function (response) {
          var div = document.createElement('div');
          div.style.zIndex = "9999";
          div.className = "alert alert-danger";
          div.innerHTML = `
              <div class="popup" id="error" style="display:block">
                  <div class="popup-content">
                      <div class="title">
                          <h3>Sorry :(</h3>
                      </div>
                      <p class="para">Payment Cancelled</p>
                      <div class="progress-container">
                          <div id="progress-bar"></div>
                      </div>
                  </div>
              </div>`;
          var fifthChild = document.body.children[3];
          document.body.insertBefore(div, fifthChild);

          $(document).ready(function () {
              $('#error').fadeIn();
              var timeout = 2000;
              var interval = 50;
              var numIntervals = timeout / interval;
              var progressStep = 100 / numIntervals;
              var progress = 0;
              var progressBar = $('#progress-bar');
              var progressInterval = setInterval(function () {
                  progress += progressStep;
                  progressBar.width(progress + '%');

                  if (progress >= 100) {
                      $('#error').fadeOut();
                      clearInterval(progressInterval);
                  }
              }, interval);
          });
          console.log(response)
          document.getElementById('register_info-modal').style.display = 'none'
      },
  });

  paystack.openIframe();
}

const formSearch = document.getElementById('searchInput')

if(formSearch){
  document.getElementById('searchInput').addEventListener('input', (e)=>{
    document.getElementById('searchResultContainer').style.display = 'block'
  
    if (document.getElementById('searchInput').value.trim() === '') {
      document.getElementById('searchResultContainer').style.display = 'none'
    }
  })
  
  const eventsSearch = document.getElementById('evenText')
  const eventsBox = document.getElementById('eventsBoxResults')
  const trainSearch = document.getElementById('trainText')
  const trainBox = document.getElementById('searchBoxResults')
  const workSearch = document.getElementById('workText')
  const workBox = document.getElementById('workBoxResults')
  
  eventsSearch.addEventListener('click', (e)=>{
    eventsBox.style.display = 'grid'
    trainBox.style.display = 'none'
    trainSearch.classList.remove('search_back')
    eventsSearch.classList.add('search_back')
    workSearch.classList.remove('search_back')
    workBox.style.display = 'none'
  })
  trainSearch.addEventListener('click', (e)=>{
    eventsBox.style.display = 'none'
    trainBox.style.display = 'grid'
    workBox.style.display = 'none'
    trainSearch.classList.add('search_back')
    eventsSearch.classList.remove('search_back')
    workSearch.classList.remove('search_back')
  })
  workSearch.addEventListener('click', (e)=>{
    eventsBox.style.display = 'none'
    workBox.style.display = 'grid'
    trainBox.style.display = 'none'
    trainSearch.classList.remove('search_back')
    workSearch.classList.add('search_back')
    eventsSearch.classList.remove('search_back')
  })
}

function openAds(){
  document.querySelector('.ads-inner-section').style.display = 'block'
  document.querySelector('.not_running_ads').style.display = 'none'
  document.getElementById('allads').style.display = 'none'
}


function changePrice(){
  const topBanner = document.getElementById('top_banner')
  const promotedBanner = document.getElementById('promoted_banner')
  const inpageBanner = document.getElementById('inpage_banner')
  const sideBanner = document.getElementById('side_banner')
  const selectedAd = document.getElementById('selected_ad')
  const adPrice = document.getElementById('selected_ad_price')

  if(topBanner.checked){
    selectedAd.value = document.querySelector('.top-banner').textContent;
    adPrice.textContent = document.querySelector('.top-banner').textContent
  } else if(promotedBanner.checked){
    selectedAd.value = document.querySelector('.promoted-banner').textContent;
    adPrice.textContent = document.querySelector('.promoted-banner').textContent
  }else if(inpageBanner.checked){
    selectedAd.value = document.querySelector('.homepage-banner').textContent
    adPrice.textContent = document.querySelector('.homepage-banner').textContent
  }else if(sideBanner.checked){
    selectedAd.value = document.querySelector('.inpage-banner').textContent
    adPrice.textContent = document.querySelector('.inpage-banner').textContent
  }
}

function openAdPayment(){
  document.getElementById('ad_paymemt-modal').style.display = 'block'
}


function countClick(event){
  var adId = event.target.id;
  console.log(adId)
  var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  fetch('/click', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken 
      },
      body: JSON.stringify({
          ad_id: adId
      })
  })
  .then(response => {
      if (!response.ok) {
          throw new Error('Network response was not ok');
      }
      // console.log('Click recorded successfully');
  })
  .catch(error => {
      // console.error('Error recording click:', error);
  });
}

function nextSection(){
  var radios = document.getElementsByName('feature_type');
  var error = document.getElementById('error-option');
  var radioSelected = false;

  for (var i = 0; i < radios.length; i++) {
    if (radios[i].checked) {
      radioSelected = true;
      break;
    }
  }

  const businessInput = document.querySelector('input[value="business"]');
  const tutorInput = document.querySelector('input[value="tutor"]');
  if (businessInput && businessInput.checked || tutorInput && tutorInput.checked) {
      openFeaturePay();
      return;
  }

  if (!radioSelected) {
    error.style.display = 'block';
  } else {
    error.style.display = 'none';
    document.getElementById('first-choose-section').style.display = 'none'
    document.getElementById('next_section').style.display = 'grid'
    document.getElementById('backIcon').style.display = 'contents'
  }
}
function backSection(){
  document.getElementById('first-choose-section').style.display = 'block'
  document.getElementById('next_section').style.display = 'none'
  document.getElementById('backIcon').style.display = 'none'
  document.getElementById('fin-proc').style.display = 'none'
}

const radios = document.querySelectorAll('input[name="feature_type"]');
const contents = document.querySelectorAll('.events_select');


radios.forEach(radio => {
    radio.addEventListener('change', () => {      
        const selectedType = document.querySelector('input[name="feature_type"]:checked').value;
        fetch(`/getFeaturePrice?type=${selectedType}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('selected_upload_price').value = data.feature_price;
            document.getElementById('selected_feature_price').textContent = data.feature_price;
            console.log(document.getElementById('selected_feature_price'))
        })
        .catch(error => console.error('Error fetching feature price:', error));
        var error = document.getElementById('error-option');
        error.style.display = 'none';
        // Hide all content divs
        contents.forEach(content => {
            content.style.display = 'none';
        });

        const selectedContents = document.querySelectorAll(`.events_select[data-type="${selectedType}"]`);
        selectedContents.forEach(content => {
            content.style.display = 'flex';
        });
    });
});

function showButton(){
  document.getElementById('fin-proc').style.display = 'flex'
}

function openFeaturePay(){
  document.getElementById('feature_paymemt-modal').style.display = 'block'
}


function showParticipantsInput(courseId, participantCount, reference) {
  let participantFormHtml = '';
  participantFormHtml += `<input type="hidden" name="_token" value="{{ csrf_token() }}" />`; // Added CSRF token input field
  participantFormHtml += `<input type="hidden" name="reference" value="${reference}" />`
  for (let i = 0; i < participantCount; i++) {
      participantFormHtml += `
          <div class="participant_container">
              <label for="participant${i + 1}">Participant ${i + 1} Name</label>
              <input type="text" class="participant_input" id="participant${i + 1}" name="participants[]">
          </div>
      `;
  }
  participantFormHtml += `
      <button type="submit" class="participant_button">Get Certificate</button>
  `;
  document.getElementById('participant-form').innerHTML = participantFormHtml;
  document.getElementById('participant-form').action = '/cert-host/' + courseId;
  console.log(document.getElementById('participant-form').action);
  console.log(courseId)
}
function createCertificate(courseId) {
  let participantFormHtml = '';
  participantFormHtml += `<input type="hidden" name="_token" value="{{ csrf_token() }}" />`;
      participantFormHtml += `
          <div class="participant_container">
              <label>Host Name</label>
              <input type="text" class="participant_input" name="host_name">
          </div>
          <div class="certificate-grid">
          <div class="participant_container">
          <label>Upload Host Logo</label>
          <input type="file" class="" name="host_logo">
          </div>
          <div class="participant_container">
              <label>Upload Signature(png only)</label>
              <input type="file" class="" accept=".png" name="host_signature">
          </div>
          
          </div>
      `;
  participantFormHtml += `
      <button type="submit" class="participant_button">Create Certificate</button>
  `;
  document.getElementById('certificate-form').innerHTML = participantFormHtml;
  document.getElementById('certificate-form').action = '/create-certificate/' + courseId;
  console.log(document.getElementById('certificate-form').action);
  console.log(courseId)
}

function openUpload(){
  document.getElementById('uploading').click();
}

function redirectPage(){
  window.location.href = '/'
}

const certi = document.getElementById('certificateModal')

if(certi){
  if(document.getElementById('certificateModal').style.display == 'block'){
    console.log('show')
    const certFormShow = document.getElementById('cert-show')
    const certForm = document.getElementById('certsearchForm')
    window.addEventListener('click', function(event) {
      if (!certFormShow.contains(event.target) && !certForm.contains(event.target)) {
        document.getElementById('certificateModal').style.display = "none";
          console.log('hi')
      }
    });
  }
}

// function createSection() {
//   var numSections = document.getElementById("course_duration").value;
//   var container = document.getElementById("container");
  
//   // Clear previous content
//   container.innerHTML = "";

//   // Create new section containers
//   for (var i = 0; i < numSections; i++) {
//       var sectionContainer = document.createElement("div");
//       sectionContainer.classList.add("section_container");

//       var label = document.createElement("label");
//       label.textContent = "Section " + (i + 1);

//       var sectionInputs = document.createElement("div");
//       sectionInputs.classList.add("section_inputs");

//       var sectionTitleInput = document.createElement("input");
//       sectionTitleInput.type = "text";
//       sectionTitleInput.placeholder = "Section Title";

//       var addButton = document.createElement("button");
//       addButton.textContent = "Add Video+";

//       // Append elements to section container
//       sectionInputs.appendChild(sectionTitleInput);
//       sectionInputs.appendChild(addButton);
//       sectionContainer.appendChild(label);
//       sectionContainer.appendChild(sectionInputs);

//       container.appendChild(sectionContainer);
//   }
// }
// function createSection() {
//   var numSections = document.getElementById("course_duration").value;
//   var container = document.getElementById("container");
  
//   // Clear previous content
//   container.innerHTML = "";

//   // Create new section containers
//   for (var i = 0; i < numSections; i++) {
//     var sectionContainer = document.createElement("div");
//     sectionContainer.classList.add("section_container");
    
//     var label = document.createElement("label");
//     label.textContent = "Section " + (i + 1);
    
//     var sectionInputs = document.createElement("div");
//     sectionInputs.classList.add("section_inputs");
    
//     var closeButton = document.createElement("i");
//     closeButton.classList.add("fas", "fa-times", "close-button");
//     closeButton.addEventListener("click", function(event) {
//         sectionContainer.remove();
//         event.stopPropagation(); // Stop propagation only for closing the current section
//     });

//       var sectionTitleInput = document.createElement("input");
//       sectionTitleInput.type = "text";
//       sectionTitleInput.placeholder = "Section Title";

//       var addButton = document.createElement("button");
//       addButton.textContent = "Add Video+";
//       addButton.type = 'button'
//       addButton.addEventListener("click", function(event) {
//           var videoInputs = document.createElement("div");
//           videoInputs.classList.add("section_video_inputs");

//           var closeButton = document.createElement("i");
//           closeButton.classList.add("fas", "fa-times", "close-button");
//           closeButton.addEventListener("click", function() {
//               videoInputs.remove();
//               event.stopPropagation(); // Stop propagation to prevent closing the section
//           });

//           var videoTitleInput = document.createElement("input");
//           videoTitleInput.type = "text";
//           videoTitleInput.placeholder = "Video Title";

//           var fileInput = document.createElement("input");
//           fileInput.type = "file";
//           fileInput.name = "video_file[]";

//           videoInputs.appendChild(closeButton);
//           videoInputs.appendChild(videoTitleInput);
//           videoInputs.appendChild(fileInput);

//           sectionContainer.appendChild(videoInputs);
//           console.log('hi')
//       });

//       // Append elements to section container
//       sectionInputs.appendChild(closeButton);
//       sectionInputs.appendChild(sectionTitleInput);
//       sectionInputs.appendChild(addButton);
//       sectionContainer.appendChild(label);
//       sectionContainer.appendChild(sectionInputs);

//       container.appendChild(sectionContainer);
//   }
// }

// function createSection() {
//   var numSections = document.getElementById("course_duration").value;
//   var container = document.getElementById("container");
  
//   // Clear previous content
//   container.innerHTML = "";

//   // Create new section containers
//   for (var i = 0; i < numSections; i++) {
//       var sectionContainer = document.createElement("div");
//       sectionContainer.classList.add("section_container");
      
//       var label = document.createElement("label");
//       label.textContent = "Section " + (i + 1);
      
//       var sectionInputs = document.createElement("div");
//       sectionInputs.classList.add("section_inputs");
      
//       var closeButton = document.createElement("i");
//       closeButton.classList.add("fas", "fa-times", "close-button");
//       closeButton.addEventListener("click", function() {
//           this.parentNode.parentNode.remove(); // Remove the grandparent of the close button
//           renumberSections();
//       });

//       var sectionTitleInput = document.createElement("input");
//       sectionTitleInput.type = "text";
//       sectionTitleInput.placeholder = "Section Title";
//       sectionTitleInput.name = "section_title[]"

//       var addButton = document.createElement("button");
//       addButton.textContent = "Add Video+";
//       addButton.type = 'button'
//       addButton.addEventListener("click", function(event) {
//           var videoInputs = document.createElement("div");
//           videoInputs.classList.add("section_video_inputs");
      
//           var closeButton = document.createElement("i");
//           closeButton.classList.add("fas", "fa-times", "close-button");
//           closeButton.addEventListener("click", function() {
//               this.parentNode.remove(); // Remove the parent of the close button
//           });
      
//           var videoTitleInput = document.createElement("input");
//           videoTitleInput.type = "text";
//           videoTitleInput.name = 'video_name[]'
//           videoTitleInput.placeholder = "Video Title";
      
//           var fileInput = document.createElement("input");
//           fileInput.type = "file";
//           fileInput.name = "video_file[]";
      
//           videoInputs.appendChild(closeButton);
//           videoInputs.appendChild(videoTitleInput);
//           videoInputs.appendChild(fileInput);
      
//           // Find the grandparent element of the clicked button and append videoInputs to it
//           var grandParent = this.parentNode.parentNode;
//           grandParent.appendChild(videoInputs);
//       });

//       // Append elements to section container
//       sectionInputs.appendChild(closeButton);
//       sectionInputs.appendChild(sectionTitleInput);
//       sectionInputs.appendChild(addButton);
//       sectionContainer.appendChild(label);
//       sectionContainer.appendChild(sectionInputs);

//       container.appendChild(sectionContainer);
//   }

//       // Function to renumber sections
//     function renumberSections() {
//       var sections = container.querySelectorAll(".section_container");
//       sections.forEach(function(section, index) {
//           section.querySelector("label").textContent = "Section " + (index + 1);
//       });
//     }

//     renumberSections();
// }


function createSection() {
  var numSections = document.getElementById("course_duration").value;
  var container = document.getElementById("container");
  
  // Clear previous content
  container.innerHTML = "";

  // Create new section containers
  for (var i = 0; i < numSections; i++) {
      var sectionId = "section_" + Date.now() + "_" + Math.floor(Math.random() * 1000); // Unique ID for section
      var sectionContainer = document.createElement("div");
      sectionContainer.classList.add("section_container");
      sectionContainer.id = sectionId;
      
      var label = document.createElement("label");
      label.textContent = "Section " + (i + 1);
      
      var sectionInputs = document.createElement("div");
      sectionInputs.classList.add("section_inputs");
      
      var closeButton = document.createElement("i");
      closeButton.classList.add("fas", "fa-times", "close-button");
      closeButton.addEventListener("click", function() {
          this.parentNode.parentNode.remove(); // Remove the grandparent of the close button
          renumberSections();
      });

      var sectionTitleInput = document.createElement("input");
      sectionTitleInput.type = "text";
      sectionTitleInput.placeholder = "Section Title";
      sectionTitleInput.name = "section_title[]"
      var sectionIdInput = document.createElement("input");
      sectionIdInput.type = "text";
      sectionIdInput.name = "sectionId[]";
      sectionIdInput.value = sectionContainer.id;
      sectionIdInput.hidden = true


      var addButton = document.createElement("button");
      addButton.textContent = "Add Video+";
      addButton.type = 'button'
      addButton.addEventListener("click", function(event) {
          var videoInputs = document.createElement("div");
          videoInputs.classList.add("section_video_inputs");
      
          var closeButton = document.createElement("i");
          closeButton.classList.add("fas", "fa-times", "close-button");
          closeButton.addEventListener("click", function() {
              this.parentNode.remove(); // Remove the parent of the close button
          });
      
          var videoTitleInput = document.createElement("input");
          videoTitleInput.type = "text";
          videoTitleInput.name = 'videos[' + this.parentNode.parentNode.id + '][video_name][]';         
          videoTitleInput.placeholder = "Video Title";
      
          var fileInput = document.createElement("input");
          fileInput.type = "file";
          fileInput.name = 'videos[' + this.parentNode.parentNode.id  + '][video_file][]';
      
          videoInputs.appendChild(closeButton);
          videoInputs.appendChild(videoTitleInput);
          videoInputs.appendChild(fileInput);
      
          // Find the grandparent element of the clicked button and append videoInputs to it
          var grandParent = this.parentNode.parentNode;
          grandParent.appendChild(videoInputs);
      });

      // Append elements to section container
      sectionInputs.appendChild(closeButton);
      sectionInputs.appendChild(sectionTitleInput);
      sectionInputs.appendChild(sectionIdInput);
      sectionInputs.appendChild(addButton);
      sectionContainer.appendChild(label);
      sectionContainer.appendChild(sectionInputs);

      container.appendChild(sectionContainer);
  }

  // Function to renumber sections
  function renumberSections() {
      var sections = container.querySelectorAll(".section_container");
      sections.forEach(function(section, index) {
          section.querySelector("label").textContent = "Section " + (index + 1);
      });
  }

  renumberSections();
}

function dropdownVideos(element) {
  // Check if the clicked element contains the class 'fa-chevron-down'
  if (element.classList.contains('fa-chevron-down')) {
    element.classList.remove('fa-chevron-down')
    element.classList.add('fa-chevron-up')
    element.parentNode.parentNode.querySelector('.course_section_videos').style.display = 'flex'
  }else{
    element.classList.add('fa-chevron-down')
    element.parentNode.parentNode.querySelector('.course_section_videos').style.display = 'none'
  }
}

function changeVideo(element) {
  const url = element.getAttribute('name');
  document.getElementById('mySource').src = url;
  // Refresh the video element to load the new source
  document.getElementById('myVideo').load();
  console.log('New video URL:', url);
}

const divs = document.querySelectorAll('.course_single_video_no');

if(divs){
  divs.forEach((div, index) => {
    const divNumber = index + 1;
    div.textContent = `${divNumber}`; 
});
}

function openCreateGroup(){
  document.getElementById('register_info-modal').style.display = 'block'

  window.addEventListener('click', function(event) {
      const modal = document.getElementById('withdraw_modal_content')
      const create = document.getElementById('header_button')
      if (!modal.contains(event.target) && !create.contains(event.target)) {
          console.log('hi')
          document.getElementById('register_info-modal').style.display = 'none'
      }
  });
}

// Events Filter

if(document.getElementById('currentYearMonth')){
  var currentDate = new Date();
  var currentYearFirst = currentDate.getFullYear();
  var currentMonth = currentDate.toLocaleString('default', { month: 'long' });
  
  document.getElementById('currentYearMonth').textContent = currentYearFirst + ' Events - showing event(s) for ' + currentMonth + ' ' + currentYearFirst;
  document.getElementById('prevYear').innerHTML = '<i class="fa-solid fa-angles-left"></i>' + (currentYearFirst - 1) + ' Events';
  document.getElementById('prevYear').setAttribute('data-year', currentYearFirst - 1);
  document.getElementById('nextYear').innerHTML = (currentYearFirst + 1) + ' Events' + '<i class="fa-solid fa-angles-right"></i>';
  document.getElementById('nextYear').setAttribute('data-year', currentYearFirst + 1);
  
  // Check if it's a workshop, event, or virtual event
  var isWorkshop = document.getElementById('currentYearMonth').classList.contains('workshop');
  var isVirtualEvent = document.getElementById('currentYearMonth').classList.contains('virtual');
  
  // Update the text content and route accordingly
  if (isWorkshop) {
      document.getElementById('currentYearMonth').textContent = currentYearFirst + ' Workshops - showing workshop(s) for ' + currentMonth + ' ' + currentYearFirst;
      document.getElementById('prevYear').innerHTML = '<i class="fa-solid fa-angles-left"></i>' + (currentYearFirst - 1) + ' Workshops';
      document.getElementById('prevYear').setAttribute('data-year', currentYearFirst - 1);
      document.getElementById('nextYear').innerHTML = (currentYearFirst + 1) + ' Workshops' + '<i class="fa-solid fa-angles-right"></i>';
      document.getElementById('nextYear').setAttribute('data-year', currentYearFirst + 1);
  } else if (isVirtualEvent) {
      document.getElementById('currentYearMonth').textContent = currentYearFirst + ' Virtual Program - showing virtual program(s) for ' + currentMonth + ' ' + currentYearFirst;
      document.getElementById('prevYear').innerHTML = '<i class="fa-solid fa-angles-left"></i>' + (currentYearFirst - 1) + ' Virtual Program';
      document.getElementById('prevYear').setAttribute('data-year', currentYearFirst - 1);
      document.getElementById('nextYear').innerHTML = (currentYearFirst + 1) + ' Virtual Program' + '<i class="fa-solid fa-angles-right"></i>';
      document.getElementById('nextYear').setAttribute('data-year', currentYearFirst + 1);
  }
  
}


let currentYear = new Date().getFullYear();
if(document.querySelectorAll('.month-link')){
  document.querySelectorAll('.month-link').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();

        var selectedMonth = this.getAttribute('data-month');
        var currentMonth = new Date(selectedMonth).toLocaleString('default', { month: 'long' });

        if(this.classList.contains('event')){
        document.getElementById('currentYearMonth').textContent = currentYear + ' Events - showing event(s) for ' + currentMonth + ' ' + currentYear;
        // console.log('event')
        fetch('/events/' + selectedMonth + '/' + currentYear)
        .then(response => response.json())
        .then(data => {
            var eventsContainer = document.querySelector('.events-container2');
            eventsContainer.innerHTML = '';

            if (Array.isArray(data.uploads)) {
                if (data.uploads.length === 0) {
                    eventsContainer.innerHTML = '<div style="position: absolute; left:50%; transform: translate(-50%)">No Events For this month</div>';
                } else {
                    data.uploads.forEach(upload => {
                        var eventHtml = '<div class="events">';
                        eventHtml += '<div class="event-image-container">';
                        eventHtml += '<img class="event-image" src="images/' + upload.featured_image + '" alt="">';
                        eventHtml += '</div>';
                        eventHtml += '<div class="event-title">' + upload.title + '</div>';
                        data.results.forEach(result => {
                            if (result.uploadId === upload.id) {
                                eventHtml += '<p class="event-date">' + result.date + '</p>';
                            }
                        });
                        if (upload.upload_type == "virtual-program") {
                            eventHtml += '<div class="event-location">' + upload.host_app + '</div>';
                        } else {
                            eventHtml += '<div class="event-location">' + upload.state + ' State, ' + upload.country + '</div>';
                        }
                        eventHtml += '<div class="company-logo-container">';
                        eventHtml += '<img class="event-image" src="storage/users-avatar/' + upload.users.avatar + '" alt="">';
                        if(upload.user.verification_badge  && upload.user.subscription == 'enterprise listing'){
                          eventHtml += '<div class="badge_container">'
                          eventHtml += '<img src="assets/images/gold-verified.png" alt="">'
                          eventHtml += '</div>';

                        } else if(upload.user.verification_badge == "true"  || upload.user.subscription == 'standard listing'){
                          eventHtml += '<div class="badge_container">'
                          eventHtml += '<img src="assets/images/clue-verified.png" alt="">'
                          eventHtml += '</div>';
                        }
                        eventHtml += '</div>';
                        eventHtml += '<div class="company-name">' + upload.user.businessname + '</div>';
                        eventHtml += '<a class="event-details" href="' + upload.slug_url + '/' + upload.upload_type + '/' + upload.id + '">View Details</a>';
                        eventHtml += '</div>';

                        eventsContainer.innerHTML += eventHtml;
                    });
                }
            } else {
                // Handle single upload object
            }
        })
        .catch(error => console.error('Error fetching uploads:', error));
      } else if(this.classList.contains('workshop')){
        document.getElementById('currentYearMonth').textContent = currentYear + ' Workshops - showing workshop(s) for ' + currentMonth + ' ' + currentYear;
        fetch('/workshop/' + selectedMonth + '/' + currentYear)
        .then(response => response.json())
        .then(data => {
            var eventsContainer = document.querySelector('.events-container2');
            eventsContainer.innerHTML = '';

            if (Array.isArray(data.uploads)) {
                if (data.uploads.length === 0) {
                    eventsContainer.innerHTML = '<div style="position: absolute; left:50%; transform: translate(-50%)">No Workshop For this month</div>';
                } else {
                    data.uploads.forEach(upload => {
                        var eventHtml = '<div class="events">';
                        eventHtml += '<div class="event-image-container">';
                        eventHtml += '<img class="event-image" src="images/' + upload.featured_image + '" alt="">';
                        eventHtml += '</div>';
                        eventHtml += '<div class="event-title">' + upload.title + '</div>';
                        data.results.forEach(result => {
                            if (result.uploadId === upload.id) {
                                eventHtml += '<p class="event-date">' + result.date + '</p>';
                            }
                        });
                        if (upload.upload_type == "virtual-program") {
                            eventHtml += '<div class="event-location">' + upload.host_app + '</div>';
                        } else {
                            eventHtml += '<div class="event-location">' + upload.state + ' State, ' + upload.country + '</div>';
                        }
                        eventHtml += '<div class="company-logo-container">';
                        eventHtml += '<img class="event-image" src="storage/users-avatar/' + upload.users.avatar + '" alt="">';
                        if(upload.user.verification_badge  && upload.user.subscription == 'enterprise listing'){
                          eventHtml += '<div class="badge_container">'
                          eventHtml += '<img src="assets/images/gold-verified.png" alt="">'
                          eventHtml += '</div>';

                        } else if(upload.user.verification_badge == "true"  || upload.user.subscription == 'standard listing'){
                          eventHtml += '<div class="badge_container">'
                          eventHtml += '<img src="assets/images/clue-verified.png" alt="">'
                          eventHtml += '</div>';
                        }
                        eventHtml += '</div>';
                        eventHtml += '<div class="company-name">' + upload.user.businessname + '</div>';
                        eventHtml += '<a class="event-details" href="' + upload.slug_url + '/' + upload.upload_type + '/' + upload.id + '">View Details</a>';
                        eventHtml += '</div>';

                        eventsContainer.innerHTML += eventHtml;
                    });
                }
            } else {
                // Handle single upload object
            }
        })
        .catch(error => console.error('Error fetching uploads:', error));
      } else if(this.classList.contains('virtual')){
        document.getElementById('currentYearMonth').textContent = currentYear + ' Virtual Program - showing virtual program(s) for ' + currentMonth + ' ' + currentYear;
        fetch('/virtual/' + selectedMonth + '/' + currentYear)
        .then(response => response.json())
        .then(data => {
            var eventsContainer = document.querySelector('.events-container2');
            eventsContainer.innerHTML = '';

            if (Array.isArray(data.uploads)) {
                if (data.uploads.length === 0) {
                    eventsContainer.innerHTML = '<div style="position: absolute; left:50%; transform: translate(-50%)">No Virtual Program For this month</div>';
                } else {
                    data.uploads.forEach(upload => {
                        var eventHtml = '<div class="events">';
                        eventHtml += '<div class="event-image-container">';
                        eventHtml += '<img class="event-image" src="images/' + upload.featured_image + '" alt="">';
                        eventHtml += '</div>';
                        eventHtml += '<div class="event-title">' + upload.title + '</div>';
                        data.results.forEach(result => {
                            if (result.uploadId === upload.id) {
                                eventHtml += '<p class="event-date">' + result.date + '</p>';
                            }
                        });
                        if (upload.upload_type == "virtual-program") {
                            eventHtml += '<div class="event-location">' + upload.host_app + '</div>';
                        } else {
                            eventHtml += '<div class="event-location">' + upload.state + ' State, ' + upload.country + '</div>';
                        }
                        eventHtml += '<div class="company-logo-container">';
                        eventHtml += '<img class="event-image" src="storage/users-avatar/' + upload.users.avatar + '" alt="">';
                        if(upload.user.verification_badge  && upload.user.subscription == 'enterprise listing'){
                          eventHtml += '<div class="badge_container">'
                          eventHtml += '<img src="assets/images/gold-verified.png" alt="">'
                          eventHtml += '</div>';

                        } else if(upload.user.verification_badge == "true"  || upload.user.subscription == 'standard listing'){
                          eventHtml += '<div class="badge_container">'
                          eventHtml += '<img src="assets/images/clue-verified.png" alt="">'
                          eventHtml += '</div>';
                        }
                        eventHtml += '</div>';
                        eventHtml += '<div class="company-name">' + upload.user.businessname + '</div>';
                        eventHtml += '<a class="event-details" href="' + upload.slug_url + '/' + upload.upload_type + '/' + upload.id + '">View Details</a>';
                        eventHtml += '</div>';

                        eventsContainer.innerHTML += eventHtml;
                    });
                }
            } else {
                // Handle single upload object
            }
        })
        .catch(error => console.error('Error fetching uploads:', error));
      }
    });
});

document.querySelectorAll('.year-link').forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();

        currentYear = this.getAttribute('data-year');
        var isWorkshop = document.getElementById('currentYearMonth').classList.contains('workshop');
        var isVirtualEvent = document.getElementById('currentYearMonth').classList.contains('virtual');
        var isEvent = document.getElementById('currentYearMonth').classList.contains('event');
        
        // Update the text content and route accordingly
        if (isWorkshop) {
            document.getElementById('currentYearMonth').textContent = currentYear + ' Workshops - showing workshop(s) for ' + currentMonth + ' ' + currentYear;
            document.getElementById('prevYear').innerHTML = '<i class="fa-solid fa-angles-left"></i>' + (currentYear - 1) + ' Workshops';
            document.getElementById('prevYear').setAttribute('data-year', currentYear - 1);
            document.getElementById('nextYear').innerHTML = parseInt(currentYear) + 1 + ' Workshops' + '<i class="fa-solid fa-angles-right"></i>';
            document.getElementById('nextYear').setAttribute('data-year', parseInt(currentYear) + 1);
        } else if (isVirtualEvent) {
            document.getElementById('currentYearMonth').textContent = currentYear + ' Virtual Program - showing virtual program(s) for ' + currentMonth + ' ' + currentYear;
            document.getElementById('prevYear').innerHTML = '<i class="fa-solid fa-angles-left"></i>' + (currentYear - 1) + ' Virtual Program';
            document.getElementById('prevYear').setAttribute('data-year', currentYear - 1);
            document.getElementById('nextYear').innerHTML = parseInt(currentYear) + 1 + ' Virtual Program' + '<i class="fa-solid fa-angles-right"></i>';
            document.getElementById('nextYear').setAttribute('data-year', parseInt(currentYear) + 1);
        } else if(isEvent){
          document.getElementById('currentYearMonth').textContent = currentYear + ' Events - showing event(s) for ' + currentMonth + ' ' + currentYear;
          document.getElementById('prevYear').innerHTML = '<i class="fa-solid fa-angles-left"></i>' + (currentYear - 1) + ' Events';
          document.getElementById('prevYear').setAttribute('data-year', currentYear - 1);
          document.getElementById('nextYear').innerHTML = parseInt(currentYear) + 1 + ' Events' + '<i class="fa-solid fa-angles-right"></i>';
          document.getElementById('nextYear').setAttribute('data-year', parseInt(currentYear) + 1);
        }

        // Fetch uploads for the selected year and update the events container
        // fetch('/events-year/' + currentYear)
        //     .then(response => response.json())
        //     .then(data => {
        //         var eventsContainer = document.querySelector('.events-container2');
        //         eventsContainer.innerHTML = '';

        //         if (data.uploads.length === 0) {
        //             eventsContainer.innerHTML = '<div style="position: absolute; left:50%; translateX(-50%)">No Events For this month</div>';
        //         } else {
        //             data.uploads.forEach(upload => {
        //                 var eventHtml = '<div class="events">';
        //                 eventHtml += '<div class="event-image-container">';
        //                 eventHtml += '<img class="event-image" src="images/' + upload.featured_image + '" alt="">';
        //                 eventHtml += '</div>';
        //                 eventHtml += '<div class="event-title">' + upload.title + '</div>';
        //                 data.results.forEach(result => {
        //                     if (result.uploadId === upload.id) {
        //                         eventHtml += '<p class="event-date">' + result.date + '</p>';
        //                     }
        //                 });
        //                 if (upload.upload_type == "virtual-program") {
        //                     eventHtml += '<div class="event-location">' + upload.host_app + '</div>';
        //                 } else {
        //                     eventHtml += '<div class="event-location">' + upload.state + ' State, ' + upload.country + '</div>';
        //                 }
        //                 eventHtml += '<div class="company-logo-container">';
        //                 eventHtml += '<img class="event-image" src="storage/users-avatar/' + upload.users.avatar + '" alt="">';
        //                 eventHtml += '</div>';
        //                 eventHtml += '<div class="company-name">' + upload.user.businessname + '</div>';
        //                 eventHtml += '<a class="event-details" href="' + upload.slug_url + '/' + upload.upload_type + '/' + upload.id + '">View Details</a>';
        //                 eventHtml += '</div>';

        //                 eventsContainer.innerHTML += eventHtml;
        //             });
        //         }
        //     })
        //     .catch(error => console.error('Error fetching uploads:', error));
            if(this.classList.contains('event')){
              document.getElementById('currentYearMonth').textContent = currentYear + ' Events - showing event(s) for ' + currentMonth + ' ' + currentYear;
              // console.log('event')
              fetch('/events-year/' + currentYear)
              .then(response => response.json())
              .then(data => {
                  var eventsContainer = document.querySelector('.events-container2');
                  eventsContainer.innerHTML = '';
      
                  if (Array.isArray(data.uploads)) {
                      if (data.uploads.length === 0) {
                          eventsContainer.innerHTML = '<div style="position: absolute; left:50%; transform: translate(-50%)">No Events For this month</div>';
                      } else {
                          data.uploads.forEach(upload => {
                              var eventHtml = '<div class="events">';
                              eventHtml += '<div class="event-image-container">';
                              eventHtml += '<img class="event-image" src="images/' + upload.featured_image + '" alt="">';
                              eventHtml += '</div>';
                              eventHtml += '<div class="event-title">' + upload.title + '</div>';
                              data.results.forEach(result => {
                                  if (result.uploadId === upload.id) {
                                      eventHtml += '<p class="event-date">' + result.date + '</p>';
                                  }
                              });
                              if (upload.upload_type == "virtual-program") {
                                  eventHtml += '<div class="event-location">' + upload.host_app + '</div>';
                              } else {
                                  eventHtml += '<div class="event-location">' + upload.state + ' State, ' + upload.country + '</div>';
                              }
                              eventHtml += '<div class="company-logo-container">';
                              eventHtml += '<img class="event-image" src="storage/users-avatar/' + upload.users.avatar + '" alt="">';
                              eventHtml += '</div>';
                              eventHtml += '<div class="company-name">' + upload.user.businessname + '</div>';
                              eventHtml += '<a class="event-details" href="' + upload.slug_url + '/' + upload.upload_type + '/' + upload.id + '">View Details</a>';
                              eventHtml += '</div>';
      
                              eventsContainer.innerHTML += eventHtml;
                          });
                      }
                  } else {
                      // Handle single upload object
                  }
              })
              .catch(error => console.error('Error fetching uploads:', error));
            } else if(this.classList.contains('workshop')){
              document.getElementById('currentYearMonth').textContent = currentYear + ' Workshops - showing workshop(s) for ' + currentMonth + ' ' + currentYear;
              fetch('/workshop-year/' + currentYear)
              .then(response => response.json())
              .then(data => {
                  var eventsContainer = document.querySelector('.events-container2');
                  eventsContainer.innerHTML = '';
      
                  if (Array.isArray(data.uploads)) {
                      if (data.uploads.length === 0) {
                          eventsContainer.innerHTML = '<div style="position: absolute; left:50%; transform: translate(-50%)">No Workshop For this month</div>';
                      } else {
                          data.uploads.forEach(upload => {
                              var eventHtml = '<div class="events">';
                              eventHtml += '<div class="event-image-container">';
                              eventHtml += '<img class="event-image" src="images/' + upload.featured_image + '" alt="">';
                              eventHtml += '</div>';
                              eventHtml += '<div class="event-title">' + upload.title + '</div>';
                              data.results.forEach(result => {
                                  if (result.uploadId === upload.id) {
                                      eventHtml += '<p class="event-date">' + result.date + '</p>';
                                  }
                              });
                              if (upload.upload_type == "virtual-program") {
                                  eventHtml += '<div class="event-location">' + upload.host_app + '</div>';
                              } else {
                                  eventHtml += '<div class="event-location">' + upload.state + ' State, ' + upload.country + '</div>';
                              }
                              eventHtml += '<div class="company-logo-container">';
                              eventHtml += '<img class="event-image" src="storage/users-avatar/' + upload.users.avatar + '" alt="">';
                              eventHtml += '</div>';
                              eventHtml += '<div class="company-name">' + upload.user.businessname + '</div>';
                              eventHtml += '<a class="event-details" href="' + upload.slug_url + '/' + upload.upload_type + '/' + upload.id + '">View Details</a>';
                              eventHtml += '</div>';
      
                              eventsContainer.innerHTML += eventHtml;
                          });
                      }
                  } else {
                      // Handle single upload object
                  }
              })
              .catch(error => console.error('Error fetching uploads:', error));
            } else if(this.classList.contains('virtual')){
              document.getElementById('currentYearMonth').textContent = currentYear + ' Virtual Program - showing virtual program(s) for ' + currentMonth + ' ' + currentYear;
              fetch('/virtual-year/' + currentYear)
              .then(response => response.json())
              .then(data => {
                  var eventsContainer = document.querySelector('.events-container2');
                  eventsContainer.innerHTML = '';
      
                  if (Array.isArray(data.uploads)) {
                      if (data.uploads.length === 0) {
                          eventsContainer.innerHTML = '<div style="position: absolute; left:50%; transform: translate(-50%)">No Virtual Program For this month</div>';
                      } else {
                          data.uploads.forEach(upload => {
                              var eventHtml = '<div class="events">';
                              eventHtml += '<div class="event-image-container">';
                              eventHtml += '<img class="event-image" src="images/' + upload.featured_image + '" alt="">';
                              eventHtml += '</div>';
                              eventHtml += '<div class="event-title">' + upload.title + '</div>';
                              data.results.forEach(result => {
                                  if (result.uploadId === upload.id) {
                                      eventHtml += '<p class="event-date">' + result.date + '</p>';
                                  }
                              });
                              if (upload.upload_type == "virtual-program") {
                                  eventHtml += '<div class="event-location">' + upload.host_app + '</div>';
                              } else {
                                  eventHtml += '<div class="event-location">' + upload.state + ' State, ' + upload.country + '</div>';
                              }
                              eventHtml += '<div class="company-logo-container">';
                              eventHtml += '<img class="event-image" src="storage/users-avatar/' + upload.users.avatar + '" alt="">';
                              eventHtml += '</div>';
                              eventHtml += '<div class="company-name">' + upload.user.businessname + '</div>';
                              eventHtml += '<a class="event-details" href="' + upload.slug_url + '/' + upload.upload_type + '/' + upload.id + '">View Details</a>';
                              eventHtml += '</div>';
      
                              eventsContainer.innerHTML += eventHtml;
                          });
                      }
                  } else {
                      // Handle single upload object
                  }
              })
              .catch(error => console.error('Error fetching uploads:', error));
            }
  });
});
}

function showWithdrawalTable(){
  document.getElementById('withdrawTableContainer').style.display = 'block';
  document.getElementById('myTableContainer').style.display = 'none';
  document.getElementById('otherTableContainer').style.display = 'none';
  document.getElementById('trans_withdraw').classList.add('transaction_active_buttons');
  document.getElementById('trans_depo').classList.remove('transaction_active_buttons');
  document.getElementById('trans_others').classList.remove('transaction_active_buttons');
}
function showDepositTable(){
  document.getElementById('withdrawTableContainer').style.display = 'none';
  document.getElementById('otherTableContainer').style.display = 'none';
  document.getElementById('myTableContainer').style.display = 'block';
  document.getElementById('trans_withdraw').classList.remove('transaction_active_buttons');
  document.getElementById('trans_depo').classList.add('transaction_active_buttons');
  document.getElementById('trans_others').classList.remove('transaction_active_buttons');
}
function showOtherTable(){
  document.getElementById('withdrawTableContainer').style.display = 'none';
  document.getElementById('myTableContainer').style.display = 'none';
  document.getElementById('otherTableContainer').style.display = 'block';
  document.getElementById('trans_withdraw').classList.remove('transaction_active_buttons');
  document.getElementById('trans_depo').classList.remove('transaction_active_buttons');
  document.getElementById('trans_others').classList.add('transaction_active_buttons');
}

// metrics per days

function showSevenMetrics(){
  document.getElementById('sevenDayMetrics').style.display = 'block';
  document.getElementById('fourteenDayMetrics').style.display = 'none';
  document.getElementById('thirtyDayMetrics').style.display = 'none';
  document.getElementById('allTimeMetrics').style.display = 'none';
  document.getElementById('sevenMetrics').classList.add('transaction_tabs_back');
  document.getElementById('allMetrics').classList.remove('transaction_tabs_back');
  document.getElementById('fourtMetrics').classList.remove('transaction_tabs_back');
  document.getElementById('thirtMetrics').classList.remove('transaction_tabs_back');
}
function showFourtMetrics(){
  document.getElementById('sevenDayMetrics').style.display = 'none';
  document.getElementById('fourteenDayMetrics').style.display = 'block';
  document.getElementById('thirtyDayMetrics').style.display = 'none';
  document.getElementById('allTimeMetrics').style.display = 'none';
  document.getElementById('sevenMetrics').classList.remove('transaction_tabs_back');
  document.getElementById('allMetrics').classList.remove('transaction_tabs_back');
  document.getElementById('fourtMetrics').classList.add('transaction_tabs_back');
  document.getElementById('thirtMetrics').classList.remove('transaction_tabs_back');
}
function showThirtMetrics(){
  document.getElementById('sevenDayMetrics').style.display = 'none';
  document.getElementById('fourteenDayMetrics').style.display = 'none';
  document.getElementById('thirtyDayMetrics').style.display = 'block';
  document.getElementById('allTimeMetrics').style.display = 'none';
  document.getElementById('sevenMetrics').classList.remove('transaction_tabs_back');
  document.getElementById('allMetrics').classList.remove('transaction_tabs_back');
  document.getElementById('fourtMetrics').classList.remove('transaction_tabs_back');
  document.getElementById('thirtMetrics').classList.add('transaction_tabs_back');
}
function showAllMetrics(){
  document.getElementById('sevenDayMetrics').style.display = 'none';
  document.getElementById('fourteenDayMetrics').style.display = 'none';
  document.getElementById('thirtyDayMetrics').style.display = 'none';
  document.getElementById('allTimeMetrics').style.display = 'block';
  document.getElementById('sevenMetrics').classList.remove('transaction_tabs_back');
  document.getElementById('allMetrics').classList.add('transaction_tabs_back');
  document.getElementById('fourtMetrics').classList.remove('transaction_tabs_back');
  document.getElementById('thirtMetrics').classList.remove('transaction_tabs_back');
}

function closeSwapText(){
  document.getElementById('swap-modal').style.display = 'none';
}

function openFeaturePage(){
  document.querySelector('.feature_dropdown_container').click();
}

function openHireModal(){
  document.getElementById('hire-modal-container').style.display = 'block';
}

function closeHireModal(){
  document.getElementById('hire-modal-container').style.display = 'none';
}

function toggleAccordion(button) {
  const icon = button.querySelector('i');
  const content = button.nextElementSibling;

  const allIcons = document.querySelectorAll('.accordion-toggle i');
  const allContents = document.querySelectorAll('.accordion-content');

  allIcons.forEach(i => {
    if (i !== icon && i.classList.contains('fa-minus')) {
      i.classList.remove('fa-minus');
      i.classList.add('fa-plus');
    }
  });

  allContents.forEach(c => {
    if (c !== content && c.style.display === 'block') {
      c.style.display = 'none';
    }
  });

  if (icon.classList.contains('fa-minus')) {
    icon.classList.remove('fa-minus');
    icon.classList.add('fa-plus');
    content.style.display = 'none';
  } else {
    icon.classList.remove('fa-plus');
    icon.classList.add('fa-minus');
    content.style.display = 'block';
  }
}

function clickFeature(){
  document.querySelector('.feature_dropdown_container').click();
}

const currencyEl_one = document.getElementById('currency-one');
const currencyEl_two = document.getElementById('currency-two');
const amountEl_one = document.getElementById('amount-one');
const amountEl_two = document.getElementById('amount-two');
const rateEl = document.getElementById('rate');
const swap = document.getElementById('swap');


function calculate() {
  if(currencyEl_one){
    const currency_one = currencyEl_one.value;
    const currency_two = currencyEl_two.value;

      //fetching the api
      fetch(`https://api.exchangerate-api.com/v4/latest/${currency_one}`)
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        console.log(data);

        const rate = data.rates[currency_two];
        rateEl.innerText = `1 ${currency_one} = ${rate} ${currency_two}`;
        amountEl_two.value = (amountEl_one.value * rate).toFixed(2);
      });
  }
}

if(currencyEl_one){
  currencyEl_one.addEventListener('change', calculate);
  amountEl_one.addEventListener('input', calculate);
  currencyEl_two.addEventListener('change', calculate);
  amountEl_two.addEventListener('input', calculate);

  swap.addEventListener('click', function() {
    const temp = currencyEl_one.value;

    currencyEl_one.value = currencyEl_two.value;

    currencyEl_two.value = temp;
    calculate();
  });
}

calculate();
