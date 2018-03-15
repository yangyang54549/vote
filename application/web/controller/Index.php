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
            $recommend = Recommend::order('id desc')->limit(5)->select();
            $this->assign('barner',$barner);
            $this->assign('zui',$barner[count($barner)-1]);
            $this->assign('recommend',$recommend);
            $this->assign('limit',count($recommend));
            return $this->fetch();
        }
    }

    public function load()
    {
        if ($this->request->isAjax()) {
            $limit = input('limit');
            $qunying = Recommend::order('id desc')->limit($limit,5)->select();
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
