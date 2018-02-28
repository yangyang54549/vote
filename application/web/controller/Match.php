<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Type;

class Match extends Yang
{
    public function index()
    {
        $type = Type::select();
        $this->assign('type',$type);
        return $this->fetch();
    }

    public function info()
    {
        return $this->fetch();
    }
}
