<?php 
$config = json_decode(file_get_contents("../config.json"))->sql_config;
$servername = $config->servename;
$username = $config->username;
$password = $config->password;
$database = $config->database;
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>