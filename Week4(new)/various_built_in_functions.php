<?php
/*
1)header("location:page_name") function: redirects to another page

2)header("refresh:2; url=page_name") function :

- header("refresh:2") : refresh the pages/url after 2 seconds on the same page
- header("refresh:2; url=page_name") : it will refresh after 2 seconds then go to the specified page_name

example:
- if i want to display error_msg in index.php , then i want to refresh after 2 seconds and then remove the error_msg

solution1 ():

if(!empty($_GET["error"]) && $_GET["error"]== "invalid"){
    header("refresh:2");
    echo"<p>Wrong</p>";
}
-this solution is bad because it will refresh on the same url that has the error_msg and it will refresh every 2 seconds
, so i should redirect to a url that has no error word in its url, 
so header("refresh:2; url=index.php") : it will refresh only 1 time after 2 seconds because it will not enter the if condition as there is no error_msg in url

3)explode(separator,string): breaks a string into an array.

    parameters:
        -separator: Required. Specifies where to break the string
            The "separator" parameter cannot be an empty string.

        -string: The string to split

    -return : 	Returns an array of strings.

4)implode(separator,array) :returns a string from the elements of an array.
    
    parameters:
        -separator : Optional. Specifies what to put between the array elements. Default is "" (an empty string)


5) empty($var_name):Determine whether a variable is empty
-returns true:
    -if $var_name is empty string ""
    -if $var_name is not defined
    -if $var_name == null

6))isset(var_name) :Determine if a variable is declared and is different than NULL 
    - if there is a variable
    - $var_name = "" gives true
    - gives false :
        - if var_name is not defined
        - if var_name == null
*/

//example on implode():
$arr = array('Hello','World!','Beautiful','Day!');
echo implode(" ",$arr)."<br>";//Hello World! Beautiful Day!

echo implode("+",$arr)."<br>";//Hello+World!+Beautiful+Day!

?>


