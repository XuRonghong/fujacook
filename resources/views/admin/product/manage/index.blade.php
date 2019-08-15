
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
            <!-- Tables -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title modalTitle"></h4>
                            <h6 class="card-subtitle">{!! data_get($data,'Summary') !!}</h6>
                            <div class="table-responsive waitme">
                                <table id="data_table" class="table table-table-striped table-bordered">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Create Modal -->
        <div class="modal fade" id="createmodel" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <form id="sample_form" >
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel"><i class="ti-marker-alt m-r-10"></i> </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body messageInfo-modal">
                            <div class="container-fluid">
                                <h4 class="card-title"></h4>
                                <div class="form-group row">
                                    <label for="com2" class="col-sm-3 text-right control-label col-form-label">type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control type options" id="com2" name="type"></select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="img1" class="col-sm-3 text-right control-label col-form-label">圖片</label>
                                    <div class="col-sm-9 images"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="com3" class="col-sm-3 text-right control-label col-form-label">Name<span style="color:red">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="name" value="" id="com3" class="form-control name" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">Price</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="price" value="" id="com4" class="form-control price" placeholder="default:100">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com5" class="col-sm-3 text-right control-label col-form-label">Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="num" value="" class="form-control num" id="com5" placeholder="數量">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="com4" class="col-sm-3 text-right control-label col-form-label">Code</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="code" value="" id="com4" class="form-control code" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="detail" class="col-sm-3 text-right control-label col-form-label">產品資訊</label>
                                    <div class="col-sm-9 note-editable product_description"></div>
                                </div>
                                <div class="form-group row">
                                    <label for="service_description" class="col-sm-3 text-right control-label col-form-label">Service description</label>
                                    <div class="col-sm-9 note-editable service_description"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="card-body">
                                <div class="form-group m-b-0 text-right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('inline-js')
    <script>
        // function document_ready() {
        function document_ready() {
            // loading .....
            run_waitMe($('.waitme'));
            let data_table = $('#data_table');
            let table = data_table.dataTable({
                "serverSide": true,
               // "stateSave": true,
                // "scrollX": true,
                // "scrollY": '60vh',
                // 'bProcessing': true,
                // 'sServerMethod': 'GET',
                "order": [[ 0, "desc" ]],
                "aoColumns": [
                    {
                        "sTitle": "ID",
                        "mData": "id",
                        "sName": "id",
                        // "width": "40px",
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": "serial(#)",
                        "mData": "rank",
                        // "width": "100px",
                        "sName": "rank",
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    // {
                    //     "sTitle": "category",
                    //     "mData": "category",
                    //     // "width": "100px",
                    //     "sName": "category"
                    // },
                    {
                        "sTitle": "type",
                        "mData": "type",
                        // "width": "100px",
                        "sName": "type"
                    },
                    {
                        "sTitle": "name",
                        "mData": "name",
                        "width": "20%",
                        "sName": "name"
                    },
                    {
                        "sTitle": "image",
                        "mData": "image",
                        // "width": "100px",
                        "sName": "image"
                    },
                    {
                        "sTitle": "updated_at",
                        "mData": "updated_at",
                        // "width": "100px",
                        "sName": "updated_at",
                        "bSortable": true,
                        "bSearchable": false,
                    },
                    {
                        "sTitle": '<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs">' +
                                    '刪除<i class="glyphicon glyphicon-remove"></i>' +
                                    '</button>',
                        "mData": "checkbox",
                        "width": "30px",
                        "sName": "checkbox",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": '',
                        "bSortable": false,
                        "bSearchable": false,
                        // "width": '100px',
                        "sName": "operate",
                        "mRender": function (data, type, row) {
                            let btn = row.status;
                            $('.waitme').waitMe('hide');
                            return btn;
                        }
                    },
                ],
                "sAjaxSource": '{{$data['route_url']['list']}}',
                "ajax": '{{$data['route_url']['list']}}',
                // "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>" +
                //     "t" +
                //     "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                // "autoWidth": true,
                "oLanguage": {
                    "sSearch": 'Search:<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
                },
            });
            $('div.dataTables_wrapper div.dataTables_paginate').click(function () {
                run_waitMe($('.waitme'));
                setTimeout(function(){ $('.waitme').waitMe('hide') }, 1000);   //逾時1秒關閉讀取
            });
            $('#data_table select').change(function () {
                run_waitMe($('.waitme'));
                setTimeout(function(){ $('.waitme').waitMe('hide') }, 1000);   //逾時1秒關閉讀取
            });
            setTimeout(function(){ $('.waitme').waitMe('hide') }, 1500);   //逾時1.5秒關閉讀取
            /* END BASIC */


            document.getElementById('create_record').addEventListener('click', function () {
                location.href = '{{$data['route_url']['create']}}'
            })

            //
            data_table.on('click', '.btn-open', function () {
                let id = $(this).closest('tr').attr('id')
                url = '{{data_get($data['route_url'], "update")}}'.replace('-10', id)
                ajaxOpen(url, {open: 'change', doValidate: 0}, 'POST', table)
            })
            //
            data_table.on('click', '.btn-show', function () {
                let id = $(this).closest('tr').attr('id')
                // var id = $(this).closest('tr').find('td').first().text()
                let url = '{{$data['route_url']['show']}}'+'/'+id
                ajaxModal(url)
            })
            //
            data_table.on('click', '.btn-edit', function () {
                let id = $(this).closest('tr').attr('id')
                location.href = '{{$data['route_url']['edit']}}'+'/'+id+'/edit'
            })
            //
            data_table.on('click', '.btn-del', function () {
                let id = $(this).closest('tr').attr('id')
                let url = '{{$data['route_url']['destroy']}}'.replace('-10', id)  //-10代替字元為id
                let data = {
                    "_token": "{{ csrf_token() }}"
                }
                doDelete(url, data, table)          // from layout.master
            })
            // 勾選刪除多筆資料
            doMessDelete(table)


            // 按一下進入編輯模式
            data_table.on('click', '.aaa', function () {
                $('div.aaa').show();
                $('input.isEdit').hide();
                $(this).parent().find('input.isEdit').show();
                $(this).hide();
            });
            data_table.mouseleave(function () {
                $('.isEdit').hide();
                $('.isEdit').parent().find('.aaa').show();
            })
            // 編輯完成退回瀏覽模式
            data_table.on('change', '.isEdit', function (e) {
                $(this).hide();
                $(this).parent().find('.aaa').show();
                //
                let id = $(this).closest('tr').attr('id');
                let url = '{{data_get($data['route_url'], "update")}}'.replace('-10', id)  //-10代替字元為id
                let data = {}
                data[$(this).data('id')] = $(this).val()
                data['doValidate'] = 0
                //
                ajaxOpen(url, data, 'POST', table)
            });
        }
    </script>
@endsection
