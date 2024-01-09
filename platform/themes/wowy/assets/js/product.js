// Табы
let tabNavs = document.querySelectorAll(".nav-tab");
let tabPanes = document.querySelectorAll(".tab-pane");

for (let i = 0; i < tabNavs.length; i++) {
    tabNavs[i].addEventListener("click", (e) => {
        e.preventDefault();
        let activeTabAttr = e.target.getAttribute("data-tab");
        for (let j = 0; j < tabNavs.length; j++) {
            let contentAttr = tabPanes[j].getAttribute("data-tab-content");
            if (activeTabAttr === contentAttr) {
                tabNavs[j].classList.add("active");
                tabPanes[j].classList.add("active"); 
            } else {
                tabNavs[j].classList.remove("active");
                tabPanes[j].classList.remove("active");
            }
        };
    });
}
// Табы

// Слайдеры
let productSlider = new Swiper('.product-slider', {
    // Стрелки
    navigation: {
        nextEl: '.product-button-next',
        prevEl: '.product-button-prev'
    },
    pagination: {
        el: '.product-pagination',
        // Буллеты
        type: 'bullets',
        clickable: true,
    },
    spaceBetween: 120,
})

let upsellSlider = new Swiper('.upsell-slider', {
    // Стрелки
    navigation: {
        nextEl: '.upsell-button-next',
        prevEl: '.upsell-button-prev'
    },
    pagination: {
        el: '.upsell-pagination',
        // Буллеты
        type: 'bullets',
        clickable: true,
    },
    slidesPerView: 2,
    spaceBetween: 10,
    breakpoints: {
        // when window width is >= 480px
        768: {
            spaceBetween: 15,
            slidesPerView: 4,
        },
        // when window width is >= 640px
        993: {
            spaceBetween: 20,
        },
    }, 
});

if(window.innerWidth <= 768){
    upsellSlider.navigation.destroy();
    upsellSlider.destroy();
} 
// Слайдеры


// Показать больше текста
let moreBlock = document.querySelectorAll('.description');

moreBlock.forEach(item => {
    moreBtn = item.querySelector('.moretext');

    moreBtn.addEventListener('click', (e) => {
        e.preventDefault();

        moreContent = item.querySelector('.text');
        moreBtn = item.querySelector('.moretext');
        moreContent.classList.toggle('more');
        if (moreContent.classList.contains('more')) {
            moreBtn.textContent = 'Приховати';
        } else {
            moreBtn.textContent = 'Показати більше';
        }
    })
})
// Показать больше текста

// Кастомная маска телефона
// const mask = (selector, pattern) => {
//     function createMask() {
//         let matrix = pattern,
//             i = 0,
//             def = matrix.replace(/\D/g, ''),
//             val = this.value.replace(/\D/g, '');

//         if (def.length >= val.length) {
//             val = def;
//         }

//         this.value = matrix.replace(/./g, function(a) {
//             return /[_\d]/.test(a) && i < val.length ? val.charAt(i++) : i >= val.length ? '' : a;
//         });
//     }

//     let inputs = document.querySelectorAll(selector);

//     inputs.forEach(input => {
//         input.addEventListener('input', createMask);
//         input.addEventListener('focus', createMask);
//         input.addEventListener('blur', createMask);
//     });
// };

mask(".phone-ukr", '+__ (___) ___ __ __'); 
mask(".popup_login .phone input", '+__ (___) ___ __ __'); 
// Кастомная маска телефона

// Счётчик -1+ для описания товара
let productQuantityButtons = document.querySelectorAll('.product-quantity .quantity__button');
if (productQuantityButtons.length > 0) {
	for (let index = 0; index < productQuantityButtons.length; index++) {
		const quantityButton = productQuantityButtons[index];
		quantityButton.addEventListener("click", function (e) {
			let value = parseInt(quantityButton.closest('.product-quantity').querySelector('input').value);
			if (quantityButton.classList.contains('quantity__button_plus')) {
				value++;
            } else {
				value = value - 1;
                if (value < 1) {
					value = 1
                }
			}
			quantityButton.closest('.product-quantity').querySelector('input').value = value;
		});
	}
}
// Счётчик -1+ для описания товара

// Открыть форму комментариев
let leaveCommentBtn = document.querySelector('.leave-btn');

leaveCommentBtn.addEventListener('click', (e) => {
    e.preventDefault();

    document.querySelector('.comment-form').classList.remove('_hidden');
    if(document.querySelector('.leave-comment')){
        document.querySelector('.leave-comment').classList.add('_hidden');
    }
    if(document.querySelector('.no-comments')){
        document.querySelector('.no-comments').classList.add('_hidden');
    }
})
// Открыть форму комментариев


// Кнопка добавить в корзину
let addtocartBtn = document.querySelector('.addtocart');

addtocartBtn.addEventListener('click', (e) => {
    e.preventDefault(e);
    if(window.innerWidth >= 768){
        addtocartBtn.classList.add('added');
        addtocartBtn.querySelector('span').textContent = 'Додано до кошику';
    
        setTimeout(() => {
            addtocartBtn.classList.remove('added');
            addtocartBtn.querySelector('span').textContent = 'Додати у кошик';
        }, 3000);
    } else {
        addtocartBtn.classList.add('added-mob');

        setTimeout(() => {
            addtocartBtn.classList.remove('added-mob');
        }, 3000);
    }
    
});
// Кнопка добавить в корзину