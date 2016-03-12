<?php
namespace Admin\Controller;
use Think\Controller;
class FoodController extends Controller {
    public function food_r(){
        $db = M('Food');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
    public function append_c() {
        $db = M('Food');
        $data = $db->create();
        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
    }
    public function destroyRow_c(){
    	$db = M('Food');
    	$conit['f_id'] = array('eq',$_REQUEST['delete_f_id']);
        $result = $db->where($conit)->delete();
    	if(!$result){
    		$this->ajaxReturn($db->getError());
    	} else{
    		$this->ajaxReturn(true);
    	}
    }

}