<?php
require '../models/PHPMailer.php';
require '../models/SMTP.php';
require '../models/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
session_start();
$name = $_POST['name'];
$text = $_POST['text'];

$config = json_decode(file_get_contents("../package.json"))->mail_config;

$mail = new PHPMailer();
$mail->isSMTP();
$mail->CharSet = 'UTF-8';
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = 'true';
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;
$mail->Username   = $config->mail;
$mail->Password   = $config->password;
$mail->Subject = $name;
$mail->setFrom($config->mail);
$mail->Body = $text;
$mail->addAddress("vladyslav.dutchak-ki202@nung.edu.ua");

if($mail->Send()){
    $_SESSION['message'] = 'Повідомлення успішно відправлено';
    $_SESSION['isSent'] = true;
}else{
    $_SESSION['isSent'] = false;
    $_SESSION['message'] = 'Чомусь повідомлення не змогло відправитись :(';
}
header('Location: ../views/feedback.php');
?>