<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{data_get($data,'parameters.meta_title', trans('front.home.title'))}}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="{{data_get($data, 'parameters.meta_author')}}">
    <meta name="keywords" content="{{data_get($data, 'parameters.meta_keyword')}}" />
    <meta name="description" content="{{data_get($data, 'parameters.meta_description')}}" />

    <link rel="shortcut icon" href="">
    <link href="{{asset('/images/favicon-2.png')}}" rel="icon" type="image/png" sizes="16x16">
    <link rel="canonical" href="https://www.fujacook.com.tw/">
    <link rel="alternate" href="https://www.fujacook.com" hreflang="zh-TW" />

    @foreach(data_get($data, 'parameters.master_style', []) as $var)
        <link rel="{{ data_get($var, 'name') }}" href="{{ json_decode( data_get($var, 'content')) }}" hreflang="{{ data_get($var, 'value') }}" />
    @endforeach

{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js')}}"></script>--}}
    <!-- jQuery Mobile -->
{{--    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.css')}}">--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js')}}"></script>--}}

    <!-- BootstrapCDN : Skip the download with BootstrapCDN to deliver cached version of Bootstrap’s compiled CSS and JS to your project. -->
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css')}}" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">--}}
{{--    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js')}}" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>--}}


<!--icon css-->
    <link rel="stylesheet" href="{{asset('web0617/css/font-awesome.min.css')}}">
    <!--bootstrap css-->
    <link rel="stylesheet" href="{{asset('web0617/css/bootstrap.css')}}"/>
    <!--custom css-->
    <link rel="stylesheet" href="{{asset('web0617/css/style.css')}}"/>

    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('css/waitMe.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/loading.css')}}" type="text/css">

    <link href="{{asset('web0708/Fujacook/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('web0708/Fujacook/css/all.css')}}" rel="stylesheet" type="text/css" media="all">

    <!-- Master styles -->
    <style type="text/css">
        .banner1 {
            /*width: 1280px;*/
            height: 400px;
            overflow:hidden;
        }
    </style>

    @yield('style')
</head>
<body>
    <!--wrap-->
    <div class="wrap">
        @include('front.layouts.nav')
        @include('front.layouts.header')
        @yield('content')
        @include('front.layouts.footer')
    </div>

<!-- ============================================================== -->
<!-- All Javascript And Jquery -->
<!-- ============================================================== -->

    <!--/wrap-->
    <script src="{{asset('web0617/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('web0617/js/bootstrap.min.js')}}"></script>
    <!--custom js-->
    <script src="{{asset('web0617/js/script.js')}}"> </script>

    <script src="{{asset('js/toastr.min.js')}}"></script>
{{--    <script src="{{asset('js/sweetalert.min.js')}}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{asset('js/waitMe.js')}}"></script>


    @include('front.layouts.script')
    @yield('inline-js')
</body>
</html>
