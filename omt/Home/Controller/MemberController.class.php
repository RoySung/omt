<?php
namespace Home\Controller;
use Think\Controller;
class MemberController extends Controller {
    public function StoredValue(){
        $db = M('Member');
        $session_auth = session('auth');
        $condit['email'] = $session_auth['email'];

        $data = $db->where($condit)->field('cash')->select();
        $store= $_REQUEST['value'];

        $result['cash'] = $data[0]['cash'] + $store;
        $result['add'] = $store;

        if(!$db->where($condit)->save($result)){
            $this->ajaxReturn(false);
        } else {
            $auth = $db->where($condit)->select(); 
            session('auth',$auth[0]);
            $this->ajaxReturn($result);
        }
    }

    public function signOut(){
        session('auth',null);
    }
}