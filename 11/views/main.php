<?php
    include("../models/database.php");
    $tableBody = (new SQLserver)->HTMLTable();;
    $operation_options = (new SQLserver)->HTMLoperations();
?>
<html>
    <head>
        <title>Таблиці</title>
    </head>
    <link rel="stylesheet" href="../src/styles/table_styles.css">
    <body>
        <header>
            
            <h1>phpLabs</h1>
            <img src="../src/images/db.png" alt="db" width="30px">
            <nav>
                <a href='feedback.php'>Зворотній зв'язок</a>
                <a href='../controllers/exitController.php'>Вийти</a>
            </nav>
            
        </header>
        
        
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
                    <?= $tableBody; ?>
                </tbody>
            </table>
            <form method="POST" action="../controllers/insertController.php" id = 'addForm'>
                <div class="form_wrapper">
                    <h2>Додати в таблицю</h2>
                    <div class="formContainer">
                        <p>
                            <label for="optype">Оберіть операцію:</label>
                            <select name="optype">
                                <?= $operation_options; ?>
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