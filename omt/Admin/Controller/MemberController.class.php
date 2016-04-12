<?php
namespace Admin\Controller;
use Think\Controller;
class MemberController extends Controller {
    public function member_r(){
        $db = M('Member');

        $page = $_REQUEST['page'];
        $pageSize = $_REQUEST['rows'];

        $result = $db->page($page,$pageSize)->select();
        $data['total'] = $db->count();
        $data['rows'] = $result;
       // $result = $db->select();
        if($data) {
            $this->ajaxReturn($data);
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
    public function search(){
   /*     $db = M('Member');
        $conit['phone'] = array('eq',$_REQUEST['th_phone']);
        $conit['mail'] = array('eq',$_REQUEST['th_mail']);
        $result = $db->where($conit)->select();
        $data = $db->create($conit);
        if($result) {
            $this->ajaxReturn($data['mail']);
        }*/
        $db = M('Member');
        $data = $db->create();
        
        $conit['phone'] = array('eq',$_REQUEST['th_phone']);
        $conit['_logic'] = 'OR';
        $result = $db->where($conit)->select();
        if($result){
            $this->ajaxReturn($result[0]['m_id']);
        } else{
            $conit['email'] = array('eq',$_REQUEST['th_mail']);
            $result = $db->where($conit)->select();
            $this->ajaxReturn($result[0]['m_id']);
        }
    }
}