<?php
namespace Admin\Controller;
use Think\Controller;
class FoodController extends Controller {
    public function food_c(){
        $db = M('Food');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}