<?php if(!class_exists("View", false)) exit("no direct access allowed");?><p></p>
<p>SQL查询query</p>
<p>代码：</p>
<pre>
$user = new User();
$uid = 3;
// 准备SQL，查询uid大于3的
$sql = "SELECT * FROM test_user WHERE uid > :uid";

// query第一个参数是SQL语句，第二个参数是绑定参数的列表
$this->findall = $user->query($sql, array(
	":uid" => $uid, // 注意这种绑定参数的做法，可以防止SQL注入
));
</pre>
<p>结果：多维数组</p>
<table class="table">
	<tr>
		<th>键</th>
		<th>值</th>
	</tr>
	<?php $_foreach_v_counter = 0; $_foreach_v_total = count($findall);?><?php foreach( $findall as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
	<tr>
		<td><?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?></td>
		<td>
			<table class="table">
				<?php $_foreach_vv_counter = 0; $_foreach_vv_total = count($v);?><?php foreach( $v as $vk => $vv ) : ?><?php $_foreach_vv_index = $_foreach_vv_counter;$_foreach_vv_iteration = $_foreach_vv_counter + 1;$_foreach_vv_first = ($_foreach_vv_counter == 0);$_foreach_vv_last = ($_foreach_vv_counter == $_foreach_vv_total - 1);$_foreach_vv_counter++;?>
				<tr>
					<td><?php echo htmlspecialchars($vk, ENT_QUOTES, "UTF-8"); ?></td>
					<td><?php echo htmlspecialchars($vv, ENT_QUOTES, "UTF-8"); ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<p>
	<a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">返回到main/index</a>
</p>