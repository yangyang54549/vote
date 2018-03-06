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
        $this->assign('limit',1);

        return $this->fetch();
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
        $qunying = Q::where('id',$id)->find();
        $this->assign('qunying',$qunying);
        return $this->fetch();
    }
}
