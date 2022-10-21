<?php
include("../models/classes.php");
include("../models/database.php");
    if(isset($_POST["opdata"])){

        $data = $conn->real_escape_string($_POST["opdata"]);
        $operationId = $conn->real_escape_string($_POST["optype"]);
        $arr = explode(" ",$data);
        $result = '';
        switch ($operationId){
            case 1:
                for($i = 0 ;$i < count($arr);$i++){
                    $gram = new Gram($arr[$i]);
                    $result.= $gram->ToKilogram(). ' ';
                }
                break;
            case 2:
                for($i = 0 ;$i < count($arr);$i++){
                    $pound = new Pound($arr[$i]);
                    $result.= $pound->ToKilogram(). ' ';
                }
                break;
            case 3:
                for($i = 0 ;$i < count($arr);$i++){
                    $food = new Food($arr[$i]);
                    $result.= $food->ToKilogram(). ' ';
                }
                break;
        }
        $query = "INSERT INTO data (inputdata,operationId,outputdata) VALUES('".$data. "',".$operationId.",'". $result."')";
        if($conn->query($query)){
            header("Location: ../views/main.php");
        }else{
            echo "Помилка добавлення <br>". $conn->error;
        }
        $conn->close();
    }
?>