<?php
    $servername = "localhost";
    $username = "root";
    $password = "1234";
    $database = "phplab";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $tempArr = array();
    $selectAllOperations = 'SELECT * FROM operations';
    $data =  'SELECT data.id, operations.name, data.inputdata, data.outputdata FROM data join operations on data.operationid = operations.id';
    $result = $conn->query($data);
    if ($result->num_rows >0){
        while ($row = $result->fetch_assoc()){
            $tempArr[] = $row;
        }
    }
    $json = json_encode($tempArr,JSON_UNESCAPED_UNICODE);
    //echo $json;
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
<div class="main">
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
        <tbody>

        </tbody>
    </table>
    <form method="POST" action="insert.php" id = 'addForm'>
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
</div>
    
</body>
</html>