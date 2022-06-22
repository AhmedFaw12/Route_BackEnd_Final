<?php

/*
error types :
1) syntax error: like missing ; or misspellings ->compiler check for syntex error , in php the interpreter check for the syntex (code will work normally until it finds syntax error), so we will not handle syntax errors

2)runtime errors : 
                  -like access non existing element in array(warning)
                  
                  -calling a function without definition(fatal error)

                  -reading or writing to file that does not exists (warning error)

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
-->we can make all errors or certain errors not appear or to stop being displayed:
    -using php.ini : 
        -configuration file of php on the web server 
        -from xampp , open config , php.ini
        
        -in php.ini : semicolon(;) means comment

        -php.ini : contain constants(each constant represent number) that represents categorized errors:
            1)E_ALL: All errors and warnings
            2)E_ERROR :fatal run-time errors
            3)E_WARNING :run-time warnings (non-fatal errors)
            4)E_PARSE : compile-time syntax errors
            5)E_NOTICE :run-time notices (these are warnings which often result from a bug in your code, but it's possible that it was intentional (e.g.,using an uninitialized variable and relying on the fact it is automatically initialized to an empty string)
            6)E_DEPRECATED :warn about code that will not work in future versions of PHP
            7)E_USER_ERROR :Fatal user-generated error. This is like an E_ERROR set by the programmer using the PHP function trigger_error()
            8)E_USER_WARNING:Non-fatal user-generated warning. This is like an E_WARNING set by the programmer using the PHP function trigger_error()
            9)E_USER_NOTICE: User-generated notice. This is like an E_NOTICE set by the programmer using the PHP function trigger_error()
        
        -in php.ini : 
            -Development Value(writing code phase) : E_ALL (show all errors).

            -Production Value(launching project): E_ALL & ~E_DEPRECATED & ~E_STRICT()

        -in php.ini :
            -error_reporting : php contain environment variable that Sets which PHP errors are reported
            
            -by default : error_reporting=E_ALL & ~E_DEPRECATED & ~E_STRICT

            -if we want to hide warning errors ,then add it to error_reporting , then save then stop server , then start the server again
                example:
                 error_reporting=E_ALL & ~E_DEPRECATED & ~E_STRICT & ~E_WARNING


        -in php.ini : 
            -display_errors :  php contain environment variable that display errors 
            -by default : display_errors=On

            -if we don't want to display any errors then set 
            display_errors=Off ,then save then stop server , then start the server again 

            - if we set display_errors=Off, and there were fatal errors , the web page will not work
             
        -in php.ini :
            -log_errors : php can also log(save) errors to a file on the server
            
            - by default : log_errors=On
            - by default , web server contain log file 
            - in xampp , log file is in xampp/apache/logs/error.log

            -if we made display_errors=Off , but we enable log_errors=On, then errors will be logged in the log file 


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


-->Error_Handling : 

    -we don't want to hide errors , but we want to handle errors

    -Error_Handling is the process of catching errors raised by your program and then taking appropriate action

    we have two ways to handle errors:
    -function_based handling
    -class_based handling

-->function_based error handling:
    -->Creating a Custom Error Handler:
        
        -Creating a custom error handler is quite simple. We simply create a special function that can be called when an error occurs in PHP.

        -This function must be able to handle a minimum of two parameters (error level and error message) but can accept up to five parameters (optionally: file, line-number, and the error context):

        -syntax:
            -myError_function(error_level,error_message,error_file,error_line,error_context)
        
            parameters:
            -error_level: Required. Specifies the error report level for the user-defined error. Must be a value number. 
            
            -error_message :Required. Specifies the error message for the user-defined error

            -error_file	:Optional. Specifies the filename in which the error occurred

            -error_line	: Optional. Specifies the line number in which the error occurred

            -error_context	:Optional. Specifies an array containing every variable, and their values, in use when the error occurred
        
        -->Error Report levels:
            1	E_ERROR	 :A fatal run-time error. Execution of the script is stopped

            2	E_WARNING	:A non-fatal run-time error. Execution of the script is not stopped
            
            8	E_NOTICE	:A run-time notice. The script found something that might be an error, but could also happen when running a script normally

            256	E_USER_ERROR :A fatal user-generated error. This is like an E_ERROR, except it is generated by the PHP script using the function trigger_error()
            
            512	E_USER_WARNING	:A non-fatal user-generated warning. This is like an E_WARNING, except it is generated by the PHP script using the function trigger_error()

            1024	E_USER_NOTICE	:A user-generated notice. This is like an E_NOTICE, except it is generated by the PHP script using the function trigger_error()
            
            8191	E_ALL :All errors and warnings (E_STRICT became a part of E_ALL in PHP 5.4)
    
    -->set_Error_Handler:

        -Function to tell the interpreter that my error function will handle errors in a script.

        -Sets a user function (callback) to handle errors in a script.

        -A callback function: is a function passed into another function as an argument, which is then invoked inside the outer function to complete some kind of routine or action.

        -The default error handler for PHP is the built in error handler. We are going to make the function that we wrote the default error handler for the duration of the script.
        
        -example: set_error_handler("customError");

        -It is possible to change the error handler to apply for only some errors, that way the script can handle different errors in different ways , for example:

            set_error_handler("customError",E_USER_WARNING);

    -->Error Logging:   
            - if we used myerror_function , no errors except fatal errors will be logged in the error.log

            -By using error_log($error_msg, message_type, destination_optional) : errors will be logged

            -message_type_optional :
            0 :message is sent to PHP's system logger,This is the default option.

            example:
             error_log("Error : $error_level : $error_message");
        

*/

function my_error_handler($error_level, $error_message, $file, $line){
    echo "<br>";
    echo "<h5>Error : $error_level : $error_message</h5>";
    echo "<h5>File : $file</h5>";
    echo "<h5>Line : $line</h5>";
    echo "<hr>";
    error_log("Error : $error_level : $error_message");

}

set_error_handler("my_error_handler");

echo $x;//warning error

require("xxx"); //fatal error

echo "Good bye";
?>
