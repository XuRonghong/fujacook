
@extends('admin.layouts.master')

@section('style')
    <style>
        /* 圖片 btn */
        .btn {
            margin-left: 10px;
        }
        /* 新增按鈕 */
        #create_record {
            visibility: hidden;
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
                            <div class="form-group row">
                                <label for="com1" class="col-sm-3 text-right control-label col-form-label">No.</label>
                                <div class="col-sm-9">
                                    <input type="text" name="no" value="{{data_get($data['arr'], 'no')}}"
                                           id="com1" class="form-control no" placeholder="訂單號">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="chos1" class="col-sm-3 text-right control-label col-form-label">Type</label>
                                <div class="col-sm-9">
                                    <select class="form-control type" id="chos1" name="type" title="訂單聯絡人類型">
                                        {!! data_get($data['arr'], 'order_contacts') !!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com4" class="col-sm-3 text-right control-label col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input type="text" name="name" value="{{data_get($data['arr'], 'name')}}"
                                           id="com4" class="form-control name" placeholder="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com5" class="col-sm-3 text-right control-label col-form-label">Gender</label>
                                <div class="col-sm-9">
                                    <input type="text" name="gender" value="{{data_get($data['arr'], 'gender')}}"
                                           id="com5" class="form-control gender" placeholder="gender">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com6" class="col-sm-3 text-right control-label col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" name="email" value="{{data_get($data['arr'], 'email')}}"
                                           id="com6" class="form-control email" placeholder="電子信箱">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com7" class="col-sm-3 text-right control-label col-form-label">Contact Phone</label>
                                <div class="col-sm-9">
                                    <input type="text" name="phone" value="{{data_get($data['arr'], 'phone')}}"
                                           id="com7" class="form-control phone" placeholder="連絡電話">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="com8" class="col-sm-3 text-right control-label col-form-label">Zip_code</label>
                                <div class="col-sm-9">
                                    <input type="text" name="zip_code" value="{{data_get($data['arr'], 'zip_code')}}"
                                           id="com8" class="form-control zip_code" placeholder="郵政編碼">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com9" class="col-sm-3 text-right control-label col-form-label">County</label>
                                <div class="col-sm-9">
                                    <input type="text" name="county" value="{{data_get($data['arr'], 'county')}}"
                                           id="com9" class="form-control county" placeholder="縣市">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com10" class="col-sm-3 text-right control-label col-form-label">District</label>
                                <div class="col-sm-9">
                                    <input type="text" name="district" value="{{data_get($data['arr'], 'district')}}"
                                           id="com10" class="form-control district" placeholder="區">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com11" class="col-sm-3 text-right control-label col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input type="text" name="address" value="{{data_get($data['arr'], 'address')}}"
                                           id="com11" class="form-control address" placeholder="地址">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com12" class="col-sm-3 text-right control-label col-form-label">Tax ID</label>
                                <div class="col-sm-9">
                                    <input type="text" name="tax_ID" value="{{data_get($data['arr'], 'tax_ID')}}"
                                           id="com12" class="form-control tax_ID" placeholder="統編">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="remarks" class="col-sm-3 text-right control-label col-form-label">訂單備註</label>
                                <div class="col-sm-9 note-editable">
                                    <textarea id="remarks" name="remarks">
                                        {!! data_get($data['arr'], 'remarks') !!}
                                    </textarea>
                                </div>
                            </div>
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
            $('form #remarks').summernote('disable')        //編輯器關閉
            $('form [type=date]').attr('disabled','disabled')    //加載圖片關閉
            //唯讀
            $('form .btn-image-modal ,form span').hide()
        } else { $('#img1').hide(); }

        //
        var modal = $('#manage-modal')
        current_modal = modal.find('.messageInfo-modal')

        //文字編輯器
        do_textarea_summernote_fun( $('#remarks'))

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
            let data = prop_fromData_fun(self, {
                'remarks': $('#remarks').summernote('code'),
            })

            ajax(url, data, 'POST')
        })

        //編輯模式
        $(".btn-dosave").click(function (e) {
            e.preventDefault()

            //寫入資料庫
            let id = $(this).data('id')
            let url = '{{data_get($data['route_url'], "update")}}'.replace('-10', id)  //-10代替字元為id
            let self = document.querySelector('#sample_form')
            let data = prop_fromData_fun(self, {
                'remarks': $('#remarks').summernote('code'),
            })

            ajax(url, data, 'POST')
        })
    }
    </script>
@endsection
