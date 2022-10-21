<?php
include('../models/database.php');
    if(isset($_POST["id"])){

        $ID = $conn->real_escape_string($_POST["id"]);
        $query = 'DELETE FROM data where id = '.$ID.';';
        if($conn->query($query)){
            header("Location: ../views/main.php");
        }else{
            echo "Помилка видалення <br>". $conn->error;
        }
        $conn->close();
    }
?>