<?php
namespace app\admin\model;
use think\Model;
class AuthRule extends Model{
	// 无限分类展示
	public function authRuleTree(){
		$AuthRule=$this->order('sort desc')->select();
		return $this->sort($AuthRule);
	}
	// 改造数组
	public function sort($data,$pid=0){
		static $arr=array();
		foreach ($data as $key => $value) {
			if($value['pid']==$pid){
			    $value['dataid']=$this->getParentId($value['id']);
				$arr[]=$value;
				$this->sort($data,$value['id']);
			}
		}
		return $arr;
	}
	//获取父分类id
    public function getParentId($id){
        $AuthRule = $this->select();
        return $this->_getParentid($AuthRule,$id,true);
    }
    public function _getParentid($AuthRule,$id,$clear=false){
	    static $arr = array();
        if ($clear){
            $arr = array();
        }
	    foreach ($AuthRule as $key => $value){
	        if ($value['id']==$id){
	            $arr[]=$value['id'];
	            $this->_getParentid($AuthRule,$value['pid']);
            }
        }
	    asort($arr);
	    return $str = implode('-',$arr);
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