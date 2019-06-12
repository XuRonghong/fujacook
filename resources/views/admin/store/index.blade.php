
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
    {{--@include('_web._layouts.breadcrumb')--}}
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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Crypto Market</h4>
                        {{--<h5 class="card-subtitle">Overview of Top Selling Items</h5>--}}
                        <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
                        <br />
                        <div class="table-responsive m-t-20 waitme">
                            <table id="data_table" class="table table-bordered m-b-20">

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
{{--<div class="page-wrapper">--}}
    {{--<div class="container-fluid">--}}
        {{--<div class="container">--}}
            {{--<br />--}}
            {{--<h3 align="center">Laravel 5.8 Ajax Crud Tutorial - Delete or Remove Data</h3>--}}
            {{--<br />--}}
            {{--<div class="table-responsive">--}}
                {{--<table class="table table-bordered table-striped" id="data_table">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th width="10%">Image</th>--}}
                        {{--<th width="35%">Name</th>--}}
                        {{--<th width="35%">Number</th>--}}
                        {{--<th width="30%">Action</th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}
                {{--</table>--}}
            {{--</div>--}}
            {{--<br />--}}
            {{--<br />--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}

<div id="formModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add New Record</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="modal-body">
                <span id="form_result"></span>
                <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">
                    {{--@csrf--}}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="control-label col-md-4">Name : </label>
                        <div class="col-md-8">
                            <input type="text" name="name" id="name" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Number : </label>
                        <div class="col-md-8">
                            <input type="text" name="number" id="number" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Address : </label>
                        <div class="col-md-8">
                            <input type="text" name="address" id="address" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4">Select Profile Image : </label>
                        <div class="col-md-8">
                            <input type="file" name="image" id="image" />
                            <span id="store_image"></span>
                        </div>
                    </div>
                    <br />
                    <div class="form-group" align="center">
                        <input type="hidden" name="action" id="action" />
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <input type="submit" name="action_button" id="action_button" class="btn btn-warning" value="Add" />
                        {{--<a onclick="history.back()" href="#" class="btn btn-default">Back</a>--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
                <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
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

        data_table = $('#data_table');
        let table = data_table.dataTable({
            processing: true,
            serverSide: true,
            // stateSave: true,
            // dataType: "json",
            // autoWidth: true,
            // scrollX: true,
            // scrollY: '60vh',
            // sServerMethod: 'GET',
            oLanguage: {
                "sSearch": 'Search:<span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>'
            },
            ajax:{
                url: "{{ $route_url['list'] }}",
            },
            columns:[
                {
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    render: function(data, type, full, meta){
                        return "<img src={{ URL::to('/') }}/images/" + data + " width='70' class='img-thumbnail' />";
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'number',
                    name: 'number'
                },
                {
                    data: 'address',
                    name: 'address'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    // render: function (data) {
                    //     return data;
                    // }
                }
            ]
        });

        document.querySelector('#create_record').addEventListener('click', function(event){
            event.preventDefault();
            $('.modal-title').text("Add New Record");
            $('#action_button').val("Add");     //button
            $('#action').val("Add");        //hidden
            let form_modal = $('#formModal');
            form_modal.modal('show');
            form_modal.find("input[type=text]").val('');
            form_modal.find("#store_image").html('');
        });

        document.querySelector('#sample_form').addEventListener('submit', function(event){
            event.preventDefault();
            let self = this;
            let url = '';
            let store_image = document.querySelector('#store_image').innerHTML;     //暫存就有圖片

            if(self.querySelector('#action').value === 'Add') {
                url = "{{ $route_url['store'] }}";
            }
            if(self.querySelector('#action').value === 'Edit') {
                url = "{{ $route_url['update'] }}";
            }

            $.ajax({
                url: url,
                data: new FormData(self),
                method: "POST",
                dataType:"json",
                contentType: false,
                processData: false,
                cache: false,
                success:function(data)
                {
                    let html = '';
                    if(data.errors) {
                        html = '<div class="alert alert-danger">';
                        for(let count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    if(data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        $('#sample_form')[0].reset();
                        document.querySelector('#store_image').innerHTML = store_image;
                        data_table.DataTable().ajax.reload();
                    }
                    document.querySelector('#form_result').innerHTML = html;
                },
                error: function (err) {
                    console.log(err.responseJSON);
                    if(err.errors) {
                        html = '<div class="alert alert-danger">';
                        for(let count = 0; count < data.errors.length; count++)
                        {
                            html += '<p>' + data.errors[count] + '</p>';
                        }
                        html += '</div>';
                    }
                    document.querySelector('#form_result').innerHTML = html;
                    {{--toastr.error(JSON.stringify(err.responseJSON), "{{trans('_web_alert.notice')}}");--}}
                }
            });
        });

        // each one edit button
        $(document).on('click', '.edit', function(){
            let id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "{{ $route_url['index'] }}"+ "/"+ id+ "/edit",
                dataType: "json",
                success:function(html){
                    $('#name').val(html.data.name);
                    $('#number').val(html.data.number);
                    $('#address').val(html.data.address);
                    $('#store_image').html("<img src={{ URL::to('/') }}/images/" + html.data.image + " width='70' class='img-thumbnail' />");
                    $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.image+"' />");
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Edit New Record");
                    $('#action_button').val("Edit");
                    $('#action').val("Edit");
                    $('#formModal').modal('show');
                }
            })
        });

        // each one show button
        $(document).on('click', '.show', function(){
            let id = $(this).attr('id');
            $('#form_result').html('');
            $.ajax({
                url: "{{ $route_url['show'] }}"+ id,
                dataType: "json",
                success:function(html){
                    $('#name').val(html.data.name).prop('disabled', true);
                    $('#number').val(html.data.number).prop('disabled', true);
                    $('#address').val(html.data.address).prop('disabled', true);
                    $('input[type=file]').hide();
                    $('#store_image').html("<img src={{ URL::to('/') }}/images/" + html.data.image + " width='70' class='img-thumbnail' />");
                    $('#store_image').append("<input type='hidden' name='hidden_image' value='"+html.data.image+"' />");
                    $('#hidden_id').val(html.data.id);
                    $('.modal-title').text("Show Record");
                    $('#action_button').hide();//attr('disabled','disabled').val("OK");
                    $('#action').val("Show");
                    $('#formModal').modal('show');
                }
            })
        });


        let primary_id;
        $(document).on('click', '.delete', function(){
            primary_id = $(this).attr('id');
            $('#confirmModal').modal('show');
        });

        $('#ok_button').click(function(){
            $.ajax({
                url: "{{ $route_url['destroy'] }}"+ "/"+ primary_id,
                beforeSend:function(){
                    $('#ok_button').text('Deleting...');
                },
                success:function(data)
                {
                    setTimeout(function(){
                        $('#confirmModal').modal('hide');
                        $('#data_table').DataTable().ajax.reload();
                    }, 2000);
                }
            })
        });

    });
</script>
@endsection