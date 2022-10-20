<?php
include($_SERVER['DOCUMENT_ROOT']."/phpLabs/9/lib/connect.php");
session_start();
if (isset($_SESSION['login'])){
	header('Location: ../index.php');
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
		<div class="input"><input type="text" name="login" value="" id="login" required/></div>
	</div>

	<div class="field">
		<a href="#" id="forgot">Забули пароль?</a>
		<label>Пароль:</label>
		<div class="input"><input type="password" name="password" value="" id="pass" required /></div>
	</div>

	<div class="submit">
		<button type="submit">Войти</button>
		<label id="remember"><input name="" type="checkbox" value="" />Запам'ятати мене</label>
	</div>
	<?php 
		if (isset($_SESSION['message'])){
			echo '<p style="text-align:center;color:red;">'. $_SESSION['message'].'</p>';
			unset($_SESSION['message']);
		}
	?>
</form>


</body>
</html>