<?php 
include("../lib/connect.php");
session_start();
$login = $_POST['login'];
$password = md5($_POST['password']);
$result = $conn->query("select login,password from users where login = '$login' and password = '$password'");

if($result->num_rows != 0){
    $_SESSION['login'] = $_POST['login'];
    header('Location: ../index.php');
}else{
    $_SESSION['message'] = 'Неправильний логін або пароль';
    header('Location: ../pages/login.php');
}
?>