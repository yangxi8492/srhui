<?php
class LoginController extends BaseController{
	function actionIndex(){
	    $this->setToken();
	}

	function actionTest(){
		echo "hello login test";
	}
	
	function actionOutlogin(){
	    $_SESSION['admin'] = array ();
	    session_destroy ();
	    msgJump ('退出系统成功', url ( 'admin/login', 'index' ) );
	}
	
	function actionDologin(){
	    $data = arg('');
	    if($data['token'] != $_SESSION['admin']['token']){
	        msgBack('登陆错误');return;
	    }
	    if(empty($data['token']) || empty($data['username']) || empty($data['password'])){
	        msgBack('登陆失败');return;
	    }
	    $user = new Admin_user();
	    $userInfo = $user->find(array('username'=>$data['username']));
	    if(empty($userInfo)){
	        msgBack('用户不存在');return;
	    }
	    $pwd = md5($data['password'].$userInfo['salt']);
	    if($pwd != $userInfo['userpass']){
	        msgBack('密码错误');return;
	    }
	    $_SESSION['admin'] = $userInfo;
	    $_SESSION['admin']['token'] = '';
	    unset($_SESSION['admin']['token']);
	    msgJump('登陆成功', url('admin/main','index'));return;
	}
	
	private function setToken(){
	    $token = random(20);
	    $_SESSION['admin']['token'] = $token;
	    $this->token = $token;
	}
}