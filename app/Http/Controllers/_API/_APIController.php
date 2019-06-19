<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
//Logs
//$this->_saveLogAction( $Dao->getTable(), $Dao->iId, 'edit', json_encode( $Dao ) );
namespace App\Http\Controllers\_API;

use App\ModBlog;
use App\ModBlogCategory;
use App\ModNotices;
use App\ModOrder;
use App\ModOrderSmart;
use App\ModProduct;
use App\ModReservoirMeta;
use App\SysMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ModPress;
use App\Http\Controllers\_Web\_WebController;
use App\Http\Controllers\FuncController;


class _APIController extends _WebController
{

    /*********************************************************************
     *
     * -資訊回應區段-
     * 100 Continue : 此臨時回應表明，目前為止的一切完好，而用戶端應當繼續完成請求、或是在已完成請求的情況下，忽略此資訊。
     * 101 Switching Protocol : 此狀態碼乃為用戶端 Upgrade 請求標頭發送之回應、且表明伺服器亦切換中。
     * 102 Processing (WebDAV) : 此狀態碼表明伺服器收到並處理請求中，但目前未有回應。
     *
     * -成功回應-
     * 200 OK : 請求成功。成功的意義依照 HTTP 方法而定：
     *                       GET: 資源成功獲取並於 message body 內發送。
     *                       HEAD: entity 標頭已於 message body 內。
     *                       POST: 已傳送 message body 內的 resource describing the result of the action。
     *                       TRACE: 伺服器已接收到 message body 內含的請求訊息。
     * 201 Created : 請求成功且新的資源成功被創建，這通常用於 PUT 請求後的回應。
     * 202 Accepted : 伺服器已接受請求，但尚未處理。最終該請求可能會也可能不會被執行，並且可能在處理發生時被禁止。
     * 203 Non-Authoritative Information : 伺服器是一個轉換代理伺服器（transforming proxy，例如網路加速器），以200 OK狀態碼為起源，但回應了原始回應的修改版本。
     * 204 No Content : 伺服器成功處理了請求，沒有返回任何內容。
     * 205 Reset Content :伺服器成功處理了請求，但沒有返回任何內容。與204回應不同，此回應要求請求者重設文件視圖。
     * 206 Partial Content : 伺服器已經成功處理了部分GET請求。類似於FlashGet或者迅雷這類的HTTP 下載工具都是使用此類回應實現斷點續傳或者將一個大文件分解為多個下載段同時下載。
     * 207 Multi-Status (WebDAV) : 代表之後的訊息體將是一個XML訊息，並且可能依照之前子請求數量的不同，包含一系列獨立的回應程式碼。
     * 208 Multi-Status (WebDAV) : DAV繫結的成員已經在（多狀態）回應之前的部分被列舉，且未被再次包含。
     * 226 IM Used (HTTP Delta encoding) : 伺服器已經滿足了對資源的請求，對實體請求的一個或多個實體操作的結果表示。
     *
     * -重定向訊息-
     * 300 Multiple Choice : 請求擁有一個以上的回應。User-agent 或 user 應當從中選一。不過，並沒有標準的選擇方案。
     * 301 Moved Permanently : 此回應碼的意思是，請求資源的 URI 已被改變。有時候，會在回應內給予新的 URI。
     * 302 Found : This response code means that URI of requested resource has been changed temporarily. New changes in the URI might be made in the future. Therefore, this same URI should be used by the client in future requests.
     * 303 See Other : Server sent this response to directing client to get requested resource to another URI with an GET request.
     * 304 Not Modified : 表示資源在由請求頭中的If-Modified-Since或If-None-Match參數指定的這一版本之後，未曾被修改。在這種情況下，由於用戶端仍然具有以前下載的副本，因此不需要重新傳輸資源。
     * 305 Use Proxy : Was defined in a previous version of the HTTP specification to indicate that a requested response must be accessed by a proxy. It has been deprecated due to security concerns regarding in-band configuration of a proxy.
     * 306 unused : This response code is no longer used, it is just reserved currently. It was used in a previous version of the HTTP 1.1 specification.
     * 307 Temporary Redirect : Server sent this response to directing client to get requested resource to another URI with same method that used prior request. This has the same semantic than the 302 Found HTTP response code, with the exception that the user agent must not change the HTTP method used: if a POST was used in the first request, a POST must be used in the second request.
     * 308 Permanent Redirect : This means that the resource is now permanently located at another URI, specified by the Location: HTTP Response header. This has the same semantics as the 301 Moved Permanently HTTP response code, with the exception that the user agent must not change the HTTP method used: if a POST was used in the first request, a POST must be used in the second request.
     *
     * -用戶端錯誤回應-
     * 400 Bad Request : 此回應意味伺服器因為收到無效語法，而無法理解請求。
     * 401 Unauthorized : 需要授權以回應請求。它有點像 403，但這裡的授權，是有可能辦到的。
     * 402 Payment Required : 此回應碼留作未來使用。一開始此碼旨在用於數位交易系統，不過，目前並未使用。
     * 403 Forbidden : 用戶端並無訪問權限，所以伺服器給予應有的回應。
     * 404 Not Found : 伺服器找不到請求的資源。因為在 web 上它很常出現，這回應碼也許最為人所悉。
     * 405 Method Not Allowed : 伺服器理解此請求方法，但它被禁用或不可用。有兩個強制性方法：GET 與 HEAD，永遠不該被禁止、也不該回傳此錯誤碼。
     * 406 Not Acceptable : This response is sent when the web server, after performing server-driven content negotiation, doesn't find any content following the criteria given by the user agent.
     * 407 Proxy Authentication Required : 與401回應類似，只不過用戶端必須在代理伺服器上進行身分驗證。[37]代理伺服器必須返回一個Proxy-Authenticate用以進行身分詢問。用戶端可以返回一個Proxy-Authorization資訊頭用以驗證。
     * 408 Request Timeout : 請求超時。根據HTTP規範，用戶端沒有在伺服器預備等待的時間內完成一個請求的傳送，用戶端可以隨時再次提交這一請求而無需進行任何更改。
     * 409 Conflict : 表示因為請求存在衝突無法處理該請求，例如多個同步更新之間的編輯衝突。
     * 410 Gone : This response would be sent when requested content has been deleted from server.
     * 411 Length Required : Server rejected the request because the Content-Length header field is not defined and the server requires it.
     * 412 Precondition Failed : The client has indicated preconditions in its headers which the server does not meet.
     * 413 Payload Too Large : Request entity is larger than limits defined by server; the server might close the connection or return an Retry-After header field.
     * 414 URI Too Long : 前稱「Request-URI Too Long」，[43]表示請求的URI長度超過了伺服器能夠解釋的長度，因此伺服器拒絕對該請求提供服務。通常將太多資料的結果編碼為GET請求的查詢字串，在這種情況下，應將其轉換為POST請求。
     * 415 Unsupported Media Type : 對於當前請求的方法和所請求的資源，請求中提交的網際網路媒體類型並不是伺服器中所支援的格式，因此請求被拒絕。例如，用戶端將圖像上傳格式為svg，但伺服器要求圖像使用上傳格式為jpg。
     * 416 Requested Range Not Satisfiable : The range specified by the Range header field in the request can't be fulfilled; it's possible that the range is outside the size of the target URI's data.
     * 417 Expectation Failed : This response code means the expectation indicated by the Expect request header field can't be met by the server.
     * 418 I'm a teapot : The server refuses the attempt to brew coffee with a teapot.
     * 421 Misdirected Request : The request was directed at a server that is not able to produce a response. This can be sent by a server that is not configured to produce responses for the combination of scheme and authority that are included in the request URI.
     * 422 Unprocessable Entity (WebDAV) : The request was well-formed but was unable to be followed due to semantic errors.
     * 423 Locked (WebDAV) : The resource that is being accessed is locked.
     * 424 Failed Dependency (WebDAV) : The request failed due to failure of a previous request.
     * 426 Upgrade Required : The server refuses to perform the request using the current protocol but might be willing to do so after the client upgrades to a different protocol. The server sends an Upgrade header in a 426 response to indicate the required protocol(s).
     * 428 Precondition Required : The origin server requires the request to be conditional. Intended to prevent the 'lost update' problem, where a client GETs a resource's state, modifies it, and PUTs it back to the server, when meanwhile a third party has modified the state on the server, leading to a conflict.
     * 429 Too Many Requests : The user has sent too many requests in a given amount of time ("rate limiting").
     * 431 Request Header Fields Too Large : The server is unwilling to process the request because its header fields are too large. The request MAY be resubmitted after reducing the size of the request header fields.
     * 451 Unavailable For Legal Reasons : 用戶端請求違法的資源，例如受政府審查的網頁。
     *
     * -伺服器端錯誤回應-
     * 500 Internal Server Error : 伺服器端發生未知或無法處理的錯誤。
     * 501 Not Implemented : 伺服器不支援當前請求所需要的某個功能。當伺服器無法辨識請求的方法，並且無法支援其對任何資源的請求。[59]（例如，網路服務API的新功能）
     * 502 Bad Gateway : 作為閘道器或者代理工作的伺服器嘗試執行請求時，從上游伺服器接收到無效的回應。
     * 503 Service Unavailable : The server is not ready to handle the request. Common causes are a server that is down for maintenance or that is overloaded. Note that together with this response, a user-friendly page explaining the problem should be sent. This responses should be used for temporary conditions and the Retry-After: HTTP header should, if possible, contain the estimated time before the recovery of the service. The webmaster must also take care about the caching-related headers that are sent along with this response, as these temporary condition responses should usually not be cached.
     * 504 Gateway Timeout : This error response is given when the server is acting as a gateway and cannot get a response in time.
     * 505 HTTP Version Not Supported : The HTTP version used in the request is not supported by the server.
     * 506 Variant Also Negotiates : The server has an internal configuration error: transparent content negotiation for the request results in a circular reference.
     * 507 Insufficient Storage : The server has an internal configuration error: the chosen variant resource is configured to engage in transparent content negotiation itself, and is therefore not a proper end point in the negotiation process.
     * 508 Loop Detected (WebDAV) : The server detected an infinite loop while processing the request.
     * 510 Not Extended : 取得資源所需要的策略並沒有被滿足。
     * 511 Network Authentication Required : 用戶端需要進行身分驗證才能獲得網路存取權限，旨在限制用戶群存取特定網路。（例如連接WiFi熱點時的強制網路門戶）
     *
     *********************************************************************/

    /*
     * Public be able to application with api for web service
     */
    protected $version = '2.0';//'1.5';//'1.4;//'1.3';//'1.1';//1.0
    private $api_data_table_key = 'oxymrssVCB6D724F1F658xjvo95DNNSwivRBuOctyoorX425DF487';
    private $api_device_token_table_key = 'oxymrssVCB6D724F1F658xjvo95DNNSwivRBuOctyoorX425DF487';
    private $api_table = '';


    /*
     *  API get data from table (前端建翰)
     */
    public function getModData (Request $request)
    {
        $this->rtndata['StatusCode'] = 200;
        if ( !$request->exists('_token')){
            //Logs
            _WebController::_saveLogAction(
                'Request',
                10001,
                'no get token api GET from ' . $request->ip(),
                json_encode($request->all(), JSON_UNESCAPED_UNICODE)
            );
            return response()->json( 'unauthorized' )->header('Conten-Type: ' , 'application/json')->setStatusCode(401);
        }
        if ( $request->input('_token') != $this->api_data_table_key){
            //Logs
            _WebController::_saveLogAction(
                'Request',
                10001,
                'error token api GET from ' . $request->ip(),
                json_encode($request->all(), JSON_UNESCAPED_UNICODE)
            );
            return response()->json( 'unauthorized' )->header('Conten-Type: ' , 'application/json')->setStatusCode(401);
        }
        if ( !$request->exists('_table') ){
            //Logs
            _WebController::_saveLogAction(
                'Request',
                10002,
                'no get _table api GET from ' . $request->ip(),
                json_encode($request->all(), JSON_UNESCAPED_UNICODE)
            );
            return response()->json( 'no table value' )->header('Conten-Type: ' , 'application/json')->setStatusCode(205);
        }


        // 分頁功能-參數
        $iPagination =  $request->input('pagination') ? $request->input('pagination') : 6 ;
        $page =  $request->input('page') ? $request->input('page') : 1 ;
        $sort_name = $request->input('sort_name') ? $request->input('sort_name') : 'iUpdateTime';//'iCreateTime';
        $sort_dir = $request->input('sort_dir') ? $request->input('sort_dir') : 'desc';

        //判斷讀取哪個資料表
        try {

            switch ($request->input('_table'))
            {
                //媒體
                case 'press':
                    $map['bDel'] = 0;
                    $map['iStatus'] = 1;
                    $data_arr = ModPress::query()->where( $map )
//                        ->where(function( $query ) use ( $sort_arr, $search_word ) {
//                            foreach ($sort_arr as $item) {
//                                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
//                            }
//                        })
                        ->orderBy( $sort_name, $sort_dir )
                        ->skip( ($page-1) * intval($iPagination) )
                        ->take( intval($iPagination) )
                        ->get();
                    $Dao = $data_arr;
                    if ( !$Dao->count()){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data';
                        break;
                    }
                    foreach ($Dao as $key => $var) {
                        //
                        // $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
                        // $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
                    }
                    //圖片
                    $this->getPictureWithId($Dao);
                    break;

                //部落格類別
                case 'blog_category':
                    $map['bDel'] = 0;
                    $map['iStatus'] = 1;
                    $data_arr = ModBlogCategory::query()->where( $map )
//                        ->where(function( $query ) use ( $sort_arr, $search_word ) {
//                            foreach ($sort_arr as $item) {
//                                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
//                            }
//                        })
                        ->orderBy( $sort_name, $sort_dir )
                        ->skip( ($page-1) * intval($iPagination) )
                        ->take( intval($iPagination) )
                        ->get();
                    $Dao = $data_arr;
                    if ( !$Dao->count()){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data';
                        break;
                    }
                    foreach ($Dao as $key => $var) {
                        $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
                        $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
                    }
                    //圖片
                    $this->getPictureWithId($Dao);
                    break;

                //部落格
                case 'blog':
                    $map['mod_blog.bDel'] = 0;
                    $map['iStatus'] = 1;
                    $count = ModBlog::query()->where($map)->count();
                    if ( !$count){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data';
                        break;
                    }
                    $Dao = ModBlog::query()->where($map)
//                        ->leftJoin('mod_blog_category', 'mod_blog_category.iId', '=', 'mod_blog.iCategoryId')
                        ->orderBy($sort_name, $sort_dir)
                        ->skip( ($page-1) * intval($iPagination) )
                        ->take( intval($iPagination) )
                        ->get();
//                    if ( !$Dao->count()){
//                            $this->rtndata['StatusCode'] = 204;
//                            $this->rtndata['status'] = 0;
//                            $this->rtndata['message'] = 'no data';
//                            $this->rtndata['aaData'] = [];
//                        break;
//                    }
                    foreach ($Dao as $key => $var) {
                        // $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
                        // $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
                    }
                    //圖片
                    $this->getPictureWithId($Dao);
                    break;

                //商品
                case 'product':
                    $map['bDel'] = 0;
                    $map['iStatus'] = 1;
                    $Dao = ModProduct::query()->where($map)
                        ->orderBy($sort_name, $sort_dir)
                        ->skip( ($page-1) * intval($iPagination) )
                        ->take( intval($iPagination) )
                        ->get();
                    if ( !$Dao->count()){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data';
                        break;
                    }
                    foreach ($Dao as $key => $var) {
                        $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
                        $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
                    }
                    //圖片
                    $this->getPictureWithId($Dao);
                    break;

                //訂單
                case 'order':
                    $map = [];
//                    $map['iStatus'] = 1;
                    $count = ModOrder::query()->where($map)->count();
                    if ( !$count){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data';
                        break;
                    }
                    $Dao = ModOrder::query()->where($map)
                        ->leftJoin('sys_member_info', 'sys_member_info.iId', '=', 'mod_order.iMemberId')
                        ->skip( ($page-1) * intval($iPagination) )
                        ->take( intval($iPagination) )
                        ->get();
                    if ( !$Dao->count()){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data from order join member_info';
                        break;
                    }
                    break;

                //訂單-智能合約
                case 'order_smart':
                    $map = [];
//                    $map['iStatus'] = 1;
                    $count = ModOrderSmart::query()->where($map)->count();
                    if ( !$count){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data';
                        break;
                    }
                    $Dao = ModOrderSmart::query()->where($map)
                        ->orderBy($sort_name, $sort_dir)
                        ->skip( ($page-1) * intval($iPagination) )
                        ->take( intval($iPagination) )
                        ->get();
                    if ( !$Dao->count()){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data from order join member_info';
                        break;
                    }
                    break;

                //通告
                case 'notices':
                    $map['bDel'] = 0;
                    $map['iStatus'] = 1;
                    $Dao = ModNotices::query()->where($map)
                        ->orderBy($sort_name, $sort_dir)
                        ->skip( ($page-1) * intval($iPagination) )
                        ->take( intval($iPagination) )
                        ->get();
                    if ( !$Dao->count()){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data';
                        break;
                    }
                    foreach ($Dao as $key => $var) {
                        // $var->iCreateTime = date( 'Y/m/d H:i:s', $var->iCreateTime );
                        // $var->iUpdateTime = date( 'Y/m/d H:i:s', $var->iUpdateTime );
                    }
                    //圖片
                    $this->getPictureWithId($Dao);
                    break;

                //會員
                case 'member':
//                    $map['bDel'] = 0;
                    $map['sys_member.iStatus'] = 1;
                    $Dao = SysMember::query()->where($map)
                        ->join('sys_member_info', 'sys_member.iId', '=', 'sys_member_info.iMemberId')
                        ->skip( ($page-1) * intval($iPagination) )
                        ->take( intval($iPagination) )
                        ->get();
                    if ( !$Dao->count()){
                        $this->rtndata['StatusCode'] = 204;
                        $this->rtndata['status'] = 0;
                        $this->rtndata['message'] = 'no data from member join member_info';
                        break;
                    }
                    //圖片
                    $this->getPictureWithId($Dao);
                    break;


                default:
                    $this->rtndata['StatusCode'] = 205;
                    $this->rtndata['status'] = 0;
                    $this->rtndata['message'] = '_table input error !';
            }
            $this->rtndata['StatusCode'] = 200;
            $this->rtndata['status'] = 1;
            $this->rtndata['message'] = 'get press data Success~';
            $this->rtndata['aaData'] = $Dao;

        } catch (\Exception $e){
            $this->rtndata['StatusCode'] = 400;
            $this->rtndata['status'] = 0;
            $this->rtndata['message'] = $e->getMessage();
        }

        return response()->json( $this->rtndata )->header('Access-Control-Allow-Origin' , '*' )->setStatusCode($this->rtndata['StatusCode']);
    }


    /*
     * API add data to table
     */
    public function addModData (Request $request)
    {
        if ( !$request->exists('_token')){
            return abort(404);
        }
        if ( $request->input('_token') != $this->api_data_table_key){
            return abort(404);
        }
        if ( !$request->input('_table') ){
            return '沒有資料表名稱';
        }
        if ( $request->input('_table') != $this->api_table ){
            return '沒有資料表名稱';
        }
        try {
            $Dao = new ModData();
            $Dao->iData1 = $request->exists('data1') ? $request->input('data1') : 0;
            $Dao->vData2 = $request->exists('data2') ? $request->input('data2') : '';
            $Dao->iCreateTime = $Dao->iUpdateTime = time();
            $Dao->iStatus = 1;
            $Dao->bDel = 0;
            $Dao->save();
        } catch (\Exception $e) {
            echo $e->getMessage() . '<br>Code:' . $e->getCode();
        }
        return 'Add success :' . $Dao->iId . '<br>on time:' . date('Y/m/d', $Dao->iCreateTime);
    }

    /*
     * API mod data to table
     */
    public function editModData (Request $request, $id)
    {
        if ( !$request->exists('_token')){
            return abort(404);
        }
        if ( $request->input('_token') != $this->api_data_table_key){
            return abort(404);
        }
        try {
            $map['bDel'] = 0;
            $map['iStatus'] = 1;
            $Dao = ModData::query()->where($map)->findOrFail($id);
            $Dao->iData1 = $request->exists('data1') ? $request->input('data1') : $Dao->iData1;
            $Dao->vData2 = $request->exists('data2') ? $request->input('data2') : $Dao->vData2;
            $Dao->iUpdateTime = time();
            $Dao->iStatus = 1;
            $Dao->bDel = 0;
            $Dao->save();
        } catch (\Exception $e){
            echo $e->getMessage() . '<br>Code:' . $e->getCode();
        }
        return 'Edit success :' . $Dao->iId . '<br>on time:' . date('Y/m/d', $Dao->iCreateTime);
    }

    /*
     * API destory data on table
     */
    public function delModData (Request $request, $id)
    {
        if ( !$request->exists('_token')){
            return abort(404);
        }
        if ( $request->input('_token') != $this->api_data_table_key){
            return abort(404);
        }
        try {
            $map['bDel'] = 0;
            $map['iStatus'] = 1;
            $Dao = ModData::query()->where($map)->find($id);
            $Dao->bDel = 1;
            $Dao->iUpdateTime = time();
            $Dao->save();
        } catch (\Exception $e){
            echo $e->getMessage() . '<br>Code:' . $e->getCode();
        }
        return abort(204);
    }


    /*
     * API get device token table
     */
    public function getDeviceToken (Request $request)
    {
        if ( !$request->exists('_token')){
            return abort(404);
        }
        if ( $request->input('_token') != $this->api_device_token_table_key){
            return abort(404);
        }
        try {
            $map['bDel'] = 0;
            $map['iStatus'] = 1;
            $Dao = ModDeviceToken::query()->where($map)->get();
        } catch (\Exception $e){
            echo $e->getMessage() . '<br>Code:' . $e->getCode();
        }
//        echo json_encode( $Dao );
        return json_encode( $Dao );
    }

    /*
     * API device token add
     */
    public function addDeviceToken (Request $request)
    {
        if ( !$request->exists('_token')){
            return abort(404);
        }
        if ( $request->input('_token') != $this->api_device_token_table_key){
            return abort(404);
        }
        try {
            $Dao = new ModDeviceToken();
            $Dao->iMemberId = $request->input('userid') ? $request->input('userid') : 0;
            $Dao->vToken = $request->input('token') ? $request->input('token') : '';
            $Dao->iCreateTime = $Dao->iUpdateTime = time();
            $Dao->iStatus = 1;
            $Dao->bDel = 0;
            $Dao->save();
        } catch (\Exception $e){
            return $e->getMessage() . '<br>Code:' . $e->getCode();
        }
        return 'Add success :' . $Dao->iId . '<br>on time:' . date('Y/m/d', $Dao->iCreateTime);
    }

    /*
     * API device token edit
     */
    public function editDeviceToken (Request $request, $id)
    {
        if ( !$request->exists('_token')){
            return abort(404);
        }
        if ( $request->input('_token') != $this->api_device_token_table_key){
            return abort(404);
        }
        try {
            $map['bDel'] = 0;
            $map['iStatus'] = 1;
            $map['vToken'] = $request->exists('token') ? $request->input('token') : 0;
            $Dao = ModDeviceToken::query()->where($map)->first();
            $Dao->iMemberId = $request->exists('userid') ? $request->input('userid') : $Dao->iMemberId;
            $Dao->iUpdateTime = time();
            $Dao->iStatus = 1;
            $Dao->bDel = 0;
            $Dao->save();
        } catch (\Exception $e){
            echo $e->getMessage() . '<br>Code:' . $e->getCode();
        }
        return 'Edit success :' . $Dao->iId . '<br>on time:' . date('Y/m/d', $Dao->iCreateTime);
    }

    /*
     * API device token del
     */
    public function delDeviceToken (Request $request, $id)
    {
        if ( !$request->exists('_token')){
            return abort(404);
        }
        if ( $request->input('_token') != $this->api_device_token_table_key){
            return abort(404);
        }
        try {
            $map['bDel'] = 0;
            $map['iStatus'] = 1;
            $map['vToken'] = $request->exists('token') ? $request->input('token') : 0;
            $Dao = ModDeviceToken::query()->where($map)->first();
            $Dao->bDel = 1;
            $Dao->iUpdateTime = time();
            $Dao->save();
        } catch (\Exception $e){
            echo $e->getMessage() . '<br>Code:' . $e->getCode();
        }
        return abort(204);
    }


}
