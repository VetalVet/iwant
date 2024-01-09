// function myFunction() {
//     document.getElementById("dropdown").classList.toggle("show");
// }

// function filterFunction() {
//     let cityInput = document.querySelector(".enter-city");
//     let filter = cityInput.value.toUpperCase();
//     let cityBlock = document.querySelector("city");
//     a = cityBlock.getElementsByTagName("a");
//     for (i = 0; i < a.length; i++) {
//         txtValue = a[i].textContent || a[i].innerText;
//         if (txtValue.toUpperCase().indexOf(filter) > -1) {
//             a[i].style.display = "";
//         } else {
//             a[i].style.display = "none";
//         }
//     }
// }



// Счётчик товара +-1
// let quantityButtons = document.querySelectorAll('.quantity__button');
// if (quantityButtons.length > 0) {
// 	for (let index = 0; index < quantityButtons.length; index++) {
// 		const quantityButton = quantityButtons[index];
// 		quantityButton.addEventListener("click", function (e) {
// 			let value = parseInt(quantityButton.closest('.quantity').querySelector('input').value);
// 			if (quantityButton.classList.contains('quantity__button_plus')) {
// 				value++;
//                 updateGoodsPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
//                 // updateTotalPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
// 			} else {
// 				value = value - 1;
//                 updateGoodsPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
//                 // updateTotalPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
// 				if (value < 1) {
// 					value = 1
//                     updateGoodsPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
//                     // updateTotalPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
//                 }
// 			}
// 			quantityButton.closest('.quantity').querySelector('input').value = value;
// 		});
// 	}
// }
// Счётчик товара +-1

// Калькулятор корзины
// let total = document.querySelector('.total span');
// let prices = document.querySelectorAll('.cart-goods .price');

// // Считает сумму отдельного товара
// function updateGoodsPrice(product, quantity){
//     product.textContent = `${product.getAttribute('data-price') * quantity} ₴`;
//     updateTotalPrice();
// }

// // Считает сумму всех товаров
// function updateTotalPrice(){
//     let sum = 0;
    
//     prices.forEach(price => {
//         sum += parseInt(price.textContent.replace(' ', ''));
//     });
//     total.textContent = `${sum} ₴`;
//     // total.textContent = `${String(sum).substring(-3,1)} ${String(sum).slice(-3)} ₴`;

// }
// Калькулятор корзины

let editCartBtn = document.querySelector('.edit');

editCartBtn.addEventListener('click', (e) => {
    e.preventDefault();
    showCart();
})

// Кастомная маска телефона
mask(".phone-ukr", '+__ (___) ___ __ __'); 
mask(".popup_login .phone input", '+__ (___) ___ __ __'); 
// Кастомная маска телефона