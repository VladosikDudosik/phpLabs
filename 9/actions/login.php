<?php
include($_SERVER['DOCUMENT_ROOT']."/phpLabs/9/lib/connect.php");
if(isset($_SESSION['log_in'])){
	header('Location: /phpLabs/9/index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Вхід</title>
	<meta charset="UTF-8" />
	<link href="../styles/login_form.css" rel="stylesheet" />
</head>

<body>

<form id="loginForm" action="do_login.php" method="post">
	<div class="field">
		<label>Ім'я користувача:</label>
		<div class="input"><input type="text" name="log_in" value="" id="login" required/></div>
	</div>

	<div class="field">
		<a href="#" id="forgot">Забули пароль?</a>
		<label>Пароль:</label>
		<div class="input"><input type="password" name="password" value="" id="pass" required /></div>
	</div>

	<div class="submit">
		<button type="submit">Войти</button>
		<label id="remember"><input name="" type="checkbox" value="" /> Запомнить меня</label>
	</div>

</form>

</body>
</html>