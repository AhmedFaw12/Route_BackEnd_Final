<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <title>login</title>
</head>

<body>
    <div class="container">
        <div class="row m-5 border">
            <!-- displaying error if exists -->
            <?php
            if(!empty($_GET["error"]) && $_GET["error"] == "empty") {
                header("refresh:2; url=login.php"); //removing error_msg after 2 seconds by refreshing page
            ?> 
                <div class="alert alert-danger col-md-12" role="alert">
                    <strong>please enter your Name and Password</strong>
                </div>
                
            <?php
            }
            ?>
            <div class="col-md-6">
                <form action="home.php" method="POST">
                    <!-- bootstrap form -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="name" name="name" class="form-control" placeholder="Enter you Name" aria-describedby="helpId">
                    </div>
                    <!-- bootstrap form -->
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" class="form-control" placeholder="Enter you Age" aria-describedby="helpId">
                     
                    </div>
                    <input class="btn btn-primary" type="submit" value="Next">
                </form>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>