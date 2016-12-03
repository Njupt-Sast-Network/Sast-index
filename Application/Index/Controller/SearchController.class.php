<?php 
namespace Index\Controller;
use Think\Controller;
class SearchController extends Controller {
	public function index(){
		$this -> display();
	}
	public function search(){
		$table = I('post.table',1,'int');
		$Database = $this -> gettable($table);
		$page = I('post.page',1,'int');
		$field = I('post.field','title');
		$content = I('post.content','');
		if ($content) {
			$SearchData = trim($content);
			$words = explode(" ",$SearchData);
			foreach ($words as $val){
				$map[$field] = array('like', '%'.$val.'%');
			}
			$map['_logic'] = 'and';
		}
		//热搜
		if($content!=NULL){
			$redb = M('news');
		}
		$Listcard['map'] = $map;
		$Listcard['card'] = $Database -> where($map)  -> page($page.',7') -> select();
		$Listcard['count'] = $Database -> where($map) -> count();
		//返回评论数
		for ($i=0; $i < count($Listcard['card']); $i++) { 
			$Listcard['card'][$i]['comnumber']=0;
			$id = whichidsearch($table);
			$Listcard['card'][$i]['comnumber']=getcomnumbersearch($table,$Listcard['card'][$i][$id]);
		}
		//返回赞数
		for ($i=0; $i < count($Listcard['card']); $i++) { 
			$Listcard['card'][$i]['likenumber']=0;
			$id = whichidsearch($table);
			$Listcard['card'][$i]['likenumber']=getlikenumbersearch($table,$Listcard['card'][$i][$id]);
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
		case 1:
					$or = "news_id desc";
			$table = M('news') ->order($or);

			$isimg = 1;
			break;
		case 2:
					$or = "talk_id desc";
			$table = M('talk') ->order($or);

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