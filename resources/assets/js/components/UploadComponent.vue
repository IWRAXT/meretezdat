<template>

    <!--Bootstrap Collapse-->


    <div>
        <div class="container" v-show="avatar==false">

            <div class="container flex-center position-ref">
                A hétvégi képeket nem tudod elküldeni emailben, mert túl nagy méretûek?<br>
                Mostantól nem kell a szomszéd informatikust, osztálytársad vagy barátod nyaggatni<br>
                a képek lekicsinyítésével, mivel itt te is megtudod tenni mindössze 3 lépésben!
            </div>

            <vue-dropzone ref="Dropzone"

                          id="dropzone"
                          :options="dropzoneOptions"
                          @vdropzone-success="afterComplete">
            </vue-dropzone>

        </div>

        <div class="container" v-show="avatar">
            <!--<img :src="img_src" class="img-responsive">-->
            <div style="width: 400px; height:300px;  display: inline-block;">
                <vue-cropper
                        ref="cropper"
                        :src="img_src"
                        alt="Source Image"
                        :cropmove="cropImage"
                        :rotatable="true"
                        drag-mode="crop">
                </vue-cropper>
                <!--:guides="true"-->
                <!--:view-mode="2"-->
                <!--drag-mode="crop"-->
                <!--:auto-crop-area="0.5"-->
                <!--:min-container-width="250"-->
                <!--:min-container-height="180"-->
                <!--:background="true"-->

                <img :src="cropImg" style="width: 200px; height: 150px;" alt="Cropped Image"/>
                <label class="radio-inline"><input type="radio" name="optradio">Méretarány megtartásával</label>

            </div>

            <p><i class="material-icons">collections</i>Kép szerkesztés</p><br><br>
            <div class="d-flex justify-content-around  mb-3">
                <button type="button" class="btn btn-info btn-sm" @click="cropImage">Kivágás</button>


                <button type="button" class="btn btn-info btn-sm" @click="rotate">Forgatás</button>
                <button type="button" class="btn btn-info btn-sm">Tükrözés</button>
            </div>
            <p><i class="material-icons">collections</i>Kép átméretezés</p><br><br>
            <div class="d-flex justify-content-around  mb-4">
                <button type="button" class="btn btn-info btn-sm">25%</button>
                <button type="button" class="btn btn-info btn-sm">50%</button>
                <button type="button" class="btn btn-info btn-sm">75%</button>
                <button type="button" class="btn btn-info btn-sm">Egyéni</button>
            </div>
            <p><i class="material-icons">collections</i>Válassz speciális réteget</p><br><br>
            <div class="d-flex justify-content-around  mb-3">
                <button type="button" class="btn btn-info btn-sm">Szürke</button>
                <button type="button" class="btn btn-info btn-sm">Szépia</button>
                <button type="button" class="btn btn-info btn-sm">Olajfesték</button>
            </div>
            <p><i class="material-icons">collections</i>Letöltés választott formátumban</p><br><br>
            <div class="d-flex justify-content-around  mb-4">
                <button type="button" class="btn btn-info btn-sm">JPG</button>
                <!--v-on="jpg"-->
                <button type="button" class="btn btn-info btn-sm">PNG</button>
                <button type="button" class="btn btn-info btn-sm">BMP</button>
                <button type="button" class="btn btn-info btn-sm">GIF</button>
            </div>
        </div>


    </div>


</template>

<script>
    import vue2Dropzone from 'vue2-dropzone';
    import VueCropper from 'vue-cropperjs';

    export default {
        components: {
            vueDropzone: vue2Dropzone,
            VueCropper,
        },
        data() {
            return {
                avatar: false,
                img_src: '',
                crop_img: '',
                cropImg: '',
                dropzoneOptions: {
                    url: '/image',
                    dictDefaultMessage: "„Kattints ide a feltöltendő kép/képek kiválasztásához,<br> vagy egyszerűen húzd ide a képeket.”<br><i class=\"fa fa-cloud-upload\"></i>",
                    thumbnailWidth: 150,
                    maxFile: 1,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                    // addRemoveLinks: true,
                }
            };

        },

        methods: {
            afterComplete(file, response) {
                this.avatar = true;
                this.img_src = '/storage/images/' + response;
                this.$refs.cropper.replace(this.img_src);
            },
            cropImage() {
                // get image data for post processing, e.g. upload or setting image src
                this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
            },
            rotate() {
                // guess what this does :)
                this.$refs.cropper.rotate(90);
            },

            // jpg(){
            //     $img = Image::make(public_path('/storage/images'.(this.img_path)));
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
        },
    };
</script>
<style scoped>

    img {
        height: 200px;
        width: auto;
        padding-bottom: 12px;
    }

    button {
        font-weight: bold;
        color: white;

    }

    p {
        float: left;

    }


</style>