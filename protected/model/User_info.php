<?php
class User_info extends Model{
	public $table_name = "sr_user_info";
	
	function getOneUser($userid){
	    if(empty($userid)){
	        return '';
	    }
	    $strUser = $this->find(array(
	        'userid'=>$userid,
	    ));
	    if($strUser){
	        $strUser['username'] = tsTitle($strUser['username']);
	        $strUser['email'] = tsTitle($strUser['email']);
	        $strUser['phone'] = tsTitle($strUser['phone']);
	        $strUser['province'] = tsTitle($strUser['province']);
	        $strUser['city'] = tsTitle($strUser['city']);
	        $strUser['signed'] = tsTitle($strUser['signed']);
	        $strUser['about'] = tsTitle($strUser['about']);
	        $strUser['address'] = tsTitle($strUser['address']);
	    
	        if($strUser['face'] && $strUser['path']){
	            $strUser['face'] = tsXimg($strUser['face'],'user',120,120,$strUser['path'],1);
	        }elseif($strUser['face'] && $strUser['path']==''){
	            $strUser['face']	= '/i/images/'.$strUser['face'];
	        }else{
	            //没有头像
	            $strUser['face']	= '/i/images/user_large.jpg';
	        }
	        //$strUser['rolename'] = $this->getRole($strUser['allscore']);
	    }else{
	        $strUser = '';
	    }
	    return $strUser;
	}
	
	public function getRecommend( $num ){
	    $strUsers = $this->findAll(array(
	        'isrecommend'=> 1,
	    ), "uptime desc", '*', $num);
	    $strUser = array();
	    foreach ($strUsers as $key=>$item){
	        $strUser[] = $item;
	        $strUser[$key]['email'] = tsTitle($item['email']);
	        $strUser[$key]['phone'] = tsTitle($item['phone']);
	        $strUser[$key]['province'] = tsTitle($item['province']);
	        $strUser[$key]['city'] = tsTitle($item['city']);
	        $strUser[$key]['signed'] = tsTitle($item['signed']);
	        $strUser[$key]['about'] = tsTitle($item['about']);
	        $strUser[$key]['address'] = tsTitle($item['address']);
	         
	        if($item['face'] && $item['path']){
	            $strUser[$key]['face'] = tsXimg($item['face'],'user',120,120,$item['path'],1);
	        }elseif($item['face'] && $item['path']==''){
	            $strUser[$key]['face']	= SITE_URL.'public/images/'.$item['face'];
	        }else{
	            //没有头像
	            $strUser[$key]['face']	= SITE_URL.'public/images/user_large.jpg';
	        }
	    }
	    return $strUser;
	}
}