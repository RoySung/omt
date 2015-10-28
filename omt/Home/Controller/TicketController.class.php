<?php
namespace Home\Controller;
use Think\Controller;
class TicketController extends Controller {
    public function get_ticket() {
        $db = M('Orderticket');
        $condit['ot_id'] = array('eq',$_REQUEST['ot_id']);
        $result = $db->where($condit)->select();

        if($result) {
            $this->ajaxReturn($result);
        }
    }
}