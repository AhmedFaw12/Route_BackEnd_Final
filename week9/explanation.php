<?php

/*
1)blog_erd:
    -we design the database that we will use in our blog project

    1)users table:
        -contain id, name, email, mobile, gender(0,1)(male,female), password, role(admin, editor, user), avtar(profile picture path), created_at, created_by, active(active, or not)(0,1)
        
        -created_by is foreign key that reference id of the admin in same table, where 1 admin can create many users but 1 user is created by 1 admin (1 to many)

    2)posts table:
        -contain id, title, body, image(image path), created_by(user who created this post), status(pending, approved, rejected), action_by(admin which approve or reject the post to be published), created_at

        -created_by is foreign key that reference id of the user in users table, where 1 user can create many posts but 1 post is created by 1 user (1 to many)

        -action_by is foreign key that reference id of the admin in users table, where 1 admin can (approve , reject) many posts but 1 post is managed by 1 admin (1 to many)

    3)comments table:
        -1user can make many comments, 1post can contain many comments, 

        -contain id, comment(what to write), post_id(what post contain that comment), user_id(which user wrote this comment), created_at

        -user_id is foreign key that reference id of the user in users table, where 1 user can create many comments but each comment is created by 1 user (1 to many)

        -post_id is foreign key that reference id of the post in posts table, where 1 post can have many comments but each comment is written in 1 post (1 to many)


    4) likes table:
        -contain id, post_id, user_id, type(like, love, angry,care)

        -user_id is foreign key that reference id of the user in users table, where 1 user can  many likes but each like is created by 1 user  (1 to many)

        -post_id is foreign key that reference id of the post in posts table, where 1 post can have many like but each comment is made in 1 post (1 to many)
**************************************************************

2)register(sign up):
    -we searched for a login template from (colorlib) or (startbootstrap) websites , then downloaded the template

    -register.php : we added inputs for name , email, password, pass_confirmation, gender(radio buttons),

    -register.php : we send data by method (post), send the data to register_action.php

    -register_action.php : we will make two things: validation & saving data in database 
    
    /////////////////////////////////////////////////////
    validations: 
    filter_and_validations:

    -validations can be done through 2 levels :client side(done by js) (can be removed through inspect), server side(php)

    - we use validations also to remove injections scripts

    -we want to validate if the email is written in correct email form
    -we want to validate email before searching in database because database has large amount of data and searching in database will consume time , so we must validate if the email is written in corrent email form

    functions:

    1)filter_var(var, filtername, options): filters a variable with the specified filter.

    return : Returns the filtered data on success, FALSE on failure
    Parameters:
        -var :Required. The variable to filter

        -filtername:	Optional. Specifies the ID or name of the filter to use. Default is FILTER_DEFAULT, which results in no filtering

        - options	:Optional. Specifies one or more flags/options to use. Check each filter for possible options and flags


    PHP Predefined Filter Constants(filternames) : they are constants , each one refer to a number

    1)FILTER_VALIDATE_BOOLEAN : validates value as a boolean option
        -ID-number: 258
        -Possible return values:
            -Returns TRUE for "1", "true", "on" and "yes"
            -Returns FALSE for "0"(zero string or number), "false", "off" and "no"
            -Returns NULL on failure if FILTER_NULL_ON_FAILURE is set
        -possible flags:
            -FILTER_NULL_ON_FAILURE :If FILTER_NULL_ON_FAILURE is set, false is returned only for "0", "false", "off", "no", and "", and null is returned for all non-boolean values.
            
    2)FILTER_SANITIZE_EMAIL:Remove all illegal characters from an email address:
        
        -removes all characters except letters, digits and !#$%&'*+-=?^_`{|}~@.[]
        
        -ilegal characters like : (), /, <, >, \, spaces
    
    3)FILTER_VALIDATE_EMAIL : validates an e-mail address. (if email is written with correct format)

    4)FILTER_SANITIZE_NUMBER_INT :  
        -ID-number: 519
        -removes all illegal characters from a number.
        - allows digits and . + -

    5)FILTER_VALIDATE_INT :
        -is used to validate value as integer.
        -also allows us to specify a range for the integer variable.
        -Possible options and flags:
            -min_range - specifies the minimum integer value
            -max_range - specifies the maximum integer value
            -FILTER_FLAG_ALLOW_OCTAL - allows octal number values
            -FILTER_FLAG_ALLOW_HEX - allows hexadecimal number values

        -When specifying options in an array. The options must be in an associative multidimensional array with the name "options".

    6)FILTER_SANITIZE_NUMBER_FLOAT:
        -removes all illegal characters from a float number.
        -his filter allows digits and + - by default.
        
        Possible flags:
            -FILTER_FLAG_ALLOW_FRACTION - Allow fraction separator (like . )
            -FILTER_FLAG_ALLOW_THOUSAND - Allow thousand separator (like , )
            -FILTER_FLAG_ALLOW_SCIENTIFIC - Allow scientific notation (like e and E)

    7) FILTER_SANITIZE_STRING:removes tags and remove or encode special characters from a string.

    possible flags:
    -FILTER_FLAG_NO_ENCODE_QUOTES - Do not encode quotes
    -FILTER_FLAG_STRIP_LOW - Remove characters with ASCII value < 32
    -FILTER_FLAG_STRIP_HIGH - Remove characters with ASCII value > 127


    8)FILTER_VALIDATE_FLOAT: filter validates a value as a float number.

    /////////////////////////////////////////////////////////

    - in register_action.php we will make an array for errors to collect errors and send it to register.php if there is errors

    -in register_action.php :first we check if all inputs are empty , then check if email is valid or not , then if the errors array is empty then save the data in database , else send the errors array to register.php

    -errors array can not be send through url , so we will put it in session , so that all pages can see it but do not forget to write session_start at the beginning of the page that will use the session

    - in register.php , inorder to make error appear in the template , the template uses a predefined class called (alert-validate) ,  to write the error message the 
    template uses attribute called (data-validate)

    - in register_action.php : if inputs are not empty , then save them in old_values array , then if there are errors , then send them in a session to register.php so that the old_values be written in the value attribute of input tag

    -in register.php , i have to check if errors exist then print the error

    

    -we will make config.php before register_action.php : to define constants for the database info(, servername, admin, pass, databaseName, port_no)
    


****************************************************************************************************************************

3)login(sign in):
    - we will make login.php to process the login
    - login.php filter and validate email , password

    -in login.php : connect to db , select user data from db if match in db

    -in login.php : after select check if we can fetch the data or not (if input data does not match in db)

    - in index.php : check if there are errors then print error message like register.php 
    
    -in login.php : after we succeded to get user data, save user data in session ,then go to home.php
****************************************************************************************************************************
4)home(main_page):
    - we will make home.php : copy paste index.php but remove all except the body
    - add navbar from bootstrap 
    - add logout button or link
    - check if session is empty incase someone wrote home page in the url without login

****************************************************************************************************************************
5) logout:
    - destroy session
    - go to index.php
*************************************************************************************
6)git_Management:
    
*/

    //example on FILTER_VALIDATE_BOOLEAN
    $var1 = "yes";
    $var2 = "off";
    
    var_dump(filter_var($var1, FILTER_VALIDATE_BOOLEAN)); //bool(true)
echo "<br>";
var_dump(filter_var($var2, FILTER_VALIDATE_BOOLEAN)); //bool(false)

echo "<hr>";
//example on FILTER_VALIDATE_BOOLEAN
$var1 = "Hello";
$var2 = 23;

var_dump(filter_var($var1, FILTER_VALIDATE_BOOLEAN)); //false
echo "<br>";
var_dump(filter_var($var1, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)); //null
echo "<br>";
var_dump(filter_var($var2, FILTER_VALIDATE_BOOLEAN)); //false
echo "<br>";
var_dump(filter_var($var2, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE)); //null

echo "<hr>";


//Example on FILTER_SANITIZE_EMAIL
$email = "john(.doe)@exa//mple.com";

$email = filter_var($email, FILTER_SANITIZE_EMAIL);
echo $email;

echo "<hr>"; //john.doe@example.com

//Example on  FILTER_VALIDATE_EMAIL
//First remove all illegal characters from the $email variable, then check if it is a valid email address:

// Variable to check
$email = "john.doe@example.com";

// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate e-mail
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("$email is a valid email address");
} else {
    echo ("$email is not a valid email address");
}
echo "<hr>";
//example 1 on FILTER_VALIDATE_INT
//FILTER_VALIDATE_INT and Problem With 0 - In the example above, if $int was set to 0, the function above will return "Variable is not an integer". To solve this problem, use the code below:

$int = 0;

if (filter_var($int, FILTER_VALIDATE_INT) === 0 || filter_var($int, FILTER_VALIDATE_INT)) {

    echo ("Variable is an integer");
} else {
    echo ("Variable is not an integer");
}

echo "<hr>";
//Example 2
//Check if a variable is both of type INT, and between 1 and 200:

$int = 122;
$min = 1;
$max = 200;

if (filter_var($int, FILTER_VALIDATE_INT, array("options" => array("min_range" => $min, "max_range" => $max))) === false) {
    echo ("Variable value is not within the legal range");
} else {
    echo ("Variable value is within the legal range");
}
echo "<hr>";

//example on FILTER_SANITIZE_NUMBER_INT
$number="5-2+3pp";

var_dump(filter_var($number, FILTER_SANITIZE_NUMBER_INT));//string(5) "5-2+3"
echo "<hr>";

//example on FILTER_SANITIZE_NUMBER_FLOAT
$number="5-2f+3.3pp";

var_dump(filter_var($number, FILTER_SANITIZE_NUMBER_FLOAT,
FILTER_FLAG_ALLOW_FRACTION));//string(7) "5-2+3.3"
echo "<hr>";


//example on FILTER_SANITIZE_STRING
$str = "<h1>Hello WorldÆØÅ!</h1>";

$newstr = filter_var($str, FILTER_SANITIZE_STRING,FILTER_FLAG_STRIP_HIGH);
////strip_tags to remove tags, sanitize email to remove spaces and special characters
$str2 = strip_tags($str); //same as filter_sanitize_string

echo $str2;//Hello WorldÆØÅ!
echo "<hr>";
echo $newstr;//Hello World!
echo "<hr>";

?>
<!-- example  -->
<form action="">
    <input type="text" name="name" onblur="submit();">    
</form>

<?php
if(!empty($_GET["name"])){
    // $name = filter_var($_GET["name"], FILTER_SANITIZE_STRING);//depricated
    

    $name = filter_var(strip_tags($_GET["name"]), FILTER_SANITIZE_EMAIL);

    // $name = strip_tags($_GET["name"]);
    echo $name;
}
//////////////////////////////////////////////////////////////
?>