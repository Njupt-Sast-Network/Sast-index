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
		//热搜
		if($_POST['content']!=NULL){
			$redb = M('news');

		}
		$Listcard['map'] = $map;
		$Listcard['card'] = $Database -> where($map)  -> page($_POST['page'].',7') -> select();
		$Listcard['count'] = $Database -> where($map) -> count();
		//返回评论数
		for ($i=0; $i < count($Listcard['card']); $i++) { 
			$Listcard['card'][$i]['comnumber']=0;
			$id = whichid($_POST['table']);
			$Listcard['card'][$i]['comnumber']=getcomnumber($_POST['table'],$Listcard['card'][$i][$id]);
		}
		//返回赞数
		for ($i=0; $i < count($Listcard['card']); $i++) { 
			$Listcard['card'][$i]['likenumber']=0;
			$id = whichid($_POST['table']);
			$Listcard['card'][$i]['likenumber']=getlikenumber($_POST['table'],$Listcard['card'][$i][$id]);
		}
		$Listcard['check'] = false;
		$Listcard['cons'] = [];
		$this -> ajaxReturn($Listcard);	
	}

	private function gettable($data){
		switch ($data) {
		case 0:
					$or = "work_id desc";
			$table = M('work') ->order($or);

			break;
		case 2:
					$or = "talk_id desc";
			$table = M('talk') ->order($or);

			break;
		case 1:
					$or = "news_id desc";
			$table = M('news') ->order($or);

			$isimg = 1;
			break;
		case 3:
					$or = "wiki_id desc";
			$table = M('wiki') ->order($or);

			break;
		default:
					$or = "work_id desc";
			$table = M('work') ->order($or);

			break;
		}
		return $table;
	}
}
?>