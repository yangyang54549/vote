<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\User;

class Login extends Yang
{
    public function login()
    {
        return $this->fetch();
    }
    public function reg()
    {
        if ($this->request->isAjax()) {
            $arr = input('post.');

            // if (!isset($arr['mobile'])) {
            //     return json(['code'=>1, 'msg'=>'手机号不能为空']);
            // }
            // if (!isset($arr['yanz'])) {
            //     return json(['code'=>1, 'msg'=>'短信验证码不能为空']);
            // }
            // if ($code != Session::get($mobile)) {
            //     return json(['code'=>1, 'msg'=>'短信验证码错误']);
            // }
            // $times=Session::get($code);
            // if (time() > ($times+5*60)) {
            //     Session::delete($times);
            //     return json(['code'=>1, 'msg'=>'短信验证码已失效']);
            // }

            $users = User::where(['mobile'=>$arr['mobile']])->find();
            if (isset($users)) {
                $this->ret['msg'] = '手机号码已注册';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            $users = User::where(['id_card'=>$arr['id_card']])->find();
            if (isset($users)) {
                $this->ret['msg'] = '身份证号码已注册';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            unset($arr['yanz']);
            $arr['image'] = '/static/web/img/painting/gh/timg (7).jpg';
            $arr['create_time'] = time();
            $arr['status'] = 1;
            $arr['password'] = md5($arr['password']);
            $user = User::insert($arr);
            if($user){
                return json($this->ret);
            }else{
                $this->ret['msg'] = '注册失败,请重试';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

        }else{
            return $this->fetch();
        }
    }
    /*修改密码*/
    public function edit()
    {
        return $this->fetch();
    }
    /*忘记密码*/
    public function password()
    {
        return $this->fetch();
    }

}
