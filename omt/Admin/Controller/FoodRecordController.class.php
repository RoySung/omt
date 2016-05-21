<?php
namespace Admin\Controller;
use Think\Controller;
class FoodRecordController extends Controller {
    var $result_f_id = 0;
    public function foodrecord_r(){
        $db = M('Orderfoodview');

        $page = $_REQUEST['page'];
        $pageSize = $_REQUEST['rows'];
        //REQUEST = POST or GET
        if($_REQUEST['phone']OR$_REQUEST['food_name']){
            $condit['phone'] = array('like',$_REQUEST['phone']);
            $condit['food_name'] = array('like',$_REQUEST['food_name']);
        }
        
        $result = $db->where($condit)->page($page,$pageSize)->order('food_orderdate desc')->select();
        $data['total'] = $db->where($condit)->count();
        $data['rows'] = $result;
       // $result = $db->select();
        if($data) {
            $this->ajaxReturn($data);
        }
    }

    public function append_c() {
        //find f_id data
        $db = M('Food');
        $condit['f_id'] = $_REQUEST['f_id'];
        $result_f_id = $db->where($condit)->select();
        //check f_id exist
        if(!$result_f_id){
            $this->ajaxReturn("food index is not exist");
        }
        //find m_id
        $db = M('Member');
        $condit['phone'] = $_REQUEST['phone'];
        $result_m_id = $db->where($condit)->getField('m_id');
        //check phone number exist
        if(!$result_m_id){
            $this->ajaxReturn('phone number is not exist');
        }
        //check ot_id exist and this m_id have this ot_id
        $db = M('Orderticket');
        $condit = "";
        $condit['m_id'] = $result_m_id;
        $condit['ot_id'] = $_REQUEST['ot_id'];
        $condit['_logic'] = 'AND';

        $result_ot_id = $db->where($condit)->select();
        if(!$result_ot_id){
            $this->ajaxReturn('orderticket index is not exist');
        }
        //put about food
        $db = M('Orderfood');
        $data = $db->create();
        $data['food_orderdate'] = date("Y-m-d");
        $data['food_size'] = $result_f_id[0]['size'];
        $data['food_cost'] = $result_f_id[0]['price']*$_REQUEST['food_quantity'];
        $data['food_name'] = $result_f_id[0]['food'];

        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);

            $this->ajaxReturn(true);
        }
    }
    public function destroyRow_c(){
        $db = M('Orderfood');
        $conit['of_id'] = array('eq',$_REQUEST['delete_of_id']);
        $result = $db->where($conit)->delete();
        if(!$result){
            $this->ajaxReturn($db->getError());
        } else{
            $this->ajaxReturn(true);
        }
    }
    public function edit_c(){
        $db = M('Orderfood');
        $condit['of_id'] = array('eq',$_REQUEST['of_id']); 
        $data = $db->create();
        //find origin data
        $result_food_quantity = $db->where($condit)->getField('food_quantity');
        $result_food_cost=$db->where($condit)->getField('food_cost');
        //count single price
        $single_price=$result_food_cost/$result_food_quantity;
        //put new data
        $data['food_cost'] = $single_price*$_REQUEST['food_quantity'];
        
        $result = $db->where($condit)->save($data);
        if($result) {
            $this->ajaxReturn(true);
        } else {
            echo $db->getError();
        }
    }
}