<?php 
/*
functions:
1)fwrite($file, string) :  writes to an open file.
*/

//example on overwrite 
// $file = fopen("emps.txt", "w");

// fwrite($file, "Hello I am Ahmed");
// fclose($file);


//example on appending 
$file = fopen("emps.txt", "a");

fwrite($file, "Hello I am Ahmed\n");
fclose($file);