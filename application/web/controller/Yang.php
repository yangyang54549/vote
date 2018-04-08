<?php
namespace app\web\controller;
use think\Controller;
use think\Session;
use think\Cookie;
use app\common\model\User as L;

class Yang extends Controller
{
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
            //session未登录
            $suser = session('user');
            if (!isset($suser)) {
                $cuser = Cookie::get('user_id');
                if (!isset($cuser)) {
                    //无cookie
                    if($url == 'User/tui'){
                        $invite = input('invite');
                        $this->redirect('login/reg', ['referrer' => $invite]);
                    }
                    $this->redirect('login/login');
                }else{
                    //有cookie
                    $user = L::where(['id'=>$cuser])->find();
                    Session::set('user',$user);
                    $this->id =Session::get('user.id');
                }
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
