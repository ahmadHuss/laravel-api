//import vue
import Vue from 'vue';
import _ from 'lodash';

Vue.prototype._ = _;

// id app
Vue.component('front-page', require('./components/Front.vue').default);


// load the front component
new Vue({
    el: '#app'
});
