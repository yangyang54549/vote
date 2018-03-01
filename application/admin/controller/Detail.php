<?php
namespace app\admin\controller;

\think\Loader::import('controller/Controller', \think\Config::get('traits_path') , EXT);

use app\admin\Controller;

class Detail extends Controller
{
    use \app\admin\traits\controller\Controller;
    // 方法黑名单
    protected static $blacklist = [];

    protected static $isdelete = false;

    protected function filter(&$map)
    {
        if ($this->request->param("user_id")) {
            $map['user_id'] = ["like", "%" . $this->request->param("user_id") . "%"];
        }
        if ($this->request->param("or ")) {
            $map['or '] = ["like", "%" . $this->request->param("or ") . "%"];
        }
        if ($this->request->param("bank_id")) {
            $map['bank_id'] = ["like", "%" . $this->request->param("bank_id") . "%"];
        }
    }
}
