<?php
/**
*   一般產生訂單(全功能)範例
*/

    //載入SDK(路徑可依系統規劃自行調整)
    include('ECPay.Payment.Integration.php');

    try {
        
    	$obj = new ECPay_AllInOne();
        //-------------------------------這部分寫死在PHP上面----------------------------//
        //服務參數
        $obj->ServiceURL  = $params['ServiceURL'];  //服務位置
        $obj->HashKey     = $params['HashKey'];      //測試用Hashkey，請自行帶入ECPay提供的HashKey
        $obj->HashIV      = $params['HashIV'];         //測試用HashIV，請自行帶入ECPay提供的HashIV
        $obj->MerchantID  = $params['MerchantID'];      //測試用MerchantID，請自行帶入ECPay提供的MerchantID
        $obj->EncryptType = $params['EncryptType'];      //CheckMacValue加密類型，請固定填入1，使用SHA256加密

        //-------------------------------參數由前端給予--------------------------//
        //基本參數(請依系統規劃自行調整)
        $MerchantTradeNo = $params['ServiceURL'] ;//可以寫死
        $obj->Send['ReturnURL']         = $params['ReturnURL'];         //付款完成通知回傳的網址(背景接收付款結果)
        $obj->Send['OrderResultURL']    = $params['OrderResultURL'];     //付款完成顯示結果畫面的網址
        $obj->Send['MerchantTradeNo']   = $params['MerchantTradeNo'];      //訂單編號
        $obj->Send['MerchantTradeDate'] = $params['MerchantTradeDate'];      //交易時間
        $obj->Send['TotalAmount']       = $params['TotalAmount'];             //交易金額 新台幣
        $obj->Send['TradeDesc']         = $params['TradeDesc'];                 //交易描述
        $obj->Send['ChoosePayment']     = ECPay_PaymentMethod::Credit ;              //付款方式:全功能
        /************************************
        *  當ChoosePayment參數為Credit付款方式時：
        * 參數    |   參數名稱  |  型態    |    說明                                  |  範例
        * Language   語系設定    String(3)    預設語系為中文，若要變更語系參數值請帶：      ENG
        *                                       英語：ENG 
                                                韓語：KOR 
                                                日語：JPN 
                                                簡體中文：CHI 
                                            注意事項： 使用語系設定時，系統將不支援信用卡
                                            記憶卡號功能 
        *************************************/
        $obj->SendExtend['Language']   = $params['lang']=='en/'? 'ENG' : '';      //延伸參數，語系設定

        //訂單的商品資料
        array_push($obj->Send['Items'], $params['Items']);


        //Credit信用卡分期付款延伸參數(可依系統需求選擇是否代入)
        //以下參數不可以跟信用卡定期定額參數一起設定
        // $obj->SendExtend['CreditInstallment'] = '' ;    //分期期數，預設0(不分期)，信用卡分期可用參數為:3,6,12,18,24
        // $obj->SendExtend['Redeem'] = false ;           //是否使用紅利折抵，預設false
        // $obj->SendExtend['UnionPay'] = false;          //是否為聯營卡，預設false;
        //Credit信用卡定期定額付款延伸參數(可依系統需求選擇是否代入)
        //以下參數不可以跟信用卡分期付款參數一起設定
        // $obj->SendExtend['PeriodAmount'] = '' ;    //每次授權金額，預設空字串
        // $obj->SendExtend['PeriodType']   = '' ;    //週期種類，預設空字串
        // $obj->SendExtend['Frequency']    = '' ;    //執行頻率，預設空字串
        // $obj->SendExtend['ExecTimes']    = '' ;    //執行次數，預設空字串


        # 電子發票參數
        /*
        $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
        $obj->SendExtend['RelateNumber'] = "Test".time();
        $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
        $obj->SendExtend['CustomerPhone'] = '0911222333';
        $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
        $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
        $obj->SendExtend['InvoiceItems'] = array();
        // 將商品加入電子發票商品列表陣列
        foreach ($obj->Send['Items'] as $info)
        {
            array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
                $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => ECPay_TaxType::Dutiable));
        }
        $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
        $obj->SendExtend['DelayDay'] = '0';
        $obj->SendExtend['InvType'] = ECPay_InvType::General;
        */

        //產生訂單(auto submit至ECPay)
        $obj->CheckOut();

    
    } catch (Exception $e) {
    	echo $e->getMessage();
    }
?>