<?php

    $x = $_GET['n1'];
    $y = $_GET['n2'];
?>


<html>
    <body>
        <form action="final.php" method="POST">
            <input type="hidden" name="a" value="<?= $_GET['n1']?>">
            <input type="hidden" name="b" value="<?= $_GET['n2']?>">
            <input type="submit" value="show Result">
            
        </form>
    </body>
</html>