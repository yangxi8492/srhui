<?php
class BlessingController extends BaseController {

   /*
    * 添加、编辑祝福语
    */
    function actionadd(){
        //祝福语ID
        $this->blessingid = $blessingid = intval(arg('bid'));
        //分类
        $ArticleCate   = new Article_cate();
        $this->strCate = $ArticleCate->findAll ();

        if($blessingid){
            $blessingModle = new Blessing();
            $blessingInfo = $blessingModle->find(['blessingid'=>$blessingid]);
            if(!empty($blessingInfo)){
                 $this->blessingInfo = $blessingInfo;
            }
        }
    }

    /*
     * 保存祝福语
     */
    function actionSave(){
        //添加模式
        $addtype                          = arg('addtype');
        //分类ID
        $data['cateid']                  = arg('cateid');
        //是否审核
        $data['isaudit']                 = arg('isaudit');
        //是否推荐
        $data['isrecommend']            = arg('isrecommend');
        //排序
        $data['sort']                    = arg('sort');
        //赞基数
        $data['count_love_basenum']    = arg('count_love_basenum');
        //祝福内容
        $data['content']                 = arg('content');
        //转发基数
        $data['count_forward_basenum'] = arg('count_forward_basenum');
        //文章发布时间
        $data['addtime']                 = date('Y-m-d h:i:s',time());
        //发布人ID
        $data['create_userid']          = $_SESSION['admin']['id'];
        //发布人姓名
        $data['create_user_name']       = $_SESSION['admin']['username'];

        //添加单条祝福语
        if($addtype=='1'){
            $blessingModle = new Blessing();
            $rs = $blessingModle->create($data);
        }else{
            //批量添加祝福语每条记录用“。”分隔
            $newContent  = explode('。',$data['content']);
            $length      = count($newContent);
            for($i=0;$i<$length;$i++){
                if(!empty($newContent[$i])){
                    $blessingModle = new Blessing();
                    $data['content'] = $newContent[$i].'。';
                    $rs = $blessingModle->create($data);
                }
            }
        }
        if($rs){
            msgJump('操作成功,', url('admin/blessing','add',['bid'=>$rs]));
            return;
        }
        msgJump('操作失败', url('admin/blessing','add'));
        return;
    }

	/*
	 * 祝福列表
	 */
	function actionList(){

	    $pagesize  = 10;
	    $page      = arg('page', 1);

	    $args[0] = '1=1';
        $blessingModle = new Blessing();
	    $blessing      = $blessingModle->findAll($args, 'blessingid desc', '*', $limit = array($page, $pagesize));
	    $this->sum     = $blessingModle->findCount($args);
	    $this->pager   = show_page( $this->sum, $page, $pagesize);

        $ArticleCate   = new Article_cate();
        $arrCate = $ArticleCate->findAll ();
	    foreach ($blessing as $key=>$val){
            $blessing[$key]['catename'] = $arrCate[$val['cateid']]['catename'];
	    }
        $this->blessingaList = $blessing;
	}
}