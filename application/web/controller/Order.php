<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Order as O;

class Order extends Yang
{
    public function index()
    {

        $order = O::where(['user_id'=>$this->id])->select();
        $this->assign('order',$order);
        return $this->fetch();
    }
    public function info()
    {
        return $this->fetch();
    }
}
