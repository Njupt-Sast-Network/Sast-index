<?php 
namespace Index\Controller;
use Think\Controller;
class SearchController extends Controller {
	public function index(){
		$this -> display();
	}
	public function search(){
		$Database = $this -> gettable($_POST['table']);
		if (!$_POST['page']) $_POST['page'] = 1;
		if (!$_POST['field']) $_POST['field'] = 'title';
		if ($_POST['content']) {
			$SearchData = trim($_POST['content']);
			$words = explode(" ",$SearchData);
			foreach ($words as $val){
				$map[$_POST['field']] = array('like', '%'.$val.'%');
			}
			$map['_logic'] = 'and';
		}
		$Listcard['card'] = $Database -> where($map) ->order('work_id desc') -> page($_POST['page'].',7') -> select();
		$Listcard['count'] = $Database -> where($map) -> count();
		$this -> ajaxReturn($Listcard);	
	}

	private function gettable($data){
		switch ($data) {
		case 0:
			$table = M('work');
			break;
		case 1:
			$table = M('talk');
			break;
		case 2:
			$table = M('news');
			break;
		case 3:
			$table = M('wiki');
			break;
		default:
			$table = M('work');
			break;
		}
		return $table;
	}
}
?>