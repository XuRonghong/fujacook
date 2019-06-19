<!-- SUMMERNOTE -->
<style>
    <!--
    .popover {
        z-index: 1050;
    }
    -->

    /*文字編輯器*/
    .note-editable {
        /*background-color: #fff !important;*/
        /*color: #3e5569 !important;*/
    }
    .note-editable .note-toolbar-wrapper {
        background-color: #ccc !important;
        color: #000 !important;
    }
    .note-editable .btn-default {
        background-color: #ccc !important;
        color: #000 !important;
        /*opacity: 0.1;*/
    }
</style>
<link href="{{url('assets/summernote-0.8.9-dist/dist/summernote.css')}}" rel="stylesheet">
<script src="{{url('assets/summernote-0.8.9-dist/dist/summernote.js')}}"></script>
<!-- include summernote css/js -->
<script>
    function do_textarea_summernote_fun(model)
    {
        model.summernote({
            placeholder: 'Hello stand alone ui',
            tabsize: 5,
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: false,                  // set focus to editable area after initializing summernote
            lang: 'zh-TW',          // default: 'en-US'
            fontSizes: ['8', '9', '10', '11', '12', '14', '18', '24', '36', '48' , '64', '82', '150'],
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['view', ['fullscreen', 'codeview']],
            ],
        })
    }


    function sendFile(files, editor) {
        if (files.size > 2 * 1024 * 1024) {
            swal("{{trans('_web_alert.notice')}}", "{{trans('_web_alert.cropper_image_too_big')}}:2 MB", "error");
            return;
        }
        data = new FormData();
        data.append("_token", "{{ csrf_token() }}");
        data.append("files", files);
        $.ajax({
            data: data,
            type: "POST",
            url: "{{url('web/upload_image')}}",
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(editor).summernote('editor.insertImage', data.files[0].url);
            }
        });
    }
</script>
