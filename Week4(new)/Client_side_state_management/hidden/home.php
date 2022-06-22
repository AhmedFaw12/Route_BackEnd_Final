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
                        echo $_REQUEST["name"], " your Age is ", $_REQUEST["age"];
                        ?></h2>

        </div>
        <div class="col-md-6 m-auto ">
            <form action="page2.php" method="POST">
                <input type="hidden" name="name" value="<?=$_REQUEST["name"]?>">

                <input type="hidden" name="age" value="<?=$_REQUEST["age"]?>">
                <!-- bootstrap form -->
                <div class="form-group">
                    <label>Job</label>
                    <input type="text" name="job" class="form-control" placeholder="Enter you JOB" aria-describedby="helpId">
                    <!-- <small id="helpId" class="text-muted">Help text</small> -->
                </div>
                <!-- bootstrap form -->
                <div class="form-group">
                    <label>Salary</label>
                    <input type="number" name="salary" class="form-control" placeholder="Enter you Salary" aria-describedby="helpId">
                    <!-- <small id="helpId" class="text-muted">Help text</small> -->
                </div>
                <input class="btn btn-primary" type="submit" value="Next">
            </form>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>