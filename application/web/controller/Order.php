<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Qunying;
use app\common\model\Address;
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
        $id = input('id');
        $order = O::where('id',$id)->find();
        $qunying = Qunying::where('id',$order['sp_id'])->find();
        $address = Address::where('id',$order['ress'])->find();

        $this->assign('order',$order);
        $this->assign('qunying',$qunying);
        $this->assign('address',$address);
        return $this->fetch();
    }
}
