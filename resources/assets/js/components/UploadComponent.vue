<template>
    <div class="container">
        <!--<div class="large-12 medium-12 small-12 cell">-->
        <!--<label>File-->
        <!--<input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>-->
        <!--<img :src="avatar" alt="Image">-->
        <!--</label>-->
        <!--<button v-on:click="submitFile()">Submit</button>-->
        <!--</div>-->

        <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
        <!--<vue-dropzone-->
        <!--id="dropzone"-->
        <!--:options="dropOptions"></vue-dropzone>-->

        <!--ref="file"-->
        <!--@vdropzone-complete="afterComplete">-->


        <!--<input type="hidden" name="csrf-token" :value="csrfToken">-->
        <!--</vue-dropzone>-->
    </div>
</template>

<script>
    import vue2Dropzone from 'vue2-dropzone'

    export default {

        data() {
            return {
                file: '',
                avatar: '',
                dropzoneOptions: {
                    url: '/image',
                    dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>„Kattints ide a feltöltendő kép/képek kiválasztásához,<br> vagy egyszerűen húzd ide a képeket.”",
                    thumbnailWidth: 150,
                    maxFile: 1,
                    // headers: {"My-Awesome-Header": "header value"},
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                // dropOptions: {
                //     url: "https://fotos.test/image",
                //     // thumbnailWidth: 150,
                //     maxFile: 1,
                //     // addRemoveLinks: true,
                //     dictDefaultMessage: "<i class='fa fa-cloud-upload'></i>„Kattints ide a feltöltendő kép/képek kiválasztásához,<br> vagy egyszerűen húzd ide a képeket.”"
                // },
                // csrfToken: document.head.querySelector('meta[name="csrf-token"]').content,
                // csrfHeader: {
                //     'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                // }

            }
        },
        components: {
            vueDropzone: vue2Dropzone
        },
        methods: {
            // afterComplete(file) {
            //     console.log(file);
            // }

            // submitFile() {
            //     let formData = new FormData();
            //     formData.append('file', this.file);
            //
            //     axios.post('/image',
            //         formData,
            //         {
            //             headers: {
            //                 'Content-Type': 'multipart/form-data'
            //             }
            //         }
            //     ).then(function () {
            //         console.log('SUCCESS!!');
            //     })
            //         .catch(function () {
            //             console.log('FAILURE!!');
            //         });
            // },
            //
            // handleFileUpload() {
            //     this.file = this.$refs.file.files[0];
            //     let reader = new FileReader();
            //     reader.readAsDataURL(this.file);
            //     reader.onload = event => {
            //         this.avatar = event.target.result}
            // }
        }
    }
</script>
<style scoped>

    img {
        height: 100px;
        width: auto;
    }
</style>