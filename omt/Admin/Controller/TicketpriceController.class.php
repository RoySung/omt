<?php
namespace Admin\Controller;
use Think\Controller;
class TicketpriceController extends Controller {
    public function ticketprice_c(){
        $db = M('Ticketprice');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}