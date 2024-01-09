// Слайдеры
let actionSlider = new Swiper(".action-slider", {
    pagination: {
        el: ".action-pagination",
        // Буллеты
        type: "bullets",
        clickable: true,
    },
});

const categorySliders = document.querySelectorAll('.main-s4');

categorySliders.forEach(booksSlider => {
    let sliderID = booksSlider.getAttribute('data-category');
    let slider = booksSlider.querySelector('.books-slider');

    let booksSlider = new Swiper(slider, {
        // Стрелки
        navigation: {
            nextEl: ".books-button-next" + sliderID,
            prevEl: ".books-button-prev" + sliderID,
        },
        pagination: {
            el: ".books-pagination" + sliderID,
            // Буллеты
            type: "bullets",
            clickable: true,
        },
        slidesPerView: 2,
        spaceBetween: 10,
        breakpoints: {
            // when window width is >= 480px
            768: {
                spaceBetween: 15,
                slidesPerView: 3,
            },
            // when window width is >= 640px
            992: {
                spaceBetween: 20,
                slidesPerView: 4,
            },
        },
    });
})

let blogSlider = new Swiper(".blog-slider", {
    // Стрелки
    navigation: {
        nextEl: ".blog-button-next",
        prevEl: ".blog-button-prev",
    },
    pagination: {
        el: ".blog-pagination",
        // Буллеты
        type: "bullets",
        clickable: true,
    },
    autoHeight: true,
    slidesPerView: 1,
    // spaceBetween: 10,
    breakpoints: {
        // when window width is >= 480px
        768: {
            spaceBetween: 15,
            slidesPerView: 2,
        },
        // when window width is >= 640px
        992: {
            spaceBetween: 20,
            slidesPerView: 3,
        },
    }
});

// Слайдеры
