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

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    {{--    <script src="{{asset('xtreme-admin/assets/libs/jquery/dist/jquery.min.js')}}"></script>--}}
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <link href="{{asset('xtreme-admin/assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
    <link href="{{asset('xtreme-admin/assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
{{--    <link href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css" rel="stylesheet" type="text/css" />--}}
{{--    <link href='//fonts.googleapis.com/css?family=Oxygen:300' rel='stylesheet' type='text/css'>--}}

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
        #main-wrapper[data-layout=vertical] .topbar .navbar-collapse[data-navbarbg=skin1], #main-wrapper[data-layout=vertical] .topbar[data-navbarbg=skin1], #main-wrapper[data-layout=horizontal] .topbar .navbar-collapse[data-navbarbg=skin1], #main-wrapper[data-layout=horizontal] .topbar[data-navbarbg=skin1] {
            background-color: black;
        }
        .btn {
            margin-left: 5px;
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
{{--    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>--}}
{{--    <script>--}}
{{--        // THIS IS WHERE THE ERROR OCCURS--}}
{{--        new Chartist.Line('.ct-chart', {--}}
{{--            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],--}}
{{--            series: [--}}
{{--                [2, 3, 2, 4, 5],--}}
{{--                [0, 2.5, 3, 2, 3],--}}
{{--                [1, 2, 2.5, 3.5, 4]--}}
{{--            ]--}}
{{--        }, {--}}
{{--            width: 500,--}}
{{--            height: 300--}}
{{--        });--}}

{{--    </script>--}}
    <!--c3 charts -->
    <script src="{{asset('xtreme-admin/assets/extra-libs/c3/d3.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/assets/extra-libs/c3/c3.min.js')}}"></script>
    <!--chartjs -->
    <script src="{{asset('xtreme-admin/assets/libs/chart.js/dist/Chart.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/dist/js/pages/dashboards/dashboard1.js')}}"></script>


    <!--This page plugins -->
    <script src="{{asset('xtreme-admin/assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script src="{{asset('xtreme-admin/dist/js/pages/datatable/datatable-basic.init.js')}}"></script>

    <!-- lightbox -->
    <link  href="{{asset('vendor/lightbox2/dist/css/lightbox.css')}}" rel="stylesheet">
    <script src="{{asset('vendor/lightbox2/dist/js/lightbox.js')}}"></script>


    <script src="{{asset('js/toastr.min.js')}}"></script>
{{--    <script src="{{asset('js/sweetalert.min.js')}}"></script>--}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
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


        function ajax(url='', data={}, method='POST')
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                url: url,
                method: method,
                // type: "POST",
                dataType:"json",
                contentType: false,
                processData: false,
                cache: false,
                data: data,
                resetForm: true,
                success: function (data) {
                    if (data.status) {
                        toastr.success(data.message, "{{trans('_web_alert.notice')}}");
                        setTimeout(function () {
                            location.href = data.redirectUrl;
                        }, 500)
                    } else {
                        toastr.error(data.message, "{{trans('_web_alert.notice')}}");
                    }
                }
            });
        }


        function doDelete(url, data, table) {
            Swal.fire({
                title: "{{trans('_web_alert.del.title')}}",
                text: "{{trans('_web_alert.del.note')}}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{trans('_web_alert.ok')}}",
                cancelButtonText: "{{trans('_web_alert.cancel')}}",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        data: data,
                        type: "POST",
                        //async: false,
                        success: function (rtndata) {
                            if (rtndata.status) {
                                Swal.fire(
                                    "{{trans('_web_alert.notice')}}",
                                    rtndata.message,
                                    'success'
                                )
                                setTimeout(function () {
                                    table.api().ajax.reload(null, false);
                                }, 100);
                            } else {
                                Swal.fire(
                                    "{{trans('_web_alert.notice')}}",
                                    rtndata.message,
                                    'error'
                                )
                            }
                        },
                        error: function (err) {
                            console.log(err.responseJSON);
                            toastr.error(JSON.stringify(err.responseJSON), "{{trans('_web_alert.notice')}}");
                        }
                    });
                }
            })
        }

        function doDelete_2016(id, data)
        {
            {{--swal({--}}
            {{--    title: "{{trans('_web_alert.del.title')}}",--}}
            {{--    text: "{{trans('_web_alert.del.note')}}",--}}
            {{--    type: "warning",--}}
            {{--    showCancelButton: true,--}}
            {{--    confirmButtonText: "{{trans('_web_alert.ok')}}",--}}
            {{--    confirmButtonColor: "#DD6B55",--}}
            {{--    cancelButtonText: "{{trans('_web_alert.cancel')}}",--}}
            {{--    closeOnConfirm: true,--}}
            {{--}, function () {--}}
            {{--    $.ajax({--}}
            {{--        url: '{{$data['route_url']['destroy']}}'+'/'+id,--}}
            {{--        data: data,--}}
            {{--        type: "POST",--}}
            {{--        //async: false,--}}
            {{--        success: function (rtndata) {--}}
            {{--            if (rtndata.status) {--}}
            {{--                toastr.success(rtndata.message, "{{trans('_web_alert.notice')}}")--}}
            {{--                setTimeout(function () {--}}
            {{--                    table.api().ajax.reload(null, false);--}}
            {{--                }, 100);--}}
            {{--            } else {--}}
            {{--                swal("{{trans('_web_alert.notice')}}", rtndata.message, "error");--}}
            {{--            }--}}
            {{--        },--}}
            {{--        error: function (err) {--}}
            {{--            console.log(err.responseJSON);--}}
            {{--            toastr.error(JSON.stringify(err.responseJSON), "{{trans('_web_alert.notice')}}");--}}
            {{--        }--}}
            {{--    });--}}
            {{--});--}}
        }
    </script>

    @yield('inline-js')
</body>
</html>
