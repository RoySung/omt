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
            $this->assign('auth',$session_auth);
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
        $db = M('Member');
        $session_auth = session('auth');
        $this->assign('auth',$session_auth);
        $this->display();
    }
    public function ticket(){
        $db = M('Orderticket'); //座位,人數
        $session_auth = session('auth');
        $condit['m_id'] = $session_auth['m_id'];
        $count = $db->where($condit)->count(); //票劵數量 2
        //$data = $db->where($condit)->field('seat,quantity')->select();
        $data = $db->where($condit)->select();
        $session = $data['ot_id'];

        for($i=0;$i<$count;$i++)
        {
            $db = M('Movie'); //電影名稱
            $condit['mo_id'] = $data[$i]['mo_id'];
            $data_name = $db->where($condit)->field('movie_name')->select();
            $data[$i]['movie_name'] = $data_name[0]['movie_name'];

            $db = M('Session'); //時間,場次
            $condit['s_id'] = $data[$i]['s_id'];
            $data_session = $db->where($condit)->field('time,date,t_id')->select();
            $data[$i]['time'] = $data_session[0]['time'];
            $data[$i]['date'] = $data_session[0]['date'];

            /*$db = M('Theater');//影院名稱
            $condit['t_id'] = $data_session[0]['t_id'];
            $data_theater = $db->where($condit)->field('theater_name')->select();
            $data[$i]['theater_name'] = $data_theater[0]['theater_name'];*/
        }
        /*for($i=0;$i<$count;$i++)
        {
            $db = M('Theater');//影院名稱
            $condit['t_id'] = $data_session[0]['t_id'];
            $data_theater = $db->where($condit)->field('theater_name')->select();
            $data[$i]['theater_name'] = $data_theater[0]['theater_name'];
        }*/

        /*$db = M('Movie'); //電影名稱
        $condit['mo_id'] = $data[0]['mo_id'];
        $data_name = $db->where($condit)->field('movie_name')->select();
        $data[$count-2]['movie_name'] = $data_name[0]['movie_name'];

        /*$db = M('Session'); //時間,場次
        $condit['s_id'] = 1;
        $data = $db->where($condit)->select();
        $result[0]['time'] = $data[0]['time'];
        $result[0]['date'] = $data[0]['date'];*/


        $this->assign('ticket',$data);
        $this->display();
    }
    public function discount(){
        $db = M('Discount');
        $session_auth = session('auth');
        $condit['m_id'] = $session_auth['m_id'];
        $data = $db->where($condit)->select();

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