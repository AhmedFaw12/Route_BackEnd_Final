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
        <div class="row m-5 border border-dark">
                <h2>Welcome <?php
                   echo $_REQUEST["name"] , " your Age is ", $_REQUEST["age"];
                ?></h2>

        </div>
        <a class="btn btn-primary mt-2" href="page2.php?user_name=<?=$_REQUEST["name"]?>&user_age=<?=$_REQUEST["age"]?>">NEXT</a>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>