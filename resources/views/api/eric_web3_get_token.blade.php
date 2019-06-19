<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Get Token</title>
    <script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
</head>
<body>
    <div>
    <?php
    if (!isset($_POST['kahap_token'])&&!isset($_POST['kahap_status'])) {
        ?>
        <form id="form1" action="{{$form_url or ''}}" method="post">
          <input type=hidden name="kahap_hashkey" value="{{$_POST['kahap_hashkey'] or ''}}">
          <input type=hidden name="kahap_walletid" value="{{$_POST['kahap_walletid'] or ''}}">
            <button type='submit' name='send' class="btn btn-primary" style="display: none">確認送出</button>
        </form>
        <script>
            $('.btn-primary').click();
        </script>
        <?php
    } else {
        unset($_POST['kahap_status']);
        unset($_POST['balance_eth']);
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