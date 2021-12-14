<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Conf as ConfModel;
class Conf extends Controller{
	// 配置列表
	public function index(){
		$data=db('Conf')->paginate(6);
		$page=$data->render();
		$this->assign('data',$data);
		$this->assign('page',$page);
		return view();
	}
	// 配置项
	public function list(){
		if(request()->isPost()){
			$data=input('post.');
			foreach ($data as $key => $value) {
				ConfModel::where('ename',$key)->update(['val'=>$value]);
			}
			$this->success('修改成功',url('list'));
		}else{
			$data=db('Conf')->select();
			$this->assign('data',$data);
			return view();
		}
		
	}
	// 添加
	public function add(){
		// 判断类型
		if(request()->isPost()){
			$model=new ConfModel();
			$data=input('post.');
			if($data['vals']){
				$data['vals']=str_replace('，',',',$data['vals']);
			}
			$res=$model->save($data);
			if($res){
				$this->success('添加成功',url('index'));
			}else{
				$this->error('添加失败');
			}
		}else{
			return view();
		}
	}
	// 删除
	public function del($id){
		$model=new ConfModel();
		$res=$model->delC($id);
		if($res){
			$this->success('删除成功',url('index'));
		}else{
			$this->error('删除失败');
		}
	}
	// 修改
	public function update($id){
		if(request()->isPost()){
			$conf=new ConfModel();
			$data=input('post.');
			if($data['vals']){
				$data['vals']=str_replace('，',',',$data['vals']);
			}
			$res=$conf->save($data,['id'=>$id]);
			if($res){
				$this->success('修改成功',url('index'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$data=db('Conf')->find($id);
			$this->assign('data',$data);
			return view();
		}
	}
}