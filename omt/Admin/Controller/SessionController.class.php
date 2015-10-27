<?php
namespace Admin\Controller;
use Think\Controller;
class SessionController extends Controller {
    public function session_c(){
        $db = M('Session');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}