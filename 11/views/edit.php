<?php 
include('../models/database.php');

$id = $conn->real_escape_string($_GET["id"]);
$operation_options = $db->HTMLselectedOperation($_GET['operationName']);
echo $id;
$sql = 'SELECT data.id, operations.name, data.inputdata, data.outputdata FROM data join operations on data.operationid = operations.id';
$result = $conn->query($sql);
foreach($result as $row){
    $operationName = $row["name"];
    $inputdata = $row["inputdata"];
    $outputdata = $row["outputdata"];
}

?>
<!DOCTYPE html>
<html>
<head>
<title>Редагування</title>
<meta charset="utf-8" />
</head>
<body>
<h3>Редагування</h3>
    <form action='../controllers/editController.php' method='post'>
        <input type='hidden' name='id' value='<?=$id?>' />
        <p>Операція:<select name='optype'><?=$operation_options?></select></p>
        <p>Вхідні дані:<br>
        <input type='text' name='inputdata' value='<?=$inputdata?>' required/></p>
        <input type='submit' value='Зберегти'>
</form>