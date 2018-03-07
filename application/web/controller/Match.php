<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\User;
use app\common\model\Detail;
use app\common\model\Type;
use app\common\model\Qunying;
use think\Db;


class Match extends Yang
{
    public function index()
    {
        if ($this->request->isAjax()) {
            $user = User::where('id',$this->id)->find();
            if ($user['integral']<1000) {
                $this->ret['msg'] = '积分不足,请充值后上传作品';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

            $arr = input('');
            $arr['user_id'] = $this->id;
            $arr['user_name'] = session('user.name');
            $arr['create_time'] = time();
            $arr['status'] = 0;
            $num = time().rand(100000,999999);
            $url = "./tmp/production/".$num.".jpg";
            $base64_string = explode(',', $arr['img']);//截取data:image/png;base64, 这个逗号后的字符
            $data = base64_decode($base64_string[1]);//对截取后的字符使用base64_decode进行解码
            $a = file_put_contents($url,$data);//写入文件并保存
            if ($a == 0) {
                $this->ret['msg'] = '上传失败,请重试';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            $url = "/tmp/production/".$num.".jpg";
            $arr['img'] = $url;

            // 启动事务
            Db::startTrans();
            try{
                $this->ret['msg'] = '上传失败,请重试';
                $this->ret['code'] = -200;
                Qunying::insert($arr);
                User::where('id',$this->id)->setDec('integral',1000);
                // 提交事务
                Db::commit();
            } catch (\Exception $e) {
                // 回滚事务
                Db::rollback();
            }
            $this->ret['msg'] = '上传成功';
            $this->ret['code'] = 1;
            return json($this->ret);

        }else{
            $type = Type::select();
            $this->assign('type',$type);
            return $this->fetch();
        }
    }

    public function info()
    {
        return $this->fetch();
    }
}
