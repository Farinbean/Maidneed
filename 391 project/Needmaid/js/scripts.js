// let menu = document.querySelector('#menu-btn');
// let navbar = document.querySelector('.navbar');

// menu.onclick = () =>{
//   menu.classList.toggle('fa-times');
//   navbar.classList.toggle('active');
// }

// document.querySelector('#login-btn').onclick = () =>{
//   document.querySelector('.login-form-container').classList.toggle('active');
// }

// document.querySelector('#close-login-form').onclick = () =>{
//   document.querySelector('.login-form-container').classList.remove('active');
// }

    
var swiper = new Swiper(".featured-slider", {
  grabCursor: true,
  centeredSlides: true,  
  spaceBetween: 20,
  loop:true,
  autoplay: {
    delay: 9500,
    disableOnInteraction: false,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable:true,
  },
  breakpoints: {
    0: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1024: {
      slidesPerView: 3,
    },
  },
});

