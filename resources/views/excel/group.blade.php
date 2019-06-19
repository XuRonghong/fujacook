<html lang="en">
<head>
    <title>Laravel 5 maatwebsite export into csv and excel and import into DB</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" >
    <!-- dataTables -->
    <link href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="/web_assets/v1/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/web_assets/v1/css/plugins/toastr/toastr.min.css" rel="stylesheet">
</head>
<body>
<div class="panel panel-primary">
    <div class="panel-heading">Laravel 5 maatwebsite export into csv and excel and import into DB</div>
    <div class="panel-body">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <a href="{{ route('excel-file',['type'=>'xls']) }}">Download Excel xls</a> |
                <a href="{{ route('excel-file',['type'=>'xlsx']) }}">Download Excel xlsx</a> |
                <a href="{{ route('excel-file',['type'=>'csv']) }}">Download CSV</a>
            </div>
        </div>
        {!! Form::open(array('route' => 'import-csv-excel','method'=>'POST','files'=>'true')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::label('excel_file','Select File to Import:',['class'=>'col-md-3']) !!}
                    <div class="col-md-9">
                        {!! Form::file('excel_file', array('class' => 'form-control')) !!}
                        {!! $errors->first('excel_file', '<p class="alert alert-danger">:message</p>') !!}
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                {!! Form::submit('Upload',['class'=>'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
        {!! Form::open(array('route' => 'update-csv-excel','method'=>'POST')) !!}
        <div class="row">
            <div>
                {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<table id="dt_basic" class="table table-bordered" style="width: 100%;">
    <thead>
    <tr>
        @foreach( $export as $header => $name )
            <th>{{$name}}</th>
        @endforeach
    </tr>
    </thead>
</table>

</body>
<script src="{{asset('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js')}}"></script>
<script>
    if (!window.jQuery) {
        document.write('<script src="{{asset('/web_assets/v3/js/libs/jquery-2.1.1.min.js')}}"><\/script>');
    }
</script>
<!-- dataTables -->
<script src="{{asset('//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js')}}"></script>
<!-- Sweet alert -->
<script src="{{asset('/web_assets/v1/js/plugins/sweetalert/sweetalert.min.js')}}"></script>
<!-- Toastr script -->
<script src="{{asset('/web_assets/v1/js/plugins/toastr/toastr.min.js')}}"></script>
<!--  -->
<script>
    var ajax_source = "{{url('group/preview-import-csv-excel')}}";
    var ajax_Table = "{{url('group/preview-import-csv-excel')}}";
    $(document).ready(function () {
        {{--table = $('#dt_basic').dataTable({--}}
            {{--"processing": true,--}}
            {{--"serverSide": true,--}}
            {{--"aoColumns": [--}}
                {{--@foreach( $export as $header => $name )--}}
                    {{--{"sTitle": "{{$name}}", "mData": "{{$header}}", "sName": "{{$header}}"},--}}
                {{--@endforeach--}}
            {{--],--}}
            {{--"sAjaxSource": ajax_source,--}}
            {{--"ajax": ajax_Table--}}
        {{--});--}}
        $('#dt_basic').DataTable({
            processing: true,
            serverSide: true,
            ajax: ajax_Table,
            columns: [
                @foreach( $export as $header => $name )
                {"sTitle": "{{$name}}", "mData": "{{$header}}", "sName": "{{$header}}"},
                @endforeach
            ]
        });
    });
</script>
</html>