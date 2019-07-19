@extends('front.layouts2.master')

@section('content')

    <div class="container box">
        <h3 align="center">Load More Data in Laravel using Ajax</h3><br />
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Post Data</h3>
            </div>
            <div class="panel-body">
                {{ csrf_field() }}
                <div id="post_data"></div>
            </div>
        </div>
        <br />
        <br />
    </div>
@endsection


<!-- ================== inline-js ================== -->
@section('inline-js')

    <script>
        $(document).ready(function(){

            var _token = $('input[name="_token"]').val();

            load_data('', _token);

            function load_data(id="", _token)
            {
                $.ajax({
                    url:"{{ route('loadmore.load_data') }}",
                    method:"POST",
                    data:{id:id, _token:_token},
                    success:function(data)
                    {
                        $('#load_more_button').remove();
                        $('#post_data').append(data);
                    }
                })
            }

            $(document).on('click', '#load_more_button', function(){
                var id = $(this).data('id');
                $('#load_more_button').html('<b>Loading...</b>');
                load_data(id, _token);
            });

        });
    </script>

@endsection
<!-- ================== /inline-js ================== -->
