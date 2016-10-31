<?php if(!class_exists("View", false)) exit("no direct access allowed");?><p>数据表</p>
<table class="table">
<?php $_foreach_v_counter = 0; $_foreach_v_total = count($findall);?><?php foreach( $findall as $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
	<tr>
		<td><?php echo htmlspecialchars($v['uid'], ENT_QUOTES, "UTF-8"); ?></td>
		<td><?php echo htmlspecialchars($v['username'], ENT_QUOTES, "UTF-8"); ?></td>
	</tr>
<?php endforeach; ?>
</table>