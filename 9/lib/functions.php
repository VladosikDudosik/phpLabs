<?php
function alert($message){
	echo "<script type='text/javascript'>alert('".$message."');</script>";
}
function jsonToTable($json){
    $res = '';
    for($i = 0 ; $i < count($json); $i++){
        $res.= "<tr>
        <td>".$json[$i]->id."</td>
        <td>".$json[$i]->name."</td>                                
        <td>".$json[$i]->inputdata."</td>
        <td>".$json[$i]->outputdata."</td>
        <td>
            <form action='action/delete.php' method='post'>
                <input type='hidden' name='id' value='".$json[$i]->id."' />
                <input type='submit' value='Delete'>
            </form>
            <form action='action/edit.php'>
                <input type='hidden' name='id' value='".$json[$i]->id."' />
                <input type='hidden' name='operationName' value='".$json[$i]->name."' />
                <input type='submit' value='Edit'>
            </form>
        </td>
        </tr>";
    }
    return $res;
}
?>