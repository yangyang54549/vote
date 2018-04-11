<?php
/**
 * @Author: Marte
 * @Date:   2018-01-07 13:49:50
 * @Last Modified by:   Marte
 * @Last Modified time: 2018-04-10 10:37:21
 */
namespace  app\common\getuser;
use think\Session;
use think\Cookie;
use app\common\model\User;
/**
* 微信授权获取用户信息
*/
class Getuser
{

    public $appid = '';
    public $redirect_uri = '';
    public $scope = '';
    public $state = '';
    public $secret = '';//  公众号的appsecret

    function __construct()
    {
    $this->appid = 'wx34fd656d22bef335';
    $this->redirect_uri = urlencode(URLL.url('login/openid'));
    $this->scope = 'snsapi_base';
    $this->state = 'succeed';
    $this->secret = '2a49e37063dc57c44bc342c83935e9c2';
    }
    /*
     * 请求授权地址
     */
    public function geturl($url=0)
    {
            $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->appid.'&redirect_uri='.$this->redirect_uri.'&response_type=code&scope='.$this->scope.'&state='.$this->state.'#wechat_redirect';
            return $url;
    }
    /*
     * 网页授权access_token地址
     */
    public function getaccess_token($code)
    {
          $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid."&secret=".$this->secret."&code=".$code."&grant_type=authorization_code";
          $date = $this->curlget($url);
            if ($date) {
                if (isset($date['access_token'])) {
                    return $date['openid'];
                }
            }
           return false;
    }

    /*
     * 获取用户信息
     */
    public function getuserinfo($access_token,$openid)
    {
        $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$access_token."&openid=".$openid."&lang=zh_CN";
        $userinfo = $this->curlget($url);
        if ($userinfo) {
            if (isset($userinfo['openid'])) {
                //将用户信息写入数据库 如果注册过查询出数据存入session
                if (!empty(Session::get('user.id')) && empty(Session::get('user.openid'))) {
                    $upd['openid'] = $userinfo['openid'];
                    $upd['name'] = $userinfo['nickname'];
                    $upd['image'] = $userinfo['headimgurl'];
                    User::where(['id'=>Session::get('user.id')])->update($upd);
                    Session::set('user.openid',$userinfo['openid']);
                    Session::set('user.name',$userinfo['nickname']);
                    Session::set('isopenid',1);
                    return true;
                }
                $user = User::where(['openid'=>$userinfo['openid']])->find();
                if (isset($user)) {
                    $user_login = rand('10000000','99999999');
                    User::where(['openid'=>$userinfo['openid']])->update(['user_login'=>$user_login]);
                    $user['user_login'] = $user_login;
                    Session::set('user',$user);
                    Cookie::set('user_id',$user['id'],2592000);
                    return true;
                }else{
                    $arr['openid'] = $userinfo['openid'];
                    $arr['name'] = $userinfo['nickname'];
                    $arr['image'] = $userinfo['headimgurl'];
                    $arr['create_time'] = time();
                    $arr['integral'] = 1000;
                    $arr['user_type'] = 1;
                    $arr['status'] = 1;
                    $arr['login_time'] = time();
                    $arr['invite_time'] = time();
                    $arr['referrer'] = Session::get('referrer') ? Session::get('referrer') : 0;
                    $arr['isdelete'] = 0;
                    $arr['authentication'] = 0;
                    User::insert($arr);
                    $userx = User::where(['openid'=>$userinfo['openid']])->find();

                    $user_login = rand('10000000','99999999');
                    User::where(['openid'=>$userinfo['openid']])->update(['user_login'=>$user_login]);
                    $userx['user_login'] = $user_login;

                    $ups = UP::where(['id'=>1])->find();
                    $up['user_id'] =  $userx['id'];
                    $up['number'] =  $ups['number'];
                    $up['money'] =  $ups['money'];
                    $up['remark'] = $ups['remark'];
                    $up['full'] = $ups['full'];
                    UP::insert($up);

                    Session::set('user',$userx);
                    Cookie::set('user_id',$userx['id'],2592000);
                    return true;
                }
            }
        }
        return false;
    }

    public function curlget($url)
    {
            file_put_contents("test.txt", $url);
            //初始化curl
            $ch = curl_init($url);
            //设置超时
            curl_setopt($ch, CURLOPT_TIMEOUT,30);
            curl_setopt($ch, CURLOPT_HEADER,FALSE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER,TRUE);
            //运行curl，结果以jason形式返回
            $res = curl_exec($ch);
            curl_close($ch);
            file_put_contents("test.txt", $res);
         //　　//打印获得的数据
             $data=json_decode($res,true);
             return $data;
    }
}