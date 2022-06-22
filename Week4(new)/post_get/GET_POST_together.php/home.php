<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>home</title>
</head>

<body>
    <div class="container">
        <div class="row m-5 ">
                <h2>
                    Welcome
                    <?php 
                    echo "<hr>";
                    var_dump($_GET);
                    echo "<hr>";
                
                    var_dump($_POST);
                    echo "<hr>";

                    var_dump($_REQUEST);
                    echo "<hr>";

                    ?>
               </h2> 
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>