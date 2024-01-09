let tabNavs = document.querySelectorAll(".nav-tab");
let tabPanes = document.querySelectorAll(".tab-pane");
for (let i = 0; i < tabNavs.length; i++) {
    tabNavs[i].addEventListener("click", function (e) {
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
        }
    });
}

// Кастомная маска телефона
// const mask = (selector, pattern) => {
//     function createMask() {
//         let matrix = pattern,
//             i = 0,
//             def = matrix.replace(/\D/g, ""),
//             val = this.value.replace(/\D/g, "");

//         if (def.length >= val.length) {
//             val = def;
//         }

//         this.value = matrix.replace(/./g, function (a) {
//             return /[_\d]/.test(a) && i < val.length
//                 ? val.charAt(i++)
//                 : i >= val.length
//                 ? ""
//                 : a;
//         });
//     }

//     let inputs = document.querySelectorAll(selector);

//     inputs.forEach((input) => {
//         input.addEventListener("input", createMask);
//         input.addEventListener("focus", createMask);
//         input.addEventListener("blur", createMask);
//     });
// };

mask(".phone-ukr", "+__ (___) ___ __ __");
mask(".popup_login .phone input", '+__ (___) ___ __ __'); 
mask(".partner .card", "____ ____ ____ ____");
// Кастомная маска телефона

// Скопировать реф ссылку
let copyBtn = document.querySelectorAll(".copy");
let refLink = document.querySelector("a.copy").textContent;
let refDiv = document.querySelector("div.copy span");

copyBtn.forEach((btn) => {
    btn.addEventListener("click", (e) => {
        e.preventDefault();

        let inp = document.createElement("input");
        inp.value = refLink;
        document.body.appendChild(inp);
        inp.select();
        
        if (document.execCommand("copy")) {
            refDiv.textContent = "Скопійовано!";
        }
        setTimeout(() => {
            refDiv.textContent = "Скопіювати";
        }, 3000);

        // } else {
        //     console.log("Failed...");
        // }

        document.body.removeChild(inp);
    });
});

// Скопировать реф ссылку


// Вкладка Партнёрская программа
let gridBtn = document.querySelector('.ongrid');
let listBtn = document.querySelector('.onlist');
let partnersList = document.querySelector('.partners-list');

gridBtn.addEventListener('click', (e) => {
    e.preventDefault();
    partnersList.classList.remove('_list')
})
listBtn.addEventListener('click', (e) => {
    e.preventDefault();
    partnersList.classList.add('_list')
})
// Вкладка Партнёрская программа