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
		$type = $_GET['type'];
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
	}
	else
	{
		$abc['islike'] = 0;
		$this -> assign('islike',$abc['islike']);
	}
		$this -> assign($content);
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