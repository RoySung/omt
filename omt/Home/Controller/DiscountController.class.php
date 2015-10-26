<?php
namespace Home\Controller;
use Think\Controller;
class DiscountController extends Controller {
    public function discount_c() {
        $db = M('Discount');
        $result = $db->add($_REQUEST['discount']);
        if($result) {
            $this->ajaxReturn(true);
        }
    }
}