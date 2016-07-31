<?php 
namespace Index\Controller;
use Think\Controller;
class LoginController extends Controller {
	public function login(){
		if (!session('userinfo')) {
			if (IS_POST) {
				$loginfo['verify']=$_POST['verify'];
				if (!check_verify($loginfo["verify"])) {
					$valid = false;
					$message = '验证码错误';
				}else{
					$loginfo['username'] = $_POST['username'];
					$loginfo['password'] = md5($_POST['password']);
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
					if (!session('userinfo')) {
			if (IS_POST) {
				$loginfo['verify']=$_POST['verify'];
				if (!check_verify($loginfo["verify"])) {
					$valid = false;
					$message = '验证码错误';
				}else{
					$loginfo['username'] = $_POST['username'];
					$loginfo['password'] = md5($_POST['password']);
					$loginfo['mail'] = $_POST['email'];
					$loginfo['level'] = '3';
					$test['username'] =  $_POST['username'];
					if (!($info = M('user') -> where($test) -> find())){  // check if user is exist
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
						$message = "该用户已存在";
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