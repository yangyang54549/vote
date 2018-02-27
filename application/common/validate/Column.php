<?php
namespace app\common\validate;

use think\Validate;

class Column extends Validate
{
    protected $rule = [
        "name|栏目名称" => "require",
        "sort|排序" => "require",
    ];
}
