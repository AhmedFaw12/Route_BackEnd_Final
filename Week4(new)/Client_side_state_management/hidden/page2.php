<?php
//$_Request will only see the job and salary only and will not see name and age because home.php did not send them 

// home.php may send name and age using url or using input type = "hidden"
var_dump($_REQUEST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <div class="row m-5">
            <div class="col-md-12">
                <?php 
                    foreach($_POST as $item=> $value){
                        echo "<h2>$item : $value</h2>";
                    }
                ?>
            </div>
        </div>
    </div>
    
</body>
</html>