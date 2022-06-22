<?php

// we want to connect to mysql database server 

/*
    - max number of connections in MySQL is 151 connections
    - max number of connections in MariaDb is 150 connections

    - there are multiple of databases servers php by default can deal with using built in functions :
    (
       - mysqli functions for mysql database
       - mssql for sql server 
       - pg for postgres
       - sqlite for sqlite
    )

    - php have functions for 5 or 6 databases

    -what about the rest of databases?
    there is a PDO class(php data object)
    
    - PDO CLASS can deal with 12 different databases

    - The MySQLi built in functions allows you to access MySQL database servers.

    - MySQLi has two types : function based and class based

    - MySQLi where (i) is improved
    ---------------------------------------------------------------------------
    - MySQLi functions:
      1)mysqli_connect($servername, $username, $password, $databasename, $portnumber) : opens a new connection to the MySQL server.
      -all parameters are optional:
         - host/servername : Optional. Specifies a host name or an IP address
         - portnumber :Optional. Specifies the port number to attempt to connect to the MySQL server (default of mysql is 3306)
      
      -return:
         - if connection is succeeded , it Returns an object representing the connection to the MySQL server.
         - if connection is failed , it return bool(false) , connection not created
      
      2)mysqli close($connection) : closes a previously opened database connection.

      3)mysqli_errno(connection) :returns the last error code for the most recent function call, if any.
      
      - if i made a wrong query , it will get the error number.

      - used when we perform a query and we want to check for error

      - return :Returns an error code value. Zero if no error occurred

      4)mysqli_error(connection): returns the last error description for the most recent function call, if any.
      
      - used when we perform a query and we want to check for error

      -Returns a string with the error description. "" if no error occurred
      
      5)mysqli_query(connection, query, resultmode) : performs a query against a database.

      -parameters:
       - connection , query : required
       - resultmode:Optional. A constant. Can be one of the following:
         --MYSQLI_USE_RESULT (Use this to retrieve large amount of data)
         --MYSQLI_STORE_RESULT (This is default). 

      -return :For successful SELECT, SHOW, DESCRIBE, or EXPLAIN queries it will return a mysqli_result object. For other successful queries it will return TRUE. FALSE on failure

      6)mysqli_affected_rows(connection):returns the number of affected rows in the previous SELECT, INSERT, UPDATE, REPLACE, or DELETE query.

      return :The number of rows affected. -1 indicates that the query returned an error

      7)mysqli_insert_id($cn): returns the id (generated with AUTO_INCREMENT) from the last query.

      return : An integer that represents the value of the AUTO_INCREMENT field updated by the last query. Returns zero if there were no update or no AUTO_INCREMENT field
 */


#example on mysqli_connect
$host_name = 'localhost';
$user_name = 'root';
$password = '';
$database_name = 'offline';
$port_number = '3306';

# open connection
$cn = mysqli_connect($host_name, $user_name, $password, $database_name, $port_number); 

// var_dump($cn);

// #example on mysqli_query
// $rslt = mysqli_query($cn, "insert into regions values(5, 'aaaa'), (6, 'ssss')");

############################################################
// #example on mysqli_affected_rows
// $rslt = mysqli_query($cn, "delete from hr.regions where region_id > 4;");


// var_dump($rslt);
// echo "<hr>";

// $rows = mysqli_affected_rows($cn);

// var_dump($rows);
// echo "<hr>";
#############################################################
#example on mysqli_insert_id()
// $rslt = mysqli_query($cn, "insert into brands(name, user_id) values('yyy', 1)");

// var_dump($rslt);
// echo "<hr>";


// $rows = mysqli_affected_rows($cn);

// var_dump($rows);
// echo "<hr>";

// $brand_id = mysqli_insert_id($cn);

// var_dump($brand_id);
// echo "<hr>";
#############################################################

// #check for error_no if exists
// var_dump(mysqli_errno($cn));

// echo '<hr>';

// #check for error description if exists
// var_dump(mysqli_error($cn));
##############################################################

#example on create database , drop
// $rslt = mysqli_query($cn, 'create schema xxx');

$rslt = mysqli_query($cn, 'drop schema xxx');
# close opened connection
mysqli_close($cn);

