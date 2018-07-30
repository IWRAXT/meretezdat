
<template>

    <div class="container">
        <div class="large-12 medium-12 small-12 cell">
            <label>Click here to upload a file
                <input type="file" id="file"  @change="GetImage"/>
                <img :src="avatar" alt="Image">
            </label>
            <button @click="onUpload">Upload!</button>
        </div>
    </div>

</template>

<script>
    export default {
        // name: "UploadComponent",
        data() {
            return {
               image: null,
                avatar: null,

            }
        },
        methods: {

            GetImage (event) {
                // console.log(event)
                let image =event.target.files[0];
                    const formData = new FormData();
                    formData.append('hal', this.image, 'ponty2.jpg');
                let reader= new FileReader();
                reader.readAsDataURL(image);
                reader.onload = event =>{
                    this.avatar=event.target.result}


            },
            onUpload() {

                axios.post('/image', this.formData)
                    .catch(function (error) {
                        alert("Hiba történt a kép feltöltése során!");
                        console.log(error);
                });


            }
        }
    }

</script>

<style scoped>
    /*.form-group {*/
        /*outline: 2px dashed grey; !* the dash box *!*/
        /*outline-offset: -10px;*/
        /*background: #b9beff;*/
        /*color: dimgray;*/
        /*padding: 10px 10px;*/
        /*min-height: 200px; !* minimum height *!*/
        /*position: relative;*/
        /*!*cursor: pointer;*!*/
    /*}*/

    /*.form-control-file {*/
        /*!*opacity: 0; !* invisible but it's there! *!*!*/
        /*width: 100%;*/
        /*height: 200px;*/
        /*position: relative;*/
        /*!*cursor: pointer;*!*/
    /*}*/

    /*.form-group:hover {*/
        /*background: #dedfd7; !* when mouse over to the drop zone, change color *!*/
    /*}*/

    /*.form-group p {*/
        /*font-size: 1.2em;*/
        /*text-align: center;*/
        /*padding: 50px 0;*/
    /*}*/


    /*input[type="file"]{*/
        /*position: absolute;*/
        /*top: -500px;*/
    /*}*/
    /*div.file-listing{*/
        /*width: 200px;*/
    /*}*/
    /*span.remove-file{*/
        /*color: red;*/
        /*cursor: pointer;*/
        /*float: right;*/
    /*}*/

    img {
        height: 100px;
        width: auto;
    }

</style>