<?php 
include('../models/classes.php');
include('../models/database.php');
$sql = 'SELECT data.id, operations.name, data.inputdata, data.outputdata FROM data join operations on data.operationid = operations.id';;
$id = $_POST['id'];
$operationId = $_POST['optype'];
$inputdata = $_POST['inputdata'];
$arr = explode(" ",$inputdata);
$result = "";
switch ($operationId){
    case 1:
        for ($i = 0 ; $i < count($arr); $i++){
            $gram = new Gram($arr[$i]);
            $result .= $gram->ToKilogram() . ' ';
        }
        
        break;
    case 2:
        for ($i = 0 ; $i < count($arr); $i++){
            $pound = new Pound($arr[$i]);
            $result .= $pound->ToKilogram() . ' ';
        }
        break;
    case 3:
        for ($i = 0 ; $i < count($arr); $i++){
            $food = new Food($arr[$i]);
            $result .= $food->ToKilogram() . ' ';
        }
        break;
}
$query = "UPDATE data SET  operationid = $operationId, inputdata = '$inputdata', outputdata ='$result' where id = $id";

if($conn->query($query)){
    header("Location: ../views/main.php");
}else{
    echo "Помилка редагування <br>". $conn->error;
}

?>