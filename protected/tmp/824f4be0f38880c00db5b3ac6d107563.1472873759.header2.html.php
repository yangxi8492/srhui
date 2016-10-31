<?php if(!class_exists("View", false)) exit("no direct access allowed");?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($seo['title'], ENT_QUOTES, "UTF-8"); ?></title>
    <meta name="keywords" content="<?php echo htmlspecialchars($seo['keywords'], ENT_QUOTES, "UTF-8"); ?>" />
    <meta name="description" content="<?php echo htmlspecialchars($seo['description'], ENT_QUOTES, "UTF-8"); ?>" />
    <meta http-equiv="Cache-Control" content="no-transform" />
    <link rel="stylesheet" type="text/css" href="/i/css/channel-pub.css" />
    <link rel="stylesheet" type="text/css" href="/i/css/group_topic.css" />
    <script type="text/javascript" src="/i/js/jquery-1.7.2.js" charset="utf-8"></script>
    </head>
<body  >
<!--内页公用头-->
<div class="chanl-head white">
    <ul class="flleft">
        <li><a href="http://www.yuemei.com/" class="logo" target="_blank"><img alt="悦美网" src="http://icon.yuemei.com/front/common/images/logo_top.png"></a></li>
                    <li><a href="http://www.yuemei.com/" target="_blank">首页</a></li>
                    <li><a href="http://www.yuemei.com/parts.html" target="_blank">项目</a></li>
                    <li><a href="http://ask.yuemei.com/" target="_blank">问答</a></li>
                    <li><a href="http://doctor.yuemei.com/" target="_blank">找医生</a></li>
                    <li><a href="http://hospital.yuemei.com/" target="_blank">找医院</a></li>
                    <li><a href="http://fan.yuemei.com/" target="_blank">社区</a></li>
                    <li><a href="http://tao.yuemei.com/" target="_blank">淘整形</a></li>
                    <li><a href="http://www.yuemei.com/app/kuaiwen.html" target="_blank">APP</a></li>
        
    </ul>
            <div class="ym-search">
            <div class="search-box">
                <input class="search" data-type='tao' id='searchWd' type="text" msg="" value="" />
                <a href="javascript:;" id='YMsearch' target="_blank" class="search-btn"></a>
                
            </div>
            <ul class="search-list">
            </ul>
        </div>    <!--未登录-->
    <ul id="notLogin" class="flright noin" >
        <li><a href="http://ymt.yuemei.com/login/" target="_blank" class="hos-in" rel="nofollow">医院入口<i>|</i></a></li>
        <li><a href="http://www.yuemei.com/user/d_register/" target="_blank" class="doc-in" rel="nofollow">医生注册<i>|</i></a></li>
        <li><a href="http://user.yuemei.com/user/register/" target="_blank" class="user-in" rel="nofollow">用户注册<i>|</i></a></li>
        <li><a href="http://user.yuemei.com/user/login/" target="_blank" class="login" rel="nofollow">登录</a></li>
    </ul>
    <!--//未登录-->
    <!--已登录-->
    <ul id="isLogin" class="flright isin" style="display:none">

    </ul>
    <!--//已登录-->
</div>
<script>meiqia = true</script>
<!--//内页公用头-->