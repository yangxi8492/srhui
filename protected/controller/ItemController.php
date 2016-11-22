<?php
class ItemController extends BaseController {
	// 增加数据create
	function actionGo(){
		$id = trim(arg('id'));
		if( empty($id )){
		    msgJump('参数错误','/');
		}
		$this->id = $id;
	}
}