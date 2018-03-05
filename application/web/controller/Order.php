<?php
namespace app\web\controller;

use app\web\controller\Yang;
use app\common\model\Order as O;

class Order extends Yang
{
    public function index()
    {
        return $this->fetch();
    }
    public function info()
    {
        return $this->fetch();
    }
}
