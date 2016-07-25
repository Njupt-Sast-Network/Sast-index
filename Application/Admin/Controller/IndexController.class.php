<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display();
    }

    public function get(){
    	switch ($_POST['type']) {
    		case 0:
    			$db = M('user');
    			$order = "uid desc";
    			break; 
    		case 1:
    			$db = M('taolun');
    			$order = "id desc";
    			break;
    		case 2:
    			$db = M('news');
    			$order = "id desc";
    			break;
    		 default:
    			$db = M('user');
    			$order = "uid desc";
    			break;
    	}





    	$page=$_POST['page'];
    	$user['card'] = $db -> order($order) -> page($page.',5') -> select();
    	$count = $db -> count();
    	$user['count'] = $count;
    	$this -> ajaxReturn($user);
    }
    public function deluser(){
    	$type = $_POST['type'];
    	$id = $_POST['id'];
    	    	switch ($_POST['type']) {
    		case 0:
    			$db = M('user');
    			$order = "uid =";
    			break; 
    		case 1:
    			$db = M('taolun');
    			$order = "id =";
    			break;
    		case 2:
    			$db = M('news');
    			$order = "id =";
    			break;
    		 default:
    			$db = M('user');
    			$order = "uid =";
    			break;
    	}
    	$where = $order.$id;
    	$isdone = false;
    	if($db -> where($where) -> delete())
    	{
    		$isdone = true;
    	}
    	$card['isdone'] = $isdone;
    	$this -> ajaxReturn($card);
    }

}