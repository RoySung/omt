<?php
namespace Home\Controller;
use Think\Controller;
use Home\Common\PublicFunction;
class OrderTicketController extends Controller {
    public function theater_r(){
        $db = M('Theater');
        $result = $db->select();
        if ($result) {
            $this->ajaxReturn($result);
        } else {
            $this->ajaxReturn($db->getError());
        }
    }
    public function movie_r(){
        $db = M('Session');
        $cond_session['t_id'] = $_REQUEST['t_id'];
        $cond_session['date'] = $_REQUEST['date'];
        $mo_id = $db->where($cond_session)->field('mo_id')->select();
        
        $data = array();
        foreach ($mo_id as $value) {
            $db = M('Movie');
            $cond_movie['mo_id'] = $value['mo_id'];

            $movie = $db->where($cond_movie)->field('mo_id,movie_name')->select();
            array_push($data,$movie[0]);
        }
        $handle = new PublicFunction;
        $data = $handle->ArrayUnique($data);
        $this->ajaxReturn($data);
    }
    public function session_r(){
        $db = M('Session');
        $cond_session['t_id'] = $_REQUEST['t_id'];
        $cond_session['date'] = $_REQUEST['date'];
        $cond_session['mo_id'] = $_REQUEST['mo_id'];
        $result = $db->where($cond_session)->select();
        if ($result) {
            $this->ajaxReturn($result);
        }
    }
    public function sold_ticket(){
        $db = M('Orderticket');
        $conit['s_id'] = array('eq',$_REQUEST['s_id']);
        $seat = $db->where($conit)->field('seat')->select();
        $seats = "";
        foreach($seat as $value){
            $seats =$seats . $value['seat'] . "-"; 
        }
        $seats = substr($seats,0,$seats.length-1);
        $split_seat = explode('-',$seats);
        $list = array(
            "A"=>1,
            "B"=>2,
            "C"=>3,
            "D"=>4,
            "E"=>5,
            "F"=>6,
            "G"=>7,
            "H"=>8,
            "I"=>9,
            "J"=>10
            );
        $result= array();
        foreach ($split_seat as $value) {
            array_push($result,$list[substr($value,0,1)] . "_" . substr($value,1,strlen($value)-1));
        }
        $this->ajaxReturn($result);
    }
    public function ticketPrice_r(){
        $db = M('Movie');
        $cond_movie['mo_id'] = $_REQUEST['mo_id'];
        $filetype = $db->where($cond_movie)->field('film_type')->select();

        $db = M('Ticketprice');
        $cond_price['t_id'] = $_REQUEST['t_id'];
        $cond_price['type'] = $filetype[0]['film_type'];
        $result = $db->where($cond_price)->select();
        if ($result) {
            $this->ajaxReturn($result);
        }
    }
    public function orderticket_c(){
        $data['s_id'] = $_REQUEST['s_id'];
        $data['seat'] = $_REQUEST['seat'];
        $data['quantity'] = $_REQUEST['quantity'];
        $data['enable'] = 1;
        $data['m_id'] = $_REQUEST['m_id'];;
        $data['cost'] = $_REQUEST['cost'];
        $data['order_date'] = date("Y-m-d");
        //cost
        $db = M('Member');
        $condit['m_id'] = $data['m_id'];
        $condit['cash'] = array('egt',$data['cost']);
        $result = $db->where($condit)->setDec('cash',$data['cost']);
        if(!$result) {
            $this->ajaxReturn(false);
        }
        //add Order Ticket
        $db = M('Orderticket');
        $result = $db->add($data);
        if($result) {
            $this->ajaxReturn(true);
        }
        
    }
}