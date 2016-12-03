<?php 
namespace Index\Controller;
use Think\Controller;
class ComController extends Controller {
	public function like(){

		$islogin = ture;
		$isdone = false;
if (session('userinfo')) 
{
	if(IS_POST)
	{
		$sess = session('userinfo');
		$data['type'] = I('post.type',1,'int');
		$data['id'] = I('post.id',1,'int');
		$data['username'] = $sess['username'];
		$data['islike'] = 1;
		$db = M('like');
		$where = array("type" => $data['type'],'id' => $data['id'],'username' => $data['username']);
		if(!$db ->where($where)->find()){
			$db -> data($data) -> add();
		}
		else
		{
			$db -> where($where) -> setField('islike','1');
		}
		$isdone = ture;
	}
}
else
{
	$islogin = false;
}
	$ajax['islogin'] = $islogin;
	$ajax['isdone'] = $isdone;
	$this->ajaxReturn($ajax);


	}

	public function dislike(){

		$islogin = ture;
		$isdone = false;
if (session('userinfo')) 
{
	if(IS_POST)
	{
		$sess = session('userinfo');
		$type = I('post.type',1,'int');
		$id = I('post.id',1,'int');
		$data['username'] = $sess['username'];
		$data['islike'] = false;
		$db = M('like');
		$where = array('type' => $type,'id' => $id);
		$db -> where($where) -> setField('islike','0');
		$isdone = ture;
	}
}
else
{
	$islogin = false;
}
	$ajax['islogin'] = $islogin;
	$ajax['isdone'] = $isdone;
	$this->ajaxReturn($ajax);


	}


	public function com(){
		$islogin = ture;
		$isdone = false;
if (session('userinfo')) 
{
	if(IS_POST)
	{
		$sess = session('userinfo');
		$data['id'] = I('post.id',1,'int');
		$data['type'] = I('post.type',1,'int');
		$data['content'] = I('post.content',"");
		$data['commentor'] = $sess['username'];
		$db = M('comment');
		if($db -> data($data) ->filter('strip_tags')-> add())
		{
			$isdone = ture;
		}
	}
}
else
{
	$islogin = false;
}
	$ajax['islogin'] = $islogin;
	$ajax['isdone'] = $isdone;
	$this->ajaxReturn($ajax);





	}



}
?>