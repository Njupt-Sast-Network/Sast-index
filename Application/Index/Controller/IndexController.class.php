<?php
namespace Index\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$date = $this -> news();
    	// F('news',NULL);
    	$this -> assign('news',F('news'));
    	$this -> display();
    }
    private function news(){
    	$news = D('News') -> field('title,text') -> where()->order('news_id desc') -> select();
    	if (!F('news')) F('news',$news);
    }
    public function mobile(){
        $this ->display();
    }
}