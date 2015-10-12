<?php
namespace Home\Model;
use Think\Model;

class MemberModel extends Model {
	protected $_validate = array(
		array('email','require','錯誤:帳號不得為空'),
		array('password','require','錯誤:密碼不得為空'),
		array('name','require','錯誤:中文姓名不得為空'),
		array('phonenumber','require','錯誤:手機號碼不得為空'),
		array('email', 'email', '錯誤:郵件格式不符合！'),
		array('email','','已經被使用！',0,'unique',1),
		//array('repassword','password','錯誤:確認密碼不一致',0,'confirm'), // 验证确认密码是否和密码一致
		array('password', '6,20', '錯誤:密碼長度須介於6至20',3,'length'),
		
	);
}