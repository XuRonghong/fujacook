<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        width: 100%;
    }

    .img-preview-sm {
        width: 263px;
        height: 152px;
    }
</style>
<script>
    var crop_width = 263;
    var crop_height = 152;
    var current_modal;
    var imagedata = {};
</script>
@include('_template_web._js._crop_image_single')