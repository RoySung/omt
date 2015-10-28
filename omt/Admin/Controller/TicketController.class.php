<?php
namespace Admin\Controller;
use Think\Controller;
class TicketController extends Controller {
    public function ticket_r(){
        $db = M('Orderticketview');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}