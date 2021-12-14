<?php
namespace app\admin\model;
use think\Model;
class Colum extends Model{
	// 无限分类展示
	public function coltree(){
		$col=$this->order('sort desc')->select();
		return $this->sort($col);
	}
	// 改造数组
	public function sort($data,$pid=0,$level=0){
		static $arr=array();
		foreach ($data as $key => $value) {
			if($value['pid']==$pid){
				$value['level']=$level;
				$arr[]=$value;
				$this->sort($data,$value['id'],$level+2);
			}
		}
		return $arr;
	}

	// 获取子分类id
	public function getChildId($id){
		$col=$this->select();
		return $this->_getChildId($col,$id);

	}
	public function _getChildId($col,$id){
		static $arr=array();
		foreach ($col as $key => $value) {
			if($value['pid']==$id){
				$arr[]=$value['id'];
				$this->_getChildId($col,$value['id']);
			}
		}
		return $arr;
	}
	// 删除
	public function delcol($id){
		if($this::destroy($id)){
			return true;
		}else{
			return false;
		}
	}
}