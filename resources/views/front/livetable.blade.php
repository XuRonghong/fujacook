@extends('front.layouts2.master')

@section('content')
<div class="container box">
    <h3 align="center">Live Table Insert Update Delete in Laravel using Ajax jQuery</h3><br />
    <div class="panel panel-default">
        <div class="panel-heading">Sample Data</div>
        <div class="panel-body">
            <div id="message"></div>

            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-5">Sample Data - Total Records - <b><span id="total_records"></span></b></div>
                    <div class="col-md-5">
                        <div class="input-group input-daterange">
                            <input type="text" name="from_date" id="from_date" readonly class="form-control" />
                            <div class="input-group-addon">to</div>
                            <input type="text"  name="to_date" id="to_date" readonly class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" name="filter" id="filter" class="btn btn-info btn-sm">Filter</button>
                        <button type="button" name="refresh" id="refresh" class="btn btn-warning btn-sm">Refresh</button>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>
        </div>
    </div>
</div>
@endsection


<!-- ================== inline-js ================== -->
@section('inline-js')
    <script>
        $(document).ready(function () {

            var date = new Date();

            $('.input-daterange').datepicker({
                todayBtn: 'linked',
                format: 'yyyy-mm-dd',
                autoclose: true
            });

            from_date = $('#from_date').val();
            to_date = $('#to_date').val();
            var _token = $('input[name="_token"]').val();


            fetch_data(from_date, to_date);

            function fetch_data(from_date, to_date)
            {
                $.ajax({
                    url:"{{ route('livetable.fetch_data') }}",
                    method:"GET",
                    data:{from_date:from_date, to_date:to_date, _token:_token},
                    dataType:"json",
                    success:function(data)
                    {
                        var html = '';
                        html += '<tr>';
                        html += '<td contenteditable id="name"></td>';
                        html += '<td contenteditable id="price"></td>';
                        html += '<td><button type="button" class="btn btn-success btn-xs" id="add">Add</button></td></tr>';
                        for(var count=0; count < data.length; count++)
                        {
                            html +='<tr>';
                            html +='<td contenteditable class="column_name" data-column_name="name" data-id="'+data[count].id+'">'+data[count].name+'</td>';
                            html += '<td contenteditable class="column_name" data-column_name="price" data-id="'+data[count].id+'">'+data[count].price+'</td>';
                            html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].id+'">Delete</button></td></tr>';
                        }
                        $('tbody').html(html);
                    }
                });
            }


            $(document).on('click', '#add', function(){
                var name = $('#name').text();
                var price = $('#price').text();
                if(name != '' && price != '')
                {
                    $.ajax({
                        url:"{{ route('livetable.add_data') }}",
                        method:"POST",
                        data:{name:name, price:price, _token:_token},
                        success:function(data)
                        {
                            $('#message').html(data);
                            fetch_data();
                        }
                    });
                }
                else
                {
                    $('#message').html("<div class='alert alert-danger'>Both Fields are required</div>");
                }
            });

            $(document).on('blur', '.column_name', function(){
                var column_name = $(this).data("column_name");
                var column_value = $(this).text();
                var id = $(this).data("id");

                if(column_value != '')
                {
                    $.ajax({
                        url:"{{ route('livetable.update_data') }}",
                        method:"POST",
                        data:{column_name:column_name, column_value:column_value, id:id, _token:_token},
                        success:function(data)
                        {
                            $('#message').html(data);
                        }
                    })
                }
                else
                {
                    $('#message').html("<div class='alert alert-danger'>Enter some value</div>");
                }
            });

            $(document).on('click', '.delete', function(){
                var id = $(this).attr("id");
                if(confirm("Are you sure you want to delete this records?"))
                {
                    $.ajax({
                        url:"{{ route('livetable.delete_data') }}",
                        method:"POST",
                        data:{id:id, _token:_token},
                        success:function(data)
                        {
                            $('#message').html(data);
                            fetch_data();
                        }
                    });
                }
            });




            $('#filter').click(function(){
                var from_date = $('#from_date').val();
                var to_date = $('#to_date').val();
                if(from_date != '' &&  to_date != '')
                {
                    fetch_data(from_date, to_date);
                }
                else
                {
                    alert('Both Date is required');
                }
            });

            $('#refresh').click(function(){
                $('#from_date').val('');
                $('#to_date').val('');
                fetch_data();
            });


        });
    </script>
@endsection
<!-- ================== /inline-js ================== -->
