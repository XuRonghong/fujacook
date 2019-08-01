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

    <!-- This page plugin CSS -->
    <link href="{{asset('xtreme-admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
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
    <link rel="stylesheet" href="{{asset('css/waitMe.css')}}" type="text/css">
    <!-- 滑動開關切換按鈕﹍CSS 語法產生器 -->
    <link rel="stylesheet" href="{{asset('css/switch_demo2.css')}}" type="text/css">

    <!-- Master styles -->
    <style type="text/css">
        /* 新增按鈕 */
        #create_record {
            float: right;
            /*clear: both;*/
            margin-top: -25px;
            height: 30px;
        }
        /* 返回Back */
        .btn-back {
            float: right;
            /*clear: both;*/
            margin-top: -25px;
            height: 30px;
            visibility: hidden;
            display: none;
        }
        /* 上方列 */
        #main-wrapper[data-layout=vertical] .topbar .navbar-collapse[data-navbarbg=skin1],
        #main-wrapper[data-layout=vertical] .topbar[data-navbarbg=skin1],
        #main-wrapper[data-layout=horizontal] .topbar .navbar-collapse[data-navbarbg=skin1],
        #main-wrapper[data-layout=horizontal] .topbar[data-navbarbg=skin1]
        {
            background-color: #82191d;
            height: 40px;
        }
        .topbar .top-navbar {
            min-height: 44px;
            padding: 0;
        }
        .topbar .top-navbar .navbar-nav>.nav-item>.nav-link {
            padding: 0 15px;
            font-size: .875rem;
            line-height: 44px;
            height: 44px;
        }
        /* breadcrumb 位置 */
        .page-breadcrumb {
            padding: 0px 20px 0;
        }
        /* 報表按鈕 */
        .btn {
            margin-left: 5px;
        }
        /* Swal.fire({}) */
        .swal2-modal {
            width: auto !important;
        }
        /* my profile item of top self */
        .bg-primary {
            background-color: #82191d !important;
        }
        /* 背景 */
        .page-wrapper {
            background: #fbf2f2;
            position: relative;
            display: none;
        }
        /* breadcrumb */
        .page-breadcrumb .row {
            height: 30px;
        }
    </style>

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
    <script src="{{asset('xtreme-admin/assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- apps -->
    <script src="{{asset('xtreme-admin/dist/js/app.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/dist/js/app.init.js')}}"></script>
    <script src="{{asset('xtreme-admin/dist/js/app-style-switcher.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('xtreme-admin/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('xtreme-admin/dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('xtreme-admin/dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('xtreme-admin/dist/js/custom.min.js')}}"></script>


    <!--This page plugins -->
    <script src="{{asset('xtreme-admin/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

    <script src="{{asset('js/toastr.min.js')}}"></script>
{{--    <script src="{{asset('js/sweetalert.min.js')}}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="{{asset('js/waitMe.js')}}"></script>

    @include('admin.layouts.script')
    @yield('inline-js')
</body>
</html>
