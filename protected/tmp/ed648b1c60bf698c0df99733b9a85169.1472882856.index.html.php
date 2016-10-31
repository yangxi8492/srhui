<?php if(!class_exists("View", false)) exit("no direct access allowed");?><?php include $_view_obj->compile("header.html"); ?>

<div class="clear"></div>
<!--//公用头-->
<script type="text/javascript">
    var fan ="http://fan.yuemei.com/";
    var user = "http://user.yuemei.com/";
</script>
<!--此区域内放置页面内容--->
<div class="community-wrap">
    <div class="community-main clearfix">

        <div class="main-ls">

            <div class="ls-top">全部讨论组</div>

            <div class="discuss-lab">
            <?php $_foreach_item_counter = 0; $_foreach_item_total = count($arrGroup);?><?php foreach( $arrGroup as $k => $item ) : ?><?php $_foreach_item_index = $_foreach_item_counter;$_foreach_item_iteration = $_foreach_item_counter + 1;$_foreach_item_first = ($_foreach_item_counter == 0);$_foreach_item_last = ($_foreach_item_counter == $_foreach_item_total - 1);$_foreach_item_counter++;?>
                <div class="lab-list">
                    <div class="fl-l">
                        <img src="<?php echo htmlspecialchars($item['photo'], ENT_QUOTES, "UTF-8"); ?>" alt="<?php echo htmlspecialchars($item['groupname'], ENT_QUOTES, "UTF-8"); ?>" />
                    </div>
                    <div class="fl-r">
                        <a class="lab-name text-hidden" href="<?php echo url(array('c'=>'group', 'a'=>'index', 'cid'=>$item['groupid'], ));?>"><?php echo htmlspecialchars($item['groupname'], ENT_QUOTES, "UTF-8"); ?></a>
                        <div class="text-hidden">今日+<?php echo htmlspecialchars($item['count_user'], ENT_QUOTES, "UTF-8"); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
                <div class="lab-list lab-last">
                    <div class="fl-l"></div>
                    <div class="fl-r">
                        <a class="lab-name text-hidden" href="javascript:;">更多讨论组</a>
                        <div class="text-hidden">敬请期待...</div>
                    </div>
                </div>
            </div>

            <div class="lab-nav">
                <a class="now" href="http://fan.yuemei.com/">热门</a>
                <a  href="http://fan.yuemei.com/new/">最新</a>
                <a  href="http://fan.yuemei.com/best/">精华</a>
                <a  href="http://fan.yuemei.com/star/">达人</a>
                <a  href="http://fan.yuemei.com/event/">活动<i class="hot-icon"></i></a>
            </div>
            <ul class="nav-cont">
                        <?php $_foreach_item_counter = 0; $_foreach_item_total = count($topTopic);?><?php foreach( $topTopic as $k => $item ) : ?><?php $_foreach_item_index = $_foreach_item_counter;$_foreach_item_iteration = $_foreach_item_counter + 1;$_foreach_item_first = ($_foreach_item_counter == 0);$_foreach_item_last = ($_foreach_item_counter == $_foreach_item_total - 1);$_foreach_item_counter++;?>
                      <li>
                    <div class="fl-l">
                        <a href="<?php echo url(array('c'=>'user', 'a'=>'index', 'uid'=>$item['userid'], ));?>" class="top-img" target="_blank">
                            <img src="<?php echo htmlspecialchars($item['user']['face'], ENT_QUOTES, "UTF-8"); ?>" alt="<?php echo htmlspecialchars($item['user']['username'], ENT_QUOTES, "UTF-8"); ?>" />
                        </a>
                        <a class="top-name text-hidden" href="<?php echo url(array('c'=>'user', 'a'=>'index', 'uid'=>$item['userid'], ));?>" target="_blank"><?php echo htmlspecialchars($item['user']['username'], ENT_QUOTES, "UTF-8"); ?></a>
                                                <div class="name-icon icon2"></div>                    </div>
                    <div class="fl-r">
                        <div class="rs-top">
                            <a href="<?php echo url(array('c'=>'group', 'a'=>'topic', 'tid'=>$item['topicid'], ));?>" target="_blank"><?php echo htmlspecialchars($item['content'], ENT_QUOTES, "UTF-8"); ?></a>
                            <i class="lab-icon top">置顶</i>                        
                        </div>
                        <div class="rs-cont">
                             <a href="<?php echo url(array('c'=>'group', 'a'=>'topic', 'tid'=>$item['topicid'], ));?>" target="_blank"><img src="http://p21.yuemei.com/forum/image/20160825/150_150/160825133356_4ac224.png" alt="3分钟攻略｜如何让悦美代金券帮你省500元？" /></a> 
                        </div>
                        <div class="rs-bot">
                            <a href="<?php echo url(array('c'=>'group', 'a'=>'topic', 'tid'=>$item['topicid'], ));?>" target="_blank" class="fl-r reply"><i></i>回复(<?php echo htmlspecialchars($item['count_comment'], ENT_QUOTES, "UTF-8"); ?>)</a>
                            <span class="fl-r great"><i></i>浏览(<?php echo htmlspecialchars($item['count_comment'], ENT_QUOTES, "UTF-8"); ?>)</span>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
                
                        <?php $_foreach_item_counter = 0; $_foreach_item_total = count($arrTopic);?><?php foreach( $arrTopic as $k => $item ) : ?><?php $_foreach_item_index = $_foreach_item_counter;$_foreach_item_iteration = $_foreach_item_counter + 1;$_foreach_item_first = ($_foreach_item_counter == 0);$_foreach_item_last = ($_foreach_item_counter == $_foreach_item_total - 1);$_foreach_item_counter++;?>
                                <li>
                    <div class="fl-l">
                        <a href="<?php echo url(array('c'=>'user', 'a'=>'index', 'uid'=>$item['userid'], ));?>" class="top-img" target="_blank">
                            <img src="<?php echo htmlspecialchars($item['user']['face'], ENT_QUOTES, "UTF-8"); ?>" alt="<?php echo htmlspecialchars($item['user']['username'], ENT_QUOTES, "UTF-8"); ?>" />
                        </a>
                        <a class="top-name text-hidden" href="<?php echo url(array('c'=>'user', 'a'=>'index', 'uid'=>$item['userid'], ));?>" target="_blank"><?php echo htmlspecialchars($item['user']['username'], ENT_QUOTES, "UTF-8"); ?></a>
                    	<div class="name-icon icon2"></div>
					</div>
                    <div class="fl-r">
                        <div class="rs-top">
                            <a href="<?php echo url(array('c'=>'group', 'a'=>'topic', 'tid'=>$item['topicid'], ));?>" target="_blank"><?php echo htmlspecialchars($item['content'], ENT_QUOTES, "UTF-8"); ?></a>
                        </div>
                        <div class="rs-cont">
                            <a href="<?php echo url(array('c'=>'group', 'a'=>'topic', 'tid'=>$item['topicid'], ));?>" target="_blank"><img src="http://p21.yuemei.com/forum/image/20160825/150_150/160825133356_4ac224.png" alt="3分钟攻略｜如何让悦美代金券帮你省500元？" /></a>
                        </div>
                        <div class="rs-bot">
                            <a href="<?php echo url(array('c'=>'group', 'a'=>'topic', 'tid'=>$item['topicid'], ));?>" target="_blank" class="fl-r reply"><i></i>回复(<?php echo htmlspecialchars($item['count_comment'], ENT_QUOTES, "UTF-8"); ?>)</a>
                            <span class="fl-r great"><i></i>浏览(<?php echo htmlspecialchars($item['count_comment'], ENT_QUOTES, "UTF-8"); ?>)</span>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="main-rs">
                        <div class="rs-tit"><span>热门话题</span></div>
            <ul class="hot-topic">
            	<?php $_foreach_item_counter = 0; $_foreach_item_total = count($hotTopics);?><?php foreach( $hotTopics as $k => $item ) : ?><?php $_foreach_item_index = $_foreach_item_counter;$_foreach_item_iteration = $_foreach_item_counter + 1;$_foreach_item_first = ($_foreach_item_counter == 0);$_foreach_item_last = ($_foreach_item_counter == $_foreach_item_total - 1);$_foreach_item_counter++;?>
                <li>
                    <a class="fl-l" href="<?php echo url(array('c'=>'group', 'a'=>'topic', 'tid'=>$item['topicid'], ));?>" target="_blank">
                        <img src="<?php echo htmlspecialchars($item['user']['face'], ENT_QUOTES, "UTF-8"); ?>" alt="<?php echo htmlspecialchars($item['content'], ENT_QUOTES, "UTF-8"); ?>" /></a>
                    <a class="fl-r" href="<?php echo url(array('c'=>'group', 'a'=>'topic', 'tid'=>$item['topicid'], ));?>" target="_blank"><?php echo htmlspecialchars($item['title'], ENT_QUOTES, "UTF-8"); ?></a>
                </li>
                <?php endforeach; ?>
             </ul>
            <div class="rs-tit mar-t46"><span>推荐达人</span></div>
            <ul class="hot-doc">
            <?php $_foreach_item_counter = 0; $_foreach_item_total = count($recommend);?><?php foreach( $recommend as $k => $item ) : ?><?php $_foreach_item_index = $_foreach_item_counter;$_foreach_item_iteration = $_foreach_item_counter + 1;$_foreach_item_first = ($_foreach_item_counter == 0);$_foreach_item_last = ($_foreach_item_counter == $_foreach_item_total - 1);$_foreach_item_counter++;?>
               <li class="clearfix">
                    <a  class="pic-box fl-l" target="_blank" href="<?php echo url(array('c'=>'user', 'a'=>'index', 'uid'=>$item['userid'], ));?>">
                    <img width="45" height="45" src="<?php echo htmlspecialchars($item['face'], ENT_QUOTES, "UTF-8"); ?>" alt="<?php echo htmlspecialchars($item['username'], ENT_QUOTES, "UTF-8"); ?>"></a>
                    <div class="arc">
                        <a class="doc-name" target="_blank" href="<?php echo url(array('c'=>'user', 'a'=>'index', 'uid'=>$item['userid'], ));?>"><?php echo htmlspecialchars($item['username'], ENT_QUOTES, "UTF-8"); ?></a>
                        <a class="hospital-name" target="_blank" href="<?php echo url(array('c'=>'user', 'a'=>'index', 'uid'=>$item['userid'], ));?>"><?php echo htmlspecialchars($item['signed'], ENT_QUOTES, "UTF-8"); ?></a>
                    </div>
                </li>
                <?php endforeach; ?>
              </ul>
            <div class="rs-tit mar-t46">
                <span>热销服务</span>
                <a class="more" href="http://tao.yuemei.com/s1.html" target="_blank">更多<i></i></a>
            </div>
            <ul class="hot-service">
                                <li class="clearfix">
                    <div class="num">1</div>
                    <a href="http://tao.yuemei.com/17701/" class="name" target="_blank">上海海薇玻尿酸注射</a>
                    <span class="money">¥ 880</span>
                </li>
                                <li class="clearfix">
                    <div class="num">2</div>
                    <a href="http://tao.yuemei.com/11629/" class="name" target="_blank">深圳伊婉玻尿酸注射美容</a>
                    <span class="money">¥ 960</span>
                </li>
                                <li class="clearfix">
                    <div class="num">3</div>
                    <a href="http://tao.yuemei.com/17509/" class="name" target="_blank">上海韩国进口伊婉玻尿酸注射</a>
                    <span class="money">¥ 999</span>
                </li>
                                <li class="clearfix">
                    <div class="last">4</div>
                    <a href="http://tao.yuemei.com/21291/" class="name" target="_blank">北京伊婉玻尿酸微整形</a>
                    <span class="money">¥ 729</span>
                </li>
                                <li class="clearfix">
                    <div class="last">5</div>
                    <a href="http://tao.yuemei.com/13905/" class="name" target="_blank">广州伊婉玻尿酸注射</a>
                    <span class="money">¥ 950</span>
                </li>
                            </ul>

            <!--新添加的下载链接-->
            <div class="new_down2">
                <img src="http://icon.yuemei.com/front/common/images/pctoapp/32.png">
            </div>
            <!--//新添加的下载链接-->

            <a class="complaints" href="http://fan.yuemei.com/tousu/" target="_blank"><i></i><span>求美者投诉曝光<i></i></a></a>

        </div>

    </div>
</div>
<!--//此区域内放置页面内容--->
<div class="clear"></div>
<div class="faith">
    <div class="ym-wrap">
        <div>
            <span class="prof"></span>
            <span class="sunl"></span>
            <span class="conv"></span>
            <span class="cheep"></span>
        </div>
    </div>
</div>
<div class="ym-footer">
    <div class="ym-info">
        <div class="foot-wrap">
            <div class="ym-logo">
                <div><img src="http://icon.yuemei.com/front/common/images/footlogo.png"/></div>
                <p><span>客服电话：</span><em>400-056-7118</em></p>
            </div>
            <div class="ym-about">
                <dl>
                    <dt>关于我们</dt>
                    <dd><a href="http://www.yuemei.com/aboutus.html" rel="nofollow">关于悦美</a></dd>
                    <dd><a href="http://www.yuemei.com/joinus.html" rel="nofollow">加入我们</a></dd>
                    <dd><a href="http://www.yuemei.com/contactus.html" rel="nofollow">联系我们</a></dd>
                    <dd><a href="http://www.yuemei.com/disclaimer.html" rel="nofollow">版权声明</a></dd>
                </dl>
                <dl>
                    <dt>用户</dt>
                    <dd><a href="http://tao.yuemei.com/">淘整形</a></dd>
                    <dd><a href="http://news.yuemei.com/">整形资讯</a></dd>
                    <!--<dd><a href="http://www.yuemei.com/fanxian.html">用户返现</a></dd>-->
                    <dd><a href="http://www.yuemei.com/feedback/" rel="nofollow">意见反馈</a></dd>
                    <dd><a href="http://photo.yuemei.com/">前后对比图</a></dd>
                    <dd><a href="http://www.yuemei.com/app/kuaiwen.html">客户端下载</a></dd>
                </dl>
                <dl>
                    <dt>战略合作</dt>
                    <dd>上海九院整复</dd>
                    <dd>西京医院整形</dd>
                    <dd>南方医院整形</dd>
                </dl>
                <dl>
                    <dt>&nbsp;</dt>
                    <dd>北京协和医院</dd>
                    <dd>中国医师协会</dd>
                    <dd>中华医学会整</dd>
                    <dd>西南医院整形</dd>
                </dl>
            </div>
            <div class="ym-public">
                <div class="ym-wb"><span><a rel="nofollow" title="关注悦美官方微博" href="http://weibo.com/2278448413" target="_blank">官方微博</a></span></div>
                <div class="ym-wx"></div>
            </div>
        </div>
    </div>
    <div class="fr-link">
        <div class="foot-wrap">
            <div class="friends"><span>友情链接：</span><a target="_blank" href="http://www.shangxing2010.com/">杭州婚纱摄影</a><a target="_blank" href="http://www.gucciblog.com/">gucci部落皮具</a><a target="_blank" href="http://zxmr.999120.net/">导医整形美容</a><a target="_blank" href="http://www.5ha.net/">娱乐八卦</a><a target="_blank" href="http://gongyi.boosj.com/">爱心公益活动</a><a target="_blank" href="http://xiamen.napai.cn/">厦门个人写真</a><a target="_blank" href="http://www.33ik.cn/">厦门互动网</a><a target="_blank" href="http://www.hbwhqz.com/">PhiSkin芙艾医疗</a><a target="_blank" href="http://wk.39.net/">外科</a><a target="_blank" href="http://www.pubangwang.cn/">铺帮网</a><a target="_blank" href="http://www.huiningtang.com/">虫草</a><a target="_blank" href="http://baojian.jianke.com/">保健品商城</a><a target="_blank" href="http://www.mimito.com.cn">女人街</a><a target="_blank" href="http://www.ftxk.cn">营养保健品</a><a target="_blank" href="http://cs.panzi.cc/">古装摄影</a><a target="_blank" href="http://www.meishang8.com/">美尚网</a><a target="_blank" href="http://jb.9939.com/">疾病百科</a><a target="_blank" href="http://zx.youde.com/">优德健康资讯</a><a target="_blank" href="http://lvyou.liuxue86.com">旅游</a><a target="_blank" href="http://ty.focus.cn/">太原房产</a><a target="_blank" href="http://zhengxing.jstv.com/">南京整形医院</a><a target="_blank" href="http://www.ilidu.com/">整形医院</a><a target="_blank" href="http://www.citshs.com/">济南整形医院</a></div>            <div class="state">
                <p><span>本站声明：</span>任何信息都不能替代执业医师面对面的诊断和治疗，本网站所载的各种信息和数据等仅供参考，本站不承担由此引起的法律责任；本站淘整形频道所有项目基于医疗美容机构所提供素材编辑完成，但并不对其准确性、充足性或完整性做任何保证，因信息不合理、不准确或遗漏导致的任何损失或损害，或不符合相关法律法规，本站也不承担相应的法律责任。</p>
                <p class="state-p"><span>京ICP证110968号</span><span>京ICP备11042644号-1</span><span><img src="http://icon.yuemei.com/front/common/images/jing-icon.png">京公网安备11010802021734号</span><span>互联网药品信息服务资格证书编号 (京) -经营性-2011-0031</span></p>
                <p class="state-p">经营性网站备案京卫计网审[2015]第0066号Copyright &copy; yuemei.com. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="http://js.yuemei.com/front/community-8-5/js/community.js?v=577" charset="utf-8"></script>
<!--//融云-->
<script>
    var ry_src='';
</script>
<div class="ryOnPage" id="ryOnPage" style="display: none">
    <div class="editBtns">
        <span class="hideIt"></span>
        <a href="" class="maxIt"></a>
        <span class="minIt"></span>
    </div>
    <span class="showIt"></span>

    <iframe src="" width="300" height="434" id="newTalk"></iframe>
</div>
<!--//融云结束-->

<div style="display: none;">
    <script src="http://cdn.ronghub.com/RongIMLib-2.1.0.min.js"></script>
<!--    <script src="//meiqia.com/js/mechat.js?unitid=553af79d4eae353c2f000001" charset="UTF-8" async="async"></script>-->
    <!--//嵌入新版本美洽代码-->
    <script type='text/javascript'>
        $(function(){
            (function(m, ei, q, i, a, j, s) {
                m[a] = m[a] || function() {
                    (m[a].a = m[a].a || []).push(arguments)
                };
                j = ei.createElement(q),
                    s = ei.getElementsByTagName(q)[0];
                j.async = true;
                j.src = i;
                s.parentNode.insertBefore(j, s)
            })(window, document, 'script', '//eco-api.meiqia.com/dist/meiqia.js', '_MEIQIA');
            _MEIQIA('entId', 21455);
            //开启无按钮模式
            _MEIQIA('withoutBtn');
        });
    </script>    <!--//嵌入美洽代码-->
</div>
<!--//公用底-->

<div style="display:none"><script src='http://js.yuemei.com/front/ym_tj.js?v=577'></script></div>
</body>
</html>