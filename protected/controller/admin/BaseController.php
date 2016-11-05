<?php
class BaseController extends Controller{
    private static $_func = array ('loginindex', 'logindologin','maintest','mainloginOut' );
    
    function init(){
        session_start();
        header("Content-type: text/html; charset=utf-8");
        $__controller = isset($_REQUEST['c']) ? strtolower($_REQUEST['c']) : 'main';
        $__action     = isset($_REQUEST['a']) ? strtolower($_REQUEST['a']) : 'index';
        
        if (! in_array ( $__controller . $__action, self::$_func )) {
            if (empty ( $_SESSION ['admin'] ['id'] )) {
                $_SESSION['admin'] = array ();
                session_destroy ();
                msgJump ('请登陆系统', url ( 'admin/login', 'index' ) );
                exit ();
            }
        }
    }
} 