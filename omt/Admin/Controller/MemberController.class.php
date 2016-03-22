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
    public function append_c() {
        $db = M('Member');
        $data = $db->create();
        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
    }
    public function destroyRow_c(){
        $db = M('Member');
        $conit['m_id'] = array('eq',$_REQUEST['delete_m_id']);
        $result = $db->where($conit)->delete();
        if(!$result){
            $this->ajaxReturn($db->getError());
        } else{
            $this->ajaxReturn(true);
        }
    }
}