
@extends('admin.layouts.master')

@section('style')
    <style>
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
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">name<span style="color:red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{data_get($data['arr'], 'name')}}"
                                               class="form-control name" id="com3" placeholder="例: admin.admin.index">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">description<span style="color:red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="description" value="{{data_get($data['arr'], 'description')}}"
                                               class="form-control description" id="com4" placeholder="例: 帳號管理-個人資料 檢視">
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
    </div>
@endsection

@section('inline-js')
    <script type="text/javascript">
        function document_ready() {

            // 只顯示詳情不開啟編輯功能
            let disable = '{{data_get($data, 'Disable')}}'
            if (disable){
                $('form#sample_form input[type=text]').attr('disabled','disabled')
            }

            // 為了做圖片編輯
            var modal = $('#manage-modal')
            current_modal = modal.find('.messageInfo-modal')

            //返回上一頁
            $(".btn-cancel").click(function (e) {
                e.preventDefault()
                history.back()
            })

            // 滑動開關切換按鈕
            $('#switch_demo').click(function () {
                if ($(this).val()==1){
                    $(this).val(0)
                } else {
                    $(this).val(1)
                }
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
