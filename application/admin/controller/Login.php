<?php
namespace app\admin\controller;
use think\Controller;
use think\captcha\Captcha;
use app\admin\model\Login as LoginModel;
class Login extends Controller{
    public function index()
    {
/*      echo "<pre>";
        print_r(input("post."));
        echo "</pre>";
        return view();*/
          if (request()->isPost()){
              $data = input("post.");
              if ($this->check($data['captcha'])){
                  $model = new LoginModel();
                  $num = $model->login($data);
                  if ($num == 1){
                      $this->success("登录成功",url('Index/index'));
                  }
                  if ($num == 2){
                      $this->error("密码不正确");
                  }
                  if ($num == 3){
                      $this->error("用户名不存在");
                  }
              }else{
                  $this->error("验证码不匹配");
              }
          }
          return view();
      }

        //验证码
        public function check($code="")
        {
            $captcha = new Captcha();
            if ($captcha->check($code)) {
                return true;
            } else {
                return false;
            }
        }

        public function logout(){
            session(null);
            $this->success('退出成功',url('Login/index'));
        }


    }