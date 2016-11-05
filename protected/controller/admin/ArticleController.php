<?php
class ArticleController extends BaseController {
	// 文章列表
	function actionList(){
	    $pagesize = 10;
	    $page = arg('page', 1);
	    $cateid = arg('cateid');
	    $keyword = arg('keyword');
	    $lstart = $page * $pagesize - $pagesize;
	    $args[0] = '1=1';
	    if($keyword){
	        $args[0] = " and title like :word";
	        $args[':word'] = '%'.$keyword.'%';
	    }
	    if($cateid){
	        $args[0] .= ' and cateid = :cateid';//
	        $args[':cateid'] = $cateid;
	    }
	    $Article = new Article();
	    $ArticleCate = new Article_cate();
	    $user = new User_info();
	    //分类
	    $arrCate = $ArticleCate->findAll ();
	    $arrArticle = $Article->findAll($args, 'articleid desc', '*', $lstart.','.$pagesize);
	    $this->sum = $Article->findCount($args);
	    $this->pager = show_page( $this->sum, $page, $pagesize);
	    
	    foreach ($arrCate as $key=>$val){
	        $arrCate[$val['cateid']] = $val;
	    }
	    
	    foreach ($arrArticle as $key=>$val){
	        $arrArticle[$key]['catename'] = $arrCate[$val['cateid']]['catename'];
	        $userInfo = $user->getOneUser($val['userid']);
	        $arrArticle[$key]['user'] = $userInfo;
	    }
	    $this->arrCate = $arrCate;
	    $this->arrArticle = $arrArticle;
	    $this->cateid = $cateid;
	    $this->keyword = $keyword;
	}
	
	function actionadd(){
	    $articleid = intval(arg('aid'));
	    
	    //分类
	    $ArticleCate = new Article_cate();
	    $this->strCate = $ArticleCate->findAll ();
	    
        if($articleid){
            $Article = new Article();
    	    $this->strArticle = $Article->getOneArticle($articleid);
        }
	}
	
	function actionEdit(){
	    $data = arg();
	    unset($data['a']);
	    unset($data['c']);
	    unset($data['m']);
	    unset($data['submit']);
	    if(empty($data['title'])){
	        msgBack('标题不能为空');return;
	    }
	    if(empty($data['content'])){
	        msgBack('内容不能为空');return;
	    }
	    
	    $Article = new Article();
	    if($data['articleid']){
	        $data['updtime'] = date('Y-m-d H:i:s');
    	    $Article->update ( array (
    	        'articleid' => $data ['articleid']
    	    ), $data );
	    }else{
	        $data['addtime'] = date('Y-m-d H:i:s');
	        $data['randid'] = $data['randid'] ? $data['randid'] :random(10, 1);
	        
	        $rs = $Article->create($data);
	    }
	    msgJump('操作成功', url('admin/article','add'));return;
	}
}