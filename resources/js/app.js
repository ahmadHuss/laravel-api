require('./bootstrap');
import Vue from 'vue';

window.Vue = Vue;
// Do `Vue.prototype._` = _ to use lodash as _ in templates. But I recommend you to define
// your own filters/methods that use lodash methods instead
Vue.prototype._ = _;
// id app
Vue.component('front-page', require('./components/FrontPage.vue').default);

// id app
let categoriesIndex = Vue.component('categories-index', require('./components/CategoriesIndex.vue').default);
let categoriesCreate = Vue.component('categories-create', require('./components/CategoriesCreate.vue').default);

// Load third party vue component `laravel-vue-pagination`
Vue.component('pagination', require('laravel-vue-pagination'));

// load the front component
new Vue({
    el: '#app',
    components: {
        categoriesIndex: categoriesIndex,
        categoriesCreate: categoriesCreate
    }
});
