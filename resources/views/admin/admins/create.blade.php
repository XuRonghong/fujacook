
@extends('admin.layouts.master')

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
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">目標階層</label>
                                    <div class="col-sm-9">
                                        <select class="form-control iHead" id="com2" name="type">
                                            @if(isset($info))
                                                <option value="10" @if($info->iHead<20) selected @endif>{{$permission['2'] or ''}}</option>
                                                <option value="20" @if($info->iHead<30 && $info->iHead>19) selected @endif>1.{{$permission['10'] or ''}}</option>
                                            @endif
                                            <option value="3">管理者</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{data_get($data['arr'], 'name')}}" class="form-control title" id="com3" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" value="{{data_get($data['arr'], 'email')}}" class="form-control summary" id="com4" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com5" class="col-sm-3 text-right control-label col-form-label">account</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="account" value="{{data_get($data['arr'], 'account')}}" class="form-control summary" id="com5" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com6" class="col-sm-3 text-right control-label col-form-label">password</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" value="{{data_get($data['arr'], 'password')}}" class="form-control summary" id="com6" placeholder="">
                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <label for="img1" class="col-sm-3 text-right control-label col-form-label">圖片</label>--}}
{{--                                    <div class="col-sm-9">--}}
{{--                                        <a class="btn-image-modal" data-modal="image-form" data-id="">--}}
{{--                                            <img src="{{$info->vImages or url('images/empty.jpg')}}" style="height:140px">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
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
    @include('admin.js.summernote')
    <!-- end -->
    <script type="text/javascript">
        $(document).ready(function () {
            //
            let disable = '{{data_get($data, 'Disable')}}'
            if (disable) $('input[type=text]').attr('disabled','disabled')

            //
            $(".btn-cancel").click(function (e) {
                e.preventDefault()
                history.back()
            })
            //
            $(".btn-doadd").click(function (e) {
                e.preventDefault();
                let self = document.querySelector('#sample_form')
                let url = '{{data_get($data['route_url'], "store")}}'
                let data = new FormData(self)
                //
                ajax(url, data, 'POST')
            })
            //
            $(".btn-dosave").click(function (e) {
                e.preventDefault()
                let self = document.querySelector('#sample_form')
                let id = $(this).data('id')
                let url = '{{data_get($data['route_url'], "update")}}'.replace('-10', id)  //-10代替字元為id
                let data = new FormData(self)
                // data._method = 'PUT'
                ajax(url, data, 'POST')
            })
        })
    </script>
@endsection
<!-- ================== /inline-js ================== -->