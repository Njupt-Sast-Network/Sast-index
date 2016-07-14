<?php
namespace Home\Model;
use Think\Model;
class LoginModel extends Model {
    // 定义自动验证
    protected $_validate    =   array(
        array('username','require','用户名必须'),
        array('password','require','用户名必须'),
        array('verify','require','验证码必须！'), 
        array('username', 'checklength', '用户名长度必须在3-16位之间！', 0, 'callback', 3, array(3, 16)),
                array('password', 'checklength', '密码长度必须在6-16位之间！', 0, 'callback', 3, array(6, 16)),
        
        
        
        
        );
        
        
        
        
        
        
    function checklength($str, $min, $max) {
        preg_match_all("/./u", $str, $matches);
        $len = count($matches[0]);
        if ($len < $min || $len > $max) {
            return false;
        } else {
            return true;
        }
    }
 }