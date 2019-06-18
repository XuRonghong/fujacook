
@extends('admin.layouts.master')

@section('style')
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid-theme.min.css')}}" rel="stylesheet">
    <link href="{{url('xtreme-admin/assets/libs/jsgrid/dist/jsgrid.min.css')}}" rel="stylesheet">
    <style>
        .btn {
            margin-left: 10px;
        }
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
        .note-editable {
            /*background-color: #fff !important;*/
            color: #3e5569 !important;
        }
    </style>
@endsection

@section('content')
    <!-- ============================================================== -->
    <!-- Page wrapper  -->
    <!-- ============================================================== -->
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
{{--        @include('layouts2.breadcrumb')--}}
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <div class="card" id="manage-modal">
                        <div class="card-body">
                            <h4 class="card-title modalTitle">{{data_get($data,'Title')}}</h4>
                            {{--<h6 class="card-subtitle">{{data_get($data,'Summary')}}</h6>--}}
                        </div>
                        <hr>
                        <form id="sample_form" class="form-horizontal">
                            <div class="card-body messageInfo-modal">
                                <h4 class="card-title"></h4>
                                <div class="form-group row">
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control type" id="com2" name="type">
                                            <option value="home.slider">首頁輪播圖</option>
                                            <option value="home.header">首頁上方圖</option>
                                            <option value="home.advertising">首頁廣告圖</option>
                                            <option value="home.footer">首頁下方圖</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">標頭</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" value="{{data_get($data['arr'], 'title')}}" id="com3" class="form-control title" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">概要</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="summary" value="{{data_get($data['arr'], 'summary')}}" id="com4" class="form-control summary" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="detail" class="col-sm-3 text-right control-label col-form-label">內容</label>
                                    <div class="col-sm-9">
                                        <textarea id="detail" name="editordata">{!! data_get($data['arr'], 'detail') !!}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com5" class="col-sm-3 text-right control-label col-form-label">url</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="url" value="{{data_get($data['arr'], 'url')}}" class="form-control url" id="com5" placeholder="">
                                    </div>
                                </div>

{{--                                <div class="form-group row">--}}
{{--                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">上傳PDF</label>--}}
{{--                                    <div class="col-sm-9">--}}
{{--                                        <input type="file" name="files[]" value="{{$info->vFile[0] or ''}}" id="lname" accept="application/*" class="form-control uploadfile" multiple="multiple">--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--                                <div class="form-group row">--}}
{{--                                    <label for="img1" class="col-sm-3 text-right control-label col-form-label">圖片</label>--}}
{{--                                    <div class="col-sm-9">--}}
{{--                                        <a class="btn-image-modal" data-modal="image-form" data-id="">--}}
{{--                                            <img src="{{data_get($data['arr'], 'image', url('images/empty.jpg'))}}" style="height:140px" alt="">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group row">
                                    <label for="img2" class="col-sm-3 text-right control-label col-form-label">圖片s</label>
                                    <div class="col-sm-9 cropper_image">
                                        @if(isset($data['arr']['image']))
                                            @foreach(data_get( $data['arr'], 'image', []) as $key => $var)
                                                <div class="image-box">
                                                    <img id="{{$key}}" src="{{$var or ''}}">
                                                    <a class="image-del">X</a>
                                                </div>
                                            @endforeach
                                            <a class="btn-image-modal" data-modal="image-form" data-id="">
                                                @if(count(data_get( $data['arr'], 'image', [])) < 5)
                                                    <img id="Image" data-data="" src="{{array_get( $data['arr'], 'image.0', url('images/empty.jpg'))}}" style="height:140px">
                                                @endif
                                            </a>
                                        @else
                                            <a class="btn-image-modal" data-modal="image-form" data-id="">
                                                <img id="Image" data-data="" src="{{url('images/empty.jpg')}}" style="height:140px">
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if( !data_get($data, 'Disable'))
                                        @if($data['arr'])
                                            <button type="button" class="btn btn-success waves-effect waves-light btn-dosave" data-id="{{data_get($data['arr'], 'id')}}">Save</button>
                                        @else
                                            <button type="button" class="btn btn-info waves-effect waves-light btn-doadd">Add</button>
                                        @endif
                                    @endif
                                    <button type="button" class="btn waves-effect waves-light btn-cancel">Cancel</button>
                                </div>
                            </div>
{{--                            <input name="_method" type="hidden" value="PUT">--}}
{{--                            {{csrf_field()}}--}}
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Row -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Page wrapper  -->
    <!-- ============================================================== -->
@endsection



<!-- ================== inline-js ================== -->
@section('inline-js')
    <!-- Public Crop_Image -->
    @include('admin.js.crop_image')
    <!-- Public SummerNote -->
{{--    @include('admin.js.summernote')--}}
    <!-- end -->
    <link href="{{url('_assets/summernote-0.8.9-dist/dist/summernote.css')}}" rel="stylesheet">
    <script src="{{url('_assets/summernote-0.8.9-dist/dist/summernote.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            //
            let disable = '{{data_get($data, 'Disable')}}'
            if (disable){
                $('input[type=text]').attr('disabled','disabled')
                $('select').attr('disabled','disabled')
            }
            //
            var modal = $('#manage-modal')
            current_modal = modal.find('.messageInfo-modal');


            $('#detail').summernote({
                // codemirror: { // codemirror options
                //     theme: 'default',
                // },
                placeholder: 'Hello stand alone ui',
                tabsize: 5,
                height: 300,                 // set editor height
                minHeight: null,             // set minimum height of editor
                maxHeight: null,             // set maximum height of editor
                focus: true,                  // set focus to editable area after initializing summernote
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
                ]
            });

            //
            $(".btn-cancel").click(function (e) {
                e.preventDefault()
                history.back()
            })
            //
            $(".btn-doadd").click(function (e) {
                e.preventDefault();

                //上傳檔案資料庫，回傳file id
                {{--let url = '{{data_get($data, "upload_file_url")}}'--}}
                {{--let file_data = $('.uploadfile').prop('files')[0]--}}
                {{--let data = new FormData();--}}
                {{--data.append("_token", "{{ csrf_token() }}")--}}
                {{--data.append('file', file_data)--}}
                {{--let file_id = ajaxUploadFile(url, data, 'POST')--}}


                //寫入資料庫
                let self = document.querySelector('#sample_form')
                url = '{{data_get($data['route_url'], "store")}}'
                data = new FormData(self)
                // data.append('file_id', file_id)
                data.append('file_id', current_modal.find("img").attr('id'))
                // data.append('image', current_modal.find("img").attr('src'))

                /***  ***/
                let images = "";
                $(".cropper_image").find('img').each(function () {
                    if ($(this).attr('id') != "Image") {
                        //data.vImages = data.vImages + $(this).attr('src') + ";";
                        images = images + $(this).attr('id') + ";";
                    }
                });
                data.append('image', images)

                ajax(url, data, 'POST')
            })
            //
            $(".btn-dosave").click(function (e) {
                e.preventDefault()

                //上傳檔案資料庫，回傳file id
                {{--let url = '{{data_get($data, "upload_file_url")}}'--}}
                {{--let file_data = $('.uploadfile').prop('files')[0]--}}
                {{--let data = new FormData();--}}
                {{--data.append("_token", "{{ csrf_token() }}")--}}
                {{--data.append('file', file_data)--}}
                {{--let file_id = ajaxUploadFile(url, data, 'POST')--}}

                //寫入資料庫
                let self = document.querySelector('#sample_form')
                let id = $(this).data('id')
                url = '{{data_get($data['route_url'], "update")}}'.replace('-10', id)  //-10代替字元為id
                data = new FormData(self)
                // data.append('file_id', file_id)
                data.append('file_id', current_modal.find("img").attr('id'))
                data.append('image', current_modal.find("img").attr('src'))
                // data.append('_method','PUT')

                /***  ***/
                let images = "";
                $(".cropper_image").find('img').each(function () {
                    if ($(this).attr('id') != "Image") {
                        //data.vImages = data.vImages + $(this).attr('src') + ";";
                        images = images + $(this).attr('id') + ";";
                    }
                });
                data.append('image', images)

                ajax(url, data, 'POST')
            })
        })
    </script>
@endsection
<!-- ================== /inline-js ================== -->
