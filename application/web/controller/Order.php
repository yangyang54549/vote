<?php
namespace app\web\controller;

use think\Db;
use app\web\controller\Yang;
use app\common\model\User;
use app\common\model\Qunying;
use app\common\model\Address;
use app\common\model\Order as O;
use app\common\model\Detail;

class Order extends Yang
{
    public function index()
    {
        $order = O::where(['user_id'=>$this->id])->select();
        $this->assign('order',$order);
        return $this->fetch();
    }
    public function info()
    {
        $id = input('id');
        $order = O::where('id',$id)->find();
        $qunying = Qunying::where('id',$order['sp_id'])->find();
        $address = Address::where('id',$order['ress'])->find();

        $this->assign('order',$order);
        $this->assign('qunying',$qunying);
        $this->assign('address',$address);
        return $this->fetch();
    }
    //买家确认收获后 卖家可以得到积分
    public function affirm()
    {
        $id = input('id');
        // 启动事务
        Db::startTrans();
        try{
            $this->ret['msg'] = '确认失败请重试';
            $this->ret['code'] = -200;
            $orders = O::where('id',$id)->find();
            O::where(['id'=>$id])->update(['status'=>3,'yes_time'=>time()]);
            User::where('id',$orders['set_user_id'])->setInc('integral',$orders['integral']);

            $user = User::where('id',$this->id)->find();
            if ($user['referrer'] != 0) {
                $integral = intval($orders['integral']*0.05);
                User::where('id',$user['referrer'])->setInc('integral', $integral);
                $row['user_id'] = $user['referrer'];
                $row['or'] = 4;
                $row['money'] = $integral/100;
                $row['integral'] =$integral;
                $row['comment'] = '推荐购买返利';
                $row['status'] = 1;
                $row['create_time'] = time();
                Detail::insert($row);

                $referrer = User::where('id',$user['referrer'])->find();
                if ($referrer['referrer'] != 0) {
                    User::where('id',$referrer['referrer'])->setInc('integral', $integral);
                    $row['user_id'] = $referrer['referrer'];
                    $row['or'] = 4;
                    $row['money'] = $integral/100;
                    $row['integral'] =$integral;
                    $row['comment'] = '推荐购买返利';
                    $row['status'] = 1;
                    $row['create_time'] = time();
                    Detail::insert($row);
                }
            }

            $row['user_id'] = $orders['set_user_id'];
            $row['or'] = 4;
            $row['money'] = $orders['integral']/100;
            $row['integral'] =$orders['integral'];
            $row['comment'] = '字画交易';
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
        $this->ret['msg'] = '确认成功!';
        $this->ret['code'] = 1;
        return json($this->ret);
    }
}
