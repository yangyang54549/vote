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
            $arr = input('');
            $user = User::where('id',$this->id)->find();
            if ($user['integral']<1000) {
                $this->ret['msg'] = '积分不足,请充值后上传作品';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

            $qunying = Qunying::whereTime('create_time', 'today')->where(['type'=>$arr['type'],'status'=>1,'is_gold'=>0])->count();
            if ($qunying>99) {
                $this->ret['msg'] = '每天每个栏目限制上传100幅作品';
                $this->ret['code'] = -200;
                return json($this->ret);
            }

            $dateStr = date('Y-m-d', time());
            $timestamp24 = strtotime($dateStr) + 86402;

            $arr['user_id'] = $this->id;
            $arr['create_time'] = time();
            $arr['time'] = $timestamp24;
            $arr['status'] = 1;
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

            $url = "./tmp/production/".$num.".jpg";
            $urlsuo = "./tmp/production/".$num."suo.jpg";
            $suo = $this->image_png_size_add($url,$urlsuo);

            if (!$suo) {
                $this->ret['msg'] = '上传缩略图失败,请重试';
                $this->ret['code'] = -200;
                return json($this->ret);
            }
            $urlsuo = "/tmp/production/".$num."suo.jpg";
            $arr['suoimg'] = $urlsuo;

            // 启动事务
            Db::startTrans();
            try{
                $this->ret['msg'] = '上传失败,请重试';
                $this->ret['code'] = -200;
                Qunying::insert($arr);
                User::where('id',$this->id)->setDec('integral',1000);

                $row['user_id'] = $this->id;
                $row['or'] = 3;
                $row['money'] =10;
                $row['integral'] =1000;
                $row['comment'] = '上传作品';
                $row['status'] = 1;
                $row['create_time'] = time();
                Detail::insert($row);

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
            $type = Type::order('father_id')->select();
            $this->assign('type',$type);
            return $this->fetch();
        }
    }

    public function info()
    {
        return $this->fetch();
    }


   /*
    * desription 压缩图片
    * @param sting $imgsrc 图片路径
    * @param string $imgdst 压缩后保存路径
    */
    public function image_png_size_add($imgsrc,$imgdst){
      list($width,$height,$type)=getimagesize($imgsrc);
      //等比例缩小

      $new_width = 400;
      $new_height = $height/($width/400);

      // $new_width = 200;
      // $new_height =1500;

      switch($type){
        case 1:

            $image_wp=imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromgif($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst,100);
            imagedestroy($image_wp);
            return true;
            break;
        case 2:

            $image_wp=imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst,100);
            imagedestroy($image_wp);
            return true;
            break;
        case 3:

            $image_wp=imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefrompng($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst,100);
            imagedestroy($image_wp);
            return true;
            break;
        default:

            return false;
      }
      return false;
    }

}
