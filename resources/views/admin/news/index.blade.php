
@extends('admin.layouts.master')

@section('style')
    <style>
    </style>
@endsection

@section('content')
    <div class="page-wrapper">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        {{--@include('admin.layouts.breadcrumb')--}}
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Tables -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title modalTitle">{{data_get($data,'Title')}}</h4>
                            {{--<h6 class="card-subtitle">{{data_get($data,'Summary')}}</h6>--}}
                            <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
                            <br />
                            <div class="table-responsive waitme">
                                <table id="data_table" class="table table-table-striped table-bordered">

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>
@endsection


@section('inline-js')
    <!--  -->
    <!-- Public Crop_Image -->
    {{--@include('_web._js.crop_image')--}}
    <!-- end -->
    <!-- Public SummerNote -->
    {{--@include('_web._js.summernote')--}}
    <!-- end -->
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
                        "sTitle": "標頭",
                        "mData": "title",
                        // "width": "100px",
                        "sName": "title"
                    },
                    {
                        "sTitle": "content",
                        "mData": "summary",
                        // "width": "100px",
                        "sName": "summary"
                    },
                    {
                        "sTitle": "",
                        "bSortable": false,
                        "bSearchable": false,
                        // "width": '100px',
                        "mRender": function (data, type, row) {
                            // current_data[row.id] = row;
                            let btn = '<button class="btn btn-xs btn-default btn-show" title="全部資訊"><i class="fa fa-book" aria-hidden="true"></i></button>';
                                btn += '<button class="btn btn-xs btn-default btn-edit" title="修改"><i class="fa fa-pencil" aria-hidden="true">修改</i></button>';
                                btn += '<button class="pull-right btn btn-xs btn-danger btn-del" title="刪除"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                            $('.waitme').waitMe('hide');
                            return btn;
                        }
                    },
                ],
                "sAjaxSource": '{{$route_url['list']}}',
                "ajax": '{{$route_url['list']}}',
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
            setTimeout(function(){ $('.waitme').waitMe('hide') }, 5000);   //逾時10秒關閉讀取
            /* END BASIC */



            document.getElementById('create_record').addEventListener('click', function () {
                location.href = '{{$route_url['create']}}'
            })

            //
            data_table.on('click', '.btn-edit', function () {
                //var id = $(this).closest('tr').attr('id');
                let id = $(this).closest('tr').find('td').first().text();
                location.href = '{{$route_url['edit']}}'+ id+ '/edit';
            });

            //
            data_table.on('click', '.btn-del', function () {
                //var id = $(this).closest('tr').attr('id');
                let id = $(this).closest('tr').find('td').first().text();
                let data = {
                    "_token": "{{ csrf_token() }}"
                };
                swal({
                    title: "{{trans('_web_alert.del.title')}}",
                    text: "{{trans('_web_alert.del.note')}}",
                    type: "warning",
                    showCancelButton: true,
                    cancelButtonText: "{{trans('_web_alert.cancel')}}",
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{trans('_web_alert.ok')}}",
                    closeOnConfirm: true
                }, function () {
                    $.ajax({
                        url: '{{$route_url['destroy']}}'+ id,
                        data: data,
                        type: "POST",
                        //async: false,
                        success: function (rtndata) {
                            if (rtndata.status) {
                                toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")
                                setTimeout(function () {
                                    table.api().ajax.reload(null, false);
                                }, 100);
                            } else {
                                swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");
                            }
                        },
                        error: function (err) {
                            console.log(err.responseJSON);
                            toastr.error(JSON.stringify(err.responseJSON), "{{trans('_web_alert.notice')}}");
                        }
                    });
                });
            });

            //
            data_table.on('click', '.btn-show', function () {
                //var id = $(this).closest('tr').attr('id');
                var id = $(this).closest('tr').find('td').first().text();
                location.href = '{{$route_url['show']}}'+ id;
            });

            //
            // var ii = 1;
            // $('thead>tr>th').each(function () {
            //     if (ii==4){
            //         $(this).click();
            //         $(this).click();
            //     }
            //     ii++;
            // });
        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->