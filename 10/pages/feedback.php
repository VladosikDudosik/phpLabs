<?php
session_start();
if (!isset($_SESSION['login'])){
	header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Зворотній зв'язок</title>
	<meta charset="UTF-8" />
	<link href="../styles/login_form.css" rel="stylesheet" />
</head>

<body>

<h1>Зворотній зв'язок</h1>

<form id="loginForm" action="../actions/send_mail.php" method="post">
	<div class="field">
		<label>Ваше ім'я</label>
		<div class="input"><input type="text" name="name" value="" id="login" required/></div>
	</div>

	<div class="field">
		<label>Текст</label>
		<div class="input"><textarea  name="text" value="" id="text" required ></textarea></div>
	</div>

	<div class="submit">
		<button type="submit">Відправити</button>
	</div>
	<?php 
		if (isset($_SESSION['message'])){
			if($_SESSION['isSent']){
				echo "<p style='color:green;text-align:center;'><b>".$_SESSION['message']."</b></p>";
				unset($_SESSION['message']);
				unset($_SESSION['isSent']);
			}else{
				echo "<p style='color:red;text-align:center;'><b>".$_SESSION['message']."</b></p>";
				unset($_SESSION['message']);
				unset($_SESSION['isSent']);
			}
			
		}
	?>
</form>
<div style="margin:50px auto; text-align:center;" class="exit">
	<a  href="../actions/do_exit.php" >Вийти</a>
</div>


</body>
</html>