<?php
namespace Admin\Controller;
use Think\Controller;
class MovieController extends Controller {
    public function Movie_r(){
        $db = M('Movie');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
    public function append_c() {
        $db = M('Movie');
        $data = $db->create();
        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
    }
    public function destroyRow_c(){
    	$db = M('Movie');
    	$conit['mo_id'] = array('eq',$_REQUEST['delete_mo_id']);
        $result = $db->where($conit)->delete();
    	if(!$result){
    		$this->ajaxReturn($db->getError());
    	} else{
    		$this->ajaxReturn(true);
    	}
    }
    public function edit_c(){
        $db = M('Movie');
        $condit['mo_id'] = array('eq',$_REQUEST['mo_id']); 
        $data = $db->create();
        $result = $db->where($condit)->save($data);
        if($result) {
            $this->ajaxReturn(true);
        } else {
            echo $db->getError();
        }
    }
}