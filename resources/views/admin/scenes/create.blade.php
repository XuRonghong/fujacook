
@extends('admin.layouts.master')

@section('style')
    <style>
        .btn {
            margin-left: 10px;
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

                                <div class="form-group row">
                                    <label for="detail" class="col-sm-3 text-right control-label col-form-label">內容</label>
                                    <div class="col-sm-9 note-editable">
                                        <textarea id="detail" name="detail">
                                            {!! data_get($data['arr'], 'detail') !!}
                                        </textarea>
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


@section('inline-js')
    <!-- Public Crop_Image -->
    @include('admin.js.crop_image')
    <!-- Public SummerNote -->
    @include('admin.js.summernote2019')
    <!-- end -->
    <script type="text/javascript">
    $(document).ready(function () {

        // 只顯示詳情不開啟編輯功能
        let disable = '{{data_get($data, 'Disable')}}'
        if (disable){
            $('input[type=text]').attr('disabled','disabled')
            $('form select').attr('disabled','disabled')
            $('form #detail').summernote('disable');        //編輯器關閉
            $('form .image-del').css("visibility","hidden");    //刪除區塊隱藏
            $('form #Image').css("display","none");     //加載圖片關閉
        }

        // 為了做圖片編輯
        var modal = $('#manage-modal')
        current_modal = modal.find('.messageInfo-modal')

        //文字編輯器
        do_textarea_summernote_fun( $('#detail'))
        // do_textarea_summernote_fun( $('#detail'))

        //返回上一頁
        $(".btn-cancel").click(function (e) {
            e.preventDefault()
            history.back()
        })

        //新增模式
        $(".btn-doadd").click(function (e) {
            e.preventDefault();

            //寫入資料庫
            let url = '{{data_get($data['route_url'], "store")}}'
            let self = document.querySelector('#sample_form')
            let data = prop_fromData_fun(self)

            ajax(url, data, 'POST')
        })

        //編輯模式
        $(".btn-dosave").click(function (e) {
            e.preventDefault()

            //寫入資料庫
            let id = $(this).data('id')
            let url = '{{data_get($data['route_url'], "update")}}'.replace('-10', id)  //-10代替字元為id
            let self = document.querySelector('#sample_form')
            let data = put_fromData_fun(self)

            ajax(url, data, 'POST')
        })
    })
    </script>
@endsection
