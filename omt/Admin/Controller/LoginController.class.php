<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function Login(){
    	if (IS_POST) {
    		$db = M('Admin');
			$condit['account'] = array('eq',$_REQUEST['account']); 
			$condit['password'] = array('eq',$_REQUEST['password']);
			$result = $db->where($condit)->select();
			if($result) {
				$save_session['account'] = $_REQUEST['account'];
				$save_session['password'] = $_REQUEST['password'];
				session('admin',$save_session);
				$this->success('登入成功',U('Index/index'));
			} else {
				$this->error('登入失敗，帳密輸入錯誤',U('Login/login'));
			}
    	} else {
    		if($_SESSION['admin']){
    			$this->success('己經登入',U('Index/index'));
    		} else {
				$this->display();
    		}
    	}
    	
    }
}