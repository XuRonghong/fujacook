
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
    </div>
@endsection

@section('inline-js')
    <script>
        function document_ready() {
            // loading .....
            run_waitMe($('.waitme'));
            let data_table = $('#data_table');
            let table = data_table.dataTable({
                "serverSide": true,
                // "stateSave": true,
                // "scrollX": true,
                "scrollY": '60vh',
                // 'bProcessing': true,
                // 'sServerMethod': 'GET',
                "order": [[ 5, "desc" ]],
                "aoColumns": [
                    {
                        "sTitle": "Num",
                        "mData": "id",
                        "sName": "id",
                        // "width": "40px",
                        // "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": "User Name",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return row.user_name;
                        }
                    },
                    {
                        "sTitle": "User Type",
                        "bSortable": false,
                        "bSearchable": false,
                        "mRender": function (data, type, row) {
                            return row.user_type;
                        }
                    },
                    {
                        "sTitle": "createIP",
                        "mData": "ip",
                        // "width": "100px",
                        "sName": "ip",
                        "bSortable": false,
                        "bSearchable": false,
                    },
                    {
                        "sTitle": "action",
                        "mData": "action",
                        // "width": "100px",
                        "sName": "action",
                        "bSortable": false,
                        "bSearchable": true,
                    },
                    {
                        "sTitle": "date time",
                        "mData": "created_at",
                        // "width": "100px",
                        "sName": "created_at",
                        "bSortable": true,
                        "bSearchable": true,
                    },
                    // {
                    //     "sTitle": "updated_at",
                    //     "mData": "updated_at",
                    //     // "width": "100px",
                    //     "sName": "updated_at",
                    //     "bSortable": true,
                    //     "bSearchable": true,
                    // },
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


            $('.align-self-center .p-15').hide()        //隱藏create
            //
            data_table.on('click', '.btn-show', function () {
                var id = $(this).closest('tr').attr('id');
                // var id = $(this).closest('tr').find('td').first().text();
                location.href = '{{$data['route_url']['show']}}'+'/'+id;
            });
            //
        }
    </script>
@endsection
