
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
{{--                                <h4 class="card-title"></h4>--}}
                                <div class="form-group row">
                                    <label for="img1" class="col-sm-5 text-right control-label col-form-label"></label>
                                    <div class="col-sm-7">
                                        <a class="btn-image-modal" data-modal="image-form" data-id="">
                                            <img src="{{data_get($data['arr'], 'info.0.user_image', url('images/empty.jpg'))}}" style="height:140px">
                                        </a>
                                        <img id="img1" src="{{data_get($data['arr'], 'info.0.user_image', url('images/empty.jpg'))}}" style="height:140px" alt="">
                                    </div>
                                </div>
                                <!--放一個假的，不顯示的，讓Chrome去填入-->
                                <!-- <input type="password" style="dispslay:none" > -->
                                <div class="form-group row">
                                    <label for="com1" class="col-sm-3 text-right control-label col-form-label">account<span style="color:red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="account" value="{{data_get($data['arr'], 'account')}}"
                                               class="form-control account" id="com1" placeholder="" disabled>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">
                                        password
                                        @if( !data_get($data['arr'], 'id')) <span style="color:red">*</span>
                                        @endif
                                    </label>
                                    <div class="col-sm-9">
                                        <input type="password" name="password" value="{{data_get($data['arr'], 'password')}}"
                                               class="form-control password" id="com2" autocomplete="off" 
                                               @if( !data_get($data['arr'], 'id')) required @endif>
                                        <span style="color:red">若不需要更改密碼 , 此欄位無需理會</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="com5" class="col-sm-3 text-right control-label col-form-label">type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control type" id="com5" name="type">
                                            {!! data_get($data['arr'], 'options') !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">name<span style="color:red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="{{data_get($data['arr'], 'name')}}"
                                               class="form-control name" id="com4" placeholder="" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">email</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="email" value="{{data_get($data['arr'], 'info.0.user_email')}}" class="form-control email" id="com3" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com7" class="col-sm-3 text-right control-label col-form-label">contact</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="user_contact" value="{{data_get($data['arr'], 'info.0.user_contact','?')}}" class="form-control user_contact" id="com7" placeholder="contact number">
                                    </div>
                                </div>
                            </div>
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
    @include('admin.js.crop_image_single')
    <!-- end -->
    <script type="text/javascript">
        $(document).ready(function () {

            // 只顯示詳情不開啟編輯功能
            let disable = '{{data_get($data, 'Disable')}}'
            if (disable){
                $('input[type=text],input[type=password]').attr('disabled','disabled')
                $('form select').attr('disabled','disabled')
                $('form .image-del').css("visibility","hidden")    //刪除區塊隱藏
                $('form #Image').css("display","none")     //加載圖片關閉
                //唯讀
                $('form .btn-image-modal').hide()
            } else { $('#img1').hide() }

            // 為了做圖片編輯
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
                let data = prop_fromData_fun(self)  //為了放file_id or image

                ajax(url, data, 'POST')
            })

            //編輯模式
            $(".btn-dosave").click(function (e) {
                e.preventDefault()

                //寫入資料庫
                let id = $(this).data('id')
                let url = '{{data_get($data['route_url'], "update")}}'.replace('-10', id)  //-10代替字元為id
                let self = document.querySelector('#sample_form')
                let data = prop_fromData_fun(self)  //為了放file_id or image

                ajax(url, data, 'POST')
            })
        })
    </script>
@endsection
