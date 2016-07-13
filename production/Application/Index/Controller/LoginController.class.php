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
					$loginfo['password'] = $_POST['password'];
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

	public function logout(){
		$Url = I('server.HTTP_REFERER');
		session('userinfo',null);
		redirect($Url,0,null);
	}

	public function getverify(){
		verify();
	}
}

?>