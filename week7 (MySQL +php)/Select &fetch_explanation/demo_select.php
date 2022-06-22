<?php
/*
    mysqli functions:
    8) mysqli_fetch_row(result) function :fetches one row from a result-set and returns it as an enumerated(indexed) array.
    -parameter:
     -result : Required. Specifies a result set identifier returned by mysqli_query().

    return : Returns an array of strings that corresponds to the fetched row. NULL if there are no more rows in result set

    9) mysqli_fetch_assoc(result) function fetches a result row as an associative array.

    -Note: Fieldnames returned from this function are case-sensitive. so either :
        -write column names not (*) in select 
        -write alias
        then use the name you write

    -parameter:
     -result : Required. Specifies a result set identifier returned by mysqli_query().

    -return : Returns an associative array of strings representing the fetched row. NULL if there are no more rows in result-set


    10) mysqli_fetch_all(result, resulttype) : fetches all result rows and returns the result-set as an associative array, a numeric array, or both.

    parameters :
    -result:	Required. Specifies a result set identifier returned by mysqli_query(), mysqli_store_result() or mysqli_use_result()
    
    -resulttype :Optional. Specifies what type of array that should be produced. Can be one of the following values:
        MYSQLI_ASSOC
        MYSQLI_NUM (this is default)
        MYSQLI_BOTH
*/

#example on mysqli_connect
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database_name = 'hr';
$port_number = '3306';

# open connection
$cn = mysqli_connect($host_name, $user_name, $password, $database_name, $port_number); 


#example on mysqli_fetch_row()
$sql = "SELECT * from regions";

/*
returns in case of select:
["current_field"] => int(0) : not pointing to the first row yet
[field_count"]=> int(2) : no of columns (id, name)
["num_rows"] => int(4) : has 4 records
  
*/
$rslt = mysqli_query($cn, $sql); 
// var_dump($rslt);

while($row = mysqli_fetch_row($rslt)){
    echo $row[0] , " - ",  $row[1], "<br>";
}


/* 
    notes on fetch:
    -if i write the while loop again , it will not print any result as i read all of the data
    - so if i want to read again , i have to write the query again

*/
echo  "<hr>";
#example on mysqli_fetch_assoc()
#we wrote column names as fetch_assoc is case sensitive
$sql = "SELECT region_name, region_id as id from regions";
$rslt = mysqli_query($cn, $sql); 

while($row = mysqli_fetch_assoc($rslt)){
    echo $row["id"] , " - ",  $row["region_name"], "<br>";
}

echo  "<hr>";


#example on mysqli_fetch_all()
#get all rows , we can then read from array
$sql = "SELECT region_name, region_id as id from regions";
$rslt = mysqli_query($cn, $sql);
$arr  = mysqli_fetch_all($rslt , MYSQLI_ASSOC);// return as associative array
foreach($arr as $row){
    echo $row["id"] , " - ",  $row["region_name"], "<br>";
}

echo  "<hr>";

mysqli_close($cn);