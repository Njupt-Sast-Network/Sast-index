<?php 
namespace Index\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function login(){
		$iusername = I('post.username',"",'string');
		$ipassword = I('post.password',"",'string');
		$iverify = I('post.verify',"");
		if (!session('userinfo')) {
			if (IS_POST) {
				$loginfo['verify']=$iverify;
				if (!check_verify($loginfo["verify"])) {
					$valid = false;
					$message = '验证码错误';
				}else{
					$loginfo['username'] = $iusername;
					$loginfo['password'] = md5($ipassword);
					if ($info = M('user') -> where($loginfo) -> find()) {
						$valid = true;
						unset($info['password']);
						session('userinfo',$info);
					}else{
						$valid = false;
						$message = '用户名或密码不正确';
					}
				}
			}
		}
	$data = session('userinfo');
	$data['valid'] = $valid;
	$data['message'] = $message;
	$this->ajaxReturn($data);
	}



public function reg(){
			$iusername = I('post.username',"",'string');
			$ipassword = I('post.password',"",'string');
			$iverify = I('post.verify',"");
			$iemail = I('post.email',"","email");
					if (!session('userinfo')) {
			if (IS_POST) {
				$loginfo['verify']=$iverify;
				if (!check_verify($loginfo["verify"])) {
					$valid = false;
					$message = '验证码错误';
				}else{
					$loginfo['username'] = $iusername;
					$loginfo['password'] = md5($ipassword);
					$loginfo['mail'] = $iemail;
					$loginfo['level'] = '3';
					$test['username'] =  $iusername;
					$test1['mail'] =  $iemail;
					if (!($info = M('user') -> where($test) -> find()) && !($info = M('user') -> where($test1) -> find())){  // check if user or mail is exist
					$info = D("user");
					if(!$info->create($loginfo)){
						exit($User->getError());
					}
					if($info -> add())
					 {       //Insert into Datebase Begin
						if ($info = M('user') -> where($loginfo) -> find()) {
						$valid = true;
						unset($info['password']);
						session('userinfo',$info);
					}
				}else{
						
						$message = '系统错误';
						} //End
					}else{
						$valid = false;
						$message = "该用户或邮箱已存在";
					}
				}
			}
		}
			$data = session('userinfo');
	$data['valid'] = $valid;
	$data['message'] = $message;
	$this->ajaxReturn($data);
	}
	public function logout(){
		// $Url = I('server.HTTP_REFERER');
		$Url = $_SERVER['HTTP_REFERER'];
		session('userinfo',null);
		// redirect($Url,0,null);
		if (isset($Url)) 
{ 
Header("HTTP/1.1 303 See Other"); 
Header("Location: $Url"); 
exit; 
} 
	}
	public function getverify(){
		verify();
	}
}
?>