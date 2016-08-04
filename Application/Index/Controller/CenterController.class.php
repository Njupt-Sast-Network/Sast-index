<?php 
namespace Index\Controller;
use Think\Controller;
class CenterController extends Controller {
	public function index(){
	if(verifyuser()==1)
		$this -> display();
	else
		echo "Please login in first";
	}

	public function userinfo(){
		if (session('userinfo')) 
        {
        	$sess = session('userinfo');
        	$name = $sess['username'];
        	$db = M("user");
        	$info = $db -> where("username = '".$name."'") -> select();
        	unset($info['password']);
        	$this -> ajaxReturn($info);
        }else
        {
        	echo "PLease login in"
        }
	}

	public function userwiki(){
        if (session('userinfo')) 
        {
    	switch ($_POST['type']) {
    		case 0:
    			$db = M('user');
    			$order = "uid desc";
    			break; 
    		case 1:
    			$db = M('wiki');
    			$order = "wiki_id desc";

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
        $sess = session('userinfo');
        $name= $sess['username'];
    	$page=$_POST['page'];
    	$user['card'] = $db -> order($order) -> page($page.',5')->where("author = '".$name."'") -> select();
    	$count = $db -> count();
    	$user['count'] = $count;
        if($_POST['type']==1)//返回评论数和点赞数
        {  
            $dblike = M('like');
            $dbcom = M('comment');
            for ($i=0; $i < count($user['card']); $i++) { 
                $where = "type = 2 and id=".$user['card'][$i]['wiki_id'];
              $like = $dblike -> where($where) ->count();
               $user['card'][$i]['like'] = $like ;
              $com = $dbcom -> where($where) ->count();
               $user['card'][$i]['comment'] = $com ;
            }
        }
    	$this -> ajaxReturn($user);
        }else
        {
        	echo "Please login in first";
        }



	}
}
?>