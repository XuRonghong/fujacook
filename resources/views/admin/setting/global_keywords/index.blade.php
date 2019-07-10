
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
                            <h6 class="card-subtitle">{!! (data_get($data,'Summary')) !!}</h6>
                            <div class="table-responsive waitme">
                                <table id="data_table" class="table table-table-striped table-bordered">
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('inline-js')
    <script>
        $(document).ready(function () {
            // loading .....
            run_waitMe($('.waitme'));
            let data_table = $('#data_table');
            let table = data_table.dataTable({
                "serverSide": true,
                "stateSave": true,
                // "scrollX": true,
                // "scrollY": '60vh',
                // 'bProcessing': true,
                // 'sServerMethod': 'GET',
                "order": [[ 0, "asc" ]],
                "aoColumns": [
                    {
                        "sTitle": "ID",
                        "mData": "id",
                        "sName": "id",
                        // "width": "40px",
                        "bSortable": true,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    // {
                    //     "sTitle": "rank",
                    //     "mData": "rank",
                    //     "sName": "rank",
                    //     // "width": "100px",
                    //     "bSortable": true,
                    //     "bSearchable": false,
                    //     "mRender": function (data, type, row) {
                    //         return data;
                    //     }
                    // },
                    {
                        "sTitle": "name",
                        "mData": "name",
                        "sName": "name",
                        // "width": "100px",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": "value",
                        "mData": "value",
                        "sName": "value",
                        "width": "30%",
                        "bSortable": false,
                        "bSearchable": true,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": "type",
                        "mData": "type",
                        "sName": "type",
                        // "width": "100px",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": "created",
                        "mData": "created_at",
                        "sName": "created_at",
                        // "width": "100px",
                        "bSortable": true,
                        "bSearchable": true,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": "",
                        "bSortable": false,
                        "bSearchable": false,
                        // "width": '100px',
                        "mRender": function (data, type, row) {
                            let btn = row.status;
                            $('.waitme').waitMe('hide');
                            return btn;
                        }
                    },
                ],
                "lengthMenu": [50, 100, 200, 500, 25, 10, 5],
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



            $('#create_record').parent().hide()     //沒有新建按鈕

            //
            data_table.on('click', '.btn-del', function () {
                var id = $(this).closest('tr').attr('id');
                let url = '{{$data['route_url']['destroy']}}'.replace('-10', id)  //-10代替字元為id
                let data = {
                    "_token": "{{ csrf_token() }}"
                };
                doDelete(url, data, table)          // from layout.master
            });
        });
    </script>
@endsection
