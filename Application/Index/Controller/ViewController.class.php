<?php 
namespace Index\Controller;
use Think\Controller;
class ViewController extends Controller {
	public function index(){

				switch ($_GET['type']) {
		case 0:
			$table = M('work');
			$or = "work_id =";
			$order = "work_id desc";
			break;
		case 1:
			$table = M('talk');
			$or = "talk_id =";
			$order = "talk_id desc";
			break;
		case 2:
			$table = M('news');
			$or = "news_id =";
			$order = "news_id desc";
			break;
		case 3:
			$table = M('wiki');
			$or = "wiki_id =";
			$order = "wiki_id desc";
			break;
		default:
			$table = M('news');
			$or = "news_id =";
			$order = "news_id desc";
			break;
		}

		$id = $or.$_GET['id'];
		$content = $table -> where($id) -> find();
		$titleseven['card'] = $table -> order($order) -> limit(7)->select();//查最近7个新闻
		$title1 = $titleseven['card'][0];
		$title2 = $titleseven['card'][1];
		$title3 = $titleseven['card'][2];
		$title4 = $titleseven['card'][3];
		$title5 = $titleseven['card'][4];
		$title6 = $titleseven['card'][5];
		$title7 = $titleseven['card'][6];
		$type = $_GET['type'];//查这文这人点没点过赞
		$id = $_GET['id'];
		if(session('userinfo')){
		$data = session('userinfo');
		$username = $data['username'];
		$db = M('like');
		$where = "type=".$type." and id=".$id." and username='".$username."'";
		$islike = 0;
		if($abc = $db -> where($where) -> find()){
			$islike=$abc['islike'];
		}
		$this -> assign('islike',$islike);
		$whereone = "type=".$type." and id=".$id." and islike=1";
		$number = $db -> where($whereone) ->count();
		$this -> assign('number',$number);
	}
	else
	{
		$abc['islike'] = 0;
		$this -> assign('islike',$abc['islike']);
	}// 查好了，返回了islike
	//下面开始写显示前三条评论。
	$comdb = M('comment');
	$wheretwo = "type=".$type." and id=".$id;
	$comdata = $comdb -> where($wheretwo) ->order('com_id desc')->limit(3)->select();
	$this -> assign('comdata',$comdata);

	//前两条评论显示完了。
	//下面开始写评论数
	$comnumber = $comdb -> where($wheretwo) -> count();
	$this -> assign('comnumber',$comnumber);

	//OK了
		$this -> assign($content);
		$this -> assign('title1',$title1);
		$this -> assign('title2',$title2);
		$this -> assign('title3',$title3);
		$this -> assign('title4',$title4);
		$this -> assign('title5',$title5);
		$this -> assign('title6',$title6);
		$this -> assign('title7',$title7);
		$this -> assign('type',$type);
		$this -> assign('id',$id);

		$this -> display();
	}
//下面是请求更多的评论，一次三条。
	public function more(){

		$table = M('comment');
		if (!$_POST['page']) $_POST['page'] = 1;
		$where = "type=".$_POST['type']." and id=".$_POST['id'];
		$page=$_POST['page'];
		$listcard = $table -> where($where) ->order('com_id desc') ->page($page.',3') -> select();
		$islogin = false;
		if(session('userinfo'))
		{
			$islogin = true;
		}
		
		$listcard['islogin'] = $islogin;



		if($_POST['type']==1)
		{
			for ($i=0; $i < 5; $i++) { 
				$back['card'][$i] = $listcard[$i];
			}
			$this -> ajaxReturn($back);	
		}else
		$this -> ajaxReturn($listcard);	
















	}
}
?>