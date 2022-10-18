<?php 
include('classes.php');
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "phplab";

$conn = new mysqli($servername, $username, $password, $database);

$id = $conn->real_escape_string($_GET["id"]);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$selectAllOperations = 'SELECT * FROM operations';

$result = $conn->query($selectAllOperations);
    $operation_options = "";
    if ($result->num_rows >0){
        while ($row = $result->fetch_assoc()){
            if ($row['name'] == $_GET["operationName"] ){
                $operation_options.="<option value='".$row['id']."' selected>".$row['name']."</option>";
            }else{
                $operation_options.="<option value='".$row['id']."'>".$row['name']."</option>";
            }
            
        }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Редагування</title>
<meta charset="utf-8" />
</head>
<body>
<?php
$sql = 'SELECT data.id, operations.name, data.inputdata, data.outputdata FROM data join operations on data.operationid = operations.id';;
if($_SERVER['REQUEST_METHOD'] === 'GET' && $result = $conn->query($sql)){
    if($result->num_rows > 0){
        foreach($result as $row){
            $operationName = $row["name"];
            $inputdata = $row["inputdata"];
            $outputdata = $row["outputdata"];
        }
        echo "<h3>Редагування</h3>
            <form method='post'>
                <input type='hidden' name='id' value='$id' />
                <p>Операція:
                    <select name='optype'>$operation_options
                    </select>
                </p>
                <p>Вхідні дані:<br>
                <input type='text' name='inputdata' value='$inputdata' required/></p>
                <input type='submit' value='Зберегти'>
        </form>";
    }
    else{
        echo "<div>Помилка</div>";
    }
    $result->free();
}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
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
        header("Location: index.php");
    }else{
        echo "Помилка редагування <br>". $conn->error;
    }
}else{
    echo "Помилка: " . $conn->error;
}
?>