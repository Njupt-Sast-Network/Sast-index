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
        if($db -> where("mail = '".$_POST['mail']."'") -> find())
        {
            if($auth -> where("mail = '".$_POST['mail']."'") -> find())
            {
                $auth -> where("mail = '".$_POST['mail']."'") -> delete();
            }


                $user = $db -> where("mail = '".$_POST['mail']."'") -> select();
                $authid = md5(getpassword());
                $info['mail'] = $_POST['mail'];
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
        $mail->AddAddress($_POST['mail'],"用户");
        $mail->WordWrap = 50; //设置每行字符长度
        $mail->IsHTML(C('MAIL_ISHTML')); // 是否HTML格式邮件
        $mail->CharSet=C('MAIL_CHARSET'); //设置邮件编码
        $mail->Subject ='密码重置'; //邮件主题
        $mail->Body = $content; //邮件内容
        $mail->AltBody = "这是一个纯文本的身体在非营利的HTML电子邮件客户端"; //邮件正文不支持HTML的备用显示
        if($mail->send())
                $msg['isdone'] = true;
            else
                $msg['isdone'] = false;
                }
        }else{
          $msg['isdone'] = false;
        }
        $this -> ajaxReturn($msg);
}

        public function verifymail(){
                if($_GET['id']!=NULL)
                {
                        $authid = $_GET['id'];
                        $dbback = M('back');
                        if($dbback -> where("id ='".$authid."'") -> find())
                        {
                                $mail = $dbback -> where("id ='".$authid."'") -> select();
                                $dbback -> where("mail = '".$mail[0]['mail']."'") -> delete();
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
                        $pass = MD5($_POST['password']);
                        $data['password'] = $pass;
                        if($dbuser -> where("mail='".$sess['mail']."'") -> save($data))
                                        $isdone = true;
                                else
                                        $isdone =false;
                     
                }else{
            $isdone = false;
        }
            }else{
            $isdone = false;
        }
        }else{
            $isdone = false;
        }
                $info['isdone'] =$isdone;
                $this -> ajaxReturn($info);
            
        }
}
?>