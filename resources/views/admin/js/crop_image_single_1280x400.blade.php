<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        width: 100%;
    }

    .img-preview-sm {
        width: 256px;
        height: 80px;
    }
</style>
<script>
    var crop_width = 1280;
    var crop_height = 400;
    var current_modal;
    var imagedata = {};
</script>
@include('admin.js._crop_image_single')
