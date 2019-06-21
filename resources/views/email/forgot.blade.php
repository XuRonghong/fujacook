<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body style="margin: 0px;">
<div style="font-family: '微軟正黑體', 'Microsoft JhengHei', Arial, sans-serif;width: 100%;background-color: #f3f2ee">
    <table style="width: 80%;margin: 0px auto;height: 120px;">
        <tbody>
        <tr>
            <td style="width: 46%;vertical-align: bottom;padding-bottom: 8px;">
                <img src="{{asset('portal_assets/dist/img/logo2.png')}}" alt="" style="width: 100%;height: auto;max-width: 280px;">
            </td>
            <td style="width: 54%;text-align: right;vertical-align: bottom;font-size: 20px;color: #6a6a6a;padding: 10px 5px 15px;letter-spacing: 1px;font-weight: 800;">忘記密碼 密碼通知信
            </td>
        </tr>
        </tbody>
    </table>
    <div style="width: 80%;margin: 0 auto;background-color: #ffffff;">
        <div style="color: #6a6a6a;padding: 90px 50px;">
            <div style="border-left: 10px solid #6a8e24;padding: 2px 15px;font-size: 22px;font-weight: 900;letter-spacing: 1px;color: #6a6a6a;margin-bottom: 50px;">
                <div style="margin-bottom: 4px;">親愛的會員<span style="color:#789162;margin:0 5px;font-weight: 800;"></span>您好：</div>
                <div style="font-size: 14px;color: #898989;font-weight: normal;">我們收到了您忘記密碼的消息，請確認此為您本人的操作。</div>
            </div>
            <div style="font-size: 22px;margin-bottom: 50px;line-height: 40px;padding: 0 25px;text-align: justify;">
                <div style=""> 以下是您的臨時密碼</div>
                <div style="font-size: 30px;margin-bottom: 18px;border-bottom: 1px solid;">{{$verification}}</div>
            </div>
        </div>
    </div>
    <div style="padding: 25px;text-align: center;background-color: #789162;color: #fff;letter-spacing: 1px;font-size: 16px;">{{config('_website.web_title')}}</div>
    <div style="height: 20px;font-size: 12px;letter-spacing: 1px;background-color: #000000;color: #ffffff;padding: 11px;text-align: center;">※此信件為系統發出信件，請勿直接回覆。</div>
</div>
</body>

</html>