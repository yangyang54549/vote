<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Column;
use app\common\model\Type;
use app\common\model\TypeCopy;


class Qunying extends Yang
{
    public function index()
    {
        $type = Type::select();
        $typecopy = TypeCopy::select();
        $this->assign('type',$type);
        $this->assign('typecopy',$typecopy);
        return $this->fetch();
    }
    public function info()
    {
        return $this->fetch();
    }
}
