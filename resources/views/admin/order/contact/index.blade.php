
@extends('admin.layouts.master')

@section('style')
    <style>
        /* 新增按鈕 */
        #create_record {
            visibility: hidden;
        }
        /* 返回Back */
        .btn-back {
            visibility: visible;
        }
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
        $(document).ready(function () {
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
                        "sTitle": "訂單號",
                        "mData": "no",
                        // "width": "100px",
                        "sName": "no",
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": "訂購人",
                        "mData": "member_id",
                        // "width": "100px",
                        "sName": "member_id"
                    },
                    {
                        "sTitle": "總金額",
                        "mData": "total_price",
                        // "width": "100px",
                        "sName": "total_price"
                    },
                    {
                        "sTitle": "付款方式",
                        "mData": "payment_method_id",
                        // "width": "100px",
                        "sName": "payment_method_id"
                    },
                    {
                        "sTitle": "物流方式",
                        "mData": "shipping_type",
                        // "width": "100px",
                        "sName": "shipping_type"
                    },
                    {
                        "sTitle": "出貨狀態",
                        "mData": "shipping_status",
                        // "width": "100px",
                        "sName": "shipping_status"
                    },
                    {
                        "sTitle": "訂單狀態",
                        "mData": "pay_status",
                        // "width": "100px",
                        "sName": "pay_status"
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
            data_table.on('change', '.dt-choose', function () {
                let id = $(this).closest('tr').attr('id')
                let data = { doValidate : 0 }
                data[ $(this).data('name') ] = this.value
                url = '{{data_get($data['route_url'], "update")}}'.replace('-10', id)
                ajaxOpen(url, data, 'POST', table)
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
                location.href = '{{$data['route_url']['show']}}'+'/'+id
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
        })
    </script>
@endsection
