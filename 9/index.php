<?php  
include('lib/connect.php');
include('lib/functions.php');
if(!isset($_SESSION['login'])){
    header("Location: actions/login.php");
}
    $selectAllOperations = 'SELECT * FROM operations';
    $dataQuery =  'SELECT data.id, operations.name, data.inputdata, data.outputdata FROM data join operations on data.operationid = operations.id';
    
    $tempArr = array();
    $result = $conn->query($dataQuery);
    if ($result->num_rows >0){
        while ($row = $result->fetch_assoc()){
            $tempArr[] = $row;
        }
    }
    $json = json_encode($tempArr,JSON_UNESCAPED_UNICODE);
    $file = fopen('result.json','w');
    fwrite($file,$json);
    fclose($file);
    
    $result = $conn->query($selectAllOperations);
    $operation_options = "";
    if ($result->num_rows >0){
        while ($row = $result->fetch_assoc()){
            $operation_options.="<option value='".$row['id']."'>".$row['name']."</option>";
        }
    }
    $conn->close();

    $ch = curl_init("http://localhost/phpLabs/9/result.json");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $curlResult =json_decode(curl_exec($ch));
    curl_close($ch);
    $curlTable = jsonToTable($curlResult);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<h1 style="text-align:center;margin:20px;">phpLabs</h1>

    <form method="POST" action="actions/insert.php" id = 'addForm'>
        <div class="form_wrapper">
            <h2>Додати в таблицю</h2>
            <div class="formContainer">
                <p>
                    <label for="optype">Оберіть операцію:</label>
                    <select name="optype">
                        <?php echo $operation_options; ?>
                    </select>
                </p>
            </div>
            <div class="formContainer">
                <p>
                    <label for="opdata">Введіть массив даних через пробіл:</label>
                </p>
                <p>
                    <input type="text" name="opdata" required>
                </p>
            </div>
            <div class="formContainer">
                <p>
                    <input type="submit" value="Додати">
                </p>
            </div>
            
        </div>
        
    </form>
<div class="main">
    <div class="tableBlock">
        <h2 style="text-align:center;">JavaScript table</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Operation</th>
                    <th>Input</th>
                    <th>Output</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class = "jstable">

            </tbody>
        </table>
    </div>

    
    <div class="tableBlock">
        <h2 style="text-align: center;">CURL Table</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Operation</th>
                    <th>Input</th>
                    <th>Output</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id = 'curltable'>
                <?php echo $curlTable?>
            </tbody>
        </table>
    </div>
    
</div>

</body>
</html>

?>