<?php
namespace Admin\Controller;
use Think\Controller;
class DiscountController extends Controller {
    public function discount_r(){
        $db = M('Discount');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}