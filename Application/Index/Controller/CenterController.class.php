<?php 
namespace Index\Controller;
use Think\Controller;
class CenterController extends Controller {
	public function index(){
	if(verifyuser()==1){
                $sess = session('userinfo');
        $name= $sess['username'];
        $this -> assign('name',$name);
		$this -> display();}
	else
		echo "Please login in first";
	}

	public function userinfo(){
		if (session('userinfo')) 
        {
        	$sess = session('userinfo');
        	$name = $sess['username'];
        	$db = M("user");
        	$info = $db -> where("username = '".$name."'") -> select();
        	unset($info[0]['password']);
            $data['card'] = $info;
        	$this -> ajaxReturn($info[0]);
        }else
        {
        	echo "PLease login in";
        }
	}

	public function userwiki(){
        if (session('userinfo')) 
        {
    	switch ($_POST['type']) {
    		case 0:
    			$db = M('wiki');
    			$order = "wiki_id desc";
    			break; 
    		case 1:
    			$db = M('wiki');
    			$order = "wiki_id desc";
    			break;
    		case 2:
    			$db = M('news');
    			$order = "news_id desc";
    			break;
            case 3:
                $db = M('work');
                $order = "work_id desc";
                break;
    		 default:
    			$db = M('user');
    			$order = "uid desc";
    			break;
    	}
        $sess = session('userinfo');
        $name= $sess['username'];
        $wherelevel = "username ='".$name."'";
        $dbuser = M('user');
        $level = $dbuser -> where($wherelevel) -> select();
        unset($level[0]['password']);
        $user['level'] = $level[0]['level'];
    	$page=$_POST['page'];
    	$user['card'] = $db -> order($order) -> page($page.',5')->where("author = '".$name."'") -> select();
    	$count = $db -> where("author = '".$name."'") -> count();
    	$user['count'] = $count;
 
            // $dblike = M('like');
            // $dbcom = M('comment');
            // for ($i=0; $i < count($user['card']); $i++) { 
            //     $where = "type = 2 and id=".$user['card'][$i]['wiki_id'];
            //   $like = $dblike -> where($where) ->count();
            //    $user['card'][$i]['like'] = $like ;
            //   $com = $dbcom -> where($where) ->count();
            //    $user['card'][$i]['comment'] = $com ;
            // }
        
    	$this -> ajaxReturn($user);
        }else
        {
        	echo "Please login in first";
        }
	}

    public function del(){
    if(verifyuser()){
        $type = $_POST['type'];
        $id = $_POST['id'];
                switch ($_POST['type']) {
            case 0:
                $db = M('wiki');
                $order = "wiki_id =";
                break; 
            case 1:
                $db = M('wiki');
                $order = "wiki_id =";
                break;
            case 2:
                $db = M('news');
                $order = "news_id =";
                break;
            case 3:
                $db = M('work');
                $order = "work_id =";
                break;
             default:
                $db = M('user');
                $order = "uid =";
                break;
        }
        $where = $order.$id;
        $isdone = false;
        $name = $db -> where($where) -> select();
        $sess = session('userinfo'); //获取当前用户
        $sessname = $sess['usernamer'];
        if($name['author'] == $sessname)  //确认文章删除权限
        {
        if($db -> where($where) -> delete())
        {
            $isdone = true;
        }
        $card['isdone'] = $isdone;
        $this -> ajaxReturn($card);
        }
        else{
            echo "You are not permitted to do this";
        }
    }else{
        echo "You are not permitted to do this";
    }
    }

public function changeinfo(){
    if(verifyuser()){
        $sess = session('userinfo');
        $name = $sess['username'];
        $data['username'] = $_POST['username'];
        $data['mail'] = $_POST['mail'];
        $data['department'] = $_POST['department'];
        $db = M('user');
        $isdone = false;
        if($db -> data($data) -> where("username = '".$data['username']."'") -> save())
        {
            $isdone = true;
        }
    }else{
        $isdone =false;
    }
    $card['isdone'] = $isdone;
    $this ->ajaxReturn($card);
}

public function wikiupload(){
    $sess=session('userinfo');
    $name = $sess['username'];
    $news['title'] = $_POST['title'];
    $news['author'] = $name;
    $news['keywords'] = $_POST['keywords'];
    $news['simple'] = $_POST['simple'];
    $news['text'] = $_POST['content'];
    $db = M('wiki');
    if($db->add($news))
    {
        $isdone = true;
    }
    $info['isdone'] = $isdone;
    $this -> ajaxReturn($isdone);
}

public function workupload(){
    $sess=session('userinfo');
    $name = $sess['username'];
    $news['title'] = $_POST['title'];
    $news['author'] = $name;
    $news['keywords'] = $_POST['keywords'];
    $news['simple'] = $_POST['simple'];
    $news['text'] = $_POST['content'];
    $db = M('work');
    if($db->add($news))
    {
        $isdone = true;
    }
    $info['isdone'] = $isdone;
    $this -> ajaxReturn($isdone);
}




    public function addimg(){
        if (session('userinfo')) 
{
    $sess = session('userinfo');
        $data['username'] = $sess['username'];
        $db = M('user');
        $where = "level=1 and username='".$data['username']."'";
        if(1)
        {
            $upload = new \Think\Upload();// 实例化上传类
    $upload->maxSize   =     3145728 ;// 设置附件上传大小
    $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
    $upload->rootPath  =      './Uploads/'; // 设置附件上传根目录
    $upload->savePath  =      ''; // 设置附件上传（子）目录
    // 上传文件 
    $info   =   $upload->upload();
    if(!$info) {// 上传错误提示错误信息
            $this->error($upload->getError());
            $info['success'] = false;
        }
        else{
                        foreach($info as $file){
                 $img ="http://".$_SERVER['SERVER_NAME']."/Uploads/".$file['savepath'].$file['savename'];
                                    }
             $info['success'] = true;
             $info['file_path'] = $img;
        }
        $this -> ajaxReturn($info);



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


}
?>