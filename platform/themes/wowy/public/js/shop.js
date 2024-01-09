// Адаптивные аккордеоны в зависимости от ширины экрана
const spollersArray = document.querySelectorAll("[data-spollers]");
if (spollersArray.length > 0) {
    // Получение обычных слойлеров
    const spollersRegular = Array.from(spollersArray).filter(function (
        item,
        index,
        self
    ) {
        return !item.dataset.spollers.split(",")[0];
    });
    // Инициализация обычных слойлеров
    if (spollersRegular.length > 0) {
        initSpollers(spollersRegular);
    }

    // Получение слойлеров с медиа запросами
    const spollersMedia = Array.from(spollersArray).filter(function (
        item,
        index,
        self
    ) {
        return item.dataset.spollers.split(",")[0];
    });

    // Инициализация слойлеров с медиа запросами
    if (spollersMedia.length > 0) {
        const breakpointsArray = [];
        spollersMedia.forEach((item) => {
            const params = item.dataset.spollers;
            const breakpoint = {};
            const paramsArray = params.split(",");
            breakpoint.value = paramsArray[0];
            breakpoint.type = paramsArray[1] ? paramsArray[1].trim() : "max";
            breakpoint.item = item;
            breakpointsArray.push(breakpoint);
        });

        // Получаем уникальные брейкпоинты
        let mediaQueries = breakpointsArray.map(function (item) {
            return (
                "(" +
                item.type +
                "-width: " +
                item.value +
                "px)," +
                item.value +
                "," +
                item.type
            );
        });
        mediaQueries = mediaQueries.filter(function (item, index, self) {
            return self.indexOf(item) === index;
        });

        // Работаем с каждым брейкпоинтом
        mediaQueries.forEach((breakpoint) => {
            const paramsArray = breakpoint.split(",");
            const mediaBreakpoint = paramsArray[1];
            const mediaType = paramsArray[2];
            const matchMedia = window.matchMedia(paramsArray[0]);

            // Объекты с нужными условиями
            const spollersArray = breakpointsArray.filter(function (item) {
                if (item.value === mediaBreakpoint && item.type === mediaType) {
                    return true;
                }
            });
            // Событие
            matchMedia.addListener(function () {
                initSpollers(spollersArray, matchMedia);
            });
            initSpollers(spollersArray, matchMedia);
        });
    }
    // Инициализация
    function initSpollers(spollersArray, matchMedia = false) {
        spollersArray.forEach((spollersBlock) => {
            spollersBlock = matchMedia ? spollersBlock.item : spollersBlock;
            if (matchMedia.matches || !matchMedia) {
                spollersBlock.classList.add("_init");
                initSpollerBody(spollersBlock);
                spollersBlock.addEventListener("click", setSpollerAction);
            } else {
                spollersBlock.classList.remove("_init");
                initSpollerBody(spollersBlock, false);
                spollersBlock.removeEventListener("click", setSpollerAction);
            }
        });
    }
    // Работа с контентом
    function initSpollerBody(spollersBlock, hideSpollerBody = true) {
        const spollerTitles = spollersBlock.querySelectorAll("[data-spoller]");
        if (spollerTitles.length > 0) {
            spollerTitles.forEach((spollerTitle) => {
                if (hideSpollerBody) {
                    spollerTitle.removeAttribute("tabindex");
                    if (!spollerTitle.classList.contains("_active")) {
                        spollerTitle.nextElementSibling.hidden = true;
                    }
                } else {
                    spollerTitle.setAttribute("tabindex", "-1");
                    spollerTitle.nextElementSibling.hidden = false;
                }
            });
        }
    }
    function setSpollerAction(e) {
        const el = e.target;
        if (el.hasAttribute("data-spoller") || el.closest("[data-spoller]")) {
            const spollerTitle = el.hasAttribute("data-spoller")
                ? el
                : el.closest("[data-spoller]");
            const spollersBlock = spollerTitle.closest("[data-spollers]");
            const oneSpoller = spollersBlock.hasAttribute("data-one-spoller")
                ? true
                : false;
            if (!spollersBlock.querySelectorAll("._slide").length) {
                if (oneSpoller && !spollerTitle.classList.contains("_active")) {
                    hideSpollersBody(spollersBlock);
                }
                spollerTitle.classList.toggle("_active");
                _slideToggle(spollerTitle.nextElementSibling, 500);
            }
            e.preventDefault();
        }
    }
    function hideSpollersBody(spollersBlock) {
        const spollerActiveTitle = spollersBlock.querySelector(
            "[data-spoller]._active"
        );
        if (spollerActiveTitle) {
            spollerActiveTitle.classList.remove("_active");
            _slideUp(spollerActiveTitle.nextElementSibling, 500);
        }
    }
}
//SlideToggle
// let _slideUp = (target, duration = 500) => {
//     if (!target.classList.contains("_slide")) {
//         target.classList.add("_slide");
//         target.style.transitionProperty = "height, margin, padding";
//         target.style.transitionDuration = duration + "ms";
//         target.style.height = target.offsetHeight + "px";
//         target.offsetHeight;
//         target.style.overflow = "hidden";
//         target.style.height = 0;
//         target.style.paddingTop = 0;
//         target.style.paddingBottom = 0;
//         target.style.marginTop = 0;
//         target.style.marginBottom = 0;
//         window.setTimeout(() => {
//             target.hidden = true;
//             target.style.removeProperty("height");
//             target.style.removeProperty("padding-top");
//             target.style.removeProperty("padding-bottom");
//             target.style.removeProperty("margin-top");
//             target.style.removeProperty("margin-bottom");
//             target.style.removeProperty("overflow");
//             target.style.removeProperty("transition-duration");
//             target.style.removeProperty("transition-property");
//             target.classList.remove("_slide");
//         }, duration);
//     }
// };
// let _slideDown = (target, duration = 500) => {
//     if (!target.classList.contains("_slide")) {
//         target.classList.add("_slide");
//         if (target.hidden) {
//             target.hidden = false;
//         }
//         let height = target.offsetHeight;
//         target.style.overflow = "hidden";
//         target.style.height = 0;
//         target.style.paddingTop = 0;
//         target.style.paddingBottom = 0;
//         target.style.marginTop = 0;
//         target.style.marginBottom = 0;
//         target.offsetHeight;
//         target.style.transitionProperty = "height, margin, padding";
//         target.style.transitionDuration = duration + "ms";
//         target.style.height = height + "px";
//         target.style.removeProperty("padding-top");
//         target.style.removeProperty("padding-bottom");
//         target.style.removeProperty("margin-top");
//         target.style.removeProperty("margin-bottom");
//         window.setTimeout(() => {
//             target.style.removeProperty("height");
//             target.style.removeProperty("overflow");
//             target.style.removeProperty("transition-duration");
//             target.style.removeProperty("transition-property");
//             target.classList.remove("_slide");
//         }, duration);
//     }
// };
// let _slideToggle = (target, duration = 500) => {
//     if (target.hidden) {
//         return _slideDown(target, duration);
//     } else {
//         return _slideUp(target, duration);
//     }
// };
// Адаптивные аккордеоны в зависимости от ширины экрана

// Ползунок с ценой
const priceSlider = document.querySelector(".price-filter__slider");
if (priceSlider) {
    let textFrom = +document.querySelector('.price__inputs #price-start').getAttribute("data-from");
    let textTo = +document.querySelector('.price__inputs #price-end').getAttribute("data-to");

    noUiSlider.create(priceSlider, {
        start: [textFrom, textTo],
        connect: true,
        // tooltips: [wNumb({ decimals: 0, prefix: textFrom + ' ' }), wNumb({ decimals: 0, prefix: textTo + ' ' })],
        range: {
            min: [textFrom],
            max: [textTo],
        },
    });

    const priceStart = document.getElementById("price-start");
    const priceEnd = document.getElementById("price-end");
    priceStart.addEventListener("change", setPriceValues);
    priceEnd.addEventListener("change", setPriceValues);
    priceStart.addEventListener("keypress", cleanChars);
    priceEnd.addEventListener("keypress", cleanChars);

    function cleanChars(e){
        if (!/\d/.test(e.key)) e.preventDefault();
    }

    function setPriceValues() {
        let priceStartValue;
        let priceEndValue;
        if (priceStart.value != "") {
            priceStartValue = priceStart.value;
        }
        if (priceEnd.value != "") {
            priceEndValue = priceEnd.value;
        }
        priceSlider.noUiSlider.set([priceStartValue, priceEndValue]);
    }
}
// Ползунок с ценой

// Появление фильтра на мобилках
// let overlay = document.querySelector('.overlay');
let filters = document.querySelector('.filters');
let filterClose = document.querySelector('.catalog .close');
let filterBtn = document.querySelector('.filter-btn');

filterBtn.addEventListener('click', (e) => {
    e.preventDefault();

    filterClose.classList.add('_show');
    body.classList.add('lock')
    overlay.classList.add('_show');
    filters.classList.add('_active');
});

overlay.addEventListener('click', (e) => {
    e.preventDefault();

    filterClose.classList.remove('_show');
    body.classList.remove('lock')
    filters.classList.remove('_active');
    overlay.classList.remove('_show');

    sortPopup.classList.remove('active');
})

filterClose.addEventListener('click', (e) => {
    e.preventDefault();

    filterClose.classList.remove('_show');
    body.classList.remove('lock')
    filters.classList.remove('_active');
    overlay.classList.remove('_show');

    sortPopup.classList.remove('active');
})
// Появление фильтра на мобилках


// Сортировка на мобилках
let sortBtn = document.querySelector('.sort__select_mob');
let sortPopup = document.querySelector('.mobile-sort');

sortBtn.addEventListener('click', () => {
    sortPopup.classList.add('active');
    body.classList.add('lock')
    overlay.classList.add('_show');
    filterClose.classList.add('_show');
});

let sortItems = document.querySelectorAll('.sort-items li');

sortItems.forEach(item => {
    item.addEventListener('click', (e) => {
        for (let i = 0; i < sortItems.length; i++) {
            sortItems[i].classList.remove('active');
        }

        item.classList.add('active');
        sortBtn.textContent = item.querySelector('a').textContent;    
        
        filterClose.classList.remove('_show');
        body.classList.remove('lock')
        overlay.classList.remove('_show');
        sortPopup.classList.remove('active');

        // Функция сортировки товаров
        // sortProducts();
    });
});

// function sortProducts(){
//     ...
// }
// Сортировка на мобилках