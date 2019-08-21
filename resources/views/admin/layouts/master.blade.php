<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    <title>{{data_get($data,'Title')}}</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon icon -->
    <link href="{{asset('/images/favicon-2.png')}}" rel="icon" type="image/png" sizes="16x16">
    <!-- Custom CSS -->
    <link href="{{asset('xtreme-admin/dist/css/style.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">

    <!-- ============================================================== -->
    <!-- 個別引入 -->
    <!-- ============================================================== -->
    <?php if( strrpos(Request::route()->getName(), '.index')) { ?>
        <!-- This page plugin CSS -->
        <link href="{{asset('xtreme-admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/waitMe.css')}}" type="text/css">
    <?php } elseif( //查找字符串在另一字符串中最后一次出现的位置（区分大小写）
            strrpos(Request::route()->getName(), '.create') ||
            strrpos(Request::route()->getName(), '.edit') || 
            strrpos(Request::route()->getName(), '.show') ) {  ?>
        <!-- 滑動開關切換按鈕﹍CSS 語法產生器 -->
        <link rel="stylesheet" href="{{asset('css/switch_demo2.css')}}" type="text/css">
    <?php } else { ?>
        <script src="{{asset('xtreme-admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
        <!-- Wave Effects -->
        <script src="{{asset('xtreme-admin/dist/js/waves.js')}}"></script>
        <!-- apps -->
        <script src="{{asset('xtreme-admin/dist/js/app-style-switcher.js')}}"></script>
    <?php } ?>

    <!-- Master styles -->
    @include('admin.layouts.style')
    @yield('style')
</head>
<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        @include('admin.layouts.header')
        @include('admin.layouts.nav2')
        @yield('content')
    </div>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->

{{--    @include('admin.layouts.footer')--}}

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
        <script src="{{asset('xtreme-admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="{{asset('xtreme-admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="{{asset('xtreme-admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
        <script src="{{asset('xtreme-admin/assets/extra-libs/sparkline/sparkline.js')}}"></script>
        <!-- Custom JavaScript -->
        <script src="{{asset('xtreme-admin/dist/js/custom.min.js')}}"></script>
        <!-- Menu sidebar -->
        <script src="{{asset('xtreme-admin/dist/js/sidebarmenu.js')}}"></script>
        <!-- apps -->
        <script src="{{asset('xtreme-admin/dist/js/app.min.js')}}"></script>
        <script src="{{asset('xtreme-admin/dist/js/app.init.js')}}"></script>
        <!-- This page plugins -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
        <script src="{{asset('js/toastr.min.js')}}"></script>

    <!-- ============================================================== -->
    <!-- 個別引入 -->
    <!-- ============================================================== -->
    <?php if( strrpos(Request::route()->getName(), '.index')) { ?>
        <script src="{{asset('xtreme-admin/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
        <script src="{{asset('xtreme-admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>
        <script src="{{asset('js/waitMe.js')}}"></script>
    <?php } elseif( //查找字符串在另一字符串中最后一次出现的位置（区分大小写）
            strrpos(Request::route()->getName(), '.create') ||
            strrpos(Request::route()->getName(), '.edit') || 
            strrpos(Request::route()->getName(), '.show') ) {  ?>
    <?php } else { ?>
        <script src="{{asset('xtreme-admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
        <!-- Wave Effects -->
        <script src="{{asset('xtreme-admin/dist/js/waves.js')}}"></script>
        <!-- apps -->
        <script src="{{asset('xtreme-admin/dist/js/app-style-switcher.js')}}"></script>
    <?php } ?>


    @include('admin.layouts.script')
    @yield('inline-js')

    <script>
        //// windows load ready ////
        $(document).ready(function () {
            toastr_options()
            document_ready()
        })
    </script>
</body>
</html>
