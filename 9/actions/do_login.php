<?php 
include($_SERVER['DOCUMENT_ROOT']."/phpLabs/9/lib/connect.php");
include($_SERVER['DOCUMENT_ROOT']."/phpLabs/9/lib/functions.php");
session_start();
$login = $_POST['login'];
$password = md5($_POST['password']);
$_SESSION['login'] = $_POST['login'];
$result = $conn->query("select login,password from users where login = '$login' and password = '$password'");
if($result->num_rows != 0){
    header('Location: ../index.php');
}else{
    $_SESSION['message'] = 'Неправильний логін або пароль';
    header('Location: login.php');
}
?>