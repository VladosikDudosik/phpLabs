<?php 
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "phplab";

$conn = new mysqli($servername, $username, $password, $database);

$id = $conn->real_escape_string($_POST["id"]);
if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}
$selectAllOperations = 'SELECT * FROM operations';

$result = $conn->query($selectAllOperations);
    $operation_options = "";
    if ($result->num_rows >0){
        while ($row = $result->fetch_assoc()){
            if ($row['name'] == $_POST["operationName"] ){
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
if( $result = $conn->query($sql)){
    if($result->num_rows > 0){
        foreach($result as $row){
            $operationName = $row["name"];
            $inputdata = $row["inputdata"];
            $outputdata = $row["outputdata"];
        }
        echo "<h3>Редагування</h3>
            <form method='post'>
                <input type='hidden' name='id' value='$id' />
                <p>Операція: $operationName
                    <select name='optype'>$operation_options
                    </select>
                </p>
                <p>Вхідні дані:<br>
                <input type='text' name='inputdata' value='$inputdata' /></p>
                <input type='submit' value='Зберегти'>
        </form>";
    }
    else{
        echo "<div>Помилка</div>";
    }
    $result->free();
}else{
    echo "Помилка: " . $conn->error;
}
?>