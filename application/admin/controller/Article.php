<?php 
namespace app\admin\controller;
use think\Controller;
use app\admin\model\Colum as ColumModel;
use app\admin\model\Article as ArticleModel;

class Article extends Allow {
	public function index(){
		$data=db('article')->alias('a')->join('colum b','a.columid=b.id')->join('author c','c.id=a.authorid')->field('a.*,b.name cname,c.name')->paginate(2);
		$page=$data->render();
		$this->assign('data',$data);
		$this->assign('page',$page);
		return view();
	}
	// 文章详情展示
	public function detail($id){
		$data=db('article')->find($id);
		$this->assign('data',$data);
		return view();
	}
	// 添加
	public function add(){
		if(Request()->isPost()){
			$data=input('post.');
			$ArticleModel=new ArticleModel;
			$data['time']=time();
			$res=$ArticleModel->save($data);
			if($res){
				$this->success('添加成功',url('index'));
			}else{
				$this->error('添加失败');
			}
		}else{
			$colum=new ColumModel;
			$col=$colum->coltree();
			$author=db('author')->select();
			$this->assign([
				'col'=>$col,
				'author'=>$author
				]);
			return view();
		}
	}
	// 删除
	public function del($id){
		$article=new ArticleModel();
		$res=$article->delA($id);
		if($res){
			$this->success('删除成功',url('index'));
		}else{
			$this->error('删除失败');
		}
	}
	// 修改
	public function update($id){
		if(request()->isPost()){
			$article=new ArticleModel();
			$data=input('post.');
			if($_FILES['img']['tmp_name']){
				$file = request()->file('img');
				$info = $file->move("./static/uploads/article");
				if($info){
					unlink("./static/uploads/article/{$data['img']}");
					$data['img']=$info->getSaveName();
				}else{
					$this->error($file->getError());
				}
			}
			$data['time']=time();
			$res=$article->save($data,['id'=>$id]);
			if($res){
				$this->success('修改成功',url('index'));
			}else{
				$this->error('修改失败');
			}
		}else{
			$author=db('author')->select();
			$article=db('article')->find($id);
			$colum=new ColumModel;
			$col=$colum->coltree();
			$this->assign(array(
				'author'=>$author,
				'article'=>$article,
				'col'=>$col
				));
			return view();
		}

	}
}