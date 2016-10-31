<?php if(!class_exists("View", false)) exit("no direct access allowed");?><p></p>
<p>
	<?php if ($whoami) : ?>
		接收到参数$whoami：“<?php echo htmlspecialchars($whoami, ENT_QUOTES, "UTF-8"); ?>”。
	<?php elseif ($whoami == "yes") : ?>
		whoami = yes
	<?php else : ?>
		没有参数哦
	<?php endif; ?>
</p>
<p>
	本页面的模板是通过display()输出，其实如果模板名称是“控制器名_方法名.html”，那么也可以不写display()，只要有模板存在就自动输出了。
</p>
<p>
	<a href="<?php echo url(array('c'=>'main', 'a'=>'index', ));?>">返回到Default/index</a>
</p>