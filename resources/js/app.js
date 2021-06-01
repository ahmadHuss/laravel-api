require('./bootstrap');

// Require Vue
window.Vue = require('vue');

// id app
Vue.component('front-page', require('./components/Front.vue').default);

// load the front component
const app = new Vue({
    el: '#app'
});
