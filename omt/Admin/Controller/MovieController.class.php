<?php
namespace Admin\Controller;
use Think\Controller;
class MovieController extends Controller {
    public function Movie_r(){
        $db = M('Movie');
        $result = $db->select();
        if($result) {
            $this->ajaxReturn($result);
        }
    }
}