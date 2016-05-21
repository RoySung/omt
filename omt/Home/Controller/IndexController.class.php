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
    	$news = $db->page("$page,5")->order('date desc')->select();
    	$this->assign('news',$news);
    	$news_count = $db->count();
    	$this->assign('news_count',round($news_count/5));
    	//recent_movie
    	$db = M('Moviegradeview');
        $date = date("Y-m-d");
        $condit['start_date'] = array('lt',$date);
    	$movie = $db->field('*,round(avg(grade),2)')->group('mo_id')->select();

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
        $db = M('Moviegradeview');
        //$i = 4.53212;
        //var_dump(number_format($i,2));

        //get need field->conbin same->rank->get avg grade >=0 infomation
        $moviegrade = $db->field('*,round(avg(grade),2)')->group('mo_id')
        ->order('round(avg(grade),2) DESC')->having('round(avg(grade),2)>=0')->select();

        $this->assign('rank',$moviegrade);
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
        //history_theater
        $condit['m_id'] = $session_auth['m_id'];
        $history_title = $db->distinct(true)->where($condit)->field('t_id, theater_name')->select();
        $this->assign('history_title', $history_title);
        //
        //ticket show
        $count = $db->where($condit)->field('count')->select();
        $sum_count = $db->where($condit)->count();
        //var_dump($count);

        for($z=0;$z<$sum_count;$z++)
        {
            //var_dump($z);
            $data = $db->where($condit)->limit($count[$i]['count'])->select();
            $this->assign('ticket_content',$data);
            
        }
        
        $data = $db->where($condit)->select();
        $this->assign('ticket_title',$data);
       

        //orderfoodrecord
        $db = M('Orderfoodview');
        $session_auth = session('auth');
        $this->assign('auth',$session_auth);
        $condit['m_id'] = $session_auth['m_id'];
        $data = $db->where($condit)->select();
        $this->food_result = 1;
        if(!$data)
        {
            $this->food_result = 0;
        }
        $tom = $db->distinct(true)->where($condit)->field('ot_id, theater_name')->select();
        $this->assign('orderfoodrecord',$data);
        $this->assign('food_number',$tom);
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
    public function grade_save(){
        $db = M('Moviegradeview');
        $condit['mo_id'] = $_REQUEST['mo_id'];
        $condit['m_id'] = $_REQUEST['m_id'];
        $data['grade'] = $_REQUEST['member_grade'];
        $data['grade_date'] = date("Y-m-d");
        $old_result = $db->where($condit)->select();
        $result = $db->where($condit)->save($data);
        if($result){
            $this->ajaxReturn($data['grade']);
        }else{
            $this->ajaxReturn($result);
        }
    }

}