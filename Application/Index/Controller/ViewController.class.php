<?php 
namespace Index\Controller;
use Think\Controller;
class ViewController extends Controller {
	public function index(){
		//过滤get所传参数
		$itype = I('get.type',0,'int');
		$iid = I('get.id',0,'int');
		switch ($itype) {
		case 0:
			$table = M('work');
			$or = "work_id";
			$order = "work_id desc";
			break;
		case 1:
			$table = M('talk');
			$or = "talk_id";
			$order = "talk_id desc";
			break;
		case 2:
			$table = M('news');
			$or = "news_id";
			$order = "news_id desc";
			break;
		case 3:
			$table = M('wiki');
			$or = "wiki_id";
			$order = "wiki_id desc";
			break;
		default:
			$table = M('news');
			$or = "news_id";
			$order = "news_id desc";
			break;
		}
		$consult[$or] = $iid;
		$content = $table -> where($consult) -> find();
		//返回最近7个新闻
		$titleseven['card'] = $table -> order($order) -> limit(7)->select();
		$title1 = $titleseven['card'][0];
		$title2 = $titleseven['card'][1];
		$title3 = $titleseven['card'][2];
		$title4 = $titleseven['card'][3];
		$title5 = $titleseven['card'][4];
		$title6 = $titleseven['card'][5];
		$title7 = $titleseven['card'][6];
		//查这文这人点没点过赞
		$type = $itype;
		$id = $iid;
		if(session('userinfo')){
		$data = session('userinfo');
		$username = $data['username'];
		$db = M('like');
		$where = array('type' => $type,'id' => $id,'username' => $username );
		$islike = 0;
		if($abc = $db -> where($where) -> find()){
			$islike=$abc['islike'];
		}
		$this -> assign('islike',$islike);
		$whereone = array('type' => $type,'id' => $id,'islike' => 1);
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
	$wheretwo = array('type' => $type,'id' => $id);
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
		$page=I('post.page','1','int');
		$id = I('post.id','1','int');
		$type = I('post.type','1','int');
		$where = array('type' => $type , 'id' => $id);
		$listcard = $table -> where($where) ->order('com_id desc') ->page($page.',3') -> select();
		$islogin = false;
		//查看是否登录(写这个代码的时候太年轻，代码乱，就不重构了，重点基于安全性重构)
		if(session('userinfo'))
		{
			$islogin = true;
		}
		$listcard['islogin'] = $islogin;
		//这里是看是不是前台陈列馆的请求评论
		if($type==1)
		{
			$front = I('post.front','1','int');
			if($front == 1)
			$listcard = $table -> where($where) ->order('com_id desc') ->page($page.',5') -> select();
			for ($i=0; $i < 5; $i++) { 
				$back[$i] = $listcard[$i];
				if($listcard[$i]==NULL)
					unset($back[$i]);
			}
			$this -> ajaxReturn($back);	
		}else
		$this -> ajaxReturn($listcard);	
	}
}
?>