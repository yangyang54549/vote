<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\User as U;
use think\Session;

class User extends Yang
{
    public function index()
    {
        $id = session('user.id');
        $user = U::where('id',$id)->find();
        $this->assign('user',$user);
        return $this->fetch();
    }
    public function edit()
    {
        return $this->fetch();
    }
}
