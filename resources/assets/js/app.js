
require('./bootstrap');

window.Vue = require('vue');

import 'vue2-dropzone/dist/vue2Dropzone.min.css'


Vue.component('upload', require('./components/UploadComponent.vue'));
// Vue.component('crop', require('./components/Cropper.vue'));
// Vue.component('photo', require('./components/PhotoComponent.vue'));



const app = new Vue({
    el: '#app'
});

