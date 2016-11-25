<?php
class MainController extends BaseController {
	// 首页
	function actionIndex(){
		$t = arg('t', 'new');
	    $articleMode = new Article();
	    $articleCateMode = new Article_cate();
	    
	    $fields = 'articleid,cateid,title,description,path,photo,isaudit,isrecommend,count_comment,count_view,addtime,count_love';
	    //礼物
 	    $conditions['cateid'] = 2;
	    $conditions['isrecommend'] = 1;
	    $limit = array(1, 30);
	    $liwu = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);
	    
	    //策划
	    $conditions['cateid'] = 1;
	    $limit = array(1, 6);
	    $cehua = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);

	    $this->liwu = $liwu;
	    $this->cehua = $cehua;
	    // SEO优化
	    $this->title = '生日汇 - 生日礼物和策划指南';
	    $this->sitekey = '生日会,生日礼物,生日策划,生日祝福,过生日,生日汇';
	    $this->sitedesc = '生日汇,一个专门从是生日策划,生日祝福,生日礼物的网站.';
	}
	
	// 接收提交表单
	function actionReceive(){
		// 把提交的数据先dump($_POST)出来看看是良好的习惯。
		
		if(isset($_POST["username"])){
			echo "已经提交了".$_POST["username"];
		}else{
			echo "没有填东东呢";
		}
	}
}