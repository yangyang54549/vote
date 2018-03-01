<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Address as A;
use think\Db;

class Address extends Yang
{
    public function index()
    {
        $address = A::where('user_id',$this->id)->select();
        $this->assign('address',$address);
        return $this->fetch();
    }
    public function add()
    {
        if ($this->request->isAjax()) {
            $arr = input('');

            if ($arr['is_default']==1) {
                A::where('user_id',$this->id)->update(['is_default'=>0]);
            }

            $arr['user_id'] = $this->id;
            $arr['create_time'] = time();
            $address = A::insert($arr);
            if($address){
                return json($this->ret);
            }else{
                $this->ret['msg'] = '添加失败,请重试';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

        }else{
            return $this->fetch();
        }
    }
    public function edit()
    {
        if ($this->request->isAjax()) {
            $arr = input('');
            if ($arr['is_default']==1) {
                A::where('user_id',$this->id)->update(['is_default'=>0]);
            }
            $address = A::update($arr);
            if($address){
                return json($this->ret);
            }else{
                $this->ret['msg'] = '修改失败,请重试';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
        }else{
            $id = input('id');
            $address = A::where('id',$id)->find();
            $this->assign('address',$address);
            return $this->fetch();
        }
    }

    public function delete()
    {
        if ($this->request->isAjax()) {
            $id = input('id');
            $address = Db::table('tp_address')->delete($id);
            if($address){
                return json($this->ret);
            }else{
                $this->ret['msg'] = '删除失败,请重试';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
        }
    }
}
