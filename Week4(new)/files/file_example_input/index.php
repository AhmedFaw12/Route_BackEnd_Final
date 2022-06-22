<?php
/*
    explanation: i want to take input from user(index.php) and write it in a file(from demo_wr.php) then displaying the file in a table(in index.php)
*/
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
                <form action="demo_wr.php" method="POST">
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

        <div class="row">
            <div class="col">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Age</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php
                            if(file_exists("users.csv")){
                                $file = fopen("users.csv", "r");
                                $cnt = 1;
                                while($line = fgets($file)){
                                    $arr = explode(",", $line);
                                    echo " 
                                    <tr>
                                        <td>", $cnt++,"</td>
                                        <td>$arr[0]</td>
                                        <td>$arr[1]</td>
                                    </tr>";
                                }
                                fclose($file);
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>