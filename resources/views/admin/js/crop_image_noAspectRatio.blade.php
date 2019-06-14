<style>
/* Image cropper style */
.img-container, .img-preview {
	overflow: hidden;
	text-align: center;
	width: 100%;
}

.img-preview-sm {
	width: 200px;
	height: 200px;
}
</style>
<!-- Image cropper -->
<link href="{{url('css/cropper.min.css')}}" rel="stylesheet">
<div id="image-form" class="modal fade" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" style="width: 960px; height: 480px; margin-left: -240px;">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				{{--<h4 class="modal-title">{{trans('_web_alert.cropper_image')}}</h4>--}}
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="image-crop">
							<img style="width: 100%; height: auto" src="{{url('images/empty.jpg')}}">
						</div>
					</div>
					<div class="col-sm-6">
						<h4>{{trans('_web_alert.upload.image_preview')}}</h4>
						<div class="img-preview img-preview-sm"></div>
						<br>
						<div class="btn-group">
							<label title="Upload image file" for="inputImage" class="btn btn-primary">
								<input type="file" accept="image/*" name="file" id="inputImage" class="hide">
								{{trans('_web_alert.upload.image_new')}}
							</label>
							<label class="btn btn-warning" id="setDrag" type="button" data-id="img1">
								{{trans('_web_alert.upload.image_crop')}}
							</label>
							{{--<button class="btn btn-warning" id="setDrag" type="button">--}}
								{{--{{trans('_web_alert.upload.image_crop')}}--}}
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
var imagedata = {};
var img ;
$(document).ready(function() {
    //
    $(".btn-image-modal1").click(function() {
        img = $(this).data('id');
        $('#image-form').modal();
    });
    $(".btn-image-modal2").click(function() {
        img = $(this).data('id');
        $('#image-form').modal();
    });
    $(".btn-image-modal3").click(function() {
        img = $(this).data('id');
        $('#image-form').modal();
    });
    //
    var $image = $(".image-crop > img");
    $($image).cropper({
        // aspectRatio: 1,
        //aspectRatio: 3.097,
        preview: ".img-preview",
        data: {
            width: 500,
            height: 500
        },
        done: function(data) {
            // Output the result data for cropping image.
        }
    });

    var $inputImage = $("#inputImage");
    if (window.FileReader) {
        $inputImage.change(function() {
            var fileReader = new FileReader(),
                files = this.files,
                file;
            if (!files.length) {
                return;
            }

            file = files[0];
            if( file.size > 1*1024*1024*5 ){
            	swal("{{trans('_web_alert.notice')}}", "{{trans('_web_alert.cropper_image_too_big')}}:5 MB", "error");
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
        swal("{{trans('_web_alert.notice')}}", "{{trans('_web_alert.cropper_success')}}", "success");
        var image = $image.cropper("getDataURL", "image/jpeg");
        sendImage(image);
        $('.cropper_image').find('.btn-image-modal'+img).before("<div id=\"div_"+imagedata.fileid+"\" class=\"image-box\"></div>");
        var cropImage = new Image();
        cropImage.src = imagedata.path;
        cropImage.id = imagedata.fileid;
        cropImage.addClass = "del-image";
        $('#div_'+imagedata.fileid).append(cropImage);
        $('#div_'+imagedata.fileid).append("<a class=\"image-del\">X</a>");
        $('#image-form').hide();
        //上傳大於五張
    	// if($('.cropper_image').find('#img'+img).length > 5){
    		// $('.cropper_image').find('#Image').remove();
    	// }
    	//
        current_modal.find('#img'+img).attr('src', imagedata.path);
        current_modal.find('#img'+img).attr('id', imagedata.fileid);
        //
    });

    $('.cropper_image').on('click', '.image-del', function () {
    	$(this).closest('.image-box').remove();
    	if($('.cropper_image').find('#img'+img).length < 5 && $('.cropper_image').find('#img'+img).length == 0 ){
    		 var cropImage = new Image();
    	        cropImage.src = "{{asset('/images/empty.jpg')}}";
    	        cropImage.id = "Image";
    		$('.cropper_image .btn-image-modal').append(cropImage);
    	}
    });
});

function sendImage(image){
	var data = new FormData();
	data.append("_token", "{{ csrf_token() }}");
	data.append("image", image);
	$.ajax({
	    data: data,
	    type: "POST",
	    url: "{{url('web/upload_image_base64')}}",
	    cache: false,
	    contentType: false,
	    processData: false,
	   	async:false,
	    success: function(rtndata) {
	    	imagedata = rtndata.info;
	    }
	});
}
</script>