
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
{{--                            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create</button>--}}
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
                "order": [[ 1, "asc" ]],
                "aoColumns": [
                    // {
                    //     "sTitle": "ID",
                    //     "mData": "id",
                    //     "sName": "id",
                    //     // "width": "40px",
                    //     "bSearchable": false,
                    //     "mRender": function (data, type, row) {
                    //         return data;
                    //     }
                    // },
                    {
                        "sTitle": "no",
                        "mData": "no",
                        // "width": "100px",
                        "sName": "no"
                    },
                    {
                        "sTitle": "rank",
                        "mData": "rank",
                        // "width": "100px",
                        "sName": "rank",
                        "mRender": function (data, type, row) {
                            return data;
                        }
                    },
                    {
                        "sTitle": "image",
                        // "mData": "info",
                        // "sName": "info",
                        "bSortable": false,
                        "bSearchable": false,
                        // "width": '100px',
                        "mRender": function (data, type, row) {
                            return row.user_image;
                        }
                    },
                    {
                        "sTitle": "name",
                        "mData": "name",
                        // "width": "100px",
                        "sName": "name",
                    },
                    {
                        "sTitle": "account",
                        "mData": "account",
                        // "width": "100px",
                        "sName": "account",
                    },
                    {
                        "sTitle": "createIP",
                        "mData": "createIP",
                        // "width": "100px",
                        "sName": "createIP",
                    },
                    // {
                    //     "sTitle": "active",
                    //     "mData": "active",
                    //     // "width": "100px",
                    //     "sName": "active",
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
                // var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
                location.href = '{{$data['route_url']['show']}}'+'/'+id;
            });
            //
            data_table.on('click', '.btn-edit', function () {
                // var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
                location.href = '{{$data['route_url']['edit']}}'+'/'+id+'/edit';
            })
            //
            data_table.on('click', '.btn-del', function () {
                var id = $(this).closest('tr').attr('id');
                let url = '{{$data['route_url']['destroy']}}'.replace('-10', id)  //-10代替字元為id
                let data = {
                    "_token": "{{ csrf_token() }}"
                };
                doDelete(url, data, table)          // from layout.master
            });


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
                //
                toastr.info('Wait me', "等我一下...");
                //
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
        });
    </script>
@endsection
