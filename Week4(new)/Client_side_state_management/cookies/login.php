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
            <div class="col-md-6 m-auto ">
                <form action="home.php" method="POST">
                    <!-- bootstrap form -->
                    <div class="form-group">
                        <label>Name</label>
                        <input type="name" name="name" class="form-control" placeholder="Enter you Name"
                        value = "<?php  if(!empty($_COOKIE["user_name"])) echo $_COOKIE["user_name"]?>"
                        aria-describedby="helpId">
                        <!-- <small id="helpId" class="text-muted">Help text</small> -->
                    </div>
                    <!-- bootstrap form -->
                    <div class="form-group">
                        <label>Age</label>
                        <input type="number" name="age" class="form-control" placeholder="Enter you Age" 
                        value = "<?php  if(!empty($_COOKIE["user_age"])) echo $_COOKIE["user_age"]?>"
                        aria-describedby="helpId">
                        <!-- <small id="helpId" class="text-muted">Help text</small> -->
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