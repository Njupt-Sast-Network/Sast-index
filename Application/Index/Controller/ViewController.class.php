<?php 
namespace Index\Controller;
use Think\Controller;
class ViewController extends Controller {
	public function index(){

				switch ($_GET['type']) {
		case 0:
			$table = M('work');
			$or = "work_id =";
			break;
		case 1:
			$table = M('talk');
			$or = "talk_id =";
			break;
		case 2:
			$table = M('news');
			$or = "news_id =";
			break;
		case 3:
			$table = M('wiki');
			$or = "wiki_id =";
			break;
		default:
			$table = M('work');
			$or = "work_id =";
			break;
		}

		$id = $or.$_GET['id'];
		$content = $table -> where($id) -> find();
		$titleseven['card'] = $table -> order('news_id desc') -> limit(7)->select();//查最近7个新闻
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
	//下面开始写显示前两条评论。
	$comdb = M('comment');
	$wheretwo = "type=".$type." and id=".$id;
	$comdata = $comdb -> where($wheretwo) ->order('com_id desc')->limit(2)->select();
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

	private function gettable($data){
		switch ($data) {
		case 0:
			$table = M('work');
			$or = "work_id =";
			break;
		case 1:
			$table = M('talk');
			$or = "talk_id =";
			break;
		case 2:
			$table = M('news');
			$or = "news_id =";
			break;
		case 3:
			$table = M('wiki');
			$or = "wiki_id =";
			break;
		default:
			$table = M('work');
			$or = "work_id =";
			break;
		}
		return $table;
	}
}
?>