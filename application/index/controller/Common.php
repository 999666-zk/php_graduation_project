<?php 
namespace app\index\controller;
use think\Controller;
class Common extends Controller{
	// 初始化
	public function _initialize(){
		// 配置
		$data=db('Conf')->select();
		$conf=array();
		foreach ($data as $key => $value) {
			$conf[$value['ename']]=$value['val'];
		}
		$this->assign('conf',$conf);
	}
}