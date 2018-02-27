<?php
namespace app\web\controller;

use app\web\controller\Yang;

class Address extends Yang
{
    public function index()
    {
        return $this->fetch();
    }
    public function add()
    {
        return $this->fetch();
    }
    public function edit()
    {
        return $this->fetch();
    }
}
