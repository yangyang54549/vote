<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class Column extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected static $isdelete = false;

    
}
