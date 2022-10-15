<?php
    if(isset($_POST["id"])){
        $servername = "localhost";
        $username = "root";
        $password = "1234";
        $database = "phplab";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $ID = $conn->real_escape_string($_POST["id"]);
        $query = 'DELETE FROM data where id = '.$ID.';';
        if($conn->query($query)){
            header("Location: index.php");
        }else{
            echo "Помилка видалення <br>". $conn->error;
        }
        $conn->close();
    }
?>