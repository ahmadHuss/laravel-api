import Vue from 'vue';
import axios from 'axios';
import _ from 'lodash';

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


window.Vue = Vue;
// Do `Vue.prototype._` = _ to use lodash as _ in templates. But I recommend you to define
// your own filters/methods that use lodash methods instead
Vue.prototype._ = _;
// id app
Vue.component('front-page', require('./components/Front.vue').default);
// Load third party vue component `laravel-vue-pagination`
Vue.component('pagination', require('laravel-vue-pagination'));

// load the front component
new Vue({
    el: '#app'
});
