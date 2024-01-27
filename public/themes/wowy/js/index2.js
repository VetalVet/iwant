/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************************!*\
  !*** ./platform/themes/wowy/assets/js/index.js ***!
  \*************************************************/
// Слайдеры
var actionSlider = new Swiper(".action-slider", {
  pagination: {
    el: ".action-pagination",
    // Буллеты
    type: "bullets",
    clickable: true
  }
});
var booksSlider = new Swiper(".books-slider", {
  // Стрелки
  navigation: {
    nextEl: ".books-button-next",
    prevEl: ".books-button-prev"
  },
  pagination: {
    el: ".books-pagination",
    // Буллеты
    type: "bullets",
    clickable: true
  },
  slidesPerView: 2,
  spaceBetween: 10,
  breakpoints: {
    // when window width is >= 480px
    768: {
      spaceBetween: 15,
      slidesPerView: 3
    },
    // when window width is >= 640px
    992: {
      spaceBetween: 20,
      slidesPerView: 4
    }
  }
});
var blogSlider = new Swiper(".blog-slider", {
  // Стрелки
  navigation: {
    nextEl: ".blog-button-next",
    prevEl: ".blog-button-prev"
  },
  pagination: {
    el: ".blog-pagination",
    // Буллеты
    type: "bullets",
    clickable: true
  },
  autoHeight: true,
  slidesPerView: 1,
  // spaceBetween: 10,
  breakpoints: {
    // when window width is >= 480px
    768: {
      spaceBetween: 15,
      slidesPerView: 2
    },
    // when window width is >= 640px
    992: {
      spaceBetween: 20,
      slidesPerView: 3
    }
  }
});

// Слайдеры
/******/ })()
;