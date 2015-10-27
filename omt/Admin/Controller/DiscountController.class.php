<?php
namespace Admin\Controller;
use Think\Controller;
class DiscountController extends Controller {
    public function discount_c(){
        $db = M('Discount');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}