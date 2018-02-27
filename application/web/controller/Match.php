<?php
namespace app\web\controller;

use app\web\controller\Yang;

class Match extends Yang
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
