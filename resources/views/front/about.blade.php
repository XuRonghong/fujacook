<!DOCTYPE html>
<!-- saved from url=(0030)https://0848ishida.jp/company/ -->
<html lang="{{ app()->getLocale() }}" class=" wf-active">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="author" content="{{data_get($data, 'parameters.meta_author')}}">
    <meta name="keywords" content="{{data_get($data, 'parameters.meta_keyword')}}" />
    <meta name="description" content="{{data_get($data, 'parameters.meta_description')}}" />

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="https://0848ishida.jp/wp/wp-content/themes/ishida/assets/images/common/favicon.ico">
    <title>{{data_get($data, 'parameters.meta_title')}}</title>

    <!-- web0708 about fujacook js-->
    <link href="{{asset('web0708/Fujacook/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('web0708/Fujacook/css/all.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('web0708/Fujacook/css/reset.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('web0708/Fujacook/css/common.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('web0708/Fujacook/css/page_company.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('web0708/Fujacook/css/style.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('web0708/Fujacook/css/jquery-jvectormap-2.0.3.css')}}" rel="stylesheet" type="text/css" media="all" />

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script src="{{asset('web0708/Fujacook/js/jce6yzd.js')}}" async=""></script>
    <script src="{{asset('web0708/Fujacook/js/analytics.js')}}" type="text/javascript" async="" ></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-135612501-1');
    </script>

    <script src="{{asset('web0708/Fujacook/js/jquery-1.9.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('web0708/Fujacook/js/jquery-jvectormap-2.0.3.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('web0708/Fujacook/js/jquery-jvectormap-world-mill-en.js')}}" type="text/javascript"></script>
    <link href="{{asset('web0708/Fujacook/css/about.css')}}" rel="stylesheet">
    <link href="{{asset('web0708/Fujacook/css/style.min.css')}}" rel="stylesheet" id="wp-block-library-css" type="text/css" media="all">
    <link href="{{asset('web0708/Fujacook/css/styles.css')}}" rel="stylesheet" id="contact-form-7-css" type="text/css" media="all">

    <link rel="canonical" href="https://www.fujacook.com">
    <link rel="shortlink" href="http://www.fujacook.com.tw/">

    <style type="text/css">
        .banner1 {
            /*width: 1280px;*/
            /*height: 400px;*/
            overflow:hidden;
        }
    </style>
</head>
<body>

    <div class="fuja-nav">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="{{url('')}}"><img src="{{asset('/web0617/img/logo.png')}}" alt="FUJACOOK即時鍋"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        @foreach(data_get($data, 'navbar', []) as $key => $var)
                            <li class="nav-item @if($key==1) active @endif">
                                <a class="nav-link {{data_get($var, 'style')}}" href="{{env('APP_URL') . data_get($var, 'url')}}">{{data_get($var, 'summary')}}</a>
                            </li>
                        @endforeach
                    </ul>
                    <ul class="social-media">
                        @foreach(array_get($data, 'parameters.external_link') as $var)
                            <li><a href="{{data_get($var,'content')}}"><i class="{{data_get($var,'value')}}"></i><p>{{data_get($var,'name')}}</p></a></li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    @foreach(data_get($data, 'slider', []) as $key => $var)
    <h6 id="fujacook">{{data_get($var,'type')}}</h6>
    <h1 id="brand">{{data_get($var,'title')}}</h1>
    <h6 id="content">{!! data_get($var,'summary') !!}</h6>
{{--    <h6 id="content2"></h6>--}}
{{--        <img src="{{data_get($var, 'image', array_first($var->images))}}" width="1884" height="943" alt="banner=" />--}}
    <div class="banner1">
        <img src="{{data_get($var, 'image', array_first($var->images))}}" alt="banner=" />
    </div>
    @endforeach


    <main role="main" id="l-contents">

        <div class="tab-wrap">
            <div class="inner">
                <ul class="tab-wrap-lister tab-wrap-top">
                <?php $i=1; ?>
                @foreach(data_get($data, 'navbar2', []) as $key => $var)
                    <li class="" data-tab-target="content" @if($i==1) class="tab-active" @endif>
                        <span class="number oswald">.0<?php echo $i;?></span>
                        <span class="center">{{data_get($var, 'summary')}}</span>
                        <i class="fas fa-lg fa-chevron-down"></i>
                    </li>
                    <?php $i++; ?>
                @endforeach
                </ul>
            </div>
        </div>

        <!--tab-contents start-->
        <div class="tab-contents" data-tab-contents-name="content">

            <!--tab-contents-list start-->
            <?php $ii=1; ?>
            @if(data_get($data, 'introduce.t01.0'))
            <div class="tab-contents-list tab-content-active" style="display: block;">
                <section class="message-sec">
                    <div class="inner message-ttl-head anime-slideIn anime-start" data-anime="on">
                        <div class="ttl-head clearfix">
                            <div class="ttl-head-inner clearfix">
                                <span class="oswald number">.0<?php echo $ii++;?></span>
                                <h2>
                                    <span class="heading_bold">FUJACOOK</span>
                                    <small class="tsukushi-bold">{{data_get($data, 'navbar2.'.($ii-2).'.summary', '')}}</small>
                                </h2>
                            </div>
                            <span class="authenia word-wrap">{{data_get($data, 'navbar2.'.($ii-2).'.detail', '')}}</span>
                        </div>
                    </div>
                    <div class="inner">
                        <div class="message-sec-inner clearfix">
                            <div class="img-area">
                                <figure>
                                    @foreach(data_get($data, 'introduce.t01', []) as $key => $var)
                                        <img src="{{data_get($var, 'image', array_first( data_get($var, 'images', []) ))}}" alt="創辦人介紹" style="width: 70%; margin-left:45%;">
                                    @endforeach
                                </figure>
                            </div>
                            <div class="text-area anime-slideIn anime-start" data-anime="on">
                                @foreach(data_get($data, 'introduce.t01', []) as $key => $var)
                                    {!! data_get($var, 'detail') !!}
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--myshopstick start-->

                    <!--myshopstick end-->
                </section>
            </div>
            @endif
            <!--tab-contents-list end-->

            <!--tab-contents-list start-->
            @if(data_get($data, 'introduce.t02.0'))
            <div class="tab-contents-list" style="display: none;">
                <section class="profile-sec">
                    <div class="inner">
                        <div class="ttl-head clearfix">
                            <div class="ttl-head-inner clearfix">
                                <span class="oswald number">.0<?php echo $ii++;?></span>
                                <h2>
                                    <span class="heading_bold">FUJACOOK</span>
                                    <b class="heading_bold">{{data_get($data, 'navbar2.'.($ii-2).'.summary', '')}}</b>
                                </h2>
                            </div>
                            <span class="authenia word-wrap">{{data_get($data, 'navbar2.'.($ii-2).'.detail', '')}}</span>
                        </div>
                        <div>
                            <img src="{{asset('web0708/Fujacook/img/得獎紀錄.jpg')}}" alt="得獎紀錄">
                        </div>
                        @foreach(data_get($data, 'introduce.t02', []) as $key => $var)
                            <div class="text-area-inner">
                                <li class="" data-tab-target="content">
                                    {!! data_get($var, 'detail') !!}
                                </li>
{{--                                <img src="{{data_get($var, 'image', array_first( data_get($var, 'images', []) ))}}"--}}
{{--                                     alt="{{data_get($var, 'summary', '研發理念')}}"--}}
{{--                                     style="width: 50%; margin-left:23.5%;margin-top: 5%">--}}
                            </div>
                        @endforeach
{{--                        <div id="map">--}}

{{--                        </div>--}}
{{--                        <script>--}}
{{--                            var championData = {--}}
{{--                                "BD": '',--}}
{{--                                "BE": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "BF": '',--}}
{{--                                "BG": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "BA": '',--}}
{{--                                "BN": '',--}}
{{--                                "BO": '',--}}
{{--                                "JP": '擁有15項設計專利證書及3項新型專利證書',--}}
{{--                                "BI": '',--}}
{{--                                "BJ": '',--}}
{{--                                "BT": '',--}}
{{--                                "JM": '',--}}
{{--                                "BW": '',--}}
{{--                                "BR": '擁有1項設計專利證書',--}}
{{--                                "BS": '',--}}
{{--                                "BY": '',--}}
{{--                                "BZ": '',--}}
{{--                                "RU": '擁有1項新型專利證書',--}}
{{--                                "RW": '',--}}
{{--                                "RS": '',--}}
{{--                                "TL": '',--}}
{{--                                "TM": '',--}}
{{--                                "TJ": '',--}}
{{--                                "RO": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "GW": '',--}}
{{--                                "GT": '',--}}
{{--                                "GR": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "GQ": '',--}}
{{--                                "GY": '',--}}
{{--                                "GE": '',--}}
{{--                                "GB": '擁有1項設計專利證書',--}}
{{--                                "GA": '',--}}
{{--                                "GN": '',--}}
{{--                                "GM": '',--}}
{{--                                "GL": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "GH": '',--}}
{{--                                "OM": '',--}}
{{--                                "TN": '',--}}
{{--                                "JO": '',--}}
{{--                                "HR": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "HT": '',--}}
{{--                                "HU": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "HN": '',--}}
{{--                                "PR": '',--}}
{{--                                "PS": '',--}}
{{--                                "PT": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "PY": '',--}}
{{--                                "PA": '',--}}
{{--                                "PG": '',--}}
{{--                                "PE": '',--}}
{{--                                "PK": '',--}}
{{--                                "PH": '擁有4項設計專利證書及4項新型專利證書',--}}
{{--                                "PL": '擁有4項設計專利證書及4項新型專利證書',--}}
{{--                                "ZM": '',--}}
{{--                                "EH": '',--}}
{{--                                "EE": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "EG": '',--}}
{{--                                "ZA": '',--}}
{{--                                "EC": '',--}}
{{--                                "IT": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "VN": 'SteelBlue',--}}
{{--                                "SB": '',--}}
{{--                                "ET": '',--}}
{{--                                "SO": '',--}}
{{--                                "ZW": '',--}}
{{--                                "ES": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "ER": '',--}}
{{--                                "ME": '',--}}
{{--                                "MD": '',--}}
{{--                                "MG": '',--}}
{{--                                "MA": '',--}}
{{--                                "UZ": '',--}}
{{--                                "MM": '',--}}
{{--                                "ML": '',--}}
{{--                                "MN": '',--}}
{{--                                "MK": '',--}}
{{--                                "MW": '',--}}
{{--                                "MR": '',--}}
{{--                                "UG": '',--}}
{{--                                "MY": '擁有1項設計專利證書<br>Singapore<br>2項設計專利證書',--}}
{{--                                "MX": '',--}}
{{--                                "IL": '',--}}
{{--                                "FR": '擁有1項設計專利證書',--}}
{{--                                "XS": '',--}}
{{--                                "FI": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "FJ": '',--}}
{{--                                "FK": '',--}}
{{--                                "NI": '',--}}
{{--                                "NL": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "NO": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "NA": '',--}}
{{--                                "VU": '',--}}
{{--                                "NC": '',--}}
{{--                                "NE": '',--}}
{{--                                "NG": '',--}}
{{--                                "NZ": '擁有2項發明專利證書',--}}
{{--                                "NP": '',--}}
{{--                                "XK": '',--}}
{{--                                "CI": '',--}}
{{--                                "CH": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "CO": '',--}}
{{--                                "CN": '擁有23項設計專利證書及4項新型專利證書<br>Hong Kong<br>擁有7項設計專利證書及2項新型專利證書',--}}
{{--                                "CM": '',--}}
{{--                                "CL": '',--}}
{{--                                "XC": '',--}}
{{--                                "CA": '擁有1項設計專利證書及1項發明專利證書',--}}
{{--                                "CG": '',--}}
{{--                                "CF": '',--}}
{{--                                "CD": '',--}}
{{--                                "CZ": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "CY": '',--}}
{{--                                "CR": '',--}}
{{--                                "CU": '',--}}
{{--                                "SZ": '',--}}
{{--                                "SY": '',--}}
{{--                                "KG": '',--}}
{{--                                "KE": '',--}}
{{--                                "SS": '',--}}
{{--                                "SR": '',--}}
{{--                                "KH": '',--}}
{{--                                "SV": '',--}}
{{--                                "SK": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "KR": '擁有20項設計專利證書及1項新型專利證書',--}}
{{--                                "SI": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "KP": '',--}}
{{--                                "KW": '',--}}
{{--                                "SN": '',--}}
{{--                                "SL": '',--}}
{{--                                "KZ": '',--}}
{{--                                "SA": '',--}}
{{--                                "SE": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "SD": '',--}}
{{--                                "DO": '',--}}
{{--                                "DJ": '',--}}
{{--                                "DK": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "DE": '擁有1項設計專利證書',--}}
{{--                                "YE": '',--}}
{{--                                "DZ": '',--}}
{{--                                "US": '擁有3項設計專利證書及2項發明專利證書',--}}
{{--                                "UY": '',--}}
{{--                                "LB": '',--}}
{{--                                "LA": '',--}}
{{--                                "TW": '擁有21項設計專利證書及4項新型專利證書',--}}
{{--                                "TT": '',--}}
{{--                                "TR": '',--}}
{{--                                "LK": '',--}}
{{--                                "LV": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "LT": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "LU": '',--}}
{{--                                "LR": '',--}}
{{--                                "LS": '',--}}
{{--                                "TH": '擁有1項設計專利證書及1項新型專利證書',--}}
{{--                                "TF": '',--}}
{{--                                "TG": '',--}}
{{--                                "TD": '',--}}
{{--                                "LY": '',--}}
{{--                                "AE": '',--}}
{{--                                "VE": '',--}}
{{--                                "AF": '',--}}
{{--                                "IQ": '',--}}
{{--                                "IS": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "IR": '',--}}
{{--                                "AM": '',--}}
{{--                                "AL": '',--}}
{{--                                "AO": '',--}}
{{--                                "AR": '',--}}
{{--                                "AU": '擁有1項新型專利證書',--}}
{{--                                "AT": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "IN": '',--}}
{{--                                "TZ": '',--}}
{{--                                "AZ": '',--}}
{{--                                "IE": '歐盟國<br>擁有歐盟認證3項設計專利證書',--}}
{{--                                "ID": 'SteelBlue',--}}
{{--                                "UA": '擁有1項新型專利證書',--}}
{{--                                "QA": '',--}}
{{--                                "MZ": ''--}}
{{--                            };--}}
{{--                            $('#map').vectorMap({--}}
{{--                                map: 'world_merc',--}}
{{--                                zoomMin: 0.01,--}}
{{--                                zoomMax: 20,--}}
{{--                                zoomOnScroll: false,--}}
{{--                                markers: [--}}
{{--                                    [33.262416, 108.955073],--}}
{{--                                    [24.484680, 113.324222],--}}
{{--                                    [28.917022, 126.387363],--}}
{{--                                    [63.405675, 102.817258],--}}
{{--                                    [16.273300, 100.893492],--}}
{{--                                    [14.169906, 108.380556],--}}
{{--                                    [-2.049634, 111.590931],--}}
{{--                                    [-23.700586, 134.305265],--}}
{{--                                    [-41.979352, 172.447306],--}}
{{--                                    [4.628427, 101.786596],--}}
{{--                                    [10.673377, 123.222208],--}}
{{--                                    [38.166072, 140.125764],--}}
{{--                                    [37.388696, 127.897879],--}}
{{--                                    [48.474799, 32.234907],--}}
{{--                                    [61.529235, -105.217956],--}}
{{--                                    [-9.134258, -48.862886],--}}
{{--                                    [40.569772, -101.523114],--}}
{{--                                    [51.395636, 10.366107],--}}
{{--                                    [47.230276, 3.045810],--}}
{{--                                    [74.476124, -40.237519],--}}
{{--                                    [54.232227, -8.228844],--}}
{{--                                ],--}}
{{--                                markerStyle: {--}}
{{--                                    initial: {--}}
{{--                                        image: './Fujacook/img/0101.png',--}}
{{--                                    }--}}
{{--                                },--}}

{{--                                focusOn: {--}}
{{--                                    x: -0.5,--}}
{{--                                    y: -0.5,--}}
{{--                                    scale: 16--}}
{{--                                },--}}
{{--                                backgroundColor: '#6495ED',--}}
{{--                                regionStyle: {--}}
{{--                                    hover: {--}}
{{--                                        fill: "#A0D1DC",--}}
{{--                                        cursor: 'pointer'--}}
{{--                                    },--}}
{{--                                },--}}
{{--                                series: {--}}
{{--                                    regions: [{--}}
{{--                                        scale: {--}}
{{--                                            red: '#FF0000',--}}
{{--                                            gray: '	#AAAAAA	',--}}
{{--                                            MediumPurple: '#9370DB',--}}
{{--                                            SteelBlue: '#4682B4',--}}
{{--                                            darkorange:'#FF8C00',--}}
{{--                                            sienna:'#A0522D',--}}
{{--                                            crimson:'#DC143C',--}}
{{--                                            indigo:'#4B0082',--}}
{{--                                            midnightblue:'#191970',--}}
{{--                                        },--}}
{{--                                        attribute: 'fill',--}}
{{--                                        values: {--}}
{{--                                            "BD": 'gray',--}}
{{--                                            "BE": 'crimson',--}}
{{--                                            "BF": 'gray',--}}
{{--                                            "BG": 'crimson',--}}
{{--                                            "BA": 'gray',--}}
{{--                                            "BN": 'gray',--}}
{{--                                            "BO": 'gray',--}}
{{--                                            "JP": 'midnightblue',--}}
{{--                                            "BI": 'gray',--}}
{{--                                            "BJ": 'gray',--}}
{{--                                            "BT": 'gray',--}}
{{--                                            "JM": 'gray',--}}
{{--                                            "BW": 'gray',--}}
{{--                                            "BR": 'midnightblue',--}}
{{--                                            "BS": 'gray',--}}
{{--                                            "BY": 'gray',--}}
{{--                                            "BZ": 'gray',--}}
{{--                                            "RU": 'midnightblue',--}}
{{--                                            "RW": 'gray',--}}
{{--                                            "RS": 'gray',--}}
{{--                                            "TL": 'gray',--}}
{{--                                            "TM": 'gray',--}}
{{--                                            "TJ": 'gray',--}}
{{--                                            "RO": 'crimson',--}}
{{--                                            "GW": 'gray',--}}
{{--                                            "GT": 'gray',--}}
{{--                                            "GR": 'crimson',--}}
{{--                                            "GQ": 'gray',--}}
{{--                                            "GY": 'gray',--}}
{{--                                            "GE": 'gray',--}}
{{--                                            "GB": 'midnightblue',--}}
{{--                                            "GA": 'gray',--}}
{{--                                            "GN": 'gray',--}}
{{--                                            "GM": 'gray',--}}
{{--                                            "GL": 'crimson',--}}
{{--                                            "GH": 'gray',--}}
{{--                                            "OM": 'gray',--}}
{{--                                            "TN": 'gray',--}}
{{--                                            "JO": 'gray',--}}
{{--                                            "HR": 'crimson',--}}
{{--                                            "HT": 'gray',--}}
{{--                                            "HU": 'crimson',--}}
{{--                                            "HN": 'gray',--}}
{{--                                            "PR": 'gray',--}}
{{--                                            "PS": 'gray',--}}
{{--                                            "PT": 'crimson',--}}
{{--                                            "PY": 'gray',--}}
{{--                                            "PA": 'gray',--}}
{{--                                            "PG": 'gray',--}}
{{--                                            "PE": 'gray',--}}
{{--                                            "PK": 'gray',--}}
{{--                                            "PH": 'midnightblue',--}}
{{--                                            "PL": 'crimson',--}}
{{--                                            "ZM": 'gray',--}}
{{--                                            "EH": 'gray',--}}
{{--                                            "EE": 'crimson',--}}
{{--                                            "EG": 'gray',--}}
{{--                                            "ZA": 'gray',--}}
{{--                                            "EC": 'gray',--}}
{{--                                            "IT": 'crimson',--}}
{{--                                            "VN": 'midnightblue',--}}
{{--                                            "SB": 'gray',--}}
{{--                                            "ET": 'gray',--}}
{{--                                            "SO": 'gray',--}}
{{--                                            "ZW": 'gray',--}}
{{--                                            "ES": 'crimson',--}}
{{--                                            "ER": 'gray',--}}
{{--                                            "ME": 'gray',--}}
{{--                                            "MD": 'gray',--}}
{{--                                            "MG": 'gray',--}}
{{--                                            "MA": 'gray',--}}
{{--                                            "UZ": 'gray',--}}
{{--                                            "MM": 'gray',--}}
{{--                                            "ML": 'gray',--}}
{{--                                            "MN": 'gray',--}}
{{--                                            "MK": 'gray',--}}
{{--                                            "MW": 'gray',--}}
{{--                                            "MR": 'gray',--}}
{{--                                            "UG": 'gray',--}}
{{--                                            "MY": 'midnightblue',--}}
{{--                                            "MX": 'gray',--}}
{{--                                            "IL": 'gray',--}}
{{--                                            "FR": 'crimson',--}}
{{--                                            "XS": 'gray',--}}
{{--                                            "FI": 'crimson',--}}
{{--                                            "FJ": 'gray',--}}
{{--                                            "FK": 'gray',--}}
{{--                                            "NI": 'gray',--}}
{{--                                            "NL": 'crimson',--}}
{{--                                            "NO": 'crimson',--}}
{{--                                            "NA": 'gray',--}}
{{--                                            "VU": 'gray',--}}
{{--                                            "NC": 'gray',--}}
{{--                                            "NE": 'gray',--}}
{{--                                            "NG": 'gray',--}}
{{--                                            "NZ": 'midnightblue',--}}
{{--                                            "NP": 'gray',--}}
{{--                                            "XK": 'gray',--}}
{{--                                            "CI": 'gray',--}}
{{--                                            "CH": 'crimson',--}}
{{--                                            "CO": 'gray',--}}
{{--                                            "CN": 'midnightblue',--}}
{{--                                            "CM": 'gray',--}}
{{--                                            "CL": 'gray',--}}
{{--                                            "XC": 'gray',--}}
{{--                                            "CA": 'midnightblue',--}}
{{--                                            "CG": 'gray',--}}
{{--                                            "CF": 'gray',--}}
{{--                                            "CD": 'gray',--}}
{{--                                            "CZ": 'crimson',--}}
{{--                                            "CY": 'gray',--}}
{{--                                            "CR": 'gray',--}}
{{--                                            "CU": 'gray',--}}
{{--                                            "SZ": 'gray',--}}
{{--                                            "SY": 'gray',--}}
{{--                                            "KG": 'gray',--}}
{{--                                            "KE": 'gray',--}}
{{--                                            "SS": 'gray',--}}
{{--                                            "SR": 'gray',--}}
{{--                                            "KH": 'gray',--}}
{{--                                            "SV": 'gray',--}}
{{--                                            "SK": 'crimson',--}}
{{--                                            "KR": 'midnightblue',--}}
{{--                                            "SI": 'crimson',--}}
{{--                                            "KP": 'gray',--}}
{{--                                            "KW": 'gray',--}}
{{--                                            "SN": 'gray',--}}
{{--                                            "SL": 'gray',--}}
{{--                                            "KZ": 'gray',--}}
{{--                                            "SA": 'gray',--}}
{{--                                            "SE": 'crimson',--}}
{{--                                            "SD": 'gray',--}}
{{--                                            "DO": 'gray',--}}
{{--                                            "DJ": 'gray',--}}
{{--                                            "DK": 'crimson',--}}
{{--                                            "DE": 'crimson',--}}
{{--                                            "YE": 'gray',--}}
{{--                                            "DZ": 'gray',--}}
{{--                                            "US": 'midnightblue',--}}
{{--                                            "UY": 'gray',--}}
{{--                                            "LB": 'gray',--}}
{{--                                            "LA": 'gray',--}}
{{--                                            "TW": 'midnightblue',--}}
{{--                                            "TT": 'gray',--}}
{{--                                            "TR": 'gray',--}}
{{--                                            "LK": 'gray',--}}
{{--                                            "LV": 'crimson',--}}
{{--                                            "LT": 'crimson',--}}
{{--                                            "LU": 'gray',--}}
{{--                                            "LR": 'gray',--}}
{{--                                            "LS": 'gray',--}}
{{--                                            "TH": 'midnightblue',--}}
{{--                                            "TF": 'gray',--}}
{{--                                            "TG": 'gray',--}}
{{--                                            "TD": 'gray',--}}
{{--                                            "LY": 'gray',--}}
{{--                                            "AE": 'gray',--}}
{{--                                            "VE": 'gray',--}}
{{--                                            "AF": 'gray',--}}
{{--                                            "IQ": 'gray',--}}
{{--                                            "IS": 'crimson',--}}
{{--                                            "IR": 'gray',--}}
{{--                                            "AM": 'gray',--}}
{{--                                            "AL": 'gray',--}}
{{--                                            "AO": 'gray',--}}
{{--                                            "AR": 'gray',--}}
{{--                                            "AU": 'midnightblue',--}}
{{--                                            "AT": 'crimson',--}}
{{--                                            "IN": 'gray',--}}
{{--                                            "TZ": 'gray',--}}
{{--                                            "AZ": 'gray',--}}
{{--                                            "IE": 'crimson',--}}
{{--                                            "ID": 'midnightblue',--}}
{{--                                            "UA": 'midnightblue',--}}
{{--                                            "QA": 'gray',--}}
{{--                                            "MZ": 'gray'--}}

{{--                                        }--}}

{{--                                    }]--}}
{{--                                },--}}
{{--                                onRegionTipShow: function(e, el, code) {--}}
{{--                                    el.html('<b>' + el.html() + '</b></br>' + '<b>' + championData[code] + '</b>');--}}
{{--                                }--}}


{{--                            }--}}
{{--    </script>--}}
                    </div>
                </section>
            </div>
            @endif
            <!--tab-contents end-->

            <!--tab-contents-list start-->
            @if(data_get($data, 'introduce.t03.0'))
            <div class="tab-contents-list" style="display: none;">
                <section class="profile-sec">
                    <div class="inner">
                        <div class="ttl-head clearfix">
                            <div class="ttl-head-inner clearfix">
                                <span class="oswald number">.0<?php echo $ii++;?></span>
                                <h2>
                                    <span class="heading_bold">FUJACOOK</span>
                                    <b class="heading_bold">{{data_get($data, 'navbar2.'.($ii-2).'.summary', '')}}</b>
                                </h2>
                            </div>
                            <span class="authenia word-wrap">{{data_get($data, 'navbar2.'.($ii-2).'.detail', '')}}</span>
                        </div>
                        @foreach(data_get($data, 'introduce.t03', []) as $key => $var)
                            <div class="text-area-inner">
                                <li class="" data-tab-target="content">
                                    {!! data_get($var, 'detail') !!}
                                </li>
                                <img src="{{data_get($var, 'image', array_first( data_get($var, 'images', []) ))}}"
                                     alt="{{data_get($var, 'summary', '研發理念')}}"
                                     style="width: 50%; margin-left:23.5%;margin-top: 5%">
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>
            @endif
            <!--tab-contents-list end-->

            <!--tab-contents-list start-->
            @if(data_get($data, 'introduce.t04.0'))
            <div class="tab-contents-list" style="display: none;">
                <section class="history-sec">
                    <div class="inner">
                        <div class="ttl-head clearfix">
                            <div class="ttl-head-inner clearfix">
                                <span class="oswald number">.0<?php echo $ii++;?></span>
                                <h2>
                                    <span class="heading_bold">FUJACOOK</span>
                                    <b class="heading_bold">{{data_get($data, 'navbar2.'.($ii-2).'.summary', '')}}</b>
                                </h2>
                            </div>
                            <span class="authenia word-wrap">{{data_get($data, 'navbar2.'.($ii-2).'.detail', '')}}</span>
                        </div>
                        <div class="history-sec-inner">
                            @foreach(data_get($data, 'introduce.t04', []) as $key => $var)
                                {!! $var->detail !!}
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            @endif
            <!--tab-contents-list end-->

            <!--tab-contents-list start-->
            @if(data_get($data, 'introduce.t05.0'))
            <div class="tab-contents-list" style="display: none;">
                <section class="profile-sec">
                    <div class="inner">
                        <div class="ttl-head clearfix">
                            <div class="ttl-head-inner clearfix">
                                <span class="oswald number">.0<?php echo $ii++;?></span>
                                <h2>
                                    <span class="heading_bold">FUJACOOK</span>
                                    <b class="heading_bold">{{data_get($data, 'navbar2.'.($ii-2).'.summary', '')}}</b>
                                </h2>
                            </div>
                            <span class="authenia word-wrap">{{data_get($data, 'navbar2.'.($ii-2).'.detail', '')}}</span>
                        </div>
                        <div class="text-area-inner">
                            @foreach(data_get($data, 'introduce.t05', []) as $key => $var)
                                <img src="{{array_first( data_get($var, 'images', data_get($var, 'image', [])) )}}" alt="創辦人介紹" style="width: 100%;">
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            @endif
            <!--tab-contents-list end-->
        </div>
        <!--tab-contents end-->

        <div class="l-lineup js__animation">
            <ul class="anime-slideIn" data-anime="on">
                @foreach(data_get($data, 'image.section3', []) as $key => $var)
                <li class="lineup-brand">
                    <img src="{{data_get($var, 'image', array_first(data_get($var, 'images', [])) )}}" alt="即食鍋">
                    <div class="img-area">
                        <i class="sp-only icon icon-btn_arrow_r"></i>
                    </div>
                    <a href="{{data_get($var, 'url')}}">
                        <div class="text-area">
                            <div class="heading_bold number">
                                <span class="oswald">{{data_get($var, 'title')}}</span>
                            </div>
                            <p>{{data_get($var, 'summary')}}</p>
                            <i class="pc-only icon icon-btn_arrow_r"></i>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="anime-slideIn" data-anime="on">
            <div class="contact-area">
                <div class="inner">
                    <div class="contact-ttl-head">
                        <b class="contact-ttl heading_bold">{{data_get($data, 'footer.0.title', 'CONTACT US')}}</b>
                        <div class="text-area">
                        </div>
                    </div>
                    <div class="contact-area-inner">
                        <ul class="clearfix">
                            {!! data_get($data, 'footer.0.detail') !!}
                            <li>
                                <b>線上詢問</b>
                                <a class="btn heading_book" href="{{data_get($data, 'footer.0.url')}}">
                                    <span class="btn-in">
                                        <i class="icon icon-btn_arrow_r"></i>CONTACT
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="sns-area">
            <div class="inner">
                <b class="heading_book">Follow Us On</b>
                <ul class="clearfix">
                    <li>
                        <a target="_blank" class="btn heading_bold" href="https://www.youtube.com/channel/UC086yJYv0ym3BNMrZWtViAA">
                            <span class="btn-in">
                                <i class="icon floater icon-youtube"></i>YouTube
                            </span>
                        </a>
                    </li>
                    <li>
                        <a target="_blank" class="btn heading_bold" href="https://www.instagram.com/fujacook/?hl=zh-tw">
                            <span class="btn-in">
                                <i class="icon icon-instagram"></i>instagram
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="footer-top">
            <div class="inner">
                <div class="breadcrumb-list">
                    <ul>
                        <li class="heading_book">
                            <a href="https://0848ishida.jp/">HOME</a>
                        </li>
                        <li>
                            關於FUJACOOK
                        </li>
                    </ul>
                </div>
                <div class="footer-inner">
                    <div class="footer-logo">
                        <a href="https://0848ishida.jp/">
                            <img src="./Fujacook/img/FUJACOOK LOGO 微鬆含框.ai.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="footer-bottom-l">
                        <address>23544<br>台灣新北市中和區中正路959號3樓</address>
                        <span>TEL：+886-2-2222-5988</span>
                    </div>
                    <div class="footer-bottom-r">
                        <ul class="footer-sns-nav clearfix">
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-copy">
            <div class="inner">
                <div class="footer-copy-inner">
                </div>
                <div class="copy-inner">
                    <small class="heading_book">©FUJACOOK Co.,Ltd. all rights reserved. </small>
                </div>
            </div>
        </div>
    </footer>

    <!-- web0708 about fujacook js-->
    <script src="{{asset('web0708/Fujacook/js/ScrollMagic.min.js')}}"></script>
    <script src="{{asset('web0708/Fujacook/js/TweenMax.min.js')}}"></script>
    <script src="{{asset('web0708/Fujacook/js/animation.gsap.min.js')}}"></script>
    <script src="{{asset('web0708/Fujacook/js/debug.addIndicators.min.js')}}"></script>
    <script src="{{asset('web0708/Fujacook/js/common.js')}}" type="text/javascript"></script>
    <script src="{{asset('web0708/Fujacook/js/jquery.matchHeight-min.js')}}"></script>
    <script src="{{asset('web0708/Fujacook/js/page_company.js')}}"></script>
    <script src="{{asset('web0708/Fujacook/js/tab.js')}}"></script>
    <script src="{{asset('web0708/Fujacook/js/tabs.js')}}"></script>
    <script src="{{asset('web0708/Fujacook/js/wp-embed.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('web0708/Fujacook/js/bootstrap.min.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
	</script>
</body>
</html>
