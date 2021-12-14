<?php
namespace app\admin\Controller;
use think\Controller;
class Index extends Controller {
    public function index(){
        $data=db('Lunbo')->select();
        $this->assign([
            'data'=>$data,
        ]);
    	return view();
    }
    public function First(){
        return $this->fetch();
    }
}



