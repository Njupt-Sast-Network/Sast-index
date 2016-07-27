<?php
namespace Admin\Controller;
use Think\Controller;
class AddController extends Controller {


public function upload(){
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
    $news['title'] = $_POST['title'];
    $news['author'] = $_POST['author'];
    $news['keywords'] = $_POST['keywords'];
    $news['simple'] = $_POST['simple'];
    $news['text'] = $_POST['text'];
    $news['img'] = $img;
    $db = M('news');
    if($db->add($news))
    {
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

}