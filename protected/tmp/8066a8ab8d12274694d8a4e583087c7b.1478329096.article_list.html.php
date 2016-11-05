<?php if(!class_exists("View", false)) exit("no direct access allowed");?><?php include $_view_obj->compile("admin/header.html"); ?>
	<!-- article -->
	<div class="article">
		<div class="mt10 bgf clearfix">
		<form id="Loginform" action="<?php echo url(array('c'=>'admin/article', 'a'=>'list', ));?>" method="get">
			<div class="top-search clearfix">
				<p class="fl">
					共有 <font class="col-red"><?php echo htmlspecialchars($sum, ENT_QUOTES, "UTF-8"); ?></font> 篇文章
				</p>
				<select class="fl selectbox ml8" name="cateid">
					<option value="" selected="">选择栏目</option>
					<?php $_foreach_val_counter = 0; $_foreach_val_total = count($arrCate);?><?php foreach( $arrCate as $key => $val ) : ?><?php $_foreach_val_index = $_foreach_val_counter;$_foreach_val_iteration = $_foreach_val_counter + 1;$_foreach_val_first = ($_foreach_val_counter == 0);$_foreach_val_last = ($_foreach_val_counter == $_foreach_val_total - 1);$_foreach_val_counter++;?>
					<option value="<?php echo htmlspecialchars($val['cateid'], ENT_QUOTES, "UTF-8"); ?>" <?php if ($cateid == $val['cateid']) : ?> selected="" <?php endif; ?>><?php echo htmlspecialchars($val['catename'], ENT_QUOTES, "UTF-8"); ?></option>
					<?php endforeach; ?>
				</select>
				<input type="text" value="<?php echo htmlspecialchars($keyword, ENT_QUOTES, "UTF-8"); ?>" name="keyword" value="文章标题关键字" class="fl inputs w170 ml8">
				
				<input type="submit" name="submit" value="" class="fl icon search-btn ml8">
				<a href="javascript:void(0)" class="fl icon addbtn ml8" onclick="openTrack('<?php echo url(array('c'=>'admin/article', 'a'=>'add', ));?>')">添加</a>
				<a href="#" class="fl icon delbtn ml8">删除</a>
			</div>
			</form>
            <div class="main">
            	<div class="pad10">
                	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table trhover table-c">
                		<thead>
							<tr>
								<th width="4%"><input type="checkbox" name="" value="" id="CheckedAll"></th>
								<th width="5%">ID</th>
								<th width="19%">文章标题</th>
								<th width="8%">栏目</th>
								<th width="8%">点击/评论</th>
								<th width="12%">发布时间</th>
								<th width="9%">发布人</th>
								<th width="10%">操作</th>
							</tr>
						</thead>
						<tbody>
							<?php $_foreach_val_counter = 0; $_foreach_val_total = count($arrArticle);?><?php foreach( $arrArticle as $key => $val ) : ?><?php $_foreach_val_index = $_foreach_val_counter;$_foreach_val_iteration = $_foreach_val_counter + 1;$_foreach_val_first = ($_foreach_val_counter == 0);$_foreach_val_last = ($_foreach_val_counter == $_foreach_val_total - 1);$_foreach_val_counter++;?>
							<tr>
								<td><input type="checkbox" name="h-list" value="<?php echo htmlspecialchars($val['articleid'], ENT_QUOTES, "UTF-8"); ?>"></td>
								<td><?php echo htmlspecialchars($val['articleid'], ENT_QUOTES, "UTF-8"); ?></td>
								<td><?php echo htmlspecialchars($val['title'], ENT_QUOTES, "UTF-8"); ?></td>
								<td><?php echo htmlspecialchars($val['catename'], ENT_QUOTES, "UTF-8"); ?></td>
								<td><?php echo htmlspecialchars($val['count_view'], ENT_QUOTES, "UTF-8"); ?> / <?php echo htmlspecialchars($val['count_comment'], ENT_QUOTES, "UTF-8"); ?></td>
								<td><?php echo htmlspecialchars($val['addtime'], ENT_QUOTES, "UTF-8"); ?></td>
								<td><?php echo htmlspecialchars($val['user']['username'], ENT_QUOTES, "UTF-8"); ?></td>
								<td>
								<a href="<?php echo url(array('c'=>'admin/article', 'a'=>'add', 'aid'=>$val['articleid'], ));?>" class="del-hoslist">修改</a>
								<a href="javascript:void(0);" class="del-hoslist" onclick="artconfirms();">删除</a></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
						<tfoot>
							<tr>
								<th colspan="12">
									<div class="fl pageleft">
										共有
										<font color="#FF0000">9217</font>
										条记录
									</div>
									<div class="fr pagergt">
										<?php echo html_entity_decode($pager);?>
									</div>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
            </div>
		</div>
	</div>
	<!-- /article -->
	<script>
	function openTrack(url) { //头部添加资讯
		var TopTab=window.parent.$('#index_tabs')
		TopTab.tabs('close','新增资讯');
	    TopTab.tabs('add',{title:'新增资讯',content:'<iframe scrolling="auto" frameborder="0"  src='+url+' style="width:100%;height:99.2%;"></iframe>',closable:true });
	}
	function artconfirms() {  //删除文章
	    top.$.messager.confirm('提示','确定要删除文章？',function(r){    
		    if (r){    
		        alert('确认删除');    
		    }    
		});
	} 
</script>
</body>
</html>

