<?php
namespace app\admin\model;
use think\Model;
class Article extends Model{
	protected static function init(){
		Article::event('before_insert', function ($ArticleModel) {
			// echo '<pre>';
			// print_r($ArticleModel);
			// echo '</pre>';
			// exit;
			if($_FILES['img']['tmp_name']){
				$file = request()->file('img');
				$info = $file->move("./static/uploads/article");
				if($info){
					$ArticleModel['img']=$info->getSaveName();
				}else{
					$this->error($file->getError());
				}
			}	
		});
	}
	// 删除
	public function delA($id){
		$data=$this->find($id);
		unlink("./static/uploads/article/{$data['img']}");
		return $this::destroy($id);
	}
}