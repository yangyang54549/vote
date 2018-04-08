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

    var $font = 'static/web/fonts/kaiti.ttf'; //默认字体. 相对于脚本存放目录的相对路径.
    var $msg = "undefined"; // 默认文字.
    var $size = 35;
    var $rot = 0; // 旋转角度.
    var $pad = 30; // 填充.
    var $transparent = 0; // 文字透明度.
    var $red = 0; // 在黑色背景中...
    var $grn = 0;
    var $blu = 0;
    var $bg_red = 255; // 将文字设置为白色.
    var $bg_grn = 255;
    var $bg_blu = 255;


    public function index()
    {
        if ($this->request->isAjax()) {
            $arr = input('');
            $user = User::where('id',$this->id)->find();
            if ($user['integral']<1000) {
                $this->ret['msg'] = '积分不足,请充值后上传作品';
                $this->ret['code'] = 200;
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
            $arr['status'] = 0;

            $num = time().rand(100000,999999);

            if ($arr['isimg']==1) {
                //文字
                $str = explode(",",$arr['img']);
                $this->msg = implode("\n",$str);
                $url = "./tmp/production/".$num.".jpg";
                $a = $this->draw($url);
                if ($a != true) {
                    $this->ret['msg'] = '文字上传失败,请重试';
                    $this->ret['code'] = -200;
                    return json($this->ret);
                }
                $url = "/tmp/production/".$num.".jpg";
                $arr['img'] = $url;
            }else{
                //图片
                /*上传图片*/
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
                /*上传图片*/
            }
            unset($arr['isimg']);

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

   /*
    * desription 文字转图片
    * @param sting $imgsrc 图片路径
    * @param string $imgdst 压缩后保存路径
    */
    public function draw($dir) {
        $width = 0;
        $height = 0;
        $offset_x = 0;
        $offset_y = 0;
        $bounds = array();
        $image = "";


        // 确定文字高度.
        $bounds = ImageTTFBBox($this->size, $this->rot, $this->font, "W");
        if ($this->rot < 0) {
            $font_height = abs($bounds[7]-$bounds[1]);
        } else if ($this->rot > 0) {
            $font_height = abs($bounds[1]-$bounds[7]);
        } else {
            $font_height = abs($bounds[7]-$bounds[1]);
        }

        // 确定边框高度.
        $bounds = ImageTTFBBox($this->size, $this->rot, $this->font, $this->msg);
        if ($this->rot < 0) {
            $width = abs($bounds[4]-$bounds[0]);
            $height = abs($bounds[3]-$bounds[7]);
            $offset_y = $font_height;
            $offset_x = 0;

        } else if ($this->rot > 0) {
            $width = abs($bounds[2]-$bounds[6]);
            $height = abs($bounds[1]-$bounds[5]);
            $offset_y = abs($bounds[7]-$bounds[5])+$font_height;
            $offset_x = abs($bounds[0]-$bounds[6]);

        } else {
            $width = abs($bounds[4]-$bounds[6]);
            $height = abs($bounds[7]-$bounds[1]);
            $offset_y = $font_height;;
            $offset_x = 0;
        }

        $image = imagecreate($width+($this->pad*2)+1,$height+($this->pad*2)+1);

        $background = ImageColorAllocate($image, $this->bg_red, $this->bg_grn, $this->bg_blu);
        $foreground = ImageColorAllocate($image, $this->red, $this->grn, $this->blu);

        if ($this->transparent) ImageColorTransparent($image, $background);
        ImageInterlace($image, false);

        // 画图.
        ImageTTFText($image, $this->size, $this->rot, $offset_x+$this->pad, $offset_y+$this->pad, $foreground, $this->font, $this->msg);

        // 输出为png格式.
        imagejpeg($image,$dir,100);
        imagedestroy($image);
        return true;
    }
}
