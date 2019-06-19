<?php

namespace App\Http\Controllers\_API;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Jenssegers\Agent\Agent;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncController;
use App\SysMember;
use App\SysMemberInfo;
use App\SysMemberAccess;
use App\SysAgentAccess;
use App\SysMenu;
use App\SysMemberVerification;
use App\ModOrder;
use App\ModOrderSmart;
use App\ModOrderBuyer;
use phpDocumentor\Reflection\Types\Array_;
use phpDocumentor\Reflection\Types\Integer;
use App\ModPayServiceOrderLog;
use App\ModPayServiceTrade;


class OrderController extends _WebController
{

    protected $_token = "oxymrssVCB6D724F1F658xjvo95DNNSwivRBuOctyoorX425DF487";
    private $lang ;
    private $url_error ;
    private $url_success ;
    private $url_get_success ;
    private $url_eth;
    private $url_vault;
    private $url_address;
    private $url_withdraw;
    private $url_get_eth;
    private $url_get_token;
    private $url_ecpay_api;
    private $manager_wallet_id = '0x565fd3B3E4b5E3174C9FD18d67053DFEeb332628';      //管理理者錢包地址

//    protected $module = "ecpay";
    protected $vPayService = "EcPay";
    protected $vPaymentType = "ECPAY::ALL";
//    private static $CARD_URL = "https://testmaple2.neweb.com.tw/NewebmPP/cdcard.jsp";


    function __construct()
    {
        $this->lang = isset($_COOKIE['lang'])? $_COOKIE['lang'] : '';       //前端切換語系需要
        $this->url_error = 'https://actualminer2.herokuapp.com/'.$this->lang.'account/points/error';
        $this->url_success = 'https://actualminer2.herokuapp.com/'.$this->lang.'account/points/completed';
        $this->url_get_success = 'https://actualminer2.herokuapp.com/'.$this->lang.'account/points';
        $this->url_withdrawal_success = 'https://actualminer2.herokuapp.com/'.$this->lang.'account/withdrawal';

        $this->url_eth = 'http://fine-i.com/kahap/am_buy_eth_post.php';         // E T H 購 買
        $this->url_vault = 'http://fine-i.com/kahap/am_buy_vault_post.php';     // 餘 額 購 買
        $this->url_address = 'http://fine-i.com/kahap/am_buy_address_post.php';     // 法 幣 購 買
        $this->url_withdraw = 'http://fine-i.com/kahap/am_withdraw_post.php';   // 帳 戶 提 領

        $this->url_get_eth = 'http://fine-i.com/kahap/am_eth_balance_post.php';   // GET ETH BALANCE
        $this->url_get_token = 'http://fine-i.com/kahap/am_get_token_post.php';   // GET TOKEN

        $this->url_ecpay_api = 'https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5';     //綠界科技全方位金流介接
    }


    //**********************************************
    // 搜尋會員所有訂單
    //**********************************************
    public function getList(Request $request)
    {
        $_token =  $request->exists( '_token' ) ? $request->input( '_token' ) : '';
        //
        if ( !$_token || $_token != $this->_token) {
            $this->rtndata ['status'] = 401;
            $this->rtndata ['message'] = 'token '.$_token.' is error !! : '. '需要授權以回應請求。';
            //Logs
            $this->_saveLogAction( 'mod_order', 10019, 'error token getList from '.$request->ip() , json_encode( $request->all() , JSON_UNESCAPED_UNICODE ) );
            return response()->json( $this->rtndata );
        }

        try{
            $uid = $request->exists('uid') ? htmlspecialchars($request->input('uid')) : 0;
            if (!is_string($uid)) {
                $this->rtndata ['status'] = 205;
                $this->rtndata ['message'] = 'error or null value';
                return response()->json( $this->rtndata );
            }

            $data_array = array();
            if ($uid) {     //有指定會員的訂單
                $map['iMemberId'] = $uid;
                $DaoOrder = ModOrder::query()->where($map)->get();
            }else{          //沒有則顯示所有會員的訂單
                $DaoOrder = ModOrder::query()->get();
            }

            if ($DaoOrder) {
                $eth_total = 0;
                $flat_total = 0;
                foreach ($DaoOrder as $key => $value) {
                    //
                    $map2['vOrderNum'] = $value['vOrderNum'];
                    $DaoOrderS = ModOrderSmart::query()->where($map2)->first();
                    $DaoOrderB = ModOrderBuyer::query()->where($map2)->first();
                    if ($DaoOrderS && $DaoOrderB) {
                        //
                        $data_array[$key]['tradeid'] = $value->vOrderNum?$value->vOrderNum:'';
                        //
                        $data_array[$key]['buy_point'] = $value->iCount?$value->iCount:'';
                        $data_array[$key]['buy_price_usd'] = $value->iMoneyTotal?$value->iMoneyTotal:'';
                        $data_array[$key]['buy_price_total_flat'] = $value->iPromoFee?$value->iPromoFee:'';     //這裡放iMoneyTotal換算的法幣
                        $data_array[$key]['pay_type'] = $value->vPaymentType?$value->vPaymentType:'';
                        $data_array[$key]['buy_name'] = $DaoOrderB->vName?$DaoOrderB->vName:'';
                        $data_array[$key]['buy_email'] = $DaoOrderB->vEmail?$DaoOrderB->vEmail:'';
                        $data_array[$key]['kahap_status'] = $DaoOrderS->vStatus?$DaoOrderS->vStatus:'';//.': '.$DaoOrderS->vTxhash;
                        $data_array[$key]['buy_time'] = $DaoOrderS->iCreateTime?$DaoOrderS->iCreateTime:'';
                        $data_array[$key]['kahap_ethqty'] = $DaoOrderS->iEthQty?$DaoOrderS->iEthQty:'';
                        $data_array[$key]['kahap_token'] = $value->iCount?$value->iCount:'';            //法幣購買的智能合約(以千為單位)
                        $data_array[$key]['ecpay_rtnMsg'] = $value->vStatus?$value->vStatus:'';             //綠界的交易訊息
                        $data_array[$key]['txhash_time'] = $DaoOrderS->iUpdateTime?$DaoOrderS->iUpdateTime:'';  //上鍊時間
                        $data_array[$key]['buy_price_tw'] = $value->iPrice?$value->iPrice:'';     //綠界功能要的台幣

                        $eth_total += $data_array[$key]['kahap_ethqty'];
                        $flat_total += $data_array[$key]['buy_price_usd'];
                    }
                    //
                }
                $total_count = count($data_array);
                $this->rtndata ['status'] = 200;
                $this->rtndata ['aaData'] = $total_count ? $data_array : 0;
                $this->rtndata ['total'] = $total_count ;
                $this->rtndata ['eth_total'] = $eth_total ;
                $this->rtndata ['flat_total'] = $flat_total ;
            }else{  
                $total_count = 0;
                $this->rtndata ['status'] = 204;
                $this->rtndata ['message'] = 'no data !';
                $this->rtndata ['total'] = $total_count ;
            }

        }catch (\Exception $e){
            $this->rtndata ['status'] = 403;
            $this->rtndata ['message'] = $e->getMessage();
            return response()->json( $this->rtndata );
        }

        return response()->json($this->rtndata, $this->rtndata['status']);
    }


    //**********************************************
    // 搜尋訂單
    //**********************************************
    public function find(Request $request)
    {
        $_token =  $request->exists( '_token' ) ? $request->input( '_token' ) : '';
        //
        if ( !$_token || $_token != $this->_token) {
            $this->rtndata ['status'] = 401;
            $this->rtndata ['message'] = 'token '.$_token.' is error !! : '. '需要授權以回應請求。';
            //Logs
            $this->_saveLogAction( 'mod_order ', 10019, 'error token find from '.$request->ip() , json_encode( $request->all() , JSON_UNESCAPED_UNICODE ) );
            return response()->json( $this->rtndata );
        }

        try{
            $id = $request->exists('id') ? htmlspecialchars($request->input('id')) : "";
            if (!is_string($id)) {
                $this->rtndata ['status'] = 205;
                $this->rtndata ['message'] = 'error or null value';
                return response()->json( $this->rtndata );
            }

            $data_array = array();
            $total_count = 1;

            $map2['vOrderNum'] = $id;
            $map['iId'] = $id;
            $DaoOrder = ModOrder::query()->where($map2)->orWhere($map)->first();
            $DaoOrderS = ModOrderSmart::query()->where($map2)->orWhere($map)->first();
            $DaoOrderB = ModOrderBuyer::query()->where($map2)->orWhere($map)->first();
            if (!$DaoOrder || !$DaoOrderS || !$DaoOrderB){
                $total_count = 0;
            }
            //姓名 email 點數 金額 付款方式 交易狀態
            $data_array['buy_point'] = $DaoOrder->iCount;
            $data_array['buy_price_usd'] = $DaoOrder->iMoneyTotal;
            $data_array['buy_price_total_flat'] = $DaoOrder->iPromoFee;     //這裡放iMoneyTotal換算的法幣
            $data_array['pay_type'] = $DaoOrder->vPaymentType;
            $data_array['buy_name'] = $DaoOrderB->vName;
            $data_array['buy_email'] = $DaoOrderB->vEmail;
            $data_array['kahap_status'] = $DaoOrderS->vStatus.': '.$DaoOrderS->vTxhash;
            $data_array['buy_time'] = $DaoOrderS->iCreateTime;
            $data_array['kahap_ethqty'] = $DaoOrderS->iEthQty;
            $data_array['kahap_token'] = $DaoOrder->iCount;             //法幣購買的智能合約(以千為單位)
            $data_array['ecpay_rtnMsg'] = $DaoOrder->vStatus;             //綠界的交易訊息
            $data_array['txhash_time'] = $DaoOrderS->iUpdateTime?$DaoOrderS->iUpdateTime:'';  //上鍊時間
            $data_array['buy_price_tw'] = $DaoOrder->iPrice?$DaoOrder->iPrice:'';       //綠界功能要的台幣

        }catch (\Exception $e){
            $this->rtndata ['status'] = 400;
            $this->rtndata ['message'] = "buy address error: \r\n<br>: ".$e->getMessage();
            return response()->json( $this->rtndata );
        }


        $this->rtndata ['status'] = 200;
        $this->rtndata ['aaData'] = $total_count ? $data_array : 0;
        $this->rtndata ['total'] = $total_count;
        return response()->json($this->rtndata);
    }



    //**********************************************
    // E T H 購 買
    //**********************************************
    public function buyEth(Request $request)
    {
        $form_action = $this->url_eth;
        $this->module = [ 'eric_web3_buy_eth' ];
        $this->view = View()->make( '_api.' . implode( '.' , $this->module ) );

        if (!isset($_POST['kahap_status']))     //對方回傳給我會有status
        {

            try{
                /*
                 * 是前端傳給我,我要傳給對方智能合約...
                 */
                $lang = $request->exists('lang') ? ($request->input('lang')) : "";

                //交易ID 交易時間 購買人姓名 購買人Email 購買點數 購買金額 電子錢包 國家 付款方式
                $vHashKey = $request->exists('kahap_hashkey') ? htmlspecialchars($request->input('kahap_hashkey')) : "";
                $vOrderNum = $request->exists('kahap_tradeid') ? htmlspecialchars($request->input('kahap_tradeid')) : "";
                $vWallet = $request->exists('kahap_walletid') ? htmlspecialchars($request->input('kahap_walletid')) : "";
                $vCode = $request->exists('kahap_vcode') ? htmlspecialchars($request->input('kahap_vcode')) : "";
                $vAcode = $request->exists('kahap_acode') ? htmlspecialchars($request->input('kahap_acode')) : "";
                $iEthQty = $request->exists('kahap_ethqty') ? htmlspecialchars($request->input('kahap_ethqty')) : 0;

                $iMemberId = $request->exists('user_id') ? htmlspecialchars($request->input('user_id')) : 0;
                $vBuyName = $request->exists('buy_name') ? ($request->input('buy_name')) : "";
                $vBuyEmail = $request->exists('buy_email') ? htmlspecialchars($request->input('buy_email')) : "";
                $iCount = $request->exists('buy_point') ? htmlspecialchars($request->input('buy_point')) : 0;
                $iMoneyTotal = $request->exists('buy_price') ? htmlspecialchars($request->input('buy_price')) : 0;
                $vCountry = $request->exists('country') ? htmlspecialchars($request->input('country')) : "";
                $vPaymentType = $request->exists('pay_type') ? htmlspecialchars($request->input('pay_type')) : '';
                $iMoneyTotalFlat = $request->exists('buy_price_flat') ? htmlspecialchars($request->input('buy_price_flat')) : 0;    //這裡放iMoneyTotal換算的法幣


                $DaoOrder = new ModOrder();
                $DaoOrder->vOrderNum = $vOrderNum;
                $DaoOrder->iMemberId = $iMemberId;
                $DaoOrder->iProductId = 1;          //預設第一個商品(算力點數)
                $DaoOrder->iCount = $iCount;        //點數
                $DaoOrder->iMoneyTotal = $iMoneyTotal;      //用ETH購買就沒有這個值
                $DaoOrder->vPayId = '1';                      //預設第一個付款(還未定義)
                $DaoOrder->vPaymentType = $vPaymentType;    //單純放交易方式
                $DaoOrder->iShipmentId = 1;                 //預設第一個 (還未定義)
                $DaoOrder->iPromoFee = $iMoneyTotalFlat;                 //這裡放iMoneyTotal換算的法幣
                $DaoOrder->vWallet = $vWallet;              //錢包id
                $DaoOrder->iCreateTime = $DaoOrder->iUpdateTime = time();
                $DaoOrder->iStatus = 1;
                $DaoOrder->save();
                $iTableId = ModOrder::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
                //Logs
                $this->_saveLogAction( $DaoOrder->getTable(), $iTableId, 'buyEth from '.$request->ip() , json_encode( $DaoOrder , JSON_UNESCAPED_UNICODE ) );


                //紀錄-智能合約訂單-歸類為[系統類別]
                $sys_category_id = $this->getSysCategoryId('智能合約Order', 'mod_order_smart',0);
                //
                $DaoOrderSmart = new ModOrderSmart();
                $DaoOrderSmart->iCategoryType = $sys_category_id;     //系統類別id
                $DaoOrderSmart->iType = $this->getSysCategoryId('ETH', 'mod_order_smart', $sys_category_id);
                $DaoOrderSmart->vUrl = $form_action;        //呼叫 api 的位置
                $DaoOrderSmart->vOrderNum = $vOrderNum;
    //            //$DaoOrderSmart->iTradeId = '';
                $DaoOrderSmart->vHashKey = $vHashKey;
                $DaoOrderSmart->vCode = $vCode;
                $DaoOrderSmart->vAcode = $vAcode;
                $DaoOrderSmart->iEthQty = $iEthQty;
                $DaoOrderSmart->vWalletId = $vWallet;
    //            $DaoOrderSmart->vWalletId2 = '';
                $DaoOrderSmart->iCreateTime = $DaoOrderSmart->iUpdateTime = time();
                $DaoOrderSmart->bShow = 1;
                $DaoOrderSmart->save();
                $iTableId = ModOrderSmart::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
                //Logs
                $this->_saveLogAction( $DaoOrderSmart->getTable(), $iTableId, 'buyEth from '.$request->ip() , json_encode( $DaoOrderSmart , JSON_UNESCAPED_UNICODE ) );


                //紀錄-智能合約訂單購買人資訊-歸類為[系統類別]
                $sys_category_id = $this->getSysCategoryId('智能合約Order購買人', 'mod_order_buyer', 0);
                //
                $DaoOrderBuyer = new ModOrderBuyer();
                $DaoOrderBuyer->vOrderNum = $vOrderNum;
                $DaoOrderBuyer->vName = $vBuyName;
                $DaoOrderBuyer->vEmail = $vBuyEmail;
                $DaoOrderBuyer->vCountry = $vCountry;
                $DaoOrderBuyer->iNum = $sys_category_id;    //因為沒有iCategoryType的欄位，所以暫存這
                $DaoOrderBuyer->vCode = $lang;              //因為沒有語系的欄位，所以暫存這
                $DaoOrderBuyer->iCreateTime = $DaoOrderBuyer->iUpdateTime = time();
                $DaoOrderBuyer->bShow = 1;
                $DaoOrderBuyer->save();
                $iTableId = ModOrderBuyer::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
                //Logs
                $this->_saveLogAction( $DaoOrderBuyer->getTable(), $iTableId, 'buyEth from '.$request->ip() , json_encode( $DaoOrderBuyer , JSON_UNESCAPED_UNICODE ) );


                $this->view->with('form_url', $form_action );
                $this->view->with('_POST', $_POST );

                //建翰需求，建立暫存預設值
                setcookie('order_num', $vOrderNum, time()+1800);
                setcookie('lang', $lang, time()+1800);

            }catch (\Exception $e){
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = "buy eth error: \r\n<br>: ".$e->getMessage();
                return response()->json( $this->rtndata );
            }  
        }
        else
        {
            //**********************************************
            // E T H 購 買 : 儲 存 對 方 回 應
            //**********************************************
            /*
             * 是對方智能合約回傳給我...
             */

            try{
                $status="";
                if ($_POST['kahap_status']==1)
                    $status="此交易易等待區塊鏈驗證中 Pending";
                else if ($_POST['kahap_status']==2)
                    $status="此交易易區塊鏈驗證成功 Success";
                else if ($_POST['kahap_status']==3)
                    $status="此交易易區塊鏈驗證失敗 Fail";
                else if ($_POST['kahap_status']==11)
                    $status="未安裝MetaMask";
                else if ($_POST['kahap_status']==12)
                    $status="未登入MetaMask";
                else if ($_POST['kahap_status']==13)
                    $status="使用者取消MetaMask轉帳";
                else if ($_POST['kahap_status']==14)
                    $status="ETH餘額不足";
                else if ($_POST['kahap_status']==15)
                    $status="使用者錢包地址不符";
                else if ($_POST['kahap_status']==16)
                    $status="KAHAP的HASHKEY有誤";
                else if ($_POST['kahap_status']==17)
                    $status="連結的固定IP有誤";
                else if ($_POST['kahap_status']==18)
                    $status="必須要manager錢包才能操作";
                else if ($_POST['kahap_status']==99)
                    $status="其它錯誤";

                $txhash="";
                if (isset($_POST['kahap_txhash']))
                    $txhash=$_POST['kahap_txhash'];

                $tradeid=isset($_COOKIE['order_num'])? $_COOKIE['order_num'] : '';     //預設值
                if (isset($_POST['kahap_tradeid']))
                    $tradeid=$_POST['kahap_tradeid'];


                    //拼裝所有的$_POST成字串
                    $req='';
                    foreach ($_POST as $key => $value) {
                        $value = urlencode(stripslashes($value));
                        $req .= "$key=$value&";
                    }

                    $map['vOrderNum'] = $tradeid;
                    $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
                    if ($DaoOrderSmart){
                        /********************************
                         * 有接收到對方回傳的trace_id...
                         ********************************/
                        $DaoOrderSmart->vTradeId = $tradeid;
                        $DaoOrderSmart->vStatus = $_POST['kahap_status'].':'.$status;
                        $DaoOrderSmart->vTxhash = $txhash;
                        $DaoOrderSmart->iUpdateTime = time();
                        $DaoOrderSmart->save();

                        if ($_POST['kahap_status']==1) {    //success
                            $url = $this->url_success;
                        }else{
                            $url = $this->url_error;
                        }
                        $url .= '?'.$req;
                        $url .= 'order_num='.$map['vOrderNum'];
                    }else{

                        /********************************
                         * 對方沒有回傳trace_id...
                         ********************************/
                        $map['vOrderNum'] = $tradeid;
                        $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
                        if ($DaoOrderSmart) {
                            $DaoOrderSmart->vTradeId = '';
                            $DaoOrderSmart->vStatus = $_POST['kahap_status'].':'.$status;
                            $DaoOrderSmart->vTxhash = $txhash;
                            $DaoOrderSmart->iUpdateTime = time();
                            $DaoOrderSmart->save();
                        }

                        $url = $this->url_error;
                        $url .= '?'.$req;
                        $url .= 'order_num='.$map['vOrderNum'];
                    }


                //Logs  
                // $this->_saveLogAction( 'order+smart+buyer', $tradeid, 'api-order buyEth response from '.$request->ip(), json_encode( $_POST ) );

            }catch (\Exception $e){
                /********************************
                 * 寫資料庫有錯誤 例外處理
                 ********************************/
                $url = $this->url_error;
                $url .= '?'.$req;
                $url .= 'order_num=' . $tradeid;

                $this->view->with('_POST', $_POST );
                $this->view->with('url', $url );
                return $this->view;
            }

            $this->view->with('_POST', $_POST );
            $this->view->with('url', $url );
        }

        return $this->view;
    }

    //**********************************************
    // 餘 額 購 買
    //**********************************************
    public function buyVault(Request $request)
    {
        $form_action = $this->url_vault;
        $this->module = [ 'eric_web_buy_vault' ];
        $this->view = View()->make( '_api.' . implode( '.' , $this->module ) );

        if (!isset($_POST['kahap_status']))     //對方回傳給我會有status
        {
            try{
                /*
                 * 是前端傳給我,我要傳給對方智能合約...
                 */
                $lang = $request->exists('lang') ? htmlspecialchars($request->input('lang')) : "";

                //交易ID 交易時間 購買人姓名 購買人Email 購買點數 購買金額 電子錢包 國家 付款方式
                $vHashKey = $request->exists('kahap_hashkey') ? htmlspecialchars($request->input('kahap_hashkey')) : "";
                $vOrderNum = $request->exists('kahap_tradeid') ? htmlspecialchars($request->input('kahap_tradeid')) : "";
                $vWallet = $request->exists('kahap_walletid') ? htmlspecialchars($request->input('kahap_walletid')) : "";
                    $vCode = $request->exists('kahap_vcode') ? htmlspecialchars($request->input('kahap_vcode')) : "";
                $vAcode = $request->exists('kahap_acode') ? htmlspecialchars($request->input('kahap_acode')) : "";
                $iEthQty = $request->exists('kahap_ethqty') ? htmlspecialchars($request->input('kahap_ethqty')) : 0;

                $iMemberId = $request->exists('user_id') ? htmlspecialchars($request->input('user_id')) : 0;
                $vBuyName = $request->exists('buy_name') ? htmlspecialchars($request->input('buy_name')) : "";
                $vBuyEmail = $request->exists('buy_email') ? htmlspecialchars($request->input('buy_email')) : "";
                $iCount = $request->exists('buy_point') ? htmlspecialchars($request->input('buy_point')) : 0;
                $iMoneyTotal = $request->exists('buy_price') ? htmlspecialchars($request->input('buy_price')) : 0;
                $vCountry = $request->exists('country') ? htmlspecialchars($request->input('country')) : "";
                $vPaymentType = $request->exists('pay_type') ? htmlspecialchars($request->input('pay_type')) : '';
                $iMoneyTotalFlat = $request->exists('buy_price_flat') ? htmlspecialchars($request->input('buy_price_flat')) : 0;    //這裡放iMoneyTotal換算的法幣


                $DaoOrder = new ModOrder();
                $DaoOrder->vOrderNum = $vOrderNum;
                $DaoOrder->iMemberId = $iMemberId;
                $DaoOrder->iProductId = 1;          //預設第一個商品(算力點數)
                $DaoOrder->iCount = $iCount;        //點數
                $DaoOrder->iMoneyTotal = $iMoneyTotal;
                $DaoOrder->vPayId = '1';                      //預設第一個付款(還未定義)
                $DaoOrder->vPaymentType = $vPaymentType;    //單純放交易方式
                $DaoOrder->iShipmentId = 1;                 //預設第一個 (還未定義)
                $DaoOrder->iPromoFee = $iMoneyTotalFlat;                 //這裡放iMoneyTotal換算的法幣
                $DaoOrder->vWallet = $vWallet;              //錢包id
                $DaoOrder->iCreateTime = $DaoOrder->iUpdateTime = time();
                $DaoOrder->iStatus = 1;
                $DaoOrder->save();
                $iTableId = ModOrder::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
                //Logs 1
                $this->_saveLogAction( $DaoOrder->getTable(), $iTableId, 'buyVault from '.$request->ip() , json_encode( $DaoOrder , JSON_UNESCAPED_UNICODE ) );


                //紀錄-智能合約訂單-歸類為[系統類別]
                $sys_category_id = $this->getSysCategoryId('智能合約Order', 'mod_order_smart',0);
                //
                $DaoOrderSmart = new ModOrderSmart();
                $DaoOrderSmart->iCategoryType = $sys_category_id;     //系統類別id
                $DaoOrderSmart->iType = $this->getSysCategoryId('餘額購買', 'mod_order_smart', $sys_category_id);
                $DaoOrderSmart->vUrl = $form_action;        //呼叫 api 的位置
                $DaoOrderSmart->vOrderNum = $vOrderNum;
    //            //$DaoOrderSmart->iTradeId = '';
                $DaoOrderSmart->vHashKey = $vHashKey;
                $DaoOrderSmart->vCode = $vCode;
                $DaoOrderSmart->vAcode = $vAcode;
                $DaoOrderSmart->iEthQty = $iEthQty;
                $DaoOrderSmart->vWalletId = $vWallet;
    //            $DaoOrderSmart->vWalletId2 = '';
                $DaoOrderSmart->iCreateTime = $DaoOrderSmart->iUpdateTime = time();
                $DaoOrderSmart->bShow = 1;
                $DaoOrderSmart->save();
                $iTableId = ModOrderSmart::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
                //Logs 2
                $this->_saveLogAction( $DaoOrderSmart->getTable(), $iTableId, 'buyVault from '.$request->ip() , json_encode( $DaoOrderSmart , JSON_UNESCAPED_UNICODE ) );


                //紀錄-智能合約訂單購買人資訊-歸類為[系統類別]
                $sys_category_id = $this->getSysCategoryId('智能合約Order購買人', 'mod_order_buyer', 0);
                //
                $DaoOrderBuyer = new ModOrderBuyer();
                $DaoOrderBuyer->vOrderNum = $vOrderNum;
                $DaoOrderBuyer->vName = $vBuyName;
                $DaoOrderBuyer->vEmail = $vBuyEmail;
                $DaoOrderBuyer->vCountry = $vCountry;
                $DaoOrderBuyer->iNum = $sys_category_id;    //因為沒有iCategoryType的欄位，所以暫存這
                $DaoOrderBuyer->vCode = $lang;              //因為沒有語系的欄位，所以暫存這
                $DaoOrderBuyer->iCreateTime = $DaoOrderBuyer->iUpdateTime = time();
                $DaoOrderBuyer->bShow = 1;
                $DaoOrderBuyer->save();
                $iTableId = ModOrderBuyer::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
                //Logs 3
                $this->_saveLogAction( $DaoOrderBuyer->getTable(), $iTableId, 'buyVault from '.$request->ip() , json_encode( $DaoOrderBuyer , JSON_UNESCAPED_UNICODE ) );

                $this->view->with('form_url', $form_action );
                $this->view->with('_POST', $_POST );

                //建翰需求
                setcookie('order_num', $vOrderNum, time()+1800);
                setcookie('lang', $lang, time()+1800);


            }catch (\Exception $e){
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = "buy value error: \r\n<br>: ".$e->getMessage();
                return response()->json( $this->rtndata );
            }   
        }
        else
        {
            //**********************************************
            // E T H 購 買 : 儲 存 對 方 回 應
            //**********************************************
            /*
             * 是對方智能合約回傳給我...
             */

            try{
                $status="";
                if ($_POST['kahap_status']){
                    if ($_POST['kahap_status']==1)
                        $status="此交易易等待區塊鏈驗證中 Pending";
                    else if ($_POST['kahap_status']==2)
                        $status="此交易易區塊鏈驗證成功 Success";
                    else if ($_POST['kahap_status']==3)
                        $status="此交易易區塊鏈驗證失敗 Fail";
                    else if ($_POST['kahap_status']==11)
                        $status="未安裝MetaMask";
                    else if ($_POST['kahap_status']==12)
                        $status="未登入MetaMask";
                    else if ($_POST['kahap_status']==13)
                        $status="使用者取消MetaMask轉帳";
                    else if ($_POST['kahap_status']==14)
                        $status="ETH餘額不足";
                    else if ($_POST['kahap_status']==15)
                        $status="使用者錢包地址不符";
                    else if ($_POST['kahap_status']==16)
                        $status="KAHAP的HASHKEY有誤";
                    else if ($_POST['kahap_status']==17)
                        $status="連結的固定IP有誤";
                    else if ($_POST['kahap_status']==18)
                        $status="必須要manager錢包才能操作";
                    else if ($_POST['kahap_status']==99)
                        $status="其它錯誤";
                }

                $txhash="";
                if (isset($_POST['kahap_txhash']))
                    $txhash=$_POST['kahap_txhash'];

                $tradeid=isset($_COOKIE['order_num'])? $_COOKIE['order_num'] : '';     //預設值
                if (isset($_POST['kahap_tradeid']))
                    $tradeid=$_POST['kahap_tradeid'];


                //拼裝所有的$_POST成字串
                $req='';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $req .= "$key=$value&";
                }

                $map['vOrderNum'] = $tradeid;
                $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
                if ($DaoOrderSmart){
                    /********************************
                     * 有接收到對方回傳的trace_id...
                     ********************************/
                    $DaoOrderSmart->vTradeId = $tradeid;
                    $DaoOrderSmart->vStatus = $_POST['kahap_status'].':'.$status;
                    $DaoOrderSmart->vTxhash = $txhash;
                    $DaoOrderSmart->iUpdateTime = time();
                    $DaoOrderSmart->save();

                    if ($_POST['kahap_status']==1) {    //success
                        $url = $this->url_success;
                    }else{
                        $url = $this->url_error;
                    }
                    $url .= '?'.$req;
                    $url .= 'order_num='.$map['vOrderNum'];
                }else{

                    /********************************
                     * 對方沒有回傳trace_id...
                     ********************************/
                    $map['vOrderNum'] = $tradeid;
                    $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
                    if ($DaoOrderSmart) {
                        $DaoOrderSmart->vTradeId = '';
                        $DaoOrderSmart->vStatus = $_POST['kahap_status'].':'.$status;
                        $DaoOrderSmart->vTxhash = $txhash;
                        $DaoOrderSmart->iUpdateTime = time();
                        $DaoOrderSmart->save();
                    }

                    $url = $this->url_error;
                    $url .= '?'.$req;
                    $url .= 'order_num='.$map['vOrderNum'];
                }

                //Logs  
                // $this->_saveLogAction( 'order+smart+buyer', $tradeid, 'api-order buyVault response from '.$request->ip(), json_encode( $_POST ) );

            }catch (\Exception $e){
                /********************************
                 * 寫資料庫有錯誤 例外處理
                 ********************************/
                // $url = $this->url_error;
                // $url .= '?'.$req;
                // $url .= 'order_num=' . $tradeid;

                // $this->view->with('_POST', $_POST );
                // $this->view->with('url', $url );
                
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = "buy address error: \r\n<br>: ".$e->getMessage();
            return response()->json( $this->rtndata );
                return $this->view;
            }

            $this->view->with('_POST', $_POST );
            $this->view->with('url', $url );
        }

        return $this->view;
    }

    //**********************************************
    // BUY_ADDRESS 購 買 1/2
    //**********************************************
    public function buyAddress(Request $request)
    {
        try{

            /*
             * 是前端傳給我,我要傳給對方智能合約...
             */
            $lang = $request->exists('lang') ? htmlspecialchars($request->input('lang')) : "";

            //交易ID 交易時間 購買人姓名 購買人Email 購買點數 購買金額 電子錢包 國家 付款方式
            $vHashKey = $request->exists('kahap_hashkey') ? htmlspecialchars($request->input('kahap_hashkey')) : "";
            $vOrderNum = $request->exists('kahap_tradeid') ? htmlspecialchars($request->input('kahap_tradeid')) : "";
            $vWallet = $request->exists('kahap_walletid') ? htmlspecialchars($request->input('kahap_walletid')) : "";
                $vCode = $request->exists('kahap_vcode') ? htmlspecialchars($request->input('kahap_vcode')) : "";
            $vAcode = $request->exists('kahap_acode') ? htmlspecialchars($request->input('kahap_acode')) : "";
                $iEthQty = $request->exists('kahap_ethqty') ? htmlspecialchars($request->input('kahap_ethqty')) : 0;

            $iMemberId = $request->exists('user_id') ? htmlspecialchars($request->input('user_id')) : 0;
            $vBuyName = $request->exists('buy_name') ? htmlspecialchars($request->input('buy_name')) : "";
            $vBuyEmail = $request->exists('buy_email') ? htmlspecialchars($request->input('buy_email')) : "";
            $iCount = $request->exists('buy_point') ? htmlspecialchars($request->input('buy_point')) : 0;       //token
            $iMoneyTotal = $request->exists('buy_price') ? htmlspecialchars($request->input('buy_price')) : 0;
            $vCountry = $request->exists('country') ? htmlspecialchars($request->input('country')) : "";
            $vPaymentType = $request->exists('pay_type') ? htmlspecialchars($request->input('pay_type')) : '';
            $iMoneyTotalFlat = $request->exists('buy_price_flat') ? htmlspecialchars($request->input('buy_price_flat')) : 0;    //這裡放iMoneyTotal換算的法幣


            $DaoOrder = new ModOrder();
            $DaoOrder->vOrderNum = $vOrderNum;
            $DaoOrder->iMemberId = $iMemberId;
            $DaoOrder->iProductId = 1;          //預設第一個商品(算力點數)
            $DaoOrder->iCount = $iCount;        //法幣
            $DaoOrder->iMoneyTotal = $iMoneyTotal;      //用ETH購買就沒有這個值
            $DaoOrder->vPayId = '1';                      //預設第一個付款(還未定義)
            $DaoOrder->vPaymentType = $vPaymentType;    //單純放交易方式
            $DaoOrder->iShipmentId = 1;                 //預設第一個 (還未定義)
            $DaoOrder->iPromoFee = $iMoneyTotalFlat;                 //這裡放iMoneyTotal換算的法幣
            $DaoOrder->vWallet = $vWallet;              //錢包id
            $DaoOrder->iCreateTime = $DaoOrder->iUpdateTime = time();
            $DaoOrder->iStatus = 1;
            $DaoOrder->save();
            $iTableId = ModOrder::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
            //Logs 1
            $this->_saveLogAction( $DaoOrder->getTable(), $iTableId, 'buyAddress from '.$request->ip() , json_encode( $DaoOrder , JSON_UNESCAPED_UNICODE ) );


            //紀錄-智能合約訂單-歸類為[系統類別]
            $sys_category_id = $this->getSysCategoryId('智能合約Order', 'mod_order_smart',0);
            //
            $DaoOrderSmart = new ModOrderSmart();
            $DaoOrderSmart->iCategoryType = $sys_category_id;     //系統類別id
            $DaoOrderSmart->iType = $this->getSysCategoryId('法幣購買 address', 'mod_order_smart', $sys_category_id);
            $DaoOrderSmart->vUrl = $this->url_address;        //呼叫 api 的位置
            $DaoOrderSmart->vOrderNum = $vOrderNum;
//            //$DaoOrderSmart->iTradeId = '';
            $DaoOrderSmart->vHashKey = $vHashKey;
            $DaoOrderSmart->vCode = $vCode;
            $DaoOrderSmart->vAcode = $vAcode;
            $DaoOrderSmart->iEthQty = $iEthQty;
            $DaoOrderSmart->vWalletId = $vWallet;
            $DaoOrderSmart->vWalletId2 = $this->manager_wallet_id;        //管理理者錢包地址
            $DaoOrderSmart->iCreateTime = $DaoOrderSmart->iUpdateTime = time();
            $DaoOrderSmart->bShow = 1;
            $DaoOrderSmart->save();
            $iTableId = ModOrderSmart::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
            //Log 2
            $this->_saveLogAction( $DaoOrderSmart->getTable(), $iTableId, 'buyAddress from '.$request->ip() , json_encode( $DaoOrderSmart , JSON_UNESCAPED_UNICODE ) );


            //紀錄-智能合約訂單購買人資訊-歸類為[系統類別]
            $sys_category_id = $this->getSysCategoryId('智能合約Order購買人', 'mod_order_buyer', 0);
            //
            $DaoOrderBuyer = new ModOrderBuyer();
            $DaoOrderBuyer->vOrderNum = $vOrderNum;
            $DaoOrderBuyer->vName = $vBuyName;
            $DaoOrderBuyer->vEmail = $vBuyEmail;
            $DaoOrderBuyer->vCountry = $vCountry;
            $DaoOrderBuyer->iNum = $sys_category_id;        //因為沒有iCategoryType的欄位，所以暫存這
            $DaoOrderBuyer->vCode = $lang;        //因為沒有語系的欄位，所以暫存這
            $DaoOrderBuyer->iCreateTime = $DaoOrderBuyer->iUpdateTime = time();
            $DaoOrderBuyer->bShow = 1;
            $DaoOrderBuyer->save();
            $iTableId = ModOrderBuyer::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
            //Log 2            
            $this->_saveLogAction( $DaoOrderBuyer->getTable(), $iTableId, 'buyAddress from '.$request->ip() , json_encode( $DaoOrderBuyer , JSON_UNESCAPED_UNICODE ) );


        }catch (\Exception $e){
            $this->rtndata ['status'] = 0;
            $this->rtndata ['message'] = "buy address error: \r\n<br>: ".$e->getMessage();
            return response()->json( $this->rtndata );
        }


        $this->rtndata ['status'] = 1;
        $this->rtndata ['message'] = "buy address success: \r\n<br>";
        $this->rtndata ['data'] = $DaoOrderSmart->vOrderNum;
        return response()->json( $this->rtndata );

    }

    //**********************************************
    // BUY_ADDRESS 購 買 2/2 (本來串智能合約功能要做在這，現在搬到後台去實現..)
    //**********************************************
    public function buyAddress2(Request $request)
    {

        /*** 這邊前端只需要存資料，先不用呼叫對方API ***/
        $form_action = $this->url_address;
        $this->module = [ 'eric_web_buy_address' ];
        $this->view = View()->make( '_api.' . implode( '.' , $this->module ) );

        if (!isset($_POST['kahap_status']))     //對方回傳給我會有status
        {
            try{

                $id = ( $request->exists( 'iId' ) ) ? $request->input( 'iId' ) : 0;

                $Dao = ModOrder::query()->where('iId','=',$id)->first();
                $map['vOrderNum'] = $Dao->vOrderNum;
                $DaoSmart = ModOrderSmart::query()->where( $map )->first();
                $DaoBuyer = ModOrderBuyer::query()->where( $map )->first();

                $data_arr = array();
                $data_arr['kahap_hashkey'] = $DaoSmart->vHashKey;
                $data_arr['kahap_tradeid'] = $DaoSmart->vOrderNum;
                $data_arr['kahap_addr'] = $DaoSmart->vWalletId;
                $data_arr['kahap_acode'] = $DaoSmart->vAcode;
                $data_arr['kahap_token'] = $Dao->iCount ? $Dao->iCount*1000 : 0;     //Token數量量，以千為單位
                $data_arr['kahap_walletid'] = $DaoSmart->vWalletId2;

                $this->view->with('form_url', $form_action );
                $this->view->with('form_value', $data_arr );

                //建翰需求，建立暫存預設值
                setcookie('order_num', $DaoSmart->vOrderNum, time()+1800);
                setcookie('lang', $DaoBuyer->vCode, time()+1800);

            }catch (\Exception $e){
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = "buy address error: \r\n<br>: ".$e->getMessage();
                return response()->json( $this->rtndata );
            }

            return $this->view;

        }
        else
        {
            //**********************************************
            // E T H 購 買 : 儲 存 對 方 回 應
            //**********************************************
            /*
             * 是對方智能合約回傳給我...
             */
            try{

                $status="";
                if ($_POST['kahap_status']) {
                    if ($_POST['kahap_status'] == 1)
                        $status = "此交易易等待區塊鏈驗證中 Pending";
                    else if ($_POST['kahap_status'] == 2)
                        $status = "此交易易區塊鏈驗證成功 Success";
                    else if ($_POST['kahap_status'] == 3)
                        $status = "此交易易區塊鏈驗證失敗 Fail";
                    else if ($_POST['kahap_status'] == 11)
                        $status = "未安裝MetaMask";
                    else if ($_POST['kahap_status'] == 12)
                        $status = "未登入MetaMask";
                    else if ($_POST['kahap_status'] == 13)
                        $status = "使用者取消MetaMask轉帳";
                    else if ($_POST['kahap_status'] == 14)
                        $status = "ETH餘額不足";
                    else if ($_POST['kahap_status'] == 15)
                        $status = "使用者錢包地址不符";
                    else if ($_POST['kahap_status'] == 16)
                        $status = "KAHAP的HASHKEY有誤";
                    else if ($_POST['kahap_status'] == 17)
                        $status = "連結的固定IP有誤";
                    else if ($_POST['kahap_status'] == 18)
                        $status = "必須要manager錢包才能操作";
                    else if ($_POST['kahap_status'] == 99)
                        $status = "其它錯誤";
                }

                $txhash="";
                if (isset($_POST['kahap_txhash']))
                    $txhash=$_POST['kahap_txhash'];

                $tradeid=isset($_COOKIE['order_num'])? $_COOKIE['order_num'] : '';     //預設值
                if (isset($_POST['kahap_tradeid']))
                    $tradeid=$_POST['kahap_tradeid'];


                //
                $map['vOrderNum'] = $tradeid;
                $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
                if ($DaoOrderSmart){
                    /********************************
                     * 有接收到對方回傳的trace_id...
                     ********************************/
                    $DaoOrderSmart->vTradeId = $tradeid;
                    $DaoOrderSmart->vStatus = $_POST['kahap_status'].':'.$status;
                    $DaoOrderSmart->vTxhash = $txhash;
                    $DaoOrderSmart->iUpdateTime = time();
                    $DaoOrderSmart->save();
                }else{
                    /********************************
                     * 對方沒有回傳trace_id...
                     ********************************/
                    $map['vOrderNum'] = $tradeid;
                    $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
                    if ($DaoOrderSmart) {
                        $DaoOrderSmart->vTradeId = '';
                        $DaoOrderSmart->vStatus = $_POST['kahap_status'].':'.$status;
                        $DaoOrderSmart->vTxhash = $txhash;
                        $DaoOrderSmart->iUpdateTime = time();
                        $DaoOrderSmart->save();
                    }
                }

                //Logs
                //$this->_saveLogAction( 'order+smart+buyer', $tradeid, 'api-order buyAddress response from '.$request->ip(), json_encode( $_POST ) );

            }catch (\Exception $e){
                /********************************
                 * 寫資料庫有錯誤 例外處理
                 ********************************/
                $this->rtndata['status'] = 0;
                $this->rtndata['message'] = $e->getMessage();
                return response()->json( $this->rtndata );
            }

            $this->rtndata['status'] = 1;
            $this->rtndata['message'] = '購買成功';
            return response()->json( $this->rtndata );
        }

    }

    //**********************************************
    //
    // BUY_ADDRESS ( 綠 界 金 流 )
    //
    //**********************************************
    public function buyECPay(Request $request)
    {
        try{

            $this->module = [ 'ecpay', 'sample' ];
            $this->view = View()->make( '_pay.' . implode( '.' , $this->module )  );

            /*
             * 是前端傳給我,我要傳給對方智能合約...
             */
            $lang = $request->exists('lang') ? htmlspecialchars($request->input('lang')) : "";

            //交易ID 交易時間 購買人姓名 購買人Email 購買點數 購買金額 電子錢包 國家 付款方式
            $vHashKey = $request->exists('kahap_hashkey') ? htmlspecialchars($request->input('kahap_hashkey')) : "";
            $vOrderNum = $request->exists('kahap_tradeid') ? htmlspecialchars($request->input('kahap_tradeid')) : "";
            $vWallet = $request->exists('kahap_walletid') ? htmlspecialchars($request->input('kahap_walletid')) : "";
                $vCode = $request->exists('kahap_vcode') ? htmlspecialchars($request->input('kahap_vcode')) : "";
            $vAcode = $request->exists('kahap_acode') ? htmlspecialchars($request->input('kahap_acode')) : "";
                $iEthQty = $request->exists('kahap_ethqty') ? htmlspecialchars($request->input('kahap_ethqty')) : 0;

            $iMemberId = $request->exists('user_id') ? htmlspecialchars($request->input('user_id')) : 0;
            $vBuyName = $request->exists('buy_name') ? htmlspecialchars($request->input('buy_name')) : "";
            $vBuyEmail = $request->exists('buy_email') ? htmlspecialchars($request->input('buy_email')) : "";
            $iCount = $request->exists('buy_point') ? htmlspecialchars($request->input('buy_point')) : 0;       //token
            $iMoneyTotal = $request->exists('buy_price_tw') ? htmlspecialchars($request->input('buy_price_tw')) : 0;
            $vCountry = $request->exists('country') ? htmlspecialchars($request->input('country')) : "";
            $vPaymentType = $request->exists('pay_type') ? htmlspecialchars($request->input('pay_type')) : '';
            $iPrice = $request->exists('buy_price_tw') ? htmlspecialchars($request->input('buy_price_tw')) : 0;  //台幣(綠界)


            $DaoOrder = new ModOrder();
            $DaoOrder->vOrderNum = $vOrderNum;
            $DaoOrder->iMemberId = $iMemberId;
            $DaoOrder->iProductId = 1;              //預設第一個商品(算力點數)
            $DaoOrder->iPrice = $iPrice;            //台幣(綠界)
            $DaoOrder->iCount = $iCount;            //法幣
            $DaoOrder->iMoneyTotal = $iMoneyTotal;      //用ETH購買就沒有這個值
            $DaoOrder->vPayId = '1';                      //預設第一個付款(若綠界放綠界交易編號)
            $DaoOrder->vPaymentType = $vPaymentType;    //單純放交易方式(前端給)
            $DaoOrder->iShipmentId = 1;                 //預設第一個 (還未定義)
            $DaoOrder->vWallet = $vWallet;              //錢包id
            $DaoOrder->iCreateTime = $DaoOrder->iUpdateTime = time();
            $DaoOrder->iStatus = 99;     // 之後綠界支付回傳的 RtnCode
            $DaoOrder->save();
            $iTableId = ModOrder::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
            //Logs 1
            $this->_saveLogAction( $DaoOrder->getTable(), $iTableId, 'buyECPay from '.$request->ip() , json_encode( $DaoOrder , JSON_UNESCAPED_UNICODE ) );          


            //紀錄-智能合約訂單-歸類為[系統類別]
            $sys_category_id = $this->getSysCategoryId('智能合約Order', 'mod_order_smart',0);
            //
            $DaoOrderSmart = new ModOrderSmart();
            $DaoOrderSmart->iCategoryType = $sys_category_id;     //系統類別id
            $DaoOrderSmart->iType = $this->getSysCategoryId('法幣購買 address', 'mod_order_smart', $sys_category_id);
            $DaoOrderSmart->vUrl = $this->url_ecpay_api;        //呼叫 api 的位置
            $DaoOrderSmart->vOrderNum = $vOrderNum;
//            //$DaoOrderSmart->iTradeId = '';
            $DaoOrderSmart->vHashKey = $vHashKey;
            $DaoOrderSmart->vCode = $vCode;
            $DaoOrderSmart->vAcode = $vAcode;
            $DaoOrderSmart->iEthQty = $iEthQty;
            $DaoOrderSmart->vWalletId = $vWallet;
            $DaoOrderSmart->vWalletId2 = $this->manager_wallet_id;        //管理理者錢包地址
            $DaoOrderSmart->iCreateTime = $DaoOrderSmart->iUpdateTime = time();
            $DaoOrderSmart->bShow = 1;
            $DaoOrderSmart->save();
            $iTableId = ModOrderSmart::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
            //Log 2   
            $this->_saveLogAction( $DaoOrderSmart->getTable(), $iTableId, 'buyECPay from '.$request->ip() , json_encode( $DaoOrderSmart , JSON_UNESCAPED_UNICODE ) );            


            //紀錄-智能合約訂單購買人資訊-歸類為[系統類別]
            $sys_category_id = $this->getSysCategoryId('智能合約Order購買人', 'mod_order_buyer', 0);
            //
            $DaoOrderBuyer = new ModOrderBuyer();
            $DaoOrderBuyer->vOrderNum = $vOrderNum;
            $DaoOrderBuyer->vName = $vBuyName;
            $DaoOrderBuyer->vEmail = $vBuyEmail;
            $DaoOrderBuyer->vCountry = $vCountry;
            $DaoOrderBuyer->iNum = $sys_category_id;        //因為沒有iCategoryType的欄位，所以暫存這
            $DaoOrderBuyer->vCode = $lang;        //因為沒有語系的欄位，所以暫存這
            $DaoOrderBuyer->iCreateTime = $DaoOrderBuyer->iUpdateTime = time();
            $DaoOrderBuyer->bShow = 1;
            $DaoOrderBuyer->save();
            $iTableId = ModOrderBuyer::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
            //Log 3   
            $this->_saveLogAction( $DaoOrderBuyer->getTable(), $iTableId, 'buyECPay from '.$request->ip() , json_encode( $DaoOrderBuyer , JSON_UNESCAPED_UNICODE ) );      


            $params = array(
                'ServiceURL'    =>  $this->url_ecpay_api,    //服務位置
                'HashKey'       =>  env( 'ECPAY_HashKey' ),      //用Hashkey，請自行帶入ECPay提供的HashKey
                'HashIV'        =>  env( 'ECPAY_HashIV' ),      //測試用HashIV，請自行帶入ECPay提供的HashIV
                'MerchantID'    =>  env( 'ECPAY_MerchantID' ),              //測試用MerchantID，請自行帶入ECPay提供的MerchantID
                'EncryptType'   =>  env( 'ECPAY_EncryptType' ),                  //CheckMacValue加密類型，請固定填入1，使用SHA256加密
                'ReturnURL'         =>  url('api/order/buy_ecpay_feedback'),     //付款完成通知回傳網址
                'OrderResultURL'    =>  url('api/order/buy_ecpay_receive'),     //Client端回傳付款結果網址
                'MerchantTradeNo'   =>  $vOrderNum,                                     //訂單編號
                'MerchantTradeDate' =>  date('Y/m/d H:i:s', time() ),         //交易時間
                'TotalAmount'       =>  (int)$iMoneyTotal,                           //交易金額 新台幣
                'TradeDesc'         =>  "算力點數",                                 //交易描述
                'Items' => array(
                                'Name' => "算力點數",               //算利點數__點
                                'Price' => ($iMoneyTotal && $iCount)? (int)($iMoneyTotal/$iCount) : 0,      //總金額。 綠界部分以一點500新台幣為主
                                'Currency' => "元",              //只收新台幣
                                'Quantity' => (int)$iCount ,   // 1
                                ),
                'lang'  =>  $lang,
            );
           // dd($params);

            //訂單支付記錄
            $DaoPayServiceOrderLog = new ModPayServiceOrderLog();
            $DaoPayServiceOrderLog->vPayService = $this->vPayService;
            $DaoPayServiceOrderLog->vOrderNum = $vOrderNum;
            $DaoPayServiceOrderLog->vValue = json_encode( $params, JSON_UNESCAPED_UNICODE );
            $DaoPayServiceOrderLog->iCreateTime = time();
            $DaoPayServiceOrderLog->save();

            $this->view->with('params', $params );
//             $this->view->with('form_url', $form_action );
//             $this->view->with('_POST', $_POST );

            //建翰需求，建立暫存預設值
             setcookie('order_num', $vOrderNum, time()+1800);
             setcookie('lang', $lang, time()+1800);

            

        }catch (\Exception $e){
            $form_action = $this->url_error.'?status=0&message='.$e->getMessage();
            $this->module = [ 'ecpay', 'error' ];
            $this->view = View()->make( '_pay.' . implode( '.' , $this->module )  );
            $this->view->with('form_url', $form_action );
            $this->view->with('url', $this->url_error );
            return $this->view;
        }

        return $this->view;
    }

    //**********************************************
    // BUY_ADDRESS ( 綠 界 金 流 feedback )
    //**********************************************
    public function buyECPayFeedback(Request $request)
    {
        // pay service trade log 1
        $DaoPayServiceTrade = new ModPayServiceTrade();
        $DaoPayServiceTrade->vPayService = $this->vPayService;
        $DaoPayServiceTrade->vTradeType = "feedback";
        $DaoPayServiceTrade->vOrderNum = $request->input('TradeNo' , 0 );
        $DaoPayServiceTrade->vPaymentType = $this->vPaymentType . "_Feedback";
        $DaoPayServiceTrade->vMessage = "success";
        $DaoPayServiceTrade->vResult =  json_encode($request->all(), JSON_UNESCAPED_UNICODE);
        $DaoPayServiceTrade->iCreateTime = time();
        $DaoPayServiceTrade->save();

        return 'ok';
    }

    //**********************************************
    // 
    // BUY_ADDRESS ( 綠 界 金 流 receive )
    //
    //**********************************************
    public function buyECPayReceive(Request $request)
    {
        try{
            // pay service trade log 2
            $DaoPayServiceTrade = new ModPayServiceTrade();
            $DaoPayServiceTrade->vPayService = $this->vPayService;
            $DaoPayServiceTrade->vTradeType = "pay";
            $DaoPayServiceTrade->vOrderNum = $request->input('TradeNo' , 0 );
            $DaoPayServiceTrade->vPaymentType = $this->vPaymentType . "_Receive";
            $DaoPayServiceTrade->vMessage = "success";
            $DaoPayServiceTrade->vResult =  json_encode($request->all(), JSON_UNESCAPED_UNICODE);
            $DaoPayServiceTrade->iCreateTime = time();
            $DaoPayServiceTrade->save();


            //要寫進資料庫的回傳值
            $params = [];
            $params ['RtnCode'] = $request->exists('RtnCode') ? ($request->input('RtnCode')) : "";     //交易狀態
            $params ['RtnMsg'] = $request->exists('RtnMsg') ? ($request->input('RtnMsg')) : "";        //交易訊息
            $params ['TradeNo'] = $request->exists('TradeNo') ? ($request->input('TradeNo')) : "";     //綠界的交易編號
            $params ['PaymentTypeChargeFee'] = $request->exists('PaymentTypeChargeFee') ? ($request->input('PaymentTypeChargeFee')) : "";   //通路費
            $params ['TradeDate'] = $request->exists('TradeDate') ? ($request->input('TradeDate')) : "";   //訂單成立時間
            $params ['SimulatePaid'] = $request->exists('SimulatePaid') ? ($request->input('SimulatePaid')) : "";   //是否為模擬付款
            $params ['CheckMacValue'] = $request->exists('CheckMacValue') ? ($request->input('CheckMacValue')) : "";   //是否為模擬付款
            $params ['MerchantTradeNo'] = $request->exists('MerchantTradeNo') ? ($request->input('MerchantTradeNo')) : 0;   //訂單編號


            $tradeid = isset($_COOKIE['order_num'])? $_COOKIE['order_num'] : '';     //訂單編號
            if ( $params['MerchantTradeNo'] ){
                $tradeid = $params['MerchantTradeNo'];
            }

            if ($params['RtnMsg']=="Succeeded" || $params ['RtnCode']=="1" ) {    //success


                $map['vOrderNum'] = $tradeid;
                $DaoOrder = ModOrder::query()->where($map)->first();
                if ($DaoOrder)
                {
                    $DaoOrder->iPayStatus = 1;                          // 支付完成
                    $DaoOrder->vPayId = $params ['TradeNo'];           //綠界的交易編號
                    $DaoOrder->iStatus = $params ['RtnCode'];        //交易狀態Int：若為１時代表成功，其餘為失敗
                    $DaoOrder->vStatus = $params ['RtnMsg'];       //交易訊息
                    $DaoOrder->iShipmentFee = (int)str_replace(' ', '', $params ['PaymentTypeChargeFee']);  //綠界交易手續費
                    $DaoOrder->iUpdateTime = strtotime($params ['TradeDate']);//time();
                    $DaoOrder->save();

                    // pay service trade log 3
                    $DaoPayServiceTrade = new ModPayServiceTrade();
                    $DaoPayServiceTrade->vPayService = $this->vPayService;
                    $DaoPayServiceTrade->vTradeType = "pay";
                    $DaoPayServiceTrade->vOrderNum = $DaoOrder->vOrderNum;
                    $DaoPayServiceTrade->vPaymentType = $DaoOrder->vPaymentType;
                    $DaoPayServiceTrade->vMessage = "success";
                    $DaoPayServiceTrade->vResult = json_encode($params, JSON_UNESCAPED_UNICODE);
                    $DaoPayServiceTrade->iCreateTime = time();
                    $DaoPayServiceTrade->save();


                    $url = $this->url_success;
                    $url .= '?status='.$params ['RtnCode'];
                    $url .= '&message='.$params ['RtnMsg'];
                    $url .= '&kahap_tradeid='.$tradeid;
                }

                $this->module = [ 'ecpay' , 'success' ];
                $this->view = View()->make( '_pay.' . implode( '.' , $this->module )  );
                $this->view->with( 'url', $url );
            }else{

                    // pay service trade log 3
                    $DaoPayServiceTrade = new ModPayServiceTrade();
                    $DaoPayServiceTrade->vPayService = $this->vPayService;
                    $DaoPayServiceTrade->vTradeType = "pay";
                    $DaoPayServiceTrade->vOrderNum = $tradeid;
                    $DaoPayServiceTrade->vPaymentType = $this->vPaymentType;
                    $DaoPayServiceTrade->vMessage = "fail";
                    $DaoPayServiceTrade->vResult = json_encode($params, JSON_UNESCAPED_UNICODE);
                    $DaoPayServiceTrade->iCreateTime = time();
                    $DaoPayServiceTrade->save();


                    $url = $this->url_error;
                    $url .= '?status='.$params ['RtnCode'];
                    $url .= '&message='.$params ['RtnMsg'];

                $this->module = [ 'ecpay', 'error' ];
                $this->view = View()->make( '_pay.' . implode( '.' , $this->module )  );
                $this->view->with( 'url', $url );
            }

            //Logs
            // $this->_saveLogAction( 'order+smart+buyer', $vOrderNum, 'api-order buyAddress request from '.$request->ip(), json_encode( $DaoOrderSmart ) );

        }catch (\Exception $e){
            $form_action = $this->url_error.'?status=0&message='.$e->getMessage();
            $this->module = [ 'ecpay', 'error' ];
            $this->view = View()->make( '_pay.' . implode( '.' , $this->module )  );
            $this->view->with('form_url', $form_action );
            $this->view->with('url', $this->url_error );
            //Logs
            $this->_saveLogAction( 'ModPayServiceTrade', 10010, 'buyECPayReceive from '.$request->ip() , json_encode( $request->all() , JSON_UNESCAPED_UNICODE ) );
            //
            return $this->view;
        }

        return $this->view;
    }

    //**********************************************
    // 帳 戶 提 領
    //**********************************************
    public function withdraw(Request $request)
    {

        $form_action = $this->url_withdraw;
        $this->module = [ 'eric_web_withdraw' ];
        $this->view = View()->make( '_api.' . implode( '.' , $this->module ) );

        if (!isset($_POST['kahap_status']))     //對方回傳給我會有status
        {

            try{   

                /*
                 * 是前端傳給我,我要傳給對方智能合約...
                 */
                $lang = $request->exists('lang') ? htmlspecialchars($request->input('lang')) : "";

                //交易ID 交易時間 購買人姓名 購買人Email 購買點數 購買金額 電子錢包 國家 付款方式
                $vHashKey = $request->exists('kahap_hashkey') ? htmlspecialchars($request->input('kahap_hashkey')) : "";
                $vOrderNum = $request->exists('kahap_tradeid') ? htmlspecialchars($request->input('kahap_tradeid')) : "";
                $vWallet = $request->exists('kahap_walletid') ? htmlspecialchars($request->input('kahap_walletid')) : "";
                    $vCode = $request->exists('kahap_vcode') ? htmlspecialchars($request->input('kahap_vcode')) : "";
                    $vAcode = $request->exists('kahap_acode') ? htmlspecialchars($request->input('kahap_acode')) : "";
                $iEthQty = $request->exists('kahap_ethqty') ? htmlspecialchars($request->input('kahap_ethqty')) : 0;   //withdraw餘額

                $iMemberId = $request->exists('user_id') ? htmlspecialchars($request->input('user_id')) : 0;
                $vBuyName = $request->exists('buy_name') ? htmlspecialchars($request->input('buy_name')) : "";
                $vBuyEmail = $request->exists('buy_email') ? htmlspecialchars($request->input('buy_email')) : "";
                $iCount = $request->exists('buy_point') ? htmlspecialchars($request->input('buy_point')) : 0;
                $iMoneyTotal = $request->exists('buy_price') ? htmlspecialchars($request->input('buy_price')) : 0;
                $vCountry = $request->exists('country') ? htmlspecialchars($request->input('country')) : "";
                $vPaymentType = $request->exists('pay_type') ? htmlspecialchars($request->input('pay_type')) : '';
                $iMoneyTotalFlat = $request->exists('buy_price_flat') ? htmlspecialchars($request->input('buy_price_flat')) : 0;    //這裡放iMoneyTotal換算的法幣


                $DaoOrder = new ModOrder();
                $DaoOrder->vOrderNum = $vOrderNum;
                $DaoOrder->iMemberId = $iMemberId;
                $DaoOrder->iProductId = 1;      //預設第一個商品(算力點數)
                $DaoOrder->iCount = $iCount;    //點數
                $DaoOrder->iMoneyTotal = $iMoneyTotal;
                $DaoOrder->vPayId = '1';      //預設第一個付款(還未定義)
                $DaoOrder->vPaymentType = $vPaymentType;    //單純放交易方式
                $DaoOrder->iShipmentId = 1;    //預設第一個 (還未定義)
                $DaoOrder->iPromoFee = $iMoneyTotalFlat;                 //這裡放iMoneyTotal換算的法幣
                $DaoOrder->vWallet = $vWallet;      //錢包id
                $DaoOrder->iCreateTime = $DaoOrder->iUpdateTime = time();
                $DaoOrder->iStatus = 1;
                $DaoOrder->save();
                $iTableId = ModOrder::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
                //Logs 1
                $this->_saveLogAction( $DaoOrder->getTable(), $iTableId, 'withdraw from '.$request->ip() , json_encode( $DaoOrder , JSON_UNESCAPED_UNICODE ) );


                //紀錄-智能合約訂單-歸類為[系統類別]
                $sys_category_id = $this->getSysCategoryId('智能合約Order', 'mod_order_smart',0);
                //
                $DaoOrderSmart = new ModOrderSmart();
                $DaoOrderSmart->iCategoryType = $sys_category_id;     //系統類別id
                $DaoOrderSmart->iType = $this->getSysCategoryId('Withdraw', 'mod_order_smart', $sys_category_id);
                $DaoOrderSmart->vUrl = $form_action;        //呼叫 api 的位置
                $DaoOrderSmart->vOrderNum = $vOrderNum;
    //            //$DaoOrderSmart->iTradeId = '';
                $DaoOrderSmart->vHashKey = $vHashKey;
                $DaoOrderSmart->vCode = $vCode;
                $DaoOrderSmart->vAcode = $vAcode;
                $DaoOrderSmart->iEthQty = $iEthQty;
                $DaoOrderSmart->vWalletId = $vWallet;
    //            $DaoOrderSmart->vWalletId2 = '';
                $DaoOrderSmart->iCreateTime = $DaoOrderSmart->iUpdateTime = time();
                $DaoOrderSmart->bShow = 1;
                $DaoOrderSmart->save();
                $iTableId = ModOrderSmart::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
                //Logs 2
                $this->_saveLogAction( $DaoOrderSmart->getTable(), $iTableId, 'withdraw from '.$request->ip() , json_encode( $DaoOrderSmart , JSON_UNESCAPED_UNICODE ) );


                //紀錄-智能合約訂單購買人資訊-歸類為[系統類別]
                $sys_category_id = $this->getSysCategoryId('智能合約Order購買人', 'mod_order_buyer', 0);
                //
                $DaoOrderBuyer = new ModOrderBuyer();
                $DaoOrderBuyer->vOrderNum = $vOrderNum;
                $DaoOrderBuyer->vName = $vBuyName;
                $DaoOrderBuyer->vEmail = $vBuyEmail;
                $DaoOrderBuyer->vCountry = $vCountry;
                $DaoOrderBuyer->iNum = $sys_category_id;        //因為沒有iCategoryType的欄位，所以暫存這
                $DaoOrderBuyer->vCode = $lang;        //因為沒有語系的欄位，所以暫存這
                $DaoOrderBuyer->iCreateTime = $DaoOrderBuyer->iUpdateTime = time();
                $DaoOrderBuyer->bShow = 1;
                $DaoOrderBuyer->save();
                $iTableId = ModOrderBuyer::query()->where('vOrderNum','=',$vOrderNum)->first() ->iId;
                //Logs 3
                $this->_saveLogAction( $DaoOrderBuyer->getTable(), $iTableId, 'withdraw from '.$request->ip() , json_encode( $DaoOrderBuyer , JSON_UNESCAPED_UNICODE ) );


                $this->view->with('form_url', $form_action );
                $this->view->with('_POST', $_POST );

                //建翰需求，建立暫存預設值
                setcookie('order_num', $vOrderNum, time()+1800);
                setcookie('lang', $lang, time()+1800);

                

            }catch (\Exception $e){
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = "buy withdraw error: \r\n<br>: ".$e->getMessage();
                return response()->json( $this->rtndata );
            }  


        }
        else
        {
            //**********************************************
            // E T H 購 買 : 儲 存 對 方 回 應
            //**********************************************
            /*
             * 是對方智能合約回傳給我...
             */

            try{
                $status="";
                if ($_POST['kahap_status']==1)
                    $status="此交易易等待區塊鏈驗證中 Pending";
                else if ($_POST['kahap_status']==2)
                    $status="此交易易區塊鏈驗證成功 Success";
                else if ($_POST['kahap_status']==3)
                    $status="此交易易區塊鏈驗證失敗 Fail";
                else if ($_POST['kahap_status']==11)
                    $status="未安裝MetaMask";
                else if ($_POST['kahap_status']==12)
                    $status="未登入MetaMask";
                else if ($_POST['kahap_status']==13)
                    $status="使用者取消MetaMask轉帳";
                else if ($_POST['kahap_status']==14)
                    $status="ETH餘額不足";
                else if ($_POST['kahap_status']==15)
                    $status="使用者錢包地址不符";
                else if ($_POST['kahap_status']==16)
                    $status="KAHAP的HASHKEY有誤";
                else if ($_POST['kahap_status']==17)
                    $status="連結的固定IP有誤";
                else if ($_POST['kahap_status']==18)
                    $status="必須要manager錢包才能操作";
                else if ($_POST['kahap_status']==99)
                    $status="其它錯誤";

                $txhash="";
                if (isset($_POST['kahap_txhash']))
                    $txhash=$_POST['kahap_txhash'];

                $tradeid=isset($_COOKIE['order_num'])? $_COOKIE['order_num'] : '';     //預設值
                if (isset($_POST['kahap_tradeid']))
                    $tradeid=$_POST['kahap_tradeid'];


                //拼裝所有的$_POST成字串
                $req='';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $req .= "$key=$value&";
                }

                $map['vOrderNum'] = $tradeid;
                $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
                if ($DaoOrderSmart){
                    /********************************
                     * trace_id有找到DB訂單...
                     ********************************/
                    $DaoOrderSmart->vTradeId = $tradeid;
                    $DaoOrderSmart->vStatus = $_POST['kahap_status'].':'.$status;
                    $DaoOrderSmart->vTxhash = $txhash;
                    $DaoOrderSmart->iUpdateTime = time();
                    $DaoOrderSmart->save();

                    if ($_POST['kahap_status']==1) {    //success
                        $url = $this->url_withdrawal_success;
                    }else{
                        $url = $this->url_error;
                    }
                    $url .= '?'.$req;
                    $url .= 'order_num='.$map['vOrderNum'];
                }else{
                    /********************************
                     * trace_id沒有找到DB訂單...
                     ********************************/
                    $map['vOrderNum'] = $tradeid;
                    $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
                    if ($DaoOrderSmart) {
                        $DaoOrderSmart->vTradeId = '';
                        $DaoOrderSmart->vStatus = $_POST['kahap_status'].':'.$status;
                        $DaoOrderSmart->vTxhash = $txhash;
                        $DaoOrderSmart->iUpdateTime = time();
                        $DaoOrderSmart->save();
                    }

                    $url = $this->url_error;
                    $url .= '?'.$req;
                    $url .= 'order_num='.$map['vOrderNum'];
                }

                //Logs  
                // $this->_saveLogAction( 'order+smart+buyer', $tradeid, 'api-order withdraw response from '.$request->ip(), json_encode( $_POST ) );

            }catch (\Exception $e){
                /********************************
                 * 寫資料庫有錯誤 例外處理
                 ********************************/
                $url = $this->url_error;
                $url .= '?'.$req;
                $url .= 'order_num=' . $tradeid;

                $this->view->with('_POST', $_POST );
                $this->view->with('url', $url );
                return $this->view;
            }

            $this->view->with('_POST', $_POST );
            $this->view->with('url', $url );
        }

        return $this->view;
    }


    //**********************************************
    // 查 詢 智 能 合 約 - GET ETH BALANCE
    //**********************************************
    public function getEth(Request $request)
    {         
        $form_action = $this->url_get_eth;
        $this->module = [ 'eric_web3_get_eth_balance' ];
        $this->view = View()->make( '_api.' . implode( '.' , $this->module ) );

        if (!isset($_POST['balance_eth'])&&!isset($_POST['kahap_status']))
        {
            try{  
                /*
                 * 是前端傳給我,我要傳給對方智能合約...
                 */
                $lang = $request->exists('lang') ? htmlspecialchars($request->input('lang')) : "";
                $iCount = $request->exists('buy_point') ? htmlspecialchars($request->input('buy_point')) : 0;       

                $this->view->with('form_url', $form_action );
                $this->view->with('_POST', $_POST );

                //建翰需求，建立暫存預設值
                setcookie('lang', $lang, time()+1800);
                setcookie('buy_point', $iCount, time()+1800);

            }catch (\Exception $e){
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = "buy address error: \r\n<br>: ".$e->getMessage();
                return response()->json( $this->rtndata );
            }  

        }
        else
        {

                //**********************************************
                // E T H 購 買 : 儲 存 對 方 回 應
                //**********************************************
                /*
                 * 是對方智能合約回傳給我...
                 */

            try{
                $status="";
                if (isset($_POST['kahap_status'])) {
                    if ($_POST['kahap_status']==1)
                        $status="此交易易等待區塊鏈驗證中 Pending";
                    else if ($_POST['kahap_status']==2)
                        $status="此交易易區塊鏈驗證成功 Success";
                    else if ($_POST['kahap_status']==3)
                        $status="此交易易區塊鏈驗證失敗 Fail";
                    else if ($_POST['kahap_status']==11)
                        $status="未安裝MetaMask";
                    else if ($_POST['kahap_status']==12)
                        $status="未登入MetaMask";
                    else if ($_POST['kahap_status']==13)
                        $status="使用者取消MetaMask轉帳";
                    else if ($_POST['kahap_status']==14)
                        $status="ETH餘額不足";
                    else if ($_POST['kahap_status']==15)
                        $status="使用者錢包地址不符";
                    else if ($_POST['kahap_status']==16)
                        $status="KAHAP的HASHKEY有誤";
                    else if ($_POST['kahap_status']==17)
                        $status="連結的固定IP有誤";
                    else if ($_POST['kahap_status']==18)
                        $status="必須要manager錢包才能操作";
                    else if ($_POST['kahap_status']==99)
                        $status="其它錯誤";
                }


                $balance="";
                if (isset($_POST['balance_eth']))
                    $balance=$_POST['balance_eth'];

                //拼裝所有的$_POST成字串
                $req='';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $req .= "$key=$value&";
                }

                // if ($_POST['kahap_status']==1) {    //success
                    $url = $this->url_get_success;
                // }else{
                //     $url = $this->url_error;
                // }
                $url .= '?'.$req;
                $url .= 'status='.$status;
                $url .= '&points='.$_COOKIE['buy_point'];

            }catch (\Exception $e){
                /********************************
                 * 寫資料庫有錯誤 例外處理
                 ********************************/
                $url = $this->url_error;
                $url .= '?'.$req;
                $url .= 'status='.$status;

                $this->view->with('_POST', $_POST );
                $this->view->with('url', $url );
                return $this->view;
            }

            $this->view->with('_POST', $_POST );
            $this->view->with('url', $url );
        }

        return $this->view;
    }

    //**********************************************
    // 查詢智能合約-GET TOKEN
    //**********************************************
    public function getToken(Request $request)
    {
        $form_action = $this->url_get_token;
        $this->module = [ 'eric_web3_get_token' ];
        $this->view = View()->make( '_api.' . implode( '.' , $this->module ) );


        if (!isset($_POST['kahap_token'])&&!isset($_POST['kahap_status'])) 
        {

            try{
                /*
                 * 是前端傳給我,我要傳給對方智能合約...
                 */
                $lang = $request->exists('lang') ? htmlspecialchars($request->input('lang')) : "";

                $this->view->with('form_url', $form_action );
                $this->view->with('_POST', $_POST );

                //建翰需求，建立暫存預設值
                setcookie('lang', $lang, time()+1800);

            }catch (\Exception $e){
                $this->rtndata ['status'] = 0;
                $this->rtndata ['message'] = "buy address error: \r\n<br>: ".$e->getMessage();
                return response()->json( $this->rtndata );
            }  
        }
        else
        {

                //**********************************************
                // E T H 購 買 : 儲 存 對 方 回 應
                //**********************************************
                /*
                 * 是對方智能合約回傳給我...
                 */

            try{
                $status="";
                if (isset($_POST['kahap_status'])) {
                    if ($_POST['kahap_status']==1)
                        $status="此交易易等待區塊鏈驗證中 Pending";
                    else if ($_POST['kahap_status']==2)
                        $status="此交易易區塊鏈驗證成功 Success";
                    else if ($_POST['kahap_status']==3)
                        $status="此交易易區塊鏈驗證失敗 Fail";
                    else if ($_POST['kahap_status']==11)
                        $status="未安裝MetaMask";
                    else if ($_POST['kahap_status']==12)
                        $status="未登入MetaMask";
                    else if ($_POST['kahap_status']==13)
                        $status="使用者取消MetaMask轉帳";
                    else if ($_POST['kahap_status']==14)
                        $status="ETH餘額不足";
                    else if ($_POST['kahap_status']==15)
                        $status="使用者錢包地址不符";
                    else if ($_POST['kahap_status']==16)
                        $status="KAHAP的HASHKEY有誤";
                    else if ($_POST['kahap_status']==17)
                        $status="連結的固定IP有誤";
                    else if ($_POST['kahap_status']==18)
                        $status="必須要manager錢包才能操作";
                    else if ($_POST['kahap_status']==99)
                        $status="其它錯誤";
                }

                $token="";
                if (isset($_POST['kahap_token']))
                    $token=$_POST['kahap_token'];

                //拼裝所有的$_POST成字串
                $req='';
                foreach ($_POST as $key => $value) {
                    $value = urlencode(stripslashes($value));
                    $req .= "$key=$value&";
                }

                // if ($_POST['kahap_status']==1) {    //success
                    $url = $this->url_success;
                // }else{
                //     $url = $this->url_error;
                // }
                $url .= '?'.$req;
                $url .= 'status='.$status;

            }catch (\Exception $e){
                /********************************
                 * 寫資料庫有錯誤 例外處理
                 ********************************/
                $url = $this->url_error;
                $url .= '?'.$req;
                $url .= 'status='.$status;

                $this->view->with('_POST', $_POST );
                $this->view->with('url', $url );
                return $this->view;
            }

            $this->view->with('_POST', $_POST );
            $this->view->with('url', $url );
        }

        return $this->view;
    }


    //**********************************************
    // 定 時 更 新 智 能 合 約 ( 對 方 呼 叫 )
    //**********************************************
    public function updateTxhash(Request $request)
    {
        try{
            //
            $vHashKey = $request->exists('kahap_hashkey') ? htmlspecialchars($request->input('kahap_hashkey')) : "";
            $vOrderNum = $request->exists('kahap_tradeid') ? htmlspecialchars($request->input('kahap_tradeid')) : "";
            $vTxhash = $request->exists('kahap_txhash') ? htmlspecialchars($request->input('kahap_txhash')) : "";
            $vTxhashTime = $request->exists('txhash_time') ? htmlspecialchars($request->input('txhash_time')) : "";
            $vTxhashCost = $request->exists('txhash_cost') ? htmlspecialchars($request->input('txhash_cost')) : "";
            $vStatus = $request->exists('kahap_status') ? htmlspecialchars($request->input('kahap_status')) : "";

            $status="";
            if ($_POST['kahap_status']==1)
                $status="此交易易等待區塊鏈驗證中 Pending";
            else if ($_POST['kahap_status']==2)
                $status="此交易易區塊鏈驗證成功 Success";
            else if ($_POST['kahap_status']==3)
                $status="此交易易區塊鏈驗證失敗 Fail";
            else if ($_POST['kahap_status']==11)
                $status="未安裝MetaMask";
            else if ($_POST['kahap_status']==12)
                $status="未登入MetaMask";
            else if ($_POST['kahap_status']==13)
                $status="使用者取消MetaMask轉帳";
            else if ($_POST['kahap_status']==14)
                $status="ETH餘額不足";
            else if ($_POST['kahap_status']==15)
                $status="使用者錢包地址不符";
            else if ($_POST['kahap_status']==16)
                $status="KAHAP的HASHKEY有誤";
            else if ($_POST['kahap_status']==17)
                $status="連結的固定IP有誤";
            else if ($_POST['kahap_status']==18)
                $status="必須要manager錢包才能操作";
            else if ($_POST['kahap_status']==99)
                $status="其它錯誤";

            $map['vOrderNum'] = $vOrderNum;
            $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
            if ($DaoOrderSmart){
                /********************************
                 * 有接收到對方回傳的trace_id...
                 ********************************/
                $DaoOrderSmart->vTradeId = $vOrderNum;
//                $DaoOrderSmart->vHashKey = $vHashKey;     //KAHAPACTUMALMINER
                $DaoOrderSmart->vTxhash = $vTxhash;     //交易易 Hash / 其它錯誤時的Error內容
                $DaoOrderSmart->vStatus = $_POST['kahap_status'].':'.$status;     //交易易狀狀態 (參參考「kahap_status 說明」)
                $DaoOrderSmart->iUpdateTime = $vTxhashTime;     //交易易上鏈時間 Unix time
                $DaoOrderSmart->save();

                $DaoOrder = ModOrder::query()->where($map)->first();
                if ($DaoOrder) {
                    $DaoOrder->iShipmentFee = $vTxhashCost;     //交易易⼿手續費
                    $DaoOrder->iUpdateTime = time();
                    $DaoOrder->save();
                }
            }


            //Logs      
            $this->_saveLogAction( $DaoOrderSmart->getTable(), $vOrderNum, 'api-order updateTxhash response from '.$request->ip(), json_encode( $_POST, JSON_UNESCAPED_UNICODE ) );

        }catch (\Exception $e){
            /********************************
             * 寫資料庫有錯誤或 例外處理
             ********************************/
            $this->rtndata['status'] = 0;
//            $this->rtndata['url'] = $url;
            $this->rtndata['message'] = $e->getCode().":\r\n".$e->getMessage()." \r\n tradeid:".$vOrderNum;
            return response()->json($this->rtndata);
        }

        $this->rtndata['status'] = 1;
//            $this->rtndata['url'] = $url;
        $this->rtndata['message'] = "Success:1 \r\n tradeid:".$vOrderNum;
        return response()->json($this->rtndata);
    }



    //**********************************************
    // 以下無入用，測試用...
    //**********************************************
    public function doAdd2(Request $request){

        //从 PayPal 出读取 POST 信息同时添加变量„cmd‟
        //         $req = 'cmd=_notify-validate';
        $req='';
        foreach ($_POST as $key => $value) {
            $value = urlencode(stripslashes($value));
            $req .= "$key=$value&";
        }

        $req.='kahap_hashkey=KAHAPACTUALMINER&';
        $req.='kahap_tradeid=testorder01&';
        $req.='kahap_walletid=0x565fd3B3E4b5E3174C9FD18d67053DFEeb332628&';
        $req.='kahap_vcode=56873887717172142175155942269461976853259567654642872852792958619230127889385&';
        $req.='kahap_acode=&';
        $req.='kahap_ethqty=0.4&';


        //建议在此将接受到的信息记录到日志文件中以确认是否收到 IPN 信息
        //将信息 POST 回给 PayPal 进行验证
        $header = "POST /kahap/am_buy_eth_post.php HTTP/1.1\r\n";
        $header .= "Content-Type:application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length:" . strlen($req) ."\r\n\r\n";
        //在 Sandbox 情况下，设置：
        //$fp = fsockopen(„www.sandbox.paypal.com‟,80,$errno,$errstr,30);
        $fp = fsockopen ('fine-i.com', 80, $errno, $errstr, 30);
        if (!$fp) {
            dd('1');
            //HTTP 错误
        } else {
            //将回复 POST 信息写入 SOCKET 端口
            //             fputs($fp, $header .$req);

            fputs($fp, "POST /kahap/am_buy_eth_post.php HTTP/1.1\r\n"); // 位址和參數寫在這，使用POST
            fputs($fp, "Host: fine-i.com\r\n"); //再寫一次host
            fputs($fp, "Content-Type: application/x-www-form-urlencoded\r\n");
            fputs($fp, "Content-Length: ".strlen($req)."\r\n");
            fputs($fp, "Connection: close\r\n");
            //             fputs($fp, "Referer: https://www.google.com.tw/?gws_rd=ssl\r\n"); //偽造 $_SERVER['HTTP_REFERER']
            //             fputs($fp, "Cookie: test=456;ai=789\r\n"); // 設定$_COOKIE
            fputs($fp, "\r\n");

            fputs($fp, $req);


            //开始接受 PayPal 对回复 POST 信息的认证信息
            while (!feof($fp)) {
                $res = fgets ($fp, 1024);
                echo $res."\r\n";
                //已经通过认证
                //                 if (strcmp ($res, "VERIFIED") == 0) {
                //                     //检查付款状态
                //                     //检查 txn_id 是否已经处理过
                //                     //检查 receiver_email 是否是您的 PayPal 账户中的 EMAIL 地址
                //                     //检查付款金额和货币单位是否正确
                //                     //处理这次付款，包括写数据库
                //                 }else if (strcmp ($res, "INVALID") == 0) {
                //                     //未通过认证，有可能是编码错误或非法的 POST 信息
                //                 }
            }
            fclose($fp);
        }

        return response()->json( $this->rtndata );
    }


    public function doSave(Request $request)
    {
        try{
            $vStatus = $request->exists('status') ? htmlspecialchars($request->input('status')) : "";
            $vTxhash = $request->exists('txhash') ? htmlspecialchars($request->input('txhash')) : "";
            $vOrderNum = $request->exists('tradeid') ? htmlspecialchars($request->input('tradeid')) : '';

            //拼裝所有的$_POST成字串
            $req='';
            foreach ($_POST as $key => $value) {
                $value = urlencode(stripslashes($value));
                $req .= "$key=$value&";
            }


            $map['vOrderNum'] = $vOrderNum;
            $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
            if ($DaoOrderSmart){
                /********************************
                 * 有接收到對方回傳的trace_id...
                 ********************************/
                //$DaoOrderSmart->iTradeId = $vOrderNum;
                $DaoOrderSmart->vStatus = $vStatus;
                $DaoOrderSmart->vTxhash = $vTxhash;
                $DaoOrderSmart->iUpdateTime = time();
                $DaoOrderSmart->save();

                $url = 'https://actualminer2.herokuapp.com/'.$_COOKIE['lang'].'account/points/completed';
                $url .= '?'.$req;
                $url .= 'order_num='.$map['vOrderNum'];
            }else{

                /********************************
                 * 對方沒有回傳trace_id...
                 ********************************/
                $map['vOrderNum'] = $_COOKIE['order_num'];
                $DaoOrderSmart = ModOrderSmart::query()->where($map)->first();
                if ($DaoOrderSmart) {
                    //$DaoOrderSmart->iTradeId = '';
                    $DaoOrderSmart->vStatus = $vStatus;
                    $DaoOrderSmart->vTxhash = $vTxhash;
                    $DaoOrderSmart->iUpdateTime = time();
                    $DaoOrderSmart->save();
                }

                $url = 'https://actualminer2.herokuapp.com/'.$_COOKIE['lang'].'account/points/error';
                $url .= '?'.$req;
                $url .= 'order_num='.$map['vOrderNum'];
                $this->rtndata['status'] = 0;
                $this->rtndata['url'] = $url;
                return response()->json($this->rtndata);
            }

        }catch (\Exception $e){
            /********************************
             * 寫資料庫有錯誤 例外處理
             ********************************/
            $url = 'https://actualminer2.herokuapp.com/'.$_COOKIE['lang'].'account/points/error';
            $url .= '?'.$req;
            $url .= 'order_num=' . (isset($_COOKIE['order_num'])? $_COOKIE['order_num'] : '');
            $this->rtndata['status'] = 0;
            $this->rtndata['url'] = $url;
//            $this->rtndata['message'] = $e->getCode().":\r\n".$e->getMessage();
            return response()->json($this->rtndata);
        }

        $this->rtndata['status'] = 1;
        $this->rtndata['url'] = $url;
        return response()->json($this->rtndata);





//        $req='';
//        foreach ($_POST as $key => $value) {
//            $value = urlencode(stripslashes($value));
//            $req .= "$key=$value&";
//        }
        //導回建翰網址

//        echo  header('Location: https://actualminer2.herokuapp.com/account/points/completed');
//        return $redir;
//
        $url = 'https://actualminer2.herokuapp.com/account/points/completed';
//        $url = 'http://www.google.com';
        $redir = redirect($url)
//            ->with('_token', csrf_token())
            ->header("Accept","text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8")
            ->header("Access-Control-Request-Method",'POST')
            ->header("Access-Control-Request-Headers",'X-PINGOTHER, Content-Type')
            ->header("Content-Type",'text/xml; charset=UTF-8')
            ->header("Access-Control-Allow-Origin",'*')
            ->header("Access-Control-Allow-Credentials","true")
            ->header("Access-Control-Allow-Methods","POST, GET, OPTIONS, DELETE, PUT, PATCH, DELETE")
            ->header("Access-Control-Allow-Headers","Content-Type, X-Auth-Token, Origin, Authorization")
            ->header("AMP-Access-Control-Allow-Source-Origin",$url)
            ->header("Access-Control-Expose-Headers","AMP-Access-Control-Allow-Source-Origin")
            ->header("Access-Control-Max-Age",'1728000')
            ->withInput($_POST)
                ;
        return $redir;
//        return response()->redirectTo('https://actualminer2.herokuapp.com/account/points/completed');

    }
}
