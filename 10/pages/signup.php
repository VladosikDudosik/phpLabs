<?php
session_start();
if (isset($_SESSION['login'])){
	header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Реєстрація</title>
	<meta charset="UTF-8" />
	<link href="../styles/login_form.css" rel="stylesheet" />
</head>

<body>
<h1>Реєстрація</h1>
<form id="loginForm" action="../actions/do_signup.php" method="post">
	<div class="field">
		<label>Ім'я користувача:</label>
		<div class="input"><input type="text" name="login" value="" id="login" required/></div>
	</div>

	<div class="field">
		<label>Пароль:</label>
		<div class="input"><input type="password" name="password" value="" id="pass" required /></div>
	</div>
    <div class="field">
		<label>Підтвердіть пароль:</label>
		<div class="input"><input type="password" name="confirm_password" value="" id="pass" required /></div>
	</div>

	<div class="submit">
		<button type="submit">Зареєструватись</button>
	</div>
	<?php 
		if (isset($_SESSION['message'])){
			echo '<p style="text-align:center;color:red;">'. $_SESSION['message'].'</p>';
			unset($_SESSION['message']);
		}
	?>
</form>
<p class='signUp'>Маєте аккаунт? - <a href="login.php">Авторизуйтесь</a></p>


</body>
</html>