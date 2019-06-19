<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::to('css/app.css') }}">

    <title>Laravel Excel Import csv and XLS file in Database</title>

    <!-- Fonts -->
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
            padding: 5%
        }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">
        Laravel Excel/CSV Import
    </h2>

    @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <strong>{{ Session::get('success') }}</strong>
        </div>
    @endif

    @if ( Session::has('error') )
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                <span class="sr-only">Close</span>
            </button>
            <h3><strong>{{ Session::get('error') }}</strong></h3>
        </div>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
    @endif

    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        Select import table :
        <select name="importTable" class="form-control">
            {{--<option value="">Choose . . .</option>--}}
            <option value="reservoir" selected>水庫資料庫(Sheet1)</option>
            {{--<option value="reservoir_info">水庫資料庫2</option>--}}
            {{--<option value="reservoir_meta">水庫資料庫3(Meta)</option>--}}
            <option value="member">會員資料庫</option>
            {{--<option value=""></option>--}}
        </select>
        Choose your xls/csv File : <input type="file" name="file" class="form-control" accept="*/*">

        <a href="{{url('/web/reservoir')}}" class="btn btn-primary btn-lg" style="margin-top: 3%">Back</a>
        <input type="submit" class="btn btn-primary btn-lg" style="margin-top: 3%;margin-left: 2%">

        <h4>
            PS: 上傳的檔案內的欄位名稱要與
            <b><a href="{{asset('template/2017水庫調查_1207.xls')}}">2017水庫調查_1207.xls</a></b>
            的一樣 <b>! !</b>
        </h4>
    </form>

</div>
</body>
</html>