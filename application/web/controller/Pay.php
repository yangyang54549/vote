<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Bank;
use app\common\model\User;
use app\common\model\Detail;
use think\Db;

class Pay extends Yang
{
    public function pay()
    {
        return $this->fetch();
    }
    public function paylog()
    {
        $arr = Detail::where(['user_id'=>$this->id,'or'=>1])->order('create_time desc')->select();
        $this->assign('arr',$arr);
        return $this->fetch();
    }
    public function lists()
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
        if ($this->request->isAjax()) {
            $arr = input('');
            $rate = db('rate')->find();
            $user = User::where(['id'=>$this->id])->find();
            if ($arr['money']!=intval($arr['money'])) {
                  $this->ret['msg'] = '提现金额必须为整数';
                  $this->ret['code'] = -200;
                  return json($this->ret);
            }
            if ($arr['money'] > $user['integral']/100) {
                  $this->ret['msg'] = '提现金额大于可提现金额';
                  $this->ret['code'] = -200;
                  return json($this->ret);
            }
            if ($arr['money']<99) {
                $this->ret['msg'] = '提现金额必须大于或等于100';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            $charge = intval($arr['money']*$rate['rate']);
            $money = $charge+$arr['money']*100;
            if ($money>$user['integral']) {
                $this->ret['msg'] = '手续费和提现金额不可超过余额';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            // 启动事务
            Db::startTrans();
            try{
                $this->ret['msg'] = '提现失败';
                $this->ret['code'] = -200;
                $bank=Bank::where(['id'=>$arr['bank_id']])->find();
                $row['user_id'] = $this->id;
                $row['or'] = 2;
                $row['money'] =$arr['money'];
                $row['integral'] =$arr['money']*100;
                $row['charge'] = $charge/100;
                $row['comment'] = '提现';
                $row['status'] = 0;
                $row['create_time'] = time();
                $row['bank_id'] = $arr['bank_id'];
                $row['bank_name'] = $bank['bank_name'];
                $row['bank_card'] = $bank['cardnum'];
                Detail::insert($row);

                $integral = $user['integral'] - $money;
                $full = User::where(['id'=> $this->id])->update(['integral' => $integral]);
                $this->ret['msg'] = '提现申请成功';
                $this->ret['code'] = 1;
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
            }
            return json($this->ret);
        }else{
            $id = input('id');
            $user = User::where(['id'=>$this->id])->find();
            $bank = Bank::where(['id'=>$id])->find();
            $bank['cardnum'] = substr($bank['cardnum'],-4);
            $this->assign('user',$user);
            $this->assign('bank',$bank);
            return $this->fetch();
        }
    }
    public function addbank()
    {
        if ($this->request->isAjax()) {
             $arr = input('');
             $user = User::where(['id'=>$this->id])->find();
             if ($arr['name']!=$user['id_name']) {
                  $this->ret['msg'] = '真实姓名和实名认证姓名不一致';
                  $this->ret['code'] = -200;
                  return json($this->ret);
             }
             $arr['user_id'] = $this->id;
             $arr['image'] = "/static/web/img/png/".$arr['image'].".png";
             $arr['create_time'] = time();
             $add = Bank::insert($arr);
             if ($add) {
                  $this->ret['msg'] = '添加银行卡成功';
                  return json($this->ret);
             }else{
                  $this->ret['msg'] = '添加银行卡失败';
                  $this->ret['code'] = -200;
                  return json($this->ret);
             }
        }else{
            return $this->fetch();
        }
    }
    public function withdrawlog()
    {
        $arr = Detail::where(['user_id'=>$this->id,'or'=>2])->order('create_time desc')->select();
        foreach ($arr as $k => $v) {
            $arr[$k]['bank_card'] = substr($v['bank_card'],-4);
            $arr[$k]['bank_name'] = $v['bank_name'];
        }
        $this->assign('arr',$arr);
        return $this->fetch();
    }
    public function delete()
    {
        if ($this->request->isAjax()) {
            $id = input('id');
            $detail = Detail::where(['bank_id'=>$id,'status'=>0])->find();
            if (!empty($detail)) {
              $this->ret['msg'] = '删除失败,您有提现申请还未审核';
              $this->ret['code'] = -200;
              return json($this->ret);
            }
            $bank=Bank::where(['id'=>$id])->delete();
            if ($bank) {
              $this->ret['msg'] = '删除成功';
              return json($this->ret);
            }else{
              $this->ret['msg'] = '删除失败';
              $this->ret['code'] = -200;
              return json($this->ret);
            }
        }
    }

}
