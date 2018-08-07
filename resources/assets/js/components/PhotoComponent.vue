<template>
    <div>
        <upload></upload>
        <crop></crop>
    </div>
</template>

<script>
    // import Upload from './UploadComponent.vue'
    // import Crop from './Cropper.vue'
    export default {
        name: "PhotoComponent",
        img_src: '',
        components: {
            // 'upload': Upload,
            // 'crop' : Crop
        }
    }
</script>

<style scoped>

</style>