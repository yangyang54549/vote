<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\User as U;
use think\Session;

class User extends Yang
{
    public function index()
    {
        $user = U::where('id',$this->id)->find();
        $this->assign('user',$user);
        return $this->fetch();
    }
    public function edit()
    {
        if ($this->request->isAjax()) {
            $arr = input('');
            if (strpos($arr['image'],'data:image') !== false) {
                $num = time().rand(100000,999999);
                $url = "./tmp/head/".$num.".jpg";
                $base64_string = explode(',', $arr['image']);//截取data:image/png;base64, 这个逗号后的字符
                $data = base64_decode($base64_string[1]);//对截取后的字符使用base64_decode进行解码
                $a = file_put_contents($url,$data);//写入文件并保存
                if ($a == 0) {
                    $this->ret['msg'] = '上传头像失败,请重试';
                    $this->ret['code'] = -200;
                    return json($this->ret);
                }
                $url = "/tmp/head/".$num.".jpg";
                $arr['image'] = $url;
            }else{
                unset($arr['image']);
            }
            $user = U::where('id',$this->id)->update($arr);
            if($user===false){
                $this->ret['msg'] = '修改失败,请重试';
                $this->ret['code'] = -200;
                return json($this->ret);
            }else{
                return json($this->ret);
            }

        }else{
            $user = U::where('id',$this->id)->find();
            $this->assign('user',$user);
            return $this->fetch();
        }
    }

    public function tui()
    {
        $this->assign('invite',$this->id);
        return $this->fetch();
    }
}
