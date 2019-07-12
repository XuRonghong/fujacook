<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        width: 100%;
    }

    .img-preview-sm {
        width: 314px;
        height: 157.167px;
    }
</style>
<script>
    var crop_width = 1884;
    var crop_height = 943;
    var current_modal;
    var imagedata = {};
</script>
@include('admin.js._crop_image_single')
