<?php if(!class_exists("View", false)) exit("no direct access allowed");?><p></p>
<p>SQL查找query</p>
<p>代码：</p>
<pre>
$user = new User();
// 先查一条，uid为2的
$this->findone = $user->find(array("uid"=>"2"));

// 查全部，用findAll
// findAll( $conditions=array(), $order=null, $field='*',  $limit=null )
// findAll参数：$conditions数组形式的条件（同find），$field指定字段（默认是*），
// $order是排序（如 “uid DESC”）, $limit是限定条数（如“3,5”，第三条开始取五条）
$this->findall = $user->findAll();
</pre>
<p>结果(find)：一位数组</p>
<?php if (!empty($findone)) : ?>
<table class="table">
	<tr>
		<th>键</th>
		<th>值</th>
	</tr>
		<?php $_foreach_v_counter = 0; $_foreach_v_total = count($findone);?><?php foreach( $findone as $k => $v ) : ?><?php $_foreach_v_index = $_foreach_v_counter;$_foreach_v_iteration = $_foreach_v_counter + 1;$_foreach_v_first = ($_foreach_v_counter == 0);$_foreach_v_last = ($_foreach_v_counter == $_foreach_v_total - 1);$_foreach_v_counter++;?>
		<tr>
			<td><?php echo htmlspecialchars($k, ENT_QUOTES, "UTF-8"); ?></td>
			<td><?php echo htmlspecialchars($v, ENT_QUOTES, "UTF-8"); ?></td>
		</tr>
		<?php endforeach; ?>
</table>
<?php else : ?>
<p>没有结果！</p>
<?php endif; ?>
<p>结果(findAll)：多维数组</p>
<?php if (!empty($findall)) : ?>
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
<?php else : ?>
<p>没有结果！</p>
<?php endif; ?>
<p>
	<a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">返回到main/index</a>
</p>