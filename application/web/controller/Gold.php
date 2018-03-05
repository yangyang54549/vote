<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Column;
use app\common\model\Type;
use app\common\model\TypeCopy;
use app\common\model\Qunying as Q;

class Gold extends Yang
{
    public function index()
    {
        $type = Type::order('father_id')->select();
        $typecopy = TypeCopy::select();
        $qunying = Q::where(['is_gold'=>0])->order('create_time desc')->select();
        //dump($qunying);die;
        $this->assign('type',$type);
        $this->assign('qunying',$qunying);
        $this->assign('typecopy',$typecopy);
        return $this->fetch();
    }
    public function info()
    {
        $id = input('id');
        $qunying = Q::where('id',$id)->find();
        $this->assign('qunying',$qunying);
        return $this->fetch();
    }
}
