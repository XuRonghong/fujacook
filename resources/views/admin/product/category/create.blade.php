
@extends('admin.layouts.master')

@section('style')
    <style>
        /* 圖片 btn */
        .btn {
            margin-left: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="page-wrapper">

        @include('admin.layouts.breadcrumb')

        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <!-- Row -->
            <div class="row">
                <div class="col-12">
                    <div class="card" id="manage-modal">
                        <div class="card-body">
                            <h4 class="card-title modalTitle"></h4>
                            <h6 class="card-subtitle">{!! data_get($data,'Summary') !!}</h6>
                        </div>
                        <form id="sample_form" class="form-horizontal">
                            <div class="card-body messageInfo-modal">
                                <h4 class="card-title"></h4>
{{--                                <div class="form-group row">--}}
{{--                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">type</label>--}}
{{--                                    <div class="col-sm-9">--}}
{{--                                        <select class="form-control type" id="com2" name="type">--}}
{{--                                            {!! data_get($data['arr'], 'options') !!}--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">類別名稱<span style="color:red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{data_get($data['arr'], 'name')}}" id="com3" class="form-control name" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">value</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="value" value="{{data_get($data['arr'], 'value')}}" id="com4" class="form-control value" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="number" value="{{data_get($data['arr'], 'number')}}" id="com4" class="form-control number" placeholder="">
                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <label for="img1" class="col-sm-3 text-right control-label col-form-label">圖片<span style="color:red">*</span></label>--}}
{{--                                    <div class="col-sm-9">--}}
{{--                                        <a class="btn-image-modal" data-modal="image-form" data-id="">--}}
{{--                                            @forelse(data_get( $data['arr'], 'image', []) as $key => $var)--}}
{{--                                                <img id="{{$key}}" src="{{$var or ''}}" style="height:140px" alt="">--}}
{{--                                            @empty--}}
{{--                                                <img src="{{url('images/empty.jpg')}}" style="height:140px" alt="">--}}
{{--                                            @endforelse--}}
{{--                                        </a>--}}
{{--                                        <br>--}}
{{--                                        <span style="color:red">如要更換圖片，點擊上方</span>--}}
{{--                                        @forelse(data_get( $data['arr'], 'image', []) as $key => $var)--}}
{{--                                            <img id="img1" src="{{$var or ''}}" style="height:140px" alt="">--}}
{{--                                        @empty--}}
{{--                                            <img id="img1" src="{{url('images/empty.jpg')}}" style="height:140px" alt="">--}}
{{--                                        @endforelse--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group row">
                                    <label for="com6" class="col-sm-3 text-right control-label col-form-label">Create at</label>
                                    <div class="col-sm-9" style="margin-top: 10px">
                                        {{data_get($data['arr'], 'created_at', date('Y-m-d H:i:s'))}}
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    @if( !data_get($data, 'Disable'))
                                        @if(data_get($data['arr'], 'id'))
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
    </div>
@endsection

@section('inline-js')
    <!-- Public Crop_Image -->
    @include('admin.js.crop_image_single_custom')
    <!-- Public SummerNote -->
    @include('admin.js.summernote2019')
    <!-- end -->
    <script type="text/javascript">
    function document_ready() {

        // 只顯示詳情不開啟編輯功能
        let disable = '{{data_get($data, 'Disable')}}'
        if (disable){
            $('form#sample_form input[type=text]').attr('disabled','disabled')
            $('form select').attr('disabled','disabled')
            $('form #detail').summernote('disable');        //編輯器關閉
            $('form .image-del').css("visibility","hidden");    //刪除區塊隱藏
            $('form #Image').css("display","none");     //加載圖片關閉
            //唯讀
            $('form .btn-image-modal ,form span').hide()
        } else { $('#img1').hide() }

        //
        var modal = $('#manage-modal')
        current_modal = modal.find('.messageInfo-modal')

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
            let data = prop_fromData_fun(self)

            ajax(url, data, 'POST')
        })
    }
    </script>
@endsection
