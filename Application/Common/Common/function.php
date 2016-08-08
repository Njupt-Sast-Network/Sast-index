<?php 
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=false){//截取固定长度的字符串
 	if(function_exists("mb_substr")){
		if($suffix&&(mb_strlen($str)>$length))
			return mb_substr($str, $start, $length, $charset)."…";
		else
			return mb_substr($str, $start, $length, $charset);
	}elseif(function_exists('iconv_substr')) {
		if($suffix&&(mb_strlen($str)>$length))
			return iconv_substr($str,$start,$length,$charset)."…";
		else
			return iconv_substr($str,$start,$length,$charset);
	}
	$re['utf-8'] = "/[x01-x7f]|[xc2-xdf][x80-xbf]|[xe0-xef][x80-xbf]{2}|[xf0-xff][x80-xbf]{3}/";
	$re['gb2312'] = "/[x01-x7f]|[xb0-xf7][xa0-xfe]/";
	$re['gbk'] = "/[x01-x7f]|[x81-xfe][x40-xfe]/";
	$re['big5'] = "/[x01-x7f]|[x81-xfe]([x40-x7e]|xa1-xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("",array_slice($match[0], $start, $length));
	if($suffix) return $slice."…";
	return $slice;
}

function verify(){//验证码调用方法
	$Verify = new \Think\Verify();
	$Verify->fontSize = 16;
	$Verify->length   = 4;
	$Verify->useNoise = ture;
	$Verify->useCurve = false;
	$Verify->imageH = 30;
	$Verify->entry();
}

function check_verify($code, $id = ""){//检查验证码输入是否正确
	$verify = new \Think\Verify();
	return $verify->check($code, $id);
}  

function getcomnumber($type,$id){
	$comdb = M('comment');
	$wheretwo = "type=".$type." and id=".$id;
	$comnumber = $comdb -> where($wheretwo) -> count();
	return $comnumber;
}
function getlikenumber($type,$id){
	$comdb = M('like');
	$wheretwo = "type=".$type." and id=".$id;
	$comnumber = $comdb -> where($wheretwo) -> count();
	return $comnumber;
}

function getcomnumbersearch($type,$id){
	if($type == 1)
		$type = 2;
	if($type == 2)
		$type = 1;
	$comdb = M('comment');
	$wheretwo = "type=".$type." and id=".$id;
	$comnumber = $comdb -> where($wheretwo) -> count();
	return $comnumber;
}
function getlikenumbersearch($type,$id){
	if($type == 1)
		$type = 2;
	if($type == 2)
		$type = 1;
	$comdb = M('like');
	$wheretwo = "type=".$type." and id=".$id." and islike = 1";
	$comnumber = $comdb -> where($wheretwo) -> count();
	return $comnumber;
}


function whichid($type){
			switch ($type) {
		case 0:
			$or = "work_id";
			break;
		case 1:
			$or = "talk_id";
			break;
		case 2:
			$or = "news_id";
			break;
		case 3:
			$or = "wiki_id";
			break;
		default:
			$or = "news_id";
			break;
		}
		return $or;
}

function whichidsearch($type){
			switch ($type) {
		case 0:
			$or = "work_id";
			break;
		case 2:
			$or = "talk_id";
			break;
		case 1:
			$or = "news_id";
			break;
		case 3:
			$or = "wiki_id";
			break;
		default:
			$or = "news_id";
			break;
		}
		return $or;
}


function verifyuser()
{
 if (session('userinfo')) 
{
    	$sess = session('userinfo');
        $data['username'] = $sess['username'];
        $db = M('user');
        $where = "username='".$data['username']."'";
        if($db->where($where)->find())
        {
        	return 1;
        }
        else
        {
        	return 0;
        }
    }else{
    	return 0;
    }
}

function getpassword( $length = 8 ) {
    // 密码字符集，可任意添加你需要的字符
    $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()-_ []{}<>~`+=,.;:/?|';

    $password = '';
    for ( $i = 0; $i < $length; $i++ ) 
    {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $password .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
    }

    return $password;
}

	function verifyadmin()
{
 if(session('userinfo')) 
{
    	$sess = session('userinfo');
        $data['username'] = $sess['username'];
        $db = M('user');
        $where = "level=1 and username='".$data['username']."'";
        if($db->where($where)->find())
        {
        	return 1;
        }
        else
        {
        	return 0;
        }
    }else{
    	return 0;
    }
}
?>