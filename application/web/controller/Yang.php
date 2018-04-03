<?php
namespace app\web\controller;
use think\Controller;
use think\Session;
use think\Cookie;
use app\common\model\User as L;

class Yang extends Controller
{

    //protected $arr = ['Index/index','Index/load','Login/login','Login/wxlogin','Login/password','Login/reg','Login/admin','Login/getaccess_token','Login/codemsg','Wxpay/weixinjsapnotify','Wxpay/weixinactivate','Timing/index','Timing/gold'];
    protected $arr = ['Login/login','Login/wxlogin','Login/password','Login/reg','Wxpay/weixinjsapnotify','Wxpay/weixinactivate','Timing/index','Timing/gold'];

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

            //登录完帐号没有激活
            if ($url != 'Login/openid' && $url != 'Login/one' && $url != 'Wxpay/activate') {
                if(session('user.status')==0){
                    $user = L::where('id',session('user.id'))->find();
                    if ($user['status']==0) {
                        $this->redirect('login/openid');
                    }
                }
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
