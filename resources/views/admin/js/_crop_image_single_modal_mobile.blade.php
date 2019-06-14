<!-- Image cropper -->
<link href="/web_assets/v1/css/plugins/cropper/cropper.min.css" rel="stylesheet">
<div id="image-mobile-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 800px; height: 400px;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{trans('_web_alert.cropper_image')}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="image-mobile-crop">
                            <img style="width: 100%; height: auto" src="/images/empty.jpg">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h4>{{trans('_web_alert.upload.image_preview')}}</h4>
                        <div class="img-preview img-preview-sm-mobile"></div>
                        <div class="btn-group">
                            <label title="Upload image file" for="inputImage-Mobile" class="btn btn-primary"> <input type="file" accept="image/*" name="file" id="inputImage-Mobile"
                                                                                                              class="hide"> {{trans('_web_alert.upload.image_new')}}
                            </label>
                            <button class="btn btn-warning" id="setDrag-Mobile" type="button">{{trans('_web_alert.upload.image_crop')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/web_assets/v1/js/plugins/cropper/cropper.min.js"></script>
<script>
    $(document).ready(function () {
        $(".btn-image-mobile-modal").click(function () {
            $('#image-mobile-form').modal();
        })
        var $image = $(".image-mobile-crop > img")
        $($image).cropper({
            aspectRatio: crop_width_mobile/crop_height_mobile,
            preview: ".img-preview",
            data: {
                width: crop_width_mobile,
                height: crop_height_mobile
            },
            done: function (data) {
                // Output the result data for cropping image.
            }
        });

        var $inputImage = $("#inputImage-Mobile");
        if (window.FileReader) {
            $inputImage.change(function () {
                var fileReader = new FileReader(),
                    files = this.files,
                    file;
                if (!files.length) {
                    return;
                }

                file = files[0];
                if (file.size > 1 * 1024 * 1024) {
                    swal("{{trans('_web_alert.notice')}}", "{{trans('_web_alert.cropper_image_too_big')}}:1 MB", "error");
                    return;
                }
                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#zoomIn").click(function () {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function () {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function () {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function () {
            $image.cropper("rotate", -45);
        });

        $("#setDrag-Mobile").click(function () {
            $('#image-mobile-form').modal('hide');
            $image.cropper("setDragMode", "crop");
            swal("{{trans('_web_alert.notice')}}", "{{trans('_web_alert.cropper_success')}}", "success");
            var image = $image.cropper("getDataURL", "image/jpeg");
            sendImage(image);
            current_modal_mobile.find('img').attr('src', imagedata.path);
            current_modal_mobile.find('img').attr('id', imagedata.fileid);
        });
    });

    function sendImage(image) {
        data = new FormData();
        data.append("_token", "{{ csrf_token() }}");
        data.append("image", image);
        $.ajax({
            data: data,
            type: "POST",
            url: "{{url('web/upload_image_base64')}}",
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            success: function (rtndata) {
                imagedata = rtndata.info;
            }
        });
    }
</script>