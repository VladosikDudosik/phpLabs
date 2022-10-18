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
    $data =  'SELECT data.id, operations.name, data.inputdata, data.outputdata FROM data join operations on data.operationid = operations.id';
    $result = $conn->query($data);
    if ($result->num_rows >0){
        while ($row = $result->fetch_assoc()){
            $tempArr[] = $row;
        }
    }
    $json = json_encode($tempArr,JSON_UNESCAPED_UNICODE);
    echo $json;
    $file = fopen('result.json','w');
    fwrite($file,$json);
    fclose($file);
?>