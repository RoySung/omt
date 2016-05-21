<?php
namespace Home\Controller;
use Think\Controller;
class OrderFoodController extends Controller {
    public function get_orderticket_r(){
        $db = M('Orderticketview');
        $condit['m_id'] = $_REQUEST['m_id'];
        $result = $db->where($condit)->select();
        if ($result) {
            $this->ajaxReturn($result);
        } else {
            $this->ajaxReturn($db->getError());
        }
    }
    public function soldfood(){
        $data['food_name'] = $_REQUEST['food_name'];
        $data['food_quantity'] = $_REQUEST['food_quantity'];
        $data['food_cost'] = $_REQUEST['food_cost'];
        $data['food_orderdate'] = date("Y-m-d");
        $data['food_size'] = $_REQUEST['food_size'];
        $data['ot_id'] = $_REQUEST['ot_id'];
        $data['food_enable'] = 1;
        $data['f_id'] = $_REQUEST['f_id'];
        $data['discount'] = 0;
        //cost 
        $db = M('Discountview');
        $con['cash'] = array('egt',$data['food_cost']);
        $result = $db->where($con)->setDec('cash',$data['food_cost']);
        if(!$result){
            $this->ajaxReturn(false);
        }
        //discount
        $date = date("Y-m-d");
        $condit['start_date'] = array('ELT',$date);
        $condit['m_id'] = $_REQUEST['m_id'];
        $condit['type_name'] = array('eq',$_REQUEST['type_name']);
        $condit['enable'] = 1;
        $result = $db->where($condit)->order('start_date')->limit(1)->setInc('cash','discount');
        if($result){
            $con = $db->where($condit)->order('start_date')->limit(1)->getField('d_id');
            $condit['d_id'] = $con;
            $discount_money = $db->where($condit)->getField('discount');
            $result = $db->where($condit)->setField('enable','0');
        }else{
            $discount_money=0;
        }
        

        //no use discount
        /*$db = M('Member');
        $condit['m_id'] = $_REQUEST['m_id'];
        $condit['cash'] = array('egt',$data['food_cost']);
        $result = $db->where($condit)->setDec('cash',$data['food_cost']);
        if(!$result) {
            $this->ajaxReturn(false);
        }*/
        // add Order food
        $db = M('Orderfood');
        $data['discount_money'] = $discount_money;
        $result = $db->add($data);
        if($result) {
            $this->ajaxReturn(true);
        }
    }
}