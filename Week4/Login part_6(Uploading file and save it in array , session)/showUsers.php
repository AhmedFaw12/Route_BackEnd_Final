<html>

<head>
    <title>Readi_in table</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/index_style.css?v=<?php echo time(); ?>" />
</head>

<body>
    <table class="table table-striped table-dark table-hover ">
        <thead >
            <tr>
                <th>#</th>
                <th>email</th>
                <th>name</th>
                <th>images</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $file = fopen("users.csv", "r");
            $i = 1;
            while ($line = fgets($file)) {

                $arr = explode(",", $line);
            ?>
                <tr>
                    <td scope="row"><?= $i++ ?></td>
                    <td><?= $arr[0] ?></td>
                    <td><?= $arr[1] ?></td>
                    <td ><img id="" src=<?= $arr[3] ?> class="setWidth" alt=""></td>
                </tr>
            <?php
            }

            fclose($file);
            ?>

        </tbody>
    </table>


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>