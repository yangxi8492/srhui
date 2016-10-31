<?php if(!class_exists("View", false)) exit("no direct access allowed");?><p></p>
<p>使用SQL语句删除数据，影响行数是：<?php echo htmlspecialchars($result, ENT_QUOTES, "UTF-8"); ?></p>
<p>代码：</p>
<pre>
$user = new User();
$username = "whoami";
// 准备SQL，要删除username是“whoami”的家伙
$sql = "DELETE * FROM test_user WHERE username = :username";

// 同query，execute第一个参数是SQL语句，第二个参数是绑定参数的列表
$this->result = $user->execute($sql, array(
		":username" => $username, // 注意这种绑定参数的做法，可以防止SQL注入
));
// execute返回参数和create等相同，即是影响行数，为0则证明没有做任何的修改
</pre>
<?php include $_view_obj->compile("db/inner.html"); ?>
<p>
	<a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">返回到main/index</a>
</p>