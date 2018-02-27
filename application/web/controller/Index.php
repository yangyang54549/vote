<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Barner;
use app\common\model\Column;
use app\common\model\Recommend;

class Index extends Yang
{
    public function index()
    {
        if ($this->request->isAjax()) {

        }else{
            $barner = Barner::select();
            // $column = Column::select();
            $recommend = Recommend::select();
            $this->assign('barner',$barner);
            // $this->assign('column',$column);
            $this->assign('recommend',$recommend);
            return $this->fetch();
        }
    }
    public function info()
    {
        $id = input('id');
        $recommend = Recommend::where('id',$id)->find();
        $this->assign('recommend',$recommend);
        return $this->fetch();
    }
}
