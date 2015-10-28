<?php
namespace Admin\Controller;
use Think\Controller;
class SessionController extends Controller {
    public function session_r(){
        $db = M('Sessionview');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}