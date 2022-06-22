<pre>
<?php
    $region_id = 200;
    $region_name = "Alex";

    //open connection
    $pdo_cn = new PDO("mysql:host=localhost;port=3306;dbname=hr", "root", "");

    //preparing statements to prevent sql injection
   

    //using ?
    // $pdo_stm = $pdo_cn->prepare("insert into regions values(:id, :name)");

    // $pdo_stm->bindParam(1, $region_id, PDO::PARAM_INT);
    // $pdo_stm->bindParam(2, $region_name, PDO::PARAM_STR);

    //using :name
    $pdo_stm = $pdo_cn->prepare("select region_id id, region_name name from regions where region_id=:id");
    $pdo_stm->bindParam(":id", $region_id, PDO::PARAM_INT);
    $pdo_stm->execute();

    $region = $pdo_stm->fetchObject();
    var_dump($region->name);

    //close connection
    $pdo_cn = null;
?>
</pre>