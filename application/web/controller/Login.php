<?php
namespace app\web\controller;

use app\web\controller\Yang;

class Login extends Yang
{
    public function login()
    {
        return $this->fetch();
    }
    public function reg()
    {
        return $this->fetch();
    }
    /*修改密码*/
    public function edit()
    {
        return $this->fetch();
    }
    /*忘记密码*/
    public function password()
    {
        return $this->fetch();
    }

}
