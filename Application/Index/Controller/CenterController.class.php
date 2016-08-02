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

	}

	public function userwork(){
        if (session('userinfo')) 
        {
   			$sess = session('userinfo');
        	$name = $sess['username'];
        	$db = M('wiki');
        	$page=$_POST['page'];
        	$wiki = $db -> where("author ='".$name."'")->page($page.',5')->order("wiki_id desc")->select();
        }else{
        	$islogin = false;
        }


		 	// switch ($_POST['type']) {
    // 		case 0:
    // 			$db = M('user');
    // 			$order = "uid desc";
    // 			break; 
    // 		case 1:
    // 			$db = M('wiki');
    // 			$order = "id desc";
    // 			break;
    // 		case 2:
    // 			$db = M('news');
    // 			$order = "news_id desc";
    // 			break;
    // 		 default:
    // 			$db = M('user');
    // 			$order = "uid desc";
    // 			break;
    // 	}
    // 	$page=$_POST['page'];
    // 	$user['card'] = $db -> order($order) -> page($page.',5') -> select();
    // 	$count = $db -> count();
    // 	$user['count'] = $count;
    //                    //去除密码 返回提问数
    //     for ($i=0; $i < 6; $i++) { 
    //         if($_POST['type'] == 0)
    //            {
    //                 unset($user['card'][$i]['password']);
    //                 $talkdb = M('talk');
    //                 $user['card'][$i]['talknumber'] = $talkdb -> where('author = \''.$user['card'][$i]['username']."'")->count();
    //            }
    //     }
    //     if($_POST['type']==2)//返回评论数和点赞数
    //     {  
    //         $dblike = M('like');
    //         $dbcom = M('comment');
    //         for ($i=0; $i < count($user['card']); $i++) { 
    //             $where = "type = 2 and id=".$user['card'][$i]['news_id'];
    //           $like = $dblike -> where($where) ->count();
    //            $user['card'][$i]['like'] = $like ;
    //           $com = $dbcom -> where($where) ->count();
    //            $user['card'][$i]['comment'] = $com ;
    //         }
    //     }
    // 	$this -> ajaxReturn($user);
	}
}
?>