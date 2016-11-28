<?php
class ArticleController extends BaseController {
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
	public $gexingName = array(
	    13 => "美物",
	    14 => "手工",
	    15 => "吃货",
	    16  => "萌萌哒",
	    17  => "小清新",
	    18 => "动漫迷",
	    19 => "科技范",
	);
	function actionLiwu(){
	    $page = intval(arg('page', 1));
	    $cid = arg('cid');
	    $gid = arg('gid');
	    $pSize = 21;
	    $articleMode = new Article();
	    $title = '';
	    
	    if($cid){
	        $conditions['childid'] = intval($cid);
	        $title .= $this->cateName[$cid].',';
	    }
	    if($gid){
	        $conditions['gexingid'] = intval($gid);
	        $title .= $this->gexingName[$gid].',';
	    }
	    //礼物
	    $conditions['cateid'] = 2;
	    $limit = array($page, $pSize);
	    $fields = 'articleid,cateid,title,description,path,photo,isaudit,isrecommend,count_comment,count_view,addtime,count_love';
	    $liwu = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);

	    $sum = $articleMode->findCount($conditions);
	    $this->pager = page( $sum, $page, $pSize);
	    $this->liwu = $liwu;
	    $this->cid = $cid;
	    $this->gid = $gid;
	    if($page>1){
	        $str = '【第'.$page.'页】 - ';
	    }
	    if($title){
	        $this->title = $str.$title.'生日礼物 - 生日汇';
	        $this->sitekey = $title.'生日礼物,生日礼物送什么好,生日汇,生日礼物网';
	        $this->sitedesc = $str.$title.'生日礼物,'.$title.'什么生日礼物好,生日汇帮您精选了生日礼物清单,让你不用再为礼物烦恼.';
	    }else{
	       $this->title = $str.'生日礼物,送女生,送男生 - 生日汇';
	       $this->sitekey = '生日礼物,送女生生日礼物,送男生生日礼物,生日礼物送什么好,生日汇,生日礼物网';
	       $this->sitedesc = $str.'生日礼物送什么好,送女生生日礼物,送男生生日礼物,生日汇帮您精选了生日礼物清单,让你不用再为礼物烦恼.';
	    }
	}
	
	function actionCehua(){
	    $page = arg('page', 1);
	    $pSize = 15;
	     
	    $articleMode = new Article();
	
	    //策划
	    $conditions['cateid'] = 1;
	    $limit = array($page, $pSize);
	    $fields = 'articleid,cateid,title,description,path,photo,isaudit,isrecommend,count_comment,count_view,addtime,count_love';
	    $cehua = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);
	    $sum = $articleMode->findCount($conditions);
	    $this->pager = page( $sum, $page, $pSize);
	    $this->cehua = $cehua;
	    
	    //礼物
	    $conditions['cateid'] = 2;
	    $conditions['isrecommend'] = 1;
	    $limit = array(1, 5);
	    $this->liwu = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);
	    
	    if($page>1){
	        $str = '【第'.$page.'页】 - ';
	    }
	    $this->title = $str.'生日策划,生日惊喜点子 - 生日汇';
	    $this->sitekey = '生日策划,生日惊喜,生日惊喜点子,生日汇';
	    $this->sitedesc = $str.'策划生日方案,提供生日惊喜和点子,让你的生日过的更有意义.';
	}
	
	function actionNews(){
	    $page = arg('page', 1);
	    $pSize = 15;
	
	    $articleMode = new Article();
	
	    //策划
	    $conditions['cateid'] = 4;
	    $limit = array($page, $pSize);
	    $fields = 'articleid,cateid,title,description,path,photo,isaudit,isrecommend,count_comment,count_view,addtime,count_love';
	    $cehua = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);
	    $sum = $articleMode->findCount($conditions);
	    $this->pager = page( $sum, $page, $pSize);
	    $this->cehua = $cehua;
	     
	    //礼物
	    $conditions['cateid'] = 2;
	    $conditions['isrecommend'] = 1;
	    $limit = array(1, 5);
	    $this->liwu = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);
	     
	    if($page>1){
	        $str = '【第'.$page.'页】 - ';
	    }
	    $this->title = $str.'生日策划,生日惊喜点子 - 生日汇';
	    $this->sitekey = '生日策划,生日惊喜,生日惊喜点子,生日汇';
	    $this->sitedesc = $str.'策划生日方案,提供生日惊喜和点子,让你的生日过的更有意义.';
	}
	
	function actionZhufu(){
	    $page = arg('page', 1);
	    $pSize = 15;
	    
	    $articleMode = new Article();
	    
	    $conditions['cateid'] = 3;
	    $limit = array($page, $pSize);
	    $fields = 'articleid,cateid,title,content,path,photo,isaudit,isrecommend,count_comment,count_view,addtime,count_love';
	    $zhufu = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);
	    $this->sum = $articleMode->findCount($conditions);
	    $this->pager = page( $this->sum, $page, $pSize);
	    $this->cehua = $zhufu;
	    
	    //礼物
	    $conditions['cateid'] = 2;
	    $conditions['isrecommend'] = 1;
	    $limit = array(1, 5);
	    $this->liwu = $articleMode->findAll($conditions, 'articleid desc', $fields, $limit);
	    
	    if($page>1){
	        $str = '【第'.$page.'页】 - ';
	    }
	}
	
	function actionDetail(){
	    $id = intval(arg('aid'));
	    if(empty($id)){
	        msgJump('参数错误', '/');
	    }//$this->a = 'liwu';
	    $articleMode = new Article();
	    $userInfoMode = new User_info();
	     
	    $conditions['articleid'] = $id;
	    $conditions['isaudit'] = 1;
	    //$conditions['cateid'] = 2;
	    $data = $articleMode->find( $conditions );
	    //$data['user'] = $userInfo->getOneUser($data['userid']);
	    
	    $sort = 'articleid desc';
	    $conditions['isrecommend'] = 1;
	    unset($conditions['articleid']);
	    $this->arrRecommend = $articleMode->findAll($conditions, $sort, '*', array(1, 5));
	     
	    // 获取评论
	    $ArticleComment = new Article_comment();
	    $arrComments = $ArticleComment->findAll ( array (
	        'articleid' => $id
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
	    $articleMode->update ( array (
	        'articleid' => $data ['articleid']
	    ), array (
	        'count_view' => $data ['count_view'] + 1
	    ) );
	    
	    $this->a = 'liwu';
	    $this->data = $data;
	    $this->arrComment = $arrComment;
	    $this->title = $data['title'].' - 生日祝福 - 生日汇';
	    $this->sitekey = $data['keyword'].',生日汇';
	    $this->sitedesc = $data['description'];
	     
	}
	
	function actionShow(){
	    $id = intval(arg('aid'));
	    if(empty($id)){
	        msgJump('参数错误', '/');
	    }
	    $articleMode = new Article();
	    $userInfoMode = new User_info();
	    
	    $conditions['articleid'] = $id;
	    $conditions['isaudit'] = 1;
	    $conditions['cateid'] = 3;
	    $data = $articleMode->find( $conditions );
	    //$data['user'] = $userInfo->getOneUser($data['userid']);
	    
	    $sort = 'articleid desc';
	    $conditions['isrecommend'] = 1;
	    unset($conditions['articleid']);
	    $this->arrRecommend = $articleMode->findAll($conditions, $sort, '*', array(1, 5));
	    
	    // 获取评论
	    $ArticleComment = new Article_comment();
	    $arrComments = $ArticleComment->findAll ( array (
	        'articleid' => $id
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
	    $articleMode->update ( array (
	        'articleid' => $data ['articleid']
	    ), array (
	        'count_view' => $data ['count_view'] + 1
	    ) );
	    
	    $this->data = $data;
	    $this->arrComment = $arrComment;
	    $this->title = $data['title'].' - 生日祝福 - 生日汇';
	    $this->sitekey = $data['keyword'].',生日汇';
	    $this->sitedesc = $data['content'];
	    
	}
	// 演示dump函数，这是最常用的工具哦
	function actionDump(){
		echo "演示dump函数，这是最常用的工具哦";
		
		dump($this->fakedata);
		dump($_POST); // 在提交表单的时候，先看看提交上来是什么
		dump($_GET);
		
		$backurl = url("main", "index");
		echo "请返回<a href='$backurl'>MainController/actionIndex</a>";
	}
}