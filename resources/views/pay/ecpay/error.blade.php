<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="refresh" content="1; URL={{$form_url or ''}}">
    <title>訂單錯誤</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <style>
        html, body {
            height: 100%;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            color: #B0BEC5;
            display: table;
            font-weight: 100;
            font-family: 'Lato', sans-serif;
        }
        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }
        .content {
            text-align: center;
            display: inline-block;
        }
        .title {
            font-size: 36px;
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="content">
        <div class="title">訂單已取消或訂單錯誤</div>
    </div>
    <span style="font-size:24px;">
        2秒之后自动跳转到{{$url or ''}}...
    </span>
</div>
</body>
</html>
