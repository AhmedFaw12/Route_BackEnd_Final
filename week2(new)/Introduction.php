<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<!--  -->
<body>
    
    <?php
        /* 
        comments in php :
        1) // in line comment   
        2) # in line comment
        3) /* */
        
        #*/
        

        /* 
            comment in html:
           <!--  -->

           comment in css:
             /*  */
        #*/


        /*
            -function : is a reusable code
            - built in functions take () , but in php make synonym(name without ()) for some functions


            -printing in php:
            1)echo:
            - echo : is a built in function to print 
            - echo can take unlimited arguments
            - echo is used more than print
            2)print:
             -print takes only 1 argument
             -if i want print to take multiple arguments , we can use concat operator (.) 
            

            -date() built in  function:
            - date() returns a formated date string based on a format that i give to it

            - php supports both single quotes'' nad double quotes ""

           - we must put ; at end of each line .
           - if it is the last line in code we can neglect ;
           
           - we can write html inside php
            
        */

        #example on echo
        echo "Welcome from php";
        echo 'Welcome from php';

        #example on writing html inside php
        echo "<br> Welcome from php";

        #example on multiple arguments echo
        echo "<br> Welcome from php", "test", "<br>", 100;

        #example on print
        print "<br> Welcome from php" . "test";
        
        #example on date()
        echo  '<br>',  date('y-m-d');
        ?>
</body>
</html>