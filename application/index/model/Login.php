<?php
namespace app\index\model;
use think\Model;
use think\Session;
class Login extends Model{
    //登录
    public function login($data){
        $student = Manger::getBySid($data['sid']);
        if ($student){
            $id = $student['sid'];
            $username = $student['nickname'];
            $password = $student['password'];

            if ($password == md5($data['password'])){
                /*               Session::set('name',$username);
                               Session::set('id',$id);*/
                \session('name',$username);
                \session('id',$id);
                /*
                    $username = \session('name',$username);
                    $this->assign('user',$username);
                */
                return 1; //密码正确
            }else{
                return 2;//密码不正确
            }
        }else{
            return 3;//用户名不存在
        }
    }
}