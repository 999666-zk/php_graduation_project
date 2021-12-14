<?php 
namespace app\admin\validate;
use think\validate;
class Author extends validate{
	//验证规则
	protected $rule=[
		'name'=>'unique:Author|require',
	];
	// 验证消息
	protected $message=[
		'name:require'=>'名称不能为空',
		'name:unique'=>'名称不能重复',
	];
	// 验证场景
	protected $scene=[
		'add'=>['name'],
	];
}