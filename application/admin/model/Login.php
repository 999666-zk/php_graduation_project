<?php
namespace app\admin\model;
use think\Model;
use think\Session;
class Login extends Model{
    //登录
    public function login($data){
        $admin = Manger::getByusername($data['username']);
        if ($admin){
            $id = $admin['id'];
            $username = $admin['username'];
            $password = $admin['password'];

            if ($password == md5($data['password'])){
 /*               Session::set('name',$username);
                Session::set('id',$id);*/
                    \session('name',$username);
                    \session('id',$id);
/*                    $username = \session('name',$username);
                    $this->assign('user',$username);*/
                return 1; //密码正确
            }else{
                return 2;//密码不正确
            }
        }else{
            return 3;//用户名不存在
        }
    }
}