<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\User;
use app\common\model\Vote;
use app\common\model\Column;
use app\common\model\Type;
use app\common\model\TypeCopy;
use app\common\model\Qunying as Q;
use think\Db;

class Qunying extends Yang
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $type = input('type');
            $qunying = Q::where(['type'=>$type,'status'=>0])->order('create_time desc')->limit(10)->select();
            if(!empty($qunying)){
                $this->ret['data'] = $qunying;
                $this->ret['limit'] = count($qunying);
                $this->ret['msg'] = '加载成功';
                $this->ret['code'] = 1;
            }else{
                $this->ret['msg'] = '暂无数据';
                $this->ret['code'] = -200;
            }
            return json($this->ret);
        }else{
            $type = Type::order('father_id')->select();
            $typecopy = TypeCopy::select();
            $qunying = Q::where(['type'=>3,'status'=>0])->order('create_time desc')->limit(10)->select();
            $this->assign('type',$type);
            $this->assign('qunying',$qunying);
            $this->assign('typecopy',$typecopy);
            $this->assign('limit',count($qunying));
            return $this->fetch();
        }
    }

    public function load()
    {
        if ($this->request->isAjax()) {
            $limit = input('limit');
            $type = input('type');
            $qunying = Q::where(['type'=>$type,'status'=>0])->order('create_time desc')->limit($limit,$limit+5)->select();
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

    public function toupiao()
    {
        //记录ip,点赞作品id,点赞时间,减去user表投票次数,为0时不可投票
        if ($this->request->isAjax()) {
            $qunying_id = input('id');
            $vote = Vote::where(['user_id'=>$this->id,'qunying_id'=>$qunying_id])->whereTime('create_time','today')->find();
            $user = User::where('id',$this->id)->find();
            if (!empty($vote)) {
                $this->ret['msg'] = '您已投过票';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            if ($user['vote']<=0) {
                $this->ret['msg'] = '今日票数已用完,请明日投票';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

            // 启动事务
            Db::startTrans();
            try{
                $this->ret['code'] = -200;

                $data['user_id'] = $this->id;
                $data['qunying_id'] = $qunying_id;
                $data['ip'] = $_SERVER['REMOTE_ADDR'];
                $data['create_time'] = time();

                $this->ret['msg'] = '添加记录失败';
                Vote::insert($data);

                $this->ret['msg'] = '修改票数失败';
                Q::where('id',$qunying_id)->setInc('poll');

                $this->ret['msg'] = '修改票数失败';
                User::where('id',$this->id)->setDec('vote');
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                return json($this->ret);
                Db::rollback();
            }
            $this->ret['msg'] = '投票成功';
            $this->ret['code'] = 1;
            return json($this->ret);
        }
    }

}
