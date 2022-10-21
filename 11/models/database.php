<?php 
class SQLserver
{
    public $conn;
    function __construct()
    {
        $config = json_decode(file_get_contents("../package.json"))->sql_config;
        $servername = $config->servername;
        $username = $config->username;
        $password = $config->password;
        $database = $config->database;
        $this->conn = new mysqli($servername, $username, $password, $database);
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    function HTMLTable()
    {
        $selectAll = 'SELECT data.id, operations.name, data.inputdata, data.outputdata FROM data join operations on data.operationid = operations.id';
        $result = $this->conn->query($selectAll);
        $tableBody = '';

        if ($result->num_rows >0){
            while ($row = $result->fetch_assoc()){
                $tableBody .="<tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['inputdata']."</td>
                <td>".$row['outputdata']."</td>
                <td>
                    <form action='../controllers/deleteController.php' method='post'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='submit' style='width:100%;' value='Delete'>
                    </form>
                    <form action='../views/edit.php'>
                        <input type='hidden' name='id' value='" . $row["id"] . "' />
                        <input type='hidden' name='operationName' value='" . $row["name"] . "' />
                        <input type='submit' style='width:100%;' value='Edit'>
                    </form>
                </td>
                </tr>";
            }
        }
        return $tableBody;
    }
    function HTMLoperations()
    {
        $selectAllOperations = 'SELECT * FROM operations';
        $result = $this->conn->query($selectAllOperations);
        $operation_options = "";
        if ($result->num_rows >0){
            while ($row = $result->fetch_assoc()){
                $operation_options.="<option value='".$row['id']."'>".$row['name']."</option>";
            }
        }
        return $operation_options;
    }
    function HTMLselectedOperation($name)
    {
        $selectAllOperations = 'SELECT * FROM operations';

        $result = $this->conn->query($selectAllOperations);
            $operation_options = "";
            if ($result->num_rows >0){
                while ($row = $result->fetch_assoc()){
                    if ($row['name'] == $name ){
                        $operation_options.="<option value='".$row['id']."' selected>".$row['name']."</option>";
                    }else{
                        $operation_options.="<option value='".$row['id']."'>".$row['name']."</option>";
                    }
                    
                }
        }
        return $operation_options;
    }
}
$conn = (new SQLserver())->conn;
$db = new SQLserver();
?>