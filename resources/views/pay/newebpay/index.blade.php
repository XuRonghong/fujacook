<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>藍新科技</title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body class="main">
<form id="spgateway" method="post" name="E_FORM"
      action="{{$CARD_URL}}">
    <input type="hidden" id="MerchantNumber" name="MerchantNumber" value="{{$params['MerchantNumber']}}">
    <input type="hidden" id="OrderNumber" name="OrderNumber" value="{{$params['OrderNumber']}}">
    <input type="hidden" id="Amount" name="Amount" value="{{$params['Amount']}}">
    <input type="hidden" id="ApproveFlag" name="ApproveFlag" value="{{$params['ApproveFlag']}}">
    <input type="hidden" id="DepositFlag" name="DepositFlag" value="{{$params['DepositFlag']}}">
    <input type="hidden" id="Englishmode" name="Englishmode" value="{{$params['Englishmode']}}">
    <input type="hidden" id="iphonepage" name="iphonepage" value="{{$params['iphonepage']}}">
    <input type="hidden" id="OrderURL" name="OrderURL" value="{{$params['OrderURL']}}">
    <input type="hidden" id="ReturnURL" name="ReturnURL" value="{{$params['ReturnURL']}}">
    <input type="hidden" id="checksum" name="checksum" value="{{$params['checksum']}}">
    <input type="hidden" id="op" name="op" value="{{$params['op']}}">
</form>
<script>
    $(document).ready(function () {
        document.E_FORM.submit();
    })
</script>
</body>
</html>
