<?php
namespace app\web\controller;

use think\Db;
use app\web\controller\Yang;
use app\common\model\Column;
use app\common\model\Type;
use app\common\model\TypeCopy;
use app\common\model\Address;
use app\common\model\Order;
use app\common\model\User;
use app\common\model\Detail;
use app\common\model\Qunying as Q;

class Gold extends Yang
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $type = input('type');
            $qunying = Q::where(['type'=>$type,'is_gold'=>1,'status'=>0])->order('create_time desc')->limit(10)->select();
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
            $qunying = Q::where(['type'=>3,'is_gold'=>1,'status'=>0])->order('create_time desc')->limit(10)->select();
            $this->assign('type',$type);
            $this->assign('qunying',$qunying);
            $this->assign('typecopy',$typecopy);
            $this->assign('limit',1);
            return $this->fetch();
        }
    }

    public function load()
    {
        if ($this->request->isAjax()) {
            $limit = input('limit');
            $type = input('type');
            $qunying = Q::where(['type'=>$type,'is_gold'=>1,'status'=>0])->order('create_time desc')->limit($limit,$limit+5)->select();
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

    public function yupay()
    {
        if ($this->request->isAjax()) {
            $arr = input();
            $user = User::where('id',$this->id)->find();
            $qunying = Q::where('id',$arr['sp_id'])->find();
            if ($qunying['status'] == 1 || $qunying['is_sell'] == 1) {
                $this->ret['msg'] = '商品不在出售状态';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

            if ($user['integral']<$qunying['integral']) {
                $this->ret['msg'] = '积分不足,请充值';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

            $arr['number'] = time().rand(100000,999999);
            $arr['user_id'] = $this->id;
            $arr['set_user_id'] = $qunying['user_id'];
            $arr['sp_name'] = $qunying['title'];
            $arr['img'] = $qunying['img'];
            $arr['integral'] = $qunying['integral'];
            $arr['create_time'] = time();

            // 启动事务
            Db::startTrans();
            try{
                $this->ret['msg'] = '购买失败';
                $this->ret['code'] = -200;

                $order = Order::insert($arr);
                User::where('id',$this->id)->setDec('integral',$qunying['integral']);
                Q::where('id',$arr['sp_id'])->update(['status'=>1,'is_sell'=>1]);

                $row['user_id'] = $this->id;
                $row['or'] = 3;
                $row['money'] =$qunying['integral']/100;
                $row['integral'] =$qunying['integral'];
                $row['comment'] = '购买';
                $row['status'] = 1;
                $row['create_time'] = time();
                Detail::insert($row);
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                return json($this->ret);
                Db::rollback();
            }
            $this->ret['msg'] = '购买成功';
            $this->ret['code'] = 1;
            return json($this->ret);
        }else{
            $id = input('id');
            $qunying = Q::where('id',$id)->find();
            $address = Address::where(['user_id'=>$this->id])->order('is_default desc')->select();
            $this->assign('qunying',$qunying);
            $this->assign('address',$address);
            return $this->fetch();
        }
    }
}
