<?php

class GroupController extends BaseController
{
    // 默认入口
    function actionIndex()
    {
        $page = arg('page', 1);
        $lstart = $page * 32 - 32;
        
        $group = new Group();
        $groupCate = new Group_cate();
        $groupTopic = new Group_topic();
        // 所有小组
        $arrGroup = $group->getGroupList();
        // 我加入的小组
        $myGroup = array();
        if (isset($_SESSION['tsuser'])) {
            $myGroups = $group->findAll(array(
                'userid' => $_SESSION['userid']
            ), null, 'groupid');
            foreach ($myGroups as $item) {
                $myGroup[] = $item['groupid'];
            }
        }
        // 热门帖子
        $arrTopics = $groupTopic->getHotList(array(), 'count_comment desc', 'groupid,typeid,userid,topicid,title,content,count_comment,count_view', 10);
        //热门帖子：10天
        $hotTopics = $groupTopic->hotTopics(10, 5);
        //置顶
        $topTopic = $groupTopic->isTopic();
        $title = '小组';
        if (isset($strCate)) {
            $title = $strCate['catename'];
        }
        $userInfo = new User_info();
        $this->recommend = $userInfo->getRecommend(5);
        
        $this->title = $title;
        $this->hotTopics = $hotTopics;
        $this->topTopic = $topTopic;
        $this->arrGroup = $arrGroup;
        $this->arrTopic = $arrTopics;
        $this->display("group/index.html");
    }
    
    // 显示JSON格式的数据，其实只是显示不一样而已
    function actionTopic()
    {
        $topicid = arg('tid');
        $groupTopic = new Group_topic();
        $tag = new Tag();
        $strTopic = $groupTopic->getOneTopic($topicid);
        
        //帖子审核
        if($strTopic['isaudit']==1 ){
            tsNotice('内容审核中......');
        }
        $group = new Group();
        // 小组
        $strGroup = $group->getOneGroup($strTopic['groupid']);
        
        // 判断会员是否加入该小组
        $strGroupUser = '';
        if(isset($_SESSION['userid'])){
            $strGroupUser = $group->find(array(
                'userid'=>intval($_SESSION['userid']),
                'groupid'=>$strTopic['groupid'],
            ));
        }
        
        // 浏览方式
        if ($strGroup['isopen'] == '1' && $strGroupUser == '') {
            $title = $strTopic['title'];
            $this->display('group/isopen.html');
            exit;
        }
        
        $strTopic['content'] = @preg_replace("/\[@(.*)\:(.*)]/U","<a href='".url('user','space',array('id'=>'$2'))." ' rel=\"face\" uid=\"$2\"'>@$1</a>",$strTopic['content']);
        // 帖子标签
        $strTopic['tags'] = $tag->getObjTagByObjid('topic', 'topicid', $topicid);
        
        //把标签作为关键词
        if($strTopic['tags']){
            foreach($strTopic['tags'] as $key=>$item){
                $arrTag[] = $item['tagname'];
            }
            $sitekey = arr2str($arrTag);
        }else{
            $sitekey = $strTopic['title'];
        }
        //标题
        $title = $strTopic['title'];
        
        // 评论列表开始
        $page = arg('page', 1);
        $lstart = $page * 15-15;
        $topicComment = new Group_topic_comment();
        $userInfo = new User_info();
        $arrComment = $topicComment->findAll(array(
            'topicid'=>$topicid,
        ),'addtime asc','*'); 
        foreach($arrComment as $key => $item)
        {
            $arrTopicComment[] = $item;
            $arrTopicComment[$key]['l'] = (($page-1) * 15) + $key + 1;
            $arrTopicComment[$key]['user'] = $userInfo->getOneUser($item['userid']);
        
            $arrTopicComment[$key]['content'] = tsDecode($item['content']);
        
           // $arrTopicComment[$key]['recomment'] = $group->recomment($item['referid']);
        }
       
        
        // 评论列表结束
        
        
        //7天内的热门帖子
        $arrHotTopic = $groupTopic->hotTopics(7, 10);
        
 
        
        // 增加浏览次数
        
        $groupTopic->update(array(
            'topicid' => $strTopic['topicid'],
        ), array(
            'count_view' => $strTopic['count_view'] + 1,
        ));
        
        
        
        $this->topicInfo = $strTopic;
        $this->display("group/topic.html");
    }
    
    // 接收提交参数，这里是GET方式的，直接用PHP的$_GET来接收
    function actionVal()
    {
        // 用$this->的方法将值传递到模板中使用
        $this->whoami = $_GET["whoami"];
        // 下面是模板输出了，模板输出可以用display方法
        $this->display("custom_page.html");
    }
    
    // 模板显示，foreach循环，多维数据的演示
    function actionTpl()
    {
        $this->data = $this->fakedata;
        // 这里模板输出就是不用display方法，因为模板名字是other_tpl.html(控制器名_方法名.html)
    }
    
    // 演示dump函数，这是最常用的工具哦
    function actionDump()
    {
        echo "演示dump函数，这是最常用的工具哦";
        
        dump($this->fakedata);
        dump($_POST); // 在提交表单的时候，先看看提交上来是什么
        dump($_GET);
        
        $backurl = url("main", "index");
        echo "请返回<a href='$backurl'>MainController/actionIndex</a>";
    }
}