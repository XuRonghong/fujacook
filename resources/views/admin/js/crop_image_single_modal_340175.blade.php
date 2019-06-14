<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        width: 100%;
    }

    .img-preview-sm {
        width: 170px;
        height: 85px;
    }
</style>
<script>
    var crop_width = 340;
    var crop_height = 175;
    var current_modal;
    var imagedata = {};
</script>
@include('_web._js._crop_image_single_modal')