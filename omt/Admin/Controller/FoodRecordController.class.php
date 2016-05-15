<?php
namespace Admin\Controller;
use Think\Controller;
class FoodRecordController extends Controller {
    public function foodrecord_r(){
        $db = M('Orderfoodview');

        $page = $_REQUEST['page'];
        $pageSize = $_REQUEST['rows'];
        //REQUEST = POST or GET
        if($_REQUEST['phone']OR$_REQUEST['food_name']){
            $condit['phone'] = array('like',$_REQUEST['phone']);
            $condit['food_name'] = array('like',$_REQUEST['food_name']);
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
        $db = M('Orderfood');
        
        $data = $db->create();
        $data['food_orderdate'] = date("Y-m-d");

        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);

            $this->ajaxReturn($data);
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
        $result = $db->where($condit)->save($data);
        if($result) {
            $this->ajaxReturn(true);
        } else {
            echo $db->getError();
        }
    }
}