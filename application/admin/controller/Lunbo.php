<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Lunbo as LunboModel;
class Lunbo extends Allow {
	public function index(){
		$data=db('Lunbo')->select();
        $count = db('Lunbo')->count();
		$this->assign([
			'data' => $data,
            'count' => $count,
			]);
		return view();
/*        $data = db('Lunbo')->select();
        $count = db('Lunbo')->count();
        $this->assign('data',$data);
        $this->assign('count',$count);
        return view();*/

	}
	// 文件上传
	public function ajax_upload(){
		$file = request()->file('file');
		// 移动到框架应用根目录/public/uploads/ 目录下
		$info = $file->move("./static/uploads/lunbo");
		if($info){
			// 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
			echo $info->getSaveName();
		}else{
			// 上传失败获取错误信息
			echo $file->getError();
		}
	}
/*	// 添加
        public function add()
        {
            $LunboModel = new LunboModel;
            $res = $LunboModel->addL(input('post.'));
            if ($res) {
                $this->success('添加成功', url('index'));
            } else {
                $this->error('添加失败');
                //验证
                $validate=\think\Loader::validate('Lunbo');
                if(!$validate->scene('add')->check(input('post.'))){
                    $this->error($validate->getError());
                }
                $res=$LunboModel->addL(input('post.'));
                if($res){
                    $this->success('添加成功',url('index'));
                }else{
                    $this->error('添加失败');
                }

            }
        }*/
        public function ajax_add(){
            parse_str(input("post.str"),$arr);
            $LunboModel = new LunboModel;
            $validate=\think\Loader::validate('Lunbo');
            if(!$validate->scene('add')->check($arr)){
//                $this->error($validate->getError());
                return $arr=['error'=>$validate->getError(),'code'=>1];
            }else{
                $res=$LunboModel->addL($arr);
                if ($res){
                    $arr['id']=$LunboModel->id;
                    $this->assign('dat',$arr);
                    return view();
                }
            }
        }
/*  	// 删除
        public function del($id){
            $LunboModel=new LunboModel;
            $res=$LunboModel->delL($id);
            if($res){
                $this->success('删除成功',url('index'));
            }else{
                $this->error('删除失败');
            }
        }*/
    // 删除
    public function ajax_del(){
        $id=input("post.id");
        $model=new LunboModel;
        $res=$model->delM($id);
        if($res){
            echo 1;
        }else{
            echo 2;
        }
    }
    // 批量删除
    public function ajax_delAll(){
        $model=new LunboModel;
        $res=$model->delM(input("post.str"));
        return $res;
    }
        // 修改
        public function update($id){
            if(request()->isPost()) {
                $data = input("post.");
                if (!$data['img']) {
                    $data['img'] = $data['oldimg'];
                } else {
                    unlink("./static/uploads/lunbo/{$data['oldimg']}");
                }
                 unset($data['oldimg']);
                 $LunboModel=new LunboModel;
                 $res=$LunboModel->save($data,['id'=>$id]);
                 if($res){
                     $this->success('修改成功',url('index'));
                 }else{
                     $this->error('修改失败');
                 }
             }else{
                 $data=db('Lunbo')->find($id);
                 $this->assign('data',$data);
                 return view();
             }

        }
      // 排序
        public function sort(){
//            $data = input('post.');
            parse_str(input("post.str"),$data);
            $LunboModel=new LunboModel;
            $res=$LunboModel->save($data,['id'=>$data['id']]);
            if($res){
                echo 1;
            }else{
                echo 2;
            }
        }
}