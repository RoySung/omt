<?php
namespace Common\Controller;
use Think\Controller;
use Think\Auth;
class AuthController extends Controller {
	//每次載入這個檔案，這個function都會執行一次
	protected function _initialize(){
		//讀取session的值
		$sess_auth = session('admin');

		//如果沒有權限做跳轉
		if(!$sess_auth){
			session('auth',null);
			$this->error('尚未登入，自動幫你跳轉到登入頁',U('Admin/Login/login'));
		}
	}
}