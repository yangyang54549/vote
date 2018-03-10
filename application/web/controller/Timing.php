<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\User;
use app\common\model\Type;
use app\common\model\Qunying;

class Timing extends Yang
{
    public function index()
    {
        //每天每个栏目点赞数前十名进入第二天(清除票数),其他改变状态,把时间创建是昨天的作品改变状态
        //每个用户每天有三票
        $Type = Type::select();
        foreach ($Type as $key => $value) {
            $dateStr = date('Y-m-d', time());
            //前十名保留
            Qunying::where(['is_gold'=>0,'status'=>0,'type'=>$value['id']])
            ->order('poll desc')
            ->limit(10)
            ->update(['time'=>strtotime($dateStr)+2,'poll'=>0]);
            //十名后改变状态
            Qunying::where(['is_gold'=>0,'status'=>0,'type'=>$value['id']])
            ->order('poll desc')
            ->limit(10,999)
            ->update(['status'=>1]);
        }
        //昨天上传的作品改变状态
        Qunying::where(['is_gold'=>0,'status'=>1])->whereTime('create_time', 'yesterday')->update(['status'=>0]);
        //每个用户每天三票
        User::update(['vote'=>3]);
    }

    public function gold()
    {
        //把每个栏目前十名放进黄金榜
        $Type = Type::select();
        foreach ($Type as $key => $value) {
            $dateStr = date('Y-m-d', time());
            //前十名保留
            Qunying::where(['is_gold'=>0,'status'=>0,'type'=>$value['id']])
            ->order('poll desc')
            ->limit(10)
            ->update(['is_gold'=>1]);
            //十名后改变状态
            Qunying::where(['is_gold'=>0,'status'=>0,'type'=>$value['id']])
            ->order('poll desc')
            ->limit(10,999)
            ->update(['status'=>1]);
        }
    }

}
