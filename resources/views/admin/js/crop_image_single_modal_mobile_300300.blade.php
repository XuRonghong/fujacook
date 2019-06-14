<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        /*width: 100%;*/
    }

    .img-preview-sm-mobile {
        width: 100px;
        height: 100px;
    }
</style>
<script>
    var crop_width_mobile = 300;
    var crop_height_mobile = 300;
    var current_modal_mobile;
    var imagedata_mobile = {};
</script>
@include('_template_web._js._crop_image_single_modal_mobile')