<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;
use think\Db;

class User extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected static $isdelete = false;

    public function info()
    {
        $id = input('id');
        $user = Db::table('tp_user')->where('id',$id)->select();
        $this->view->assign('list',$user);
        return $this->view->fetch();
    }

    public function ress()
    {
        $id = input('id');
        $user = Db::table('tp_address')->where('id',$id)->select();
        $this->view->assign('list',$user);
        return $this->view->fetch();
    }
}
