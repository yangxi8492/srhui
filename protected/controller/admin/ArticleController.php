<?php
class ArticleController extends BaseController {
	// 文章列表
	function actionLiwu(){
	    $pagesize = 10;
	    $page = arg('page', 1);
	    $cateid = arg('cateid');
	    $begin_time = arg('begin_time');
	    $end_time = arg('end_time');
	    $keyword = arg('keyword');
	    $lstart = $page * $pagesize - $pagesize;
	    $args[0] = '1=1';
	    if($keyword){
	        $args[0] .= ' and title like :words';
 	        $args[':words'] = "%".$keyword."%";
	    }
	    if($cateid){
	        $args[0] .= ' and cateid = :cateid';//
	        $args[':cateid'] = $cateid;
	    }
	    if($begin_time){
	        $args[0] .= ' and addtime >= :begin_time';//
	        $args[':begin_time'] = $begin_time;
	    }
	    if($end_time){
	        $args[0] .= ' and addtime <= :end_time';//
	        $args[':end_time'] = $end_time;
	    }
	    $user = new User_info();
	    $Article = new article();
	    
	    $info = $Article->findAll($args, 'articleid desc', '*', $limit = array($page, $pagesize));
	    $this->sum = $Article->findCount($args);
	    $this->pager = show_page( $this->sum, $page, $pagesize);
	    
	    foreach ($info as $key=>$val){
	        $userInfo = $user->getOneUser($val['userid']);
	        $info[$key]['user'] = $userInfo;
	    }
	    $this->begin_time = $begin_time;
	    $this->end_time = $end_time;
	    //$this->arrCate = $arrCate;
	    $this->arrArticle = $info;
	    $this->cateid = $cateid;
	    $this->keyword = $keyword;
	}
	function actionaddliwu(){
	    $this->id = intval(arg('id'));
	    
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
	        $content = '<a href="'.url('item','go',array('id'=>$val['num_iid'])).'" target="_blank"><img alt="'.$val['title'].'" src="'.$val['pict_url'].'" width="600"></a><div class="fl w pt15 pb15 lh18 clearfix">
            	    <div class="fl detail-leftline">
            	    <i class="block clf94 fs16">￥'.$val['zk_final_price'].'</i>
            	    <span class="block fs12 cl9">销售: '.$val['volume'].'</span>
            	    </div>
            	    <a href="'.url('item','go',array('id'=>$val['num_iid'])).'" class="fr click-detail" target="_blank">查看详情</a>
            	    </div>
            	</div>';
	        
	        $str .= '<tr><td>'.$val['num_iid'].'<input type="hidden" title='.$val['title'].' id="val_'.$val['num_iid'].'" name="val" value=\''.$content.'\'></td>
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
	    
	    $param['parentid'] = 2;
	    $this->strCate = $ArticleCate->findAll ($param);
	    $param['parentid'] = 100;
	    $this->gexingCate = $ArticleCate->findAll ($param);
	    
        if($articleid){
            $ArticleMode = new Article();
    	    $this->strArticle = $ArticleMode->find(array('articleid'=>$articleid));
    	    //$Article->getOneArticle($articleid);
        }
	}
	
	function actionSave(){
	    $data = arg();
	    $data['content'] = $data['elm1'];
	    $data['userid'] = $_SESSION['admin']['id'];
	    $data['randid'] = rand(10000000, 99999999);
	    $articleid = $data['articleid'];
	    unset($data['articleid']);
	    unset($data['elm1']);
	    unset($data['c']);
	    unset($data['a']);
	    unset($data['m']);
	    if(empty($data['title'])){
	        msgJump('操作失败,标题必填'.$str, url('admin/article','add'));return;
	    }
	    if(empty($data['content'])){
	        msgJump('操作失败,内容不能为空'.$str, url('admin/article','add'));return;
	    }
	    
	    
	    if($_FILES['image']['size']){
    	    $upload = new upload();
    	    $newFileName = date('Ymd').'/0/'.time().mt_rand(1000, 9999);
    	    $up = $upload->upImg($_FILES['image'], 'article', $newFileName);
    	    if($up['state'] < 1 ){
    	       $str = '图片上传失败';
    	    }else{
    	        $data['path'] = date('Ymd').'/0';  //路径
    	        $data['photo'] = $up['desc_file'];  //返回的文件名称
    	    }
	    }
	    if(empty($data['photo'])){
	        //取内容图片
	        preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$data['content'],$match);
	        
	        //1000个图片一个目录
	        $menu1=date("Ymd");
	        $menu2='0';
	        $menu = $menu1.'/'.$menu2;
	        $photo = time().mt_rand(1000, 9999).'.jpg';
	        $photos = $menu.'/'.$photo;
	        
	        $dir = 'upload/article/'.$menu;
	        $dfile = $dir.'/'.$photo;
	        createFolders($dir);
	        
	        if(!is_file($dfile)){
	            $img = file_get_contents($match[1]);
	            file_put_contents($dfile,$img);
	        };
	        $data['path'] = $menu;  //路径
	        $data['photo'] = $photos;  //返回的文件名称
	    }
	    $artInfo = new Article();
	    $data['updtime'] = time();
	    if($articleid){
	        $rs = $artInfo->update(array('articleid'=>$articleid), $data);
	    }else{
	        $data['addtime'] = time();
	        $rs = $artInfo->create($data);
	    }
	    if($rs){
	        msgJump('操作成功,'.$str, url('admin/article','add', array('aid'=>$articleid)));return;
	    }
	    msgJump('操作失败', url('admin/article','add', array('aid'=>$articleid)));return;
	}
	function replace($string,$keyArray,$replacement,$i){
	    $result='';
	    if($i<(count($keyArray))){
	        $strSegArray=explode($keyArray[$i],$string);
	        foreach ($strSegArray as $index=>$strSeg){
	            $x=$i+1;
	            if($index==(count($strSegArray)-1))
	                $result=$result.replace($strSeg,$keyArray,$replacement,$x);
	            else
	                $result=$result.replace($strSeg,$keyArray,$replacement,$x).$replacement[$i];
	        }
	        return $result;
	    }
	    else{
	        return $string;
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