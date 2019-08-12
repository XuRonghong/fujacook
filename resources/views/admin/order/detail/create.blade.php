
@extends('admin.layouts.master')

@section('style')
    <style>
        /* 圖片 btn */
        .btn {
            margin-left: 10px;
        }
        /* 新增按鈕 */
        #create_record {
            display: none;
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
                                <label for="img1" class="col-sm-3 text-right control-label col-form-label">Product spec</label>
                                <div class="col-sm-9">
                                    <a class="btn-image-modal" data-modal="image-form" data-id="">
                                        @forelse(data_get( $data['arr'], 'image', []) as $key => $var)
                                            <img id="{{$key}}" src="{{$var or ''}}" style="height:140px" alt="" >
                                        @empty
                                            <img src="{{url('images/empty.jpg')}}" style="height:140px" alt="">
                                        @endforelse
                                    </a>
                                    <br>
                                    <span style="color:red">如要更換圖片，點擊上方</span>
                                    @forelse(data_get( $data['arr'], 'image', []) as $key => $var)
                                        <img id="img1" src="{{$var or ''}}" style="height:140px" alt="">
                                    @empty
                                        <img id="img1" src="{{url('images/empty.jpg')}}" style="height:140px" alt="">
                                    @endforelse
                                </div>
                            </div>
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
                                        {!! data_get($data['arr'], 'order_details') !!}
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com3" class="col-sm-3 text-right control-label col-form-label">進價</label>
                                <div class="col-sm-9">
                                    <input type="text" name="purchase_price" value="{{data_get($data['arr'], 'purchase_price')}}"
                                           id="com3" class="form-control purchase_price" placeholder="Purchase price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com4" class="col-sm-3 text-right control-label col-form-label">成本價</label>
                                <div class="col-sm-9">
                                    <input type="text" name="cost_price" value="{{data_get($data['arr'], 'cost_price')}}"
                                           id="com4" class="form-control cost_price" placeholder="Cost price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com5" class="col-sm-3 text-right control-label col-form-label">價格</label>
                                <div class="col-sm-9">
                                    <input type="text" name="price" value="{{data_get($data['arr'], 'price')}}"
                                           id="com5" class="form-control price" placeholder="Price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com6" class="col-sm-3 text-right control-label col-form-label">原價</label>
                                <div class="col-sm-9">
                                    <input type="text" name="market_price" value="{{data_get($data['arr'], 'market_price')}}"
                                           id="com6" class="form-control market_price" placeholder="Market price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="com7" class="col-sm-3 text-right control-label col-form-label">購買數量</label>
                                <div class="col-sm-9">
                                    <input type="text" name="quantity" value="{{data_get($data['arr'], 'quantity')}}"
                                           id="com7" class="form-control quantity" placeholder="Quantity">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="chos1" class="col-sm-3 text-right control-label col-form-label">狀態</label>
                                <div class="col-sm-9">
                                    <select class="form-control status" id="chos1" name="status" title="Status">
                                        {!! data_get($data['arr'], 'status') !!}
                                    </select>
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
    <!-- Public Crop_Image -->
    @include('admin.js.crop_image_single_custom')
    <!-- end -->
    <script type="text/javascript">
    function document_ready() {

        // 只顯示詳情不開啟編輯功能
        let disable = '{{data_get($data, 'Disable')}}'
        if (disable){
            $('form#sample_form input[type=text]').attr('disabled','disabled')
            // $('form select').attr('disabled','disabled')
            $('form .image-del').css("visibility","hidden")    //刪除區塊隱藏
            $('form #Image').css("display","none")     //加載圖片關閉
            $('form [type=date]').attr('disabled','disabled')    //加載圖片關閉
            //唯讀
            $('form .btn-image-modal ,form span').hide()
        } else { $('#img1').hide(); }

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
            let data = prop_fromData_fun(self, {
                'doValidate' : 0
            })

            ajax(url, data, 'POST')
        })
    }
    </script>
@endsection
