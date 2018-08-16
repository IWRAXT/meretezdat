<template>

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

            <table class="table-responsive">
                <thead>
                <tr>
                    <th>Szerkesztett</th>
                    <th>Eredeti</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><img :src="cropImg"
                             alt="Cropped Image"/></td>
                    <td><img :src="img_src"
                             alt="Cropped Image"/></td>
                </tr>
                </tbody>
            </table>

            <button class="collapsible"><i class="material-icons">collections</i> Kép szerkesztés</button>
            <div class="content">
                <div class="col-sm-10" style="padding-top: 6px; padding-bottom: 6px">
                    <vue-cropper
                            ref="cropper"
                            :src="img_src"
                            alt="Source Image"
                            :cropmove="cropImage"
                            :rotatable="true"
                            :img-style="{ 'width': '200px', 'height': '200px' }"
                            drag-mode="crop">
                    </vue-cropper>
                </div>
                <div class="col-sm-2" style="padding-top: 6px; padding-bottom: 6px">
                    <button type="button" class="btn btn-info btn-sm" @click="rotate">Forgatás</button>
                    <br><br>
                    <button type="button" class="btn btn-info btn-sm" @click="scaleX">Tükrözés<br>y-tengelyre</button>
                    <br><br>
                    <button type="button" class="btn btn-info btn-sm" @click="scaleY">Tükrözés<br>x-tengelyre</button>
                    <br><br>
                    <button type="button" class="btn btn-secondary btn-sm" @click="cropImage">Szerkesztés<br>kész
                    </button>
                </div>
            </div>

            <button class="collapsible"><i class="material-icons">collections</i> Kép átméretezés</button>
            <div class="content">
                <div class="d-flex justify-content-around  mb-3" style="padding-top: 6px">
                    <button type="button" class="btn btn-info btn-sm" @click="meretez(25)">25%</button>
                    <button type="button" class="btn btn-info btn-sm" @click="meretez(50)">50%</button>
                    <button type="button" class="btn btn-info btn-sm" @click="meretez(75)">75%</button>
                </div>
                <button type="button" class="btn btn-info btn-sm" style="margin-bottom: 12px" @click="meretez(szam)">
                    Egyéni:
                </button>
                <!--<input :model="szama" >-->
                <!--<p>{{szama}}</p>-->
                <label class="radio-inline"><input type="radio" name="optradio">Méretarány
                    megtartásával</label>
            </div>

            <button class="collapsible"><i class="material-icons">collections</i> Válassz speciális réteget</button>
            <div class="content">
                <div class="d-flex justify-content-around  mb-3" style="padding-top: 6px">
                    <button type="button" class="btn btn-info btn-sm">Szürke</button>
                    <button type="button" class="btn btn-info btn-sm">Szépia</button>
                    <button type="button" class="btn btn-info btn-sm">Olajfesték</button>
                </div>
            </div>

            <button class="collapsible"><i class="material-icons">collections</i> Letöltés választott formátumban
            </button>
            <div class="content">
                <div class="d-flex justify-content-around  mb-4" style="padding-top: 6px">
                    <button type="button" class="btn btn-info btn-sm" @click="jpg">JPG</button>
                    <button type="button" class="btn btn-info btn-sm">PNG</button>
                    <button type="button" class="btn btn-info btn-sm">BMP</button>
                    <button type="button" class="btn btn-info btn-sm">GIF</button>
                    <button type="button" class="btn btn-dark btn-sm" @click="download">Download</button>
                </div>
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
                szam: '100',
                img_src: '',
                cropImg: 'default-image.png',
                dropzoneOptions: {
                    url: '/image',
                    dictDefaultMessage: "„Kattints ide a feltöltendő kép/képek kiválasztásához," +
                    "<br> vagy egyszerűen húzd ide a képeket.”<br><br>" +
                    "<i class=\"fa fa-cloud-upload\"" +
                    "style=\"font-size:36px\"></i>",
                    dictMaxFilesExceeded: 'Csak (max: {{maxFiles}}) file-t lehet feltölteni',
                    thumbnailWidth: 150,
                    uploadMultiple: false,
                    maxFiles: 1,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    }
                }
            };

        },

        methods: {
            //MaxFiles...alert()
            afterComplete(file, response) {
                this.avatar = true;
                this.img_src = '/storage/images/' + response;
                this.$refs.cropper.replace(this.img_src);
            },
            cropImage() {
                this.cropImg = this.$refs.cropper.getCroppedCanvas().toDataURL();
            },
            rotate() {
                this.$refs.cropper.rotate(90);
            },
            scaleX() {
                this.$refs.cropper.scaleX(-1);
            },
            scaleY() {
                this.$refs.cropper.scaleY(-1);
            },

            meretez($meret) {
                if (this.cropImg !== 'default-image.png') {
                    const formData = new FormData();
                    console.log(this.img_src);
                    formData.append('file', (new Blob([this.$refs.cropper.getCroppedCanvas().toDataURL()])), this.img_src);
                    formData.append('meret', $meret);

                    axios.post('/image/meretez', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                            }
                        }
                    ).then(function () {
                        alert("Sikeresen átméretezte!");
                    }).catch(function () {
                        alert("Nem sikerült átméretezni!");
                    });
                } else {
                    const formData = new FormData();
                    formData.append('file', (new Blob([this.img_src])));
                    axios.post('/image/meretez', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data',
                            }
                        }
                    ).then(function () {
                        alert("Sikeresen átméretezte!");
                    }).catch(function () {
                        alert("Nem sikerült átméretezni!");
                    });
                }

            },


            jpg() {
                if (this.cropImg !== 'default-image.png') {
                    const formData = new FormData();
                    console.log(this.img_src);
                    formData.append('file', (new Blob([this.cropImg])), this.img_src);
                    axios.post('/image/JPG', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data',

                            },
                            responseType: 'arraybuffer' //ha ez nincs ismeretlen formátumba ment
                        }
                    ).then((response) => {

                        let blob = new Blob([response.data], {type: 'application/jpg'})
                        let link = document.createElement('a')
                        link.href = window.URL.createObjectURL(blob)
                        link.download = 'pelda.jpg'
                        link.click()

                    }).catch(function () {
                        alert("Nem sikerült menteni más formátumba!");
                    });
                } else {
                    const formData = new FormData();
                    formData.append('file', (new Blob([this.img_src])));
                    axios.post('/image/JPG', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data',

                            },
                            responseType: 'arraybuffer' //ha ez nincs ismeretlen formátumba ment
                        }
                    ).then((response) => {

                        let blob = new Blob([response.data], {type: 'application/jpg'})
                        let link = document.createElement('a')
                        link.href = window.URL.createObjectURL(blob)
                        link.download = 'pelda.jpg'
                        link.click()

                    }).catch(function () {
                        alert("Nem sikerült menteni más formátumba!");
                    });
                }
            },
            png() {
                if (this.cropImg !== 'default-image.png') {
                    const formData = new FormData();
                    console.log(this.img_src);
                    formData.append('file', (new Blob([this.cropImg])), this.img_src);
                    axios.post('/image/PNG', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data',

                            },
                            responseType: 'arraybuffer' //ha ez nincs ismeretlen formátumba ment
                        }
                    ).then((response) => {

                        let blob = new Blob([response.data], {type: 'application/png'})
                        let link = document.createElement('a')
                        link.href = window.URL.createObjectURL(blob)
                        link.download = 'pelda.png'
                        link.click()

                    }).catch(function () {
                        alert("Nem sikerült menteni más formátumba!");
                    });
                } else {
                    const formData = new FormData();
                    formData.append('file', (new Blob([this.img_src])));
                    axios.post('/image/PNG', formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data',

                            },
                            responseType: 'arraybuffer' //ha ez nincs ismeretlen formátumba ment
                        }
                    ).then((response) => {

                        let blob = new Blob([response.data], {type: 'application/png'})
                        let link = document.createElement('a')
                        link.href = window.URL.createObjectURL(blob)
                        link.download = 'pelda.png'
                        link.click()

                    }).catch(function () {
                        alert("Nem sikerült menteni más formátumba!");
                    });
                }
            },


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

        max-height: 300px;

        max-width: 400px;

    }

    button {
        font-weight: bold;
        color: white;
        font-size: 14px;
        border-radius: 6px;

    }

    .material-icons {
        font-size: small;
    }

    vue-dropzone {
        padding-top: 12px;
        height: 300px;
        width: auto;

    }

    .collapsible {
        background-color: #777;
        color: white;
        cursor: pointer;
        padding: 6px;
        border: none;
        text-align: left;
        outline: none;
        font-size: 16px;
        width: 100%;
        border-radius: 3px;
        opacity: 0.7;
    }

    .active, .collapsible:hover {
        background-color: #555;
    }

    .collapsible:after {
        content: '\002B';
        color: white;
        font-weight: bold;
        float: right;
        margin-left: 5px;
    }

    .active:after {
        content: "\2212";
    }

    .content {
        padding: 0;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.2s ease-out;
        background-color: #f1f1f1;

    }

    tr {
        horiz-align: center;
    }

    thead {
        background-color: #777;
        opacity: 0.7;
        color: white;
        font-size: 16px;
        horiz-align: center;
    }

    td {
        width: 600px;
    }

    table {
        display: block;
        margin-left: auto;
        margin-right: auto;
        border-radius: 3px;

    }


</style>