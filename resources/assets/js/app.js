

require('./bootstrap');

window.Vue = require('vue');


Vue.component('upload', require('./components/UploadComponent.vue'));

const app = new Vue({
    el: '#app'
});
