<?php
class Article extends Model
{
    public $table_name = "sr_article";

    private function getArticle($param, $sort=null, $fields = '*', $page=1, $pagesize=10)
    {
        $userInfo = new User_info();
        //$lstart = $page * $pagesize - $pagesize;
        //if($lstart<0)return;
        $limit = array($page, $pagesize);
        $arrArticle = $this->findAll($param, $sort, $fields, $limit);
        foreach ($arrArticle as $key => $item) {
            $arrArticle[$key]['articleid'] = tsTitle($item['articleid']);
            $arrArticle[$key]['title'] = tsTitle($item['title']);
            $arrArticle[$key]['content'] = tsDecode($item['content']);
            $arrArticle[$key]['count_comment'] = $item['count_comment']; // 回复
            $arrArticle[$key]['count_view'] = $item['count_view']; // 查看
            $arrArticle[$key]['user'] = $userInfo->getOneUser($item['userid']);
            $arrArticle[$key]['addtime'] = getTime(strtotime($item['addtime']),time());
            if($item['photo']){
                $arrArticle[$key]['photo'] = tsXimg($item['photo'],'article',290,160,$item['path'],1);
            }else{
                $arrArticle[$key]['photo'] = SITE_URL.'i/images/article.jpg';
            }
        }
        $row['pager'] = $this->page;
        $row['data'] = $arrArticle;
        if(empty($arrArticle))unset($arrArticle);
        return $row;
    }
    /**
     * 查询单条数据
     * @param unknown $articleId
     * @return string|Ambigous <string, void, boolean>
     */
    public function getOneArticle($articleId){
        if(empty($articleId))return '';
        $userInfo = new User_info();
        
        $param['articleid'] = $articleId;
        //$param['isaudit'] = $isaudit;
        $arrArticle = $this->find($param);
        
        $arrArticle['articleid'] = tsTitle($arrArticle['articleid']);
        $arrArticle['title'] = tsTitle($arrArticle['title']);
        $arrArticle['content'] = tsDecode($arrArticle['content']);
        $arrArticle['count_comment'] = $arrArticle['count_comment']; // 回复
        $arrArticle['count_view'] = $arrArticle['count_view']; // 查看
        $arrArticle['user'] = $userInfo->getOneUser($arrArticle['userid']);
        $arrArticle['addtime'] = getTime(strtotime($arrArticle['addtime']),time());
        if($arrArticle['photo']){
            $arrArticle['photo'] = tsXimg($arrArticle['photo'],'article',600,600,$arrArticle['path'],1);
        }
        return $arrArticle;
    }
    /**
     * 首页文章
     * @return Ambigous <NULL, multitype:number multitype: unknown Ambigous <number, unknown> >
     */
    public function getArticleByHome( $type, $page=0, $pagesize=10 ){
        $param['isaudit'] = 1;
        switch ($type){
        	case 'new':
        	    $sort = 'articleid desc';
        	    break;
        	case 'hot':
        	    $sort = 'count_view desc';
        	    break;
        	case 'recommend':
        	    $sort = 'articleid desc';
        	    $param['isrecommend'] = 1;
        	    break;
        }
        
        return $this->getArticle($param, $sort, '*', $page, $pagesize);
    }
    /**
     * 按分类查
     * @param unknown $cateid
     * @param string $sort
     * @param string $fields
     * @param number $page
     * @param number $pagesize
     * @return Ambigous <NULL, multitype:number multitype: unknown Ambigous <number, unknown> >
     */
    public function getArticleByCate($cateid, $sort=null, $fields = '*', $page=1, $pagesize=10 ){
        $param['isaudit'] = 1;
        $param['cateid'] = $cateid;
        // 列表
        return $this->getArticle ( $param, $sort, $fields, $page, $pagesize );
    }
    
    /**
     * 推荐文章 $cateid
     * @param int $cateid
     * @return mixed
     */
    public function getRecommendArticle($cateid = 0, $num = 10) {
        if ($cateid) {
            $arr = array(
                'cateid' => $cateid,
                'isrecommend' => 1,
            );
        } else {
            $arr = array(
                'isrecommend' => 1,
            );
        }
        $arrArticle = $this->findAll($arr, 'addtime desc', 'articleid,title,photo,description', $num);
        foreach ($arrArticle as $key => $item) {
            $arrArticle[$key]['title'] = htmlspecialchars($item['title']);
            $arrArticle[$key]['description'] = tsDecode($item['description']);
            if($item['photo']){
                $arrArticle[$key]['photo'] = tsXimg($item['photo'],'article',290,160,$item['path'],1);
            }else{
                $arrArticle[$key]['photo'] = SITE_URL.'i/images/article.jpg';
            }
        }
        return $arrArticle;
    }
    
    /**
     * 热门文章,1天，7天，30天
     * @param $day
     * @param int $cateid
     * @return mixed
     */
    public function getHotArticle($day, $cateid = 0, $num = 10) {
        $startTime = time() - ($day * 3600 * 60);
        $startTime = date('Y-m-d', $startTime);
    
        $endTime = date('Y-m-d');
    
        if ($day == 30) {
            $endTime = date('Y-m-d', time() - (7 * 3600 * 60));
        }
    
        if ($cateid) {
            $arr = "`cateid`='$cateid' and `count_view`>'0' and `addtime`>'$startTime' and `addtime`<'$endTime' and `isaudit`='0'";
        } else {
            $arr = "`addtime`>'$startTime' and `count_view`>'0' and `addtime`<'$endTime' and `isaudit`='0'";
        }
        $userInfo = new User_info();
        $arrArticle = $this->findAll($arr, 'addtime desc', '*', $num);
        foreach ($arrArticle as $key => $item) {
            $arrArticle[$key]['title'] = tsTitle($item['title']);
            $arrArticle[$key]['content'] = cututf8(t($item['content']),0,90);
            $arrArticle[$key]['count_comment'] = $item['count_comment']; // 回复
            $arrArticle[$key]['count_view'] = $item['count_view']; // 查看
            $arrArticle[$key]['user'] = $userInfo->getOneUser($item['userid']);
            $arrArticle[$key]['addtime'] = getTime(strtotime($item['addtime']),time());
            if($item['photo']){
                $arrArticle[$key]['photo'] = tsXimg($item['photo'],'article',120,120,$item['path'],1);
            }else{
                $arrArticle[$key]['photo'] = SITE_URL.'i/images/article.jpg';
            }
        }
    
        return $arrArticle;
    }
}