<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" href="{{asset('templated-industrious/assets/css/main.css')}}" />

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('/css/toastr.min.css')}}">
        <link rel="stylesheet" href="{{asset('/css/sweetalert.css')}}">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        {{-- loading .... --}}
        <link type="text/css" rel="stylesheet" href="{{asset('css/waitMe.css')}}">


        <style type="text/css">
            .box{
                width:600px;
                margin:0 auto;
            }
        </style>

        <!-- Styles -->
        @yield('style')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="{{asset('/js/toastr.min.js')}}"></script>
        <script src="{{asset('/js/sweetalert.min.js')}}"></script>
        {{--<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.css" />

    </head>



        {{--@include('js')--}}

    </head>
    <body>
        @include('front.layouts2.header')
        @include('front.layouts2.nav')
        @include('front.layouts2.banner')
        @yield('content')
        @include('front.layouts2.footer')
        @yield('inline-js')

        <script>
            $(document).ready(function(){

                $('#country_name').keyup(function(){
                    var query = $(this).val();
                    if(query != '')
                    {
                        var _token = "{{ csrf_token() }}";
                        $.ajax({
                            url:"{{ route('autocomplete.fetch') }}",
                            method:"POST",
                            data:{query:query, _token:_token},
                            success:function(data){
                                $('#countryList').fadeIn();
                                $('#countryList').html(data);
                            }
                        });
                    }
                });

                $(document).on('click', 'li', function(){
                    $('#country_name').val($(this).text());
                    $('#countryList').fadeOut();
                });

            }
    </script>

        <script src="{{asset('js/waitMe.js')}}"></script>
        <script>
            // none, bounce, rotateplane, stretch, orbit,
            // roundBounce, win8, win8_linear or ios
            function run_waitMe(selector='body', effect='roundBounce'){
                $(selector).waitMe({
                    //none, rotateplane, stretch, orbit, roundBounce, win8,
                    //win8_linear, ios, facebook, rotation, timer, pulse,
                    //progressBar, bouncePulse or img
                    effect: effect,
                    //place text under the effect (string).
                    text: 'Please waiting...',
                    //background for container (string).
                    bg: 'rgba(255,255,255,0.7)',
                    //color for background animation and text (string).
                    color: '#000',
                    //max size
                    maxSize: '',
                    //wait time im ms to close
                    waitTime: -1,
                    //url to image
                    source: '',
                    //or 'horizontal'
                    textPos: 'vertical',
                    //font size
                    fontSize: '',
                    // callback
                    onClose: function() {}
                });
            }
        </script>
    </body>
</html>
