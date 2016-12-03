<?php 
namespace Index\Controller;
use Think\Controller;
class BackController extends Controller {
        public function index(){
            $this ->display();
        }
        public function getmail(){
        $db = M('user');
        $auth = M('back');
        $where['mail'] = I('post.mail',"",'email');
        if($db -> where($where) -> find())
        {
            if($auth -> where($where) -> find())
            {
                $auth -> where($where) -> delete();
            }


                $user = $db -> where($where) -> select();
                $authid = md5(getpassword());
                $info['mail'] = I('post.mail',"",'email');
                $info['id'] = $authid;
                $content = "请打开以下地址来设置你的新密码。 http://sast.njupt.edu.cn/index.php/Back/verifymail?id=".$authid;
                if($auth -> data($info) -> add())
                {
                             //发邮件开始
                           Vendor('PHPMailer.PHPMailerAutoload');    
        if($mail = new \PHPMailer()) //实例化
        $mail->IsSMTP(); // 启用SMTP
        $mail->Host=C('MAIL_HOST'); //smtp服务器的名称（这里以QQ邮箱为例）
        $mail->SMTPAuth = C('MAIL_SMTPAUTH'); //启用smtp认证
        $mail->Username = C('MAIL_USERNAME'); //你的邮箱名
        $mail->Password = C('MAIL_PASSWORD') ; //邮箱密码
        $mail->From = C('MAIL_FROM'); //发件人地址（也就是你的邮箱地址）
        $mail->FromName = C('MAIL_FROMNAME'); //发件人姓名
        $mail->AddAddress($info['mail'],"用户");
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
        $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
        $mail->Subject ='密码重置'; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = "请使用浏览器打开此邮件"; //邮件正文不支持HTML的备用显示
        if($mail->send())
                $msg['isdone'] = true;
            else{
                $msg['isdone'] = false;
                        $msg['msg'] = "发送失败。";}
                }
        }else{
          $msg['isdone'] = false;
          $msg['msg'] = "没有这个用户！";
        }
        $this -> ajaxReturn($msg);
}

        public function verifymail(){
                if($_GET['id']!=NULL)
                {
                        $authid = I('get.id',"");
                        $dbback = M('back');
                        $where['id'] = $authid;
                        if($dbback -> where($where) -> find())
                        {
                                $mail = $dbback -> where($where) -> select();
                                $consult['mail'] = $mail[0]['mail'];
                                $dbback -> where($consult) -> delete();
                                $change['authid'] = $authid;
                                $change['mail'] = $mail[0]['mail'];
                                $change['isvalid'] = true;
                                session('changeinfo',$change);
                                $this -> display();
                        }
                }else
                {
                    echo "Error";
                }
        }

        public function change(){
            if(session('changeinfo')){
                if(IS_POST){
                    $sess = session('changeinfo');
                    if($sess['isvalid'] == true){
                        $authid = $sess['authid'];
                        $dbuser = M('user');
                        $ipassword = I('post.password',"");
                        $pass = MD5($ipassword);
                        $data['password'] = $pass;
                        $where['mail'] = $sess['mail'];
                        if($dbuser -> where($where) -> save($data))
                                        $isdone = true;
                                else
                                        $isdone =false;
                     
                }else{
            $isdone = false;
                        $info['msg'] = "你没有权限进入这里。";
        }
            }else{
            $isdone = false;
            $info['msg'] = "你没有权限进入这里。";
        }
        }else{
            $isdone = false;
            $info['msg'] = "你没有权限进入这里。";
        }
                $info['isdone'] =$isdone;
                $this -> ajaxReturn($info);
            
        }
}
?>