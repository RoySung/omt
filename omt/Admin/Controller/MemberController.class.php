<?php
namespace Admin\Controller;
use Think\Controller;
class MemberController extends Controller {
    public function member_c(){
        $db = M('Member');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}