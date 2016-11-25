<?php
class BaseController extends Controller{
	public $layout = null;//layout.html";
	function init(){
		header("Content-type: text/html; charset=utf-8");
		self::set( );
	}
	
	function set(){
	    $this->a = arg('a');
	    $this->c = arg('c');
	    $this->webinfo = $GLOBALS['webinfo'];
	}

	//public static function err404($controller_name, $action_name){
	//	header("HTTP/1.0 404 Not Found");
	//	exit;
	//}
} 