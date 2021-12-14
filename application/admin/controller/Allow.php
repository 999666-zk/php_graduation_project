<?php
namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\controller\Auth as Auth;

class Allow extends Controller{
    public function _initialize()
    {
        if (!session('name') || !session('id')){
            $this->error("请登录",url('Login/index'));
        }
        //权限把控
        $auth = new Auth();
//        $request = request();  //获取当前控制器和方法
        $request = Request::instance();
        $con = $request->controller();
        $action = $request->action();
        $name = $con.'/'.$action;
//        echo $name = $con.'/'.$action;

        //无需检测
        $noCheck = array('Index/index');
        if (session('id')!=108){
            if (!in_array($name,$noCheck)){
                if (!$auth->check($name,session('id'))){
                    $this->error('你没有权限',url('Index/index'));
                }
            }
        }
    }



}