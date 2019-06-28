
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
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">type</label>
                                    <div class="col-sm-9">
                                        <select id="com2" name="type" class="form-control type">
                                            <option value="app">app</option>
                                            <option value="meta" selected>meta</option>
                                            <option value="search_keyword">search_keyword</option>
{{--                                            <option value="20" @if($info->iHead<30 && $info->iHead>19) selected @endif>1.{{$permission['10'] or ''}}</option>--}}
{{--                                            <option value="30" @if($info->iHead<40 && $info->iHead>29) selected @endif>2.{{$permission['20'] or ''}}</option>--}}
{{--                                            <option value="40" @if($info->iHead<50 && $info->iHead>39) selected @endif>3.{{$permission['30'] or ''}}</option>--}}
{{--                                            <option value="50" @if($info->iHead<60 && $info->iHead>49) selected @endif>4.{{$permission['40'] or ''}}</option>--}}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">name</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{data_get($data['arr'], 'name')}}" class="form-control name" id="com3" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="content" class="col-sm-3 text-right control-label col-form-label">content</label>
                                    <div class="col-sm-9 note-editable">
                                        <textarea id="content" name="content">
                                            {!! data_get($data['arr'], 'content') !!}
                                        </textarea>
                                    </div>
                                </div>
                                <br>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">value<span style="color:red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="value" value="{{data_get($data['arr'], 'value')}}" class="form-control value" id="com4" placeholder="">
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
    <!-- Public SummerNote -->
    @include('admin.js.summernote2019')
    <!-- end -->
    <script type="text/javascript">
        $(document).ready(function () {

            // 只顯示詳情不開啟編輯功能
            let disable = '{{data_get($data, 'Disable')}}'
            if (disable){
                $('input[type=text]').attr('disabled','disabled')
                $('form #detail').summernote('disable');        //編輯器關閉
            }

            var modal = $('#manage-modal')
            current_modal = modal.find('.messageInfo-modal')

            //文字編輯器
            do_textarea_summernote_fun( $('#content'))
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
                // let data = new FormData(self)
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
                // let data = new FormData(self)
                let data = prop_fromData_fun(self)

                ajax(url, data, 'POST')
            })
        })
    </script>
@endsection
<!-- ================== /inline-js ================== -->
