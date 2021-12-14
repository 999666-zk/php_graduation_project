<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\AuthRule as AuthRuleModel;
class AuthRule extends Allow {
	public function index(){
		$auth=new AuthRuleModel;
		$rule=$auth->authRuleTree();
		$this->assign('rule',$rule);
		return view();
	}
	// 添加
	public function add(){
		if(request()->isPost()){
			$data=input('post.');
			// 查询当前数据父级了level
			$plevel=db('auth_rule')->where('id',$data['pid'])->field('level')->find();
			if($plevel){
				$data['level']=$plevel['level']+1;
			}else{
				$data['level']=0;
			}
			
			$res=db('auth_rule')->insert($data);
			if($res){
				$this->success('添加成功',url('index'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$auth=new AuthRuleModel;
			$rule=$auth->authRuleTree();
			$this->assign('rule',$rule);
			return view();
		}
	}
	// 前置操作
	protected $beforeActionList=[
		'delson'=>['only'=>'del'],
	];
	public function delson(){
		$id=input('id');
		$auth=new AuthRuleModel;
		$idx=$auth->getChildId($id);
		if($idx){
			db('auth_rule')->delete($idx);
		}
	}
	// 删除
	public function del($id){
		$auth=new AuthRuleModel;
		$res=$auth->delcol($id);
		if($res){
			$this->success('删除成功',url('index'));
		}else{
			$this->error('删除失败');
		}
	}
	// 修改
	public function update($id){
		if(request()->isPost()){
			$data=input('post.');
			// 查询当前数据父级了level
			$plevel=db('auth_rule')->where('id',$data['pid'])->field('level')->find();
			if($plevel){
				$data['level']=$plevel['level']+1;
			}else{
				$data['level']=0;
			}
			$res=db('auth_rule')->update($data,['id'=>$id]);
			if($res){
				$this->success('修改成功',url('index'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$res=db('auth_rule')->find($id);
			$this->assign('res',$res);
			$auth=new AuthRuleModel;
			$rule=$auth->authRuleTree();
			$this->assign('rule',$rule);
			return view();
		}
		
	}
}