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
            // dump($barner[2]);die;
            $this->assign('zui',$barner[count($barner)-1]);
            // $this->assign('column',$column);
            $this->assign('recommend',$recommend);
            return $this->fetch();
        }
    }

    public function load()
    {
        if ($this->request->isAjax()) {
            $limit = input('limit');
            $qunying = Q::order('create_time desc')->limit($limit,$limit+5)->select();
            if(!empty($qunying)){
                $this->ret['data'] = $qunying;
                $this->ret['limit'] = $limit+count($qunying);
                $this->ret['msg'] = '加载成功';
                $this->ret['code'] = 1;
            }else{
                $this->ret['msg'] = '暂无数据';
                $this->ret['code'] = -200;
            }
            return json($this->ret);
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
