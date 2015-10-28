<?php
namespace Admin\Controller;
use Think\Controller;
class MemberController extends Controller {
    public function member_r(){
        $db = M('Member');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
    public function member_u(){
    	$db = M('Member');
    	$condit['m_id'] = array('eq',$_REQUEST['m_id']); 
    	$data = $db->create();
    	$result = $db->where($condit)->save($data);
    	if($result) {
    		$this->ajaxReturn(true);
    	} else {
    		echo $db->getError();
    	}
    }
    public function store(){
    	$db = M('Member');
    	$condit['m_id'] = array('eq',$_REQUEST['m_id']); 
    	$result = $db->where($condit)->setInc('cash',$_REQUEST['money']);
    	if($result) {
    		$this->ajaxReturn(true);
    	} else {
    		echo $db->getError();
    	}
    }
}