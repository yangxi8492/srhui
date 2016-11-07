<?php
class GiftController extends BaseController {
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
	    $user = new User_info();
	    $giftArticle = new Gift_article();
	    $info = $giftArticle->findAll($args, 'articleid');
	    $this->sum = $giftArticle->findCount($args);
	    $this->pager = show_page( $this->sum, $page, $pagesize);
	   
	    foreach ($info as $key=>$val){
	        $info[$key]['catename'] = $arrCate[$val['cateid']]['catename'];
	        $userInfo = $user->getOneUser($val['userid']);
	        $info[$key]['user'] = $userInfo;
	    }
	    $this->arrCate = $arrCate;
	    $this->arrArticle = $info;
	    $this->cateid = $cateid;
	    $this->keyword = $keyword;
	}
	function actionaddliwu(){
	    
	}
	
	function actionquery(){
	    $keyword = trim(arg('keyword'));
	    include 'include/taobao.php';
	    $c = new taobao;
	    $c->appkey = '23384812';
	    $c->secretKey = '3bb4e39e600c78423824977372daf876';
	    $req = new TbkItemGetRequest;
	    $req->setFields("num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,seller_id,volume,nick");
	    $req->setQ( $keyword );
	    $resp = $c->execute($req);
	    
	    $data = object_to_array($resp);
	    $str = '';
	    foreach ($data['results']['n_tbk_item'] as $key=>$val){
	        $str .= '<tr><td>'.$val['num_iid'].'<input type="hidden" id="val_'.$val['num_iid'].'" name="val" value=\''.json_encode($val).'\'></td>
	            <td><a href="'.$val['item_url'].'" target="_blank">'.$val['title'].'</a></td>
	            <td>'.$val['zk_final_price'].'</td>
	            <td><img src="'.$val['pict_url'].'" width=60></td>
	            <td>'.$val['volume'].'</td>
	            <td><a href="javascript:void(0);" onclick="surebtn('.$val['num_iid'].');">选择</a></td></tr>';
	    }
	    echo json_encode( array('str'=>$str));exit;
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