<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        width: 100%;
    }

    .img-preview-sm {
        width: 100px;
        height: 100px;
    }
</style>
<script>
    var crop_width = 500;
    var crop_height = 500;
    var current_modal;
    var imagedata = {};
</script>
@include('_template_web._js._crop_image_single')