<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\User;
use think\Session;
use app\common\getuser\Getuser;

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
            $arr['status'] = 0;//0为未支付一元激活
            $arr['vote'] = 3;
            $arr['password'] = md5($arr['password']);
            $user = User::insert($arr);

            User::where('id',$arr['referrer'])->setInc('integral', 30);
            $referrer = User::where('id',$arr['referrer'])->find();
            if ($referrer['referrer'] != 0) {
                User::where('id',$referrer['referrer'])->setInc('integral', 10);
            }
            if($user){
                return json($this->ret);
            }else{
                $this->ret['msg'] = '注册失败,请重试';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

        }else{
            $referrer = input('referrer');
            if (!empty($referrer)) {
                $this->assign('referrer',$referrer);
            }
            return $this->fetch();
        }
    }
    //注册完成后跳转到此页面获取用户openid
    public function openid()
    {
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
            $code = input('code');
            $getuser = new Getuser;
            if (isset($code)) {

                $result = $getuser->getaccess_token($code);
                if ($result) {
                    User::where('id',$this->id)->update(['openid'=>$result]);
                    Session::set('user.openid',$result);
                    $this->redirect(url('login/one'));
                }else{
                    echo "微信获取失败,请从新登录!";
                }
            }else{
                $url = $getuser->geturl();
                $this->redirect($url);
            }
        }else{
            echo "请在微信内打开,激活帐号";
        }
    }
    /*注册后支付一元*/
    public function one()
    {
        $url = URLL;
        $this->assign('url',$url);
        return $this->fetch();
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
     * 短信公共方法 根据不同model使用不同的模版
     * mobile 手机号码
     * model 1登录 2注册 3忘记密码修改密码 4修改支付密码 5修改手机号码
     */
    public function message($mobile,$model)
    {
        $cons = '';
        $randStr = str_shuffle('1234567890');
        $rand = substr($randStr,0,6);

        if ($model==1) {
            $cons = "【诗词书画鉴赏】您正在修改密码,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }elseif($model==3){
            $cons = "【诗词书画鉴赏】您正在绑定手机号码,验证码是:".$rand."，5分钟后过期，请您及时验证!";
        }

        Session::set($mobile,$rand);
        Session::set($rand,time());
        $url='http://117.78.52.216:9003';//系统接口地址
        $conss = iconv('UTF-8', 'gbk', $cons);
        $content=urlencode($conss);
        $username="13613820359";//用户名
        $password="ODIwMzU5";//密码百度BASE64加密后密文
        $url=$url."/servlet/UserServiceAPI?method=sendSMS&extenno=&isLongSms=0&username=".$username."&password=".$password."&smstype=0&mobile=".$mobile."&content=".$content;
        $data = $this->concurl($url);
        return $data;
    }
    /*
     * 发送get请求
     */
    public function concurl($url)
    {
            //初始化curl
            $ch = curl_init($url);
            //设置超时
            curl_setopt($ch, CURLOPT_TIMEOUT,30);
            curl_setopt($ch, CURLOPT_HEADER,FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
            //运行curl，结果以jason形式返回
            $res = curl_exec($ch);
            curl_close($ch);
         //　　//打印获得的数据
             //$data=json_decode($res,true);
             return $res;
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
