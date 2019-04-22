require('./bootstrap');

 

window.Vue = require('vue');

Vue.use(require('vue-resource'));

 

Vue.component('data-component', require('./components/DataComponent.vue'));

Vue.component('pagination', require('laravel-vue-pagination'));

 

const app = new Vue({

    el: '#app'

});