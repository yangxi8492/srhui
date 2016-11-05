<?php if(!class_exists("View", false)) exit("no direct access allowed");?><?php include $_view_obj->compile("admin/header.html"); ?>
<script type="text/javascript">
	var index_tabs;
	$(function() {
		index_tabs = $('#index_tabs').tabs({
			fit : true,
			onContextMenu : function(e, title) {
				e.preventDefault();
				index_tabsMenu.menu('show', { 
					left : e.pageX,
					top : e.pageY
				}).data('tabTitle', title);
			}
		}); 
	});

	function addTab(title, url){ //创建tabs
	    if ($('#index_tabs').tabs('exists', title)){  
	        $('#index_tabs').tabs('select', title);  
	    } else {  
	        var content = '<iframe scrolling="auto" frameborder="0"  src="'+url+'" style="width:100%;height:99.2%;"></iframe>';  
	        $('#index_tabs').tabs('add',{  
	            title:title,  
	            content:content,
	            closable:true  
	        });  
	    };
	};
	


	function closeTab(){ //关闭当前，新增tabs
		var TopTab=$('#index_tabs')
		TopTab.tabs('close','新增医院');
	    TopTab.tabs('add',{title:'新增医院',content:'<iframe scrolling="auto" frameborder="0"  src="hospital-index.html" style="width:100%;height:99.2%;"></iframe>',closable:true });
	} 

	$(function(){
		$("#rgtiframe").html('<iframe src="<?php echo url(array('c'=>"admin/main", 'a'=>"welcome", ));?>" frameborder="0" width="100%" height="99.2%" style="min-width:1120px;"></iframe>')
	});
	
</script>

<!-- north区域 -->
<div data-options="region:'north'" class="header">
	<img src="images/logo.png">
	<p>您好！<?php echo htmlspecialchars($_SESSION['admin']['username'], ENT_QUOTES, "UTF-8"); ?> |  <a href="#">修改密码</a> | <a href="<?php echo url(array('c'=>'admin/login', 'a'=>'outlogin', ));?>">退出</a></p>
</div>
<!-- /north区域 -->

<!-- west区域 -->
<div data-options="region:'west',iconCls:'',width:'150'" title="欢迎您登录！" class="Aside">
	<!-- 左侧center -->
	<div data-options="region:'center'" border="false">
		<div id="firstpane" class="menu_list">
			
			<p class="menu_head">资讯管理</p>
			<div class="menu_body">
				<a href="javascript:void(0)" onclick="addTab('资讯列表','<?php echo url(array('c'=>'admin/article', 'a'=>'list', ));?>')" >资讯列表</a>
				<a href="javascript:void(0)" onclick="addTab('新增资讯','<?php echo url(array('c'=>'admin/article', 'a'=>'add', ));?>')" >新增资讯</a>
			</div>

			<p class="menu_head">权限管理</p>
			<div class="menu_body">
				<a href="#" >角色管理</a>
				<a href="#" >管理员管理</a>
				<a href="#" >配置管理</a>
			</div>

		</div>
		<script type="text/javascript">
		$(function() {
			$("#firstpane .menu_body:eq(0)").show();
			$("#firstpane p.menu_head").click(function(){
				$(this).toggleClass("current");
				$(this).next(".menu_body").slideToggle();
			});
		});
		</script>
	</div>	
	<!-- /左侧center -->
</div>
<!-- /west区域 -->

<!-- center区域 -->
<div data-options="region:'center',bodyCls:'Section'">
	<div class="easyui-layout" fit="true">
		<!-- center -->
		<div data-options="region:'center'" style="padding:5px 5px 0;">
			<div id="index_tabs" class="easyui-tabs">
				<div title="医院管理" id="rgtiframe">
					
				</div>
			</div>
		</div>
		<!-- /center -->
	</div>
</div>
<!-- /center区域 -->


<div id='win' data-options="modal:true"></div>
<!-- <div id="choosewin">
	<iframe src="dialog/choose-supplier.html" frameborder="0" width="100%" height="99.4%"></iframe>
</div> -->

</body>
</html>