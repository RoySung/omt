<?php
namespace Admin\Controller;
use Think\Controller;
class TicketController extends Controller {
    public function ticket_c(){
        $db = M('Ticket');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}