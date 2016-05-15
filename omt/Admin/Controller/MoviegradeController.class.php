<?php
namespace Admin\Controller;
use Think\Controller;
class MoviegradeController extends Controller {
    public function Moviegrade_r(){
        // $db = M('Moviegradeview');
        // $result = $db->group('m_id,mo_id')->select();
        // if($result) {
        //     $this->ajaxReturn($result);
        // }


        $db = M('Moviegradeview');

        $page = $_REQUEST['page'];
        $pageSize = $_REQUEST['rows'];

        if($_REQUEST['m_id']AND$_REQUEST['mo_id']){
            $condit['m_id'] = array('eq',$_REQUEST['m_id']);
            $condit['mo_id'] = array('eq',$_REQUEST['mo_id']);
        }
        
        $result = $db->where($condit)->group('m_id,mo_id')->page($page,$pageSize)->select();
        $data['total'] = $db->where($condit)->count();
        $data['rows'] = $result;
       // $result = $db->select();
        if($data) {
            $this->ajaxReturn($data);
        }
    }
    public function append_c() {
        
        //check m_id and mo_id exist
        $db=M('Member');
        $condit['m_id'] = array('eq',$_REQUEST['m_id']);
        $result = $db->where($condit)->select();
        if(!$result){
            $this->ajaxReturn("m_id no exist");
        }
        $db=M('Movie');
        $condit['mo_id'] = array('eq',$_REQUEST['mo_id']);
        $result = $db->where($condit)->select();
        if(!$result){
            $this->ajaxReturn("mo_id no exist");
        }
        
        $db = M('Moviegrade');
        //check exist repeat exist
        $result = $db->where($condit)->select();
        if($result){
            $this->ajaxReturn(false);
        }
        //add moviegrade data
        $data = $db->create();
        $data['grade_date'] = date("Y-m-d");
        
        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
        
    }
    public function destroyRow_c(){
    	$db = M('Moviegrade');
    	$conit['mg_id'] = array('eq',$_REQUEST['delete_mg_id']);
        $result = $db->where($conit)->delete();
    	if(!$result){
    		$this->ajaxReturn($db->getError());
    	} else{
    		$this->ajaxReturn(true);
    	}
    }
    public function edit_c(){
        $db = M('Moviegrade');
        $condit['mg_id'] = array('eq',$_REQUEST['mg_id']); 
        $data = $db->create();
        $result = $db->where($condit)->save($data);
        if($result) {
            $this->ajaxReturn(true);
        } else {
            echo $db->getError();
        }
    }
}