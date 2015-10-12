<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	//View display
    public function index(){
    	$db = M('News');
    	//news page
    	$page = 0;
    	if ($_REQUEST['page'])
    		$page=$_REQUEST['page'];
    	$news = $db->page("$page,5")->select();
    	$this->assign('news',$news);
    	$news_count = $db->count();
    	$this->assign('news_count',round($news_count/5));
    	//movie
    	$db = M('Movie');
    	$movie = $db->select();
    	$this->assign('movie',$movie);
    	//auth
        if(session('auth')){
            $session_auth = session('auth');
            $this->assign('email',$session_auth['email']);
            $this->assign('name',$session_auth['name']);
        }
        $this->display();
    }
    public function order(){
        $db = M('Food');
        $food = $db->select();
        $this->assign('food',$food);
        $this->display();
    }
    public function order_t(){
        $this->display();
    }
    public function member(){
        $this->display();
    }
    public function ticket(){
        $this->display();
    }
    public function discount(){
        $this->display();
    }

    //Feature
    public function checkAccount(){
    	$db = D('Member');
    	$data['email'] = $_REQUEST['email'];
    	$result = $db->create($data);
    	if (!$result) {
    		$this->ajaxReturn($db->getError());
    	} else {
    		$this->ajaxReturn(true);
    	}
    }
    
    public function signUp(){
        $db = D('Member');
        $data = $db->create();
        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
    }

    public function signIn(){
        $db = M('Member');
        $data = $db->create();
        $cond['email'] = $data['email'];
        $cond['password'] = $data['password'];
        $result = $db->where($cond)->select(); 
        if (!$result) {
            $this->ajaxReturn(false);
        } else {
            session('auth',$result[0]);
            $this->ajaxReturn($result[0]['name']);
        }
    }

}