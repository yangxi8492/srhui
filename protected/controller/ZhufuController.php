<?php
class ZhufuController extends BaseController {
	// 这里先构造点数据
	public $cateName = array(
			5 => "送自己",
			6 => "送男票",
			7 => "送女票",
			8  => "送闺蜜",
			9  => "送基友",
			10 => "送父母",
			11 => "送同事",
			12 => "送小朋友"
	);
	
	function actionIndex(){
		$page = arg('page', 1);
	    $pSize = 15;
	    
	    $args[0] = '1=1';
	    $blessingModle = new Blessing();
	    $zhufu         = $blessingModle->findAll($args, 'blessingid desc', '*', array($page, $pSize));
	    $this->sum     = $blessingModle->findCount($args);
	    $this->pager   = page( $this->sum, $page, $pSize);
	    $this->zhufu = $zhufu;
	    
	    //礼物
	    $articleMode = new Article();
	    $conditions['cateid'] = 2;
	    $conditions['isrecommend'] = 1;
	    $limit = array(1, 5);
	    $fields = 'articleid,cateid,title,content,path,photo,isaudit,isrecommend,count_comment,count_view,addtime,count_love';
	    $this->liwu = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);
	     
	    
	    if($page>1){
	    	$str = '【第'.$page.'页】 - ';
	    }
	}
	
	function actionDetail(){
		//祝福语ID
		$this->zid = $blessingid = intval(arg('zid'));
		
		if(empty($blessingid)){
			msgJump('参数错误', '/');
		}
		
		$blessingModle = new Blessing();
		$zhufu = $blessingModle->find(['blessingid'=>$blessingid]);
		if(!empty($zhufu)){
			$this->zhufu = $zhufu;
		}
		
		$articleMode = new Article();
		$userInfoMode = new User_info();
		 
		// 获取评论
		$ArticleComment = new Article_comment();
		$arrComments = $ArticleComment->findAll ( array (
				'articleid' => $blessingid,
				'type' => 1 //1 祝福 2 资讯 3 礼物
		), 'addtime desc');
		
		foreach ( $arrComments as $key => $item ) {
			$arrComment [] = $item;
			$arrComment[$key]['content'] = tsDecode($item['content']);
			$arrComment[$key]['user'] = $userInfoMode->getOneUser ( $item ['userid'] );
		}
		 
		//礼物
		$conditions['cateid'] = 2;
		$conditions['isrecommend'] = 1;
		$limit = array(1, 5);
		$this->liwu = $articleMode->findAll($conditions, 'articleid desc', '*', $limit);
		 
		// 统计查看次数
		$blessingModle->update ( array (
				'articleid' => $zhufu ['articleid']
		), array (
				'count_view' => $zhufu ['count_view'] + 1
		) );
	}
	
}