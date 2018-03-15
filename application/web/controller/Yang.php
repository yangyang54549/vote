<?php
namespace app\web\controller;
use think\Controller;
use think\Session;
use think\Cookie;

class Yang extends Controller
{

    protected $arr = ['Index/index','Index/load','Login/login','Login/wxlogin','Login/password','Login/reg','Login/admin','Login/getaccess_token','Login/codemsg','Wxpay/weixinjsapnotify','Timing/index','Timing/gold'];
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
            $suser = session('user');
            if (!isset($suser)) {
                //未登录
                if($url == 'User/tui'){
                    $invite = input('invite');
                    //cookie('referrer',$invite,2592000);
                    $this->redirect('login/reg', ['referrer' => $invite]);
                }
                $this->redirect('login/login');
            }
            //已登录又点击链接跳转至首页
            if($url == 'User/tui'){
                $invite = input('invite');
                if ($invite == session('user.referrer')) {
                    $this->redirect('index/index');
                }
            }
            $this->id = session('user.id');
        }
    }
}
