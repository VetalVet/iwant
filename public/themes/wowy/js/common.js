/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************************!*\
  !*** ./platform/themes/wowy/assets/js/common.js ***!
  \**************************************************/
// Счётчик товара +-1
var quantityButtons = document.querySelectorAll('.cart-block .quantity__button');
if (quantityButtons.length > 0) {
  var _loop = function _loop() {
    var quantityButton = quantityButtons[index];
    quantityButton.addEventListener("click", function (e) {
      var value = parseInt(quantityButton.closest('.quantity').querySelector('input').value);
      if (quantityButton.classList.contains('quantity__button_plus')) {
        value++;
        updateGoodsPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
        // updateTotalPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
      } else {
        value = value - 1;
        updateGoodsPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
        // updateTotalPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
        if (value < 1) {
          value = 1;
          updateGoodsPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
          // updateTotalPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
        }
      }

      quantityButton.closest('.quantity').querySelector('input').value = value;
    });
  };
  for (var index = 0; index < quantityButtons.length; index++) {
    _loop();
  }
}
// Счётчик товара +-1

// Показ/скрытие корзины
var cartBtn = document.querySelector('.cart');
var overlay = document.querySelector('.overlay');
var cartBlock = document.querySelector('.cart-block');
var closeCartBtn = document.querySelector('.cart-close');
cartBtn.addEventListener('click', function (e) {
  e.preventDefault();
  showCart();
});
closeCartBtn.addEventListener('click', function (e) {
  e.preventDefault();
  closeCart();
});
overlay.addEventListener('click', function (e) {
  e.preventDefault();
  closeCart();
});
function showCart() {
  overlay.classList.add('_show');
  cartBlock.classList.add('_show');
}
function closeCart() {
  overlay.classList.remove('_show');
  cartBlock.classList.remove('_show');
  mobileMenu.classList.remove('_active');
  try {
    mobileCatalog.classList.remove('_active');
  } catch (e) {}
  burger.classList.remove('h-active');
  body.classList.remove('lock');
  closeBtn.classList.remove('active');
}
// Показ/скрытие корзины

// Калькулятор корзины
var total = document.querySelector('.cart-block .total span');
var prices = document.querySelectorAll('.cart-block .cart-goods .price');

// Считает сумму отдельного товара
function updateGoodsPrice(product, quantity) {
  product.textContent = "".concat(product.getAttribute('data-price') * quantity, " \u20B4");
  updateTotalPrice();
}

// Считает сумму всех товаров
function updateTotalPrice() {
  var sum = 0;
  prices.forEach(function (price) {
    sum += parseInt(price.textContent.replace(' ', ''));
  });
  total.textContent = "".concat(sum, " \u20B4");
}
// Калькулятор корзины

// Меню-бургер
var burger = document.querySelector('header .burger');
var body = document.querySelector('body');
var mobileMenu = document.querySelector('.mobile-menu');
if (window.innerWidth >= 1200) {
  burger.addEventListener('click', function () {
    burger.classList.toggle('h-active');
    // body.classList.toggle('lock')
  });
} else {
  burger.addEventListener('click', function () {
    burger.classList.toggle('h-active');
    body.classList.toggle('lock');
    overlay.classList.toggle('_show');
    closeBtn.classList.toggle('active');
    mobileMenu.classList.toggle('_active');
  });
}
// Меню-бургер 

// Показать/скрыть каталог товаров на мобилках
var mobileCatalogBtn = document.querySelector('.mobile-menu .burger');
var mobileCatalog = document.querySelector('.wrapper > .catalog');
var closeBtn = document.querySelector('.wrapper > .close');
var backBtn = document.querySelector('.back');
mobileCatalogBtn.addEventListener('click', function () {
  mobileCatalog.classList.add('_active');
});
var arrows = document.querySelectorAll('.arrow');
arrows.forEach(function (arrow) {
  arrow.addEventListener('click', function () {
    arrow.nextElementSibling.classList.toggle('active');
    arrow.classList.toggle('active');
    arrow.closest('.has-sub').classList.toggle('active');
  });
});
backBtn.addEventListener('click', function () {
  mobileCatalog.classList.remove('_active');
});
closeBtn.addEventListener('click', function () {
  burger.classList.remove('h-active');
  body.classList.remove('lock');
  overlay.classList.remove('_show');
  closeBtn.classList.remove('active');
  mobileCatalog.classList.remove('_active');
  mobileMenu.classList.remove('_active');
});
// Показать/скрыть каталог товаров на мобилках

// Кастомная маска телефона
var mask = function mask(selector, pattern) {
  function createMask() {
    var matrix = pattern,
      i = 0,
      def = matrix.replace(/\D/g, ''),
      val = this.value.replace(/\D/g, '');
    if (def.length >= val.length) {
      val = def;
    }
    this.value = matrix.replace(/./g, function (a) {
      return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a;
    });
  }
  var inputs = document.querySelectorAll(selector);
  inputs.forEach(function (input) {
    input.addEventListener('input', createMask);
    input.addEventListener('focus', createMask);
    input.addEventListener('blur', createMask);
  });
};
mask(".popup_login .phone input", '+__ (___) ___ __ __');
// Кастомная маска телефона

// Поиск
var openSearchBtn = document.querySelector('.opensearch');
var searchForm = document.querySelector('header .search');
var searchInput = searchForm.querySelector('input');
var searchResults = searchForm.querySelector('.ajax-search');
if (window.innerWidth <= 992) {
  openSearchBtn.addEventListener('click', function (e) {
    e.preventDefault();
    searchForm.classList.toggle('active');
    openSearchBtn.classList.toggle('active');
  });
}
searchInput.addEventListener('input', function () {
  if (searchInput.value) {
    searchResults.classList.add('active');

    // searchProducts(searchInput.value);
  } else {
    searchResults.classList.remove('active');

    // searchProducts(searchInput.value);
  }
});

// Поиск в БД
// function searchProducts(query){
//     ...
// }

// Поиск
/******/ })()
;