<?php
namespace app\web\controller;

use app\web\controller\Yang;

/*作品*/

class Production extends Yang
{
    public function index()
    {
        return $this->fetch();
    }
}
