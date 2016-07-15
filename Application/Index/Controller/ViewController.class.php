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
		$this -> assign($content);
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