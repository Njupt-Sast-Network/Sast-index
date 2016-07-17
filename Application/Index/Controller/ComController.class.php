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
		$data['islike'] = true;
		$db = M('like');
		$db -> data($data) -> add();
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
		$db -> where($where) -> setField('id','0');
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



}
?>