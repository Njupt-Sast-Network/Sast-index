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
    			$order = "news_id desc";
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
        if($_POST['type']==2)//返回评论数和点赞数
        {  
            $dblike = M('like');
            $dbcom = M('comment');
            for ($i=0; $i < count($user['card']); $i++) { 
                $where = "type = 2 and id=".$user['card'][$i]['news_id'];
              $like = $dblike -> where($where) ->count();
               $user['card'][$i]['like'] = $like ;
              $com = $dbcom -> where($where) ->count();
               $user['card'][$i]['comment'] = $com ;
            }
        }
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
    			$order = "news_id =";
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