<?php

/* 
    project_requirements:
    1)login: check the associative array(which come from a file), if email and password exists then go to home page, if empty or wrong send an error_msg

    2)logout :clear session , go to index page

    3)remember me checkbox : store cookie so when i close browser and reopen the browser, I can still enter home page and account still open


    4)sign_up

    //////////////////////////////////////////////////////////
    login:

    - when user login , go to login.php , validate user_info,
    ,check if email and pw exists , go to home page
    steps:
    1)user login , go to login.php
    2)in login.php , check if post (email , pw) not empty , if empty go to index.php and print empty_error_msg
    
    3)in login.php validate (email , pw)

    4)in login.php , check if email, pw exists in the associative array, if not go to index.php and print invalid_error_msg

    5)in index.php , if there is error_msg  , print it then refresh the page to remove the error_msg

    6)in login.php , if we have made correct login, then go to home.php

    //////////////////////////////////////////////////////////
    filter_and_validations:

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
        
        -ilegal characters like : (), /, <>,\, spaces
    
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

    //////////////////////////////////////////////////////////

    save user in session:
    --------------------

    -after we made correct login, we need to save user in session, so that all pages can see user data 

    1)in login.php ,before going to home.php, save user in session, but write session_start() in login.php to write in session array and also write session_start() in home.php to read from session_start()

    2)in home.php check if session user data exists, if not go to index.php and print an error_msg


    
    /////////////////////////////////////////////////////////
    remember Me(cookie):
    -----------
    
    1)in login.php ,after checking and validating data , check if cookie array is not empty
    
    2) setcookie for user data
    - to send array in a cookie, we should convert it to json using json_encode($arr).
    
    -json_encode(value) : encode a value to JSON format.
    
    
    3) in index.php , check if there is cookie for user so that when closing browser and opening it  , don't open index.php and head to home.php
    
    4)after checking if there is cookie for user, put user data in session and go to home.php
    -json_decode(string, assoc) : decode or convert a JSON object to a PHP object.
    
    parameters:
    -assoc	:Optional. Specifies a Boolean value. When set to true, the returned object will be converted into an associative array. When set to false, it returns an object. False is default


    /////////////////////////////////////////////////////////
    logout:
    ------
    -we want to destroy session , remove any cookie, go to index.php
    
    1)in home.php , make link(<a href= "index.php"></a>) to index.php

    2) start session, destroy session
    3) make cookies values null or delete them
    4) go to index.php

    /////////////////////////////////////////////////////////////
    signUp:
    -------
    
    1)signUp.php: contains the form 
    
    2)sign_up_proc.php:
    ----------------
        1)filter and validate email, user, password
        2)check if email exists in file or not
        3)add user data to the file
        4)save current user_data in session
        5)go to home.php

    3)usersArray.php:
    --------------
        1)created users array from a file
    
    4)login.php:
    ---------
        1)added require_once("usersArray.php"); to get users array


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

