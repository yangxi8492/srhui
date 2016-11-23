<?php
class BaseController extends Controller{
	public $layout = null;//layout.html";
	function init(){
		header("Content-type: text/html; charset=utf-8");
		self::seo( );
	}
	
	function seo(){
	    $this->a = arg('a');
	    $this->c = arg('c');
	    $seo = array(
        	'title' => 'ttttttttttttttt',
        	'keywords' => 'kkkkkkkkkkkkkkkk',
        	'description' => 'dddddddddddddd',
	        'host' => 'http://www.sp.com/',
	        'webname' => 'test',
        );
	    $this->seo = $seo;
	    $this->webinfo = $GLOBALS['webinfo'];
	}

    function tips($msg, $url){
    	$url = "location.href=\"{$url}\";";
		echo "<html><head><meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\"><script>function sptips(){alert(\"{$msg}\");{$url}}</script></head><body onload=\"sptips()\"></body></html>";
		exit;
    }
    function jump($url, $delay = 0){
        echo "<html><head><meta http-equiv='refresh' content='{$delay};url={$url}'></head><body></body></html>";
        exit;
    }
	
	//public static function err404($controller_name, $action_name){
	//	header("HTTP/1.0 404 Not Found");
	//	exit;
	//}
} 