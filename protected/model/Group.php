<?php
class Group extends Model{
	public $table_name = "sr_group";
	
	//Refer二级循环，三级循环暂时免谈
	function recomment($referid){
	    $userInfo = new User_info();
	    $topicComment = new Group_topic_comment();
	    $strComment = $topicComment->find(array(
	        'commentid'=>$referid,
	    ));
	
	    $strComment['content'] = tsDecode($strComment['content']);
	    $strComment['user'] = $userInfo->getOneUser($strComment['userid']);
	    return $strComment;
	}
	
	public function getGroupList($sort='addtime asc'){
	    // 所有小组
	    $arr = array(
	        'isaudit' => 0
	    );
	    $arrGroup = $this->findAll($arr, $sort);
	    foreach ( $arrGroup as $key => $item ) {
	        $arrGroup [$key] ['groupname'] = tsTitle ( $item['groupname'] );
	        $arrGroup [$key] ['groupdesc'] = cututf8 ( t(tsDecode($item ['groupdesc'])), 0, 35 );
	        if($item['photo']){
	            $arrGroup [$key] ['photo'] = tsXimg($item['photo'],'group',180,180,$item['path'],1);
	        }else{
	            $arrGroup [$key] ['photo'] = SITE_URL.'public/images/group.jpg';
	        }
	    }
	    return $arrGroup;
	}
	//获取最新创建的小组
	public function getNewGroup($num){
	    $arrNewGroups = $this->findAll(array(
	        'isaudit'=>'0'
	    ),'addtime desc', '', $num);
	    if(is_array($arrNewGroups)){
	        foreach($arrNewGroups as $item){
	            //$arrNewGroup[] = $this->getOneGroup($item['groupid']);
	        }
	    }
	    return $arrNewGroup;
	}
	
	//获取一个小组
	public function getOneGroup($groupid){
	    $strGroup=$this->find(array(
	        'groupid'=>$groupid,
	    ));
	    if($strGroup){
	        $strGroup['groupname'] = tsTitle($strGroup['groupname']);
	        $strGroup['groupdesc'] = tsDecode($strGroup['groupdesc']);
	        	
	        if($strGroup['photo']){
	            $strGroup['photo'] = tsXimg($strGroup['photo'],'group',120,120,$strGroup['path'],1);
	        }else{
	            $strGroup['photo'] = SITE_URL.'public/images/group.jpg';
	        }
	    }
	    return $strGroup;
	}
	
	public function getOneGroupByDir($dir){
	    $strGroup=$this->find(array(
	        'randname'=>$dir,
	    ));
	    if($strGroup){
	        $strGroup['groupname'] = tsTitle($strGroup['groupname']);
	        $strGroup['groupdesc'] = tsDecode($strGroup['groupdesc']);
	        if($strGroup['photo']){
	            $strGroup['photo'] = tsXimg($strGroup['photo'],'group',120,120,$strGroup['path'],1);
	        }else{
	            $strGroup['photo'] = SITE_URL.'public/images/group.jpg';
	        }
	    }
	    return $strGroup;
	}
}