
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
                                    <input type="text" name="no" value="{{data_get($data['arr'], 'no')}}" id="com1" class="form-control no" placeholder="訂單號">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="chos1" class="col-sm-3 text-right control-label col-form-label">type</label>
                                <div class="col-sm-9">
                                    <select class="form-control type" id="chos1" name="type">
                                        {!! data_get($data['arr'], 'options') !!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com3" class="col-sm-3 text-right control-label col-form-label">Store</label>
                                <div class="col-sm-9">
                                    <input type="text" name="store_id" value="{{data_get($data['arr'], 'store_id')}}" id="com3" class="form-control store_id" placeholder="賣家">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com4" class="col-sm-3 text-right control-label col-form-label">Member</label>
                                <div class="col-sm-9">
                                    <input type="text" name="member_id" value="{{data_get($data['arr'], 'member_id')}}" id="com4" class="form-control member_id" placeholder="買家">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com5" class="col-sm-3 text-right control-label col-form-label">Total Price</label>
                                <div class="col-sm-9">
                                    <input type="text" name="total_price" value="{{data_get($data['arr'], 'total_price')}}" class="form-control total_price" id="com5" placeholder="訂單總金額">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com6" class="col-sm-3 text-right control-label col-form-label">Shipping Fee</label>
                                <div class="col-sm-9">
                                    <input type="text" name="shipping_fee" value="{{data_get($data['arr'], 'shipping_fee')}}" id="com6" class="form-control shipping_fee" placeholder="運費">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com7" class="col-sm-3 text-right control-label col-form-label">Promo Fee</label>
                                <div class="col-sm-9">
                                    <input type="text" name="promo_fee" value="{{data_get($data['arr'], 'promo_fee')}}" id="com7" class="form-control promo_fee" placeholder="折扣">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com8" class="col-sm-3 text-right control-label col-form-label">Bonus</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bonus" value="{{data_get($data['arr'], 'bonus')}}" id="com8" class="form-control bonus" placeholder="使用購物金數量">
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="chos2" class="col-sm-3 text-right control-label col-form-label">付款方式</label>
                                <div class="col-sm-9">
                                    <select class="form-control payment_method_id" id="chos2" name="payment_method_id">
                                        {!! data_get($data['arr'], 'payment_method_id') !!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="chos3" class="col-sm-3 text-right control-label col-form-label">物流方式</label>
                                <div class="col-sm-9">
                                    <select class="form-control shipping_type" id="chos3" name="shipping_type">
                                        {!! data_get($data['arr'], 'shipping_type') !!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="chos3" class="col-sm-3 text-right control-label col-form-label">出貨狀態</label>
                                <div class="col-sm-9">
                                    <select class="form-control shipping_status" id="chos3" name="shipping_status">
                                        {!! data_get($data['arr'], 'shipping_status') !!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="chos4" class="col-sm-3 text-right control-label col-form-label">付款方式</label>
                                <div class="col-sm-9">
                                    <select class="form-control pay_status" id="chos4" name="pay_status">
                                        {!! data_get($data['arr'], 'pay_status') !!}
                                    </select>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group row">
                                <label for="tim1" class="col-sm-3 text-right control-label col-form-label">收款時間</label>
                                <div class="col-sm-9">
                                    <input type="date" name="paid_at" value="{{data_get($data['arr'], 'paid_at')}}" id="tim1" class="form-control paid_at" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com11" class="col-sm-3 text-right control-label col-form-label">匯款款帳號後五碼</label>
                                <div class="col-sm-9">
                                    <input type="text" name="bank_last_no" value="{{data_get($data['arr'], 'bank_last_no')}}" id="com11" class="form-control bank_last_no" placeholder="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="detail" class="col-sm-3 text-right control-label col-form-label">運送備註</label>
                                <div class="col-sm-9 note-editable">
                                    <textarea id="detail" name="shipping_note">
                                        {!! data_get($data['arr'], 'shipping_note') !!}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="service_description" class="col-sm-3 text-right control-label col-form-label">訂單備註</label>
                                <div class="col-sm-9 note-editable">
                                    <textarea id="service_description" name="pay_note">
                                        {!! data_get($data['arr'], 'pay_note') !!}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="customerservice_note" class="col-sm-3 text-right control-label col-form-label">客服備註</label>
                                <div class="col-sm-9 note-editable">
                                    <textarea id="customerservice_note" name="customerservice_note">
                                        {!! data_get($data['arr'], 'customerservice_note') !!}
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
                                    @else
                                        <button type="button" class="btn btn-info waves-effect waves-light btn-doadd">Add</button>
                                    @endif
                                @endif
                                <button type="button" class="btn btn-success waves-effect waves-light btn-dosave" data-id="{{data_get($data['arr'], 'id')}}">Save</button>
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
    <!-- Public SummerNote -->
    @include('admin.js.summernote2019')
    <!-- end -->
    <script type="text/javascript">
    $(document).ready(function () {

        // 只顯示詳情不開啟編輯功能
        let disable = '{{data_get($data, 'Disable')}}'
        if (disable){
            $('form#sample_form input[type=text]').attr('disabled','disabled')
            // $('form select').attr('disabled','disabled')
            $('form #detail').summernote('disable')        //編輯器關閉
            $('form #service_description').summernote('disable')        //編輯器關閉
            $('form #customerservice_note').summernote('disable')        //編輯器關閉
            // $('form .image-del').css("visibility","hidden")    //刪除區塊隱藏
            // $('form #Image').css("display","none")     //加載圖片關閉
            $('form [type=date]').attr('disabled','disabled')    //加載圖片關閉
            //唯讀
            $('form .btn-image-modal ,form span').hide()
        } else { $('#img1').hide(); }

        //
        var modal = $('#manage-modal')
        current_modal = modal.find('.messageInfo-modal')

        //文字編輯器
        do_textarea_summernote_fun( $('#detail'))
        do_textarea_summernote_fun( $('#service_description'))
        do_textarea_summernote_fun( $('#customerservice_note'))

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
                'product_description': $('#detail').summernote('code'),
                'service_description': $('#service_description').summernote('code'),
                'customerservice_note': $('#customerservice_note').summernote('code'),
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
                'product_description': $('#detail').summernote('code'),
                'service_description': $('#service_description').summernote('code'),
                'customerservice_note': $('#customerservice_note').summernote('code'),
                'doValidate' : 0
            })

            ajax(url, data, 'POST')
        })
    })
    </script>
@endsection
