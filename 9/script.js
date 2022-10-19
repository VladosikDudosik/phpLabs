$(document).ready(function(){
    let link = "result.json"
    $.get(link,function(data){
        for ( let i = 0 ; i < data.length; i++){
            $(".jstable").append(`<tr>
            <td>${data[i]['id']}</td>
            <td>${data[i]['name']}</td>                                
            <td>${data[i]['inputdata']}</td>
            <td>${data[i]['outputdata']}</td>
            <td>
                <form action='actions/delete.php' method='post'>
                    <input type='hidden' name='id' value='${data[i]['id']}' />
                    <input type='submit' value='Delete'>
                </form>
                <form action='actions/edit.php'>
                    <input type='hidden' name='id' value='${data[i]['id']}' />
                    <input type='hidden' name='operationName' value='${data[i]['name']}' />
                    <input type='submit' value='Edit'>
                </form>
            </td>
            </tr>`)
        }
    })
})
