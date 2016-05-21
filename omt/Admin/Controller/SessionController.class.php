<?php
namespace Admin\Controller;
use Think\Controller;
class SessionController extends Controller {
    public function session_r(){
        $db = M('Sessionview');

        $page = $_REQUEST['page'];
        $pageSize = $_REQUEST['rows'];
        //REQUEST = POST or GET
        if($_REQUEST['movie_name']OR$_REQUEST['time']OR$_REQUEST['date']OR$_REQUEST['s_id']){
            $condit['s_id'] = array('like',$_REQUEST['s_id']);
            $condit['movie_name'] = array('like',$_REQUEST['movie_name']);
            $condit['time'] = array('like',$_REQUEST['time']);
            $condit['date'] = array('like',$_REQUEST['date']);
        }
        
        $result = $db->where($condit)->page($page,$pageSize)->select();
        $data['total'] = $db->where($condit)->count();
        $data['rows'] = $result;
       // $result = $db->select();
        if($data) {
            $this->ajaxReturn($data);
        }
    }
    public function append_c() {
        $db = M('Session');
        $data = $db->create();
        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
    }
    public function destroyRow_c(){
    	$db = M('Session');
    	$conit['s_id'] = array('eq',$_REQUEST['delete_s_id']);
        $result = $db->where($conit)->delete();
    	if(!$result){
    		$this->ajaxReturn($db->getError());
    	} else{
    		$this->ajaxReturn(true);
    	}
    }
    public function edit_c(){
        $db = M('Session');
        $condit['s_id'] = array('eq',$_REQUEST['s_id']); 
        $data = $db->create();
        $result = $db->where($condit)->save($data);
        if($result) {
            $this->ajaxReturn(true);
        } else {
            echo $db->getError();
        }
    }
}