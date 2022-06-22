<?php
/* 
explanation of example : we want when the user choose a color from option tag , background color will change and the color is saved in cookie 

<option></option> tag html : 
-The <option> tag defines an option in a select list.
-The <option> tag can be used without any attributes, but you usually need the value attribute, which indicates what is sent to the server on form submission.

-Attributes:
disabled :Specifies that an option should be disabled
selected : Specifies that an option should be pre-selected when the page loads
value : Specifies the value to be sent to a server

-onchange event :
    -The onchange event occurs when the value of an element has been changed.
    -For radiobuttons and checkboxes, the onchange event occurs when the checked state has been changed.
    -Execute a JavaScript when a user changes the selected option of a <select> element:
        <select onchange="myFunction()"> </select>
    -submit() : built in function in js to submit form    


example on option : 
<select id="cars">
  <option value="volvo">Volvo</option>
  <option value="saab">Saab</option>
  <option value="opel">Opel</option>
  <option value="audi">Audi</option>
</select>

*/

$s = "gray";//beginning value default
if(!empty($_GET["change_style"])){
    $s = $_GET["change_style"];
    setcookie("sCookie", $s, time() + 60*60*24*7);
}else if(!empty($_COOKIE["sCookie"])){
    $s = $_COOKIE["sCookie"];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Style_Changing</title>

    <style>
        .dark {
            background-color: black;
            color: white;
        }

        .gray {
            background-color: gray;
            color: maroon;
        }

        .orange {
            background-color: peru;
            color: orangered;
        }
    </style>
</head>
<body class="<?=$s?>">
    <h1>Change Color</h1>
    
    <form action="demo.php" method="get">
        <select name="change_style" onchange="submit();">
            <option value="gray" <?php if($s==="gray") echo "selected" ?>>gray</option>
            <option value="orange" <?php if($s==="orange") echo "selected" ?> >orange</option>
            <option value="dark" <?php if($s==="dark") echo "selected" ?>>dark</option>

        </select>
    </form>
</body>
</html>