
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
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">標頭</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" class="form-control title" id="com3" placeholder="" value="{{data_get($news, 'title')}}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">概要</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="summary" class="form-control summary" id="com4" placeholder="" value="{{data_get($news, 'summary')}}">
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
                                    @if($news)
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-dosave" data-id="{{data_get($news, 'id')}}">Save</button>
                                    @else
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-doadd">Add</button>
                                    @endif
                                    <button type="button" class="btn btn-dark waves-effect waves-light btn-cancel">Cancel</button>
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
    <!--  -->
    <!-- Public Crop_Image -->
    {{--@include('_web._js.crop_image')--}}
    <!-- end -->
    <!-- Public SummerNote -->
    {{--@include('_web._js.summernote')--}}
    <!-- end -->
    <script type="text/javascript">
        $(document).ready(function () {
            //
            let modal = $("#manage-modal");
            let current_modal = modal.find('.messageInfo-modal');
            //
            $(".btn-cancel").click(function () {
                history.back();
            });
            //
            $(".btn-doadd").click(function () {
                let self = document.querySelector('#sample_form');
                //
                $.ajax({
                    url: '{{route('admin.news.store')}}',
                    type: "POST",
                    dataType:"json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: new FormData(self),
                    resetForm: true,
                    success: function (data) {
                        if (data.status) {
                            //
                            //sendNotifyMessage(rtndata.newid , rtndata.heads_token , current_modal.find(".vTitle").val() , current_modal.find(".vSummary").val());
                            //
                            toastr.success(data.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = data.redirectUrl;
                            }, 1000)
                        } else {
                            toastr.error(data.message, "{{trans('_web_alert.notice')}}");
                        }
                    },
                    error: function (err) {
                        console.log(err.responseJSON);
                        toastr.error(JSON.stringify(err.responseJSON), "{{trans('_web_alert.notice')}}");
                    }
                });
            });

            //
            $(".btn-dosave").click(function () {
                let self = document.querySelector('#sample_form');
                let id = $(this).data('id');
                //
                $.ajax({
                    url: '{{url('admin/news/update')}}'+ '/'+ id,
                    type: "POST",
                    dataType:"json",
                    contentType: false,
                    processData: false,
                    cache: false,
                    data: new FormData(self),
                    resetForm: true,
                    success: function (data) {
                        if (data.status) {
                            toastr.success(data.message, "{{trans('_web_alert.notice')}}");
                            setTimeout(function () {
                                location.href = data.redirectUrl;
                            }, 1000)
                        } else {
                            toastr.error(data.message, "{{trans('_web_alert.notice')}}");
                        }
                    }
                });
            });

            let disable = '{{data_get($data, 'Disable')}}'
            if (disable) $('input[type=text]').attr('disabled','disabled');
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->