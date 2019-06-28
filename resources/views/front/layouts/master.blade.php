<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>{{data_get($data,'Title', config('app.title'))}}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <meta name="keywords" content="鍋具品牌,鍋具料理,鍋具推薦,鍋具介紹,鍋具收納,鍋具配件,鍋具不沾鍋,鍋具專賣店,如何挑選鍋具,多功能鍋具,鍋子品牌,鍋子料理,鍋子推薦,鍋子介紹,鍋子收納,鍋子配件,鍋子不沾鍋,鍋子專賣店,如何挑選鍋子多功能鍋子,即食鍋具,即食鍋子,即食鍋,即時餐,各國料理,各式料理,fujacook,FUJACOOK即食鍋,富呷一方" />
    <meta name="description" content="即時的歡樂趴，永恆的幸福感。 富呷一方, fujacook, 即食鍋, FUJACOOK即食鍋" />

    <link rel=”alternate” href=”https://www.fujacook.com” hreflang=”zh-TW” />
    <link rel=”canonical” href=”https://www.fujacook.com”>


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

    <!-- Master styles -->
    <style type="text/css">
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
