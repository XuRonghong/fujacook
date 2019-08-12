<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{$vTitle.' ('.$N.')'}}</title>
        <!-- Fonts -->
        <link rel="{{$vTitle}}" type="image/x-icon" href="{{$icon}}" />
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .btn {
                width: 40px;
                /*height: 30px;*/
                margin: 0px -3px 0 0 ;
                /*padding: 0;*/
            }
            .show {
                background-color: white;
            }
            .red {
                background-color: #ff5f5b;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>
                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
                <hr>
                <div class="minesweeper">

                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            var aaData = [];
            var bbData = [];
            var timer = 0;
            var millisecond=0;
            function timedCount()
            {
                // document.getElementsByClassName('title').value=c;
                $('.title').html('Laravel'+ '<a class="timer" style="position: fixed;top: 15px;left: 380px;">' + (millisecond/100) + '</a>' );
                millisecond++;
                timer=setTimeout("timedCount()",10);
            }

            function document_ready() {
                //
                // if (!Date.now) {
                //     Date.now = function() { return new Date().getTime(); }
                // }
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.i = $(this).data('i');
                data.j = $(this).data('j');
                //set
                data.x = '<?php echo $X; ?>';
                data.y = '<?php echo $Y; ?>';
                data.n = '<?php echo $N; ?>';
                //
                $.ajax({
                    url: '{{url('playgame1')}}',
                    type: "POST",
                    data: data,
                    success: function (rtndata) {
                        aaData = rtndata.aaData;
                        bbData = rtndata.bbData;
                        show(rtndata);
                    }
                });
            });
            //
            $(".minesweeper").on('click','.btn',function () {
                // time_start = (time_start)? time_start : Date.now();  //now time
                if (millisecond===0) timedCount();
                //
                var data = {"_token": "{{ csrf_token() }}"};
                data.aaData = JSON.stringify(aaData);
                data.bbData = JSON.stringify(bbData);
                data.i = $(this).data('i');
                data.j = $(this).data('j');
                //
                $.ajax({
                    url: '{{url('playgame1')}}',
                    type: "POST",
                    data: data,
                    // async: false,
                    success: function (rtndata) {
                        if (rtndata.status===1) {
                            aaData = rtndata.aaData;
                            bbData = rtndata.bbData;
                            show(rtndata);
                        }else if(rtndata.status===2){       //Win
                            clearTimeout(timer);//time stop
                            show(rtndata);
                            $('.btn').val(function(){ return $(this).data('value') });   //show All value
                            $('.btn').addClass('show');
                            $('.btn').attr('disabled','true');
                            //show integral
                            $('.title').html('You Win ~^0^ '+ '<a class="timer" style="position: fixed;top: 15px;left: 380px;">' + (millisecond/100) + '</a>' );
                        }else{                              //Game Over
                            clearTimeout(timer);//time stop
                            show(rtndata);
                            $('.btn').val(function(){ return $(this).data('value') });   //show All value
                            $('.btn').addClass('show');
                            $('.btn').attr('disabled','true');
                            //show integral
                            $('.title').html('= =... GameOver '+ '<a class="timer" style="position: fixed;top: 15px;left: 380px;">' + (millisecond/100) + '</a>' );
                        }
                    }
                });
            });

            function show(rtndata){
                var html_str = '';
                for (var i in rtndata.aaData) {
                    for (var j in rtndata.aaData[i]) {
                        value = rtndata.aaData[i][j];
                        beClick = rtndata.bbData[i][j];
                        if (value===-1) {   //fence
                            html_str += '<input type="button" id="btn'+i+'-'+j+'" class="btn" data-value="'+value+'" data-i="'+i+'" data-j="'+j+'" value="'+value+'" style="display: none;" />';
                        } else if (beClick) {   //disable click
                            if(value==='X') {
                                html_str += '<input type="button" id="btn' + i + '-' + j + '" class="btn show red" data-value="' + value + '" data-i="' + i + '" data-j="' + j + '" value="' + value + '" disabled />';
                            } else {
                                html_str += '<input type="button" id="btn' + i + '-' + j + '" class="btn show" data-value="' + value + '" data-i="' + i + '" data-j="' + j + '" value="' + value + '" disabled />';
                            }
                        } else {    //no yet click
                            html_str += '<input type="button" id="btn'+i+'-'+j+'" class="btn" data-value="' + value + '" data-i="'+i+'" data-j="'+j+'" value="" />';
                        }
                    }
                    html_str += '<br>';
                }
                $(".minesweeper").html(html_str);
                // $('.btn').val(function(){ return $(this).data('value') });   //show All value
            }
        </script>
    </body>
</html>
