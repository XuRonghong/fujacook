<?php

namespace App\Presenters;

use App\Admin;
use App\Http\Controllers\FuncController;
use App\Member;
use App\Menu;
use App\Permission;
use DB;

abstract class Presenter
{
    protected $model;
    protected $summary = '';
    protected $breadcrumb = [];

    public function setTitle($title)
    {
        return $this->title = $title;
    }

    public function setViewName($name)
    {
        return $this->view_group_name = $name;
    }

    public function setRouteName($name)
    {
        $this->route_name = $name;
        $this->gotoUrl = route($name.'.index');
        return $name;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getViewName()
    {
        return $this->view_group_name;
    }

    public function getRouteName()
    {
        return $this->route_name;
    }

    public function propSummary($text=0)
    {
        return $this->summary = $text ? $text : $this->summary;
    }

    //
    public function addParameters(&$data, $key=null, $value=null)
    {
        $data = array_add($data, $key, $value);
    }

    //
    public function editParameters(&$data, $key=null, $value=null)
    {
        $data[$key] = $value;
    }

    /*
     * data object or array forEach to do.
     */
    public function eachOne_aaData($arr)
    {
        if ( $arr['aaData']) {
            foreach ($arr['aaData'] as $key => $var) { }
        }
        return $arr;
    }

    /*
     * trans each one data for output view.
     */
    public function transOne($data, $other=0)
    {
        //從資料串裡依據file_id找到image
        $data->image = $data->image ? array($data->image) : $this->transFileIdtoImage($data->file_id);
        if ($other=='strip_tags'){
            //特別處理使文字方塊顯示出來
            if (isset($data['product_description'])) {
                $data['product_description'] = strip_tags( htmlspecialchars_decode($data['product_description']));
            }
            if (isset($data['service_description'])) {
                $data['service_description'] = strip_tags( htmlspecialchars_decode($data['service_description']));
            }
            if (isset($data['customerservice_note'])) {
                $data['customerservice_note'] = strip_tags( htmlspecialchars_decode($data['customerservice_note']));
            }
            if (isset($data['shipping_note'])) {
                $data['shipping_note'] = strip_tags( htmlspecialchars_decode($data['shipping_note']));
            }
            if (isset($data['pay_note'])) {
                $data['pay_note'] = strip_tags( htmlspecialchars_decode($data['pay_note']));
            }
            if (isset($data['remarks'])) {
                $data['remarks'] = strip_tags( htmlspecialchars_decode($data['remarks']));
            }
            if (isset($data['content'])) {
                $data['content'] = strip_tags( htmlspecialchars_decode($data['content']));
            }
            if (isset($data['detail'])) {
//                $data['detail'] = strip_tags( htmlspecialchars_decode($data['detail']));
                $data['detail'] = htmlspecialchars_decode($data['detail']);
            }
        }
        return $data;
    }

    // 給table名稱以及id即可找出使用者名稱
    public function getUserName($model, $id)
    {
        switch ($model) {
            case 'admin': $model = new Admin(); break;
            case 'member': $model = new Member(); break;
            default: return null;
        }
        if ( !$id) return null;
        else return $model->query()->where('id', $id)->first()->name;
    }

    // 轉換 user type 為輸出顯示type
    public function transUserType($type=null)
    {
        if ( !$type) return null;
        elseif ($type < 5) return trans('web.user_type.administrator');
        elseif ($type < 10) return trans('web.user_type.manager');
        else return trans('web_message.runaways'); //'超出可以判斷的範圍';
    }

    // 轉換 type 為輸出顯示選項內容之一
    public function tranTypeInSelectOption($type=null, $arr=[], $key=null)
    {
        if (is_null($type)) {
            return null;
        } elseif ($key) {
            foreach ($arr[$key] as $value => $option) {
                if ($type == $value) return $option;
            }
        } else {
            foreach ($arr as $select) {
                foreach ($select as $value => $option) {
                    if ($type == $value) return $option;
                }
            }
        }
    }

    /* Input: (int)file id ==> Output: (array)file path
     * table - input file_id to find image on filetable.
     */
    public function transFileIdtoImage($file_id)
    {
        if ( !$file_id) return [];
        //
        $image_arr = [];
        $tmp_arr = explode( ';', $file_id );
        $tmp_arr = array_filter( $tmp_arr );
        foreach ($tmp_arr as $key => $item) {
            //主要要讓前端編輯器可以正確讀取file id，很重要
            $image_arr[$item] = FuncController::_getFilePathById( $item );
        }
        if ($tmp_arr){
            return $image_arr;
        }
        return [];
    }

    // 例行公事，路由元素
    public function getRouteResource($route_name = '', $except='')
    {
        $except = '0'.$except;
        return [
            'index' => strpos($except,'i')?:route($route_name.'.index'),
            'list' => strpos($except,'l')?:route($route_name.'.list'),
            'create' => strpos($except,'c')?:route($route_name.'.create'),
            'store' => strpos($except,'p')?:route($route_name.'.store'),
            'edit'  => strpos($except,'e')?:route($route_name.'.index'),
            'update' => strpos($except,'u')?:route($route_name.'.update', [-10]),    //-10暫定代替字元
            'destroy' => strpos($except,'d')?:route($route_name.'.destroy', [-10]),
            'show' => strpos($except,'s')?:route($route_name.'.index'),
        ];
    }

    // 例行公事，顯示板塊參數
    public function getParameters($index=null, $mergeArr=[])
    {
        $data = [
            'arr' => [],    // parameter of view
            'indexUrl' => url('admin'),
            'logoutUrl' => route('admin.logout'),
            'dark_logo' => asset('images/logo_icon.png'),
            'light_logo' => asset('images/logo_icon.png'),
            'dark_logo_text' => asset('images/logo_icon2.png'),
            'light_logo_text' => asset('images/logo_icon2.png'),
            'admin_logo' => auth()->guard('admin')->user()->info[0]->user_image, //asset('xtreme-admin/assets/images/users/1.jpg'),
            'admin_name' => auth()->guard('admin')->user()->name, //'Steave Jobs',
            'admin_email' => auth()->guard('admin')->user()->email, //'varun@gmail.com',
            'admin_profile' => route('admin.admins.index').'/'.auth()->guard('admin')->user()->no.'/edit',
            'my_balance_url' => '',
            'account_setting_url' => 'javascript:void(0)',
            'upload_image' => url('admin/upload_image'),
            'upload_image_base64_url' => url('admin/upload_image_base64'),
            'upload_file_url' => url('admin/upload_file'),
            'menu' => $this->getMenu2(),
        ];
        if ($mergeArr) $data = array_merge($data, $mergeArr);
        switch ($index){
            case 'index':
                $data = array_merge($data, [
                    'Title' => $this->title,
                    'Summary' => $this->summary,
                    'breadcrumb' => $this->presentBreadcrumb([
                        $this->title => data_get($data,'route_url')?$data['route_url']['index']:'',
                    ]),
                ]);
                break;
            case 'create':
                $data = array_merge($data, [
                    'Title' => $this->title.' Create',
                    'Summary' => $this->summary,
                    'breadcrumb' => $this->presentBreadcrumb([
                        $this->title => data_get($data,'route_url')?$data['route_url']['index']:'',
                        'create' => data_get($data,'route_url')?$data['route_url']['create']:'',
                    ]),
                ]);
                break;
            case 'edit':
                $data = array_merge($data, [
                    'Title' => $this->title.' Edit',
                    'Summary' => $this->summary,
                    'breadcrumb' => $this->presentBreadcrumb([
                        $this->title => data_get($data,'route_url')?$data['route_url']['index']:'',
                        'edit' => request()->getUri(), //data_get($data,'route_url')?$data['route_url']['edit']:'',
                    ]),
                ]);
                break;
            case 'show':
                $data = array_merge($data, [
                    'Title' => $this->title.' Show',
                    'Summary' => $this->summary,
                    'breadcrumb' => $this->presentBreadcrumb([
                        $this->title => data_get($data,'route_url')?$data['route_url']['index']:'',
                        'show' => request()->getUri(), // data_get($data,'route_url')?$data['route_url']['show']:'',
                    ]),
                    'Disable' => true
                ]);
                break;
            default :
                $data = array_merge($data, [
                    'Title' => '',
                    'Summary' => '',
                ]);
        }
        return $data;
    }

    // to view response
    public function responseJson($data=[], $method=0, $status=200)
    {
        if ( !data_get($data,'errors')) {
            switch ($method) {
                case 'ajax':
                    return response()->json($data, $status);
                case 'noajax':
                    return response()->json($data['messages'], $status);
                case 'index':
                    return view('admin.'.$this->getViewName().'.index', compact('data'));
                case 'create':
                case 'edit':
                case 'show':
                    return view('admin.'.$this->getViewName().'.create', compact('data'));
                case 'store':
                    return response()->json([
                        'status' => 1,
                        'message' => sprintf(trans('options.presenter.store')." %s", trans('options.presenter.one_data')),
                        'redirectUrl' => $this->gotoUrl
                    ], $status);
                case 'update':
                    return response()->json([
                        'status' => 1,
                        'message' => sprintf(trans('options.presenter.update')." %s", trans('options.presenter.one_data')),
                        'redirectUrl' => $this->gotoUrl
                    ], $status);
                case 'destroy':
                    return response()->json([
                        'status' => 1,
                        'message' => sprintf(trans('options.presenter.destroy')." %s", trans('options.presenter.one_data')),
                        'redirectUrl' => $this->gotoUrl
                    ], $status);
                case 'mass_destroy':
                    return response()->json([
                        'status' => 1,
                        'message' => sprintf(trans('options.presenter.destroy')." %s", trans('options.presenter.mass_data')),
                        'redirectUrl' => $this->gotoUrl
                    ], $status);
                default:
//                    return redirect(route('admin.news.index', $request->query()))->with('success', sprintf("已新增 %s", "一筆資料"));
                    return response()->json([ ], 404);
            }
        } else {
            return response()->json([
                'status' => 0,
                'message' => $data['errors'],
//                'redirectUrl' => $this->gotoUrl
            ], 422);
        }
    }

    // 製造左邊選單
    public function getMenu2()
    {
//        $this->view = View()->make( config( '_menu.' . $this->func . '.view' ) );
//        session()->put( 'menu_parent', config( '_menu.' . $this->func . '.menu_parent' ) );
//        session()->put( 'menu_access', config( '_menu.' . $this->func . '.menu_access' ) );
        if (auth()->guard('admin')->user()->id == 1){
            $mapSysMenu ['open'] = 1;
            $DaoSysMenu = Menu::query()->orderBy( 'rank', 'ASC' )->get();
        } else {
            $mapSysMenu ['open'] = 1;
            $DaoSysMenu = Menu::query()->where($mapSysMenu)->whereExists(function ($query) {
                    $query->select(DB::raw(1))
                        ->from('admin_menu')
                        ->whereRaw('admin_menu.menu_id = menus.id')
                        ->whereRaw('admin_id = ' . auth()->guard('admin')->user()->id)
                        ->where('open', 1);
                })
                ->orderBy('rank', 'ASC')
                ->get();
        }
        $sys_menu = $DaoSysMenu->where('parent_id', '=', 0);
        foreach ($sys_menu as $key => $var) {
            if ($var->sub_menu) {
                $var->second = $DaoSysMenu->where('parent_id', '=', $var->id);
                foreach ($var->second as $key2 => $var2) {
                    if ($var2->sub_menu) {
                        $var2->third = $DaoSysMenu->where('parent_id', '=', $var2->id);
                    }
                }
            }
        }
        return $sys_menu;
    }

    // no finish...
    public function getMenu()
    {
        $index = '';
        $permissions = new Permission();
        foreach ($permissions as $permission){
            $arr = explode('.', $permission['name']);
            if ($arr[0] != $index) {

            } else {

            }
        }
    }

    //breadcrumb HTML
    public function presentBreadcrumb($elements=[])
    {
        $html = '<nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="'. url('admin') .'">Home</a></li>';
            foreach ($this->breadcrumb as $key => $element){
                $html .= '<li class="breadcrumb-item"><a href="'. $element .'">'.$key.'</a></li>';
            }
            foreach ($elements as $key => $element){
                $html .= '<li class="breadcrumb-item"><a href="'. $element .'">'.$key.'</a></li>';
            }
        $html .=       '<li class="breadcrumb-item active" aria-current="page"></li>
                    </ol>
                </nav>';
        return $html;
    }

    //CheckBox HTML
    public function presentCheckBox($data)
    {
        return '<div class="form-group row">
                    <div class="offset-sm-3 col-sm-9">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" name="group_checkbox[]" id="checkbox'.$data.'" value="'.$data.'" class="custom-control-input group_checkbox">
                            <label class="custom-control-label" for="checkbox'.$data.'"></label>
                        </div>
                    </div>
                </div>';
    }

    //click it can edit HTML
    public function presentIsEdit($index, $data)
    {
        $cache = $data;
        if ($data=='') $data = '-';
        switch ($index){
            case 'parent_id':
                return '<input class="isEdit '.$index.'" data-id="'.$index.'" size="10" style="width: 100%; display: none;" type="text" value="'. $cache .'" />'.'<div class="aaa">'.$data.'</div>';
            case 'rank':
                return '<input class="isEdit '.$index.'" data-id="'.$index.'" style="width: 50%; display: none;" type="number" max="9999" min="-9999" value="'. $cache .'" />'.'<div class="aaa">'.$data.'</div>';
            case 'name':
                return '<input class="isEdit '.$index.'" data-id="'.$index.'" size="10" style="width: 100%; display: none;" type="text" value="'. $cache .'" />'.'<div class="aaa">'.$data.'</div>';
            case 'value':
                return '<input class="isEdit '.$index.'" data-id="'.$index.'" size="10" style="width: 100%; display: none;" type="text" value="'. $cache .'" />'.'<div class="aaa">'.$data.'</div>';
            case 'link':
                return '<input class="isEdit '.$index.'" data-id="'.$index.'" size="10" style="width: 100%; display: none;" type="text" value="'. $cache .'" />'.'<div class="aaa">'.$data.'</div>';
            case 'sub_menu':
                return '<input class="isEdit '.$index.'" data-id="'.$index.'" size="10" style="width: 100%; display: none;" type="text" value="'. $cache .'" />'.'<div class="aaa">'.$data.'</div>';
            case 'open':
                return '<input class="isEdit '.$index.'" data-id="'.$index.'" size="10" style="width: 100%; display: none;" type="text" value="'. $cache .'" />'.'<div class="aaa">'.$data.'</div>';
            default:
                return '<div class="'.$index.'">'.$cache.'</div>';
        }
    }

    // panel HTML
    public function presentStatus($status=null, $btn='')
    {
        switch ($status) {
            case 1: $btn .= '<button class="btn btn-xs btn-success btn-open">'.trans('options.panel.status.open').'</button>'; break;
            case 0: $btn .= '<button class="btn btn-xs btn-primary btn-open">'.trans('options.panel.status.close').'</button>'; break;
            case '1': $btn .= '<button class="btn btn-xs btn-success btn-open">'.trans('options.panel.status.open').'</button>'; break;
            case '0': $btn .= '<button class="btn btn-xs btn-primary btn-open">'.trans('options.panel.status.close').'</button>'; break;
            default: $btn .= trans('options.panel.status.not'); //"無功能";
        }
        $btn .= '<button class="btn btn-xs btn-show btn-info" title="'.trans('options.panel.show').'" data-toggle="modal" data-target="#createmodel"><i class="fa fa-book" aria-hidden="true"></i></button>';
        $btn .= '<button class="btn btn-xs btn-edit" title="'.trans('options.panel.edit').'"><i class="fa fa-pencil-alt" aria-hidden="true"></i></button>';
        $btn .= '<button class="btn btn-xs btn-del pull-right" title="'.trans('options.panel.del').'"><i class="fa fa-trash" aria-hidden="true"></i></button>';
        return $btn;
    }

    // 製造 img HTML
    public function presentImages($images, $breakline=2)
    {
        $html_str = "";
        $i = 0;
        foreach($images as $image) {
            if ($i++ == $breakline) $html_str .= '<br>';
            $html_str .= "<img width='".($breakline>=2?'50px':'75px')."' src=" . $image . " style='margin-right:5px;margin-bottom:5px;'>";
        }
        return $html_str;
    }

    // 製造 a HTML
    public function presentAnchor($text, $href='')
    {
        return '<a href="'.$href.'">'.$text.'</button>';
    }

    // 製造 operate panel HTML
    public function presentOperate($html='', $text='', $href='', $class='')
    {
        return $html.'<a href="'.$href.'"><button class="btn btn-xs" title="'.$text.'"><i class="'.$class.'" aria-hidden="true"></i></button></a>';
    }


    /*
     * 目前無入用
     */
    public function presentStatus2018()
    {
        if($this->object->status)
        {
            return '<span class="label label-success">啟用</span>';
        }
        return '<span class="label label-danger">停用</span>';
    }

    public function dateTime($column = 'created_at', $format = 'Y-m-d H:i:s')
    {
        if ($this->object->$column) {
            return $this->object->$column->format($format);
        }
        return null;
    }
}
