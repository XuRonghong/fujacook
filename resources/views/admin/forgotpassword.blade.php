<!DOCTYPE html>
<html lang="en-us" id="extr-page">
<head>
    <meta charset="utf-8">
    <title>{{trans('web.title')}}</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- #CSS Links -->
    <!-- Basic Styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/font-awesome.min.css">

    <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/smartadmin-production-plugins.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/smartadmin-production.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/smartadmin-skins.min.css">

    <!-- SmartAdmin RTL Support -->
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/smartadmin-rtl.min.css">

    <!-- We recommend you use "your_style.css" to override SmartAdmin
                 specific styles this will also ensure you retrain your customization with each SmartAdmin update.
            <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/your_style.css"> -->

    <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
    <link rel="stylesheet" type="text/css" media="screen" href="/web_assets/v3/css/demo.min.css">

    <!-- #FAVICONS -->
    <link rel="shortcut icon" href="/web_assets/v3/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/web_assets/v3/img/favicon/favicon.ico" type="image/x-icon">

    <!-- #GOOGLE FONT -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

    <!-- #APP SCREEN / ICONS -->
    <!-- Specifying a Webpage Icon for Web Clip
                 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
    <link rel="apple-touch-icon" href="/web_assets/v3/img/splash/sptouch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/web_assets/v3/img/splash/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/web_assets/v3/img/splash/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/web_assets/v3/img/splash/touch-icon-ipad-retina.png">

    <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- Startup image for web apps -->
    <link rel="apple-touch-startup-image" href="/web_assets/v3/img/splash/ipad-landscape.png"
          media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
    <link rel="apple-touch-startup-image" href="/web_assets/v3/img/splash/ipad-portrait.png"
          media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
    <link rel="apple-touch-startup-image" href="/web_assets/v3/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
    <!-- Sweet Alert -->
    <link href="/web_assets/v1/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <!-- Toastr style -->
    <link href="/web_assets/v1/css/plugins/toastr/toastr.min.css" rel="stylesheet">

</head>

<body class="login">
<header id="header">
    <div id="logo-group">
			<span id="logo"> <img src="/web_assets/v3/img/logo.png" alt="SmartAdmin">
			</span>
    </div>
    <span id="extr-page-header-space"> <span class="hidden-mobile hiddex-xs">{{trans('web.forgotpassword.register')}}</span>
        <a href="{{url('web/register')}}" class="btn btn-danger">{{trans('web.forgotpassword.create_account')}}</a>
    </span>
</header>
<div id="main" role="main">
    <!-- MAIN CONTENT -->
    <div id="content" class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4"></div>
            <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                <div class="well no-padding">
                    <form id="forgotpassword-form" class="smart-form client-form">
                        <header> {{trans('web.forgotpassword.forgot_password')}} </header>
                        <fieldset>
                            <section>
                                <label class="label">{{trans('web.forgotpassword.email')}}</label>
                                <label class="input"> <i class="icon-append fa fa-envelope"></i>
                                    <input type="email" id="vAccount" name="vAccount">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i> {{trans('web.forgotpassword.email')}}</b>
                                </label>
                                <div class="note">
                                    <a href="{{url('web/login')}}">{{trans('web.forgotpassword.remembered')}}</a>
                                </div>
                            </section>
                        </fieldset>
                        <footer>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-refresh"></i> {{trans('web.forgotpassword.reset_password')}}
                            </button>
                        </footer>
                    </form>
                </div>
                <p class="note text-center">{{config('config.footer')}}</p>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="verification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">{{trans('web.forgotpassword.title')}}</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control vVerification" id="vVerification" placeholder="{{trans('web.forgotpassword.verification')}}" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control vPassword" id="vPassword" placeholder="{{trans('web.forgotpassword.new_password')}}" required/>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input type="text" class="form-control confirm_password" id="confirm_password" placeholder="{{trans('web.forgotpassword.confirm_password')}}" required/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('web.cancel')}}</button>
                <button type="button" class="btn btn-primary btn-doResetPassword">{{trans('web.forgotpassword.reset_password')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!--================================================== -->

<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
<script src="/web_assets/v3/js/plugin/pace/pace.min.js"></script>

<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script> if (!window.jQuery) {
        document.write('<script src="/web_assets/v3/js/libs/jquery-2.1.1.min.js"><\/script>');
    } </script>

<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script> if (!window.jQuery.ui) {
        document.write('<script src="/web_assets/v3/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
    } </script>

<!-- IMPORTANT: APP CONFIG -->
<script src="/web_assets/v3/js/app.config.js"></script>

<!-- JS TOUCH : include this plugin for mobile drag / drop touch events
    <script src="/web_assets/v3/js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> -->

<!-- BOOTSTRAP JS -->
<script src="/web_assets/v3/js/bootstrap/bootstrap.min.js"></script>

<!-- JQUERY VALIDATE -->
<script src="/web_assets/v3/js/plugin/jquery-validate/jquery.validate.min.js"></script>

<!-- JQUERY MASKED INPUT -->
<script src="/web_assets/v3/js/plugin/masked-input/jquery.maskedinput.min.js"></script>

<!--[if IE 8]>

<h1>Your browser is out of date, please update your browser by going to
    www.microsoft.com/download</h1>

<![endif]-->

<!-- MAIN APP JS FILE -->
<script src="/web_assets/v3/js/app.min.js"></script>
<!-- Sweet alert -->
<script src="/web_assets/v1/js/plugins/sweetalert/sweetalert.min.js"></script>
<!-- Toastr script -->
<script src="/web_assets/v1/js/plugins/toastr/toastr.min.js"></script>
<!-- Plugin Customer-->
<script type="text/javascript" src="/_assets/CryptoJS/rollups/md5.js"></script>

@include('_template_web._js.var')
<script type="text/javascript">
    runAllForms();
    $(function () {
        // Validation
        $("#forgotpassword-form").validate({
            // Rules for form validation
            rules: {
                vAccount: {
                    required: true,
                    email: true
                }
            },

            // Messages for form validation
            messages: {
                vAccount: {
                    required: "{{trans('web.forgotpassword.account_empty')}}",
                    email: "{{trans('web.forgotpassword.account_fail')}}"
                }
            },

            // Ajax form submition
            submitHandler: function (form) {
                form = "";
                var data = {"_token": "{{ csrf_token() }}"};
                data.vAccount = $("#vAccount").val();
                $.ajax({
                    url: url_doSendVerification,
                    type: "POST",
                    data: data,
                    //resetForm : true,
                    success: function (rtndata) {
                        if (rtndata.status) {
                            var modal = $("#verification");
                            modal.modal();
                        }
                    }
                });
            },

            // Do not change code below
            errorPlacement: function (error, element) {
                error.insertAfter(element.parent());
            }
        });
        $(".btn-doResetPassword").click(function () {
            var vVerification = $("#vVerification").val();
            var vPassword = $("#vPassword").val();
            var confirm_password = $("#confirm_password").val();
            if (vPassword != confirm_password) {
                return false;
            }
            var data = {"_token": "{{ csrf_token() }}"};
            data.vVerification = vVerification;
            data.vPassword = CryptoJS.MD5(vPassword).toString(CryptoJS.enc.Base64);
            $.ajax({
                url: url_doResetPassword,
                type: "POST",
                data: data,
                //resetForm : true,
                success: function (rtndata) {
                    if (rtndata.status) {
                        location.href = rtndata.rtnurl;
                    }
                }
            });
        })
    });
</script>
</body>
</html>