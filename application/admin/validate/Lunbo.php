<?php 
namespace app\admin\validate;
use think\validate;
class Lunbo extends validate{
	//验证规则
	protected $rule=[
		'img'=>'require|unique:Lunbo',
	];
	// 验证消息
	protected $message=[
        'img:unique'=>'图片不能重复',
		'img:require'=>'图片不能为空',
	];
	// 验证场景
	protected $scene=[
		'add'=>['img'],
	];
}