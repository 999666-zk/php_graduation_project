<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\Model\Colum as ColumModel;
class Colum extends Controller{
	public function index(){
		$colum=new ColumModel;
		if(Request()->isPost()){
			$data=input('post.');
			foreach ($data as $key => $value) {
				db('colum')->update(['id'=>$key,'sort'=>$value]);
			}
			$this->success('排序更新成功',url('index'));
		}else{
			// 栏目分类展示
			$data=$colum->coltree();
			$this->assign('data',$data);
			$count=$colum->count();
			$this->assign('count',$count);
			return view();
		}
	}
	// 添加
	public function add(){
		$colum=new ColumModel;
		if(Request()->isPost()){
			$data=input("post.");
			$validate=\think\Loader::validate('Colum');
			if(!$validate->scene('add')->check($data)){
				$this->error($validate->getError());
			}
			$res=$colum->save($data);
			if($res){
				$this->success("添加成功",url('index'));
			}else{
				$this->error('添加失败');
			}
		}else{
			// 栏目分类展示
			$data=$colum->coltree();
			$this->assign('data',$data);
			return view();
		}
		
	}
	// 前置操作
	protected $beforeActionList=[
		'delson'=>['only'=>'del'],
	];
	public function delson(){
		$id=input('id');
		$colum=new ColumModel;
		$idx=$colum->getChildId($id);
		if($idx){
			db('colum')->delete($idx);
		}
	}
	// 删除
	public function del($id){
		$colum=new ColumModel;
		$res=$colum->delcol($id);
		if($res){
			$this->success('删除成功',url('index'));
		}else{
			$this->error('删除失败');
		}
	}
	// 修改
	public function update($id){
		$colum=new ColumModel;
		if(Request()->isPost()){
			$data=input('post.');
			$res=$colum->save($data,['id'=>$id]);
			if($res){
				$this->success('修改成功',url('index'));
			}else{
				$this->error('修高失败');
			}
		}else{
			$fdata=db('colum')->find($id);
			$this->assign('fdata',$fdata);
			
			// 栏目分类展示
			$data=$colum->coltree();
			$this->assign('data',$data);
			return view();
		}
		
	}
}