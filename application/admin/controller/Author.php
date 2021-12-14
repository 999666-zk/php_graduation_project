<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Author as AuthorModel;
class Author extends Controller{
	public function index(){
		$data=db('Author')->select();
		$this->assign('data',$data);
		return view();
	}
	// 文件上传
	public function ajax_upload(){
		$file = request()->file('file');
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move("./static/uploads/author");
		if($info){
			// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
			echo $info->getSaveName();
		}else{
			// 上传失败获取错误信息
			echo $file->getError();
		}
	}
	// 添加
	public function add(){
		$AuthorModel=new AuthorModel;
		//验证
		$validate=\think\Loader::validate('Author');
		if(!$validate->scene('add')->check(input('post.'))){
			$this->error($validate->getError());
		}
		$res=$AuthorModel->addA(input('post.'));
		if($res){
			$this->success('添加成功',url('index'));
		}else{
			$this->error('添加失败');
		}
	}
	// 删除
	public function del($id){
		$AuthorModel=new AuthorModel;
		$res=$AuthorModel->delA($id);
		if($res){
			$this->success('删除成功',url('index'));
		}else{
			$this->error('删除失败');
		}
	}
	// 修改
	public function update($id){
		if(request()->isPost()){
			$data=input("post.");
			if(!$data['photo']){
				$data['photo']=$data['oldimg'];
			}else{
				unlink("./static/uploads/author/{$data['oldimg']}");
			}
			unset($data['oldimg']);
			$AuthorModel=new AuthorModel;
			$res=$AuthorModel->save($data,['id'=>$id]);
			if($res){
				$this->success('修改成功',url('index'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$data=db('author')->find($id);
			$this->assign('data',$data);
			return view();
		}
	}
	// 排序
	public function sort(){
		$data=input("post.");
		$AuthorModel=new AuthorModel;
		$res=$AuthorModel->save($data,['id'=>$data['id']]);
		if($res){
			echo 1;
		}else{
			echo 2;
		}
	}
}