<?php
namespace Index\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
    	$date = $this -> news();
    	$this -> assign('news',F('news'));
    	$this -> display();
    }
    private function news(){
    	$news = D('News') -> field('title,text') -> where() -> select();
    	if (!F('news')) F('news',$news);
    }
}