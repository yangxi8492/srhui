<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($seo['title'], ENT_QUOTES, "UTF-8"); ?></title>
    <meta name="keywords" content="<?php echo htmlspecialchars($seo['keywords'], ENT_QUOTES, "UTF-8"); ?>" />
    <meta name="description" content="<?php echo htmlspecialchars($seo['description'], ENT_QUOTES, "UTF-8"); ?>" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <link rel="stylesheet" type="text/css" href="/i/css/common_v1.css" />
    <link rel="stylesheet" type="text/css" href="/i/css/group.css" />
    <script type="text/javascript" src="/i/js/jquery-1.7.2.js" charset="utf-8"></script>
    </head>
<body  >
<!--头开-->
<div class="headNew-bg">
    <div class="head-wrap">

        <div class="index left">
            <a href="<?php echo htmlspecialchars($seo['host'], ENT_QUOTES, "UTF-8"); ?>" target="_blank"><?php echo htmlspecialchars($seo['webname'], ENT_QUOTES, "UTF-8"); ?></a>
            <em class="download"><img alt="" src="http://icon.yuemei.com/front/common/images/erweimaHead.png"/></em>
        </div>
        <div class="box-xx box_xx-line left">|</div>
        <div class="phone">
            <a href="<?php echo url(array('c'=>'group', 'a'=>'index', ));?>" target="_blank">悦美整形APP</a>
            <em class="download"></em>
        </div>
        <div class="box-xx box_xx-line left">|</div>
        <div class="weixin">
            <a href="javascript:;">悦美微信号</a>
            <em class="download"></em>
        </div>

        <!--未登录-->
        <div id="notLogin" class="sign-box to-sign">
            <div class="sign_hos"><a href="http://ymt.yuemei.com/login/" rel="nofollow">医院入口</a></div>
            <div class="box-xx box_xx-line">|</div>
            <div class="sign_doc"><a href="http://www.yuemei.com/user/d_register/" rel="nofollow">医生注册</a></div>
            <div class="box-xx box_xx-line">|</div>
            <div class="sign-right sign-user"><span><a href="http://user.yuemei.com/user/register/" rel="nofollow">用户注册</a></span></div>
            <div class="box-xx box_xx-line">|</div>
            <div class="sign-right"><span><a href="http://user.yuemei.com/user/login/" rel="nofollow">登录</a></span></div>
            <div class="box-xx box_xx-line">|</div>
            <div class="sign-right"><span class="callUs">联系客服<em>400 056 7118</em></span></div>
        </div>
        <!--//未登录-->
        <!--已登录-->
        <div id="isLogin" class="sign-box sign-on" style="display: none;">
        </div>
        <!--//已登录-->
    </div>
</div>
<div class="clear"></div>


<script charset="utf-8" src="http://icon.yuemei.com/front/common/js/common_head.js?version=577" type="text/javascript"></script><div class="community-head">
    <div class="head-wrap">
        <a title="悦美社区" href="http://fan.yuemei.com/" class="community-logo"></a>

        <div class="ym-search">
            <div class="search-box">
<input id="searchWd" class="search" data-type="tao" type="text" msg="水光针" value="" />
<label for="searchWd" class="hot-searchWd">开学小心机 颜值神助攻</label>
<a  id="YMsearch" href="javascript:;" class="search-btn">搜索</a></div><ul class="search-list"></ul><div class="hotItem clearfix"><a target="_blank" href="http://so.yuemei.com/tao/%E7%8E%BB%E5%B0%BF%E9%85%B8/">玻尿酸</a><a target="_blank" href="http://so.yuemei.com/tao/%E7%BE%8E%E7%99%BD%E9%92%88/">美白针</a><a target="_blank" href="http://so.yuemei.com/tao/%E5%8F%8C%E7%9C%BC%E7%9A%AE/">双眼皮</a><a target="_blank" href="http://so.yuemei.com/tao/%E5%90%B8%E8%84%82/">吸脂</a><a target="_blank" href="http://so.yuemei.com/tao/%E6%B0%B4%E5%85%89%E9%92%88/">水光针</a><a target="_blank" href="http://so.yuemei.com/tao/%E7%98%A6%E8%84%B8%E9%92%88/">瘦脸针</a></div>        </div>

        <div class="select-box">
            <div class="select-top">
                <p class="select-txt">发帖</p>
                <div class="select-btn"></div>
            </div>
            <div class="select-list" id="user_select_list">
                <a href="http://ask.yuemei.com/q/" target="_blank">问医生</a>
                <a href="http://www.yuemei.com/u_share/" target="_blank">写日记</a>
                <a href="http://user.yuemei.com/user/talk/" target="_blank">随便聊聊</a>
            </div>
            <div class="select-list" id="doctor_select_list">
                <a href="http://user.yuemei.com/user/case/" target="_blank">发案例</a>
                <a href="http://user.yuemei.com/user/article/" target="_blank">发观点</a>
            </div>
        </div>
    </div>
</div>
<!--//头结束-->
<?php include $_view_obj->compile($__template_file); ?>
</div>
</body>
</html>