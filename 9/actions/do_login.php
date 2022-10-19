<?php 
include($_SERVER['DOCUMENT_ROOT']."/phpLabs/9/lib/connect.php");
include($_SERVER['DOCUMENT_ROOT']."/phpLabs/9/lib/functions.php");
if (isset($_POST['log_in'])&& isset($_POST['password'])){
    $result = $conn->query("select login,password from users where login = '". $_POST['log_in']."'");
    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if ($row['password'] == md5($_POST['password'])){
            $_SESSION['login'] = $_POST['log_in'];
            header('Location: /phpLabs/9/index.php');
        }else{
            alert("Пароль введено неправильно!");
            sleep(5);
            header('Location: login.php',true,303);
        }
    }else{
        alert("Логін або пароль введені неправильно!");
        sleep(5);
        header('Location: login.php',true,303);
    }
}else{
    alert("Логін або пароль введені неправильно!");
    sleep(5);
    header('Location: login.php',true,303);
}
?>