<?php

namespace App\Presenters\Admin;


class ScenesPresenter extends Presenter
{
    protected $gotoUrl;         //ajax finish to url
    protected $title = 'Scenes';          //output for view
    protected $view_group_name = 'scenes';       //document of view group
    protected $route_name;      //Route->name()


    public function setViewName($name)
    {
        return $this->view_group_name = $name;
    }

    public function setRouteName($name)
    {
        $this->route_name = $name;
        $this->gotoUrl = route($this->route_name.'.index');
        return $this->route_name;
    }

    public function getViewName()
    {
        return $this->view_group_name;
    }

    public function getRouteName()
    {
        return $this->route_name;
    }

    /*
     * Select options design
     */
    public function getSelectOption()
    {
        return [
            'navbar' => [
                'navbar.home' => '首頁選單欄位',
                'navbar.intr' => '介紹頁選單',
            ],
            'slider' => [
                'slider.home' => '首頁滑動圖',
                'slider.intr' => '介紹頁滑動圖',
                'slider.product' => '商品頁滑動圖',
            ],
            'introduce' => [
                'introduce.home' => '首頁文字',
                'introduce.intr' => '介紹頁文字',
            ],
            'footer' => [
                'footer.home' => '首頁',
                'footer.intr' => '介紹頁',
            ],
        ];
    }

    public function getSelectOption_navbar($type='', $opt = '')
    {
        $arr = $this->getSelectOption();
        foreach ($arr['navbar'] as $key => $val){
            $opt .= '<option value="'.$key.'" '. ($type==$key?'selected':'') .'>'.$val.'</option>';
        }
        return $opt;
    }

    public function getSelectOption_slider($type='', $opt = '')
    {
        $arr = $this->getSelectOption();
        foreach ($arr['slider'] as $key => $val){
            $opt .= '<option value="'.$key.'" '. ($type==$key?'selected':'') .'>'.$val.'</option>';
        }
        return $opt;
    }

    public function getSelectOption_introduct($type='', $opt = '')
    {
        $arr = $this->getSelectOption();
        foreach ($arr['introduce'] as $key => $val){
            $opt .= '<option value="'.$key.'" '. ($type==$key?'selected':'') .'>'.$val.'</option>';
        }
        return $opt;
    }

    public function getSelectOption_footer($type='', $opt = '')
    {
        $arr = $this->getSelectOption();
        foreach ($arr['footer'] as $key => $val){
            $opt .= '<option value="'.$key.'" '. ($type==$key?'selected':'') .'>'.$val.'</option>';
        }
        return $opt;
    }
}
