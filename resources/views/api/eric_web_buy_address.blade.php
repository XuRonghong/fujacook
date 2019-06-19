<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Buy with address</title>
    <script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
</head>
<body>
	<div>
    <?php
    if (!isset($_POST['kahap_status'])) {
        ?>
        <form id="form1" action="{{$form_url or ''}}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            @foreach($form_value as $key=> $value)
                <input type=hidden name="{!! $key !!}" value="{!! $value !!}">
            @endforeach

            <button type='submit' name='send' class="btn btn-primary" style="display: none">確認送出</button>
        </form>
        <script>
            $('.btn-primary').click();
        </script>
        <?php
    } else {
        unset($_POST['kahap_status']);
        ?>
        <script>
            location.href = '{!! $url !!}';
        </script>
        <?php
    }
    ?>
    </div>
</body>
</html>