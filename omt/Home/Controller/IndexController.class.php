<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
	//View display
    public function index(){
    	$db = M('News');
    	//news page
    	$page = 0;
    	if ($_REQUEST['page'])//有沒有職收到 get保留有暫存 post 沒有暫存
    		$page=$_REQUEST['page'];
    	$news = $db->page("$page,5")->select();
    	$this->assign('news',$news);
    	$news_count = $db->count();
    	$this->assign('news_count',round($news_count/5));
    	//recent_movie
    	$db = M('Movie');
        $date = date("Y-m-d");
        $condit['start_date'] = array('lt',$date);
    	$movie = $db->where($condit)->select();
    	$this->assign('recent_movie',$movie);
        //soon_movie
        $db = M('Movie');
        $date = date("Y-m-d");
        $condit['start_date'] = array('gt',$date);
        $movie = $db->where($condit)->select();
        $this->assign('soon_movie',$movie);
    	//auth
        if(session('auth')){
            $session_auth = session('auth');
            $this->assign('auth',$session_auth);
        }
        //rank
        $db = M('Movie');
        $date = date("Y-m-d");
        $condit['start_date'] = array('lt',$date);
        $movie = $db->where($condit)->limit(5)->order('grade desc')->select();
        $this->assign('rank',$movie);





        $this->display();
    }
    public function order(){
        $db = M('Food');
        if(session('auth')){
            $session_auth = session('auth');
            $this->assign('auth',$session_auth);
        }
        $food = $db->select();
        $this->assign('food',$food);
        $this->display();
    }
    public function order_t(){
        //auth
        if(session('auth')){
            $session_auth = session('auth');
            $this->assign('auth',$session_auth);
        }
        $this->display();
    }
    public function member(){
        $db = M('Member');
        $session_auth = session('auth');
        $condit['m_id'] = array('eq',$session_auth['m_id']);
        $auth = $db->where($condit)->select(); 
        session('auth',$auth[0]);
        $this->assign('auth',$auth[0]);
        $this->display();
    }
    public function ticket(){
        $db = M('Orderticketview');
        $session_auth = session('auth');
        $this->assign('auth',$session_auth);
        $condit['m_id'] = $session_auth['m_id'];
        $data = $db->where($condit)->select();

        $this->result = 1;
        if(!$data)
        {
            $this->result = 0;
        }
        //$data_seat = 'A7-B5';
        $test = explode('-', $data[0]['seat']);
        for ($i=0;$i<count($test);$i++)
        {
            $seat_row[$i] = substr($test[$i],0,1);
            $seat_num[$i] = substr($test[$i],1,1);   
        }
        $this->seat_row = $seat_row;
        $this->seat_num = $seat_num;
        $this->test=$seat_row;

        $this->assign('ticket',$data);
        $this->display();
    }
    public function discount(){
        $db = M('Discount');
        $session_auth = session('auth');
        $this->assign('auth',$session_auth);
        $condit['m_id'] = $session_auth['m_id'];
        $data = $db->where($condit)->select();
        $this->result = 1;
        if(!$data)
        {
            $this->result = 0;
        }
        $this->assign('discount',$data);
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