<?php if(!class_exists("View", false)) exit("no direct access allowed");?><p></p>
<p>
<?php if ($newid) : ?>
插入一行数据，新增的uid是：<?php echo htmlspecialchars($newid, ENT_QUOTES, "UTF-8"); ?>
<?php else : ?>
插入数据失败！
<?php endif; ?>
</p>
<p>代码：</p>
<pre>
// 准备数据，一个“字段名”对应“值”的数组
$data = array(
	"username" => "user".mt_rand(2,100),
);
$user = new User();
// create返回的是最新插入的自增主键的值
$this->newid = $user->create($data);
</pre>
<?php include $_view_obj->compile("db/inner.html"); ?>
<p>
	<a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">返回到main/index</a>
</p>