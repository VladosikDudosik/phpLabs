<?php
session_start();
if (isset($_SESSION['login'])){
	header('Location: main.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Вхід</title>
	<meta charset="UTF-8" />
	<link href="../src/styles/login_form.css" rel="stylesheet" />
</head>

<body>
<h1>Авторизація</h1>
<form id="loginForm" action="../controllers/loginController.php" method="post">
	<div class="field">
		<label>Ім'я користувача:</label>
		<div class="input"><input type="text" name="login" value="" id="login" required/></div>
	</div>

	<div class="field">
		<label>Пароль:</label>
		<div class="input"><input type="password" name="password" value="" id="pass" required /></div>
	</div>

	<div class="submit">
		<button type="submit">Увійти</button>
	</div>
	<?php 
		if (isset($_SESSION['message'])){
			if(isset($_SESSION['green'])){
				echo '<p style="text-align:center;color:green;">'. $_SESSION['message'].'</p>';
				unset($_SESSION['message']);
			}else{
				echo '<p style="text-align:center;color:red;">'. $_SESSION['message'].'</p>';
				unset($_SESSION['message']);
			}
			
		}
	?>
</form>
<p class='signUp'>Не маєте аккаунта? - <a href="signup.php">Зареєструйтесь</a></p>


</body>
</html>