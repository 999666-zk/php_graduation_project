<?php
namespace app\admin\model;
use think\Model;
class Author extends Model{
	// 添加
	public function addA($arr){
		if($this->save($arr)){
			return true;
		}else{
			return false;
		}
	}
	// 删除
	public function delA($id){
		$data=$this->find($id);
		unlink("./static/uploads/author/{$data['photo']}");
		return $this::destroy($id);
	}
}