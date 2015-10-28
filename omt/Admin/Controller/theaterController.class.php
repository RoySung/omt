<?php
namespace Admin\Controller;
use Think\Controller;
class TheaterController extends Controller {
    public function theater_r(){
        $db = M('Theater');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}