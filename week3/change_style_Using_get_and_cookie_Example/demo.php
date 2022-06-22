<!DOCTYPE html>


<?php

    $s = "gray";
    if(isset($_GET["style_change"])){
        $s = $_GET["style_change"];
        setcookie("sCookie", $s, time()+60*60*24*30);
    }
    else if(isset($_COOKIE["sCookie"])){

        $s = $_COOKIE["sCookie"];
    }
?>
<html>

<head>
    <style>
        .dark {
            background-color: black;
            color: white;
        }

        .gray {
            background-color: gray;
            color: maroon;
        }

        .orange {
            background-color: peru;
            color: orangered;
        }
    </style>
</head>
<body class="<?=$s ?>">
    <h1>Change Style</h1>

    <form action="" method="GET">
        <select name="style_change" onchange="submit()">

            <option value="dark" <?php if($s =="dark") echo "selected"?> > dark</option>
            <option value="gray" <?php if($s =="gray") echo "selected"?> >gray</option>
            <option value="orange" <?php if($s =="orange") echo "selected"?> >orange</option>

        </select>
    </form>

</body>

</html>