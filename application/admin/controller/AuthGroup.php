<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\model\AuthRule as AuthRuleModel;

class AuthGroup extends Allow {
    public function index(){
        $data = db('AuthGroup')->select();
        $this->assign('data',$data);
        return view();
    }
    public function add(){
        if(Request()->isPost()){
//            echo "<pre>";
//            print_r(input('post.'));
//            echo "</pre>";
            $data = input('post.');
            if ($data['rules']){
                $data['rules'] = implode(',',$data['rules']);
            }
            $res = db('AuthGroup')->insert($data);
            /*$data1 = db('Manger')->select();
            $data2 = db('AuthGroup')->select();
            $userid = $data1['id'];
            $groupid = $data2['id'];
            $result = db('AuthGroupAccess')->insert($userid,$groupid);*/
            if ($res){
                $this->success('添加成功',url('index'));
            }else{
                $this->error('添加失败');
            }
        }else{
            //管理员名称
            $data = db('Manger')->select();
            $this->assign('data',$data);
            //规则显示
            $authRule = new AuthRuleModel();
            $tree = $authRule->authRuleTree();
            $this->assign('tree',$tree);
            return view();
        }
    }

    public function update($id){
        if(Request()->isPost()){
//            echo "<pre>";
//            print_r(input('post.'));
//            echo "</pre>";
            $data = input('post.');
            if ($data['rules']){
                $data['rules'] = implode(',',$data['rules']);
            }
            $res = db('AuthGroup')->update($data,['id'=>$id]);
            if ($res){
                $this->success('修改成功',url('index'));
            }else{
                $this->error('修改失败');
            }
        }else{
            //管理员名称
            $data = db('Manger')->select();
            $this->assign('data',$data);
            $AuthGroup = db('AuthGroup')->find($id);
            $this->assign('AuthGroup',$AuthGroup);
            //规则显示
            $authRule = new AuthRuleModel();
            $tree = $authRule->authRuleTree();
            $this->assign('tree',$tree);
            return view();
        }
    }

    public function del($id){
        $res = db('AuthGroup')->delete($id);
        if ($res){
            $this->success('删除成功',url('index'));
        }else{
            $this->error('删除失败');
        }
    }
}