<?php
class LoginController extends BaseController {
	// qq
	function actionQq(){
		$qq = new qq();
		$qq->qq_login();
	}
	//weibo
	function actionWeibo(){
	    $o = new weibo( WB_AKEY , WB_SKEY );
	    $code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
	    header("Location: " . $code_url);
	}
}