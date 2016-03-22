<?php
namespace Admin\Controller;
use Think\Controller;
class DiscountController extends Controller {
    public function discount_r(){
        $db = M('Discountview');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
    public function append_c() {
        $db = M('Discount');
        $data = $db->create();
        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
    }
    public function destroyRow_c(){
    	$db = M('Discount');
    	$conit['d_id'] = array('eq',$_REQUEST['delete_d_id']);
        $result = $db->where($conit)->delete();
    	if(!$result){
    		$this->ajaxReturn($db->getError());
    	} else{
    		$this->ajaxReturn(true);
    	}
    }
    public function edit_c(){
        $db = M('Discount');
        $condit['d_id'] = array('eq',$_REQUEST['d_id']); 
        $data = $db->create();
        $result = $db->where($condit)->save($data);
        if($result) {
            $this->ajaxReturn(true);
        } else {
            echo $db->getError();
        }
    }
}