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
		$data['type'] = $_POST['type'];
		$data['id'] = $_POST['id'];
		$data['username'] = $sess['username'];
		$data['islike'] = 1;
		$db = M('like');
		$where = "type=".$_POST['type']." and id=".$_POST['id']." and username='".$data['username']."'";
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
		$type = $_POST['type'];
		$id = $_POST['id'];
		$data['username'] = $sess['username'];
		$data['islike'] = false;
		$db = M('like');
		$where = "type=".$type." and id=".$id;
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
		$data['id'] = $_POST['id'];
		$data['type'] = $_POST['type'];
		$data['content'] = $_POST['content'];
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