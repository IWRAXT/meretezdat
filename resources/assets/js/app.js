
require('./bootstrap');

window.Vue = require('vue');
import 'vue2-dropzone/dist/vue2Dropzone.min.css'


Vue.component('upload', require('./components/UploadComponent.vue'));

const app = new Vue({
    el: '#app'
});

