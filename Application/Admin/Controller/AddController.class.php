<?php
namespace Admin\Controller;
use Think\Controller;
class AddController extends Controller {


public function upload(){
        if (session('userinfo')) 
{
    $sess = session('userinfo');
        $data['username'] = $sess['username'];
        $db = M('user');
        $where = array('level' => 1 , 'username' => $data['username']);
        if($db->where($where)->find())
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
        }else{// 上传成功 获取上传文件信息
            foreach($info as $file){
                 $img = $file['savepath'].$file['savename'];
                                    }
                 }
    $news['title'] = I('post.title',"");
    $news['author'] = I('post.author',"");
    $news['keywords'] = I('post.keywords',"");
    $news['simple'] = I('post.simple',"");
    $news['text'] = $_POST['text'];
    $news['img'] = $img;
    $db = M('news');
    if($db->add($news))
    {
        F('news',NULL);
        echo("<script>alert('发布成功')</script>");
                $Url = $_SERVER['HTTP_REFERER'];
        if (isset($Url)) 
{ 
Header("HTTP/1.1 303 See Other"); 
Header("Location: $Url"); 
exit; 
} 
    }
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

    public function addimg(){
        if (session('userinfo')) 
{
    $sess = session('userinfo');
        $data['username'] = $sess['username'];
        $db = M('user');
        $where = array('level' => 1 , 'username' => $data['username']);
        if($db->where($where)->find())
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
                 $img ="/Uploads/".$file['savepath'].$file['savename'];
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