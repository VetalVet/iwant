let mix = require('laravel-mix');

const path = require('path');
let directory = path.basename(path.resolve(__dirname));

const source = 'platform/themes/' + directory;
const dist = 'public/themes/' + directory;

mix.js(source + '/assets/js/app.js', dist + '/js');

mix
    .sass(source + '/assets/sass/swiper-bundle.scss', dist + '/css')
    .sass(source + '/assets/sass/cart.scss', dist + '/css')
    .sass(source + '/assets/sass/popup.scss', dist + '/css')
    .sass(source + '/assets/sass/style.scss', dist + '/css')
    .sass(source + '/assets/sass/common.scss', dist + '/css')
    .sass(source + '/assets/sass/rtl.scss', dist + '/css')
    .sass(source + '/assets/sass/index.scss', dist + '/css')

    .js(source + '/assets/js/swiper-bundle.min.js', dist + '/public/js')
    .js(source + '/assets/js/dynamicAdapt.js', dist + '/js')
    .js(source + '/assets/js/popup.js', dist + '/js')
    .js(source + '/assets/js/common.js', dist + '/js')

    .js(source + '/assets/js/backend.js', dist + '/js')
    .js(source + '/assets/js/main.js', dist + '/js')
    .js(source + '/assets/js/icons-field.js', dist + '/js')

    .js(source + '/assets/js/index.js', dist + '/public/js')

    .copy(dist + '/css/style.css', source + '/public/css')
    .copy(dist + '/css/rtl.css', source + '/public/css')
    .copy(dist + '/js/app.js', source + '/public/js')
    .copy(dist + '/js/backend.js', source + '/public/js')
    .copy(dist + '/js/main.js', source + '/public/js')
    .copy(dist + '/js/icons-field.js', source + '/public/js');
