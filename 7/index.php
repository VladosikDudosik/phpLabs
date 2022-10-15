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
    $selectAllOperations = 'SELECT * FROM operations';
    $selectAll = 'SELECT data.id, operations.name, data.inputdata, data.outputdata FROM data join operations on data.operationid = operations.id';
    $result = $conn->query($selectAll);
    $tableBody = '';

    if ($result->num_rows >0){
        while ($row = $result->fetch_assoc()){
            $tableBody .="<tr>
            <td>".$row['id']."</td>
            <td>".$row['name']."</td>
            <td>".$row['inputdata']."</td>
            <td>".$row['outputdata']."</td>
            <td>
                <form action='delete.php' method='post'>
                    <input type='hidden' name='id' value='" . $row["id"] . "' />
                    <input type='submit' value='Delete'>
                </form>
                <form action='edit.php'>
                    <input type='hidden' name='id' value='" . $row["id"] . "' />
                    <input type='hidden' name='operationName' value='" . $row["name"] . "' />
                    <input type='submit' value='Edit'>
                </form>
            </td>
            </tr>";
        }
    }
    $result = $conn->query($selectAllOperations);
    $operation_options = "";
    if ($result->num_rows >0){
        while ($row = $result->fetch_assoc()){
            $operation_options.="<option value='".$row['id']."'>".$row['name']."</option>";
        }
    }
    $conn->close();
?>
<html>
    <head>
        <title>Lab 7</title>
    </head>
    <style>
        body{
            /*background-color:bisque;*/
        }
        *{
            margin: 0;
            padding: 0;
        }
        table {
            font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
            font-size: 14px;
            border-collapse: collapse;
            text-align: center;
        }
        th, td:first-child {
            background: #AFCDE7;
            color: white;
            padding: 10px 20px;
        }
        th, td {
            border-style: solid;
            border-width: 0 1px 1px 0;
            border-color: white;
        }
        td {
            background: #D8E6F3;
        }
        th:first-child, td:first-child {
            text-align: left;
        }
        .main{
            display: flex;
            justify-content: space-between;
            width: 60%;
            margin:0 auto;
        }
        #addForm{
            width: max-content;
            padding: 40px;
            background-color:#D8E6F3 ;
            border-radius: 20px;
        }
        #addForm h2{
            text-align: center;
            margin-bottom:10px;
        }
        
        .form_wrapper{
            width: max-content;
        }
        #addForm input[name="opdata"]{
            width: 100%;
        }
        
        .formContainer{
            margin-top: 10px;
            border: black bold 1px;
        }
        #addForm input[type="submit"]{
            width: 100%;
            padding: 5px;
            font-size:16px;
            font-weight: bold;
        }
        #addForm input[type="submit"]:hover{
            background-color: white;
            cursor: pointer;
        }
        
    </style>
    <body>
        <h1 style="text-align:center;margin:20px;">Взаємодія з базою даних phpMyAdmin</h1>
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
                    <?php echo $tableBody; ?>
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