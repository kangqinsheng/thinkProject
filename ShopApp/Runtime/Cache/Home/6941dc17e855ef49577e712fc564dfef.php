<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<link rel="stylesheet" href="/shop/Public/style.css" />
	<script type="text/javascript" src="/shop/Public/jquery-1.7.min.js"></script>
</head>
<body>
	<div class="lg-container">
		<h1>Register</h1>
		<form action="<?php echo U('register');?>" id="lg-form" name="lg-form" method="post">
			<div>
				<label for="username">Username:</label>
				<input type="text" name="username" id="username" placeholder="username"/>
			</div>
			
			<div>
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" placeholder="password" />
			</div>
			<div>				
				<button type="submit" id="login">注册</button>
				<a href="<?php echo U('login');?>">
					登陆
				</a>
			</div>	
		</form>
		<div id="message">
			<?php echo ($massage); ?>
		</div>
	</div>
</body>
</html>