<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Qunying;

/*作品*/

class Production extends Yang
{
    public function index()
    {
        $qunying = Qunying::where('user_id',$this->id)->order('create_time desc')->select();
        $this->assign('qunying',$qunying);
        return $this->fetch();
    }
}
