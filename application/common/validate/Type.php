<?php
namespace app\common\validate;

use think\Validate;

class Type extends Validate
{
    protected $rule = [
        "name|书画类型" => "require",
    ];
}
