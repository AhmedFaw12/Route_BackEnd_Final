    <?php

    //check post is not empty

    if(!empty($_POST["name"]) && !empty($_POST["age"])){
        $name = $_POST["name"];
        $age = $_POST["age"];
        //creating file
        $file = fopen("users.csv", "a");
        fwrite($file, "$name,$age\n");//writing
        fclose($file);

        header("location:index.php");
    }else{
        header("location:index.php?error=empty");
    }