<?php
namespace app\web\controller;
use think\Controller;
use think\Session;
use think\Cookie;

class Yang extends Controller
{

    protected $arr = ['Index/index','Login/login','Login/wxlogin','Login/password','Login/reg','Login/admin','Login/getaccess_token','Login/codemsg','Wxpay/weixinjsapnotify'];
    public $id = null;

    public function __construct()
    {
        $this->ret = ['code'=>1,'data'=>'','msg'=>'提交成功'];//1是成功 -200是失败
        parent::__construct();
        $request=  \think\Request::instance();
        $con = $request->controller();
        $act = $request->action();
        $url = $con.'/'.$act;
        if (!in_array($url,$this->arr)) {
            $suser = Session::get('user');
            if (!isset($suser)) {
                $this->redirect('web/login/login');
            }
        }
    }
}
