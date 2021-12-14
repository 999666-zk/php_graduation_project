<?php
namespace app\admin\model;
use think\Model;
class Lunbo extends Model{
	// 添加
	public function addL($arr){
		if($this->save($arr)){
			return true;
		}else{
			return false;
		}
	}
/*	// 删除
	public function delL($id){
		$data=$this->find($id);
		unlink("./static/uploads/lunbo/{$data['img']}");
		return $this::destroy($id);
	}*/
    // 删除
    public function delM($id){
        return $this::destroy($id);
    }
}