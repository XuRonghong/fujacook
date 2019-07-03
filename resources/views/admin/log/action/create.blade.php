
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
                                    <label for="com3" class="col-sm-2 text-right control-label col-form-label">User name</label>
                                    <div class="col-sm-10">
                                        {{data_get($data['arr'], 'name')}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-2 text-right control-label col-form-label">User id</label>
                                    <div class="col-sm-10">
                                        {{data_get($data['arr'], 'type')}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com2" class="col-sm-2 text-right control-label col-form-label">User no</label>
                                    <div class="col-sm-10">
                                        {{data_get($data['arr'], 'no')}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com6" class="col-sm-2 text-right control-label col-form-label">IP</label>
                                    <div class="col-sm-10">
                                        {{data_get($data['arr'], 'ip')}}
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="com5" class="col-sm-2 text-right control-label col-form-label">Table</label>
                                    <div class="col-sm-10">
                                        {{data_get($data['arr'], 'table_name')}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com5" class="col-sm-2 text-right control-label col-form-label">Table id</label>
                                    <div class="col-sm-10">
                                        {{data_get($data['arr'], 'table_id')}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com5" class="col-sm-2 text-right control-label col-form-label">Action</label>
                                    <div class="col-sm-10">
                                        {{data_get($data['arr'], 'action')}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com5" class="col-sm-2 text-right control-label col-form-label">Value</label>
                                    <div class="col-sm-10">
                                        {!! data_get($data['arr'], 'value') !!}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com7" class="col-sm-2 text-right control-label col-form-label">Create at</label>
                                    <div class="col-sm-10">
                                        {{data_get($data['arr'], 'created_at')}}
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com8" class="col-sm-2 text-right control-label col-form-label">Update at</label>
                                    <div class="col-sm-10">
                                        {{data_get($data['arr'], 'updated_at')}}
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
        })
    </script>
@endsection
<!-- ================== /inline-js ================== -->
