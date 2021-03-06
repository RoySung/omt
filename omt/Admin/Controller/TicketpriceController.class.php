<?php
namespace Admin\Controller;
use Think\Controller;
class TicketpriceController extends Controller {
    public function ticketprice_r(){
        $db = M('Ticketpriceview');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
    public function append_c() {
        //check t_id exist
        $db = M('Theater');
        $condit['t_id'] = $_REQUEST['t_id'];
        $result = $db->where($condit)->select();
        if(!$result){
            $this->ajaxReturn("theater index no exist");
        }
        //check mo_id exist
        $db = M('Movie');
        $condit['mo_id'] = $_REQUEST['mo_id'];
        $result = $db->where($condit)->select();
        if(!$result){
            $this->ajaxReturn("movie index no exist");
        }
        //check mo_id and t_id exist price
        $db = M('Ticketprice');
        $result = $db->where($condit)->getField('tp_id');
        if($result){
            //return tp_id
            $this->ajaxReturn(false);
        }
        //put add data
        $data = $db->create();
        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
    }
    public function destroyRow_c(){
    	$db = M('Ticketprice');
    	$conit['tp_id'] = array('eq',$_REQUEST['delete_tp_id']);
        $result = $db->where($conit)->delete();
    	if(!$result){
    		$this->ajaxReturn($db->getError());
    	} else{
    		$this->ajaxReturn(true);
    	}
    }
    public function edit_c(){
        $db = M('Ticketprice');
        $condit['tp_id'] = array('eq',$_REQUEST['tp_id']); 
        $data = $db->create();
        $result = $db->where($condit)->save($data);
        if($result) {
            $this->ajaxReturn(true);
        } else {
            echo $db->getError();
        }
    }
}