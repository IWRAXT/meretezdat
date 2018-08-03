<template>
    <div class="container">
      <vue-dropzone ref="myVueDropzone" id="dropzone" :options="dropzoneOptions"></vue-dropzone>
        <!--<vue-dropzone-->
        <!--id="dropzone"-->
        <!--:options="dropOptions"></vue-dropzone>-->

        <!--ref="file"-->
        <!--@vdropzone-complete="afterComplete">-->


        <!--<input type="hidden" name="csrf-token" :value="csrfToken">-->
        <!--</vue-dropzone>-->
      <div class=container>
        <h5><i class="material-icons">collections</i>Kép szerkesztés</h5>
        <button type="button">Kivágás</button>
        <button type="button">Forgatás</button>
        <button type="button">Tükrözés</button>
        <h5><i class="material-icons">collections</i>Kép átméretezés</h5>
        <button type="button">25%</button>
        <button type="button">50%</button>
        <button type="button">75%</button>
        <button type="button">Egyéni</button>
        <h5><i class="material-icons">collections</i>Válassz speciális réteget</h5>
        <button type="button">Szürke</button>
        <button type="button">Szépia</button>
        <button type="button">Olajfesték</button>
        <h5><i class="material-icons">collections</i>Letöltés választott formátumban</h5>
        <button type="button">JPG</button>
        <button type="button">PNG</button>
        <button type="button">BMP</button>
        <button type="button">GIF</button>
      </div>

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
                    dictDefaultMessage: "„Kattints ide a feltöltendő kép/képek kiválasztásához,<br> vagy egyszerűen húzd ide a képeket.”<br><i class=\"fa fa-cloud-upload\"></i>",
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