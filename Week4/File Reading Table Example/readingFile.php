<html>

<head>
    <title>Reading_CSV_file_in table</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/index_style.css" />
</head>

<body>


    <table class="table table-striped table-dark table-hover ">
        <thead >
            <tr>
                <th>#</th>
                <th>name</th>
                <th>salary</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $file = fopen("text.csv", "r");

            while ($line = fgets($file)) {

                $arr = explode(",", $line);
            ?>
                <tr>
                    <td scope="row"><?= $arr[0] ?></td>
                    <td><?= $arr[1] ?></td>
                    <td><?= $arr[2] ?></td>
                </tr>
            <?php
            }

            fclose($file);
            ?>

        </tbody>
    </table>


    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>

</body>

</html>