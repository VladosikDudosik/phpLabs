<?php
include('../lib/connect.php');
session_start();
$login = $_POST['login'];
$password = md5($_POST['password']);
$confirm_password = md5($_POST['confirm_password']);

$query = "SELECT login FROM users where login = '$login'";
$result = $conn->query($query);
if ($result->num_rows == 0){
    if($password == $confirm_password){
        $query = "INSERT INTO users (login,password) VALUES ('$login','$password')";
        $conn->query($query);
        $_SESSION['message'] = 'Ви успішно зареєструвались';
        $_SESSION['green'] = true;
        header('Location: ../pages/login.php');
    }else{
        $_SESSION['message'] = 'Паролі не співпадають';
        header('Location: ../pages/signup.php');
    }
}else{
    $_SESSION['message'] = 'Такий логін уже існує';
    header('Location: ../pages/signup.php');
}
?>