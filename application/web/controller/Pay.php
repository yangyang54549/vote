<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Bank;

class Pay extends Yang
{
    public function pay()
    {
        return $this->fetch();
    }
    public function paylog()
    {
        return $this->fetch();
    }
    public function list()
    {

        $bank = Bank::where(['user_id'=>$this->id])->order('create_time desc')->select();
        foreach ($bank as $k => $v) {
            $bank[$k]['cardnum'] = substr($v['cardnum'],-4);
        }
        $this->assign('bank',$bank);
        return $this->fetch();
    }
    public function withdraw()
    {
        return $this->fetch();
    }
    public function addbank()
    {
        return $this->fetch();
    }
    public function withdrawlog()
    {
        return $this->fetch();
    }

    public function addwithdraw()
    {
        $arr = ['code'=>-200,'data'=>'','msg'=>'添加银行卡失败'];
        if ($this->request->isAjax()) {
             $data = input();
             $user = U::where(['id'=>$this->id])->find();
             if ($user['authentication']!=2) {
                  $arr['msg'] = '请实名认证成功后再添加银行卡';
                  return json_encode($arr);
             }
             $identity = I::where(['user_id'=>$this->id])->find();
             if ($data['name']!=$identity['name']) {
                  $arr['msg'] = '真实姓名和实名认证姓名不一致';
                  return json_encode($arr);
             }
             $data['user_id'] = $this->id;
             $data['create_time'] = time();
             $add = B::insert($data);
             if ($add) {
                $arr['code'] = 1;
                $arr['msg'] = '添加银行卡成功';
                return json_encode($arr);
             }else{
                return json_encode($arr);
             }
        }else{
            return $this->fetch();
        }
    }
    public function tiwithdraw()
    {
        $arr = ['code'=>-200,'data'=>'','msg'=>'提现失败'];
        $user = U::where(['id'=>$this->id])->find();
        $rate = RA::find();
        $lilv = $rate['rate']/100;
        $kbalance=intval($user['balance']);
        if ($this->request->isAjax()) {
            $money = input('money');
            $bank_id = input('bank_id');
            $charge = substr(sprintf("%.3f",$money*($rate['rate']/100)),0,-1);
            if ($money!=intval($money)) {
              $arr['msg'] = '提现金额必须为整数';
              return json_encode($arr);
            }
            if (($money+$charge) > $kbalance) {
              $arr['msg'] = '提现金额大于可提现金额';
              return json_encode($arr);
            }
            if ($user['mobile']=='') {
             $arr['msg']='请先在设置中绑定手机号码';
             return json_encode($arr);
            }
            if($user['authentication']==0){
             $arr['msg']='请实名认证后提现';
             return json_encode($arr);
            }
            if($user['authentication']==1){
            $arr['msg']='请等待实名认证成功后提现';
             return json_encode($arr);
            }
            if ($money<99) {
              $arr['msg'] = '提现金额必须大于或等于100';
              return json_encode($arr);
            }
            // 启动事务
            Db::startTrans();
            try{

                $bank=B::where(['id'=>$bank_id])->find();
                $data['user_id'] = $this->id;
                $data['money'] = $money;
                $data['charge'] = $charge;
                $data['bank_id'] = $bank_id;
                $data['bank_name'] = $bank['bank_name'];
                $data['bank_card'] = $bank['cardnum'];
                $data['create_time'] = time();
                $data['update_time'] = time();

                $arr['msg'] = '提现申请失败!';
                $add = W::insert($data);
                $userId = W::getLastInsID();

                $row['user_id'] = $this->id;
                $row['or'] = 2;
                $row['money'] =$money;
                $row['charge'] = $charge;
                $row['comment'] = '提现';
                $row['status'] = 0;
                $row['create_time'] = time();
                $row['withdraw_id'] = $userId;
                $row['bank_id'] = $bank_id;
                $row['accomplish_time'] = 0;
                D::insert($row);

                $balance = $user['balance'] - $money - $charge;
                $id = $this->id;
                $full = U::where(['id'=> $id])->update(['balance' => $balance]);
                Session::set('user.balance',$balance);
                $arr['code'] = 1;
                $arr['msg'] = '提现申请成功';

                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
            }
            return json_encode($arr);

        }else{
            $id = input('id');
            $arr = B::where(['id'=>$id])->find();
            $arr['cardnum'] = substr($arr['cardnum'],-4);
            $arr['kbalance'] = $kbalance;
            $arr['balance'] = $user['balance'];
            $arr['lilv'] = $lilv;
            $this->assign('arr',$arr);
            return $this->fetch();
        }
    }
    // public function withdrawlog()
    // {
    //     $arr = W::where(['user_id'=>$this->id])->order('create_time desc')->select();
    //     $money = W::where(['user_id'=>$this->id,'status'=>1])->sum('money');
    //     foreach ($arr as $k => $v) {
    //       $arr[$k]['bank_card'] = substr($v['bank_card'],-4);;
    //     }
    //     $this->assign('arr',$arr);
    //     $this->assign('money',$money);
    //     return $this->fetch();
    // }



}
