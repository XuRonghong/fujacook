<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
</head>

<body style="margin: 0px;">
<div style="font-family: '微軟正黑體', 'Microsoft JhengHei', Arial, sans-serif;width: 100%;background-color: #f3f2ee;">
    <table style="width: 80%;margin: 0px auto;height: 120px;">
        <tbody>
        <tr>
            <td style="width: 46%;vertical-align: bottom;padding-bottom: 8px;">
                <img src="{{asset('images/logo.png')}}" alt="" style="width: 100%;height: auto;max-width: 280px;">
            </td>
            <td style="width: 54%;text-align: right;vertical-align: bottom;font-size: 20px;color: #6a6a6a;padding: 10px 5px 15px;letter-spacing: 1px;font-weight: 800;">訂購商品明細通知信
            </td>
        </tr>
        </tbody>
    </table>
    <div style="width: 80%;margin: 0 auto;background-color: #ffffff;">
        <div style="color: #6a6a6a;padding: 90px 50px;">
            <div style="border-left: 10px solid #6a8e24;padding: 2px 15px;font-size: 22px;font-weight: 900;letter-spacing: 1px;color: #6a6a6a;margin-bottom: 50px;">
                <div style="margin-bottom: 4px;">親愛的會員<span style="color:#789162;margin:0 5px;font-weight: 800;">{{$info->addressee1->vName or ''}}</span>您好：感謝您訂購的商品。</div>
                <div style="font-size: 14px;color: #898989;font-weight: normal;">以下為您的訂購明細，您也可以至訂單資訊了解訂單詳情。
                    <br>若尚未付款，可點擊以下連結前往付款。
                    <br><a href="{{$pay_url or ''}}">訂單詳情</a>
                </div>
            </div>
            <table style="width: calc(100% );font-size: 15px;margin: 20px 0 20px;line-height: 28px;border-bottom: 1px solid #dddddd;padding: 0 0 15px;">
                <tbody>
                <tr>
                    <td style="padding: 0 5px;width: 100px;">日期：</td>
                    <td style="padding: 0 5px;width: calc(100% - 100px);">{{date('Y-m-d',$info->iCreateTime)}}</td>
                </tr>
                <tr>
                    <td style="padding: 0 5px;width: 100px;">訂單編號：</td>
                    <td style="padding: 0 5px;width: calc(100% - 100px);">{{$info->vOrderNum}}</td>
                </tr>
                </tbody>
            </table>
            <table style="width:100%;font-size: 16px;margin-bottom: 30px;line-height: 30px;word-break: break-all;">
                <thead>
                <tr>
                    <td colspan="2" style="padding: 10px;font-size: 18px;">訂單明細：@if($store)<span style="font-weight: 800;">店家：<span>{{$store->vStoreName or ''}}</span>)</span>@endif
                    </td>
                </tr>
                <tr style="text-align: center;">
                    <td style="padding: 10px;border: 1px solid #ddd;min-width: 150px;background-color: #d8e0d0;color:#336309;">名稱</td>
                    <td style="padding: 10px;border: 1px solid #ddd;background-color: #d8e0d0;color:#336309;">規格</td>
                    <td style="padding: 10px;border: 1px solid #ddd;background-color: #d8e0d0;color:#336309;">售價</td>
                    <td style="padding: 10px;border: 1px solid #ddd;background-color: #d8e0d0;color:#336309;">數量</td>
                    <td style="padding: 10px;border: 1px solid #ddd;background-color: #d8e0d0;color:#336309;">小計</td>
                </tr>
                </thead>
                <tbody>
                @foreach($info->meta as $key => $var)
                    <tr style="text-align: center;">
                        <td style="padding: 10px;border: 1px solid #ddd;line-height: 30px;">{{$var->vProductName or ''}}</td>
                        <td style="padding: 10px;border: 1px solid #ddd;">{{$var->vSpecTitle or ''}}</td>
                        <td style="padding: 10px;border: 1px solid #ddd;">{{$var->iProductPromoPrice or ''}}</td>
                        <td style="padding: 10px;border: 1px solid #ddd;">{{$var->iCount or ''}}</td>
                        <td style="padding: 10px;border: 1px solid #ddd;">{{$var->iTotal or ''}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <table style="width:100%;font-size: 16px;margin-bottom: 30px;">
                <thead>
                <tr>
                    <td colspan="2" style="padding: 10px;font-size: 18px;">收件人：</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="padding: 10px;border: 1px solid #ddd;width: 100px;text-align: right;background-color: #d8e0d0;color:#336309;line-height: 30px;text-align: center;">
                        姓名
                    </td>
                    <td style="padding: 10px;border: 1px solid #ddd;line-height: 30px;">{{$info->addressee2->vName or ''}}</td>
                </tr>
                <tr>
                    <td style="padding: 10px;border: 1px solid #ddd;width: 100px;text-align: right;background-color: #d8e0d0;color:#336309;line-height: 30px;text-align: center;">
                        聯繫電話
                    </td>
                    <td style="padding: 10px;border: 1px solid #ddd;line-height: 30px;">{{$info->addressee2->vContact or ''}}</td>
                </tr>
                <tr>
                    <td style="padding: 10px;border: 1px solid #ddd;width: 100px;text-align: right;background-color: #d8e0d0;color:#336309;line-height: 30px;text-align: center;">
                        聯繫地址
                    </td>
                    <td style="padding: 10px;border: 1px solid #ddd;line-height: 30px;">{{$info->addressee2->vAddress or ''}}</td>
                </tr>
                <tr>
                    <td style="padding: 10px;border: 1px solid #ddd;width: 100px;text-align: right;background-color: #d8e0d0;color:#336309;line-height: 30px;text-align: center;">
                        Email
                    </td>
                    <td style="padding: 10px;border: 1px solid #ddd;line-height: 30px;">{{$info->addressee3->vEmail or ''}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div style="padding: 25px;text-align: center;background-color: #789162;color: #fff;letter-spacing: 1px;font-size: 16px;">{{config('_website.web_title')}}</div>
    <div style="height: 20px;font-size: 12px;letter-spacing: 1px;background-color: #000000;color: #ffffff;padding: 11px;text-align: center;">※此信件為系統發出信件，請勿直接回覆。</div>
</div>
</body>

</html>