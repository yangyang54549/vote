<?php
namespace app\web\controller;
use think\Controller;
use think\Session;
use think\Cookie;

class Yang extends Controller
{
    public function __construct()
    {
        $this->ret = ['code'=>1,'data'=>'','msg'=>'提交成功'];//1是成功 -200是失败
        parent::__construct();
    }
}
