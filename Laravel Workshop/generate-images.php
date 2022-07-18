<?php

// we will change in these lines 
$path = __DIR__ . "/skillshub/public/uploads/exams";
$ext = "png";
$start = 1;
$end = 80;



for($i = $start + 1; $i <=$end ; $i++){
    copy("$path/1.$ext", "$path/$i.$ext");
    echo "image $i.$ext generated successfully <br>";
}