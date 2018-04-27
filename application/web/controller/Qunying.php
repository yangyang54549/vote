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
use think\Session;
use think\Cookie;
use think\Request;

class Qunying extends Yang
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $type = input('type');
            $qunying = Q::where(['type'=>$type,'status'=>0,'is_gold'=>0])->order('create_time desc')->limit(5)->select();
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
            $qunying = Q::where(['type'=>3,'status'=>0,'is_gold'=>0])->order('create_time desc')->limit(5)->select();
            $arr = Cookie::get('toupiao');
            $arr = json_decode($arr, true);
            $arr[] = 0;
            //var_dump($arr);die;
            $request = Request::instance();
            $url=$request->domain();

            $this->assign('url',$url);
            $arrj = json_encode($arr);
            $this->assign('arrj',$arrj);
            $this->assign('arr',$arr);
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
            $qunying = Q::where(['type'=>$type,'status'=>0,'is_gold'=>0])->order('create_time desc')->limit($limit,5)->select();
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

    public function infoajax()
    {
        if ($this->request->isAjax()) {

            $id = input('id');
            $qunying = Q::where('id',$id)->find();
            $this->ret['data'] = $qunying;
            $this->ret['code'] = 1;
            return json($this->ret);
        }
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
                User::where('id',$this->id)->setInc('integral',rand(0,2));

                $arr = Cookie::get('toupiao');
                $arr = json_decode($arr, true);
                $arr[] = $qunying_id;
                Cookie::set('toupiao',json_encode($arr),2592000);

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
