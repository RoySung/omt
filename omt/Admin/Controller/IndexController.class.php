<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Controller\AdminController;
class IndexController extends AdminController {
    public function index_r(){
        $db = M('News');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
    public function append_c() {
        $db = M('News');
        $data = $db->create();
        if (!$data) {
            $this->ajaxReturn($db->getError());
        } else {
            $db->add($data);
            $this->ajaxReturn(true);
        }
    }
    public function destroyRow_c(){
        $db = M('News');
        $conit['n_id'] = array('eq',$_REQUEST['delete_n_id']);
        $result = $db->where($conit)->delete();
        if(!$result){
            $this->ajaxReturn($db->getError());
        } else{
            $this->ajaxReturn(true);
        }
    }
    public function edit_c(){
        $db = M('News');
        $condit['n_id'] = array('eq',$_REQUEST['n_id']); 
        $data = $db->create();
        $result = $db->where($condit)->save($data);
        if($result) {
            $this->ajaxReturn(true);
        } else {
            echo $db->getError();
        }
    }
    public function index(){
        $this->display();
    }
    public function discount(){
        $this->display();
    }
    public function food(){
        $this->display();
    }
    public function login(){
        $this->display();
    }
    public function member(){
        $this->display();
    }
    public function movie(){
        $this->display();
    }
    public function session(){
        $this->display();
    }
    public function theater(){
        $this->display();
    }
    public function ticket(){
        $this->display();
    }
    public function ticketprice(){
        $this->display();
    }
}