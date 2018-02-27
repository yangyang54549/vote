<?php
namespace app\common\validate;

use think\Validate;

class Recommend extends Validate
{
    protected $rule = [
        "title|名称" => "require",
        "content|简介" => "require",
        "img|作品图片" => "require",
        "type|类型" => "require",
    ];
}
