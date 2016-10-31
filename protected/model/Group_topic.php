<?php

class Group_topic extends Model
{

    public $table_name = "ts_group_topic";
    
    public function getOneTopic($topicId){
        
        $userInfo = new User_info();
        $strTopic = $this->find(array(
            'topicId'=>$topicId,
        ));
        if($strTopic){
            $strTopic['title'] = tsTitle($strTopic['title']);
            $strTopic['desc'] = tsDecode($strTopic['content']);
            $strTopic['addday'] = getTime($strTopic['addtime']);
            if($strTopic['photo']){
                $strTopic['photo'] = tsXimg($strTopic['photo'],'group',120,120,$strTopic['path'],1);
            }else{
                $strTopic['photo'] = SITE_URL.'public/images/group.jpg';
            }
            $strTopic['user'] = $userInfo->getOneUser($strTopic['userid']);
        }
        return $strTopic;
    }
    // 热门帖子：一天1
    public function hotTopics($day, $num = 10)
    {
        $userInfo = new User_info();
        $startTime = time() - ($day * 3600 * 60);
        $endTime = time();
        $arrTopics = $this->findAll("`addtime`>'$startTime' and `addtime` < '$endTime' and and `isaudit`='0'", 'count_comment desc', '*', $num);
        foreach ($arrTopics as $key => $item) {
            $arrTopic[] = $item;
            $arrTopic[$key]['user'] = $userInfo->getOneUser($item['userid']);
            $arrTopic[$key]['title'] = tsTitle($item['title']);
            $arrTopic[$key]['content'] = tsCutContent($item['content'], 150);
        }
        return $arrTopic;
    }

    public function getHotList($param, $sort, $field, $limit)
    {
        $arrTopics = $this->findAll($param, $sort, $field, $limit);
        $userInfo = new User_info();
        $group = new Group();
        foreach ($arrTopics as $key => $item) {
            $arrTopic[] = $item;
            $arrTopic[$key]['group'] = $group->getOneGroup($item['groupid']);
            $arrTopic[$key]['user'] = $userInfo->getOneUser($item['userid']);
            $arrTopic[$key]['title'] = tsTitle($item['title']);
            $arrTopic[$key]['content'] = tsCutContent($item['content'], 150);
        }
        return $arrTopic;
    }
    // 置顶帖子
    public function isTopic()
    {
        $arr = array(
            'istop' => 1
        );
        $arrTopics = $this->findAll($arr, 'uptime desc');
        if (empty($arrTopics))
            return array();
        $userInfo = new User_info();
        $group = new Group();
        foreach ($arrTopics as $key => $item) {
            $arrTopic[] = $item;
            $arrTopic[$key]['group'] = $group->getOneGroup($item['groupid']);
            $arrTopic[$key]['user'] = $userInfo->getOneUser($item['userid']);
            $arrTopic[$key]['title'] = tsTitle($item['title']);
            $arrTopic[$key]['content'] = tsCutContent($item['content'], 150);
        }
        return $arrTopic;
    }
}