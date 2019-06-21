<style>
    /* Image cropper style */
    .img-container, .img-preview {
        overflow: hidden;
        text-align: center;
        width: 100%;
    }

    .img-preview-sm {
        width: 150px;
        height: 150px;
    }


    /*多圖片*/
    .image-box {
        float: left;
    }
    .image-box img {
        height: 140px;
    }
    .image-del {
        vertical-align: top;
        margin-right: 15px;
    }
    /*客製化*/
    .col-mystyle {
        padding-left: 30px;
    }
    .btn-group-mystyle {
        margin-left: 100px;
        margin-top: 50px;
    }
</style>
<!-- Image cropper -->
<link href="{{url('css/cropper.min.css')}}" rel="stylesheet">
<div id="image-form" class="modal fade" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
                <h4 class="modal-title">{{trans('web_alert.cropper_image')}}</h4>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="image-crop">
							<img style="width: 100%; height: auto" src="{{url('images/empty.jpg')}}">
						</div>
					</div>
					<div class="col-sm-6 col-mystyle">
						<h5>{{trans('web_alert.upload.image_preview')}}</h5>
						<div class="img-preview img-preview-sm"></div>
						<div class="btn-group btn-group-mystyle">
							<label title="Upload image file" for="inputImage" class="btn btn-primary">
								<input type="file" accept="image/*" name="file" id="inputImage" class="hide">
								{{trans('web_alert.upload.image_new')}}
							</label>
							<label class="btn btn-warning" id="setDrag" type="button">
								{{trans('web_alert.upload.image_crop')}}
							</label>
							{{--<button class="btn btn-warning" id="setDrag" type="button">--}}
								{{--{{trans('web_alert.upload.image_crop')}}--}}
							{{--</button>--}}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{url('js/cropper.min.js')}} "></script>
<script>
$(document).ready(function() {

    let imagedata = {};

    $(".btn-image-modal").click(function() {
        $('#image-form').modal();
    });

    let $image = $(".image-crop > img");
    $($image).cropper({
        aspectRatio: 1,
        //aspectRatio: 3.097,
        preview: ".img-preview",
        data: {
            width: 800,
            height: 800
        },
        done: function(data) {
            // Output the result data for cropping image.
        }
    });

    let $inputImage = $("#inputImage");
    if (window.FileReader) {
        $inputImage.change(function() {
            let fileReader = new FileReader(),
                files = this.files,
                file;
            if (!files.length) {
                return;
            }

            file = files[0];
            if( file.size > 1*1024*1024 ){
            	swal("{{trans('web_alert.notice')}}", "{{trans('web_alert.cropper_image_too_big')}}:1 MB", "error");
            	return;
            }
            if (/^image\/\w+$/.test(file.type)) {
                fileReader.readAsDataURL(file);
                fileReader.onload = function() {
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

    $("#zoomIn").click(function() {
        $image.cropper("zoom", 0.1);
    });

    $("#zoomOut").click(function() {
        $image.cropper("zoom", -0.1);
    });

    $("#rotateLeft").click(function() {
        $image.cropper("rotate", 45);
    });

    $("#rotateRight").click(function() {
        $image.cropper("rotate", -45);
    });

    $("#setDrag").click(function() {
        $('#image-form').modal('hide');
        $image.cropper("setDragMode", "crop");
        Swal.fire("{{trans('web_alert.notice')}}", "{{trans('web_alert.cropper_success')}}", "success");
        let image = $image.cropper("getDataURL", "image/jpeg");
        sendImage(image);
        $('.cropper_image').find('.btn-image-modal').before("<div id=\"div_"+imagedata.fileid+"\" class=\"image-box\"></div>");
        let cropImage = new Image();
        cropImage.src = imagedata.path;
        cropImage.id = imagedata.fileid;
        cropImage.addClass = "del-image";
        $('#div_'+imagedata.fileid).append(cropImage);
        $('#div_'+imagedata.fileid).append("<a class=\"image-del\">X</a>");
        $('#image-form').hide();
    	if($('.cropper_image').find('img').length > 5){
    		$('.cropper_image').find('#Image').remove();
    	}
    	//** 多圖片 **/
        $('#div_'+imagedata.fileid).attr('src', imagedata.path);
        $('#div_'+imagedata.fileid).attr('id', imagedata.fileid);
        //** 單圖片 **/
        // current_modal.find('img').attr('src', imagedata.path);
        // current_modal.find('img').attr('id', imagedata.fileid);
        //
    });

    $('.cropper_image').on('click', '.image-del', function () {
    	$(this).closest('.image-box').remove();
    	if($('.cropper_image').find('img').length < 5 && $('.cropper_image').find('#Image').length == 0 ){
    		 let cropImage = new Image();
    	        cropImage.src = "{{asset('/images/empty.jpg')}}";
    	        cropImage.id = "Image";
    		$('.cropper_image .btn-image-modal').append(cropImage);
    	}
    });

    function sendImage(image){
        let data = new FormData();
        data.append("_token", "{{ csrf_token() }}");
        data.append("image", image);
        $.ajax({
            data: data,
            type: "POST",
            url: '{{data_get($data, "upload_image_base64_url")}}',
            cache: false,
            contentType: false,
            processData: false,
            async:false,
            success: function(rtndata) {
                imagedata = rtndata.info;
            },
            error: function (err) {
                console.log(err.responseJSON)
                toastr.error(JSON.stringify(err.responseJSON), "{{trans('web_alert.notice')}}")
            }
        });
    }
});
</script>
