<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if (session('userinfo')) 
{
        if(verifyadmin())
        {
                    $this->display();
        }
        else
        {
            echo('Your account is not permitted to enter this page.');
        }

}
else{
     echo("Please login in first.");
}
}

    public function get(){
    if(verifyadmin()){
        $itype = I('post.type',1,'int');
    	switch ($itype) {
    		case 0:
    			$db = M('user');
    			$order = "uid desc";
    			break; 
    		case 1:
    			$db = M('talk');
    			$order = "talk_id desc";
    			break;
    		case 2:
    			$db = M('news');
    			$order = "news_id desc";
    			break;
                        case 3:
                $db = M('wiki');
                $order = "wiki_id desc";
                break;
    		 default:
    			$db = M('user');
    			$order = "uid desc";
    			break;
    	}
    	$page=I('post.page',1,'int');
    	$user['card'] = $db -> order($order) -> page($page.',5') -> select();
    	$count = $db -> count();
    	$user['count'] = $count;
                       //去除密码 返回提问数
        for ($i=0; $i < count($user['card']); $i++) { 
            if($itype == 0)
               {
                    unset($user['card'][$i]['password']);
                    $talkdb = M('talk');
                    $where['author'] = $user['card'][$i]['username'];
                    $user['card'][$i]['talknumber'] = $talkdb -> where($where)->count();
               }
        }
        if($itype==2)//返回评论数和点赞数
        {  
            $dblike = M('like');
            $dbcom = M('comment');
            for ($i=0; $i < count($user['card']); $i++) { 
                $where = array('type' => 2 , 'id' => $user['card'][$i]['news_id']);
              $like = $dblike -> where($where) ->count();
               $user['card'][$i]['like'] = $like ;
              $com = $dbcom -> where($where) ->count();
               $user['card'][$i]['comment'] = $com ;
            }
        }
                if($itype==1)//返回评论数和点赞数
        {  
            $dblike = M('like');
            $dbcom = M('comment');
            for ($i=0; $i < count($user['card']); $i++) { 
                $where = array('type' => 1 , 'id' => $user['card'][$i]['talk_id']);
              $like = $dblike -> where($where) ->count();
               $user['card'][$i]['like'] = $like ;
              $com = $dbcom -> where($where) ->count();
               $user['card'][$i]['comment'] = $com ;
            }
        }
    	$this -> ajaxReturn($user);
    }else{
        echo "You are not permitted to do this";
    }
    }

    public function deluser(){
    if(verifyadmin()){
    	$type = I('post.type',"",'int');
    	$id = I('post.id',"",'int');
    	    	switch ($type) {
    		case 0:
    			$db = M('user');
    			$order = "uid";
    			break; 
    		case 1:
    			$db = M('talk');
    			$order = "talk_id";
    			break;
    		case 2:
    			$db = M('news');
    			$order = "news_id";
    			break;
            case 3:
                $db = M('wiki');
                $order = "wiki_id";
                break;
    		 default:
    			$db = M('user');
    			$order = "uid";
    			break;
    	}
        $where[$order] = $id;
    	$isdone = false;
    	if($db -> where($where) -> delete())
    	{
    		$isdone = true;
    	}
    	$card['isdone'] = $isdone;
    	$this -> ajaxReturn($card);
    }else{
        echo "You are not permitted to do this";
    }
    }


}