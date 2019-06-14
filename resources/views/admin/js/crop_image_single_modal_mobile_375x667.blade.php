<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        /*width: 100%;*/
    }

    .img-preview-sm-mobile {
        width: 125px;
        height: 225px;
    }
</style>
<script>
    var crop_width_mobile = 375;
    var crop_height_mobile = 675;
    var current_modal_mobile;
    var imagedata_mobile = {};
</script>
@include('_template_web._js._crop_image_single_modal_mobile')