<?php
class LoginController extends BaseController {
	// qq
	function actionQq(){
		$qq = new qq();
		$qq->qq_login();
	}
	
	//weibo
	function actionWeibo(){
	    $o = new weibo( WB_AKEY , WB_SKEY );
	    $code_url = $o->getAuthorizeURL( WB_CALLBACK_URL );
	    header("Location: " . $code_url);
	}
	
	//登陆回调地址
	function actionCallback(){
		$mod = arg('mod');
		
		if($mod == 'qq'){
			//qq登陆
			$this->qqCallback();
		}elseif ($mod == 'weibo'){
			//weibo登陆
			$this->weiboCallback();
		}
		exit;
	}
	
	private function weiboCallback(){
		$user = new User();
		$userInfo = new User_info();
		
		$o = new weibo( WB_AKEY , WB_SKEY );
		if (isset($_REQUEST['code'])) {
		
			$keys = array();
			$keys['code'] = $_REQUEST['code'];
			$keys['redirect_uri'] = WB_CALLBACK_URL;
			try {
				$token = $o->getAccessToken( 'code', $keys ) ;
			} catch (OAuthException $e) {
			}
		}
		$access_token = $token['access_token'];
		$openid = $token['uid'];
		
		//cookie10天
		setcookie("weibo_access_token",$access_token, time()+3600*24*10);
		setcookie("weibo_openid",$openid, time()+3600*24*10);
		
		if($openid){
			$conditions['setname'] = 'weibo';
			$conditions['openid'] = $openid;
			$strOpen = $user->find($conditions);
			if($strOpen['userid']){
				$userData = $userInfo->find(
						array(
							'userid'=>$strOpen['userid'],
						)
				);
				$row['ip'] = $_SERVER["REMOTE_ADDR"];
				$row['uptime'] = time();
				$row['access_token'] = $access_token;
				$userInfo->update(array('userid'=>$strOpen['userid']), $row);
					
				$_SESSION['srUser']	= $userData;
				header("Location: /");
				exit;
			}
		}else{
			//获取用户基本资料
			
			$c = new SaeTClientV2( WB_AKEY , WB_SKEY , $access_token );
			$uid_get = $c->get_uid();
			$uid = $uid_get['uid'];
			$arrUserInfo = $c->show_user_by_id( $uid);
			
			/*
			 Array ( [id] => 2741015883 [idstr] => 2741015883 [class] => 1 [screen_name] => 哥哥很伤心啦 [name] => 哥哥很伤心啦 [province] => 11 [city] => 5 [location] => 北京 朝阳区 [description] => [url] => [profile_image_url] => http://tp4.sinaimg.cn/2741015883/50/5633423902/1 [profile_url] => u/2741015883 [domain] => [weihao] => [gender] => m [followers_count] => 3 [friends_count] => 30 [statuses_count] => 0 [favourites_count] => 0 [created_at] => Thu May 31 17:22:49 +0800 2012 [following] => [allow_all_act_msg] => [geo_enabled] => 1 [verified] => [verified_type] => -1 [remark] => [ptype] => 0 [allow_all_comment] => 1 [avatar_large] => http://tp4.sinaimg.cn/2741015883/180/5633423902/1 [avatar_hd] => http://tp4.sinaimg.cn/2741015883/180/5633423902/1 [verified_reason] => [follow_me] => [online_status] => 0 [bi_followers_count] => 0 [lang] => zh-cn [star] => 0 [mbtype] => 0 [mbrank] => 0 [block_word] => 0 )
			*/
			
			if($arrUserInfo['screen_name']==''){
				msgJump('登陆失败！','/');exit;
			}
			
			$salt = md5(rand());
			$pwd = random(5,0);
			
			$userid = $user->create(array(
					'pwd'		=> md5($salt.$pwd),
					'salt'		=> $salt,
					'email'		=> $openid,
					'username' 	=> $arrUserInfo['screen_name'],
					'openid' 	=> $openid,
					'setname' 	=> 'qq',
					'access_token' => $access_token,
					'code' 		=> random(10, 1)
			));
			
			//更新用户头像
			if($arrUserInfo['avatar_large']){
				//1000个图片一个目录
				$menu2=intval($userid/1000);
				$menu1=intval($menu2/1000);
				$menu = $menu1.'/'.$menu2;
				$photo = $userid.'.jpg';
					
				$photos = $menu.'/'.$photo;
					
				$dir = 'uploadfile/user/'.$menu;
					
				$dfile = $dir.'/'.$photo;
					
				createFolders($dir);
					
				if(!is_file($dfile)){
					$img = file_get_contents($arrUserInfo['avatar_large']);
					file_put_contents($dfile,$img);
				};
			}
			//插入user_info
			$userInfo->create(array(
					'userid'	=> $userid,
					'username' 	=> $arrUserInfo['screen_name'],
					'email'		=> $openid,
					'ip'		=> $_SERVER["REMOTE_ADDR"],
					'addtime'	=> time(),
					'uptime'	=> time(),
					'path'		=> $menu,
					'face'		=> $photos,
			));
			//获取用户信息
			$userData = $userInfo->find(
					array(
							'userid' => $userid,
					)
			);
			$_SESSION['srUser']	= $userData;
			header("Location: /");
			exit;
		}
	}
	
	private function qqCallback(){
		$user = new User();
		$userInfo = new User_info();
		
		$qq = new qq();
		$access_token = $qq->qq_callback();
		$openid = $qq->get_openid();
		if($openid){
			$conditions['setname'] = 'qq';
			$conditions['openid'] = $openid;
			$strOpen = $user->find($conditions);
			if($strOpen['userid']){
				$userData = $userInfo->find(
						array(
								'userid'=>$strOpen['userid'],
						)
				);
				$row['ip'] = $_SERVER["REMOTE_ADDR"];
				$row['uptime'] = time();
				$row['access_token'] = $access_token;
				$userInfo->update(array('userid'=>$strOpen['userid']), $row);
					
				$_SESSION['srUser']	= $userData;
				header("Location: /");
				exit;
			}
		}else{
			//获取用户基本资料
			$arrUserInfo = $qq->get_user_info();
			/*
			 Array
			(
					[ret] => 0
					[msg] =>
					[nickname] => 我就是我
					[gender] => 男
					[figureurl] => http://qzapp.qlogo.cn/qzapp/205607/30CA6A53A2580AAD3299CB874EEED345/30
					[figureurl_1] => http://qzapp.qlogo.cn/qzapp/205607/30CA6A53A2580AAD3299CB874EEED345/50
					[figureurl_2] => http://qzapp.qlogo.cn/qzapp/205607/30CA6A53A2580AAD3299CB874EEED345/100
					[figureurl_qq_1] => http://q.qlogo.cn/qqapp/205607/30CA6A53A2580AAD3299CB874EEED345/40
					[figureurl_qq_2] => http://q.qlogo.cn/qqapp/205607/30CA6A53A2580AAD3299CB874EEED345/100
					[is_yellow_vip] => 0
					[vip] => 0
					[yellow_vip_level] => 0
					[level] => 0
					[is_yellow_year_vip] => 0
			)
			*/
			if($arrUserInfo['nickname']==''){
				msgJump('登陆失败！','/');exit;
			}
		
			$salt = md5(rand());
			$pwd = random(5,0);
			$userid = $user->create(array(
					'pwd'		=> md5($salt.$pwd),
					'salt'		=> $salt,
					'email'		=> $openid,
					'username' 	=> $arrUserInfo['nickname'],
					'openid' 	=> $openid,
					'setname' 	=> 'qq',
					'access_token' => $access_token,
					'code' 		=> random(10, 1)
			));
		
			//更新用户头像
			if($arrUserInfo['figureurl_qq_2']){
				//1000个图片一个目录
				$menu2=intval($userid/1000);
				$menu1=intval($menu2/1000);
				$menu = $menu1.'/'.$menu2;
				$photo = $userid.'.jpg';
				$photos = $menu.'/'.$photo;
		
				$dir = 'uploadfile/user/'.$menu;
				$dfile = $dir.'/'.$photo;
				createFolders($dir);
					
				if(!is_file($dfile)){
					$img = file_get_contents($arrUserInfo['figureurl_qq_2']);
					file_put_contents($dfile,$img);
				};
			}
		
			//插入user_info
			$userInfo->create(array(
					'userid'	=> $userid,
					'username' 	=> $arrUserInfo['nickname'],
					'email'		=> $openid,
					'ip'		=> $_SERVER["REMOTE_ADDR"],
					'addtime'	=> time(),
					'uptime'	=> time(),
					'path'		=> $menu,
					'face'		=> $photos,
			));
			//获取用户信息
			$userData = $userInfo->find(
					array(
							'userid' => $userid,
					)
			);
			$_SESSION['srUser']	= $userData;
			header("Location: /");
			exit;
		}
	}
}