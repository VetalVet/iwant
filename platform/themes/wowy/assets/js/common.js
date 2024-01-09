// Счётчик товара +-1
let quantityButtons = document.querySelectorAll('.cart-block .quantity__button');
if (quantityButtons.length > 0) {
	for (let index = 0; index < quantityButtons.length; index++) {
		const quantityButton = quantityButtons[index];
		quantityButton.addEventListener("click", function (e) {
			let value = parseInt(quantityButton.closest('.quantity').querySelector('input').value);
			if (quantityButton.classList.contains('quantity__button_plus')) {
				value++;
                updateGoodsPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
                // updateTotalPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
			} else {
				value = value - 1;
                updateGoodsPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
                // updateTotalPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
				if (value < 1) {
					value = 1
                    updateGoodsPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
                    // updateTotalPrice(quantityButton.closest('.cart-goods').querySelector('.price'), value);
                }
			}
			quantityButton.closest('.quantity').querySelector('input').value = value;
		});
	}
}
// Счётчик товара +-1

// Показ/скрытие корзины
let cartBtn = document.querySelector('.cart');
let overlay = document.querySelector('.overlay');
let cartBlock = document.querySelector('.cart-block');
let closeCartBtn = document.querySelector('.cart-close');

cartBtn.addEventListener('click', (e) => {
    e.preventDefault();
    showCart();
})
closeCartBtn.addEventListener('click', (e) => {
    e.preventDefault();
    closeCart();
})
overlay.addEventListener('click', (e) => {
    e.preventDefault();
    closeCart();
})

function showCart(){
    overlay.classList.add('_show');
    cartBlock.classList.add('_show');
}
function closeCart(){
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
let total = document.querySelector('.cart-block .total span');
let prices = document.querySelectorAll('.cart-block .cart-goods .price');

// Считает сумму отдельного товара
function updateGoodsPrice(product, quantity){
    product.textContent = `${product.getAttribute('data-price') * quantity} ₴`;
    updateTotalPrice();
}

// Считает сумму всех товаров
function updateTotalPrice(){
    let sum = 0;
    
    prices.forEach(price => {
        sum += parseInt(price.textContent.replace(' ', ''));
    });
    total.textContent = `${sum} ₴`;
}
// Калькулятор корзины


// Меню-бургер
const burger = document.querySelector('header .burger')
const body = document.querySelector('body')
const mobileMenu = document.querySelector('.mobile-menu')

if(window.innerWidth >= 1200){
    burger.addEventListener('click', () => {
        burger.classList.toggle('h-active')
        // body.classList.toggle('lock')
    })
} else{
    burger.addEventListener('click', () => {
        burger.classList.toggle('h-active')
        body.classList.toggle('lock');
        overlay.classList.toggle('_show');
        closeBtn.classList.toggle('active');
        mobileMenu.classList.toggle('_active');
    })
}
// Меню-бургер 



// Показать/скрыть каталог товаров на мобилках
let mobileCatalogBtn = document.querySelector('.mobile-menu .burger');
let mobileCatalog = document.querySelector('.wrapper > .catalog');
let closeBtn = document.querySelector('.wrapper > .close');
let backBtn = document.querySelector('.back');

mobileCatalogBtn.addEventListener('click', () => {
    mobileCatalog.classList.add('_active');
});

let arrows = document.querySelectorAll('.arrow');

arrows.forEach(arrow => {
    arrow.addEventListener('click', () => {
        arrow.nextElementSibling.classList.toggle('active');
        arrow.classList.toggle('active');
        arrow.closest('.has-sub').classList.toggle('active');
    });
});

backBtn.addEventListener('click', () => {
    mobileCatalog.classList.remove('_active');
});

closeBtn.addEventListener('click', () => {
    burger.classList.remove('h-active')
    body.classList.remove('lock');
    overlay.classList.remove('_show');
    closeBtn.classList.remove('active');
    mobileCatalog.classList.remove('_active');
    mobileMenu.classList.remove('_active');
})
// Показать/скрыть каталог товаров на мобилках

// Кастомная маска телефона
const mask = (selector, pattern) => {
    function createMask() {
        let matrix = pattern,
            i = 0,
            def = matrix.replace(/\D/g, ''),
            val = this.value.replace(/\D/g, '');

        if (def.length >= val.length) {
            val = def;
        }

        this.value = matrix.replace(/./g, function(a) {
            return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a;
        });
    }

    let inputs = document.querySelectorAll(selector);

    inputs.forEach(input => {
        input.addEventListener('input', createMask);
        input.addEventListener('focus', createMask);
        input.addEventListener('blur', createMask);
    });
};

mask(".popup_login .phone input", '+__ (___) ___ __ __'); 
// Кастомная маска телефона

// Поиск
let openSearchBtn = document.querySelector('.opensearch');
let searchForm = document.querySelector('header .search');
let searchInput = searchForm.querySelector('input');
let searchResults = searchForm.querySelector('.ajax-search');

if(window.innerWidth <= 992){
    openSearchBtn.addEventListener('click', (e) => {
        e.preventDefault();
        searchForm.classList.toggle('active');
        openSearchBtn.classList.toggle('active');
    });
}

searchInput.addEventListener('input', () => {
    if(searchInput.value){
        searchResults.classList.add('active');

        // searchProducts(searchInput.value);
    } else{
        searchResults.classList.remove('active');
        
        // searchProducts(searchInput.value);
    }
});

// Поиск в БД
// function searchProducts(query){
//     ...
// }

// Поиск