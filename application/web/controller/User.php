<?php
namespace app\web\controller;

use app\web\controller\Yang;

class User extends Yang
{
    public function index()
    {
        return $this->fetch();
    }
    public function edit()
    {
        return $this->fetch();
    }
}
