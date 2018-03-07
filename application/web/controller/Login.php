<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\User;
use think\Session;

class Login extends Yang
{
    public function login()
    {
        if ($this->request->isAjax()) {
            $arr = input('post.');
            $user = User::where(['mobile'=>$arr['mobile'],'password'=>md5($arr['password'])])->find();
            if (!isset($user)) {
                $this->ret['msg'] = '密码错误';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            Session::set('user',$user);
            return json($this->ret);

        }else{
            return $this->fetch();
        }
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
            $arr['integral'] = 100;
            $arr['image'] = '/static/web/img/painting/gh/timg (7).jpg';
            $arr['create_time'] = time();
            $arr['status'] = 0;
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
      if ($this->request->isAjax() && $this->request->isPost()){
            $arr = input('post.');

            if (!$arr['password']) {
                $this->ret['msg'] = '密码不能为空';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            if (!$arr['mobile']) {
                $this->ret['msg'] = '手机号不能为空';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            //$scode = empty($_SESSION['code'][$mobile]['code']) ? '' : $_SESSION['code'][$mobile]['code'];
            //$stime = empty($_SESSION['code'][$mobile]['time']) ? 0 : $_SESSION['code'][$mobile]['time'];
            //if (!$scode || $scode != $messcode) {
            //   echo json_encode(array('code'=>-200,'msg'=>'短信验证码错误'));exit;
            //}
            // if ($scode && $scode == $messcode) {
            //     if (time() > ($stime + 5*60)) {
            //         echo json_encode(array('code'=>-200,'msg'=>'短信验证码已失效'));exit;
            //     }
            // }
            unset($arr['yanz']);

            $res = User::where(['mobile'=>$arr['mobile']])->find();

            if (isset($res)) {
                $ress = User::where(['mobile'=>$arr['mobile']])->update(['password'=>md5($arr['password'])]);
                return json($this->ret);
            }else{
                $this->ret['msg'] = '用户不存在';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            $this->ret['msg'] = '重置密码失败';
            $this->ret['code'] = -200;
            return json($this->ret);

        }else{
            return $this->fetch();
        }
    }
    /*
     * 退出
     */
    public function noadmin()
    {
       Session::delete('user');
       $this->redirect('Index/index');
    }
}
