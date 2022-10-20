<?php 
include($_SERVER['DOCUMENT_ROOT']."/phpLabs/9/lib/connect.php");
include($_SERVER['DOCUMENT_ROOT']."/phpLabs/9/lib/functions.php");
session_start();
$login = $_POST['log_in'];
$password = $_POST['password'];
$_SESSION['log_in'] = $_POST['log_in'];
$_SESSION['password'] = $_POST['password'];
$result = $conn->query("select login,password from users where login = '$login' and password = $password");
if($result->num_rows != 0){
    header('Location: ../index.php');
}else{
    $_SESSION['message'] = 'Неправильний логін або пароль';
    header('Location: login.php');
}
?>