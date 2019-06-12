<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
<head>
    @yield('title')

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon icon -->
    <link href="{{asset('xtreme-admin/assets/images/favicon.png')}}" rel="icon" type="image/png" sizes="16x16">
    <!-- Custom CSS -->
    <link href="{{asset('xtreme-admin/assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('xtreme-admin/assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('xtreme-admin/dist/css/style.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- This page plugin CSS -->
    <link href="{{asset('xtreme-admin/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('css/waitMe.css')}}" type="text/css">

    <!-- Master styles -->
    <style type="text/css">
        #create_record {
            float: right;
            /*clear: both;*/
            margin-top: -25px;
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
        @include('admin.layouts.nav')
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
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="{{asset('xtreme-admin/assets/libs/chartist/dist/chartist.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
    <!--c3 charts -->
    <script src="{{asset('xtreme-admin/assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/assets/extra-libs/c3/c3.min.js')}}"></script>
    <!--chartjs -->
    <script src="{{asset('xtreme-admin/assets/libs/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/dist/js/pages/dashboards/dashboard1.js')}}"></script>


    <!--This page plugins -->
    <script src="{{asset('xtreme-admin/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

    <script src="{{asset('js/toastr.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
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

    @yield('inline-js')
</body>
</html>
