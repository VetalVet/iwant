'use strict';

import ProductReviewsComponent from './components/ProductReviewsComponent.vue';

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const { createApp } = Vue

const app = createApp({})

app.component('product-reviews-component', ProductReviewsComponent);

app.config.globalProperties.__ = (key) => {
    return window.trans[key] !== 'undefined' ? window.trans[key] : key;
};

app.config.globalProperties.siteConfig = window.siteConfig;

app.mount('#product-reviews')
