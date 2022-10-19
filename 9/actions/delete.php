<?php
    include($_SERVER['DOCUMENT_ROOT']."/phpLabs/9/lib/connect.php");
    if(isset($_POST["id"])){
        $ID = $conn->real_escape_string($_POST["id"]);
        $query = 'DELETE FROM data where id = '.$ID.';';
        if($conn->query($query)){
            header('Location: /phpLabs/9/index.php');
        }else{
            echo "Помилка видалення <br>". $conn->error;
        }
        $conn->close();
    }
?>