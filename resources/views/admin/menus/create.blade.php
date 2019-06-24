
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
                                {{--<div class="form-group row">--}}
                                    {{--<label for="com2" class="col-sm-3 text-right control-label col-form-label">目標階層</label>--}}
                                    {{--<div class="col-sm-9">--}}
                                        {{--<select class="form-control iHead" id="com2" >--}}
                                            {{--@if(isset($info))--}}
                                                {{--<option value="10" @if($info->iHead<20) selected @endif>{{$permission['2'] or ''}}</option>--}}
                                                {{--<option value="20" @if($info->iHead<30 && $info->iHead>19) selected @endif>1.{{$permission['10'] or ''}}</option>--}}
                                                {{--<option value="30" @if($info->iHead<40 && $info->iHead>29) selected @endif>2.{{$permission['20'] or ''}}</option>--}}
                                                {{--<option value="40" @if($info->iHead<50 && $info->iHead>39) selected @endif>3.{{$permission['30'] or ''}}</option>--}}
                                                {{--<option value="50" @if($info->iHead<60 && $info->iHead>49) selected @endif>4.{{$permission['40'] or ''}}</option>--}}
                                                {{--<option value="60" @if($info->iHead<70 && $info->iHead>59) selected @endif>5.{{$permission['50'] or ''}}</option>--}}
                                                {{--<option value="70" @if($info->iHead<80 && $info->iHead>69) selected @endif>6.{{$permission['60'] or ''}}</option>--}}
                                            {{--@else--}}
                                                {{--@if(isset($permission))--}}
                                                {{--@foreach($permission as $key => $value)--}}
                                                    {{--@if($key=='2')--}}
                                                        {{--<option value="10">{{$value or ''}}</option>--}}
                                                    {{--@else--}}
                                                        {{--<option value="{{ intval($key)+10 }}">{{$value or ''}}</option>--}}
                                                    {{--@endif--}}
                                                {{--@endforeach--}}
                                                {{--@endif--}}
                                            {{--@endif--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" value="{{data_get($data['arr'], 'name')}}" class="form-control title" id="com3" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">description</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="summary" value="{{data_get($data['arr'], 'description')}}" class="form-control summary" id="com4" placeholder="">
                                    </div>
                                </div>
                                {{--<div class="form-group row">--}}
                                    {{--<label for="com4" class="col-sm-3 text-right control-label col-form-label">概要</label>--}}
                                    {{--<div class="col-sm-9">--}}
                                        {{--<input type="text" class="form-control summary" id="com4" placeholder="" value="{{data_get($news, 'summary')}}">--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                {{--<label for="com5" class="col-sm-3 text-right control-label col-form-label">Detail</label>--}}
                                {{--<div class="col-sm-9">--}}
                                {{--<input type="text" class="form-control vDetail" id="com5" placeholder="" value="{{ $info->vDetail or ''}}">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="form-group row">--}}
                                    {{--<label for="img1" class="col-sm-3 text-right control-label col-form-label">圖片</label>--}}
                                    {{--<div class="col-sm-9">--}}
                                        {{--<a class="btn-image-modal" data-modal="image-form" data-id="">--}}
                                            {{--<img src="{{$info->vImages or url('images/empty.jpg')}}" style="height:140px">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
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
                            {{csrf_field()}}
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
    <script type="text/javascript">
        $(document).ready(function () {

            // 只顯示詳情不開啟編輯功能
            let disable = '{{data_get($data, 'Disable')}}'
            if (disable){
                $('input[type=text]').attr('disabled','disabled')
            }

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
                let data = new FormData(self)
                // let data = prop_fromData_fun(self)

                ajax(url, data, 'POST')
            })

            //編輯模式
            $(".btn-dosave").click(function (e) {
                e.preventDefault()

                //寫入資料庫
                let id = $(this).data('id')
                let url = '{{data_get($data['route_url'], "update")}}'.replace('-10', id)  //-10代替字元為id
                let self = document.querySelector('#sample_form')
                let data = new FormData(self)
                // let data = put_fromData_fun(self)

                ajax(url, data, 'POST')
            })
        })
    </script>
@endsection
<!-- ================== /inline-js ================== -->
