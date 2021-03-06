<?php
namespace Admin\Controller;
use Think\Controller;
class TicketController extends Controller {
    public function ticket_r(){
        $db = M('Orderticketview');

        $page = $_REQUEST['page'];
        $pageSize = $_REQUEST['rows'];
        //REQUEST = POST or GET
        if($_REQUEST['name']OR$_REQUEST['movie_name']){
            $condit['name'] = array('like',$_REQUEST['name']);
            $condit['movie_name'] = array('like',$_REQUEST['movie_name']);
        }
        
        $result = $db->where($condit)->page($page,$pageSize)->select();
        $data['total'] = $db->where($condit)->count();
        $data['rows'] = $result;
       // $result = $db->select();
        if($data) {
            $this->ajaxReturn($data);
        }
    }
    public function append_c() {
        
        //find single price
        $db = M('Sessionview');
        $condit['s_id'] = array('eq',$_REQUEST['s_id']);
        $single_price = $db->where($condit)->getField('price');
        //find seat count
        $db = M('Orderticketview');
        $data = $db->create();
        $split_seat = explode('-',$data['seat']);
        $quantity = count($split_seat);
        //put quantity and cost and date
         $data['quantity'] = $quantity;
         $data['cost'] = $quantity * $single_price;
         $data['order_date'] = date("Y-m-d");
         $data['enable'] = 1;

        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
    }
    public function destroyRow_c(){
        $db = M('Orderticket');
        $conit['ot_id'] = array('eq',$_REQUEST['delete_ot_id']);
        $result = $db->where($conit)->delete();
        if(!$result){
            $this->ajaxReturn($db->getError());
        } else{
            $this->ajaxReturn(true);
        }
    }
    public function edit_c(){
        $db = M('Orderticket');
        $condit['ot_id'] = array('eq',$_REQUEST['ot_id']); 
        $data = $db->create();
        $result = $db->where($condit)->save($data);
        if($result) {
            $this->ajaxReturn(true);
        } else {
            echo $db->getError();
        }
    }
}